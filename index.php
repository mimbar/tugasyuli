<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Sistem Pendukung Keputusan Penentuan Pemberian Kredit</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/paging.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/tables.css" type="text/css" media="all" />
</head>
<body>
<!-- Shell -->
<div id="shell">
	
	<!-- Header -->
	<div id="header">
		<h1><a href="#"></a></h1>
		<div class="right">
			<?php
			include "config/fungsi_alert.php";
			if (!empty($_SESSION['username']) && !empty($_SESSION['password'])){
			?>
			<p>
			<p>
			<p>
			<p>
			<p>
			<p>
			<p><p class="small-nav"><a href="?module=password">Ganti Password</a> / <a href="JavaScript: confirmIt('Anda yakin akan logout dari aplikasi ?','logout.php','','','','u','n','Self','Self')" onMouseOver="self.status=''; return true" onMouseOut="self.status=''; return true">Keluar</a></p>
			<?php
			}
			?>
		</div>
	</div>
	<!-- End Header -->
	<?php
	if (!empty($_SESSION['username']) && !empty($_SESSION['password'])){
	?>
	<!-- Navigation -->
	<div id="navigation">
		<ul>
		    <?php include "menu.php"; ?>
		</ul>
	</div>
	<!-- End Navigation -->
	<?php
	}
	?>
	<!-- Content -->
	<div id="content">

		<?php include "content.php"; ?>
	
	</div>
	
	<!-- End Content -->
</div>
<!-- End Shell -->

<!-- Footer -->
<div id="footer">
	<p>&copy; 2017 - BUMDes Rejasari</a></p>
</div>
<!-- End Footer -->
</body>
</html>