<?php
namespace  Fuel\Tasks;

class Aggregatehour
{
    public function run()
    {
	//集計時間は誤差を懸念
	$target_time = strtotime("-2 hour");

	$count = 0;
	$temperature = 0;
	$humidity = 0;
	
	$sensordatas = \Model_Sensordata_Average_Min::find('all', array(
			"where" => array(
				array("aggregated_at", 
					"between",
					array( 
						date("Y-m-d H:00:00",$target_time),  
						date("Y-m-d H:59:59",$target_time)
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

	$sensordata = \Model_Sensordata_Average_Hour::forge(array(
		'aggregated_at' => date("Y-m-d H:00:00",$target_time),
		'temperature' => round(($temperature / $count),1),
		'humidity' => ($humidity / $count),
		));

	if ($sensordata and $sensordata->save())
	{
		//success!!
	}

    }
}
