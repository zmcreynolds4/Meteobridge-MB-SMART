
<?php
####################################################################################################
#     MB-SMART TEMPLATE by BRIAN UNDERDOWN 2015-19                                                 #
#     CREATED FOR HOMEWEATHERSTATION TEMPLATE at                                                   #
#     https://weather34.com/homeweatherstation/index.html                                          #
#     WEATHER34 MENU MB-SMART November 2019                                                        #
#     https://www.weather34.com                                                                    #
####################################################################################################
?>

<div class="weather34admin"><header class="weather34admin__header">
<div class="weather34topbarmail">
<a href="bio.php" data-lity title="Contact WEATHERSTATION Info"><svg version="1.1" id="email icon weather34" width="24" height="24"  x="0px" y="0px" viewBox="0 0 419.284 419.284" stroke-width="1"><g>
	<g><path fill="whitesmoke" stroke="whitesmoke" stroke-width="1" opacity="0.5" d="M363.284,126.616h-199.28c-6.352-45.063-48.032-76.444-93.095-70.092s-76.444,48.032-70.092,93.095
c4.303,30.527,25.287,56.099,54.387,66.278v91.68c0,27.04,14.72,56,56,56h252.08c27.04,0,56-14.72,56-56v-125.04 C419.204,141.256,390.324,126.616,363.284,126.616z M165.044,138.456h198.24c9.825-0.036,19.446,2.8,27.68,8.16l-153.76,99.6 l-36.4-24c-0.643-0.586-1.408-1.023-2.24-1.28l-50.64-32.8C158.931,173.906,164.947,156.447,165.044,138.456z M12.004,138.136
c0-38.881,31.519-70.4,70.4-70.4c38.881,0,70.4,31.519,70.4,70.4s-31.519,70.4-70.4,70.4 C43.541,208.492,12.048,176.999,12.004,138.136z M67.284,307.576h-0.08v-88.4c26.266,5.051,53.34-3.077,72.48-21.76l47.2,30.56 l-107.76,112C71.237,331.053,67.009,319.482,67.284,307.576z M362.564,351.736l-251.44-0.24c-7.604,0.192-15.152-1.34-22.08-4.48 l108.08-112l36.72,24h0.4c0.795,0.401,1.67,0.619,2.56,0.64c0.89-0.021,1.765-0.239,2.56-0.64h0.4l36.96-24l108,112 C377.759,350.153,370.203,351.763,362.564,351.736z M395.444,339.576l-107.76-112l112-72.56c5.268,8.093,7.869,17.633,7.44,27.28 v125.28C407.845,319.403,403.614,330.996,395.444,339.576z"/></g></g><g><g><path fill="#2f9dac" stroke="#aeb6bf" stroke-width="1" d="M132.241,108.322c-0.077-0.091-0.156-0.179-0.237-0.265c-2.205-2.474-5.997-2.692-8.471-0.488 c-0.003,0.003-0.006,0.005-0.009,0.008l-53.92,48l-27.28-38.64c-1.922-2.717-5.683-3.362-8.4-1.44 c-2.717,1.922-3.362,5.683-1.44,8.4l31.12,44.16c0.995,1.394,2.538,2.296,4.24,2.48h0.72c1.475,0.002,2.899-0.539,4-1.52 l58.96-52.24C134.057,114.64,134.378,110.854,132.241,108.322z"/></g></svg></a>
&nbsp;&nbsp;&nbsp;
<?php //metric/non-metric/uk
if ($units!='us') {
    echo '<a  href="./?units=us"> <metricgrey>US</metricgrey> <topbarimperialf>&deg;F</topbarimperialf>&nbsp;&nbsp;</a> ';
}
if ($units!='metric') {
    echo '<a  href="./?units=metric"> <metricgrey>KM/H</metricgrey> <topbarmetricc>&deg;C</topbarmetricc>&nbsp;&nbsp;</a>';
}
if ($units!='uk') {
    echo '<a  href="./?units=uk">  <metricgrey>UK</metricgrey> <topbarmetricc>&deg;C</topbarmetricc>&nbsp;&nbsp;</a>';
}
?>
</div>
<weather34toptitle><?php echo $stationName; ?>&nbsp;Weather Station</weather34toptitle>
<div class="weather34toolbar">
<div class="weather34toolbar__right"><weather34thetime><?php echo $menuclocksvg; ?>&nbsp; <div id="theTime"></weather34thetime></div></div>
<div class="weather34-theme-switch-wrapper"><div class="weather34-theme-switch">
<a class="weather34-slider round" href=<?php if ($theme == 'dark') {
    echo '?theme=light';
} else {
    echo '?theme=dark';
}?>><?php if ($theme == 'dark') {
    echo ' Light Mode';
} else {
    echo ' &nbsp;Dark Mode';
}?> </a></div></div></div></div></div>
<!-- start the weather34 pure css menu-->
<nav>
 <!-- weather34 dot menu svg-->
<a href="#" class="iconcolor">
<svg id="weather34 dot menu" width="23pt" viewBox="0 0 720.000000 560.000000" preserveAspectRatio="xMidYMid meet">
<g transform="translate(0.000000,560.000000) scale(0.100000,-0.100000)" fill="currentcolor" stroke="none">
<path d="M485 5341 c-255 -73 -435 -312 -435 -576 0 -268 182 -504 445 -581
80 -23 230 -23 310 0 314 91 500 398 431 709 -50 222 -216 396 -432 451 -83
21 -241 20 -319 -3z"/><path d="M2445 5341 c-98 -28 -184 -80 -260 -157 -282 -282 -207 -763 146
-949 93 -49 176 -68 289 -68 229 2 436 133 531 338 44 96 59 161 59 260 0 102
-15 166 -62 265 -73 153 -217 271 -384 314 -83 21 -241 20 -319 -3z"/>
<path d="M4405 5341 c-294 -84 -483 -395 -421 -691 60 -285 298 -482 586 -483
173 -1 301 52 425 177 122 123 175 250 175 421 0 169 -57 305 -179 425 -82 82
-160 127 -266 155 -80 20 -242 19 -320 -4z"/><path d="M6365 5341 c-294 -84 -483 -395 -421 -691 60 -285 298 -482 586 -483
173 -1 301 52 425 177 122 123 175 250 175 421 0 169 -57 305 -179 425 -82 82
-160 127 -266 155 -80 20 -242 19 -320 -4z"/><path d="M493 3380 c-172 -45 -306 -155 -383 -315 -46 -96 -60 -159 -60 -268
0 -101 19 -179 66 -273 176 -352 654 -432 943 -159 77 73 122 144 158 247 36
101 38 260 6 363 -31 99 -87 187 -165 260 -150 142 -365 197 -565 145z"/>
<path d="M2453 3380 c-264 -69 -443 -303 -443 -579 0 -204 96 -387 263 -498
111 -74 195 -98 342 -97 134 0 201 19 311 85 166 100 284 312 284 509 0 224
-141 446 -341 539 -136 64 -277 78 -416 41z"/><path d="M4430 3384 c-254 -55 -445 -285 -457 -554 -23 -467 456 -773 877
-560 237 119 367 412 301 672 -48 185 -158 320 -326 399 -127 59 -256 73 -395
43z"/><path d="M6390 3384 c-254 -55 -445 -285 -457 -554 -23 -467 456 -773 877
-560 237 119 367 412 301 672 -48 185 -158 320 -326 399 -127 59 -256 73 -395
43z"/><path d="M559 1430 c-237 -37 -434 -214 -493 -446 -20 -79 -20 -219 0 -297 54
-208 223 -378 431 -432 73 -19 232 -19 303 0 292 77 486 371 441 665 -45 288
-264 490 -556 513 -38 3 -95 1 -126 -3z"/><path d="M2520 1430 c-136 -22 -255 -85 -349 -186 -105 -112 -161 -251 -161
-406 0 -105 15 -168 62 -268 73 -152 218 -272 385 -315 73 -19 232 -19 303 0
276 73 467 338 446 621 -11 153 -68 278 -175 384 -134 132 -332 198 -511 170z"/>
<path d="M4480 1430 c-290 -45 -510 -299 -510 -591 0 -94 29 -210 72 -292 70
-132 225 -253 374 -291 78 -20 231 -21 304 -1 264 70 450 310 450 580 0 195
-107 394 -267 501 -113 75 -290 114 -423 94z"/><path d="M6440 1430 c-290 -45 -510 -299 -510 -591 0 -94 29 -210 72 -292 70
-132 225 -253 374 -291 78 -20 231 -21 304 -1 264 70 450 310 450 580 0 195
-107 394 -267 501 -113 75 -290 114 -423 94z"/></g></svg>

</div></a>
<ul><br>

<!-- menu options-->
<div class="weather34themenuicon2">
    <svg id="weather34 options icon" width="24" height="24" viewBox="0 0 24 24">
    <path fill="currentcolor" d="M4 11h5V5H4v6zm0 7h5v-6H4v6zm6 0h5v-6h-5v6zm6 0h5v-6h-5v6zm-6-7h5V5h-5v6zm6-6v6h5V5h-5z"/>
    <path d="M0 0h24v24H0z" fill="none"/></svg><weather34themenu><?php echo $lang['Menu Options']; ?></weather34themenu></div>
<div class=weather34thinborder></div>

<!--tools-->
<li><a href="#"><weather34themenusection> TOOLS</weather34themenusection></a></li>
<li><a href="mb-smart-setup.php" target="_blank" title="Weather34 MB SMART Setup Screen"><?php echo " <weather34menumarkerdot></weather34menumarkerdot> ", $lang['Settings']; ?>
<?php if ($password == "") {
    echo ' <svg id="weather34 unlocked"  viewBox="0 0 32 32"  width="12" height="12" fill="none" stroke="#f16b4f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 15 L5 30 27 30 27 15 Z M9 15 C9 7 9 3 16 3 23 3 23 8 23 9 M16 20 L16 23" /><circle cx="16" cy="24" r="1" /></svg> <menuinfobox>Password Not Set</menuinfobox>';
} else {
    echo ' <svg id="weather34 locked" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="#06a2b1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 15 L5 30 27 30 27 15 Z M9 15 C9 9 9 5 16 5 23 5 23 9 23 15 M16 20 L16 23" /><circle cx="16" cy="24" r="1" /></svg> <menuinfobox>Locked</menuinfobox>';
}?> </a></li>
<div class=weather34thinborder></div>

<!-- theme-->
<li><a href="#"><weather34themenusection><?php echo $smalldots ?> UI THEME</weather34themenusection></a></li>
<li><a href=<?php if ($theme == 'dark') {
    echo '?theme=light';
} else {
    echo '?theme=dark';
}?>>
<?php //theme
if ($theme == 'dark') {
    echo ' <weather34menumarkerdotmode></weather34menumarkerdotmode> Light <menuinfobox>Mode</menuinfobox>';
} else {
    echo '<weather34menumarkerdot></weather34menumarkerdot> Dark <menuinfobox>Mode</menuinfobox>';
}?></a></li>
</a></li>
<li><a href="console/consoledavis.php"><weather34menumarkerdot></weather34menumarkerdot> 
Alternative <menuinfobox>Layout</menuinfobox></a></li> 
<div class=weather34thinborder></div>
<li><a href="#"><weather34themenusection> UNITS</weather34themenusection></a></li>
<!-- units -->
<?php
  if ($units!='us') {
      echo '<li> <a  href="./?units=us"> <weather34menumarkerdot></weather34menumarkerdot>  Imperial  <menuinfobox>MPH</menuinfobox> 
  <menuinfobox>&deg;F</menuinfobox> </a>';
  }
  if ($units!='metric') {
      echo '<li> <a  href="./?units=metric"> <weather34menumarkerdot></weather34menumarkerdot> Metric <menuinfobox>KM/H</menuinfobox> <menuinfobox>&deg;C</menuinfobox></a>';
  }
  if ($units!='uk') {
      echo '<li> <a  href="./?units=uk">  <weather34menumarkerdot></weather34menumarkerdot> UK <menuinfobox>MPH</menuinfobox>  
  <menuinfobox>&deg;C</menuinfobox></a>';
  }
  if ($units!='scandinavia') {
      echo '<li> <a  href="./?units=scandinavia"> <weather34menumarkerdot></weather34menumarkerdot> Scandinavia <menuinfobox>M/S</menuinfobox> <menuinfobox>&deg;C</menuinfobox></a>';
  }
?>
</li>
<div class=weather34thinborder></div>

<li><a href="#"><weather34themenusection><?php echo $smalldots ?> EXTRAS</weather34themenusection></a></li>
<!--webcam--->
<?php if ($webcamurl == '') {
    ;
} else {
    echo '<li> <a href="cam.php" data-lity title="WEATHERSTATION WEBCAM"> <weather34menumarkerdot></weather34menumarkerdot> Web Cam <menuinfobox>Stream</menuinfobox></a></li>';
}
?>
<li><!--contact info---> <a href="bio.php" data-lity title="Weather Station Owner Contact Card Info"> <weather34menumarkerdot></weather34menumarkerdot> Contact <menuinfobox>Info</menuinfobox> </a></li>
<li><!--hardware info---> <a href="stationinfo.php" data-lity title="Hardware Weather Station Hardware Info"> <weather34menumarkerdot></weather34menumarkerdot> Hardware <menuinfobox>Info</menuinfobox></a></li>

<!---languages--->
   <?php if ($languages == "yes") {
    echo '
   <div class=weather34thinborder></div>
   <li><a href="">
   <weather34themenusection>' . $lang["language"], '</weather34themenusection>  </a></li>', '
  <center>
  <a href="index.php?lang=en"><img src="img/flags/en.svg"  title="English" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=dk"><img src="img/flags/dk.svg"  title="Danish" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=dl"><img src="img/flags/dl.svg"  title="German" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=nl"><img src="img/flags/nl.svg"  title="Dutch" width="20px" height="20px"></a>&nbsp;<br>
  <a href="index.php?lang=fr"><img src="img/flags/fr.svg"  title="French" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=it"><img src="img/flags/it.svg"  title="Italian" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=sp"><img src="img/flags/sp.svg"  title="Spanish" width="20px" height="20px"></a>&nbsp;
  <a href="index.php?lang=sw"><img src="img/flags/sw.svg"  title="Swedish" width="20px" height="20px"></a>&nbsp;
   ';
}?></center>

 <div class=weather34thinborder></div> </div>
 <!---credits | download info please do not remove credits if so no support is given it is not much to ask--->
<li><a href="#"><weather34themenusection><?php echo $smalldots ?> CREDITS & INFO</weather34themenusection></a></li>
<?php  //suppliers
if ($suppliers =='Weather Spares') {
    echo '<li><a href="https://weatherspares.co.uk" title="https://weatherspares.co.uk" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>UK</menuinfobox>';
}
if ($suppliers =='Prodata Weather Systems') {
    echo '<li><a href="https://shop.weatherstations.co.uk" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>UK</menuinfobox>';
}
if ($suppliers =='Weerspecialist') {
    echo '<li><a href="https://www.weerstationkopen.nl" title="https://www.weerstationkopen.nl" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>Netherlands</menuinfobox>';
}
if ($suppliers =='Weerhuisje') {
    echo '<li><a href="https://weerhuisje.nl" title="https://weerhuisje.nl" target="_blank"> <weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>Netherlands</menuinfobox>';
}
if ($suppliers =='Soluzionimeteo') {
    echo '<li><a href="https://www.soluzionimeteo.it/content/category/1-home" title="https://www.soluzionimeteo.it/content/category/1-home" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>Italy</menuinfobox>';
}
if ($suppliers =='Scaled Instruments') {
    echo '<li><a href="https://www.scaledinstruments.com" title="https://www.scaledinstruments.com" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>USA</menuinfobox>';
}
if ($suppliers =='Ambient Weather') {
    echo '<li><a href="https://www.ambientweather.com" title="https://www.ambientweather.com" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> '.$suppliers.' <menuinfobox>USA</menuinfobox>';
}
if ($suppliers =='None') {
    echo '';
}?></a></li> 

<li><!--hardware info---> <a href="licence.php" data-lity title="Weather34 MB-SMART Licence Info and Download"> <weather34menumarkerdot></weather34menumarkerdot> Download MB-SMART <menuinfobox><?php echo $mbsmartversion ?></menuinfobox></a></li>
<li><!--hardware info---> <a href="meteocloud.php" data-lity title="View the Meteocloud Network"> <weather34menumarkerdot></weather34menumarkerdot> Meteocloud <menuinfobox>Network</menuinfobox></a></li>

<li><a href="https://weather34.com/homeweatherstation/meteobridge-mb-smart.html" data-title="Weather34 MB-Smart Version" target="_blank"><weather34menumarkerdot></weather34menumarkerdot> Weather34 Designed <menuinfobox>&copy;2015-<?php echo date('Y'); ?></menuinfobox></a></li>
</div></div>
<div class=weather34thinborder></div>
<div class="closethenav" > CLOSE &nbsp; 
<svg fill="currentcolor" x="0px" y="0px" viewBox="0 0 1000 1000" width="16pt" height="16pt">
<g><path d="M700.9,816.7H124.3V69.2h578.6v400.1h57V10H67.2v864.2h633.7V816.7L700.9,816.7z M413.8,643v-56.6H240.7V643H413.8z M586.2,413.1H240.7v58.8h345.5V413.1z M586.2,239.9H240.7v58.8h345.5V239.9z M874.4,532.7l57.7,54c0-204.4,0-404,0-404H816.7V241h57.7C874.4,241,874.4,373.4,874.4,532.7z M874.6,931H296.2v59h635.9c0,0,0-84.4,0-198.7l-57.5,49.4C874.6,915.2,874.6,931,874.6,931z M471.5,644.5v56.6h370.7l-82.3,84.4l31.1,32l141.7-144.3L791.3,528.1l-31.6,32.5l82,84.2H471.5V644.5z"/></g>
</svg><div> 
</ul>
</nav>
</header>