<?php include_once('livedata.php');?>
<div class="topframe">
  <div class="mbtype2" ><weather34menumarkerblue></weather34menumarkerblue> NanoSD:<blue><?php echo $weather["mbplatform"]," ",$weather["swversion"]?></blue></div>
  <?php //meteobridge and station hardware 
$nanosduptime = $meteobridgeapi[81];function convert($nanosduptime){$weather34nanotimeago = "";$days1 = intval(intval($nanosduptime) / (3600*24));$hours1 = (intval($nanosduptime) / 3600) % 24;$minutes1 = (intval($nanosduptime) / 60) % 60;$seconds1 = (intval($nanosduptime)) % 60;if($days1> 1){$weather34nanotimeago .= "$days1 Days ";}else {if($days1>0){$weather34nanotimeago .= "$days1 Day ";}if($hours1 > 1){$weather34nanotimeago .= "$hours1 hrs ";}else if($hours1 >=0){$weather34nanotimeago .= "$hours1 hr ";}if($minutes1 > 1){$weather34nanotimeago .= "$minutes1 mins ";}else if($minutes1 >=0){$weather34nanotimeago .= "$minutes1 min ";}}return $weather34nanotimeago;}?>
  <div class="nanouptime2" ><weather34menumarkerblue></weather34menumarkerblue> NanoSD Uptime:<oblue> <?php echo convert($nanosduptime)?></oblue></div>  
  <div class="hardware2"><weather34menumarkerblue></weather34menumarkerblue> Station:<blue>Davis Vantage Pro2</blue></div>
  <div class="hardwareinfo2"><weather34menumarkerblue></weather34menumarkerblue> Station Uptime:<blue><?php echo"<oblue>", $davisvp2install->diff($now)->days;echo "</oblue> Days";?></blue></div>  
  <div class="davisimg2"><img src=img/weather34-davis-vp2.svg width="90rem" alt="Davis Vantage Pro2" title="Davis Vantage Pro2"/></div>  
  </div>