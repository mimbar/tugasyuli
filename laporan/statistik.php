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
			<div class="col-md-6">
				<center><h3>Jumlah Pengajuan</h3></center>
				<div id="canvas-holder">
					<canvas id="chartpendaftar" />
				</div>
			</div>

			<div class="col-md-6">
				<center><h3>Pinjaman Terbayar</h3></center>
				<div id="canvas-holder">
					<canvas id="chartpinjamanterbayar" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<center><h3>Pembayaran Angsuran</h3></center>
				<div id="canvas-holder">
					<canvas id="chartpembayaranangsuran" />
				</div>
			</div>
		</div>











	</div>

	<script src="../plugin/jquery.min.js"></script> 
	<script src="../plugin/chart.bundle.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../plugin/Chart.PieceLabel.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../plugin/gauge.min.js" type="text/javascript" charset="utf-8"></script>
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
				var datanacoy = JSON.parse(data);
				var ctx = document.getElementById('chartpendaftar').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: datanacoy.labels,
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
							data: datanacoy.datas,
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

		$.ajax({
			type: 'POST',
			url: 'backend/jumlah_angsuran.php',
			success: function (data) {
				lineChartData = data;
				var hasil = JSON.parse(data);
				var ctx = document.getElementById('chartpembayaranangsuran').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: hasil.labels,
						datasets: [{
							label: "Jumlah Pembayaran Angsuran",
							fill: false,
							borderColor: window.chartColors.red,
							backgroundColor: [
							window.chartColors.red
							],
							data: hasil.datas,
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

		var opts = {
			angle: 0.000013, 
			lineWidth: 0.1, 
			radiusScale: 1, 
			pointer: {
				length: 0.6,
				strokeWidth: 0.035, 
				color: '#FFFFFF' 
			},
			limitMax: false,     
			limitMin: false,     
			colorStart: 'rgb(255, 99, 132)',   
			colorStop: 'rgb(255, 99, 132)',    
			strokeColor: '#EEEEEE',  
			generateGradient: false,
			highDpiSupport: true     
		};
		var target = document.getElementById('chartpinjamanterbayar'); 
		var gauge = new Donut(target).setOptions(opts); 
		gauge.maxValue = 1000;
		gauge.setMinValue(0);  
		gauge.animationSpeed = 32; 
		gauge.set(500); 





	</script>

</body>
</html>