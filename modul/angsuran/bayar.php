<?php
$kode_pinjaman = $_GET['kode_pinjaman'];
$pembayaran = mysql_query("SELECT * FROM v_tb_angsuran where kode_pinjaman = $kode_pinjaman");
if (!$pembayaran) {
  die('Invalid query: ' . mysql_error());
}

$detail = mysql_query("SELECT * FROM v_tb_pinjaman where kode_pinjaman = $kode_pinjaman");
$detail2 = mysql_query("SELECT * FROM tb_angsuran where kode_pinjaman = $kode_pinjaman");
$kalibayar = mysql_num_rows($detail2);
while ($r=mysql_fetch_array($detail)){
  $nama               = $r['nama'];
  $besar_pinjaman     = $r['besar_pinjaman'];
  $lama_pinjaman      = $r['lama_pinjaman'];
  $angsuran           = $r['angsuran'];
}
if (!$detail) {
  die('Invalid query: ' . mysql_error());
}
?>
<h6 class='orange'>Tambah Pinjaman</h6>
<form name=text_form method=POST action='modul/angsuran/aksi_angsuran.php?module=angsuran&act=bayar' onsubmit='return Blank_TextField_Validator()'>
  <table>
    <tr><td>Nama Peminjam</td>   <td> : <?php echo $nama ?></tr>
    <tr><td>Besar Pinjaman</td>   <td> : <?php echo $besar_pinjaman ?></td></tr>
    <tr><td>Besar Angsuran</td>   <td> : <?php echo $angsuran ?></td></tr>
    <tr><td>Lama Angsuran</td>   <td> : <?php echo $lama_pinjaman ?></td></tr>
    <tr><td>Sisa Pinjaman</td>   <td> : <?php echo $lama_pinjaman-$kalibayar; ?></td></tr>
    <tr><td></td><td>
      <input type=hidden name=kode_pinjaman value='<?php echo $kode_pinjaman ?>' >
      <input type=hidden name=angsuran value='<?php echo $angsuran ?>' >
      <input type=hidden name=tgl_angsuran value='<?php echo date("Y-m-d"); ?>' >
      <input type=submit name=submit value='Simpan' >
    </td></tr>
  </table>
</form>

<table cellpadding='0' cellspacing='0'>
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Pinjam</th>
      <th>Angsuran</th>
      <th>Tanggal Bayar</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no=1;
    while ($r=mysql_fetch_array($pembayaran)){
      $tgl_angsuran = date("d-m-Y", strtotime($r['tgl_angsuran']));
      echo "<tr>
      <td align=center>$no</td>
      <td>$r[kode_pinjaman]</td>
      <td>$r[angsuran]</td>
      <td>$tgl_angsuran</td>
    </tr>";
    $no++;
  } 
  ?>

</tbody>
</table>
</h6>