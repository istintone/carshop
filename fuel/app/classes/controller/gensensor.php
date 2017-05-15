<?php

class Controller_Gensensor extends Controller_Rest
{

	public function action_gen()
	{

		$number = 1;

		\DBUtil::truncate_table('sensors');

		while($number <= 10000){
			$sensor = Model_Sensor::forge(array(
				'sensorid' => "CENTER-{$number}",
				'use_flg' => 1,
				));

			if ($sensor and $sensor->save())
			{
				//Session::set_flash('success', e('Added sensor #'.$sensor->id.'.'));
			}
			else
			{
				//Session::set_flash('error', e('Could not save sensor.'));
			}
			$number++;
		}
	}
}
