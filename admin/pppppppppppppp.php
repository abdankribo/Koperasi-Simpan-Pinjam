<?php 
    require './admin_session.php';
    include '../database.php';
     
    // Check connection
    if (mysqli_connect_errno()){
        echo "db database gagal : " . mysqli_connect_error();
    }
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
    <style>
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th {
            border-top:none; border-right: none;
        }
        @media print {
        th, td {
            border: none; /* Menghapus border saat cetak */
            }
        }
    </style>

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
    <?php
    include '../navbar/title.php'
    ?> 
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

    <script>
        $(document).ready(function() {
            $('#tabledoc').DataTable({
                dom: 'Bflrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                lengthMenu: [
                    [10, 25, 50, 100, -1], 
                    [10, 25, 50, 100, "Semua"] 
                ], 
                pageLength: -1, // Menampilkan semua data
                ordering: false,
                layout: {
                    topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }       
                },
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
    window.addEventListener('DOMContentLoaded', (event) => {
    // Ambil semua elemen input dengan value "0"
    const zeroValueInputs = document.querySelectorAll('input[value="0"]');
    
    // Iterasi melalui setiap elemen input
    zeroValueInputs.forEach(input => {
        // Set nilai default menjadi kosong
        input.value = '0';
        // Tambahkan kelas untuk mengubah tampilan menjadi seperti placeholder
        input.classList.add('placeholder-style');
        // Tambahkan event listener untuk mengembalikan nilai jika input kosong
        input.addEventListener('blur', function() {
        if (this.value === '') {
            this.value = '0';
            this.classList.add('placeholder-style');
        }
        });
        // Event listener untuk menghapus kelas placeholder saat input diisi
        input.addEventListener('focus', function() {
        if (this.value === '0') {
            this.value = '';
            this.classList.remove('placeholder-style');
        }
        });
    });
    });
    </script>

  </head>
  <body>
<!--Nav-->
<?php
    include '../navbar/nav_admin.php';

    include 'upload_excel_pinj.php'
?>

    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
                <!-- isian -->
                
                <div>
                    <h2 style="font-family: Poppins;"><b><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                    </svg> NERACA</b></h2>

                        <!-- <div class="container">
                            <div class="row">
                                <div class="col-md-2 text-start" style="font-family: Poppins;">
                                <form action="pinjaman.php" method="post">
                                <select class="form-select" aria-label="Default select example" name="bulan" onchange="this.form.submit()">
                                    <option selected disabled>Pilih Bulan/Tahun</option>
                                    <option value="semua">Semua data Pinjaman</option>
                                    <?php
                                    // Ambil bulan dan tahun dari kolom tanggal_pinjaman dan urutkan berdasarkan bulan dan tahun
                                    $data_tanggal = select("SELECT DISTINCT DATE_FORMAT(tanggal_pinjaman, '%Y-%m') AS bulan_tahun FROM pinjaman_record ORDER BY tanggal_pinjaman ASC");
                                    
                                    // Array nama bulan dalam bahasa Indonesia
                                    $bulan_indonesia = array(
                                        'January' => 'Januari',
                                        'February' => 'Februari',
                                        'March' => 'Maret',
                                        'April' => 'April',
                                        'May' => 'Mei',
                                        'June' => 'Juni',
                                        'July' => 'Juli',
                                        'August' => 'Agustus',
                                        'September' => 'September',
                                        'October' => 'Oktober',
                                        'November' => 'November',
                                        'December' => 'Desember'
                                    );

                                    // Loop melalui hasil dan menambahkan opsi ke dalam dropdown
                                    foreach ($data_tanggal as $tanggal) {
                                        $bulan_tahun = $tanggal['bulan_tahun'];
                                        // Ubah format bulan_tahun ke format yang diinginkan
                                        $bulan_tahun_formatted = date('F Y', strtotime($bulan_tahun));
                                        // Pisahkan bulan dan tahun
                                        $bulan = date('F', strtotime($bulan_tahun));
                                        $tahun = date('Y', strtotime($bulan_tahun));
                                        // Ganti bulan dengan nama bulan dalam bahasa Indonesia
                                        $bulan_indonesia_formatted = $bulan_indonesia[$bulan];
                                        echo "<option value='$bulan_tahun'>$bulan_indonesia_formatted $tahun</option>";
                                    }
                                    ?>
                                </select>

                 
                                </form>
                                </div> -->

                                <div class="col-md-2 text-start" style="font-family: Poppins;">
                                <form action="pppppppppppppp.php" method="post">
                                    <select class="form-select" aria-label="Default select example" name="tahun" onchange="this.form.submit()">
                                        <option selected disabled>Pilih Akumulasi/Tahun</option>

                                        <?php
                                        // Ambil tahun dari kolom tanggal_pinjaman dan urutkan secara menurun
                                        $tahun_result = mysqli_query($db, "SELECT DISTINCT YEAR(tanggal_pinjaman) AS tahun FROM pinjaman_record ORDER BY tahun ASC");

                                        // Loop melalui hasil dan menambahkan opsi ke dalam dropdown
                                        while ($row = mysqli_fetch_assoc($tahun_result)) {
                                            $tahun = $row['tahun'];
                                            echo "<option value='$tahun'>$tahun</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                            </div>

                                    
                                <!-- <div class="col text-end" style="font-family: Poppins;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_tambah">
                                Tambah
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form_upload">
                                Upload File Excel
                                </button>
                                </div> -->
                            </div>
                        </div>
                        <span class="form-error"><?php echo $form_success; //pesan eror ?></span>
                        <span class="form-error"><?php echo $form_error; //pesan eror ?></span>
                        <span class="form-error"><?php echo $form_warning; //pesan eror ?></span>
                        <hr>
                        <div class="col-md-10 hero-tagline my-auto mx-auto table-responsive align-items-center">
                        <table class="table table-primary table-bordered display nowrap" id="tabledoc" style="width:100%">
                        <?php
                            $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : 'semua';
                            $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '13';
                            $old_tahun = $tahun - 1;                    
                            // Ambil nilai bulan yang dipilih dari input POST
                            if(isset($_GET['bulan']) && isset($_GET['tahun'])) {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];
                            } elseif(($bulan == '') && ($tahun == '13') ) { ?>
                            <thead style="background-color: #007070;">
                            <h5 style="font-family: Poppins;"><b>Laporan Semua Pinjaman</b></h5>
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="3" class="text-center text-light">Pinjaman</th>
                                <th colspan="3" class="text-center text-light">Pinjaman Khusus</th>
                                
                                <th colspan="3" class="text-center text-light">Angsuran</th>
                                
                                <!-- <th rowspan="2" class="text-center text-light">Sisa</th> -->
                                <th rowspan="2" class="text-center text-light">Kelompok</th>
                                <th rowspan="2" class="text-center text-light">Edit</th>
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
                                
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
                             $data = mysqli_query($db,"SELECT * FROM pinjaman  WHERE nomor_anggota IN (SELECT nomor_anggota FROM anggota WHERE status_anggota = 'Aktif') ORDER BY nomor_anggota ASC");
                             $jum_total = 0;
                             while($d = mysqli_fetch_array($data)){
                             ?>
                             <tr class="text-start">
                                 <td class="text-start text-light"><?php echo $id_smp++; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nomor_anggota']; ?></td>
                                 <td class="text-start text-light"><?php echo $d['nama_anggota']; ?></td>
                                 <td class="text-end text-light"><?php echo number_format($d['pinjaman_pokok'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['pinjaman_jasa'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['pinjaman_pokok'] + $d['pinjaman_jasa'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'] + $d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['angsuran_pokok'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                 <td class=" text-end text-light"><?php echo number_format($d['angsuran_pokok'] + $d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                 <!-- <td class="col-md-2 text-end text-light"><?php echo number_format(($d['spokok'] + $d['swajib'])-($d['ssukarela'] + $d['shariraya']), 0, ',', '.'); ?></td> -->
                                 <td class="text-start text-light"><?php echo $d['unit']; ?></td>

                                 <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_pinjaman'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td>
                             </tr>
                             <?php 
                             };$data2 = mysqli_query($db, "SELECT SUM(pinjaman_pokok) AS spokok, SUM(pinjaman_jasa) AS ssukarela, SUM(pinjaman_khusus_pokok) AS pinjaman_khusus_pokok, SUM(pinjaman_khusus_jasa) AS pinjaman_khusus_jasa, SUM(angsuran_pokok) AS shariraya, SUM(angsuran_jasa) AS swajib FROM pinjaman WHERE nomor_anggota IN (SELECT nomor_anggota FROM anggota WHERE status_anggota = 'Aktif')");

                             while($d = mysqli_fetch_array($data2)){
                            ?>
                            <tfoot style="background-color: #007070;">
                            <tr>
                                <th colspan="3" class="text-center text-light">Total</th>
                                <th class="text-end text-light"><?php echo number_format($d['spokok'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['ssukarela'], 0, ',', '.'); ?></th>
                                <th class="text-center text-light"></th>
                                <th class="text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></th>
                                <th class="text-center text-light"></th>
                                <th class="text-end text-light"><?php echo number_format($d['shariraya'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['swajib'], 0, ',', '.'); ?></th>
                                <!-- <th class="text-start text-light"><?php echo number_format($d['skhusus'], 0, ',', '.'); ?></th> -->
                                <th colspan="3" class="text-center text-light"></th>
                            </tr></tfoot>
                            
                            <?php }} 
                            elseif ($bulan != 'semua' && $tahun = '13') { 
                            $query = select("SELECT DISTINCT tanggal_pinjaman FROM pinjaman_record WHERE DATE_FORMAT(tanggal_pinjaman, '%Y-%m') = '$bulan'");
                            $bulan_tampil = array(); // Array untuk menyimpan kombinasi bulan dan tahun yang sudah ditampilkan
                                $bulan_indonesia = array(
                                    'January' => 'Januari',
                                    'February' => 'Februari',
                                    'March' => 'Maret',
                                    'April' => 'April',
                                    'May' => 'Mei',
                                    'June' => 'Juni',
                                    'July' => 'Juli',
                                    'August' => 'Agustus',
                                    'September' => 'September',
                                    'October' => 'Oktober',
                                    'November' => 'November',
                                    'December' => 'Desember'
                                );
                                foreach ($query as $akunku):
                                    $tanggal_pinjaman = $akunku['tanggal_pinjaman'];
                                    $nama_bulan = date("F", strtotime($tanggal_pinjaman)); // Mendapatkan nama bulan dari nilai tanggal_pinjaman
                                    $tahun = date("Y", strtotime($tanggal_pinjaman)); // Mendapatkan tahun dari nilai tanggal_pinjaman
                                    $bulan_tahun = $bulan_indonesia[$nama_bulan] . " " . $tahun; // Kombinasi bulan dalam bahasa Indonesia dan tahun

                                    // Periksa apakah kombinasi bulan dan tahun sudah ditampilkan sebelumnya
                                    if (!in_array($bulan_tahun, $bulan_tampil)):
                                ?>
                                        <h5 style="font-family: Poppins;"><b>Laporan Pinjaman Bulan <?php echo $bulan_tahun; ?></b></h5>
                                <?php
                                        // Tambahkan kombinasi bulan dan tahun ke dalam array bulan_tampil
                                        $bulan_tampil[] = $bulan_tahun;
                                    endif;
                                endforeach;
                                ?>

                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="3" class="text-center text-light">Pinjaman <?php echo $bulan_tahun; ?></th>
                                <th colspan="3" class="text-center text-light">Pinjaman Khusus <?php echo $bulan_tahun; ?></th>
                                
                                <th colspan="3" class="text-center text-light">Angsuran <?php echo $bulan_tahun; ?></th>
                                <!-- <th rowspan="2" class="text-center text-light">Sisa</th> -->
                                <th rowspan="2" class="text-center text-light">Tanggal</th>
                                <!-- <th rowspan="2" class="text-center text-light">Edit</th> -->
                            </tr>
                            <tr align="center">
                                <th class="text-center text-light">Pokok</th>
                                <th class="text-center text-light">Jasa</th>
                                <th class="text-center text-light">Total</th>
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
                            $query = "SELECT * FROM pinjaman_record WHERE DATE_FORMAT(tanggal_pinjaman, '%Y-%m') = '$bulan'ORDER BY id_anggota ASC;
                            ";
                            $data = mysqli_query($db, $query);
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
                                    <td class=" text-end text-light"><?php echo number_format($d['pinjaman_jasa_rec'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['pinjaman_pokok_rec'] + $d['pinjaman_jasa_rec'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'] + $d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['angsuran_pokok'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                    <td class=" text-end text-light"><?php echo number_format($d['angsuran_pokok'] + $d['angsuran_jasa'], 0, ',', '.'); ?></td>
                                    <!-- <td class="col-md-2 text-end text-light"><?php echo number_format(($d['ssukarela'] + $d['shariraya'])-($d['spokok'] + $d['swajib']), 0, ',', '.'); ?></td> -->
                                        <td class="text-start text-light"><?php echo $d['tanggal_pinjaman']; ?></td>
                                        <!-- <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_simpanan'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg></span></td> -->
                                    </tr>
                                    <?php 
                                }
                            }$query = "SELECT id_anggota,SUM(pinjaman_pokok_rec) AS spokok, SUM(pinjaman_jasa_rec) AS ssukarela, SUM(pinjaman_khusus_pokok) AS pinjaman_khusus_pokok, SUM(pinjaman_khusus_jasa) AS pinjaman_khusus_jasa, SUM(angsuran_pokok) AS shariraya, SUM(angsuran_jasa) AS swajib FROM pinjaman_record WHERE DATE_FORMAT(tanggal_pinjaman, '%Y-%m') = '$bulan'ORDER BY id_anggota ASC;
                            ";
                            $data = mysqli_query($db, $query);
                            $jum_total = 0;
                            
                            while($d = mysqli_fetch_array($data)) {
                                $query2 = "SELECT * FROM anggota WHERE nomor_anggota = '{$d['id_anggota']}' AND status_anggota = 'Aktif'";
                                $data2 = mysqli_query($db, $query2);
                                while($d2 = mysqli_fetch_array($data2)) { // Menggunakan $data2, bukan $data
                                    // Looping untuk menampilkan data sesuai dengan bulan yang dipilih
                                    ?>
                                    <tfoot style="background-color: #007070;">
                            <tr>
                                <th colspan="3" class="text-center text-light">Total</th>
                                <th class="text-end text-light"><?php echo number_format($d['spokok'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['ssukarela'], 0, ',', '.'); ?></th>
                                <th class="text-center text-light"></th>
                                <th class="text-end text-light"><?php echo number_format($d['pinjaman_khusus_pokok'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['pinjaman_khusus_jasa'], 0, ',', '.'); ?></th>
                                <th class="text-center text-light"></th>
                                <th class="text-end text-light"><?php echo number_format($d['shariraya'], 0, ',', '.'); ?></th>
                                <th class="text-end text-light"><?php echo number_format($d['swajib'], 0, ',', '.'); ?></th>
                                <th colspan="3" class="text-center text-light"></th>
                            </tr></tfoot>
                                    <?php 
                                }
                            }
                        
                        }
                            
                            
                             elseif($tahun != '13' && $bulan == 'semua') { ?>
                            
                            <h5 style="font-family: Poppins;"><b>Neraca Pertahun <?php echo $tahun ?></b></h5>
                            <thead style="background-color: #007070;">
                            <tr align="center">
                                <!-- <th class="col-md-1 text-start text-light">No.</th> -->
                                <th class="text-center text-light"></th>
                                <th class="text-center text-light"><?php echo $tahun ?></th>
                                <th class="text-center text-light"><?php echo $old_tahun ?></th>
                                
                                
                            </tr>
                            
                            </thead>
                            <tbody style="background-color: #009D9D;"> 
                            
                            <?php
                            $piutang_sp = '';
                            $piutang_sp_old = '';
                            $piutang_k = '';
                            $piutang_k_old = '';
                            $simpanan_s = '';
                            $simpanan_s_old = '';
                            $simpanan_p = '';
                            $simpanan_p_old = '';
                            $simpanan_w = '';
                            $simpanan_w_old = '';
                                    $query = "SELECT SUM(pokok_rec) AS spokok, SUM(sukarela_rec) AS ssukarela, SUM(hariraya_rec) AS shariraya, SUM(wajib_rec) AS swajib, SUM(khusus_rec) AS skhusus FROM simpanan_record WHERE (YEAR(tgl_simpanan) = '$old_tahun' OR YEAR(tgl_simpanan) < '$old_tahun')";
                                    $data = mysqli_query($db, $query);
                                    $query2 = "SELECT SUM(pokok_rec) AS spokok, SUM(sukarela_rec) AS ssukarela, SUM(hariraya_rec) AS shariraya, SUM(wajib_rec) AS swajib, SUM(khusus_rec) AS skhusus FROM simpanan_record WHERE (YEAR(tgl_simpanan) = '$tahun' OR YEAR(tgl_simpanan) < '$tahun')";
                                    $data2 = mysqli_query($db, $query2); // Menggunakan $data3 sebagai variabel untuk query ke-3


                                    $query3 = "SELECT 
                                        SUM(pinjaman_jasa_rec) AS pinjaman_jasa_rec, 
                                        SUM(pinjaman_pokok_rec) AS pinjaman_pokok_rec, 
                                        SUM(pinjaman_khusus_pokok) AS pinjaman_khusus_pokok, 
                                        SUM(pinjaman_khusus_jasa) AS pinjaman_khusus_jasa, 
                                        SUM(angsuran_pokok) AS angsuran_pokok, 
                                        SUM(angsuran_jasa) AS angsuran_jasa 
                                    FROM pinjaman_record 
                                    WHERE YEAR(tanggal_pinjaman) <= '$tahun'"; 

                                    $data3 = mysqli_query($db, $query3);

                                    $query4 = "SELECT 
                                        SUM(pinjaman_jasa_rec) AS pinjaman_jasa_rec, 
                                        SUM(pinjaman_pokok_rec) AS pinjaman_pokok_rec, 
                                        SUM(pinjaman_khusus_pokok) AS pinjaman_khusus_pokok, 
                                        SUM(pinjaman_khusus_jasa) AS pinjaman_khusus_jasa, 
                                        SUM(angsuran_pokok) AS angsuran_pokok, 
                                        SUM(angsuran_jasa) AS angsuran_jasa 
                                    FROM pinjaman_record 
                                    WHERE YEAR(tanggal_pinjaman) <= '$old_tahun'"; 

                                    $data3 = mysqli_query($db, $query3);
                                    $data4 = mysqli_query($db, $query4);

                                    if ($data3 && $data4) {
                                        while ($d = mysqli_fetch_assoc($data3)) { // Menggunakan mysqli_fetch_assoc untuk hasil yang lebih baik
                                            $piutang_sp = $d['pinjaman_pokok_rec'] - $d['angsuran_pokok'];
                                            $piutang_k = $d['pinjaman_khusus_pokok'] ;
                                        }
                                        while ($d = mysqli_fetch_assoc($data4)) { // Menggunakan mysqli_fetch_assoc untuk hasil yang lebih baik
                                            $piutang_sp_old = $d['pinjaman_pokok_rec'] - $d['angsuran_pokok'];
                                            $piutang_k_old = $d['pinjaman_khusus_pokok'] ;

                                        }
                                        while ($d = mysqli_fetch_array($data2)) { // Menggunakan $data3
                                            $simpanan_s = $d['ssukarela'] ;
                                            $simpanan_p = $d['spokok'] ;
                                            $simpanan_w = $d['swajib'] ;
                                        }
                                        while ($d = mysqli_fetch_array($data)) { // Menggunakan $data3
                                            $simpanan_s_old = $d['ssukarela'] ;
                                            $simpanan_p_old = $d['spokok'] ;
                                            $simpanan_w_old = $d['swajib'] ;
                                        }
                                    } else {
                                        // Handle the error
                                        echo "Error: " . mysqli_error($db);
                                    }
                                    ?>
                                    

                                    <tr>
                                        <th style="color: white; text-align: left; border-top:none; border-right: none;">
                                            <h5><b>PENGHASILAN :</b></h5>
                                        </th>
                                        <th style="color: white; text-align: left; border:none;"></th>
                                        <th style="color: white; text-align: left; border-collapse: collapse; border-left:none; border-bottom:none;"></th>
                                    </tr>
                                    <tr>
                                        <th style="color: white; text-align: left; border-top:none; border-right: none;">Pendapatan Jasa Simpan Pinjam</th>
                                        <td style="color: white; text-align: right; ">0</td>
                                        <td style="color: white; text-align: right; border-left: none;">0</td>
                                    </tr>
                                    <tr>
                                        <th style="color: white; text-align: left; border-top:none; border-right: none;">Pendapatan Administrasi</th>
                                        <td style="color: white; text-align: right; ">0</td>
                                        <td style="color: white; text-align: right; border-left: none">0</td>
                                    </tr>
                                    <tr>
                                        <th style="color: white; text-align: left;">Pendapatan Lain - lain</th>
                                        <td style="color: white; text-align: right;">0</td>
                                        <td style="color: white; text-align: right; border-left:none;">0</td>
                                    </tr>
                                    <tr>
                                        <th style="color: white; text-align: center; border-top:none; border-right: none;">
                                            Jumlah Penghasilan
                                        </th>
                                        <td style="color: white; text-align: right;">
                                        0
                                        </td>
                                        <td style="color: white; text-align: right; border-left:none;">
                                        0
                                        </td>
                                    </tr>

                            

                                    <!-- <tr style="background-color: #007070;">
                                        <th class="text-start text-light">
                                            12
                                        </th>
                                        <th class="text-center text-light">
                                            Kewajiban & Ekuitas
                                        </th>
                                        <td class="text-end text-light">
                                            
                                        </td>
                                        <td class="text-end text-light">
                                            
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <th class="text-start text-light" style="border-top:none; border-right: none;">
                                            <h5><b>BEBAN PERKOPERASIAN :</b></h5>
                                        </th>
                                        <td class="text-end text-light" style="border:none">
                                            0
                                        </td>
                                        <td class="text-end text-light" style="border:none">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start text-light" style="border-top:none; border-right: none;">
                                            Beban Rapat Anggota Tahunan
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start text-light" style="border-top:none; border-right: none;">
                                            <h5><b>BEBAN OPERASIONAL :</b></h5>
                                        </th>
                                        <td class="text-end text-light" style="border:none">
                                            0
                                        </td>
                                        <td class="text-end text-light" style="border:none">
                                            0
                                        </td>
                                    </tr>

                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-top:none; border-right: none;">
                                            Beban Insentif ( Organisasi )
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom:1px #009D9D; border-top: none">
                                            Beban Honor Ketua Kelompok
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: none; border-right: none">
                                            Beban THR
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-top: none; border-right: none">
                                            Beban ATK
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Transportasi
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Penyisihan Sewa Gedung
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Penyisihan Piutang Tak Tertagih
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Penyusutan Inventaris
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light" style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Konsumsi
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light"style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban Perawatan Aset
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light"style="border-bottom: 1px solid #009D9D; border-right: none">
                                            Beban lain - lain
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>                                       
                                    <tr>
                                        
                                        <th class="text-start text-light"style="border-top:none ; border-right: none">
                                            Beban Pajak Badan
                                        </th>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                        <td class="text-end text-light">
                                            0
                                        </td>
                                    </tr>      
                                    <tr>
                                        <th style="color: white; text-align: center; border-right:none;">
                                            Jumlah
                                        </th>
                                        <td style="color: white; text-align: right;">
                                            0
                                        </td>
                                        <td style="color: white; text-align: right; border: none;">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-start text-light"style="border-top:none ; border-right: none">
                                            <h5><b>JUMLAH</b></h5>
                                        </th>
                                        <td class="text-end text-light" style="color: white; text-align: right; border: none;">

                                        </td>
                                        <td class="text-end text-light" style="color: white; text-align: right; border: none;">
                                            
                                        </td>
                                    </tr>                                                                  
                                    <tr>
                                        <th style="color: white; text-align: center; border-right:none;">
                                            SHU
                                        </th>
                                        <td style="color: white; text-align: right;">
                                            0
                                        </td>
                                        <td style="color: white; text-align: right; border: none;">
                                            0
                                        </td>
                                    </tr>
                                </td>
                            </tr>
                            

                                    
                                
                            <?php
                                    
                            }
                            ?>

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero"> -->
            <!-- <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">
            <img src="../assets/img/Accsent 2.png" alt="" class="h-100 position-absolute top-0 end-0 accsent-img"> -->

        </div>
    </section>

    <?php 
    include 'edit_pinjaman.php';
        $id_smp = 1;
        $data = mysqli_query($db,"select * from pinjaman");
        $jum_total = 0;
        while($d = mysqli_fetch_array($data)){
        ?>
        <!-- Modal Edit -->
    <div class="modal fade" id="form_edit<?php echo $d['id_pinjaman'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Pinjaman <b><?= $d['nama_anggota']; ?></b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="pinjaman.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_anggota" value="<?= $d['id_pinjaman']; ?>">
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" name="tnomoranggota2" class="form-control" value="<?= $d['nomor_anggota']; ?>" disabled>
                    <input type="text" name="tnomoranggota" class="form-control" value="<?= $d['nomor_anggota']; ?>" hidden>
                    <label for="floatingInputPelatihan">Nomor Anggota</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="text" name="tnama2" class="form-control" value="<?= $d['nama_anggota']; ?>" disabled>
                    <input type="text" name="tnama" class="form-control" value="<?= $d['nama_anggota']; ?>" hidden>
                    <label for="floatingInputPelatihan">Nama Lengkap</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="number" name="ppokok" class="form-control" value="<?= $d['pinjaman_pokok']; ?>" min="0">
                    <label for="floatingInputPelatihan">Pinjaman Pokok</label>
                </div>                                                                                                                         
                <div class="form-floating mb-3">
                    <input type="number" name="pjasa" class="form-control" value="<?= $d['pinjaman_jasa']; ?>" min="0">
                    <label for="floatingInputTanggal">Pinjaman Jasa</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="pkpokok" class="form-control" value="<?= $d['pinjaman_khusus_pokok']; ?>" min="0">
                    <label for="floatingInputPelatihan">Pinjaman Khusus Pokok</label>
                </div>                                                                                                                         
                <div class="form-floating mb-3">
                    <input type="number" name="pkjasa" class="form-control" value="<?= $d['pinjaman_khusus_jasa']; ?>" min="0">
                    <label for="floatingInputTanggal">Pinjaman Khusus Jasa</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="apokok" class="form-control" value="<?= $d['angsuran_pokok']; ?>" min="0">
                    <label for="floatingInputTanggal">Angsuran Pokok</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="ajasa" class="form-control" value="<?= $d['angsuran_jasa']; ?>" min="0">
                    <label for="floatingInputTanggal">Angsuran Jasa</label>
                </div>
                 <!---BELUM DIGANTI--->
                <div class="form-floating mb-3">
                    <input type="text" name="ttotal" class="form-control" value="<?php echo 'Rp ' . number_format(($d['pinjaman_pokok'] + $d['pinjaman_jasa']), 0, ',', '.'); ?>" disabled>
                    <label for="floatingInputTanggal">Total Pinjaman</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ttotal" class="form-control" value="<?php echo 'Rp ' . number_format(($d['pinjaman_pokok'] + $d['pinjaman_jasa']), 0, ',', '.'); ?>" disabled>
                    <label for="floatingInputTanggal">Total Pinjaman Khusus</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ttotal" class="form-control" value="<?php echo 'Rp ' . number_format(($d['angsuran_pokok'] + $d['pinjaman_jasa']), 0, ',', '.'); ?>" disabled>
                    <label for="floatingInputTanggal">Total Angsuran</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="keterangan" class="form-control" value="<?= $d['unit']; ?>" disabled>
                    <label for="floatingInputTanggal">Kelompok</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="ssimpan" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>  
            </div>
        </form>

        </div>
    </div>
    </div>
        <?php }?>

<?php
include '../database.php';
function select($query) {

    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

$data_simp= select("SELECT * FROM anggota");
?>
       <!-- Modal upload -->
   <?php include 'addpinjamanprocess.php'?>
<div class="modal fade" id="form_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pinjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="pinjaman.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        
            <div class="form-floating mb-3">
                <select name="tnomoranggota" class="form-select" id="floatingInputstatus">
                <option value="Pilih Anggota" disabled selected>Pilih Anggota</option>
                <?php
                foreach ($data_simp as $simp): ?>
                <?php echo "<option value='" . $simp['nomor_anggota'] . "'>". $simp['nomor_anggota']." " . $simp['nama'] . "</option>"; ?>
                <?php endforeach; ?>
                </select>
                <label for="floatingInputstatus">Anggota</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="number" name="ppokok" class="form-control" value="0" min="0">
                <label for="floatingInputPelatihan">Pinjaman Pokok</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="pjasa" class="form-control" value="0" min="0">
                <label for="floatingInputPelatihan">Pinjaman Jasa</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="pkpokok" class="form-control" value="0" min="0">
                <label for="floatingInputPelatihan">Pinjaman Khusus Pokok</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="pkjasa" class="form-control" value="0" min="0">
                <label for="floatingInputPelatihan">Pinjaman Khusus Jasa</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="apokok" class="form-control" value="0" min="0">
                <label for="floatingInputTanggal">Angsuran  Pokok</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="ajasa" class="form-control" value="0" min="0">
                <label for="floatingInputTanggal">Angsuran Jasa</label>
            </div>
            <!-- <div class="form-floating mb-3">
                <input type="text" name="tkhusus" class="form-control">
                <label for="floatingInputTanggal">Simpanan Khusus</label>
            </div> -->
            <?php
            $today = date('Y-m-d'); // Mendapatkan tanggal hari ini dalam format 'YYYY-MM-DD'
            ?>
            <div class="form-floating mb-3">
                <input type="date" name="tbulan" class="form-control" value="<?php echo $today; ?>" required>
                <label for="floatingInputTanggal">Tanggal</label>
            </div>


        </div>
        <div class="modal-footer">
            <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>  
        </div>
    </form>

    </div>
</div>
</div>

<div class="modal fade" id="form_upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Data Excel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    
    <form action="pinjaman.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <!--<div class="form-floating mb-3">
                <input type="text" name="tpelatihan" class="form-control">
                <label for="floatingInputPelatihan">Nama Pelatihan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="ttanggal" class="form-control">
                <label for="floatingInputTanggal">Tanggal Pelatihan</label>
            </div>-->
            <div class="mb-3">
                <label for="formFile" class="form-label">Berkas File (xls,xlsx)</label>
                <input class="form-control" name="tfile" type="file">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="eupload" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>  
        </div>
    </form>

    </div>
</div>
</div>

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