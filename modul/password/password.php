<?php
switch($_GET[act]){
default:
echo "<h6 class='orange'>Ubah Password</h6>
		<form method='post' action='?module=password&act=updatepassword'>
		<table>
		<tr><td width=200>Masukkan password lama</td><td><input type='password' name='oldPass' /></td></tr>
		<tr><td>Masukkan password baru</td><td><input type='password' name='newPass1' /></td></tr>
		<tr><td>Masukkan kembali password baru</td><td><input type='password' name='newPass2' /></td></tr>
		<tr><td></td><td>
		<input type=submit name=submit title='Simpan' alt='Simpan' value='Simpan' />
		<input type='hidden' name='pass' value='".$_SESSION[password]."'>
		<input type='hidden' name='nama' value='".$_SESSION[username]."'></td></tr>
		</table>		
		</form>";
break;

case "updatepassword":

include "config/koneksi.php";

$user = $_POST['nama'];
$passwordlama = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];
$level = $_SESSION['level'];
if ($level == "admin"){
$query = "SELECT * FROM admin WHERE username = '$user'";
}elseif ($level == "kades"){
$query = "SELECT * FROM kepaladesa WHERE username = '$user'";
}
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['password'] ==  md5($passwordlama))
{
	if ($passwordbaru1 == $passwordbaru2)
	{
		$passwordbaruenkrip = md5($passwordbaru1);
		if ($level == "admin"){
		$query = "UPDATE admin SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		}elseif ($level == "kades"){
		$query = "UPDATE kepaladesa SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		}
		$hasil = mysql_query($query);
		
		if ($hasil) echo "<h6 class='orange'>Ubah Password</h6><p><br>Update password sukses</p>";
	}
	else echo "<h6 class='orange'>Ubah Password</h6><p><br>Password baru Anda tidak sama</p>";
}
else echo "<h6 class='orange'>Ubah Password</h6><p><br>Password lama Anda salah</p>";
break;
}
?>