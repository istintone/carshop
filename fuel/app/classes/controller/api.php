<?php

class Controller_Api extends Controller_Rest
{

	public function action_write()
	{

		$val = Model_Sensordata::validate('create');
		if ($val->run())
		{
			$sensordata = Model_Sensordata::forge(array(
				'sensorid' => Input::post('sensorid'),
				'temperature' => Input::post('temperature'),
				'humidity' => Input::post('humidity'),
				));

			if ($sensordata and $sensordata->save())
			{
				Session::set_flash('success', e('Added sensordata #'.$sensordata->id.'.'));
				Response::redirect('admin/sensordatas');
			}
			else
			{
				Session::set_flash('error', e('Could not save sensordata.'));
			}
		}	
	}
}
