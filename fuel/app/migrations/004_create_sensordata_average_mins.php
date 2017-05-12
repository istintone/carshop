<?php

namespace Fuel\Migrations;

class Create_sensordata_average_mins
{
	public function up()
	{
		\DBUtil::create_table('sensordata_average_mins', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'aggregated_at' => array('type' => 'timestamp'),
			'temperature' => array('type' => 'float'),
			'humidity' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('sensordata_average_mins');
	}
}