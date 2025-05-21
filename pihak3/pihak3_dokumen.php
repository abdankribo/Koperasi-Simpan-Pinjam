<?php
require '../pihak3/master_session.php';
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

$data_materi = select("SELECT * FROM materi");

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
    <script>
        $(document).ready(function() {
        $('#tabledoc').DataTable({
            scrollX: true // Enable horizontal scrolling
        });

        // Disable horizontal scrolling when in responsive mode
        $('#tabledoc').on('init.dt', function() {
            var table = $(this).DataTable();
            var scrollBody = $('.dataTables_scrollBody');

            // Only enable scrolling if table width is greater than window width
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
include '../navbar/nav_master.php'
?>
    <!--Section1-->
    <section id="hero">
        <div class="container">
            <div class="row h-100 tabel">
                <div class="box col-md-8 hero-tagline my-auto mx-auto table-responsive ">
                    <table class="table table-bordered table-striped mt-3 zi" id="tabledoc" style="width:100%">
                        
                    <h2 style="font-family: Poppins;"><b>DOKUMEN</b></h2>
                        
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_tambah">
                        Tambah
                        </button> -->
                        <hr>
                        <thead style="background-color: #007070;">
                            <tr>    
                                <th class="col-md-1 text-start text-light">No</th>
                                <th class="col-md-7 text-light">Nama Pelatihan</th>
                                <th class="col-md-2 text-start text-light">Tanggal</th>
                                <th class="col-md-2 text-light">File</th>
                                <!-- <th class="text-light" colspan="2">Lainnya</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                            ?>
                            <?php
                            foreach ($data_materi as $materi): ?>
                            <tr>
                                <td class="text-start"><?= $no++; ?></td>
                                <td class="text-start"><?= $materi['nama_materi']; ?></td>
                                <td class="text-start"><?= $materi['tgl_pelatihan']; ?></td>
                                <td ><a class="pdf_style" href="download.php?file=<?=urlencode($materi['dokumen_materi']); ?>" target="_blank">Detail File</a></td>
                                <!-- <td class="text-center"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_tambah<?php echo $materi['id_materi'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td>
                                <td class="text-center"><span type="button" class="xdelete" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $materi['id_materi'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg></span></td> -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero">
            <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img"> -->

        </div>
    </section> 
    <!--Pop Up-->
<?php foreach ($data_materi as $materi): 

    $file_path = $materi['dokumen_materi'];
    $file_name = basename($file_path);

// include 'ubah_data.php'

?>
    <!-- Modal Edit -->
<div class="modal fade" id="form_tambah<?php echo $materi['id_materi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Berkas Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="tambah_materi.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_materi" value="<?= $materi['id_materi']; ?>">
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input type="text" name="spelatihan" class="form-control" value="<?= $materi['nama_materi']; ?>">
                <label for="floatingInputPelatihan">Nama Pelatihan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="stanggal" class="form-control" value="<?= $materi['tgl_pelatihan']; ?>">
                <label for="floatingInputTanggal">Tanggal Pelatihan</label>
            </div>
            <div class="mb-3">
            <label for="formFile" class="form-label">Berkas File</label>
            <!-- Menampilkan nama file yang sudah diunggah sebelumnya -->
            <input class="form-control" name="sfile" type="file">
            <p>File yang sudah diunggah sebelumnya:<br><b><?= $file_name; ?></b></p>
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
<div class="modal fade" id="staticBackdrop<?php echo $materi['id_materi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger"><a class="link-up4" href="hapus_data.php?datae=<?php echo $materi['id_materi'] ?>">Hapus</a></button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>


   <!-- Modal upload -->
<!-- <?php include 'addmateriprocess.php'?> -->
<div class="modal fade" id="form_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Berkas Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="tambah_materi.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input type="text" name="tpelatihan" class="form-control">
                <label for="floatingInputPelatihan">Nama Pelatihan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="ttanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                <label for="floatingInputTanggal">Tanggal Pelatihan</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Berkas File</label>
                <input class="form-control" name="tfile" type="file">
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