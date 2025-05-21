<!--Nav-->
<?php

include '../database.php';
$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):
?>
<nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #009D9D; ">
        <div class="container-fluid">
        <a class="navbar-brand" href="./pihak3_edit_anggota.php">
            <img src="../assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <?=$koperasiku['nama_koperasi'];?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'pihak3_edit_anggota.php') echo 'active'; ?> mx-1" href="./pihak3_edit_anggota.php">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'pihak3_dokumen.php') echo 'active'; ?> mx-1" href="./pihak3_dokumen.php">Dokumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'pihak3_pinjaman.php') echo 'active'; ?> mx-1" href="./pihak3_pinjaman.php">Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'pihak3_simpanan.php') echo 'active'; ?> mx-1" href="./pihak3_simpanan.php">Simpanan</a>
                </li>
                
                <?php
                
                if(isset($_SESSION['IsMaster'])) {
                    // Jika pengguna sudah login, tampilkan tombol Log Out
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mx-1" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Master Admin
                        </a>
                        <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./dashboard.php">DASHBOARD</a></li>
                            <li><a class="dropdown-item" href="../user/akunsaya.php">Akun Saya</a></li>
                            <li><a class="dropdown-item" href="./form.php">-</a></li>
                            <li><a class="dropdown-item" href="./regulasi.php">-</a></li>
                        </ul> -->
                    </li>
                    <?php
                } else {
                    // Jika pengguna belum login, tampilkan tombol Masuk
                   
                }
                ?>
                
            </ul>
            <?php
            
            if(isset($_SESSION['IsMaster'])) {
                // Jika pengguna sudah login, tampilkan tombol Log Out
                ?>
                <div><button class="btn btn-outline-danger btn-sm link-up" data-bs-toggle="modal" data-bs-target="#logoutAkun">Logout</button></div>
                <?php
            } else {
                // Jika pengguna belum login, tampilkan tombol Masuk
                ?>
                <div><button class="button-primary"><a class="link-up" href="../admin.php">Masuk</a></button></div>
                <?php
            }
            ?>
            </div>
        </div>
    </nav>

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
endforeach
?>