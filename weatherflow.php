<?php  

	####################################################################################################
	#	CREATED FOR HOMEWEATHERSTATION MB SMART TEMPLATE 											   #
	# https://weather34.com/homeweatherstation/index.html 											   # 
	# 	                                                                                               #
	# 	Release: July 2019						  	                                                   #
	# 	                                                                                               #
	#   https://www.weather34.com 	                                                                   #
	####################################################################################################

error_reporting(0);include('settings.php');
$section = file_get_contents('https://swd.weatherflow.com/swd/rest/observations/device/'.$weatherflowdairID.'?api_key='.$somethinggoeshere.'');file_put_contents('jsondata/weatherflow1.txt',$section);
$section1 = file_get_contents('https://swd.weatherflow.com/swd/rest/observations/station/'.$weatherflowID.'?api_key='.$somethinggoeshere.'');file_put_contents('jsondata/weatherflow.txt',$section1);
?>