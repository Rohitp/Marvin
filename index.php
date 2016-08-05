<?php
include('dump.php');
?>

<html>
<head>
	<script src="js/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="js/amcharts/plugins/responsive/responsive.min.js" type="text/javascript"></script>
	<script src="js/worldcoords.js" type="text/javascript"></script>
	<script src="js/amcharts/themes/light.js" type="text/javascript"></script>
	<link rel="stylesheet" href="js/ammap/ammap.css" type="text/css">
	<script src="js/ammap/ammap.js" type="text/javascript"></script>
	<script src="js/ammap/maps/js/worldLow.js" type="text/javascript"></script>

	<script type="text/javascript">

		var map = AmCharts.makeChart( "chartdiv", {
			type: "map",
			"theme": "light",

			colorSteps: 30,

			dataProvider: {
				map: "worldLow",
				areas: [ {
					id: "IN",
					value: -8
				}, {
					id: "AU	",
					value: 45
				}, {
					id: "US",
					value: 12
				} ]
			},

			areasSettings: {
				autoZoom: false
			},

			zoomControl: {
				zoomControlEnabled:false,
				panControlEnabled:false
			},

			"export": {
				"enabled": false
			}

	} );

	</script>

	<style>
	#chartdiv {
		margin: auto;
	 	width: 50%;
	}

	</style>
</head>
<body>
	<div id="chartdiv" style="width: 800px; height: 600px;"></div>



</body>
</html>
