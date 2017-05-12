<?php
namespace  Fuel\Tasks;

class Aggregatemin
{
    public function run()
    {
	//集計時間は誤差を懸念
	$target_time = strtotime("-2 minute");

	$count = 0;
	$temperature = 0;
	$humidity = 0;
	
	$sensordatas = \Model_Sensordata::find('all', array(
			"where" => array(
				array("created_at", 
					"between",
					array( 
						strtotime(date("Y-m-d H:i:00",$target_time)),  
						strtotime(date("Y-m-d H:i:59",$target_time))
					)
				),
			),
		)
	);

	foreach ($sensordatas as $value) {
		// echo $value['id']."\n";
		
		$temperature += $value['temperature'];
		$humidity += $value['humidity'];
	
		$count++;

	}

	//echo $count;
	//echo $temperature;
	//echo $humidity;

	$sensordata = \Model_Sensordata_Average_Min::forge(array(
		'aggregated_at' => date("Y-m-d H:i:00",$target_time),
		'temperature' => round(($temperature / $count),1),
		'humidity' => ($humidity / $count),
		));

	if ($sensordata and $sensordata->save())
	{
		//success!!
	}
    }
}
