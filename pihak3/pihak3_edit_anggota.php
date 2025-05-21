<?php
// require './admin_session.php';
include '../database.php';
require 'master_session.php';

function select($query) {

    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

$id_master = $_SESSION['IsMaster']; // Ambil user_id dari session

$data_anggota = select("SELECT * FROM anggota WHERE unit IN (SELECT unit FROM master_admin WHERE id_master = $id_master) ");

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
    <link rel="stylesheet" href="../css/docstyle.css">
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

  </head>
  <body>
<!--Nav-->
<?php
include '../navbar/nav_master.php';
// include 'upload_excel_anggota.php'

?>
    <!--Section1-->
    <section id="hero">
        <div class="container">
            <div class="row h-100">
                <div class="col-md-12 hero-tagline my-auto mx-auto table-responsive align-items-center">
                    <table class="table table-primary table-bordered display nowrap" id="tabledoc" style="width:100%">
                        
                    <h2 style="font-family: Poppins;"><b>ANGGOTA KOPERASI</b></h2>
                        
                        
                        <!-- <div class="col text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_tambah">
                            Tambah
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form_upload">
                            Upload File Excel
                            </button>
                        </div>   -->
                        <!-- <span class="form-error"><?php echo $form_success; //pesan eror ?></span>
                        <span class="form-error"><?php echo $form_error; //pesan eror ?></span>       -->
                        <hr>
                        <thead style="background-color: #007070;">
                            <tr>    
                                <th class="text-start text-light">No.</th>
                                <th class="text-start text-light">Nomor Anggota</th>
                                <th class="text-start text-light">Nama </th>
                                <!--<th class="text-start text-light">Nama Koperasi</th>-->
                                
                                <!-- <th class="text-start text-light">Jabatan</th> -->
                                <th class="text-start text-light">Alamat</th>
                                <!--<th class="text-start text-light">Email</th>-->
                                <th class="text-start text-light">No. Telp</th>
                                <!-- <th class="text-start text-light">Tempat Lahir</th> -->
                                <!-- <th class="text-start text-light">Tgl Lahir</th> -->
                                <th class="text-start text-light">Jenis Kelamin</th>
                                <th class="text-start text-light">Status</th>
                                <th class="text-start text-light">Keterangan</th>
                                <!-- <th class="text-light" colspan="2">Lainnya</th> -->
                            </tr>
                        </thead>
                        <tbody style="background-color: #009D9D;">
                            <?php 
                                $no = 1;
                            ?>
                            <?php
                            foreach ($data_anggota as $anggota): ?>
                            <tr>
                                <td class="text-start text-light"><?= $no++; ?></td>
                                <td class="text-start text-light"><?= $anggota['nomor_anggota']; ?></td>
                                <td class="text-start text-light"><?= $anggota['nama']; ?></td>                               
                                
                                <!-- <td class="text-start text-light"><?= $anggota['jabatan_anggota']; ?></td> -->
                                <td class="text-start text-light"><?= $anggota['alamat']; ?></td>
                                <!--<td class="text-start"><?= $anggota['email']; ?></td>-->
                                <td class="text-start text-light"><?= $anggota['nomor_telepon']; ?></td>
                                <!-- <td class="text-start text-light"><?= $anggota['tempat_lahir']; ?></td>
                                <td class="text-start text-light"><?= $anggota['tanggal_lahir']; ?></td> -->
                                <td class="text-start text-light"><?= $anggota['jenis_kelamin']; ?></td>
                                <td class="text-start text-light"><?= $anggota['status_anggota']; ?></td>
                                <td class="text-start text-light"><?= $anggota['unit']; ?></td>
                                <!-- <td class="text-center text-light"><span class="xedit" data-bs-toggle="modal"  data-bs-target="#form_tambah<?php echo $anggota['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td>
                                <td class="text-center text-light"><span class="xdelete" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $anggota['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg></span></td> -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            
            <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero">
            <!--<img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">-->

        </div>
    </section> 
    <!--Pop Up-->
<?php foreach ($data_anggota as $anggota): 

// include 'ubah_data_anggota.php'

    ?>
        <!-- Modal Edit -->
    <div class="modal fade" id="form_tambah<?php echo $anggota['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Anggota <?= $anggota['nama']; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="edit_anggota.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_anggota" value="<?= $anggota['id']; ?>">
            <div class="modal-body">
                
                <div class="form-floating mb-3">
                    <input type="text" name="tnama" class="form-control" value="<?= $anggota['nama']; ?>">
                    <label for="floatingInputPelatihan">Nama Lengkap</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="text" name="tnamakop" class="form-control" value="<?= $anggota['koperasi_user']; ?>">
                    <label for="floatingInputPelatihan">Nama Koperasi</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="text" name="tnoanggota" class="form-control" value="<?= $anggota['nomor_anggota']; ?>">
                    <label for="floatingInputPelatihan">Nomor Anggota Koperasi</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="text" name="tkelompok" class="form-control" value="<?= $anggota['unit']; ?>">
                    <label for="floatingInputPelatihan">Kelompok</label>
                </div> 
                <div class="form-floating mb-3">
                    <input type="text" name="tjabatan" class="form-control" value="<?= $anggota['jabatan_anggota']; ?>">
                    <label for="floatingInputPelatihan">Jabatan</label>
                </div>                                                                                                                            
                <div class="form-floating mb-3">
                    <input type="text" name="talamat" class="form-control" value="<?= $anggota['alamat']; ?>">
                    <label for="floatingInputTanggal">Alamat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="temail" class="form-control" value="<?= $anggota['email']; ?>">
                    <label for="floatingInputTanggal">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ttelp" class="form-control" value="<?= $anggota['nomor_telepon']; ?>">
                    <label for="floatingInputTanggal">No. Telp</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="tlahir" class="form-control" value="<?= $anggota['tanggal_lahir']; ?>">
                    <label for="floatingInputTanggal">Tanggal lahir</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ttempatlahir" class="form-control" value="<?= $anggota['tempat_lahir']; ?>">
                    <label for="floatingInputTanggal">Tempat lahir</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="tkelamin" class="form-select" id="floatingInputstatus">
                        <option value="Laki-Laki" <?= ($anggota['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= ($anggota['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <label for="floatingInputstatus">Jenis Kelamin</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="tstatus" class="form-select" id="floatingInputstatus">
                        <option value="Aktif" <?= ($anggota['status_anggota'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?= ($anggota['status_anggota'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                    </select>
                    <label for="floatingInputstatus">Status</label>
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


<!-- Modal Delete -->
<div class="modal fade" id="staticBackdrop<?php echo $anggota['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus data <?= $anggota['nama']; ?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger"><a class="link-up4" href="hapus_data_anggota.php?datae=<?php echo $anggota['id'] ?>&nomer= <?php echo $anggota['nomor_anggota'] ?>">Hapus</a></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>


   <!-- Modal upload -->
   <!-- <?php include 'addanggotaprocess.php'?> -->
<div class="modal fade" id="form_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form class="needs-validation" action="edit_anggota.php" method="post" enctype="multipart/form-data" novalidate>
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input type="text" name="tnoanggota" class="form-control" required>
                <label for="floatingInputPelatihan">Nomor Anggota</label>
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tnama" class="form-control" required>
                <label for="floatingInputPelatihan">Nama Lengkap</label>
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tnamakop" class="form-control">
                <label for="floatingInputPelatihan">Nama Koperasi</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tjabatan" class="form-control">
                <label for="floatingInputPelatihan">Jabatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tnik" class="form-control">
                <label for="floatingInputPelatihan">NIK</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tkelompok" class="form-control">
                <label for="floatingInputPelatihan">Kelompok</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="talamat" class="form-control">
                <label for="floatingInputTanggal">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="temail" class="form-control">
                <label for="floatingInputTanggal">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="ttelp" class="form-control">
                <label for="floatingInputTanggal">No. Telp</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="tlahir" class="form-control">
                <label for="floatingInputTanggal">Tgl Lahir</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="ttempatlahir" class="form-control">
                <label for="floatingInputTanggal">Tempat Lahir</label>
            </div>
            <div class="form-floating mb-3">
                <select name="tkelamin" class="form-select" id="floatingInputstatus">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <label for="floatingInputstatus">Jenis Kelamin</label>
            </div>
            <div class="form-floating mb-3">
                <select name="tstatus" class="form-select" id="floatingInputstatus">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                <label for="floatingInputstatus">Status</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Upload Data Excel Anggota Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    
    <form action="edit_anggota.php" method="post" enctype="multipart/form-data">
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
            <button type="submit" name="aupload" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>  
        </div>
    </form>

    </div>
</div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>


    <!--Footer-->
    

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