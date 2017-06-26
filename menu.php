<li><a href="./" <?php if ($_GET['module']=="") { echo 'class="active"'; } ?>><span>Home</span></a></li>
<?php if ($_SESSION['level']=="admin") { ?>
<li><a href="?module=kriteria" <?php if ($_GET['module']=="kriteria") { echo 'class="active"'; } ?>><span>Data Kriteria</span></a></li>
<li><a href="?module=pemohon" <?php if ($_GET['module']=="pemohon") { echo 'class="active"'; } ?>><span>Data Pemohon</span></a></li>
<li><a href="?module=penilaian" <?php if ($_GET['module']=="penilaian") { echo 'class="active"'; } ?>><span>Penilaian Kriteria</span></a></li>
<li><a href="?module=penilaianp" <?php if ($_GET['module']=="penilaianp") { echo 'class="active"'; } ?>><span>Penilaian Pemohon</span></a></li>
<li><a href="?module=rekomendasi" <?php if ($_GET['module']=="rekomendasi") { echo 'class="active"'; } ?>><span>Hasil Penilaian</span></a></li>
<li><a href="?module=pinjaman" <?php if ($_GET['module']=="pinjaman") { echo 'class="active"'; } ?>><span>Pinjaman</span></a></li>
<li><a href="?module=angsuran" <?php if ($_GET['module']=="angsuran") { echo 'class="active"'; } ?>><span>Angsuran</span></a></li>
<li><a href="?module=laporan" <?php if ($_GET['module']=="laporan") { echo 'class="active"'; } ?>><span>Laporan</span></a></li>
<?php } ?>