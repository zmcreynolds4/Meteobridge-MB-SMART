<?php error_reporting(0);
// Speed
function ktsTokmh(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(1.852*$weather[$field],1);
}

function ktsTomph(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(1.150779*$weather[$field],1);
}

function ktsToms(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.514444*$weather[$field],1);
}

function mphTokmh(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(1.609344*$weather[$field],1);
}

function mphTokts(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.868976*$weather[$field],1);
}

function mphToms(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.44704*$weather[$field],1);
}

function kmhTokts(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.5399568*$weather[$field],1);
}

function kmhTomph(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.621371*$weather[$field],1);
}

function kmhToms(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(0.2777778*$weather[$field],1);
}

function msTokmh(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(3.6*$weather[$field],2);
}

function msTokts(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = round((float)(1.943844*$weather[$field]), 1);
}

function msTomph(&$weather, $field){
	if(!isset($weather[$field])) return;
	$weather[$field] = number_format(2.236936*$weather[$field], 2);
}
// Temperature
function cToF(&$weather, $field){if(!isset($weather[$field])) return;$weather[$field] = cToFDirect($weather[$field]);}
function fToC(&$weather, $field){if(!isset($weather[$field])) return;$weather[$field] = fToCDirect($weather[$field]);}
function cToFrel(&$weather, $field){if(!isset($weather[$field])) return;	$weather[$field] = round((float)(1.8*$weather[$field]), 1);}
function fToCrel(&$weather, $field){if(!isset($weather[$field])) return;$weather[$field] = round((float)(0.55555556*($weather[$field])), 1);}
function fToCDirect($field){return round((float)(0.55555556*($field - 32)), 1);}
function cToFDirect($field){return  number_format((float)$field*1.8 +32,1);}
// Pressure
function mbToin(&$weather, $field){if(!isset($weather[$field])) return;	$weather[$field] = round((float)(0.02952999*$weather[$field]), 3);}
function inTomb(&$weather, $field){	if(!isset($weather[$field])) return;$weather[$field] = round((float)(33.86388158*$weather[$field]), 2);}
// Depth
function mmToin(&$weather, $field){if(!isset($weather[$field])) return;$weather[$field] = number_format(0.03937008*$weather[$field], 2);}
function inTomm(&$weather, $field){if(!isset($weather[$field])) return;	$weather[$field] =number_format(25.4*$weather[$field], 1);}
// Calculates "real feel" heat index valid only at lower temperatures (up to 79 F)
function heatIndexLow($t, $rh) {return 0.5 * ($t + 61.0 + (($t - 68.0) * 1.2) + ($rh * 0.094));}
// Calculates "real feel" heat index valid only at higher temperatures (beginning around 79-80 F), the traditional heat index formula
function heatIndexHigh($t, $rh) {$heatIndex = -42.379 + 2.04901523 * $t + 10.1433127*$rh - .22475441*$t*$rh - .00683783 *$t * $t - .05481717 * $rh * $rh + .00122874*$t*$t*$rh + .00085282 *$t * $rh *$rh - .00000199 *$t *$t *$rh * $rh;$a = 0;if ($rh < 13 && ($t >= 80 && $t <= 112)) {$a=((13 - $rh ) / 4) * sqrt((17-abs($t - 95))/17);$a = -$a;};if ($rh > 85 && ($t >= 80 && $t <= 87)) {$a=(($rh - 85)/10) * ((87 - $t) / 5);};$heatIndex += $a;return $heatIndex;}
// Ruthfusz heat index formula
// http://www.wpc.ncep.noaa.gov/html/heatindex_equation.shtml
function heatIndex($temp, $rh) {global $weather;$t = anyToF($temp);
// First try simple formula, valid when calculated heat index <= 79 degrees F
$heatIndex = heatIndexLow($t, $rh);
// If too warm, do the complicated formula instead
if ($heatIndex >= 79){$heatIndex = heatIndexHigh($t, $rh);}$weather["temp_units"]='C';if ($weather["temp_units"] == 'C'){$heatIndex = fToCDirect($heatIndex);}return round($heatIndex, 1);}

function anyToC($field){global $weather;if ($weather["temp_units"] == 'C'){	return $field;} else {return fToCDirect($field);}}
function anyToF($field){return cToFDirect ($field);	}
// Great circle calculation uses the radius of earth, 6371 km
function distance($lat, $lon, $lati, $longi) {$lat1 = deg2rad($lati);$lat2 = deg2rad($lat);$long1 = deg2rad($longi);$long2 = deg2rad($lon);
return 6371 * acos(sin($lat1)*sin($lat2) + cos($lat1)*cos($lat2)*cos($long2-$long1));}
?>
<?php 
$info='<svg  viewBox="0 0 32 32" width=10 height=10 fill=none stroke=silver stroke-linecap=round stroke-linejoin=round stroke-width=6.25%><path d="M16 14 L16 23 M16 8 L16 10" /><circle cx=16 cy=16 r=14 /></svg> ';
$fallingsymbol='<svg id="falling" width="16" height="16" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 18 23 18 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$risingsymbol='<svg id="rising" width="16" height="16" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 6 23 6 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$tempfallingsymbol='<svg id="falling temp" width="16" height="16" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 18 23 18 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$temprisingsymbol='<svg id="rising temp" width="16" height="16" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 6 23 6 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$fallingsymbolsmall='<svg id="falling temp" width="10" height="10" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 18 23 18 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$risingsymbolsmall='<svg id="rising temp" width="10" height="10" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 6 23 6 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$steadysymbol='<svg id="steadybarometer" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>';
$arrowsymbol='<svg id="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>';	
$arrowsymbol='<svg id="arrow" width="16" height="16" viewBox="0 0 17 18" fill="none" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>';
$fallingsymbolx='<svg id="falling" width="14" height="14" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 18 23 18 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
$risingsymbolx='<svg id="rising" width="14" height="14" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline points="17 6 23 6 23 12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>';
//weather34 beaufort
$beaufort0='<svg id="weather34 bft0 calm" width="14pt" height="14pt" viewBox="0 0 96 96" ><path fill="#aaa" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 42.39 20.62 C 51.40 18.80 61.26 21.58 67.72 28.18 C 72.37 33.32 76.08 39.84 76.03 46.95 C 76.90 61.75 63.98 75.82 49.07 75.88 C 34.47 76.94 20.93 64.49 20.01 50.07 C 18.76 36.54 29.04 23.08 42.39 20.62 M 42.50 28.79 C 33.81 31.19 27.33 40.09 27.98 49.12 C 28.45 59.28 37.72 68.28 48.01 67.94 C 57.97 68.25 66.94 59.86 67.96 50.09 C 68.99 41.50 63.52 32.72 55.56 29.51 C 51.45 27.80 46.77 27.67 42.50 28.79 Z" /><path fill="#fff" stroke="#fff" stroke-width="0.09375" opacity="1.00" d=" M 47.33 36.16 C 54.36 35.51 60.80 42.06 59.99 49.07 C 59.51 55.87 52.46 61.15 45.80 59.61 C 38.41 58.73 33.64 49.68 37.08 43.09 C 38.85 39.03 42.93 36.37 47.33 36.16 Z" /></svg>';
$beaufort1='<svg id="weather34 bft1" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#00a4b4" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 73.92 43.89 C 77.12 40.10 82.80 39.45 87.34 40.81 C 91.48 42.01 93.99 45.85 96.00 49.39 L 96.00 56.58 C 94.00 60.14 91.49 63.99 87.34 65.19 C 82.80 66.55 77.13 65.90 73.92 62.11 C 72.32 60.28 71.03 58.19 69.69 56.16 C 46.47 55.76 23.23 56.12 0.00 56.00 L 0.00 50.00 C 23.23 49.88 46.47 50.24 69.69 49.84 C 71.03 47.81 72.31 45.73 73.92 43.89 Z" /></svg>';
$beaufort2='<svg id="weather34 bft2" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#00a4b4" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 33.38 C 1.68 32.46 3.19 31.28 4.67 30.09 C 10.04 36.72 15.42 43.36 20.80 50.00 C 37.23 49.99 53.66 50.03 70.09 49.98 C 71.41 47.21 72.76 44.23 75.39 42.45 C 79.66 39.54 85.60 39.45 90.03 42.07 C 93.26 44.08 95.26 47.64 96.00 51.31 L 96.00 54.79 C 95.15 58.68 92.92 62.47 89.30 64.34 C 84.74 66.62 78.83 66.29 74.79 63.09 C 72.52 61.29 71.31 58.57 70.10 56.02 C 46.73 55.97 23.37 56.02 0.00 56.00 L 0.00 49.94 C 4.33 50.04 8.66 50.00 13.00 49.99 C 8.62 44.92 4.88 39.28 0.00 34.68 L 0.00 33.38 Z" /></svg>';
$beaufort3='<svg id="weather34 bft3" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#e6a141" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 33.44 C 1.67 32.50 3.17 31.28 4.64 30.06 C 10.04 36.70 15.41 43.36 20.80 50.00 C 37.24 49.99 53.68 50.02 70.12 49.98 C 71.39 47.19 72.76 44.24 75.38 42.46 C 79.66 39.55 85.61 39.46 90.05 42.08 C 93.25 44.09 95.22 47.60 96.00 51.23 L 96.00 54.90 C 95.16 58.48 93.20 61.96 90.01 63.95 C 85.59 66.53 79.71 66.44 75.44 63.58 C 72.79 61.80 71.39 58.83 70.12 56.02 C 52.75 55.98 35.38 56.01 18.01 56.00 C 11.92 48.94 6.53 41.24 0.00 34.58 L 0.00 33.44 Z" /></svg>';
$beaufort4='<svg id="weather34 bft4" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#e6a141" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 33.39 C 1.62 32.38 3.17 31.27 4.69 30.10 C 10.05 36.74 15.43 43.37 20.80 50.01 C 22.27 49.99 23.73 49.99 25.20 49.99 C 22.39 46.60 19.61 43.19 16.80 39.80 C 18.34 38.53 19.87 37.27 21.40 36.00 C 25.26 40.67 29.13 45.33 33.00 50.00 C 45.36 49.99 57.72 50.02 70.08 49.98 C 71.35 47.43 72.52 44.67 74.84 42.87 C 79.08 39.57 85.34 39.34 89.94 42.02 C 93.23 44.01 95.21 47.59 96.00 51.27 L 96.00 54.84 C 95.16 58.45 93.23 61.98 89.99 63.95 C 85.38 66.65 79.11 66.44 74.86 63.15 C 72.54 61.35 71.34 58.58 70.08 56.02 C 52.72 55.98 35.37 56.01 18.01 56.00 C 11.92 48.97 6.60 41.23 0.00 34.67 L 0.00 33.39 Z" /></svg>';
$beaufort5='<svg id="weather34 bft5" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#ec5a34" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 4.55 30.01 C 10.04 36.62 15.37 43.37 20.82 50.01 C 22.21 50.00 23.60 49.99 25.00 49.99 C 20.67 44.66 16.33 39.33 12.00 34.00 C 13.53 32.67 15.07 31.34 16.60 30.01 C 22.01 36.67 27.39 43.35 32.82 50.01 C 45.26 49.98 57.71 50.02 70.15 49.99 C 71.41 46.91 73.07 43.77 76.03 42.02 C 79.40 40.12 83.56 39.63 87.24 40.85 C 91.95 42.11 95.08 46.63 96.00 51.23 L 96.00 55.03 C 95.11 58.56 93.16 61.97 90.02 63.95 C 85.60 66.53 79.71 66.45 75.44 63.58 C 72.80 61.79 71.34 58.86 70.15 56.01 C 52.77 55.99 35.39 56.00 18.02 56.00 C 11.93 48.90 6.44 41.24 0.00 34.48 L 0.00 33.53 C 1.72 32.64 3.15 31.32 4.55 30.01 Z" /></svg>';
$beaufort6='<svg id="weather34 bft6" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#ec5a34" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 4.55 30.01 C 10.03 36.62 15.37 43.35 20.81 50.00 C 22.20 50.00 23.60 50.00 24.99 49.99 C 20.67 44.65 16.33 39.34 12.01 34.00 C 13.53 32.66 15.07 31.33 16.60 30.00 C 22.02 36.67 27.39 43.38 32.84 50.02 C 34.22 50.01 35.60 49.99 36.98 49.98 C 32.67 44.64 28.31 39.34 24.01 33.99 C 25.54 32.66 27.07 31.33 28.60 30.01 C 34.01 36.67 39.39 43.35 44.81 50.00 C 53.26 49.99 61.71 50.01 70.15 49.99 C 71.04 48.00 71.89 45.95 73.36 44.31 C 76.67 40.43 82.45 39.34 87.19 40.83 C 91.91 42.08 95.07 46.60 96.00 51.22 L 96.00 54.75 C 95.20 58.73 92.83 62.57 89.13 64.44 C 84.81 66.48 79.42 66.27 75.43 63.58 C 72.80 61.79 71.34 58.86 70.15 56.01 C 52.77 55.99 35.39 56.01 18.01 56.00 C 11.92 48.94 6.51 41.22 0.00 34.56 L 0.00 33.45 C 1.83 32.80 3.11 31.23 4.55 30.01 Z" /></svg>'; 
$beaufort7='<svg id="weather34 bft7" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 34.01 C 1.53 32.68 3.03 31.30 4.61 30.03 C 10.06 36.65 15.35 43.40 20.85 49.98 C 22.23 50.02 23.60 50.02 24.98 49.97 C 20.67 44.64 16.31 39.36 12.04 34.00 C 13.53 32.64 15.05 31.31 16.61 30.03 C 22.05 36.65 27.35 43.39 32.84 49.98 C 34.22 50.02 35.60 50.02 36.98 49.98 C 32.69 44.64 28.30 39.37 24.04 34.00 C 25.53 32.64 27.05 31.31 28.61 30.03 C 34.05 36.65 39.36 43.39 44.83 49.98 C 46.35 50.02 47.86 50.02 49.38 49.99 C 46.62 46.57 43.78 43.22 41.03 39.80 C 42.53 38.52 44.05 37.24 45.61 36.03 C 49.51 40.65 53.29 45.38 57.22 49.98 C 61.55 50.03 65.88 50.00 70.21 49.99 C 71.17 47.29 72.62 44.67 74.86 42.84 C 78.91 39.72 84.66 39.43 89.20 41.60 C 92.85 43.49 95.26 47.32 96.00 51.30 L 96.00 54.66 C 95.11 60.04 90.82 65.13 85.16 65.58 C 78.59 67.06 71.90 62.43 70.21 56.01 C 52.82 55.97 35.43 56.04 18.04 55.98 C 11.96 48.71 6.04 41.31 0.00 34.01 L 0.00 34.01 Z" /></svg>';
$beaufort8='<svg id="weather34 bft8" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 4.64 30.07 C 10.05 36.70 15.41 43.37 20.82 50.01 C 22.21 50.00 23.60 50.00 25.00 49.99 C 20.66 44.66 16.33 39.33 12.00 34.00 C 13.54 32.67 15.07 31.34 16.60 30.00 C 22.01 36.67 27.40 43.35 32.81 50.01 C 34.21 50.00 35.60 49.99 37.00 49.99 C 32.66 44.66 28.33 39.33 24.00 34.00 C 25.54 32.67 27.07 31.34 28.60 30.00 C 34.01 36.67 39.40 43.35 44.82 50.01 C 46.21 50.00 47.60 50.00 49.00 49.99 C 44.66 44.66 40.33 39.33 36.00 34.00 C 37.54 32.67 39.07 31.34 40.60 30.00 C 46.01 36.67 51.40 43.35 56.81 50.01 C 58.34 50.00 59.86 50.00 61.39 49.99 C 58.60 46.59 55.80 43.20 53.00 39.80 C 54.54 38.53 56.07 37.27 57.61 36.01 C 61.73 40.79 65.44 45.94 69.89 50.42 C 71.21 47.70 72.41 44.73 74.89 42.83 C 79.11 39.58 85.30 39.36 89.89 41.99 C 93.19 43.96 95.20 47.55 96.00 51.23 L 96.00 54.77 C 95.21 58.43 93.21 62.00 89.94 63.98 C 85.52 66.55 79.63 66.43 75.40 63.55 C 72.77 61.77 71.38 58.81 70.11 56.01 C 52.74 55.99 35.38 56.01 18.01 56.00 C 11.92 48.95 6.57 41.23 0.00 34.64 L 0.00 33.40 C 1.68 32.49 3.18 31.30 4.64 30.07 Z" /></svg>';
$beaufort9='<svg id="weather34 bft9" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 29.97 C 5.29 36.34 10.66 42.65 15.99 48.99 C 16.01 42.66 15.99 36.34 16.00 30.01 C 21.61 36.67 27.19 43.34 32.80 50.00 C 45.26 49.99 57.71 50.02 70.16 49.98 C 71.97 43.66 78.38 39.03 85.02 40.35 C 90.73 40.87 95.12 45.87 96.00 51.36 L 96.00 54.55 C 95.18 60.08 90.75 65.14 85.00 65.66 C 78.37 66.96 71.98 62.34 70.16 56.02 C 46.77 55.98 23.39 56.01 0.00 56.00 L 0.00 29.97 Z" /></svg>';
$beaufort10='<svg id="weather34 bft10"  width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 29.97 C 5.30 36.33 10.66 42.65 15.99 48.98 C 16.01 42.66 15.99 36.34 16.00 30.02 C 21.62 36.67 27.19 43.35 32.81 50.00 C 34.20 50.00 35.60 49.99 36.99 50.00 C 33.74 45.99 30.46 42.01 27.21 38.00 C 28.66 36.67 30.12 35.34 31.58 34.01 C 36.02 39.32 40.38 44.69 44.81 50.00 C 53.27 49.99 61.72 50.02 70.18 49.99 C 71.39 46.85 73.14 43.69 76.15 41.96 C 80.11 39.71 85.11 39.63 89.20 41.59 C 92.87 43.50 95.27 47.34 96.00 51.35 L 96.00 54.56 C 95.18 60.08 90.75 65.14 85.02 65.65 C 78.40 66.97 71.95 62.35 70.18 56.01 C 46.79 55.98 23.39 56.01 0.00 56.00 L 0.00 29.97 Z" /></svg>';
$beaufort11='<svg id="weather34 bft11" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 29.97 C 5.57 36.68 11.20 43.33 16.81 50.00 C 34.60 49.99 52.38 50.02 70.16 49.99 C 71.98 43.63 78.44 39.00 85.10 40.36 C 90.77 40.90 95.07 45.87 96.00 51.29 L 96.00 54.67 C 95.15 59.33 91.95 63.89 87.21 65.17 C 82.45 66.67 76.62 65.56 73.32 61.64 C 71.87 60.01 71.03 57.98 70.16 56.01 C 46.77 55.99 23.39 56.01 0.00 56.00 L 0.00 29.97 Z" /></svg>';
$beaufort12='<svg id="weather34 bft12" width="20pt" height="20pt" viewBox="0 0 96 96" ><path fill="#d65b4a" stroke="currentcolor" stroke-width="0.09375" opacity="1.00" d=" M 0.00 29.96 C 5.55 36.68 11.21 43.31 16.80 50.00 C 18.26 49.99 19.73 49.99 21.19 49.99 C 18.93 47.26 16.67 44.53 14.40 41.79 C 15.94 40.54 17.47 39.27 19.00 38.00 C 22.34 42.00 25.66 46.01 29.01 50.00 C 42.72 49.98 56.43 50.03 70.14 49.98 C 71.17 47.82 72.07 45.50 73.83 43.81 C 77.91 39.62 84.85 39.15 89.85 41.94 C 93.15 43.97 95.29 47.56 96.00 51.33 L 96.00 54.56 C 95.35 58.38 93.17 62.01 89.84 64.06 C 85.44 66.52 79.67 66.42 75.46 63.60 C 72.81 61.81 71.37 58.87 70.15 56.02 C 46.76 55.98 23.38 56.01 0.00 56.00 L 0.00 29.96 Z" /></svg>';
$preciprain='<svg x="0px" y="0px" width="10px" viewBox="0 0 345.13 345.13" ><g> <path style="fill:#01A4B5;" opacity=".8"  d="M264.25,301.7c-2.45,3.01-5.08,5.91-7.88,8.71c-23.14,23.14-53.47,34.72-83.8,34.72 
s-60.66-11.58-83.81-34.72c-22.86-22.86-34.71-53.2-34.71-83.84c0-21.31,5.74-42.77,17.5-61.94l21.16-34.48L172.57,0l31.67,51.62 l24.28,39.56l45.06,73.45C300.18,207.99,295.971,263.03,264.25,301.7z"/><path style="fill:#01A4B5;" d="M264.25,301.7L92.71,130.15L172.57,0l31.67,51.62l24.28,39.56l45.06,73.45 C300.18,207.99,295.971,263.03,264.25,301.7z"/></g>';
$heatindexalert8='<svg id="weather34 heatindex alert" width="7pt" height="7pt" fill="#ff552e" viewBox="0 0 20 20"><path d="M19.64 16.36L11.53 2.3A1.85 1.85 0 0 0 10 1.21 1.85 1.85 0 0 0 8.48 2.3L.36 16.36C-.48 17.81.21 19 1.88 19h16.24c1.67 0 2.36-1.19 1.52-2.64zM11 16H9v-2h2zm0-4H9V6h2z"/></svg>';
$heatindexalert8a='<svg id="weather34 heatindex wu alert3" width="7pt" height="7pt" fill="#fff" viewBox="0 0 20 20"><path d="M19.64 16.36L11.53 2.3A1.85 1.85 0 0 0 10 1.21 1.85 1.85 0 0 0 8.48 2.3L.36 16.36C-.48 17.81.21 19 1.88 19h16.24c1.67 0 2.36-1.19 1.52-2.64zM11 16H9v-2h2zm0-4H9V6h2z"/></svg>';
$rainfallalert8='<svg id="weather34 wu rainfall alert" width="8pt" height="8pt" fill="#009bab" viewBox="0 0 20 20"><path d="M19.64 16.36L11.53 2.3A1.85 1.85 0 0 0 10 1.21 1.85 1.85 0 0 0 8.48 2.3L.36 16.36C-.48 17.81.21 19 1.88 19h16.24c1.67 0 2.36-1.19 1.52-2.64zM11 16H9v-2h2zm0-4H9V6h2z"/></svg>';
$windchillalert8='<svg id="weather34 windchill alert2" width="7pt" height="7pt" fill="#009bab" viewBox="0 0 20 20"><path d="M19.64 16.36L11.53 2.3A1.85 1.85 0 0 0 10 1.21 1.85 1.85 0 0 0 8.48 2.3L.36 16.36C-.48 17.81.21 19 1.88 19h16.24c1.67 0 2.36-1.19 1.52-2.64zM11 16H9v-2h2zm0-4H9V6h2z"/></svg>';
$toggle='<svg height="18pt" viewBox="0 0 512 512" width="18pt" fill="currentcolor" ><path d="m362.667969 0h-213.335938c-82.324219 0-149.332031 66.988281-149.332031 149.332031 0 82.347657 67.007812 149.335938 149.332031 149.335938h213.335938c82.324219 0 149.332031-66.988281 149.332031-149.335938 0-82.34375-67.007812-149.332031-149.332031-149.332031zm0 0" fill="currentcolor"/>
<path d="m234.667969 149.332031c0 47.128907-38.207031 85.335938-85.335938 85.335938-47.128906 0-85.332031-38.207031-85.332031-85.335938 0-47.128906 38.203125-85.332031 85.332031-85.332031 47.128907 0 85.335938 38.203125 85.335938 85.332031zm0 0" fill="#fafafa"/></svg>';
$settingsicon='<svg height="14pt" viewBox="-3 0 512 512" width="16pt"><path d="m317.5 341.332031c1.089844-6.976562 1.621094-14.144531 1.621094-21.332031 0-7.148438-.53125-14.230469-1.597656-21.164062l35.261718-27.667969c8.277344-6.507813 10.5625-18.28125 5.3125-27.457031l-22.761718-39.421876c-5.292969-9.152343-16.660157-13.078124-26.453126-9.132812l-41.558593 16.746094c-11.347657-9.148438-23.660157-16.277344-36.691407-21.226563l-6.316406-44.371093c-1.492187-10.433594-10.558594-18.304688-21.121094-18.304688h-45.480468c-10.5625 0-19.628906 7.871094-21.121094 18.324219l-6.316406 44.394531c-13.054688 5.015625-25.492188 12.226562-36.519532 21.183594l-41.75-16.746094c-9.792968-3.925781-21.140624 0-26.433593 9.132812l-22.742188 39.421876c-5.289062 9.175781-2.984375 20.992187 5.355469 27.476562l35.222656 27.480469c-1.089844 6.976562-1.621094 14.144531-1.621094 21.332031 0 7.148438.53125 14.230469 1.597657 21.164062l-35.261719 27.667969c-8.277344 6.507813-10.558594 18.28125-5.3125 27.457031l22.742188 39.421876c5.289062 9.132812 16.660156 13.058593 26.453124 9.132812l41.558594-16.746094c11.347656 9.148438 23.65625 16.277344 36.691406 21.226563l6.316407 44.371093c1.511719 10.433594 10.578125 18.304688 21.140625 18.304688h45.480468c10.5625 0 19.628907-7.871094 21.121094-18.324219l6.316406-44.394531c13.054688-5.015625 25.492188-12.226562 36.519532-21.183594l41.75 16.746094c9.835937 3.945312 21.164062.019531 26.433594-9.132812l22.742187-39.421876c5.289063-9.175781 2.984375-20.992187-5.355469-27.476562zm-137.042969 53.335938c-41.175781 0-74.667969-33.496094-74.667969-74.667969s33.492188-74.667969 74.667969-74.667969c41.171875 0 74.664063 33.496094 74.664063 74.667969s-33.492188 74.667969-74.664063 74.667969zm0 0" fill="#00bcd4"/><path d="m483.453125 116.671875c.40625-3.304687 1.003906-6.570313 1.003906-10.003906 0-3.4375-.597656-6.699219-1.003906-10.007813l19.222656-14.546875c4.285157-3.242187 5.480469-9.175781 2.792969-13.847656l-17.257812-29.867187c-2.6875-4.648438-8.429688-6.589844-13.378907-4.5l-22.121093 9.324218c-5.398438-4.117187-11.136719-7.746094-17.472657-10.390625l-2.941406-23.488281c-.683594-5.332031-5.207031-9.34375-10.582031-9.34375h-34.496094c-5.375 0-9.921875 4.011719-10.582031 9.34375l-2.945313 23.488281c-6.335937 2.644531-12.09375 6.292969-17.472656 10.390625l-22.121094-9.324218c-4.96875-2.089844-10.710937-.171876-13.398437 4.5l-17.234375 29.867187c-2.691406 4.652344-1.496094 10.582031 2.792968 13.847656l19.222657 14.546875c-.429688 3.308594-1.023438 6.570313-1.023438 10.007813 0 3.433593.59375 6.699219 1 10.003906l-19.21875 14.550781c-4.289062 3.242188-5.484375 9.171875-2.796875 13.84375l17.257813 29.867188c2.6875 4.652344 8.429687 6.589844 13.378906 4.5l22.121094-9.34375c5.398437 4.117187 11.136719 7.746094 17.472656 10.390625l2.941406 23.488281c.683594 5.355469 5.207031 9.363281 10.582031 9.363281h34.496094c5.378906 0 9.921875-4.007812 10.582032-9.34375l2.945312-23.488281c6.335938-2.644531 12.09375-6.292969 17.472656-10.386719l22.121094 9.320313c4.96875 2.089844 10.710938.171875 13.398438-4.5l17.234374-29.867188c2.691407-4.652344 1.496094-10.582031-2.792968-13.84375zm-78.996094 32.660156c-23.574219 0-42.667969-19.09375-42.667969-42.664062 0-23.574219 19.09375-42.667969 42.667969-42.667969 23.570313 0 42.664063 19.09375 42.664063 42.667969 0 23.570312-19.09375 42.664062-42.664063 42.664062zm0 0" fill="currentcolor"/></svg>'; 
$sundownhalf='<svg  id=weather34 sunset" width=8pt height=8pt viewBox="0 0 200 120" version="1.5"><title>moon set</title><path fill="#d65b4a" opacity="1.00" d=" M 28.39 48.01 C 76.13 47.99 123.87 48.00 171.60 48.01 C 171.21 64.95 164.90 81.83 153.35 94.34 C 146.33 103.04 136.44 108.75 126.37 113.22 C 109.44 119.78 89.98 119.71 73.11 112.99 C 63.49 108.57 53.96 103.15 47.15 94.85 C 35.35 82.27 28.80 65.20 28.39 48.01 Z" /></svg>';
$sunuphalf='<svg id=weather34 sunrise" width=8pt height=8pt viewBox="0 0 200 120" version="1.5"><title>moon rise</title><path fill="#ff8841" opacity="1.00" d=" M 73.12 50.01 C 90.23 43.20 110.01 43.20 127.10 50.08 C 134.54 53.53 141.90 57.50 148.03 63.03 C 154.51 69.43 160.41 76.59 164.39 84.84 C 168.81 94.26 171.40 104.57 171.60 114.99 C 123.86 115.00 76.13 115.01 28.40 114.99 C 28.79 97.79 35.36 80.71 47.17 68.13 C 53.98 59.83 63.50 54.42 73.12 50.01 Z" /></svg>';
$sunlight="<svg version='1.1' id='weather34 daylight' x='0px' y='0px' width='30' height='30' fill='#ff793a' viewBox='0 0 1000 1000' enable-background='new 0 0 1000 1000' xml:space='preserve'>
<g><path  fill='#ff793a' d='M270.3,500c0,126.9,102.8,229.7,229.7,229.7S729.7,626.9,729.7,500c0-126.9-102.8-229.7-229.7-229.7S270.3,373.1,270.3,500z'/><path d='M500,193.8c16.8,0,30.6-13.8,30.6-30.6V40.6c0-16.8-13.8-30.6-30.6-30.6c-16.8,0-30.6,13.8-30.6,30.6v122.5C469.4,180,483.2,193.8,500,193.8z'/><path d='M500,806.3c-16.8,0-30.6,13.8-30.6,30.6v122.5c0,16.8,13.8,30.6,30.6,30.6c16.8,0,30.6-13.8,30.6-30.6V836.9C530.6,820,516.8,806.3,500,806.3z'/><path d='M959.4,469.4H836.9c-16.8,0-30.6,13.8-30.6,30.6c0,16.8,13.8,30.6,30.6,30.6h122.5c16.8,0,30.6-13.8,30.6-30.6C990,483.2,976.2,469.4,959.4,469.4z'/><path d='M193.8,500c0-16.8-13.8-30.6-30.6-30.6H40.6C23.8,469.4,10,483.2,10,500c0,16.8,13.8,30.6,30.6,30.6h122.5C180,530.6,193.8,516.8,193.8,500z'/><path d='M239.7,284.1c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2c12.3-12.3,12.3-30.6,0-42.9l-87.3-87.3c-12.3-12.3-30.6-12.3-42.9,0s-12.3,30.6,0,42.9L239.7,284.1z'/><path d='M760.3,715.9c-12.3-12.3-30.6-12.3-42.9,0s-12.3,30.6,0,42.9l87.3,87.3c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2c12.3-12.3,12.3-30.6,0-42.9L760.3,715.9z'/><path d='M738.9,291.8c7.7,0,15.3-3.1,21.4-9.2l87.3-87.3c12.3-12.3,12.3-30.6,0-42.9s-30.6-12.3-42.9,0l-88.8,87.3c-12.3,12.3-12.3,30.6,0,42.9C722,288.7,729.7,291.8,738.9,291.8z'/><path d='M239.7,715.9l-87.3,87.3c-12.3,12.3-12.3,30.6,0,42.9c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2l87.3-87.3c12.3-12.3,12.3-30.6,0-42.9C271.8,705.2,251.9,705.2,239.7,715.9z'/></g></svg>";

$sundown="<svg version='1.1' id='weather34 darkness' x='0px' y='0px' width='30' height='30' fill='#555' viewBox='0 0 1000 1000' enable-background='new 0 0 1000 1000' xml:space='preserve'>
<g><path  fill='#555' d='M270.3,500c0,126.9,102.8,229.7,229.7,229.7S729.7,626.9,729.7,500c0-126.9-102.8-229.7-229.7-229.7S270.3,373.1,270.3,500z'/>
<path d='M500,193.8c16.8,0,30.6-13.8,30.6-30.6V40.6c0-16.8-13.8-30.6-30.6-30.6c-16.8,0-30.6,13.8-30.6,30.6v122.5C469.4,180,483.2,193.8,500,193.8z'/>
<path d='M500,806.3c-16.8,0-30.6,13.8-30.6,30.6v122.5c0,16.8,13.8,30.6,30.6,30.6c16.8,0,30.6-13.8,30.6-30.6V836.9C530.6,820,516.8,806.3,500,806.3z'/>
<path d='M959.4,469.4H836.9c-16.8,0-30.6,13.8-30.6,30.6c0,16.8,13.8,30.6,30.6,30.6h122.5c16.8,0,30.6-13.8,30.6-30.6C990,483.2,976.2,469.4,959.4,469.4z'/>
<path d='M193.8,500c0-16.8-13.8-30.6-30.6-30.6H40.6C23.8,469.4,10,483.2,10,500c0,16.8,13.8,30.6,30.6,30.6h122.5C180,530.6,193.8,516.8,193.8,500z'/>
<path d='M239.7,284.1c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2c12.3-12.3,12.3-30.6,0-42.9l-87.3-87.3c-12.3-12.3-30.6-12.3-42.9,0s-12.3,30.6,0,42.9L239.7,284.1z'/>
<path d='M760.3,715.9c-12.3-12.3-30.6-12.3-42.9,0s-12.3,30.6,0,42.9l87.3,87.3c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2c12.3-12.3,12.3-30.6,0-42.9L760.3,715.9z'/>
<path d='M738.9,291.8c7.7,0,15.3-3.1,21.4-9.2l87.3-87.3c12.3-12.3,12.3-30.6,0-42.9s-30.6-12.3-42.9,0l-88.8,87.3c-12.3,12.3-12.3,30.6,0,42.9C722,288.7,729.7,291.8,738.9,291.8z'/>
<path d='M239.7,715.9l-87.3,87.3c-12.3,12.3-12.3,30.6,0,42.9c6.1,6.1,13.8,9.2,21.4,9.2s15.3-3.1,21.4-9.2l87.3-87.3c12.3-12.3,12.3-30.6,0-42.9C271.8,705.2,251.9,705.2,239.7,715.9z'/></g></svg>";

$backhome='<svg id="weather34 back icon" version="1.1" x="0px" y="0px" viewBox="0 0 219.151 219.151" width="16pt" fill="#00a4b4" style="enable-background:new 0 0 219.151 219.151;" xml:space="preserve">
<g>
<path fill="silver" d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575
   C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575
   c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z"/>
<path d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008
   c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825
   c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628
   c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z"/>
</g></svg>';
$tothecharts='
<svg id="weather34 chart icon" enable-background="new 0 0 475.293 475.293" viewBox="0 0 475.293 475.293"  width="13pt" fill="silver" >
<path fill="#00a4b4" d="m193.392 154.375 48.533 49.142c2.785 2.828 5.294 4.366 10.574 4.424 3.945 0 7.717-1.567 10.501-4.351l63.763-63.763v38.409h29.706v-74.265c0-8.21-6.643-14.853-14.853-14.853h-74.265v29.706h38.409l-53.189 53.189-48.533-49.142c-2.785-2.828-6.571-4.409-10.53-4.424-3.641.116-7.746 1.552-10.545 4.351l-89.495 89.495 21.003 21.003z"/>
<path d="m430.734 0h-386.175c-24.571 0-44.559 19.988-44.559 44.559v297.058c0 24.571 19.988 44.559 44.559 44.559h117.967c-.465 4.837-1.134 9.392-1.957 13.669-4.566 23.75-13.843 38.894-19.003 45.743h-22.744v29.706h237.648v-29.706h-22.742c-6.088-8.083-17.913-27.715-20.961-59.412h117.967c24.571 0 44.559-19.988 44.559-44.559v-297.058c0-24.572-19.987-44.559-44.559-44.559zm-386.175 29.706h386.176c8.195 0 14.853 6.658 14.853 14.853v222.794h-415.882v-222.794c0-8.195 6.658-14.853 14.853-14.853zm254.528 415.881h-122.881c7.115-13.972 13.881-33.958 15.966-59.412h90.949c2.085 25.455 8.852 45.441 15.966 59.412zm131.647-89.117h-386.175c-8.195 0-14.853-6.658-14.853-14.853v-44.559h415.882v44.559c-.001 8.195-6.658 14.853-14.854 14.853z"/>
<path d="m248.149 316.262c5.8 5.8 5.8 15.205 0 21.005s-15.205 5.8-21.005 0-5.8-15.205 0-21.005 15.205-5.8 21.005 0"/></svg>
';
$desktopicon='
<svg id="weather34desktop icon" enable-background="new 0 0 475.293 475.293" viewBox="0 0 475.293 475.293"  width="13pt" fill="silver" >
<path fill="rgba(0,0,0,0)" d="m193.392 154.375 48.533 49.142c2.785 2.828 5.294 4.366 10.574 4.424 3.945 0 7.717-1.567 10.501-4.351l63.763-63.763v38.409h29.706v-74.265c0-8.21-6.643-14.853-14.853-14.853h-74.265v29.706h38.409l-53.189 53.189-48.533-49.142c-2.785-2.828-6.571-4.409-10.53-4.424-3.641.116-7.746 1.552-10.545 4.351l-89.495 89.495 21.003 21.003z"/>
<path d="m430.734 0h-386.175c-24.571 0-44.559 19.988-44.559 44.559v297.058c0 24.571 19.988 44.559 44.559 44.559h117.967c-.465 4.837-1.134 9.392-1.957 13.669-4.566 23.75-13.843 38.894-19.003 45.743h-22.744v29.706h237.648v-29.706h-22.742c-6.088-8.083-17.913-27.715-20.961-59.412h117.967c24.571 0 44.559-19.988 44.559-44.559v-297.058c0-24.572-19.987-44.559-44.559-44.559zm-386.175 29.706h386.176c8.195 0 14.853 6.658 14.853 14.853v222.794h-415.882v-222.794c0-8.195 6.658-14.853 14.853-14.853zm254.528 415.881h-122.881c7.115-13.972 13.881-33.958 15.966-59.412h90.949c2.085 25.455 8.852 45.441 15.966 59.412zm131.647-89.117h-386.175c-8.195 0-14.853-6.658-14.853-14.853v-44.559h415.882v44.559c-.001 8.195-6.658 14.853-14.854 14.853z"/>
<path d="m248.149 316.262c5.8 5.8 5.8 15.205 0 21.005s-15.205 5.8-21.005 0-5.8-15.205 0-21.005 15.205-5.8 21.005 0"/></svg>
';
$wireless='<svg id="weather34 console online" id="console online" width="18pt" fill="#00a4b4" stroke="#00a4b4" stroke-width="3" x="0px" y="0px" viewBox="0 0 64.908 64.908" style="enable-background:new 0 0 54.908 54.908;" >
<g>
<path stroke="#00a4b4" stroke-width="2" d="M54.615,19.123c-7.243-7.244-16.89-11.233-27.161-11.233S7.537,11.878,0.293,19.123c-0.391,0.391-0.391,1.023,0,1.414
   s1.023,0.391,1.414,0C8.573,13.67,17.717,9.889,27.454,9.889s18.881,3.781,25.747,10.647c0.195,0.195,0.451,0.293,0.707,0.293
   s0.512-0.098,0.707-0.293C55.006,20.146,55.006,19.513,54.615,19.123z"/>
<path stroke="#00a4b4" stroke-width="2" d="M6.171,25c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293
   c10.955-10.956,28.781-10.956,39.737,0c0.391,0.391,1.023,0.391,1.414,0s0.391-1.023,0-1.414C37.002,13.266,17.907,13.264,6.171,25
   z"/>
<path stroke="#00a4b4" stroke-width="2" d="M27.454,24.508c-5.825,0-11.295,2.263-15.404,6.371c-0.391,0.391-0.391,1.023,0,1.414s1.023,0.391,1.414,0
   c3.731-3.73,8.699-5.785,13.99-5.785c5.291,0,10.259,2.055,13.99,5.785c0.195,0.195,0.451,0.293,0.707,0.293
   s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414C38.75,26.771,33.279,24.508,27.454,24.508z"/>
<path fill="#777" stroke="#777" stroke-width="2" d="M27.454,33.916c-3.612,0-6.551,2.939-6.551,6.552s2.939,6.552,6.551,6.552c3.613,0,6.552-2.939,6.552-6.552
   S31.067,33.916,27.454,33.916z M27.454,45.019c-2.51,0-4.551-2.042-4.551-4.552s2.042-4.552,4.551-4.552s4.552,2.042,4.552,4.552
   S29.964,45.019,27.454,45.019z"/>
</g></svg>';
$wirelessoffline='<svg id="weather34 console offline" fill="#ff552e"  stroke-width="3" width="18pt" x="0px" y="0px" viewBox="0 0 64.908 64.908" style="enable-background:new 0 0 54.908 54.908;" >
<g>
   <path stroke="#ff552e" stroke-width="2" d="M54.615,19.123c-7.243-7.244-16.89-11.233-27.161-11.233S7.537,11.878,0.293,19.123c-0.391,0.391-0.391,1.023,0,1.414
   s1.023,0.391,1.414,0C8.573,13.67,17.717,9.889,27.454,9.889s18.881,3.781,25.747,10.647c0.195,0.195,0.451,0.293,0.707,0.293
   s0.512-0.098,0.707-0.293C55.006,20.146,55.006,19.513,54.615,19.123z"/>
   <path stroke="#ff552e" stroke-width="2" d="M6.171,25c-0.391,0.391-0.391,1.023,0,1.414c0.195,0.195,0.451,0.293,0.707,0.293s0.512-0.098,0.707-0.293
   c10.955-10.956,28.781-10.956,39.737,0c0.391,0.391,1.023,0.391,1.414,0s0.391-1.023,0-1.414C37.002,13.266,17.907,13.264,6.171,25
   z"/>
   <path stroke="#ff552e" stroke-width="2" d="M27.454,24.508c-5.825,0-11.295,2.263-15.404,6.371c-0.391,0.391-0.391,1.023,0,1.414s1.023,0.391,1.414,0
   c3.731-3.73,8.699-5.785,13.99-5.785c5.291,0,10.259,2.055,13.99,5.785c0.195,0.195,0.451,0.293,0.707,0.293
   s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414C38.75,26.771,33.279,24.508,27.454,24.508z"/>
   <path width="0" fill="#777" stroke="#777" stroke-width="0" d="M27.454,33.916c-3.612,0-6.551,2.939-6.551,6.552s2.939,6.552,6.551,6.552c3.613,0,6.552-2.939,6.552-6.552
   S31.067,33.916,27.454,33.916z M27.454,45.019c-2.51,0-4.551-2.042-4.551-4.552s2.042-4.552,4.551-4.552s4.552,2.042,4.552,4.552
   S29.964,45.019,27.454,45.019z"/></g></svg>';
   $hometemp='<svg id="weather34 home indoor temperature icon" version="1.0" x="0px" y="0px" width="8pt" height="8pt" viewBox="0 0 575.284 575.285" style="enable-background:new 0 0 575.284 575.285;"><g><g><path fill="rgba(211, 93, 78, 1.000)" d="M167.295,287.88c-0.771,0.673-1.224,1.653-1.224,2.693V395.25c0,1.53,0.979,2.876,2.424,3.366l67.883,22.632
c0.367,0.122,0.747,0.184,1.126,0.184c0.734,0,1.469-0.233,2.069-0.674c0.93-0.673,1.481-1.738,1.481-2.876V300.513 c0-1.763-1.285-3.256-3.036-3.514l-67.883-9.939C169.119,286.901,168.079,287.208,167.295,287.88z"/>
<path fill="rgba(211, 93, 78, 1.000)" d="M132.387,281.589l-47.846-6.977c-1.016-0.159-2.057,0.159-2.828,0.82c-0.783,0.673-1.224,1.652-1.224,2.692v88.582 c0,1.53,0.979,2.877,2.424,3.366l47.846,15.948c0.368,0.123,0.747,0.184,1.114,0.184c0.734,0,1.469-0.232,2.081-0.673 c0.918-0.673,1.469-1.738,1.469-2.876V285.09C135.422,283.327,134.137,281.834,132.387,281.589z"/>
<path fill="rgba(86, 95, 103, 1.000)" d="M573.174,203.669L424.678,4.843c0,0-1.419-2.24-4.7-3.55c-3.28-1.322-6.475-0.392-6.475-0.392L180.184,60.694V40.057
c0-4.957-3.415-9.253-8.237-10.379l-19.499-4.504c0,0-1.261-0.343-3.036-0.245c-1.774,0.098-2.913,0.575-2.913,0.575 l-35.166,12.46c-4.247,1.505-7.087,5.52-7.087,10.024v32.179l-36.928,9.449c-2.975,0.771-5.472,2.778-6.867,5.52L1.15,212.666 c-1.653,3.268-1.518,7.148,0.367,10.282c1.885,3.133,5.251,5.08,8.911,5.166l28.103,0.587v208.558 c0,3.978,2.203,7.613,5.728,9.437L287.92,573.489c0,0,2.118,1.176,4.896,1.212c2.778,0.024,4.921-1.212,4.921-1.212 l236.098-122.963c3.513-1.836,5.716-5.459,5.728-9.437l0.416-222.096l23.917,1.652c0,0,6.255,0.71,9.78-5.018 C577.568,209.361,573.174,203.669,573.174,203.669z M282.205,546.512L59.828,430.795V229.141l177.468,3.733c0,0,0,0,0.012,0h0.024 l44.884,0.808v312.831H282.205z M530.102,196.986c-2.95-0.208-5.839,0.82-7.993,2.828c-2.154,2.007-3.378,4.834-3.391,7.772
l-0.416,227.041l-60.942,31.751V269.606c0-1.004-0.417-1.946-1.151-2.62s-1.701-1.003-2.692-0.918l-58.63,4.872 c-1.836,0.159-3.256,1.701-3.256,3.537v226.11L303.478,546.5V223.229c0-5.814-4.651-10.539-10.453-10.649l-32.901-0.6
L415.62,28.307l126.611,169.512L530.102,196.986z"/></g></svg>';
?>