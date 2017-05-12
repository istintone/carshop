<!-- highchart -->
<?php echo Asset::js("code/highcharts.js") ?>
<?php echo Asset::js("code/modules/exporting.js") ?>


<div class="jumbotron">
	<h2>Data Of Currently</h2>
	<div id="tem_charts"></div>
	<div id="hum_charts"></div>

</div>
<div class="row">
	<div class="col-md-4">
		<h2>Get Started</h2>
		<p>The controller generating this page is found at <code>APPPATH/classes/controller/admin.php</code>.</p>
		<p>This view can be found at <code>APPPATH/views/admin/dashboard.php</code>.</p>
		<p>You can modify these files to get your application started quickly.</p>
	</div>
	<div class="col-md-4">
		<h2>Learn</h2>
		<p>The best way to learn FuelPHP is reading through the <a href="http://docs.fuelphp.com">Documentation</a>.</p>
		<p>Another good resource is the <a href="http://fuelphp.com/forums">Forums</a>.  They are fairly active, and you can usually get a response quickly.</p>
	</div>
	<div class="col-md-4">
		<h2>Contribute</h2>
		<p>FuelPHP wouldn't exist without awesome contributions from the community.  Use the links below to get contributing.</p>
		<ul>
			<li><a href="http://docs.fuelphp.com/general/coding_standards.html">Coding Standards</a></li>
			<li><a href="http://github.com/fuel/fuel">GitHub Respository</a></li>
			<li><a href="http://fuelphp.com/contribute/issue-tracker">Issue Tracker</a></li>
		</ul>
	</div>
</div>
<?php 
	$tem_average_hourly_current = "";
	$hum_average_hourly_current = "";
	$average_time = "";
	$count = 1;
	foreach($hourly_ave as $value){
		$tem_average_hourly_current .= $value['temperature'].",";
		$hum_average_hourly_current .= $value['humidity'].",";
		$average_time .= $count.",";
		$count++;
	}

	$tem_average_hourly_yesterday = "";
	$hum_average_hourly_yesterday = "";
	foreach($hourly_ave_yesterday as $value){
		$tem_average_hourly_yesterday .= $value['temperature'].",";
		$hum_average_hourly_yesterday .= $value['humidity'].",";
	}
	
?>

<script type="text/javascript">

Highcharts.chart('tem_charts', {
	chart: {
		type: 'line'
	},
	title: {
		text: 'Hourly Average Temperature'
	},
	subtitle: {
		text: 'Source: 10000 sensor devices'
	},
	xAxis: {
		categories: [<?php echo $average_time; ?>]
	},
	yAxis: {
		title: {
			text: 'Temperature (°C)'
		}
	},
	plotOptions: {
		line: {
			dataLabels: {
				enabled: true
			},
			enableMouseTracking: false
		}
	},
	series: [{
		name: 'Currently',
		data: [<?php echo $tem_average_hourly_current; ?>]
	}, {
		name: 'Yesterday',
		data: [<?php echo $tem_average_hourly_yesterday; ?>]
	}]
});


Highcharts.chart('hum_charts', {
	chart: {
                type: 'area'
        },
        title: {
                text: 'Hourly Average Humidity'
        },
        subtitle: {
                text: 'Source: 10000 sensor devices'
        },
        xAxis: {
                categories: [<?php echo $average_time; ?>]
        },
        yAxis: {
                title: {
                        text: ' Humidity (%)'
                }
        },
        plotOptions: {
                line: {
                        dataLabels: {
                                enabled: true
                        },
                        enableMouseTracking: false
                }
        },
        series: [{
                name: 'Currently',
                data: [<?php echo $hum_average_hourly_current; ?>]
        }, {
                name: 'Yesterday',
                data: [<?php echo $hum_average_hourly_yesterday; ?>]
        }]
});
</script>

