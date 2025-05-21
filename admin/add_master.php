<?php
include '../database.php';

if (isset($_POST['bsimpan'])) {
    
        // File berhasil diunggah, selanjutnya simpan informasi ke database
        $username = $_POST['tusername'];
        $password = $_POST['tpassword'];
        $kelompok = $_POST['tkelompok'];

        // Pengecekan apakah nomor anggota sudah ada
        $username = mysqli_real_escape_string($db, $username);
        $existing_result = mysqli_query($db, "SELECT * FROM master_admin WHERE username_master = '$username'");
        if(mysqli_num_rows($existing_result) > 0) {
            // Nomor anggota sudah ada, Anda dapat menangani kasus ini sesuai kebutuhan Anda
            echo "Username sudah ada dalam database.";
        } else {
            // Nomor anggota belum ada, lakukan INSERT
            $query = "INSERT INTO master_admin (username_master, password_master, unit) 
                    VALUES ('$username', '$password', '$kelompok')";
            
            // Lakukan query
            $simpan = mysqli_query($db, $query);
        }

        if ($simpan) {
            // Tampilkan pesan sukses dan redirect setelah 1 detik
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Anggota</h5>
                    </div>
                    <div class="modal-body">
                        <p>Tambah Akun Master Berhasil.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();
                    setTimeout(function() {
                        redirectToIndex();
                    }, 1000);
                }

                function redirectToIndex() {
                    window.location.href = "pihak3.php";
                }
            </script>';
        } else {
            // Tampilkan pesan gagal dan redirect setelah 1 detik
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Materi</h5>
                    </div>
                    <div class="modal-body">
                        <p>Tambah Akun Gagal, Username '.$username.' Sudah ada!</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();
                    setTimeout(function() {
                        redirectToIndex();
                    }, 2000);
                }

                function redirectToIndex() {
                    window.location.href = "pihak3.php";
                }
            </script>';
        }
    
    }

