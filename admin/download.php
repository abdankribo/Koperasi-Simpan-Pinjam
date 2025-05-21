<?php
// Ambil nama file PDF dari parameter URL
$file = $_GET['file'];

// Melakukan sanitasi nama file untuk mencegah serangan XSS
$file = htmlspecialchars($file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinas Koperasi dan Usaha Mikro Sidoarjo</title>

    <link rel="icon" href="../assets/img/dikom.png" type="image/x-icon">
</head>
<body>

    <!-- Menampilkan file PDF menggunakan tag <embed> -->
    <embed src="<?= $file ?>" type="application/pdf" width="100%" height="1000px" />

</body>
</html>
