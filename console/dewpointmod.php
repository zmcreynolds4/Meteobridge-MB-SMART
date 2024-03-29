<?php include('livedata.php');include('common.php');?>
<div class="modulecaption"><?php echo $lang['Dewpoint']?>&deg;<blue1><?php echo $weather["temp_units"]?></blue1></div>
<div class="tempcontainer">
<?php echo "<div class='maxdata'>". $weather["dewmin"]."&deg;</div>";?> 
<?php echo "<div class='mindata'>".$weather["dewmax"]."&deg;</div>";?>
<?php echo "<div class='hidata'>Min</div>";?> 
<?php echo "<div class='lodata'>Max</div>";?>
<?php //weather34 sez lets make the temperature look nice 
if($weather["temp_units"]=='C' && $weather["dewpoint"]<-10){echo '<div class=outsideminus10>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<-5){echo '<div class=outsideminus5>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<0){echo '<div class=outsidezero>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<5){echo '<div class=outside0-5>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<10){echo '<div class=outside6-10>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<15){echo '<div class=outside11-15>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<20){echo '<div class=outside16-20>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<25){echo '<div class=outside21-25>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<30){echo '<div class=outside26-30>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<35){echo '<div class=outside31-35>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<40){echo '<div class=outside36-40>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<45){echo '<div class=outside41-45>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='C' && $weather["dewpoint"]<100){echo '<div class=outside50>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}

//Fahrenheit
if($weather["temp_units"]=='F' && $weather["dewpoint"]<14){echo '<div class=outsideminus10>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<23){echo '<div class=outsideminus5>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<32){echo '<div class=outsidezero>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<41){echo '<div class=outside0-5>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<50){echo '<div class=outside6-10>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<59){echo '<div class=outside11-15>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<68){echo '<div class=outside16-20>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<77){echo '<div class=outside21-25>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<86){echo '<div class=outside26-30>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<95){echo '<div class=outside31-35>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<104){echo '<div class=outside36-40>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<113){echo '<div class=outside41-45>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
else if($weather["temp_units"]=='F' && $weather["dewpoint"]<212){echo '<div class=outside50>'.number_format($weather["dewpoint"],1).'<smalltempunit>&deg;'.$weather["temp_units"];}
?>
</div></smalltempunit>
</div></div>



<div class="heatcircle"><div class="heatcircle-content">
<?php  //dewpoint max Year
echo "<valuetextheading1>".date('Y')." Max <blue>".$weather["dewymaxtime"]."</blue></valuetextheading1><br>";
if ($weather["dewymax"]>24) {
echo "
<div class=tempconverter1><div class=tempmodulehome25-30c>".$weather["dewymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["dewymax"]>19) {
echo "
<div class=tempconverter1><div class=tempmodulehome20-25c>".$weather["dewymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}
    

else if ($weather["dewymax"]>10) {
echo "
<div class=tempconverter1><div class=tempmodulehome10-15c>".$weather["dewymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}  

else if ($weather["dewymax"]>7) {
echo "
<div class=tempconverter1><div class=tempmodulehome5-10c>".$weather["dewymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["dewymax"]>-50) {
echo "
<div class=tempconverter1><div class=tempmodulehome0-5c>".$weather["dewymax"]."&deg;<smalltempunit2>".$weather["temp_units"];}

?><smalltempunit2></div></div></div>

<div class="heatcircle2"><div class="heatcircle-content">
<?php  //dewpoint min year
echo "<valuetextheading1>".date('Y')." Min <blue>".$weather["dewymintime"]."</blue></valuetextheading1><br>";
if ($weather["dewymin"]>24) {
echo "
<div class=tempconverter1><div class=tempmodulehome25-30c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["dewymin"]>19) {
echo "
<div class=tempconverter1><div class=tempmodulehome20-25c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}
    

else if ($weather["dewymin"]>10) {
echo "
<div class=tempconverter1><div class=tempmodulehome10-15c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}  

else if ($weather["dewymin"]>7) {
echo "
<div class=tempconverter1><div class=tempmodulehome5-10c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["dewymin"]>2) {
    echo "
    <div class=tempconverter1><div class=tempmodulehome0-5c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

else if ($weather["dewymin"]>-50) {
echo "
<div class=tempconverter1><div class=tempmodulehome-10-0c>".$weather["dewymin"]."&deg;<smalltempunit2>".$weather["temp_units"];}

?>
</smalltempunit2></div></div>

<div class="thetrendgap">
<?php 
//falling
if($weather["dewpoint_trend"]<0){echo '<div class=thetrendboxblue>'.$lang['Falling'].'';echo '&nbsp;'.$fallingsymbolx.'&nbsp; '.number_format($weather["dewpoint_trend"],1).'&deg;';}
//rising
else if($weather["dewpoint_trend"]>0){echo '<div class=thetrendboxorange>'.$lang['Rising'].'';echo '&nbsp;'.$risingsymbolx.'&nbsp; + '.number_format($weather["dewpoint_trend"],1).'&deg;';}
//steady
else echo '<div class=thetrendboxblue>'.$lang['Steady'].''.$steadysymbol.'';?>
</div></div></div></div>