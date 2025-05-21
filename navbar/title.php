<?php

include '../database.php';

$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):
?>

<link rel="icon" href="../assets/img/<?=$koperasiku['logo_koperasi'];?>" type="image/x-icon">
<title>
<?=$koperasiku['nama_koperasi'];?>
</title>

<?php 
endforeach
?>