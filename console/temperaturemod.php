<?php include('livedata.php');include('common.php');?>
<div class="modulecaption"><?php echo $lang['Temperature']; ?> &deg;<blue1><?php echo $weather["temp_units"]?></blue1></div>
<div class="tempcontainer">
<?php echo "<div class='maxdata'>". $weather["temp_today_low"]."&deg;</div>";?> 
<?php echo "<div class='mindata'>".$weather["temp_today_high"]."&deg;</div>";?>
<?php echo "<div class='hidata'>Min</div>";?> 
<?php echo "<div class='lodata'>Max</div>";?>
<?php //weather34 sez lets make the temperature look nice 
if($weather["temp_units"]=='C' && $weather['temp']<-10){echo '<div class=outsideminus10>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<-5){echo '<div class=outsideminus5>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<0){echo '<div class=outsidezero>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<5){echo '<div class=outside0-5>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<10){echo '<div class=outside6-10>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<16){echo '<div class=outside11-15>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<20){echo '<div class=outside16-20>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<25){echo '<div class=outside21-25>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<30){echo '<div class=outside26-30>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<35){echo '<div class=outside31-35>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<40){echo '<div class=outside36-40>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<45){echo '<div class=outside41-45>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather['temp']<100){echo '<div class=outside50>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
//Fahrenheit
if($weather["temp_units"]=='F' && $weather['temp']<14){echo '<div class=outsideminus10>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<23){echo '<div class=outsideminus5>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<32){echo '<div class=outsidezero>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<41){echo '<div class=outside0-5>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<50){echo '<div class=outside6-10>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<60.1){echo '<div class=outside11-15>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<68){echo '<div class=outside16-20>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<77){echo '<div class=outside21-25>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<86){echo '<div class=outside26-30>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<95){echo '<div class=outside31-35>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<104){echo '<div class=outside36-40>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<113){echo '<div class=outside41-45>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather['temp']<212){echo '<div class=outside50>'.number_format($weather['temp'],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
?>
</div></smalltempunit>
</div></div>



<div class="heatcircle"><div class="heatcircle-content">
<?php  //temp max Year
echo "<valuetextheading1>".date('Y')." Max <blue>".$weather["tempymaxtime"]."</blue></valuetextheading1><br>";
if ($weather["tempymax"]>24) {
echo "
<div class=tempconverter1><div class=tempmodulehome25-30c>".$weather["tempymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["tempymax"]>19) {
echo "
<div class=tempconverter1><div class=tempmodulehome20-25c>".$weather["tempymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}
    

else if ($weather["tempymax"]>10) {
echo "
<div class=tempconverter1><div class=tempmodulehome10-15c>".$weather["tempymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}  

else if ($weather["tempymax"]>7) {
echo "
<div class=tempconverter1><div class=tempmodulehome5-10c>".$weather["tempymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["tempymax"]>-50) {
echo "
<div class=tempconverter1><div class=tempmodulehome0-5c>".$weather["tempymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

?><smalltempunit2></div></div></div>

<div class="heatcircle2"><div class="heatcircle-content">
<?php  //dewpoint min year
echo "<valuetextheading1>".date('Y')." Min <blue>".$weather["tempymintime"]."</blue></valuetextheading1><br>";
if ($weather["tempymin"]>24) {
echo "
<div class=tempconverter1><div class=tempmodulehome25-30c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["tempymin"]>19) {
echo "
<div class=tempconverter1><div class=tempmodulehome20-25c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}
    

else if ($weather["tempymin"]>10) {
echo "
<div class=tempconverter1><div class=tempmodulehome10-15c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}  

else if ($weather["tempymin"]>7) {
echo "
<div class=tempconverter1><div class=tempmodulehome5-10c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["tempymin"]>2) {
    echo "
    <div class=tempconverter1><div class=tempmodulehome0-5c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["tempymin"]>-50) {
echo "
<div class=tempconverter1><div class=tempmodulehome-10-0c>".$weather["tempymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

?>
</smalltempunit2></div></div></div>


<div class="heatcircleindoor"><div class="heatcircle-content"><valuetextheading1><?php echo $lang['Average']." ".$lang['Today'];?></valuetextheading1>
<?php //avg today
if ($weather["temp_units"]=='C' &&  $weather["temp_avgtoday"]>=40){echo "<div class=tempconverter1><div class=tempmodulehome40-50c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' &&  $weather["temp_avgtoday"]>=35){echo "<div class=tempconverter1><div class=tempmodulehome35-40c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' &&  $weather["temp_avgtoday"]>=30){echo "<div class=tempconverter1><div class=tempmodulehome30-35c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>=25){echo "<div class=tempconverter1><div class=tempmodulehome25-30c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>=20){echo "<div class=tempconverter1><div class=tempmodulehome20-25c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>=15){echo "<div class=tempconverter1><div class=tempmodulehome15-20c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>=10){echo "<div class=tempconverter1><div class=tempmodulehome10-15c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>5){echo "<div class=tempconverter1><div class=tempmodulehome5-10c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>=0){echo "<div class=tempconverter1><div class=tempmodulehome0-5c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>-10){echo "<div class=tempconverter1><div class=tempmodulehome-10-0c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='C' && $weather["temp_avgtoday"]>-50){echo "<div class=tempconverter1><div class=tempmodulehome-50-10c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}

//non metric avg today
if ($weather["temp_units"]=='F' &&  $weather["temp_avgtoday"]>=104){echo "<div class=tempconverter1><div class=tempmodulehome40-50c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' &&  $weather["temp_avgtoday"]>=95){echo "<div class=tempconverter1><div class=tempmodulehome35-40c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' &&  $weather["temp_avgtoday"]>=86){echo "<div class=tempconverter1><div class=tempmodulehome30-35c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>=77){echo "<div class=tempconverter1><div class=tempmodulehome25-30c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>=68){echo "<div class=tempconverter1><div class=tempmodulehome20-25c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>=59){echo "<div class=tempconverter1><div class=tempmodulehome15-20c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>=50){echo "<div class=tempconverter1><div class=tempmodulehome10-15c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>41){echo "<div class=tempconverter1><div class=tempmodulehome5-10c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>=32){echo "<div class=tempconverter1><div class=tempmodulehome0-5c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>14){echo "<div class=tempconverter1><div class=tempmodulehome-10-0c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}
else if ($weather["temp_units"]=='F' && $weather["temp_avgtoday"]>-50){echo "<div class=tempconverter1><div class=tempmodulehome-50-10c>". $weather["temp_avgtoday"]."&deg;<smalltempunit2>".$weather["temp_units"];}?>
</smalltempunit2></div></div></div>
</div>


<?php 
//falling
if($weather["temp_trend"]<0){echo '<div class=thetrendboxblue>'.$lang['Falling'].'';echo '&nbsp;'.$fallingsymbolx.'&nbsp; '.number_format($weather["temp_trend"],1).'&deg;';}
//rising
else if($weather["temp_trend"]>0){echo '<div class=thetrendboxorange>'.$lang['Rising'].'';echo '&nbsp;'.$risingsymbolx.'&nbsp; + '.number_format($weather["temp_trend"],1).'&deg;';}
//steady
else echo '<div class=thetrendboxblue>'.$lang['Steady'].''.$steadysymbol.'';?>
</div></div></div></div>