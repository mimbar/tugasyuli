<?php
use Medoo\Medoo;

$server = "localhost";
$username = "root";
$password = "";
$database = "kredit";

$conn = mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

?>