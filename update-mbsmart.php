<?php
/**
 * The Unzipper extracts .zip or .rar archives and .gz files on webservers.
 * It's handy if you do not have shell access. E.g. if you want to upload a lot
 * of files (php framework or image collection) as an archive to save time.
 * As of version 0.1.0 it also supports creating archives.
 *
 * @author  Andreas Tasch, at[tec], attec.at
 * @license GNU GPL v3
 * @package attec.toolbox
 * @version 1.1
 * adapted for MB-SMART September 2019 revised October 2019
 */
define('VERSION', '1.1 October 2019');
$timestart = microtime(TRUE);
$GLOBALS['status'] = array();
$unzipper = new Unzipper;
if (isset($_POST['dounzip'])) {
  // Check if an archive was selected for unzipping.
  $archive = isset($_POST['zipfile']) ? strip_tags($_POST['zipfile']) : '';
  $destination = isset($_POST['extpath']) ? strip_tags($_POST['extpath']) : '';
  $unzipper->prepareExtraction($archive, $destination);
}
if (isset($_POST['dozip'])) {
  $zippath = !empty($_POST['zippath']) ? strip_tags($_POST['zippath']) : '.';
  // Resulting zipfile e.g. zipper--2016-07-23--11-55.zip.
  $zipfile = 'MB-SMART-' . date("YmdHi") . '.zip';
  Zipper::zipDir($zippath, $zipfile);
}
$timeend = microtime(TRUE);
$time = round($timeend - $timestart, 4);
/**
 * Class Unzipper
 */
class Unzipper {
  public $localdir = '.';
  public $zipfiles = array();
  public function __construct() {
    // Read directory and pick .zip, .rar and .gz files.
    if ($dh = opendir($this->localdir)) {
      while (($file = readdir($dh)) !== FALSE) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'zip'
          || pathinfo($file, PATHINFO_EXTENSION) === 'gz'
          || pathinfo($file, PATHINFO_EXTENSION) === 'rar'
        ) {
          $this->zipfiles[] = $file;
        }
      }
      closedir($dh);
      if (!empty($this->zipfiles)) {
        $GLOBALS['status'] = array('info' => '<b>Success !</b> mb-smart-updater.zip file or mb-smart backup <b>found</b>, select file for updating below');
      }
      else {
        $GLOBALS['status'] = array('info' => '<b>Sorry No !</b> mb-smart-updater.zip or mb-smart back up file <b>found</b>.');
      }
    }
  }
  /**
   * Prepare and check zipfile for extraction.
   *
   * @param string $archive
   *   The archive name including file extension. E.g. my_archive.zip.
   * @param string $destination
   *   The relative destination path where to extract files.
   */
  public function prepareExtraction($archive, $destination = '') {
    // Determine paths.
    if (empty($destination)) {
      $extpath = $this->localdir;
    }
    else {
      $extpath = $this->localdir . '/' . $destination;
      // Todo: move this to extraction function.
      if (!is_dir($extpath)) {
        mkdir($extpath);
      }
    }
    // Only local existing archives are allowed to be extracted.
    if (in_array($archive, $this->zipfiles)) {
      self::extract($archive, $extpath);
    }
  }
  /**
   * Checks file extension and calls suitable extractor functions.
   *
   * @param string $archive
   *   The archive name including file extension. E.g. my_archive.zip.
   * @param string $destination
   *   The relative destination path where to extract files.
   */
  public static function extract($archive, $destination) {
    $ext = pathinfo($archive, PATHINFO_EXTENSION);
    switch ($ext) {
      case 'zip':
        self::extractZipArchive($archive, $destination);
        break;
      case 'gz':
        self::extractGzipFile($archive, $destination);
        break;
      case 'rar':
        self::extractRarArchive($archive, $destination);
        break;
    }
  }
  /**
   * Decompress/extract a zip archive using ZipArchive.
   *
   * @param $archive
   * @param $destination
   */
  public static function extractZipArchive($archive, $destination) {
    // Check if webserver supports unzipping.
    if (!class_exists('ZipArchive')) {
      $GLOBALS['status'] = array('error' => 'Error: Your PHP version does not support unzip functionality.');
      return;
    }
    $zip = new ZipArchive;
    // Check if archive is readable.
    if ($zip->open($archive) === TRUE) {
      // Check if destination is writable
      if (is_writeable($destination . '/')) {
        $zip->extractTo($destination);
        $zip->close();
        $GLOBALS['status'] = array('success' => 'MB SMART updated successfully');
      }
      else {
        $GLOBALS['status'] = array('error' => 'Error: Directory not writeable by webserver.');
      }
    }
    else {
      $GLOBALS['status'] = array('error' => 'Error: Cannot read .zip archive.');
    }
  }
  /**
   * Decompress a .gz File.
   *
   * @param string $archive
   *   The archive name including file extension. E.g. my_archive.zip.
   * @param string $destination
   *   The relative destination path where to extract files.
   */
  public static function extractGzipFile($archive, $destination) {
    // Check if zlib is enabled
    if (!function_exists('gzopen')) {
      $GLOBALS['status'] = array('error' => 'Error: Your PHP has no zlib support enabled.');
      return;
    }
    $filename = pathinfo($archive, PATHINFO_FILENAME);
    $gzipped = gzopen($archive, "rb");
    $file = fopen($destination . '/' . $filename, "w");
    while ($string = gzread($gzipped, 4096)) {
      fwrite($file, $string, strlen($string));
    }
    gzclose($gzipped);
    fclose($file);
    // Check if file was extracted.
    if (file_exists($destination . '/' . $filename)) {
      $GLOBALS['status'] = array('success' => 'File unzipped successfully.');
      // If we had a tar.gz file, let's extract that tar file.
      if (pathinfo($destination . '/' . $filename, PATHINFO_EXTENSION) == 'tar') {
        $phar = new PharData($destination . '/' . $filename);
        if ($phar->extractTo($destination)) {
          $GLOBALS['status'] = array('success' => 'Extracted tar.gz archive successfully.');
          // Delete .tar.
          unlink($destination . '/' . $filename);
        }
      }
    }
    else {
      $GLOBALS['status'] = array('error' => 'Error unzipping file.');
    }
  }
  /**
   * Decompress/extract a Rar archive using RarArchive.
   *
   * @param string $archive
   *   The archive name including file extension. E.g. my_archive.zip.
   * @param string $destination
   *   The relative destination path where to extract files.
   */
  public static function extractRarArchive($archive, $destination) {
    // Check if webserver supports unzipping.
    if (!class_exists('RarArchive')) {
      $GLOBALS['status'] = array('error' => 'Error: Your PHP version does not support .rar archive functionality. <a class="info" href="http://php.net/manual/en/rar.installation.php" target="_blank">How to install RarArchive</a>');
      return;
    }
    // Check if archive is readable.
    if ($rar = RarArchive::open($archive)) {
      // Check if destination is writable
      if (is_writeable($destination . '/')) {
        $entries = $rar->getEntries();
        foreach ($entries as $entry) {
          $entry->extract($destination);
        }
        $rar->close();
        $GLOBALS['status'] = array('success' => 'Files extracted successfully.');
      }
      else {
        $GLOBALS['status'] = array('error' => 'Error: Directory not writeable by webserver.');
      }
    }
    else {
      $GLOBALS['status'] = array('error' => 'Error: Cannot read .rar archive.');
    }
  }
}
/**
 * Class Zipper
 *
 * Copied and slightly modified from http://at2.php.net/manual/en/class.ziparchive.php#110719
 * @author umbalaconmeogia
 */
class Zipper {
  /**
   * Add files and sub-directories in a folder to zip file.
   *
   * @param string $folder
   *   Path to folder that should be zipped.
   *
   * @param ZipArchive $zipFile
   *   Zipfile where files end up.
   *
   * @param int $exclusiveLength
   *   Number of text to be exclusived from the file path.
   */
  private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
    $handle = opendir($folder);
    while (FALSE !== $f = readdir($handle)) {
      // Check for local/parent path or zipping file itself and skip.
      if ($f != '.' && $f != '..' && $f != basename(__FILE__)) {
        $filePath = "$folder/$f";
        // Remove prefix from file path before add to zip.
        $localPath = substr($filePath, $exclusiveLength);
        if (is_file($filePath)) {
          $zipFile->addFile($filePath, $localPath);
        }
        elseif (is_dir($filePath)) {
          // Add sub-directory.
          $zipFile->addEmptyDir($localPath);
          self::folderToZip($filePath, $zipFile, $exclusiveLength);
        }
      }
    }
    closedir($handle);
  }
  /**
   * Zip a folder (including itself).
   *
   * Usage:
   *   Zipper::zipDir('path/to/sourceDir', 'path/to/out.zip');
   *
   * @param string $sourcePath
   *   Relative path of directory to be zipped.
   *
   * @param string $outZipPath
   *   Relative path of the resulting output zip file.
   */
  public static function zipDir($sourcePath, $outZipPath) {
    $pathInfo = pathinfo($sourcePath);
    $parentPath = $pathInfo['dirname'];
    $dirName = $pathInfo['basename'];
    $z = new ZipArchive();
    $z->open($outZipPath, ZipArchive::CREATE);
    $z->addEmptyDir($dirName);
    if ($sourcePath == $dirName) {
      self::folderToZip($sourcePath, $z, 0);
    }
    else {
      self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
    }
    $z->close();
    $GLOBALS['status'] = array('success' => 'MB-SMART Successfully backed up and created ' . $outZipPath);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>MB SMART Updater & Backup</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <style type="text/css">
    <!--
    body {
      font-family: Arial,Helvetica,sans-serif;
      line-height: 150%;
	  width:60%;	  
	  margin:0 auto;
	  background-color:0;
	  color:#f3f4f7;
	   -webkit-appearance: none;
	   font-size:14px;
    }
	
	a{text-transform:none;text-decoration:none;color:#262830}
	h1{font-size:1.2em;font-weight:500}
    label {
      display: block;
      margin-top: 10px;
	  -webkit-appearance: none;
    }
    fieldset {
      border: 0;
      background-color: #262830;
      margin: 10px 0 10px 0;
	    -webkit-appearance: none;
		-webkit-border-radius:3px;
		border-radius:3px;
    }
    .select {
      padding: 5px;
      font-size: 110%;
	  -webkit-appearance: none;
	  -webkit-border-radius:3px;
		border-radius:3px;
    }
    .status {
      margin: 0;
	  margin-top:10px;
      margin-bottom: 20px;
      padding: 10px;
      font-size: 1em;
      background: #b83603;
      border:0;
	  -webkit-border-radius:3px;
		border-radius:3px;
    }
    .status--ERROR {
      background-color:#b8362d;
      color: white;
      font-size: 120%;
    }
    .status--SUCCESS {
      background-color: #01a4b5;
      font-weight: bold;
      color: white;
      font-size: 120%
    }
    .small {
      font-size: 0.7rem;
      font-weight: normal;
    }    
    .form-field {
      border:0;
      padding: 8px;
      width: 280px;
	   -webkit-appearance: none;
	  -webkit-border-radius:3px;
		border-radius:3px;
	  
    }
    .info {
      margin-top: 0;
      font-size: 90%;
      color: silver;
    }
    .submit {
      background-color:#01a4b5;
      border: 0;
      color: #ffffff;
      font-size: 15px;
      padding: 10px 24px;
      margin: 20px 0 20px 0;
      text-decoration: none;
	   -webkit-appearance: none;
	   -webkit-border-radius:3px;
		border-radius:3px;
    }
    .submit:hover {
      background-color: #b83603;
      cursor: pointer;
	   -webkit-appearance: none;
    }
	.version{color:#555;font-size:70%;}
	orange{color:#01a4b5}
	blue{color:#01a4b5}
	
    -->
  </style>
</head>
<body>

<p class="status status--<?php echo strtoupper(key($GLOBALS['status'])); ?>">
  
  <svg id="i-info" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
    <path d="M16 14 L16 23 M16 8 L16 10" />    <circle cx="16" cy="16" r="14" /></svg> 
  Status: <?php echo reset($GLOBALS['status']); ?><br/>
  <span class="small">Processing Time: <?php echo $time; ?> seconds</span>
</p>



<form action="" method="POST">
  <fieldset>
  <svg id="weather34 mb smart logo" width="50pt" height="50pt" viewBox="0 0 300 300" version="1.1" xmlns="http://www.w3.org/2000/svg">
<path fill="#707070" stroke="#707070" stroke-width="0.09375" opacity="1.00" d=" M 39.75 72.69 C 53.65 60.89 70.89 53.07 88.93 50.43 C 94.60 49.71 100.32 50.09 106.02 50.00 C 120.97 49.35 135.84 53.66 149.02 60.53 C 159.52 54.95 171.13 51.32 182.97 50.14 C 191.01 49.94 199.07 49.83 207.11 50.22 C 228.01 52.68 247.91 62.40 263.03 76.99 C 282.34 95.50 293.92 122.19 293.01 149.04 C 293.28 162.90 289.92 176.68 284.19 189.24 C 272.88 213.93 250.92 233.48 225.04 241.74 C 200.20 250.13 172.16 247.60 148.99 235.44 C 133.13 243.73 114.98 247.57 97.12 246.54 C 81.97 245.23 66.97 240.93 53.82 233.17 C 32.86 221.04 16.68 200.95 9.40 177.84 C 4.98 164.69 4.31 150.64 5.39 136.90 C 8.08 112.14 20.67 88.67 39.75 72.69 M 89.46 59.62 C 77.35 61.27 65.84 66.14 55.47 72.51 C 35.09 85.36 20.41 106.79 15.60 130.38 C 12.74 147.65 13.61 166.00 20.79 182.16 C 29.29 202.70 45.66 219.88 65.92 229.08 C 83.14 237.58 103.17 239.01 121.88 235.60 C 149.03 229.85 173.11 210.95 184.64 185.64 C 193.52 167.66 194.72 146.68 190.74 127.25 C 187.19 113.50 180.66 100.41 171.31 89.67 C 159.36 75.60 142.84 65.72 125.05 61.02 C 113.41 58.38 101.28 57.88 89.46 59.62 M 159.14 65.79 C 159.13 65.95 159.10 66.25 159.09 66.41 C 175.66 77.84 188.83 94.25 195.87 113.15 C 204.35 135.37 204.32 160.65 195.84 182.86 C 188.71 201.96 175.31 218.47 158.51 229.95 C 176.17 237.80 196.29 239.12 215.09 235.13 C 234.45 230.34 252.26 219.22 264.63 203.53 C 276.97 187.85 284.47 168.03 283.88 147.94 C 284.48 127.86 276.95 108.06 264.62 92.39 C 252.22 76.66 234.35 65.53 214.95 60.77 C 196.42 56.86 176.54 58.04 159.14 65.79 Z" />
<path fill="#00a4b4" stroke="#00a4b4" stroke-width="0.09375" opacity="1.00" d=" M 89.46 59.62 C 101.28 57.88 113.41 58.38 125.05 61.02 C 142.84 65.72 159.36 75.60 171.31 89.67 C 180.66 100.41 187.19 113.50 190.74 127.25 C 194.72 146.68 193.52 167.66 184.64 185.64 C 173.11 210.95 149.03 229.85 121.88 235.60 C 103.17 239.01 83.14 237.58 65.92 229.08 C 45.66 219.88 29.29 202.70 20.79 182.16 C 13.61 166.00 12.74 147.65 15.60 130.38 C 20.41 106.79 35.09 85.36 55.47 72.51 C 65.84 66.14 77.35 61.27 89.46 59.62 M 97.80 76.89 C 97.81 85.35 97.83 93.81 97.79 102.26 C 100.07 102.27 102.35 102.30 104.64 102.35 C 104.80 93.91 104.58 85.46 104.76 77.02 C 102.44 76.87 100.12 76.84 97.80 76.89 M 54.42 102.39 C 59.22 107.26 64.12 112.06 68.92 116.94 C 70.56 115.17 72.26 113.47 74.03 111.83 C 69.11 107.09 64.32 102.20 59.47 97.37 C 57.83 99.08 56.14 100.76 54.42 102.39 M 129.48 111.80 C 131.26 113.47 133.03 115.14 134.78 116.84 C 139.37 111.95 144.09 107.15 149.06 102.63 C 147.45 100.76 145.65 99.06 143.96 97.26 C 139.24 102.21 134.32 106.96 129.48 111.80 M 94.21 113.28 C 81.70 116.21 71.55 127.22 69.88 139.98 C 67.76 152.95 74.73 166.63 86.27 172.79 C 96.82 178.78 110.82 177.94 120.57 170.70 C 132.51 162.45 137.30 145.67 131.57 132.35 C 125.92 118.02 109.16 109.35 94.21 113.28 M 33.16 141.66 C 33.21 143.93 33.19 146.19 33.12 148.46 C 41.57 148.57 50.01 148.45 58.45 148.52 C 58.44 146.22 58.43 143.93 58.45 141.63 C 50.02 141.67 41.59 141.60 33.16 141.66 M 144.21 141.66 C 144.25 143.92 144.24 146.19 144.18 148.46 C 152.62 148.56 161.07 148.47 169.51 148.51 C 169.48 146.21 169.48 143.92 169.50 141.63 C 161.07 141.67 152.64 141.61 144.21 141.66 M 54.33 186.87 C 56.08 188.48 57.78 190.14 59.39 191.88 C 64.28 187.08 69.16 182.26 73.94 177.35 C 72.17 175.77 70.49 174.09 68.91 172.33 C 64.07 177.20 59.22 182.05 54.33 186.87 M 129.57 177.39 C 134.27 182.36 139.29 187.02 143.98 192.00 C 145.64 190.22 147.36 188.49 149.14 186.83 C 144.28 182.07 139.39 177.35 134.76 172.37 C 133.04 174.05 131.30 175.72 129.57 177.39 M 97.79 187.86 C 97.82 196.32 97.82 204.78 97.79 213.24 C 100.10 213.24 102.42 213.24 104.73 213.24 C 104.53 204.73 104.95 196.21 104.52 187.71 C 102.28 187.82 100.03 187.86 97.79 187.86 Z" />
<path fill="#ff8841" stroke="#ff8841" stroke-width="0.09375" opacity="1.00" d=" M 159.14 65.79 C 176.54 58.04 196.42 56.86 214.95 60.77 C 234.35 65.53 252.22 76.66 264.62 92.39 C 276.95 108.06 284.48 127.86 283.88 147.94 C 284.47 168.03 276.97 187.85 264.63 203.53 C 252.26 219.22 234.45 230.34 215.09 235.13 C 196.29 239.12 176.17 237.80 158.51 229.95 C 175.31 218.47 188.71 201.96 195.84 182.86 C 204.32 160.65 204.35 135.37 195.87 113.15 C 188.83 94.25 175.66 77.84 159.09 66.41 C 159.10 66.25 159.13 65.95 159.14 65.79 M 247.34 94.40 C 243.39 95.91 242.21 101.72 245.44 104.55 C 257.25 115.77 264.68 131.63 264.94 148.00 C 265.48 162.74 260.53 177.69 251.04 189.02 C 249.24 191.43 246.30 193.64 246.60 196.98 C 246.81 201.87 253.64 205.07 257.09 201.16 C 273.44 184.61 280.72 159.77 276.56 136.95 C 273.84 121.27 265.94 106.55 254.35 95.65 C 252.53 93.90 249.63 93.14 247.34 94.40 M 229.47 111.52 C 225.20 113.44 225.00 119.68 228.63 122.35 C 241.59 134.69 243.44 156.50 232.82 170.88 C 231.14 173.53 227.81 175.53 228.08 179.04 C 227.85 182.68 231.50 185.77 235.03 185.40 C 238.33 184.77 240.34 181.86 242.26 179.37 C 249.51 169.98 253.04 157.91 252.37 146.10 C 251.60 133.42 245.96 120.97 236.51 112.42 C 234.64 110.66 231.70 110.04 229.47 111.52 M 210.47 126.53 C 208.05 128.09 206.68 131.28 207.86 134.02 C 209.03 136.43 211.30 138.07 212.62 140.39 C 216.03 146.20 215.73 154.14 211.57 159.50 C 210.44 161.23 208.71 162.76 208.57 164.95 C 207.98 169.69 213.91 173.69 217.98 170.98 C 231.15 160.01 230.60 137.33 217.35 126.64 C 215.40 125.10 212.46 125.06 210.47 126.53 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 97.80 76.89 C 100.12 76.84 102.44 76.87 104.76 77.02 C 104.58 85.46 104.80 93.91 104.64 102.35 C 102.35 102.30 100.07 102.27 97.79 102.26 C 97.83 93.81 97.81 85.35 97.80 76.89 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 247.34 94.40 C 249.63 93.14 252.53 93.90 254.35 95.65 C 265.94 106.55 273.84 121.27 276.56 136.95 C 280.72 159.77 273.44 184.61 257.09 201.16 C 253.64 205.07 246.81 201.87 246.60 196.98 C 246.30 193.64 249.24 191.43 251.04 189.02 C 260.53 177.69 265.48 162.74 264.94 148.00 C 264.68 131.63 257.25 115.77 245.44 104.55 C 242.21 101.72 243.39 95.91 247.34 94.40 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 54.42 102.39 C 56.14 100.76 57.83 99.08 59.47 97.37 C 64.32 102.20 69.11 107.09 74.03 111.83 C 72.26 113.47 70.56 115.17 68.92 116.94 C 64.12 112.06 59.22 107.26 54.42 102.39 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 129.48 111.80 C 134.32 106.96 139.24 102.21 143.96 97.26 C 145.65 99.06 147.45 100.76 149.06 102.63 C 144.09 107.15 139.37 111.95 134.78 116.84 C 133.03 115.14 131.26 113.47 129.48 111.80 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 229.47 111.52 C 231.70 110.04 234.64 110.66 236.51 112.42 C 245.96 120.97 251.60 133.42 252.37 146.10 C 253.04 157.91 249.51 169.98 242.26 179.37 C 240.34 181.86 238.33 184.77 235.03 185.40 C 231.50 185.77 227.85 182.68 228.08 179.04 C 227.81 175.53 231.14 173.53 232.82 170.88 C 243.44 156.50 241.59 134.69 228.63 122.35 C 225.00 119.68 225.20 113.44 229.47 111.52 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 94.21 113.28 C 109.16 109.35 125.92 118.02 131.57 132.35 C 137.30 145.67 132.51 162.45 120.57 170.70 C 110.82 177.94 96.82 178.78 86.27 172.79 C 74.73 166.63 67.76 152.95 69.88 139.98 C 71.55 127.22 81.70 116.21 94.21 113.28 M 96.25 120.22 C 83.19 122.86 73.99 137.18 77.36 150.14 C 79.90 162.34 92.56 171.30 104.92 169.41 C 118.05 168.07 128.44 154.97 126.66 141.87 C 125.47 127.57 110.20 116.53 96.25 120.22 Z" />
<path fill="#00a4b4" stroke="#00a4b4" stroke-width="0.09375" opacity="1.00" d=" M 96.25 120.22 C 110.20 116.53 125.47 127.57 126.66 141.87 C 128.44 154.97 118.05 168.07 104.92 169.41 C 92.56 171.30 79.90 162.34 77.36 150.14 C 73.99 137.18 83.19 122.86 96.25 120.22 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 210.47 126.53 C 212.46 125.06 215.40 125.10 217.35 126.64 C 230.60 137.33 231.15 160.01 217.98 170.98 C 213.91 173.69 207.98 169.69 208.57 164.95 C 208.71 162.76 210.44 161.23 211.57 159.50 C 215.73 154.14 216.03 146.20 212.62 140.39 C 211.30 138.07 209.03 136.43 207.86 134.02 C 206.68 131.28 208.05 128.09 210.47 126.53 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 33.16 141.66 C 41.59 141.60 50.02 141.67 58.45 141.63 C 58.43 143.93 58.44 146.22 58.45 148.52 C 50.01 148.45 41.57 148.57 33.12 148.46 C 33.19 146.19 33.21 143.93 33.16 141.66 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 144.21 141.66 C 152.64 141.61 161.07 141.67 169.50 141.63 C 169.48 143.92 169.48 146.21 169.51 148.51 C 161.07 148.47 152.62 148.56 144.18 148.46 C 144.24 146.19 144.25 143.92 144.21 141.66 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 54.33 186.87 C 59.22 182.05 64.07 177.20 68.91 172.33 C 70.49 174.09 72.17 175.77 73.94 177.35 C 69.16 182.26 64.28 187.08 59.39 191.88 C 57.78 190.14 56.08 188.48 54.33 186.87 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 129.57 177.39 C 131.30 175.72 133.04 174.05 134.76 172.37 C 139.39 177.35 144.28 182.07 149.14 186.83 C 147.36 188.49 145.64 190.22 143.98 192.00 C 139.29 187.02 134.27 182.36 129.57 177.39 Z" />
<path fill="#f7f7f7" stroke="#f7f7f7" stroke-width="0.09375" opacity="1.00" d=" M 97.79 187.86 C 100.03 187.86 102.28 187.82 104.52 187.71 C 104.95 196.21 104.53 204.73 104.73 213.24 C 102.42 213.24 100.10 213.24 97.79 213.24 C 97.82 204.78 97.82 196.32 97.79 187.86 Z" />
</svg>
  
  
    <h1>Weather<orange>34</orange> MB SMART Quick updater </h1>
    <label for="zipfile">
    Select mb-smart-updater.zip if no mb-smart-updater.zip found or not automaticlly found check you have uploaded mb-smart-updater.zip to this directory on your/this server.*note a bonus if you have a backup zip it will automatically locate it .i.e MB-SMART-20191015.zip </label>
    <select name="zipfile" size="1" class="choose" value="mb-smart-updater.zip">
      <?php foreach ($unzipper->zipfiles as $zip) {
        echo "<option>$zip</option>";
      }
      ?>
    </select>
    <label for="extpath">
    <svg id="i-info" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
    <path d="M16 14 L16 23 M16 8 L16 10" />    <circle cx="16" cy="16" r="14" /></svg>  MB SMART Update path (<blue>leave blank</blue>):</label>
    <input type="text" name="extpath" class="form-field" />
    <p class="info">* Please leave blank it will then extract and update files in the current template directory only  </p>
    <input type="submit" name="dounzip" class="submit" value="Update MB-SMART Version"/>
  </fieldset>
  
  <fieldset>  
    <h1>Weather<orange>34</orange> MB SMART Back up </h1>
    <label for="zippath">
    <svg id="i-info" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
    <path d="M16 14 L16 23 M16 8 L16 10" />    <circle cx="16" cy="16" r="14" /></svg> 
    This will backup all folders and files contained in the MB-SMART directory (<blue>or whatever you may have called it</blue>):</label>
    <input type="text" name="zippath" class="form-field" />
    <p class="info">* Please leave empty the current template directory will be used and a backup zip will be created of this template installed on your server.</p>
    <input type="submit" name="dozip" class="submit" value="Back up current MB SMART installation"/>
  </fieldset>
</form>
<p class="version"><a href="https://weather34.com/homeweatherstation/" title="https://weather34.com/homeweatherstation/" target="_blank">Weather<orange>34</orange></a> MB-SMART Updater/Backup Version: <blue><?php echo VERSION; ?></blue></p>
</body>
</html>