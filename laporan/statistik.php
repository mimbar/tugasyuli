<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../plugin/bs/css/bootstrap.min.css">
	
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12"><center><h1>Laporan Statistik</h1></center></div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div id="canvas-holder">
					<canvas id="myChart" />
				</div>
			</div>
			<div class="col-md-4">
				<div id="canvas-holder">
					<canvas id="chart-area" />
				</div>
			</div>
			<div class="col-md-4">
				<div id="canvas-holder">
					<canvas id="chart-area" />
				</div>
			</div>
		</div>
	</div>












	<script src="../plugin/jquery.min.js"></script> 
	<script src="../plugin/chart.bundle.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../plugin/Chart.PieceLabel.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};

		$.ajax({
			type: 'POST',
			url: 'backend/jumlah_diterima.php',
			success: function (data) {
				lineChartData = data;
				alert(JSON.stringify(data));
				var ctx = document.getElementById('myChart').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: ["January", "February", "March", "April", "May", "June", "July"],
						datasets: [{
							label: "Status Pengajuan",
							backgroundColor: [
							window.chartColors.red,
							window.chartColors.orange,
							window.chartColors.yellow,
							window.chartColors.green,
							window.chartColors.blue,
							window.chartColors.green,
							window.chartColors.blue,
							],
							data: [6, 10, 5, 2, 20, 30, 45],
						}]
					},


					options: {
						pieceLabel: {
							mode: 'percentage',
							precision: 2
						}
					}
				});
			} 
		});


		



	</script>

</body>
</html>