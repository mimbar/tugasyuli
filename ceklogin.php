<?php
session_start();
include "config/koneksi.php";

$user=$_POST['username'];
$pass=md5($_POST['password']);


$login=mysql_query("select * from admin where username='$user' and password='$pass'");
$_SESSION[level] = "admin";

$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
if ($ketemu>0) {
		$_SESSION['nama'] = $r['nama'];
		$_SESSION['id_admin'] = $r['id_admin'];
		$_SESSION['username'] = $r['username'];
		$_SESSION['password'] = $r['password'];
	}
	
	
	header("location: index.php");
  echo "<center><br><b>LOGIN GAGAL!</b><br> 
        Username dan Password anda salah.<br><br>";
		echo "<div> <img src='css/images/seru.png'  height=147 width=176><br><br>
             </div>";
  echo "<input type=button class='tombol' value='ULANGI LAGI' onclick=location.href='index.php'></center>";

?>