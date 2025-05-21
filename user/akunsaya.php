<?php
require '../session.php';
include '../database.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['IsUser'])) {
    // Jika belum, arahkan ke halaman login
    header("Location: login.php");
    exit;
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
    <link rel="stylesheet" href="../css/akunsaya.css">
    <!-- <link rel="icon" href="../assets/img/dikom.png" type="image/x-icon"> -->


    <!-- <title>Dinas Koperasi dan Usaha Mikro Sidoarjo</title> -->
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
    <?php
    foreach ($akun_user as $akunku): ?>
    <section id="hero">
    <div class="box container h-100">
            <div class="container col-md-6">

                <div class="card mb-3" style="max-width: 620px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php
                            $file_name = $akunku['foto_anggota'];
                            $image_path = "./image_user/" . $file_name;
                            ?>
                            <img src="<?php echo $image_path; ?>" class="img-fluid rounded-start" alt="Img not found!">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Hi, <span class="fw-bold text-uppercase"><?= $akunku['nama']; ?></span></h5>
                                <p class="card-text">Koperasi <?= $akunku['koperasi_user']; ?></p>
                                <?php
                                    $query = mysqli_query($db, "SELECT last_update FROM anggota WHERE id = $id_user");
                                    $row = mysqli_fetch_assoc($query);
                                    if ($row['last_update'] > 0) {
                                        $last_updated_time = $row['last_update'];
                                        $current_time = time();
                                        $time_diff = $current_time - $last_updated_time;

                                        // Determine the time format
                                        if ($time_diff < 60) {
                                            $last_updated_text = "Last updated a few seconds ago";
                                        } elseif ($time_diff < 3600) {
                                            $mins = floor($time_diff / 60);
                                            $last_updated_text = "Last updated $mins minutes ago";
                                        } elseif ($time_diff < 86400) {
                                            $hours = floor($time_diff / 3600);
                                            $last_updated_text = "Last updated $hours hours ago";
                                        } else {
                                            $days = floor($time_diff / 86400);
                                            $last_updated_text = "Last updated $days days ago";
                                        }
                                    } else {
                                        // Handle case where last update is not available
                                        $last_updated_text = "Last updated not available";
                                    }
                                ?>
                                 <p class="card-text"><small class="text-muted"><?php echo $last_updated_text; ?></small></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container col-md-6">
            
            <form class="row g-2">
            <!-- <div class="col-md-6">
                <label for="inputAddress" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['nama']; ?>" disabled>
            </div> -->
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">No. Telp/ WA</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['nomor_telepon']; ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">NIK</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['NIK']; ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['jenis_kelamin']; ?>" disabled>
            </div>
            
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Nomor Anggota</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['nomor_anggota']; ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['jabatan_anggota']; ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Kelompok</label>
                <input type="text" class="form-control" id="inputAddress" value="<?= $akunku['unit']; ?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" value="<?= $akunku['email']; ?>" disabled>
            </div>
            <!-- <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4" value="<?= $akunku['password_user']; ?>" disabled>
            </div> -->
            
            <div class="col-md-6">
                <label for="inputAddress2" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="inputAddress2" value="<?= $akunku['alamat']; ?>" disabled>
            </div>
            <div class="col-md-5">
                <label for="inputCity" class="form-label">Tanggal Lahir</label>
                <input type="text" class="form-control" id="inputCity" value="<?= $akunku['tanggal_lahir']; ?>" disabled>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Kota Kelahiran</label>
                <input type="text" class="form-control" id="inputCity" value="<?= $akunku['tempat_lahir']; ?>" disabled>
            </div>
            
            <div class="col-md-3">
                <label for="inputZip" class="form-label">Status</label>
                <input type="text" class="form-control" id="inputZip" value="<?= $akunku['status_anggota']; ?>" disabled>
            </div>
            
            <!-- <div class="col-md-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_edit">Edit</button>
            </div> -->
            </form>
            
            </div>
            </div>
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero"> -->
            <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">

        </div>
    </section>

<!-- 
<div class="modal fade" id="form_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="./akunsaya.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-floating mb-3">
                <input type="text" name="tnamalengkap" class="form-control" value="<?= $akunku['nama']; ?>">
                <label for="floatingInputnamalengkap">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tnik" class="form-control" value="<?= $akunku['NIK']; ?>">
                <label for="floatingInputtelp">NIK</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="ttelp" class="form-control" value="<?= $akunku['nomor_telepon']; ?>">
                <label for="floatingInputtelp">No. Telp/Wa</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tusername" class="form-control" value="<?= $akunku['username_user']; ?>">
                <label for="floatingInputusername">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tkoperasi" class="form-control" value="<?= $akunku['koperasi_user']; ?>">
                <label for="floatingInputkoperasi">Nama Koperasi</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tjabatan" class="form-control" value="<?= $akunku['jabatan_anggota']; ?>">
                <label for="floatingInputjabatan">Jabatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="temail" class="form-control" value="<?= $akunku['email']; ?>">
                <label for="floatingInputemail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tpassword" class="form-control" value="<?= $akunku['password_user']; ?>">
                <label for="floatingInputpassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="talamat" class="form-control" value="<?= $akunku['alamat']; ?>">
                <label for="floatingInputalamat">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" name="ttanggal" class="form-control" value="<?= $akunku['tanggal_lahir']; ?>">
                <label for="floatingInputTanggal">Tanggal Lahir</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="tkota" class="form-control" value="<?= $akunku['tempat_lahir']; ?>">
                <label for="floatingInputkota">Kota Kelahiran</label>
            </div>
            <div class="form-floating mb-3">
                <select name="tstatus" class="form-select" id="floatingInputstatus">
                    <option value="Aktif" <?= ($akunku['status_anggota'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                    <option value="Tidak Aktif" <?= ($akunku['status_anggota'] == 'tidak aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
                <label for="floatingInputstatus">Status</label>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Foto (Jpg,Jpeg atau PNG. Max 5 mb)</label>
                <input class="form-control" name="tfile" type="file" accept="image/jpeg, image/jpg, image/png" />
                <p>File yang sudah diunggah sebelumnya:<br><b><?= $file_name; ?></b></p>
                <div class="col-md-4">
                <?php
                    // Pastikan $akunku tidak kosong sebelum mencoba mengakses kunci 'foto_user'
                    if (!empty($akunku['foto_user'])) {
                        $file_name = $akunku['foto_user'];
                        $image_path = "./image_user/" . $file_name;
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
</div> -->

<?php
endforeach;
?>

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