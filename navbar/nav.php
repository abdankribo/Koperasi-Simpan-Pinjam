<!--Nav-->
<?php

include '../database.php';
$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):
?>

<nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #009D9D; ">
        <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <?=$koperasiku['nama_koperasi'];?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <?php          
            if(isset($_SESSION['IsUser'])) {
              $id_user = $_SESSION['IsUser']; // Ambil user_id dari session
                            
              $user = select("SELECT * FROM anggota WHERE id = '$id_user'"); 
              foreach ($user as $akunku):
                ?>
                <li class="nav-item dropdown" onmouseover="showDropdown()" onmouseout="hideDropdown()">
                    <a class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'akunsaya.php') echo 'active'; ?> mx-1" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-current="page" href="#">Hi, <span class="fw-bold text-uppercase"><?= $akunku['nama']; ?></span></a>
                    <ul class="dropdown-menu" id="myDropdown" aria-labelledby="navbarDropdownMenuLink">
                          <li><a class="dropdown-item" href="../user/akunsaya.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg> Profil Saya</a></li>
                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#form_edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                            </svg> Edit Profil</a></li>
                      </ul>
                  </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'keuangan.php') echo 'active'; ?> mx-1" aria-current="page" href="./keuangan.php">Keuangan</a>
                </li>
                <?php
                endforeach;
                } 
                // Jika pengguna belum login, tampilkan tombol Masuk
                ?>
                <li class="nav-item dropdown" onmouseover="showDropdown2()" onmouseout="hideDropdown2()">
                    <a class="nav-link dropdown-toggle mx-1" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Koperasi Kita
                    </a>
                    <ul class="dropdown-menu" id="myDropdown2" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="./sejarah.php">Sejarah</a></li>
                      <li><a class="dropdown-item" href="./dokumentasi_gambar.php">Dokumentasi</a></li>
                      <!-- <li><a class="dropdown-item" href="./create.php">create</a></li> -->


                      <!-- <li><a class="dropdown-item" href="./regulasi.php">Regulasi</a></li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'dokumen.php') echo 'active'; ?> mx-1" aria-current="page" href="./dokumen.php">Dokumen</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == '../index.php') echo 'active'; ?> mx-1" aria-current="page" href="../index.php">Home</a>
                </li>
                
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
                <div><button class="btn btn-outline-light btn-sm link-up"><a class="link-up4" href="../index.php">Masuk</a></button></div>
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
        <button type="button" class="btn btn-danger"><a class="link-up4" href="../logout.php">Logout</a></button>
      </div>
    </div>
  </div>
</div>
<?php 
    include 'akunsaya_edit.php';
    if(isset($_SESSION['IsUser'])) {
    foreach ($user as $akunku):
?>
<div class="modal fade" id="form_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="./akunsaya.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <!-- <div class="form-floating mb-3">
                <input type="text" name="tnamalengkap" class="form-control" value="<?= $akunku['nama']; ?>">
                <label for="floatingInputnamalengkap">Nama Lengkap</label>
            </div> -->
            <!-- <div class="form-floating mb-3">
                <input type="text" name="tnik" class="form-control" value="<?= $akunku['NIK']; ?>">
                <label for="floatingInputtelp">NIK</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="ttelp" class="form-control" value="<?= $akunku['nomor_telepon']; ?>">
                <label for="floatingInputtelp">No. Telp/Wa</label>
            </div> -->
            <!-- <div class="form-floating mb-3">
                <input type="text" class="form-control" value="<?= $akunku['password_user']; ?>" disabled>
                <label for="floatingInputusername">Password Lama</label>
            </div> -->
            <!-- <div class="form-floating mb-3">
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
            </div> -->
            <div class="form-floating mb-3">
                <input type="text" name="tpassword" class="form-control" value="<?= $akunku['password_user']; ?>">
                <label for="floatingInputpassword">Ganti Password</label>
            </div>
            <!-- <div class="form-floating mb-3">
                <input type="text" name="talamat" class="form-control" value="<?= $akunku['alamat']; ?>">
                <label for="floatingInputalamat">Alamat</label>
            </div> -->
            <!-- <div class="form-floating mb-3">
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
            </div> -->

            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Foto (Jpg,Jpeg atau PNG. Max 5 mb)</label>
                <input class="form-control" name="tfile" type="file" accept="image/jpeg, image/jpg, image/png" />
                <p>File yang sudah diunggah sebelumnya:<br><b><?= $akunku['foto_anggota']; ?></b></p>
                <div class="col-md-4">
                <?php
                    // Pastikan $akunku tidak kosong sebelum mencoba mengakses kunci 'foto_user'
                    if (!empty($akunku['foto_anggota'])) {
                        $file_name = $akunku['foto_anggota'];
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
</div>

<?php
endforeach;
  }
endforeach;
?>
