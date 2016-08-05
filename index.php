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
	<script src="js/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript">

		var data1 = {
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
		};

		$.ajax({
					type : "POST",
					cache: false,
					url : "parse.php",
					success: function(data){
					// console.log(data);
					var mapData = {map : "worldLow", areas : data};
					console.log(mapData);
					console.log("Data 1");
					console.log(data1);
					drawMap(mapData);
					},
					error: function(error){
						console.log(error);
					}
		});

		// drawMap(data1);

		function drawMap(data) {
			var map = AmCharts.makeChart( "chartdiv", {
				type: "map",
				"theme": "light",

				colorSteps: 10,

				dataProvider: data,

				areasSettings: {
					autoZoom: false,
					color : "044704",
					colorSolid : "b2600c"
				},

				zoomControl: {
					zoomControlEnabled:false,
					panControlEnabled:false
				},



				"export": {
					"enabled": false
				}

		} );

}

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
