<?php include('livedata.php');?>
<div
style="position:relative;left:-60px;-webkit-border-radius:3px;-moz-border-radius:3px;-o-border-radius:3px;border-radius:3px;background:rgba(74, 99, 111, 0.1);
padding:5px;
font-family:Headingtext;width:180px;height:13px;font-size:13px;padding-top:2px;color:#aaa;
align-items:left;justify-content:left;margin-bottom:-5px;top:-20px">
Average 10 min Speed <blue><?php echo $weather["wind_units"]?></blue></div>
<div class="tempcontainer" style="left:-60px;">
<?php 
if ($weather["wind_speed"]>50){echo "<div class='maxdatawind'>Gale Force Winds</div>";}
if ($weather["wind_speed"]>40){echo "<div class='maxdatawind'>Storm Winds</div>";}
if ($weather["wind_speed"]>30){echo "<div class='maxdatawind'>Very Windy</div>";}
else if ($weather["wind_speed"]>20){echo "<div class='maxdatawind'>Moderate Winds</div>";}
else if ($weather["wind_speed"]>10){echo "<div class='maxdatawind'>Breezy Conditions</div>";}
else if ($weather["wind_speed"]>0){echo "<div class='maxdatawind'>Relatively Calm</div>";}

?> 

<?php echo "<div class='hidata'></div>";?> 

<?php //weather34 sez lets make the temperature look nice 
if( $weather["wind_speed"]<5){echo '<div class=windbox style="color:#3b9cac">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<10){echo '<div class=windbox style="color:#9aba2f">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<20){echo '<div class=windbox style="color:#e6a141;">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<35){echo '<div class=windbox style="color:#ec5a34;">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<40){echo '<div class=windbox style="color:#d05f2d;">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<75){echo '<div class=windbox style="color:#d65b4a;">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
else if( $weather["wind_speed"]<150){echo '<div class=windbox style="color:#d05f2d;"">'.number_format($weather["wind_speed"],1).'<smalltempunit>'.$weather["wind_units"];}
?>
</div></smalltempunit2>
</div></div>

<div class="heatcircle" ><div class="heatcircle-content">
<?php 
//windchill offline with real feel 
echo "<valuetextheading1>Wind Run</valuetextheading1><br><div class=tempconverter1><div class=tempmodulehome0-5c>".$weather["windrun34"]."<smalltempunit2>".$distanceunit;

?><smalltempunit2></div></div></div>


<div class="heatcircle2"><div class="heatcircle-content"><valuetextheading1>Average Today</valuetextheading1>
<?php //avg today
echo "<div class=tempconverter1><div class=tempmodulehome0-5c>". $weather["wind_speed_avg30"]."<smalltempunit2>". $weather["wind_units"]."</smalltempunit2>";
?>
</smalltempunit2></div></div></div></div></div>