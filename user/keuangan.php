<?php 
    require '../session.php';
    include '../database.php';
     
    // Check connection
    if (mysqli_connect_errno()){
        echo "db database gagal : " . mysqli_connect_error();
    }

    $id_user = $_SESSION['IsUser']; // Ambil user_id dari session

    function select($query) {
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

// Tidak perlu lagi menggunakan $_GET['user_id'], gunakan $id_user dari session
$akun_user = select("SELECT * FROM anggota WHERE id = '$id_user'");

    foreach ($akun_user as $akunku):
        
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Plugin Asset-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    
    <!--Logo Title-->
    <link rel="stylesheet" href="../css/simpanancss.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabledoc').DataTable({
                
                lengthMenu: [
                    [10, 25, 50, 100, -1], 
                    [10, 25, 50, 100, "Semua"] 
                ], 
                
                scrollX: true // Aktifkan gulir horizontal
            });

            // Menonaktifkan gulir horizontal saat tampilan mode responsif
            $('#tabledoc').on('init.dt', function() {
                var table = $(this).DataTable();
                var scrollBody = $('.dataTables_scrollBody');

                // Hanya aktifkan gulir jika lebar layar lebih besar dari lebar tabel
                if (table.table().width() <= $(window).width()) {
                    scrollBody.css('overflow-x', 'hidden');
                }

                $(window).on('resize', function() {
                    if (table.table().width() <= $(window).width()) {
                        scrollBody.css('overflow-x', 'hidden');
                    } else {
                        scrollBody.css('overflow-x', 'auto');
                    }
                });
            });
        });
    </script>

<script>
        $(document).ready(function() {
            $('#tabledoc2').DataTable({
                
                lengthMenu: [
                    [10, 25, 50, 100, -1], 
                    [10, 25, 50, 100, "Semua"] 
                ], 
                
                scrollX: true // Aktifkan gulir horizontal
            });

            // Menonaktifkan gulir horizontal saat tampilan mode responsif
            $('#tabledoc').on('init.dt', function() {
                var table = $(this).DataTable();
                var scrollBody = $('.dataTables_scrollBody');

                // Hanya aktifkan gulir jika lebar layar lebih besar dari lebar tabel
                if (table.table().width() <= $(window).width()) {
                    scrollBody.css('overflow-x', 'hidden');
                }

                $(window).on('resize', function() {
                    if (table.table().width() <= $(window).width()) {
                        scrollBody.css('overflow-x', 'hidden');
                    } else {
                        scrollBody.css('overflow-x', 'auto');
                    }
                });
            });
        });
    </script>

<?php
    include '../navbar/title.php'
    ?>
  </head>
  <body>
<!--Nav-->
<?php
    include '../navbar/nav.php'
?>
    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
            <div>
                
                    <h3 style="font-family: Poppins;"><b>Selamat Datang <span class="fw-bold text-uppercase"><?php echo $akunku['nama']; ?></span></b></h3>

                    
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-2 text-start" style="font-family: Poppins;">
                                <form action="keuangan.php" method="post">
                                <select class="form-select" aria-label="Default select example" name="bulan" onchange="this.form.submit()">
                                    <option selected disabled>Pilih Bulan</option>
                                    <option value="13">Semua data Simpanan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>                  
                                </form>
                                </div>
                                
                                
                            </div>
                        </div>
                        
                        <hr>
                        <div class="col-md-12 hero-tagline my-auto mx-auto table-responsive align-items-center">
                        <table class="table table-primary table-bordered display nowrap" id="tabledoc" style="width:100%">
                        <?php
                            $nomor_anggota = $akunku['nomor_anggota'];
                            $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : 13;
                            // Ambil nilai bulan yang dipilih dari input POST
                            if(isset($_GET['bulan'])) {
                                $bulan = $_GET['bulan'];
                            } elseif($bulan == 13) { ?>
                            <h5 style="font-family: Poppins;"><b>Laporan Simpanan</b></h5>
                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="5" class="text-center text-light">Simpanan</th>
                                <th rowspan="2" class="text-center text-light">Jumlah Total</th>
                                <th rowspan="2" class="text-center text-light">Keterangan</th>
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Wajib</th>
                                <th class="text-center text-light">Sukarela</th>
                                <th class="text-center text-light">Hari Raya</th>
                                <th class="text-center text-light">Khusus</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #009D9D;">
                                <?php 
                             $id_smp = 1;
                             $data = mysqli_query($db, "SELECT * FROM simpanan WHERE nomor_anggota IN (SELECT nomor_anggota FROM anggota WHERE status_anggota = 'Aktif' AND nomor_anggota = {$akunku['nomor_anggota']})");
                             $jum_total = 0;
                             while($d = mysqli_fetch_array($data)){
                             ?>
                             <tr class="text-start">
                                 <td class="text-start text-light"><?php echo $id_smp++; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nomor_anggota']; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nama_anggota']; ?></td>
                                 <td class="text-end text-light"><?php echo number_format($d['spokok'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['swajib'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['ssukarela'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['shariraya'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['skhusus'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['spokok'] + $d['swajib'] + $d['ssukarela'] + $d['shariraya'] + $d['skhusus'], 0, ',', '.'); ?></td>
                                 <td class="text-start text-light"><?php echo $d['unit']; ?></td>

                                 
                             </tr>
                             <?php 
                             };
                            ?>
                            
                            <?php 
                            }elseif ($bulan != 13) { 
                                $query = select("SELECT DISTINCT bulan FROM simpanan_record WHERE bulan = $bulan");
                                $bulan_tampil = array(); // Array untuk menyimpan bulan yang sudah ditampilkan
                                foreach ($query as $akunku):
                                    $nama_bulan = date("F", mktime(0, 0, 0, $akunku['bulan'], 1)); // Mendapatkan nama bulan dari nilai bulan
                                    // Periksa apakah bulan sudah ditampilkan sebelumnya
                                    if (!in_array($nama_bulan, $bulan_tampil)) {
                                        ?>
                                        <h5 style="font-family: Poppins;"><b>Laporan Simpanan Bulan <span><?php echo $nama_bulan; ?></span></b></h5>
                                        <?php
                                        // Tambahkan bulan ke dalam array bulan_tampil
                                        $bulan_tampil[] = $nama_bulan;
                                    }
                                endforeach; ?>

                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th colspan="5" class="text-center text-light">Simpanan</th>
                                <th rowspan="2" class="text-center text-light">Jumlah Total</th>
                                <!-- <th rowspan="2" class="text-center text-light">Tgl Transaksi</th> -->
                                <!-- <th rowspan="2" class="text-center text-light">Edit</th> -->
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Wajib</th>
                                <th class="text-center text-light">Sukarela</th>
                                <th class="text-center text-light">Hari Raya</th>
                                <th class="text-center text-light">Khusus</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #009D9D;"> 
                             <?php
                             
                            $id_smp = 1;
                            $data = mysqli_query($db,"SELECT * FROM simpanan_record WHERE bulan = $bulan AND id_anggota = $nomor_anggota");
                        
                            $jum_total = 0;
                            
                            while($d = mysqli_fetch_array($data)) {
                                $query2 = "SELECT * FROM anggota WHERE nomor_anggota = '{$d['id_anggota']}' AND status_anggota = 'Aktif'";
                                $data2 = mysqli_query($db, $query2);
                                while($d2 = mysqli_fetch_array($data2)) { // Menggunakan $data2, bukan $data
                                    // Looping untuk menampilkan data sesuai dengan bulan yang dipilih
                                    ?>
                                    <tr class="text-start">
                                        <td class="text-start text-light"><?php echo $id_smp++; ?></td>
                                        <td class="text-start text-light"><?php echo $d2['nama']; ?></td>
                                        <td class="text-start text-light"><?php echo $d2['nomor_anggota']; ?></td>
                                        <td class="text-end text-light"><?php echo number_format($d['pokok_rec'], 0, ',', '.'); ?></td>
                                        <td class="col-md-2 text-end text-light"><?php echo number_format($d['wajib_rec'], 0, ',', '.'); ?></td>
                                        <td class="col-md-2 text-end text-light"><?php echo number_format($d['sukarela_rec'], 0, ',', '.'); ?></td>
                                        <td class="col-md-2 text-end text-light"><?php echo number_format($d['hariraya_rec'], 0, ',', '.'); ?></td>
                                        <td class="col-md-2 text-end text-light"><?php echo number_format($d['khusus_rec'], 0, ',', '.'); ?></td>
                                        <td class="col-md-2 text-end text-light"><?php echo number_format($d['pokok_rec'] + $d['wajib_rec'] + $d['sukarela_rec'] + $d['hariraya_rec'] + $d['khusus_rec'], 0, ',', '.'); ?></td>
                                        <!-- <td class="text-start text-light"><?php echo $d['tgl_simpanan']; ?></td> -->
                                        <!-- <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_simpanan'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg></span></td> -->
                                    </tr>
                                    <?php 
                                }
                            }    
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- Pinjaman di bawah -->
                    <hr>
                        <div class="col-md-12 hero-tagline my-auto mx-auto table-responsive align-items-center">
                        <table class="table table-primary table-bordered display nowrap" id="tabledoc2" style="width:100%">
                        <?php
                            // $nomor_anggota = $akunku['nomor_anggota'];
                            $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : 13;
                            // Ambil nilai bulan yang dipilih dari input POST
                            if(isset($_GET['bulan'])) {
                                $bulan = $_GET['bulan'];
                            } elseif($bulan == 13) { ?>
                            <h5 style="font-family: Poppins;"><b>Laporan Pinjaman</b></h5>
                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="3" class="text-center text-light">Pinjaman</th>
                                
                                <th colspan="3" class="text-center text-light">Angsuran</th>
                                
                                <!-- <th rowspan="2" class="text-center text-light">Sisa</th> -->
                                <th rowspan="2" class="text-center text-light">Keterangan</th>
                                <!-- <th rowspan="2" class="text-center text-light">Edit</th> -->
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
                                
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #009D9D;">
                                <?php 
                             $id_smp = 1;
                             $data = mysqli_query($db,"SELECT * FROM pinjaman WHERE nomor_anggota IN (SELECT nomor_anggota FROM anggota WHERE status_anggota = 'Aktif' AND nomor_anggota = {$akunku['nomor_anggota']})");
                             $jum_total = 0;
                             while($d = mysqli_fetch_array($data)){
                             ?>
                             <tr class="text-start">
                                 <td class="text-start text-light"><?php echo $id_smp++; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nomor_anggota']; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nama_anggota']; ?></td>
                                 <td class="text-end text-light"><?php echo number_format($d['pinjaman_pokok'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['pinjaman_jasa'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['pinjaman_pokok'] + $d['pinjaman_jasa'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_pokok'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                 <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_pokok'] + $d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                 <!-- <td class="col-md-2 text-end text-light"><?php echo number_format(($d['spokok'] + $d['swajib'])-($d['ssukarela'] + $d['shariraya']), 0, ',', '.'); ?></td> -->
                                 <td class="text-start text-light"><?php echo $d['unit']; ?></td>

                                 <!-- <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_pinjaman'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td> -->
                             </tr>
                             <?php 
                             };
                            ?>
                            
                            <?php 
                            }elseif ($bulan != 13) { 
                                $query = select("SELECT DISTINCT bulan FROM pinjaman_record WHERE bulan = $bulan");
                                $bulan_tampil = array(); // Array untuk menyimpan bulan yang sudah ditampilkan
                                foreach ($query as $akunku):
                                    $nama_bulan = date("F", mktime(0, 0, 0, $akunku['bulan'], 1)); // Mendapatkan nama bulan dari nilai bulan
                                    // Periksa apakah bulan sudah ditampilkan sebelumnya
                                    if (!in_array($nama_bulan, $bulan_tampil)) {
                                        ?>
                                        <h5 style="font-family: Poppins;"><b>Laporan Pinjaman Bulan <span><?php echo $nama_bulan; ?></span></b></h5>
                                        <?php
                                        // Tambahkan bulan ke dalam array bulan_tampil
                                        $bulan_tampil[] = $nama_bulan;
                                    }
                                endforeach; ?>

                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="3" class="text-center text-light">Pinjaman</th>
                                
                                <th colspan="3" class="text-center text-light">Angsuran</th>
                                <!-- <th rowspan="2" class="text-center text-light">Sisa</th> -->
                                <!-- <th rowspan="2" class="text-center text-light">Tanggal</th> -->
                                <!-- <th rowspan="2" class="text-center text-light">Edit</th> -->
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #009D9D;"> 
                             <?php
                             
                            $id_smp = 1;
                            $data = mysqli_query($db,"SELECT * FROM pinjaman_record WHERE bulan = $bulan AND id_anggota = $nomor_anggota");
                        
                            $jum_total = 0;
                            
                            while($d = mysqli_fetch_array($data)) {
                                $query2 = "SELECT * FROM anggota WHERE nomor_anggota = '{$d['id_anggota']}' AND status_anggota = 'Aktif'";
                                $data2 = mysqli_query($db, $query2);
                                while($d2 = mysqli_fetch_array($data2)) { // Menggunakan $data2, bukan $data
                                    // Looping untuk menampilkan data sesuai dengan bulan yang dipilih
                                    ?>
                                    <tr class="text-start">
                                    <td class="text-start text-light"><?php echo $id_smp++; ?></td>
                                    <td class="text-start text-light"><?php echo $d2['nomor_anggota']; ?></td>
                                    <td class="text-start text-light"><?php echo $d2['nama']; ?></td>
                                    <td class="text-end text-light"><?php echo number_format($d['pinjaman_pokok_rec'], 0, ',', '.'); ?></td>
                                    <td class="col-md-2 text-end text-light"><?php echo number_format($d['pinjaman_jasa_rec'], 0, ',', '.'); ?></td>
                                    <td class="col-md-2 text-end text-light"><?php echo number_format($d['pinjaman_pokok_rec'] + $d['pinjaman_jasa_rec'], 0, ',', '.'); ?></td>
                                    <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_pokok'], 0, ',', '.'); ?></td>
                                    <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                    <td class="col-md-2 text-end text-light"><?php echo number_format($d['angsuran_pokok'] + $d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                    <!-- <td class="col-md-2 text-end text-light"><?php echo number_format(($d['ssukarela'] + $d['shariraya'])-($d['spokok'] + $d['swajib']), 0, ',', '.'); ?></td> -->
                                        <!-- <td class="text-start text-light"><?php echo $d['tanggal_pinjaman']; ?></td> -->
                                        <!-- <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_simpanan'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg></span></td> -->
                                    </tr>
                                    <?php 
                                }
                            }    
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>



    <?php endforeach ?>
    </section>

    <?php
        include '../footer/footer.php'
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>