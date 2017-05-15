<?php

class Controller_Api extends Controller_Rest
{

	public function action_write()
	{

		$val = Model_Sensordata::validate('create');
		if ($val->run())
		{
			//TODO:check sensors exist

			$data['sensors'] = Model_Sensor::find('all',array(
				'where' => array(
						array('sensorid', Input::post('sensorid')),
						array('use_flg', 1)
					)
				));
			//Log::info(var_dump($data));
			if(count($data['sensors']))
			{
				//TODO: insert mongodb
				$sensordata = Model_Sensordata::forge(array(
					'sensorid' => Input::post('sensorid'),
					'temperature' => Input::post('temperature'),
					'humidity' => Input::post('humidity'),
					));

				if ($sensordata and $sensordata->save())
				{
					//Session::set_flash('success', e('Added sensordata #'.$sensordata->id.'.'));
				}
				else
				{
					//Session::set_flash('error', e('Could not save sensordata.'));
				}
			}
		}	
	}
}
