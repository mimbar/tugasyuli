<?php
// $query = mysql_query("SELECT id_pemohon, nama FROM pemohon ORDER BY nama");
// if (!$query) { // add this check.
//     die('Invalid query: ' . mysql_error());
// }

require_once ( 'ahp.php' );
require_once('modul/rekomendasi/fungsi.php');

?>
<h6 class='orange'>Tambah Pinjaman</h6>
<form name=text_form method=POST action='modul/pinjaman/aksi_pinjaman.php?module=pinjaman&act=input' onsubmit='return Blank_TextField_Validator()'>
  <table>
    <tr><td>Peminjam</td>   <td> : <select name='id_pemohon'>
      <?php
      $nilaiakhir=0;
      for($i=0;$i<count($kk);$i++){
        for($ii=0;$ii<count($kriteria);$ii++){
          $nilaiakhir = $nilaiakhir + $eigen_kk[$ii][$i];
        }
        if ($nilaiakhir > 1) {
          echo "<option value='1'>".$kk[$i][2]."</option>";
        }
        $nilaiakhir=0;
      }?> </td></select></tr>
      <tr><td>Besar Pinjaman</td>   <td> : <input type=text id='nama' name='besar_pinjaman' size=30></td></tr>
      <tr><td>Lama Pinjaman</td>   <td> : <select name='lama_pinjaman'> <option value='6'>6x Cicilan</option> <option value='12'>12x Cicilan</option> </select></td></tr>
      <tr><td></td><td>
        <input type=submit name=submit value='Simpan' >
        <input type=button name=batal value='Batal' onclick=\"window.location.href='?module=pinjaman';\">
      </td></tr>
    </table></form>
  </h6>