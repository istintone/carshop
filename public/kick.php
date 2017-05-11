<?php


class ApiKicker
{ 

	const URL = "http://localhost/api/write";

	const ID_MIN_VALUE = 1;
	const ID_MAX_VALUE = 10000;

	const TEM_MIN_VALUE = 10;
	const TEM_MAX_VALUE = 500;

	const HUM_MIN_VALUE = 0;
	const HUM_MAX_VALUE = 100;	


	function kick($num=1){
 
		$curl=curl_init(ApiKicker::URL);
		$count = 0;
		while ($count < $num){
			$sensorid = rand(ApiKicker::ID_MIN_VALUE, ApiKicker::ID_MAX_VALUE);
			$temperature = rand(ApiKicker::TEM_MIN_VALUE, ApiKicker::TEM_MAX_VALUE) * 0.1;
			$humidity = rand(ApiKicker::HUM_MIN_VALUE, ApiKicker::HUM_MAX_VALUE);

			//echo $sensorid."--".$temperature."--".$humidity."<br>";
			
			$POST_DATA = array(
				'sensorid' => "CENTER-".$sensorid,
				'temperature' => $temperature,
				'humidity' => $humidity
			);

			$curl=curl_init(ApiKicker::URL);		
			curl_setopt($curl,CURLOPT_POST, TRUE);
			//curl_setopt($curl,CURLOPT_POSTFIELDS, $POST_DATA);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($POST_DATA));
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE); 
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, FALSE);   
			curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
			//curl_setopt($curl,CURLOPT_COOKIEJAR,      'cookie');
			//curl_setopt($curl,CURLOPT_COOKIEFILE,     'tmp');
			curl_setopt($curl,CURLOPT_FOLLOWLOCATION, TRUE); 
			//curl_setopt($curl,CURLOPT_REFERER,        "REFERER");
			//curl_setopt($curl,CURLOPT_USERAGENT,      "USER_AGENT"); 

			$output= curl_exec($curl);
	
			$count++;
		}
	}

}

ApiKicker::kick(30);


?>
