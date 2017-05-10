<h2>Viewing #<?php echo $sensordata->id; ?></h2>

<p>
	<strong>Sensorid:</strong>
	<?php echo $sensordata->sensorid; ?></p>
<p>
	<strong>Temperature:</strong>
	<?php echo $sensordata->temperature; ?></p>
<p>
	<strong>Humidity:</strong>
	<?php echo $sensordata->humidity; ?></p>

<?php echo Html::anchor('admin/sensordatas/edit/'.$sensordata->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/sensordatas', 'Back'); ?>