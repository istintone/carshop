<?php

namespace Fuel\Migrations;

class Create_sensors
{
	public function up()
	{
		\DBUtil::create_table('sensors', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'sensorid' => array('constraint' => 50, 'type' => 'varchar'),
			'use_flg' => array('type' => 'smallint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		\DBUtil::create_index('sensors', 'sensorid', 'idx1');
	}

	public function down()
	{
		\DBUtil::drop_table('sensors');
	}
}
