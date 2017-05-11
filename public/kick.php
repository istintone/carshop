<?php


class ApiKicker
{ 
	const ID_MIN_VALUE = 1;
	const ID_MAX_VALUE = 10000;

	const TEM_MIN_VALUE = 10;
	const TEM_MAX_VALUE = 500;

	const HUM_MIN_VALUE = 0;
	const HUM_MAX_VALUE = 100;	

	function kick30(){
 
		$count = 0;
		while ($count < 30){
			$sensorid = rand(ApiKicker::ID_MIN_VALUE, ApiKicker::ID_MAX_VALUE);
			$temperature = rand(ApiKicker::TEM_MIN_VALUE, ApiKicker::TEM_MAX_VALUE) * 0.1;
			$humidity = rand(ApiKicker::HUM_MIN_VALUE, ApiKicker::HUM_MAX_VALUE);

echo $sensorid."--".$temperature."--".$humidity."<br>";
			$count++;
		}
	}

}

ApiKicker::kick30();


?>
