<?php 
include_once('livedata.php');
include_once('updater2.php');
include_once('common.php');
include_once('console-settings.php');
?>
<!DOCTYPE html><html><head>
<title><?php echo $stationName; ?></title>
<meta name="title" content="<?php echo $stationName; ?>">
<meta name="description" content="<?php echo $stationName; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=yes">
<meta name="mobile-web-app-capable" content="yes">
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#01a4b4">
<meta name="apple-mobile-web-app-title" content="Weather34 Console">
<meta name="application-name" content="Weather34 Console">
<link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="msapplication-TileColor" content="#f8f8f8">
<link href="console-<?php echo $theme1?>.css?version=<?php echo filemtime('console-'.$theme1.'.css')?>" rel="stylesheet prefetch">
<link rel="preload" href="fonts/clock3-webfont.woff" as="font" type="font/woff" crossorigin>
<link rel="preload" href="fonts/verbatim-regular.woff" as="font" type="font/woff" crossorigin>
<link rel="preload" href="fonts/verbatim-medium.woff" as="font" type="font/woff" crossorigin>
<link rel="preload" href="fonts/HelveticaNeue-Medium.woff" as="font" type="font/woff" crossorigin>
</head>
<body>
<!-- weather34 NANOSD console flex layout -->
<div class="container">
  <ul class="grid-container">
    <li><div id=temperature></div></li>
    <li><div id=humidity></div></li>
    <li><div id=dewpoint></div></li>
    <li><div id=wind></div></li>
    <li><div id=direction></div></li>
    <li><div id=gust></div></li>
    <li><div id=rain></div></li>
    <li><div id=barometer></div></li>
    <li><div id=uvindex></div></li>    
  </ul>
  <a href="console-setup.php" target="_blank" class="consolesetup"> <?php echo $settingsicon?> Web App Setup</a>
  <a href="console-setup.php" target="_blank" class="designedby"> <?php echo $info?> Weather<blue>34</blue> Designed</a>
  <a href="https://weather34.com/homeweatherstation" class="credit34" target="_blank" alt="https://weather34.com/homeweatherstation" title="https://weather34.com/homeweatherstation">
  <?php echo "2015-"; ?><?php echo date('Y'); ?> &copy;WEATHER<blue>34</blue> Davis Alternative Console</a>
</div>  
</body>
</html>