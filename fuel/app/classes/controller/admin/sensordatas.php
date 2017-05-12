<?php
class Controller_Admin_Sensordatas extends Controller_Admin
{

	public function action_index()
	{

		$total = Model_Sensordata::count();

		$config = array(
		        'pagination_url' => 'admin/sensordatas/index',
		        'uri_segment' => 3,
		        'per_page' => 100,
		        'total_items' => $total
		);

		$pagination = Pagination::forge('mypagination', $config);		

		//$data['sensordatas'] = Model_Sensordata::find('all');
		$data['sensordatas'] = Model_Sensordata::find('all',array(
						'order_by' => array(
							'created_at' => 'desc'
						),
						'limit' => $pagination->per_page,
						'offset' => $pagination->offset
					)
				);

		$this->template->title = "Sensordatas";
		$this->template->content = View::forge('admin/sensordatas/index', $data);

	}

	public function action_view($id = null)
	{
		$data['sensordata'] = Model_Sensordata::find($id);

		$this->template->title = "Sensordata";
		$this->template->content = View::forge('admin/sensordatas/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
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
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Sensordatas";
		$this->template->content = View::forge('admin/sensordatas/create');

	}

	public function action_edit($id = null)
	{
		$sensordata = Model_Sensordata::find($id);
		$val = Model_Sensordata::validate('edit');

		if ($val->run())
		{
			$sensordata->sensorid = Input::post('sensorid');
			$sensordata->temperature = Input::post('temperature');
			$sensordata->humidity = Input::post('humidity');

			if ($sensordata->save())
			{
				Session::set_flash('success', e('Updated sensordata #' . $id));

				Response::redirect('admin/sensordatas');
			}

			else
			{
				Session::set_flash('error', e('Could not update sensordata #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$sensordata->sensorid = $val->validated('sensorid');
				$sensordata->temperature = $val->validated('temperature');
				$sensordata->humidity = $val->validated('humidity');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('sensordata', $sensordata, false);
		}

		$this->template->title = "Sensordatas";
		$this->template->content = View::forge('admin/sensordatas/edit');

	}

	public function action_delete($id = null)
	{
		if ($sensordata = Model_Sensordata::find($id))
		{
			$sensordata->delete();

			Session::set_flash('success', e('Deleted sensordata #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete sensordata #'.$id));
		}

		Response::redirect('admin/sensordatas');

	}

}
