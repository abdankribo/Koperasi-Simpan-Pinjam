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
                    <h2 style="font-family: Poppins;"><b><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 16 16">
                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542s.987-.254 1.194-.542C9.42 6.644 9.5 6.253 9.5 6a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2z"/>
                    <path d="M16 6.5h-5.551a2.7 2.7 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5s-1.613-.412-2.006-.958A2.7 2.7 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5z"/>
                    </svg> DAFTAR PINJAMAN ANGGOTA</b></h2>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 text-start" style="font-family: Poppins;">
                                <form action="pinjaman.php" method="post">
                                <select class="form-select" aria-label="Default select example" name="bulan" onchange="this.form.submit()">
                                    <option selected disabled>Pilih Bulan</option>
                                    <option value="13">Semua data Pinjaman</option>
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
                                    
                                <div class="col text-end" style="font-family: Poppins;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_tambah">
                                Tambah
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form_upload">
                                Upload File Excel
                                </button>
                                </div>
                            </div>
                        </div>
                        <span class="form-error"><?php echo $form_success; //pesan eror ?></span>
                        <span class="form-error"><?php echo $form_error; //pesan eror ?></span>
                        <span class="form-error"><?php echo $form_warning; //pesan eror ?></span>
                        <hr>
                        <div class="col-md-12 hero-tagline my-auto mx-auto table-responsive align-items-center">
                        <table class="table table-primary table-bordered display nowrap" id="tabledoc" style="width:100%">
                        <?php
                            $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : 13;
                            // Ambil nilai bulan yang dipilih dari input POST
                            if(isset($_GET['bulan'])) {
                                $bulan = $_GET['bulan'];
                            } elseif($bulan == 13) { ?>
                            <thead style="background-color: #007070;">
                            <h5 style="font-family: Poppins;"><b>Laporan Semua Pinjaman</b></h5>
                            <tr align="center">
                                <th rowspan="2" class="text-center text-light">No</th>
                                <th rowspan="2" class="text-center text-light">No. Anggota</th>
                                <th rowspan="2" class="text-center text-light">Nama</th>
                                
                                <th colspan="3" class="text-center text-light">Pinjaman</th>
                                
                                <th colspan="3" class="text-center text-light">Angsuran</th>
                                
                                <!-- <th rowspan="2" class="text-center text-light">Sisa</th> -->
                                <th rowspan="2" class="text-center text-light">Keterangan</th>
                                <th rowspan="2" class="text-center text-light">Edit</th>
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
                             $data = mysqli_query($db,"SELECT * FROM pinjaman  WHERE nomor_anggota IN (SELECT nomor_anggota FROM anggota WHERE status_anggota = 'Aktif')");
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

                                 <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_edit<?php echo $d['id_pinjaman'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td>
                             </tr>
                             <?php 
                             };
                            ?>
                            <?php } ?>
                            <?php 
                            if ($bulan != 13) { 
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
                            $query = "SELECT * FROM pinjaman_record WHERE bulan = $bulan";
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
                    <input type="text" name="ttotal" class="form-control" value="<?php echo 'Rp ' . number_format(($d['angsuran_pokok'] + $d['pinjaman_jasa']), 0, ',', '.'); ?>" disabled>
                    <label for="floatingInputTanggal">Total Angsuran</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="keterangan" class="form-control" value="<?= $d['unit']; ?>">
                    <label for="floatingInputTanggal">Keterangan</label>
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
            $currentMonth = date('Y-m'); // Mendapatkan bulan dan tahun saat ini dalam format 'YYYY-MM'
            ?>
            <div class="form-floating mb-3">
                <input type="month" name="tbulan" class="form-control" value="<?php echo $currentMonth; ?>">
                <label for="floatingInputTanggal">Bulan</label>
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