<h2>Listing Sensordatas</h2>
<br>
<?php if ($sensordatas): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Sensorid</th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th>SendDate</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($sensordatas as $item): ?>		<tr>

			<td><?php echo $item->sensorid; ?></td>
			<td><?php echo $item->temperature; ?>℃</td>
			<td><?php echo $item->humidity; ?>%</td>
			<td><?php echo date("Y/m/d H:i:s", $item->created_at); ?></td>
			<td>
				<?php echo Html::anchor('admin/sensordatas/view/'.$item->id, 'View'); ?> 
				<!--
				<?php echo Html::anchor('admin/sensordatas/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/sensordatas/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				-->
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php echo Pagination::instance('mypagination')->render(); ?>

<?php else: ?>
<p>No Sensordatas.</p>

<?php endif; ?><p>
<!--
	<?php echo Html::anchor('admin/sensordatas/create', 'Add new Sensordata', array('class' => 'btn btn-success')); ?>
-->
</p>
