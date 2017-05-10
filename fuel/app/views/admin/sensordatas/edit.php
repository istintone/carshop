<h2>Editing Sensordata</h2>
<br>

<?php echo render('admin/sensordatas/_form'); ?>
<p>
	<?php echo Html::anchor('admin/sensordatas/view/'.$sensordata->id, 'View'); ?> |
	<?php echo Html::anchor('admin/sensordatas', 'Back'); ?></p>
