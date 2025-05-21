<?php
require './admin_session.php';
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

$data_materi = select("SELECT * FROM set_web");

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
include '../navbar/nav_admin.php'
?>
    <!--Section1-->
    <section id="hero">
        <div class="container">
            <div class="row h-100 tabel">
                <div class="box col-md-12 hero-tagline my-auto mx-auto table-responsive ">
                    <table class="table table-bordered table-striped mt-3 zi" id="tabledoc">
                        
                    <h2 style="font-family: Poppins;"><b><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg> Pengaturan Website</b></h2>
                        
                        
                        <hr>
                        <thead style="background-color: #007070;">
                            <tr>    
                                <th class="text-start text-light">Nama Koperasi</th>
                                <th class="text-light">Deskripsi</th>
                                <th class="text-start text-light">Alamat</th>
                                <th class="text-light">No. Telp</th>
                                <th class="text-light">Email</th>
                                <th class="text-light">Image</th>
                                <th class="text-light">Lainnya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                            ?>
                            <?php
                            foreach ($data_materi as $materi): ?>
                            <tr>
                                <!-- <td class="text-start"><?= $no++; ?></td> -->
                                <td class="text-start"><?= $materi['nama_koperasi']; ?></td>
                                <td class="text-start"><?= $materi['deskripsi_koperasi']; ?></td>
                                <td class="text-start"><?= $materi['alamat_koperasi']; ?></td>
                                <td class="text-start"><?= $materi['telp_koperasi']; ?></td>
                                <td class="text-start"><?= $materi['email_koperasi']; ?></td>
                                <td class="text-start"><?php
                                    // Pastikan $materi tidak kosong sebelum mencoba mengakses kunci 'foto_user'
                                    if (!empty($materi['logo_koperasi'])) {
                                        $file_name = $materi['logo_koperasi'];
                                        $image_path = "../assets/img/" . $file_name;
                                ?>
                                    <img src="<?php echo $image_path; ?>" class="img-fluid rounded-start" alt="Img not found!">
                                    <?php
                                        } else {

                                        }
                                    ?></td>
                                <td class="text-center"><span class="xedit" data-bs-toggle="modal" data-bs-target="#form_tambah<?php echo $materi['id_set'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg></span></td>
                                
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


include 'set_web_process.php'

?>
    <!-- Modal Edit -->
<div class="modal fade" id="form_tambah<?php echo $materi['id_set'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Berkas Dokumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="set_web.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_web" value="<?= $materi['id_set']; ?>">
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input type="text" name="knama" class="form-control" value="<?= $materi['nama_koperasi']; ?>">
                <label for="floatingInputPelatihan">Nama Koperasi</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="text" name="kdeskripsi" class="form-control" id="exampleFormControlTextarea1" style="height: 150px;"><?= $materi['deskripsi_koperasi']; ?></textarea>
                <label for="exampleFormControlTextarea1">Deskripsi</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="text" name="kalamat" class="form-control" id="exampleFormControlTextarea1" style="height: 100px;"><?= $materi['alamat_koperasi']; ?></textarea>
                <label for="floatingInputTanggal">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="ktelp" class="form-control" value="<?= $materi['telp_koperasi']; ?>">
                <label for="floatingInputTanggal">No. Telp</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="kemail" class="form-control" value="<?= $materi['email_koperasi']; ?>">
                <label for="floatingInputTanggal">Email</label>
            </div>
            <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Berkas File</label>
            
            <input class="form-control" name="kfile" type="file">
            <p>File yang sudah diunggah sebelumnya:<br><b><?= $file_name; ?></b></p>
            </div> -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Foto (Jpg,Jpeg atau PNG. Max 5 mb)</label>
                <input class="form-control" name="tfile" type="file" accept="image/jpeg, image/jpg, image/png" />
                <p>File yang sudah diunggah sebelumnya:<br><b><?= $materi['logo_koperasi']; ?></b></p>
                <div class="col-md-4">
                <?php
                    // Pastikan $materi tidak kosong sebelum mencoba mengakses kunci 'foto_user'
                    if (!empty($materi['logo_koperasi'])) {
                        $file_name = $materi['logo_koperasi'];
                        $image_path = "../assets/img/" . $file_name;
                ?>
                    <img src="<?php echo $image_path; ?>" class="img-fluid rounded-start" alt="Img not found!">
                    <?php
                        } else {

                        }
                    ?>
                </div>
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


<!-- Modal Delete -->
<!-- <div class="modal fade" id="staticBackdrop<?php echo $materi['id_materi'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
</div> -->
<?php endforeach; ?>


   <!-- Modal upload
<?php include 'addmateriprocess.php'?>
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
</div> -->




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