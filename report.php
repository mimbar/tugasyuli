<?php
// error_reporting(0);
session_start();
$id = $_GET['id'];
$modul = $_GET['modul'];
include "config/koneksi.php";
include "pdf/mpdf.php";

switch ($modul) {
  case 'history':
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
      <td style="text-align:center">Angsuran</td>
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
      $denda = number_format($r['denda'],0,".",".");
      $jumlah = number_format($r['angsuran'] + $r['denda'],0,".",".");

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
$pdf->SetHTMLHeader('<img src="images/header.png"/>');
$pdf->AddPage('', // L - landscape, P - portrait 
  '', '', '', '',
        5, // margin_left
        5, // margin right
       60, // margin top
       30, // margin bottom
        0, // margin header
        0); // margin footer

$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML($html);
$pdf->Output();
break;

case 'penilaian':
require_once ( 'ahp.php' );

$kriteria=array();
$q="select * from kriteria order by id_kriteria";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
  $kriteria[]=array($h['id_kriteria'],$h['id_kriteria'],$h['nama_kriteria']);
}
$kk=array();
$q="select * from pemohon order by id_pemohon";
$q=mysql_query($q);
while($h=mysql_fetch_array($q)){
  $kk[]=array($h['id_pemohon'],$h['id_pemohon'],$h['nama']);
}

for($i=0;$i<count($kriteria);$i++){
  $id_kriteria[]=$kriteria[$i][0];
}
$matrik_kriteria = ahp_get_matrik_kriteria($id_kriteria);
$jumlah_kolom = ahp_get_jumlah_kolom($matrik_kriteria);
$matrik_normalisasi = ahp_get_normalisasi($matrik_kriteria, $jumlah_kolom);
$eigen_kriteria = ahp_get_eigen($matrik_normalisasi);

for($i=0;$i<count($kk);$i++){
  $id_kk[]=$kk[$i][0];
}
for($i=0;$i<count($kriteria);$i++){
  $matrik_kk = ahp_get_matrik_kk($kriteria[$i][0], $id_kk);
  $jumlah_kolom_kk = ahp_get_jumlah_kolom($matrik_kk);
  $matrik_normalisasi_kk = ahp_get_normalisasi($matrik_kk, $jumlah_kolom_kk);
  $eigen_kk[$i] = ahp_get_eigen($matrik_normalisasi_kk);
}

$nilai_to_sort = array();
mysql_query("truncate table nilai_hasil");
for($i=0;$i<count($kk);$i++){
  $nilai=0;
  for($ii=0;$ii<count($kriteria);$ii++){
    $nilai = $nilai + ( $eigen_kk[$ii][$i] * $eigen_kriteria[$ii]);
  }
  $idkk = $kk[$i][0];
  $nilai = round( $nilai , 4);
  $nilai_global[$i] = $nilai;
  $nilai_to_sort[] = array($nilai, $kk[$i][0]);
  mysql_query("INSERT INTO nilai_hasil(
    id_pemohon,nilai) 
    VALUES(
    '$idpemohon','$nilai')");
}

sort($nilai_to_sort);
for($i=0;$i<count($nilai_to_sort);$i++){
  $ranking[$nilai_to_sort[$i][1]]=(count($nilai_to_sort) - $i);
}



$html = "<table border='1' cellpadding='0' cellspacing='0'>
<thead>
  <tr>
    <th colspan='50'>HASIL PENILAIAN</th>
  </tr>
  <tr>
    <th>No KTP</th>
    <th>Nama Pemohon</th>";

    for($i=0;$i<count($kriteria);$i++){
      $html .= '<th style="text-align:center;">'.strtoupper($kriteria[$i][2]).'</th>';
    }

    $html .= '<th style="text-align:center;">NILAI</th>
    <th style="text-align:center;">REKOMENDASI</th>
  </tr>
</thead>
<tbody>';
  $counter = 1;
  for($i=0;$i<count($kk);$i++){
    if ($counter % 2 == 0) $warna = "light";
    else $warna = "dark";
    $html .= '
    <tr class="'.$warna.'">
      <td style="text-align:center;">'.($i+1).'</td>
      <td>'.$kk[$i][2].'</td>
      ';
      for($ii=0;$ii<count($kriteria);$ii++){
        $html .= '
        <td style="text-align:center;">'.$eigen_kk[$ii][$i].'</td>
        ';
        
      }
      $html .= '
      <td style="text-align:center;"><strong>'.$nilai_global[$i].'</strong></td>
      <td style="text-align:center;">'.$ranking[$kk[$i][0]].'</td>
    </tr>
    ';
    $counter++;
  }

  $html .= '</tbody>
</table>';
$pdf = new MPDF();
$pdf->SetHTMLHeader('<img src="images/header.png"/>');
$pdf->AddPage('', // L - landscape, P - portrait 
  '', '', '', '',
        5, // margin_left
        5, // margin right
       60, // margin top
       30, // margin bottom
        0, // margin header
        0); // margin footer

$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML($html);
$pdf->Output();
break;

case 'pinjaman':
$html ="<table border='1' >
<thead>
  <tr>
    <th>No</th>
    <th>Tanggal Pinjam</th>
    <th>Nama Pemohon</th>
    <th>Jumlah Pinjaman</th>
    <th>Bunga</th>
    <th>Total Pinjaman</th>
    <th>Lama Pinjaman</th>
    <th>Angsuran</th>
  </tr>
</thead>
<tbody>";
  $hasil = mysql_query("SELECT * FROM v_tb_pinjaman ORDER BY kode_pinjaman");
  $no = 1;
  $no = 1 + $offset;
  $counter = 1;
  while ($r=mysql_fetch_array($hasil)){
   if ($counter % 2 == 0) $warna = "light";
   else $warna = "dark";
   $besar_pinjaman = number_format($r['besar_pinjaman'],0,".",".");
   $nilai_bunga = number_format($r['nilai_bunga'],0,".",".");
   $total_pinjaman = number_format($r['total_pinjaman'],0,".",".");
   $lama_pinjaman = number_format($r['lama_pinjaman'],0,".",".");
   $angsuran = number_format($r['angsuran'],0,".",".");

   $html .= "<tr class='".$warna."'>
   <td align=center>$no</td>
   <td>$r[tgl_pinjaman]</td>
   <td>$r[nama]</td>
   <td>$besar_pinjaman</td>
   <td>$nilai_bunga</td>
   <td>$total_pinjaman</td>
   <td>$lama_pinjaman</td>
   <td>$angsuran</td>
   </tr>";
  $no++;
  $counter++;
}
$html .= "</tbody></table>";
$pdf = new MPDF();
$pdf->SetHTMLHeader('<img src="images/header.png"/>');
$pdf->AddPage('', // L - landscape, P - portrait 
  '', '', '', '',
        5, // margin_left
        5, // margin right
       60, // margin top
       30, // margin bottom
        0, // margin header
        0); // margin footer

$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML($html);
$pdf->Output();
break;

case 'kartu':
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
    for ($i=1; $i < 13 ; $i++) { 
      $html .= '<tr>
      <td style="text-align:center">'.$i.'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    ';
  }

  $html.='</tbody>
</table>';



$pdf = new MPDF();
$pdf->SetHTMLHeader('<img src="images/header.png"/>');
$pdf->AddPage('', // L - landscape, P - portrait 
  '', '', '', '',
        5, // margin_left
        5, // margin right
       60, // margin top
       30, // margin bottom
        0, // margin header
        0); // margin footer

$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML($html);
$pdf->Output();
break;


default:
    # code...
break;
}

?>