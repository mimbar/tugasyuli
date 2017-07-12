<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../plugin/chartist/chartist.min.css">
	<link rel="stylesheet" href="../plugin/bs/bootstrap.min.css">
	
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-md-4"><canvas class="myChart" width="100" height="100"></canvas></div>
		<div class="col-md-4"><canvas class="myChart" width="100" height="100"></canvas></div>
		<div class="col-md-4"><canvas class="myChart" width="100" height="100"></canvas></div>
		</div>
	</div>
	











	<script src="../plugin/jquery.min.js"></script> 
	<script src="../plugin/chart.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		var ctx = document.getElementsByClassName('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'pie',

			data: {
				labels: ["January", "February", "March", "April", "May", "June", "July"],
				datasets: [{
					label: "My First dataset",
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [0, 10, 5, 2, 20, 30, 45],
				}]
			},

    // Configuration options go here
    options: {}
});




</script>

</body>
</html>