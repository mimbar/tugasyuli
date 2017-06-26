<?php
// error_reporting(0);
session_start();
$id = $_GET['id'];
include "config/koneksi.php";
include "pdf/mpdf.php";
$sql="SELECT * FROM v_tb_pinjaman where kode_pinjaman=$id";
$query = mysql_query($sql);
while ($r = mysql_fetch_array($query)) {
  $no_ktp = $r['no_ktp'];
  $nama = $r['nama'];
  $tgl_pinjaman = date("d-m-Y", strtotime($r['tgl_pinjaman']));
  $total_pinjaman = number_format($r['total_pinjaman'],0,",",".");
  $angsuran = number_format($r['angsuran'],0,".",".");
  $lama_pinjaman = $r['lama_pinjaman'];
}

$html = '<table style="width: 50%">
<tbody>
  <tr>
    <td>No. KTP</td>
    <td>'.$no_ktp.'</td>
  </tr>
  <tr>
    <td>Nama Peminjam</td>
    <td>'.$nama.'</td>
  </tr>
  <tr>
    <td>Tanggal Cair</td>
    <td>'.$tgl_pinjaman.'</td>
  </tr>
  <tr>
    <td>Jumlah Pinjaman</td>
    <td>'.$total_pinjaman.'</td>
  </tr>
  <tr>
    <td>Angsuran</td>
    <td>'.$angsuran.'</td>
  </tr>
  <tr>
    <td>Jangka Waktu</td>
    <td>'.$lama_pinjaman.'</td>
  </tr>
</tbody>
</table>
<br><br><br>
<table style="border-collapse: collapse;width: 100%;border: 1px solid black" border="1" >
  <tbody>
    <tr>
      <td style="text-align:center">No</td>
      <td style="text-align:center">Tanggal</td>
      <td style="text-align:center">Pokok</td>
      <td style="text-align:center">Bunga</td>
      <td style="text-align:center">Denda</td>
      <td style="text-align:center">Simpanan</td>
      <td style="text-align:center">Jumlah</td>
      <td style="text-align:center">Paraf</td>
    </tr>';

    $sql="SELECT * FROM v_tb_angsuran where kode_pinjaman=$id";
    $query = mysql_query($sql);
    $no=1;
    while ($r = mysql_fetch_array($query)) {
      $tgl_angsuran = date("d-m-Y", strtotime($r['tgl_angsuran']));
      $angsuran = number_format($r['angsuran'],0,",",".");
      $nilai_bunga = number_format($r['nilai_bunga'],0,",",".");
      $denda = number_format($r['denda'],0,".",".");
      $jumlah = number_format($r['angsuran'] + $r['nilai_bunga'] + $r['denda'],0,".",".");

      $html .= '<tr>
      <td style="text-align:center">'.$no.'</td>
      <td>'.$tgl_angsuran.'</td>
      <td>'.$angsuran.'</td>
      <td>'.$nilai_bunga.'</td>
      <td>'.$denda.'</td>
      <td>0</td>
      <td>'.$jumlah.'</td>
      <td>&nbsp;</td>
    </tr>
    ';
    $no++;
  }


  $html.='</tbody>
</table>';

$pdf = new MPDF();
$pdf->AddPage();
$pdf->SetHTMLHeader('<img src="images/header.png"/>');
$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML($html);
$pdf->Output();
?>