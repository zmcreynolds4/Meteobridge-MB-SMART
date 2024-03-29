<?php 
	####################################################################################################
	#	HOME WEATHER STATION MB SMART TEMPLATE by BRIAN UNDERDOWN 2015-19                              #
	#	CREATED FOR HOMEWEATHERSTATION TEMPLATE at https://weather34.com/homeweatherstation/index.html # 
	# 	                                                                                               #
	# 	                                                                                               #
	# 	Moon: 25TH JANUARY 2018  						                                               #
	# 	   revised September 2019                                                                      #
	#   https://www.weather34.com 	                                                                   #
	####################################################################################################
//original weather34 script original css/svg/php by weather34 2015-2019 clearly marked as original by weather34//
include('livedata.php');
//get moon rise/set updated 29th July
class Moon{ public static function calculateMoonTimes($month,$day,$year,$lat,$lon){$utrise=$utset=0;$timezone=(int)($lon / 15);$date=self::modifiedJulianDate($month,$day,$year);$date-=$timezone / 24;$latRad=deg2rad($lat);$sinho=0.0023271056;$sglat=sin($latRad);$cglat=cos($latRad);$rise=false;$set=false;$above=false;$hour=0;$ym=self::sinAlt($date,$hour ,$lon,$cglat,$sglat)- $sinho;$above=$ym>0;while($hour<25&&(false==$set||false==$rise)){$yz=self::sinAlt($date,$hour,$lon,$cglat,$sglat)- $sinho;$yp=self::sinAlt($date,$hour + 1,$lon,$cglat,$sglat)- $sinho;$quadout=self::quad($ym,$yz,$yp);$nz=$quadout[0];$z1=$quadout[1];$z2=$quadout[2];$xe=$quadout[3];$ye=$quadout[4];if($nz==1){if($ym<0){$utrise=$hour + $z1;$rise=true;}else{$utset=$hour + $z1;$set=true;}}if($nz==2){if($ye<0){$utrise=$hour + $z2;$utset=$hour + $z1;}else{$utrise=$hour + $z1;$utset=$hour + $z2;}}$ym=$yp;$hour+=2.0;}$retVal=new stdClass();$utrise=self::convertTime($utrise);$utset=self::convertTime($utset);$retVal->moonrise=$rise?mktime($utrise['hrs'],$utrise['min'],0,$month,$day,$year):mktime(0,0,0,$month,$day + 1,$year);$retVal->moonset=$set?mktime($utset['hrs'],$utset['min'],0,$month,$day,$year):mktime(0,0,0,$month,$day + 1,$year);return $retVal;} private static function quad($ym,$yz,$yp){$nz=$z1=$z2=0;$a=0.5 *($ym + $yp)- $yz;$b=0.5 *($yp - $ym);$c=$yz;$xe=-$b /(2 * $a);$ye=($a * $xe + $b)* $xe + $c;$dis=$b * $b - 4 * $a * $c;if($dis>0){$dx=0.5 * sqrt($dis)/ abs($a);$z1=$xe - $dx;$z2=$xe + $dx;$nz=abs($z1)<1?$nz + 1:$nz;$nz=abs($z2)<1?$nz + 1:$nz;$z1=$z1<-1?$z2:$z1;}return array($nz,$z1,$z2,$xe,$ye);} private static function sinAlt($mjd,$hour,$glon,$cglat,$sglat){$mjd+=$hour / 24;$t=($mjd - 51544.5)/ 36525;$objpos=self::minimoon($t);$ra=$objpos[1];$dec=$objpos[0];$decRad=deg2rad($dec);$tau=15 *(self::lmst($mjd,$glon)- $ra);return $sglat * sin($decRad)+ $cglat * cos($decRad)* cos(deg2rad($tau));} private static function degRange($x){$b=$x / 360;$a=360 *($b -(int)$b);$retVal=$a<0?$a + 360:$a;return $retVal;} private static function lmst($mjd,$glon){$d=$mjd - 51544.5;$t=$d / 36525;$lst=self::degRange(280.46061839 + 360.98564736629 * $d + 0.000387933 * $t * $t - $t * $t * $t / 38710000);return $lst / 15 + $glon / 15;} private static function minimoon($t){$p2=6.283185307;$arc=206264.8062;$coseps=0.91748;$sineps=0.39778;$lo=self::frac(0.606433 + 1336.855225 * $t);$l=$p2 * self::frac(0.374897 + 1325.552410 * $t);$l2=$l * 2;$ls=$p2 * self::frac(0.993133 + 99.997361 * $t);$d=$p2 * self::frac(0.827361 + 1236.853086 * $t);$d2=$d * 2;$f=$p2 * self::frac(0.259086 + 1342.227825 * $t);$f2=$f * 2;$sinls=sin($ls);$sinf2=sin($f2);$dl=22640 * sin($l);$dl+=-4586 * sin($l - $d2);$dl+=2370 * sin($d2);$dl+=769 * sin($l2);$dl+=-668 * $sinls;$dl+=-412 * $sinf2;$dl+=-212 * sin($l2 - $d2);$dl+=-206 * sin($l + $ls - $d2);$dl+=192 * sin($l + $d2);$dl+=-165 * sin($ls - $d2);$dl+=-125 * sin($d);$dl+=-110 * sin($l + $ls);$dl+=148 * sin($l - $ls);$dl+=-55 * sin($f2 - $d2);$s=$f +($dl + 412 * $sinf2 + 541 * $sinls)/ $arc;$h=$f - $d2;$n=-526 * sin($h);$n+=44 * sin($l + $h);$n+=-31 * sin(-$l + $h);$n+=-23 * sin($ls + $h);$n+=11 * sin(-$ls + $h);$n+=-25 * sin(-$l2 + $f);$n+=21 * sin(-$l + $f);$L_moon=$p2 * self::frac($lo + $dl / 1296000);$B_moon=(18520.0 * sin($s)+ $n)/ $arc;$cb=cos($B_moon);$x=$cb * cos($L_moon);$v=$cb * sin($L_moon);$w=sin($B_moon);$y=$coseps * $v - $sineps * $w;$z=$sineps * $v + $coseps * $w;$rho=sqrt(1 - $z * $z);$dec=(360 / $p2)* atan($z / $rho);$ra=(48 / $p2)* atan($y /($x + $rho));$ra=$ra<0?$ra + 24:$ra;return array($dec,$ra);} private static function frac($x){$x-=(int)$x;return $x<0?$x + 1:$x;} private static function modifiedJulianDate($month,$day,$year){if($month<=2){$month+=12;$year--;}$a=10000 * $year + 100 * $month + $day;$b=0;if($a<=15821004.1){$b=-2 *(int)(($year + 4716)/ 4)- 1179;}else{$b=(int)($year / 400)-(int)($year / 100)+(int)($year / 4);}$a=365 * $year - 679004;return $a + $b +(int)(30.6001 *($month + 1))+ $day;} private static function convertTime($hours){include('settings.php');$hrs=(int)($hours * 60 + 0.5)/ 60.0;$h=(int)($hrs);$m=(int)(60 *($hrs - $h)+ 0.5);return array('hrs'=>$h + $moonadj,'min'=>$m);} } $Moon=Moon::calculateMoonTimes($months,$days,$years,$lat,$lon); $MoonRise=$Moon->moonrise; $MoonSet=$Moon->moonset; $MoonRise=date($MoonRise); $MoonSet=date($MoonSet); class MoonPhase{ private $timestamp; private $phase; private $illum; private $age; private $dist; private $angdia; private $sundist; private $sunangdia; private $synmonth; private $quarters=null; function __construct($pdate=null){if(is_null($pdate))$pdate=time();$epoch=2444238.5;$elonge=278.833540;$elongp=282.596403;$eccent=0.016718;$sunsmax=1.495985e8;$sunangsiz=0.533128;$mmlong=64.975464;$mmlongp=349.383063;$mlnode=151.950429;$minc=5.145396;$mecc=0.054900;$mangsiz=0.5181;$msmax=384401;$mparallax=0.9507;$synmonth=29.53058868;$zenith=90+(50/60);$this->synmonth=$synmonth;$lunatbase=2423436.0;$this->timestamp=$pdate;$pdate=$pdate / 86400 + 2440587.5;$Day=$pdate - $epoch;$N=$this->fixangle((360 / 365.2422)* $Day);$M=$this->fixangle($N + $elonge - $elongp);$Ec=$this->kepler($M,$eccent);$Ec=sqrt((1 + $eccent)/(1 - $eccent))* tan($Ec / 2);$Ec=2 * rad2deg(atan($Ec));$Lambdasun=$this->fixangle($Ec + $elongp);$F=((1 + $eccent * cos(deg2rad($Ec)))/(1 - $eccent * $eccent));$SunDist=$sunsmax / $F;$SunAng=$F * $sunangsiz;$ml=$this->fixangle(13.1763966 * $Day + $mmlong);$MM=$this->fixangle($ml - 0.1114041 * $Day - $mmlongp);$MN=$this->fixangle($mlnode - 0.0529539 * $Day);$Ev=1.2739 * sin(deg2rad(2 *($ml - $Lambdasun)- $MM));$Ae=0.1858 * sin(deg2rad($M));$A3=0.37 * sin(deg2rad($M));$MmP=$MM + $Ev - $Ae - $A3;$mEc=6.2886 * sin(deg2rad($MmP));$A4=0.214 * sin(deg2rad(2 * $MmP));$lP=$ml + $Ev + $mEc - $Ae + $A4;$V=0.6583 * sin(deg2rad(2 *($lP - $Lambdasun)));$lPP=$lP + $V;$NP=$MN - 0.16 * sin(deg2rad($M));$y=sin(deg2rad($lPP - $NP))* cos(deg2rad($minc));$x=cos(deg2rad($lPP - $NP));$Lambdamoon=rad2deg(atan2($y,$x))+ $NP;$BetaM=rad2deg(asin(sin(deg2rad($lPP - $NP))* sin(deg2rad($minc))));$MoonAge=$lPP - $Lambdasun;$MoonPhase=(1 - cos(deg2rad($MoonAge)))/ 2;$MoonDist=($msmax *(1 - $mecc * $mecc))/(1 + $mecc * cos(deg2rad($MmP + $mEc)));$MoonDFrac=$MoonDist / $msmax;$MoonAng=$mangsiz / $MoonDFrac;$this->phase=$this->fixangle($MoonAge)/ 360;$this->illum=$MoonPhase;$this->age=$synmonth * $this->phase;$this->dist=$MoonDist;$this->angdia=$MoonAng;$this->sundist=$SunDist;$this->sunangdia=$SunAng;} private function fixangle($a){return($a - 360 * floor($a / 360));} private function kepler($m,$ecc){$epsilon=0.000001;$e=$m=deg2rad($m);do{$delta=$e - $ecc * sin($e)- $m;$e-=$delta /(1 - $ecc * cos($e));}while(abs($delta)>$epsilon);return $e;} private function meanphase($sdate,$k){$t=($sdate - 2415020.0)/ 36525;$t2=$t * $t;$t3=$t2 * $t;$nt1=2415020.75933 + $this->synmonth * $k + 0.0001178 * $t2 - 0.000000155 * $t3 + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));return $nt1;} private function truephase($k,$phase){$apcor=false;$k+=$phase;$t=$k / 1236.85;$t2=$t * $t;$t3=$t2 * $t;$pt=2415020.75933 + $this->synmonth * $k + 0.0001178 * $t2 - 0.000000155 * $t3 + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));$m=359.2242 + 29.10535608 * $k - 0.0000333 * $t2 - 0.00000347 * $t3;$mprime=306.0253 + 385.81691806 * $k + 0.0107306 * $t2 + 0.00001236 * $t3;$f=21.2964 + 390.67050646 * $k - 0.0016528 * $t2 - 0.00000239 * $t3;if($phase<0.01||abs($phase - 0.5)<0.01){$pt+=(0.1734 - 0.000393 * $t)* sin(deg2rad($m))+ 0.0021 * sin(deg2rad(2 * $m))- 0.4068 * sin(deg2rad($mprime))+ 0.0161 * sin(deg2rad(2 * $mprime))- 0.0004 * sin(deg2rad(3 * $mprime))+ 0.0104 * sin(deg2rad(2 * $f))- 0.0051 * sin(deg2rad($m + $mprime))- 0.0074 * sin(deg2rad($m - $mprime))+ 0.0004 * sin(deg2rad(2 * $f + $m))- 0.0004 * sin(deg2rad(2 * $f - $m))- 0.0006 * sin(deg2rad(2 * $f + $mprime))+ 0.0010 * sin(deg2rad(2 * $f - $mprime))+ 0.0005 * sin(deg2rad($m + 2 * $mprime));$apcor=true;}else if(abs($phase - 0.25)<0.01||abs($phase - 0.75)<0.01){$pt+=(0.1721 - 0.0004 * $t)* sin(deg2rad($m))+ 0.0021 * sin(deg2rad(2 * $m))- 0.6280 * sin(deg2rad($mprime))+ 0.0089 * sin(deg2rad(2 * $mprime))- 0.0004 * sin(deg2rad(3 * $mprime))+ 0.0079 * sin(deg2rad(2 * $f))- 0.0119 * sin(deg2rad($m + $mprime))- 0.0047 * sin(deg2rad($m - $mprime))+ 0.0003 * sin(deg2rad(2 * $f + $m))- 0.0004 * sin(deg2rad(2 * $f - $m))- 0.0006 * sin(deg2rad(2 * $f + $mprime))+ 0.0021 * sin(deg2rad(2 * $f - $mprime))+ 0.0003 * sin(deg2rad($m + 2 * $mprime))+ 0.0004 * sin(deg2rad($m - 2 * $mprime))- 0.0003 * sin(deg2rad(2 * $m + $mprime));if($phase<0.5)$pt+=0.0028 - 0.0004 * cos(deg2rad($m))+ 0.0003 * cos(deg2rad($mprime));else $pt+=-0.0028 + 0.0004 * cos(deg2rad($m))- 0.0003 * cos(deg2rad($mprime));$apcor=true;}if(!$apcor)return false;return $pt;} private function phasehunt(){$sdate=$this->utctojulian($this->timestamp);$adate=$sdate - 45;$ats=$this->timestamp - 86400 * 45;$yy=(int)gmdate('Y',$ats);$mm=(int)gmdate('n',$ats);$k1=floor(($yy +(($mm - 1)*(1 / 12))- 1900)* 12.3685);$adate=$nt1=$this->meanphase($adate,$k1);while(true){$adate+=$this->synmonth;$k2=$k1 + 1;$nt2=$this->meanphase($adate,$k2);if(abs($nt2 - $sdate)<0.75)$nt2=$this->truephase($k2,0.0);if($nt1<=$sdate&&$nt2>$sdate)break;$nt1=$nt2;$k1=$k2;}$data=array($this->truephase($k1,0.0),$this->truephase($k1,0.25),$this->truephase($k1,0.5),$this->truephase($k1,0.75),$this->truephase($k2,0.0),$this->truephase($k2,0.25),$this->truephase($k2,0.5),$this->truephase($k2,0.75));$this->quarters=array();foreach($data as $v)$this->quarters[]=($v - 2440587.5)* 86400;}private function utctojulian($ts){return $ts / 86400 + 2440587.5;} private function get_phase($n){if(is_null($this->quarters))$this->phasehunt();return $this->quarters[$n];} function phase(){return $this->phase;}function illumination(){return $this->illum;} function age(){return $this->age;} function distance(){return $this->dist;} function diameter(){return $this->angdia;} function sundistance(){return $this->sundist;} function sundiameter(){return $this->sunangdia;} function new_moon(){return $this->get_phase(0);} function first_quarter(){return $this->get_phase(1);} function full_moon(){return $this->get_phase(2);} function last_quarter(){return $this->get_phase(3);} function next_new_moon(){return $this->get_phase(4);} function next_first_quarter(){return $this->get_phase(5);} function next_full_moon(){return $this->get_phase(6);} function next_last_quarter(){return $this->get_phase(7);} function phase_name(){$names=array('New Moon','Waxing Crescent','First Quarter','Waxing Gibbous','Full Moon','Waning Gibbous','Third Quarter','Waning Crescent','New Moon');return $names[ floor(($this->phase + 0.0625)* 8)];} } ?>

<?php 
//weather34 next lunar event..
$lunar_nextevent="No Lunar Event<br>s";
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 1, 1),"event_title"=>"<br><large>Annular Solar <blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue>December 26th 2019
</div></div>","event_end"=>mktime(23, 59, 59, 12, 26, 19),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 12, 26,19),"event_title"=>"<br><large>Penumbral Lunar <blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br> <blue>January 10-11th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 1, 11, 20),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 1, 11, 20),"event_title"=>"<br><large>Penumbral Lunar <blue>Eclipse</large></blue>
<div class=date><br>Lunar Event Visible <br><blue> June 5-6th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 6, 6, 20),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 6, 6, 20),"event_title"=>"<br><large>Annular Solar <blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> June 21st 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 6, 21, 20),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 6, 21, 20),"event_title"=>"<br><large>Penumbral Lunar <blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> July 4-5th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 7, 5, 20),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 7, 5, 20),"event_title"=>"<br><large>Penumbral Lunar <blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> November 29-30th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 11, 30, 20),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 11, 30, 20),"event_title"=>"<br><large>Total Solar<blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> December 14th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 12, 14, 20),);
//2021
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 12, 14, 20),"event_title"=>"<br><large>Lunar Total<blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> May 26th 2021<br>
</div></div>","event_end"=>mktime(23, 59, 59, 5, 26, 21),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 5, 26, 21),"event_title"=>"<br><large>Annular Solar<blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> June 10th 2020<br>
</div></div>","event_end"=>mktime(23, 59, 59, 6, 10, 21),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 6, 10, 21),"event_title"=>"<br><large>Partial Lunar<blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> November 18-19th 2021<br>
</div></div>","event_end"=>mktime(23, 59, 59, 11, 19, 21),);
$lunar_eventsnext[]=array("event_start"=>mktime(23, 59, 59, 112, 19, 21),"event_title"=>"<br><large>Total Solar<blue>Eclipse</large></blue>
<div class=date>Lunar Event Visible <br><blue> December 4th 2021</blue><br>
</div></div>","event_end"=>mktime(23, 59, 59, 12, 4, 21),);
$lunarNext=time();$lunarOP=false;
foreach ($lunar_eventsnext as $lunar_check) {if ($lunar_check["event_start"]<=$lunarNext&&$lunarNext<=$lunar_check["event_end"]) {$lunarOP=true;$lunar_nextevent=$lunar_check["event_title"];}};
//end meteor nevt event
$lunarinfo3='<svg width="110" viewBox="0 0 512 512" id="weather34 svg eclipse"><g id="weather34eclipse"><path fill="#49545b" opacity=".5" d=" M 162.82 68.68 C 217.22 42.05 283.43 41.17 338.48 66.45 C 356.45 74.61 373.20 85.40 388.08 98.34 C 411.02 118.31 429.61 143.30 441.71 171.21 C 461.45 216.04 464.30 267.98 449.86 314.76 C 439.41 349.21 419.54 380.72 393.08 405.11 C 360.92 435.22 318.71 454.36 274.88 458.76 C 227.90 463.90 179.25 452.31 139.80 426.23 C 96.19 397.68 64.01 352.07 52.47 301.18 C 41.60 254.95 47.17 205.00 68.34 162.46 C 88.32 121.92 122.13 88.36 162.82 68.68 M 241.61 70.93 C 205.47 73.17 170.04 86.26 141.37 108.41 C 113.46 129.68 91.96 159.22 80.24 192.29 C 72.92 212.99 69.23 235.01 69.62 256.96 C 70.21 300.95 87.26 344.52 116.92 377.05 C 136.12 398.29 160.36 414.99 187.13 425.19 C 223.20 439.09 263.68 441.22 300.98 431.01 C 339.57 420.78 374.47 397.34 398.64 365.58 C 426.37 329.66 439.83 283.09 435.67 237.92 C 431.92 192.52 410.38 148.90 376.56 118.36 C 340.47 85.10 290.54 67.71 241.61 70.93 Z" /></g><g id="weather34pass"><path fill="#01a4b5" opacity="1.00" d=" M 338.48 66.45 C 344.19 58.84 353.31 53.45 363.03 53.96 C 378.55 53.20 392.86 67.55 392.04 83.07 C 392.30 88.44 390.64 93.68 388.08 98.34 C 373.20 85.40 356.45 74.61 338.48 66.45 Z" /></g>
</svg>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Weather34 MB-SMART Moon Phase Information</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
@font-face{font-family:weathertext;src:url(css/fonts/verbatim-regular.woff) format("woff"),url(fonts/verbatim-regular.woff2) format("woff2"),url(fonts/verbatim-regular.ttf) format("truetype")}
html,body{font-size:13px;font-family: "weathertext", Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;	-moz-osx-font-smoothing: grayscale;}
.grid { 
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 2fr));
  grid-gap: 5px;
  align-items: stretch;
  color:#f5f7fc;-webkit-font-smoothing: antialiased;	-moz-osx-font-smoothing: grayscale;
  }
.grid > article {
  border: 1px solid rgba(245, 247, 252,.02);
  box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.6);
  padding:5px;
  font-size:0.75em;
  -webkit-border-radius:4px;
  border-radius:4px;
  background:0;-webkit-font-smoothing: antialiased;	-moz-osx-font-smoothing: grayscale;
  height:160px
}
.grid > article img {
  max-width: 50%;
  max-height:100px
} 
 
  a{color:#aaa;text-decoration:none} 
.weather34darkbrowser{position:relative;background:0;width:96%;height:30px;margin:auto;margin-top:-5px;margin-left:0px;border-top-left-radius:5px;border-top-right-radius:5px;padding-top:10px;}
.weather34darkbrowser[url]:after{content:attr(url);color:#aaa;font-size:10px;position:absolute;left:0;right:0;top:0;padding:4px 15px;margin:11px 10px 0 auto;border-radius:3px;background:rgba(97, 106, 114, 0.3);height:20px;box-sizing:border-box}
 
 
 blue{color:#01a4b4}orange{color:#009bb4}orange1{position:relative;color:#009bb4;margin:0 auto;text-align:center;margin-left:5%;font-size:1.1rem}green{color:#aaa}red{color:#f37867}red6{color:#d65b4a}value{color:#fff}yellow{color:#CC0}purple{color:#916392}
 meteotextshowertext{font-size:1.2rem;color:#009bb4}
 meteorsvgicon{color:#f5f7fc}  
.moonphasesvg{align-items:right;justify-content:center;display:flex;max-height:120px}
.moonphasetext{font-size:.8rem;color:#f5f7fc;position:absolute;display:inline;left:145px;top:100px}
moonphaseriseset{font-size:.75rem;}
credit{position:relative;font-size:.7em;top:10%}
.actualt{position:relative;left:5px;-webkit-border-radius:3px;-moz-border-radius:3px;-o-border-radius:3px;border-radius:3px;background:rgba(74, 99, 111, 0.1);
padding:5px;font-family:Arial, Helvetica, sans-serif;width:100px;height:0.8em;font-size:0.8rem;padding-top:2px;color:#aaa;
align-items:center;justify-content:center;margin-bottom:10px;top:0}
.actualw{position:relative;left:5px;-webkit-border-radius:3px;-moz-border-radius:3px;-o-border-radius:3px;border-radius:3px;background:rgba(74, 99, 111, 0.1);
padding:5px;font-family:Arial, Helvetica, sans-serif;width:100px;height:0.8em;font-size:0.8rem;padding-top:2px;color:#aaa;
align-items:center;justify-content:center;margin-bottom:10px;top:0}
.moonphaseing{width:110px;padding-bottom:50px;margin-top:-10px}
.weather34moonphasesvg{position:absolute;width:120px;}
.weather34moonforeground { fill:rgba(230, 232, 239, .3); stroke:rgba(86, 95, 103, .8); stroke-width:0;max-height:100px }
.weather34moonbackground{ fill:rgba(86, 95, 103, .8);stroke:rgba(230, 232, 239, .3);stroke-width:0; }
.mbsmartlogo{position:relative;float:right;left:10px;top:70px;}
small{font-size:8px;}
large{position:relative;top:-5px;left:60px;font-size:13px;width:120px}
.date{position:relative;top:-5px;left:60px;font-size:11px;width:180px}
</style>
<?php // lets rotate for Tony (Beaumaris-Weather) down under
if ($hemisphere==0){echo '<style>.weather34moonphasesvg{-webkit-transform: rotate('.$hemisphere.'deg);transform: rotate('.$hemisphere.'deg);left:25px; top:70px;}
</style>';}
if ($hemisphere==180){echo '<style>.weather34moonphasesvg{-webkit-transform: rotate('.$hemisphere.'deg);transform: rotate('.$hemisphere.'deg);left:15px; top:30px;}
</style>';}
?>
<div class="weather34darkbrowser" url="Moon Phase Information"></div>
  
<main class="grid">
  <article>       


<?php echo $info;?> Current Moon Phase<br><br>  

<!---simple weather34 svg moonphase -->
<div class="weather34moonphasesvg"><p id="weather34moonphase"></p>
<svg>
	<circle cx="50" cy="50" r="49.5" fill="rgba(86,95,103,.8)"/><path id="weather34themoon" fill="rgba(230, 232, 239, .3)"/></svg>
<script>
function showMoon(){var t=(Date.now()/864e5-Date.UTC(2018, 0, 17, 1, 0, 0, 0)/864e5)%29.530588853,e=String;document.getElementById("weather34moonphase");var a,n=Math.min(3-t/30*4,1),o=Math.abs(50*n),h=n<0?"0":"1",m=Math.min(3+(t-30)/30*4,1),M=Math.abs(50*m),r=m<0?"0":"1";a="M 50,0 a "+e(o)+",50 0 0 "+h+" 0,100 a "+e(M)+",50 0 0 "+r+" 0,-100",document.getElementById("weather34themoon").setAttribute("d",a)}showMoon();</script>
</article>

<div class=moonphasetext>    
<?php echo " ";{$day = date('l jS F Y');
if($day===date("l jS F Y",strtotime('2019-12-26'))){echo 'Lunar Annular Solar <blue>Eclipse</blue>';}
else if($day===date("l jS F Y",strtotime('2020-1-10'))){echo 'Lunar <blue>Eclipse</blue>';}
else if($day===date("l jS F Y",strtotime('2020-2-9'))){echo 'Super <blue>Moon</blue>';}
else if($day===date("l jS F Y",strtotime('2020-3-9'))){echo 'Super <blue>Moon</blue>';}
else if($day===date("l jS F Y",strtotime('2020-4-8'))){echo 'Super <blue>Moon</blue>';}
else if($day===date("l jS F Y",strtotime('2020-6-5'))){echo 'Lunar <blue>Eclipse</blue>';}	
else if($day===date("l jS F Y",strtotime('2020-6-21'))){echo 'Annular Solar <blue>Eclipse</blue>';}	
else if($day===date("l jS F Y",strtotime('2020-7-5'))){echo 'Lunar <blue>Eclipse</blue>';}	
else if($day===date("l jS F Y",strtotime('2020-10-31'))){echo 'Blue <blue>Moon</blue>';}
else if($day===date("l jS F Y",strtotime('2020-11-30'))){echo 'Lunar <blue>Eclipse</blue>';}	
else if($day===date("l jS F Y",strtotime('2020-12-14'))){echo 'Total <blue>Eclipse</blue>';}		
// weather34 moonphase no scraping its calculated from the livedata !
	else echo "<aqivalue1>".$weather['moonphase']." </aqivalue1>";}?>       
<br>
<?php echo" Luminance <blue>" .$weather['luminance']."</blue>%";?>            
</div>  
</article>  
  
  <article>
 <moonphaseriseset>
  <?php echo $info;?> Moon Rise/Set Information<br><br>
<svg id="i-ban" viewBox="0 0 32 32" width="10" height="10" fill="#39739f" stroke="#39739f" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
<circle cx="16" cy="16" r="14" /><path d="M6 6 L26 26" /></svg> Moon:<?php echo $weather['moonrise']," ";?>
<svg id="i-chevron-top" viewBox="0 0 32 32" width="10" height="10" fill="none" stroke="#ff8841" stroke-linecap="round" stroke-linejoin="round" stroke-width="10%"><path d="M30 20 L16 8 2 20" /></svg>
</span><br>
<svg id="i-ban" viewBox="0 0 32 32" width="10" height="10" fill="#D46842" stroke="#D46842" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%"><circle cx="16" cy="16" r="14" /><path d="M6 6 L26 26" /></svg> Moon:<?php echo $weather['moonset']," ";?>
<svg id="i-chevron-bottom" viewBox="0 0 32 32" width="10" height="10" fill="none" stroke="#ff8841" stroke-linecap="round" stroke-linejoin="round" stroke-width="10%"><path d="M30 12 L16 24 2 12" /></svg>
</span><br>
<svg id="i-ban" viewBox="0 0 32 32" width="10" height="10" fill="rgba(255, 136, 65, 1.00)" stroke="rgba(255, 136, 65, 1.00)" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
<circle cx="16" cy="16" r="14" /><path d="M6 6 L26 26" /></svg>
Next Full Moon: <?php  // homeweatherstation fullmoon info output 18th Aug
$now1 =time();$moon1 = new MoonPhase();
echo "";
if ($now1 < $moon1->full_moon()) 
{echo date('D jS-M-Y', $moon1->full_moon() );}
else echo date('D jS-M-Y', $moon1->next_full_moon() );
?></span><br>
<svg id="i-ban" viewBox="0 0 32 32" width="10" height="10" fill="#777" stroke="#777" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
<circle cx="16" cy="16" r="14" /> <path d="M6 6 L26 26" /></svg>
Next New Moon:<?php $moon=new MoonPhase();$nextnewmoon=date('D jS-M-Y',$moon->next_new_moon());echo $nextnewmoon;?>
</span><br /><svg id="i-ban" viewBox="0 0 32 32" width="10" height="10" fill="rgba(154, 186, 47, 1.00)" stroke="rgba(154, 186, 47, 1.00)" stroke-linecap="round" stroke-linejoin="round" stroke-width="6.25%">
<circle cx="16" cy="16" r="14" /><path d="M6 6 L26 26" /></svg> 
<?php // homeweatherstation create an instance of the age of moon
$moon = new MoonPhase();$moonage =round($moon->age(),2);echo "Current Moon cycle is <blue>", round($moonage,0)," days old </blue>";?>
               
  
  
   </article>  
   
   <article>
  
  <?php if ($lunar_nextevent)  {echo $lunarinfo3 ,$lunar_nextevent ;} ?>    
  </article>  
   
 <article>
   <?php echo $info;?> Solar Eclipse and Lunar Events</blue><br><br>
           <?php 
$lunayear=date('Y');		   
		   
if($lunayear==2019 || $lunayear==2020 ){
	echo $info." Annular Lunar <blue>Eclipse</blue> 26 Dec 2019<br>";	
	echo $info." Lunar <blue>Eclipse</blue> 10-11 Jan 2020<br>	";
	echo $info." Lunar <blue>Eclipse </blue> 5-6 Jun 2020<br>";	
	echo $info." Annular Solar <blue>Eclipse </blue> 21 Jun 2020<br>";
	echo $info." Lunar <blue>Eclipse </blue> 4-5 Jul 2020<br>";	
	echo $info." Lunar <blue>Eclipse </blue> 29-30 Nov 2020<br>";
	echo $info." Total <blue>Eclipse </blue> 14 Dec 2020<br>";
	}
	
else if($lunayear==2021 || $lunayear==2022 ){
	echo $info." Total Lunar <blue>Eclipse</blue> 26 May 2021<br>";
	echo $info." Annular Solar <blue>Eclipse</blue> 10 Jun 2021<br>	";
	echo $info." Partial Lunar <blue>Eclipse </blue> 18-19 Nov 2021<br>	";
	echo $info." Total <blue>Eclipse </blue> 4 Dec 2021<br>";
	echo $info." Partial Solar <blue>Eclipse </blue> 30 Apr 2021<br>";
	echo $info." Lunar <blue>Eclipse </blue> 15-16 May 2021<br>";
	echo $info." Partial Solar <blue>Eclipse </blue> 25 Oct 2021<br>";
	echo $info." Total Lunar <blue>Eclipse </blue> 8 Nov 2020<br>";	
	}	
echo '<br><a href="https://www.timeanddate.com" title="https://www.timeanddate.com" target="_blank"><small>data provided by<blue> https://www.timeanddate.com</blue></small></a>';
	
?>	

  </article> 
  
  
  <article>
   <?php echo $info ;?> Radio Ham Guide (<orange>EME</orange>)<br><br>
   Earth–Moon–Earth communication (<orange>EME</orange>), also known as Moon bounce, is a radio communications technique that relies on the propagation of radio waves from an Earth-based transmitter directed via reflection from the surface of the Moon back to an Earth-based receiver using VHF and UHF amateur radio bands.              
  </article> 
  <article>
   <div class=actualt>&nbsp;&nbsp &copy; Information</div>  
  <?php echo $info?> CSS/SVG/PHP scripts were developed by <a href="https://weather34.com" title="weather34.com" target="_blank" style="font-size:9px;">weather34.com</a>  for use in the weather34 template &copy; 2015-<?php echo date('Y');?></span>
  
  <div class="mbsmartlogo"><img src="img/weather34-mbsmart-logo.svg" alt="weather34 mb-smart" title="weather34 mb-smart" width="60px"></div>
  </article> 
</main>