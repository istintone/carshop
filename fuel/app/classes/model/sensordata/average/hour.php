<?php

class Model_Sensordata_Average_Hour extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'aggregated_at',
		'temperature',
		'humidity',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'sensordata_average_hours';

}
