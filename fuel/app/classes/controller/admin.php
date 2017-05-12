<?php

class Controller_Admin extends Controller_Base
{
	public $template = 'admin/template';

	public function before()
	{
		parent::before();

		if (Request::active()->controller !== 'Controller_Admin' or ! in_array(Request::active()->action, array('login', 'logout')))
		{
			if (Auth::check())
			{
				$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
				if ( ! Auth::member($admin_group_id))
				{
					Session::set_flash('error', e('You don\'t have access to the admin panel'));
					Response::redirect('/');
				}
			}
			else
			{
				Response::redirect('admin/login');
			}
		}
	}

	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('admin');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				if ( ! Auth::check())
				{
					if (Auth::login(Input::post('email'), Input::post('password')))
					{
						// assign the user id that lasted updated this record
						foreach (\Auth::verified() as $driver)
						{
							if (($id = $driver->get_user_id()) !== false)
							{
								// credentials ok, go right in
								$current_user = Model\Auth_User::find($id[1]);
								Session::set_flash('success', e('Welcome, '.$current_user->username));
								Response::redirect('admin');
							}
						}
					}
					else
					{
						$this->template->set_global('login_error', 'Login failed!');
					}
				}
				else
				{
					$this->template->set_global('login_error', 'Already logged in!');
				}
			}
		}

		$this->template->title = 'Login';
		$this->template->content = View::forge('admin/login', array('val' => $val), false);
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		Auth::logout();
		Response::redirect('admin');
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{

		$view_data = array();


		$view_data['hourly_ave'] = $this->getHourlyData(1);
		$view_data['hourly_ave_yesterday'] = $this->getHourlyData(2);


		$this->template->title = 'Dashboard';
		$this->template->content = View::forge('admin/dashboard',$view_data);
	}

	
	private function getHourlyData($hour=1){
	
		$min = 60;
		$start_time = $min * $hour;
		$end_time = $start_time -59;

		$hourly_average = \Model_Sensordata_Average_Min::find('all', array(
			"where" => array(
				array("aggregated_at","between",
					array(
						date("Y-m-d H:i:00",strtotime("-{$start_time} minute")),
						date("Y-m-d H:i:59",strtotime("-{$end_time} minute"))
					)
				),
			),
			"order_by" => array("aggregated_at" => "desc"),
		));
		
		return $hourly_average;
	}
}

/* End of file admin.php */
