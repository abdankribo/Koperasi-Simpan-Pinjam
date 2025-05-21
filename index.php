<?php
    include './lock_session.php';
    
    include './database.php';
    function select($query) {

        global $db;
    
        $result = mysqli_query($db, $query);
        $rows = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    
        return $rows;
    }
$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Logo Title-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/img/<?=$koperasiku['logo_koperasi'];?>" type="image/x-icon">

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

    <title>
    <?=$koperasiku['nama_koperasi'];?></title>
  </head>
  <body>
<!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #009D9D; ">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <?=$koperasiku['nama_koperasi'];?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active mx-1" aria-current="page" href="index.php">Home</a>
                </li>
                
                <li class="nav-item dropdown" onmouseover="showDropdown2()" onmouseout="hideDropdown2()">
                    <a class="nav-link dropdown-toggle mx-1" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Koperasi Kita
                    </a>
                    <ul class="dropdown-menu" id="myDropdown2" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="./user/sejarah.php">Sejarah</a></li>

                      <!-- <li><a class="dropdown-item" href="./user/regulasi.php">Regulasi</a></li> -->
                    </ul>
                </li>
                
                <!-- <li class="nav-item">
                    <a class="nav-link mx-1" href="./user/anggota.php">Anggota</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link mx-1" href="./user/dokumen.php">Dokumen</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link mx-1" href="./user/pinjaman.php">Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-1" href="./user/simpanan.php">Simpanan</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link mx-1" href="#footer">Kontak</a>
                </li>
                <?php
            
                if(isset($_SESSION['IsUser'])) {
                    
                    // Jika pengguna sudah login, tampilkan tombol Log Out
                    $id_user = $_SESSION['IsUser']; // Ambil user_id dari session
                            
                    $user = select("SELECT * FROM anggota WHERE id = '$id_user'"); 
                    foreach ($user as $akunku):
                    ?>
                    <li class="nav-item dropdown" onmouseover="showDropdown()" onmouseout="hideDropdown()">
                    <a class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'akunsaya.php') echo 'active'; ?> mx-1" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-current="page" href="#">Hi, <span class="fw-bold text-uppercase"><?= $akunku['nama']; ?></span></a>

                        <ul class="dropdown-menu" id="myDropdown" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./user/keuangan.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
                            <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a2 2 0 0 1-1-.268M1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1"/>
                            </svg> Keuangan</a></li>
                            <li><a class="dropdown-item" href="./user/akunsaya.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                            </svg> Akun Saya</a></li>
                            <!-- <li><a class="dropdown-item" href="./user/form.php">-</a></li>
                            <li><a class="dropdown-item" href="./user/regulasi.php">-</a></li> -->
                        </ul>
                    </li>
                    <?php
                    endforeach;
                } else {
                    // Jika pengguna belum login, tampilkan tombol Masuk
                   
                }
                ?>
                
            </ul>
            <?php
            
            if(isset($_SESSION['IsUser'])) {
                // Jika pengguna sudah login, tampilkan tombol Log Out
                ?>
                <div><button class="btn btn-outline-danger btn-sm link-up" data-bs-toggle="modal" data-bs-target="#logoutAkun">Logout</button></div>
                <?php
            } else {
                // Jika pengguna belum login, tampilkan tombol Masuk
                ?>
                <!-- <div><button class="btn btn-outline-light btn-sm link-up"><a class="link-up4" href="admin.php">Masuk</a></button></div> -->
                <?php
            }
            ?>
            </div>
        </div>
    </nav>

    <script>
function showDropdown() {
    document.getElementById("myDropdown").classList.add("show");
}
function hideDropdown() {
    document.getElementById("myDropdown").classList.remove("show");
}
function showDropdown2() {
    document.getElementById("myDropdown2").classList.add("show");
}
function hideDropdown2() {
    document.getElementById("myDropdown2").classList.remove("show");
}
</script>
<!-- Modal exit -->
<div class="modal fade" id="logoutAkun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutAkunLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutAkunLabel">Logout Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin melakukan Logout akun?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-danger"><a class="link-up4" href="./logout.php">Logout</a></button>
      </div>
    </div>
  </div>
</div>

<?php
    include 'login_process.php'
?>
    <!--Section1-->
    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-7 hero-tagline my-auto">
                    <h1><?=$koperasiku['nama_koperasi'];?></h1>
                    <p><?=$koperasiku['deskripsi_koperasi'];?></p>
                </div>
                <div class="col-md-4 hero-tagline my-auto">
                <?php
            
            if(!isset($_SESSION['IsUser'])) {
                // Jika pengguna sudah login, tampilkan tombol Log Out
                ?>                
                    <div class="login">
                    <!-- <h2><b>LOGIN</b></h2> -->
                    <form action="index.php" method="post">
                        <div class="form-floating mb-3"> 
                            <input class="form-control" id="floatingInput" type="text" name="username" placeholder="Enter your username" required>
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="floatingPassword" type="password" name="password" placeholder="Enter your password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                            <label for="showPassword" style="transform: translateY(-8%); cursor: pointer;"><small>Show Password</small></label>                         
                        </div>
                            <div class="mt-3">
                            <small class="form-error"><?php echo $form_error; //pesan eror ?></small>
                        </div>

                        <input class="btn fw-bold btn-primary" type="submit" name="ssubmit" value="Login">

                        <p>Belum ada akun? <a href="./user/register.php"><b>Buat Akun</b></a></p>
                    </form>
                    <script>
                        function togglePasswordVisibility() {
                            var passwordField = document.getElementById("floatingPassword");
                            if (passwordField.type === "password") {
                                passwordField.type = "text";
                            } else {
                                passwordField.type = "password";
                            }
                        }
                    </script>
                    </div>
                </div>
                <?php
            }else{
                $id_user = $_SESSION['IsUser']; // Ambil user_id dari session
                
                // Tidak perlu lagi menggunakan $_GET['user_id'], gunakan $id_user dari session
                $akun_user = select("SELECT * FROM anggota WHERE id = '$id_user'");
                foreach ($akun_user as $akunku):
                ?> 
                <div class="card" style="width: 18rem;">
                <?php
                    $file_name = $akunku['foto_anggota'];
                    $image_path = "./user/image_user/" . $file_name;
                    ?>
                    <img src="<?php echo $image_path; ?>" class="img-fluid rounded-start" alt="Img not found!">                <div class="card-body">
                    <h5 class="card-title">Selamat Datang</h5>
                    <p class="card-text"><span class="fw-bold text-uppercase"><?= $akunku['nama']; ?></span></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nomor Anggota: <b><?= $akunku['nomor_anggota']; ?></b></li>
                    <!-- <li class="list-group-item">Total Simpanan:  </li>
                    <li class="list-group-item">Total Pinjaman: </li> -->
                </ul>
                <!-- <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div> -->
                </div>

            <?php
            endforeach;
            } ?>
                
                
                <!-- <div id="carouselExampleIndicators" class="carousel slide col-md-6 my-auto" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="./assets/img/clay-banks-hwLAI5lRhdM-unsplash.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="./assets/img/jake-leonard-M2-OvzVD-0E-unsplash.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="./assets/img/jezael-melgoza-alY6_OpdwRQ-unsplash.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> -->
            </div>
            <!-- <img src="" alt="" class="position-absolute end-0 bottom-0 img-hero">
            <img src="assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img"> -->

        </div>
    </section>

    <!--Footer-->
    <section id="contact">
        <div class="container-fluid overlay h-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Pusat Bantuan</h3>
                    
                            <div class="kontak">
                                <h6>Kontak</h6>
                                <div class="mb-3 d-flex align-items-center">
                                    <div>
                                        <img src="assets/img/Alamat Icon.png" alt="">
                                    </div>
                                    
                                    <a href="#"><?=$koperasiku['alamat_koperasi'];?></a>
                                </div>
                                <div class="mb-3">
                                    <img src="assets/img/Whatsapp icon.png" alt="">
                                    <a href="#"><?=$koperasiku['telp_koperasi'];?></a>
                                </div>
                                <div class="mb-3">
                                    <img src="assets/img//Email Icon.png" alt="">
                                    <a href="#"><?=$koperasiku['email_koperasi'];?></a>
                                </div>
                            </div>
                            <h6>Social Media</h6>
                                <a href="" class="me-3"><img src="assets/img/Instagram Iicon.png" alt=""></a>
                                <a href="" class="me-3"><img src="assets/img/Facebook Icon.png" alt=""></a>
                                <a href="" class="me-3"><img src="assets/img/Twiter Icon.png" alt=""></a>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="card-contact w-100">
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
                            </div> -->
                    </div>
                </div> 
            </div>
        </div>
    </section>

    <footer class="d-flex align-items-center" id="footer">
        <div class="container-fluid ">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <img class="imgfoot" src="./assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="">
                        <a href="index.php"><?=$koperasiku['nama_koperasi'];?></a>
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
<?php
endforeach
?>