<?php include_once('livedata.php');include_once('common.php');
	####################################################################################################
    #	CREATED FOR HOMEWEATHERSTATION MB SMART TEMPLATE 											   #
    # https://weather34.com/homeweatherstation/index.html 											   #
    # 	                                                                                               #
    # 	Release: September 2019						  	                                      		   #
    # 	                                                                                               #
    #   https://www.weather34.com 	                                                                   #
    ####################################################################################################
?>

<div class="nanoimg">
<?php if ($mbplatform== "Nano" || $mbplatform== "NanoSD"){echo '<img src=img/nano.svg width="50rem">';}if ($mbplatform=="Pro"){echo '<img src=img/MeteobridgePRO.svg width="70rem">';}?>
</div>

<div class="nanoinfo">
<div class=hardwareimg1>
  <a href="https://www.meteobridge.com/wiki/index.php/Home" alt="https://www.meteobridge.com/wiki/index.php/Home" title="https://www.meteobridge.com/wiki/index.php/Home" class=hardwareimg1>Meteobridge</a> </div>

  <div class=mbtype><weather34menumarkerblue></weather34menumarkerblue>&nbsp;<?php echo $mbplatform?>: <?php echo $weather["mbplatform"]?></div>
  <div class=mbfirmware><weather34menumarkerorange></weather34menumarkerorange>&nbsp;Firmware Rev:<oblue><?php echo $weather["swversion"];echo "-",$weather["build"]?><oblue></div>
<?php //meteobridge device uptime
$nanosduptime = $meteobridgeapi[81];function convert($nanosduptime){$weather34nanotimeago = ""; $days1 = intval(intval($nanosduptime) / (3600*24));
    $hours1 = (intval($nanosduptime) / 3600) % 24;$minutes1 = (intval($nanosduptime) / 60) % 60;$seconds1 = (intval($nanosduptime)) % 60;
		if ($days1> 1) {$weather34nanotimeago .= "$days1 Days ";} 
		else {if ($days1>0) {$weather34nanotimeago .= "$days1 Day ";}
        if ($hours1 > 1) {$weather34nanotimeago .= "$hours1 hrs ";} 
		else if ($hours1 >=0) {$weather34nanotimeago .= "$hours1 hr ";}
        if ($minutes1 > 1) {$weather34nanotimeago .= "$minutes1 mins ";} 
		else if ($minutes1 >=0) {$weather34nanotimeago .= "$minutes1 min ";}}
		return $weather34nanotimeago;}?>
  <div class=nanouptime><weather34menumarkerred></weather34menumarkerred>&nbsp;<?php echo $lang['Interface Uptime']?>:<oblue> <?php echo convert($nanosduptime)?></oblue></div></div>
  <br /><br /><br /><br /> 
  <div class="davisimg">
  <?php  
  if ($weatherhardware=='Davis Vantage Pro2+'){echo ' 
  <img src=img/weather34-davis-vp2.svg width="90rem" alt="Davis Vantage Pro2" title="Davis Vantage Pro2"/>';}  
  else if ($weatherhardware=='Davis Vantage Pro2'){echo ' 
  <img src=img/weather34-davis-vp2.svg width="90rem" alt="Davis Vantage Pro2" title="Davis Vantage Pro2"/>';}  
  else if ($weatherhardware=='Davis Vantage Vue' ){echo ' 
  <img src=img/davisvue.svg width="90rem" alt="Davis Vantage Vue" title="Davis Vantage Vue" style="margin-top:5px;"/>';}  
  else if ($weatherhardware=='Davis Envoy8x' ){echo ' 
  <img src=img/designedfordavisenvoy8x.svg width="85rem" alt="Davis Envoy8x" title="Davis Envoy8x" style="margin-top:5px;"/>';}
  ?>
  
  
  </div>
  <div class=hardwareimg2>
  <a href="https://www.davisinstruments.com/solution/vantage-pro2/" title="https://www.davisinstruments.com/solution/vantage-pro2/" target="_blank" class=hardwareimg2>
  <?php echo $lang['Weather Station'];?></a></div>


  
  <div class=hardware><weather34menumarkerblue></weather34menumarkerblue>&nbsp;<?php echo $weatherhardware;?></div>
  <div class=hardwareinfo><weather34menumarkerorange></weather34menumarkerorange>&nbsp;<?php echo $lang['Installed']?>: <?php echo $hardwareinstalled;?></div>
  <div class=hardwareuptime><weather34menumarkerred></weather34menumarkerred>&nbsp;<?php echo $lang['Battery']?>:
  <?php if($weather['indoorbattery']==0){ echo "<blue>OK</blue>";}else echo "<red>Replace";?> ISS:
  <?php if($weather['outdoorbattery']==0){ echo "<blue>OK</blue>";}else echo "<red>Replace</red>";?></div>