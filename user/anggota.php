<?php
require '../session.php';
include '../database.php';
$id_user = $_SESSION['IsUser'];
function select($query) {

    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
$data_user = select("SELECT * FROM anggota WHERE id = '$id_user'");
foreach ($data_user as $dataku): 
    $koperasi_user = $dataku['koperasi_user'];
endforeach;
$anggota_user = select("SELECT * FROM anggota WHERE koperasi_user = '$koperasi_user'");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!--Plugin Asset-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>


    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Logo Title-->
    <link rel="stylesheet" href="../css/anggota.css">

    <script>
        $(document).ready(function() {
            $('#tabledoc').DataTable();
        })
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

    <!--Section1-->
    <section id="hero">
    <div class="container">
            <div class="row h-100 tabel">
            <div class="col-md-8 hero-tagline my-auto mx-auto table-responsive align-items-center">
                    <table class="table table-bordered table-striped mt-3 zi" id="tabledoc">
                    <?php                         
                    foreach ($data_user as $dataku): ?>
                    <h2>Daftar Anggota Koperasi <span class="fw-bold text-uppercase"><?= $dataku['koperasi_user']; ?></span></h2>
                    <?php endforeach; ?>
                    <hr>
                        <thead>
                            <tr>
                                <th class="text-start">No</th>
                                <th class="text-start">Nama</th>
                                <th class="text-start">Koperasi</th>
                                <th class="text-start">Alamat</th>         
                                <th class="text-start">Email</th>
                                <!-- <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Anggota</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;                        
                            foreach ($anggota_user as $anggotaku): ?>
                            <tr>
                                <td class="text-start"><?= $no++; ?></td>
                                <td class="text-start"><?= $anggotaku['nama']; ?></td>
                                <td class="text-start"><?= $anggotaku['koperasi_user']; ?></td>
                                <td class="text-start"><?= $anggotaku['alamat']; ?></td>
                                <td class="text-start"><?= $anggotaku['email']; ?></td>
                                <!-- <td><?= $anggotaku['tempat_lahir']; ?></td> -->
                                <!-- <td><?= $anggotaku['tanggal_lahir']; ?></td> -->
                                <!-- <td><?= $anggotaku['jenis_kelamin']; ?></td> -->
                                <!-- <td><?= $anggotaku['status_anggota']; ?></td> -->
                                <!-- <td><a class="pdf_style" href="../admin/download.php?file=<?=urlencode($materi['dokumen_materi']); ?>" target="_blank">Detail File</a></td> -->
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                      </table>
                </div>
            </div>
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero"> -->
            <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">

        </div>
    </section>

    <!--Footer-->
<!--     <section id="contact">
        <div class="container-fluid overlay h-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Pusat Bantuan</h3>
                    
                            <div class="kontak">
                                <h6>Kontak</h6>
                                <div class="mb-3 d-flex align-items-center">
                                    <div>
                                        <img src="../assets/img/Alamat Icon.png" alt="">
                                    </div>
                                    
                                    <a href="#">Jl. Jaksa Agung Suprapto Raya Suprapto No.9, Sidoklumpuk, Sidokumpul, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61218</a>
                                </div>
                                <div class="mb-3">
                                    <img src="../assets/img/Whatsapp icon.png" alt="">
                                    <a href="#">0318921220</a>
                                </div>
                                <div class="mb-3">
                                    <img src="../assets/img//Email Icon.png" alt="">
                                    <a href="#">diskopum@sidoarjokab.go.id</a>
                                </div>
                            </div>
                            <h6>Social Media</h6>
                                <a href="" class="me-3"><img src="../assets/img/Instagram Iicon.png" alt=""></a>
                                <a href="" class="me-3"><img src="../assets/img/Facebook Icon.png" alt=""></a>
                                <a href="" class="me-3"><img src="../assets/img/Twiter Icon.png" alt=""></a>
                        </div>
                        <div class="col-md-6">
                            <div class="card-contact w-100">
                                <form action="">
                                    <h2>Hubungi Kami</h2>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="question" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Tuliskan Kendala Anda</label>
                                    </div>  
                                    <button type="submit" class="button-kontak">Kirim</button>
                                </form>
                            </div>
                    </div>
                </div> 
            </div>
        </div>
    </section> -->

    <footer class="d-flex align-items-center">
        <div class="container-fluid ">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <img class="imgfoot" src="../assets/img/dikom.png" alt="">
                        <a href="../index.php">Dinkopum</a>
                    </div>
                    
                </div>
                <div class="row  copyright  ">
                    <div class="col-12">
                        <p>Copyright By UTM All Right Deserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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