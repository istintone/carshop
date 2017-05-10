<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Sensorid', 'sensorid', array('class'=>'control-label')); ?>

				<?php echo Form::input('sensorid', Input::post('sensorid', isset($sensordata) ? $sensordata->sensorid : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Sensorid')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Temperature', 'temperature', array('class'=>'control-label')); ?>

				<?php echo Form::input('temperature', Input::post('temperature', isset($sensordata) ? $sensordata->temperature : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Temperature')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Humidity', 'humidity', array('class'=>'control-label')); ?>

				<?php echo Form::input('humidity', Input::post('humidity', isset($sensordata) ? $sensordata->humidity : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Humidity')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>