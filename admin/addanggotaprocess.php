<?php
include '../database.php';

if (isset($_POST['bsimpan'])) {
    
        // File berhasil diunggah, selanjutnya simpan informasi ke database
        $nomor_anggota = $_POST['tnoanggota'];
        $nama_anggota = $_POST['tnama'];
        // $username = $_POST['tusernama'];
        // $password = $_POST['tpassword'];
        $nama_koperasi = $_POST['tnamakop'];
        $kelompok = $_POST['tkelompok'];
        $jabatan = $_POST['tjabatan'];
        $NIK = $_POST['tnik'];
        $alamat_anggota = $_POST['talamat'];
        $email_anggota = $_POST['temail'];
        $telp_anggota = $_POST['ttelp'];
        $lahir_anggota = $_POST['tlahir'];
        $tlahir_anggota = $_POST['ttempatlahir'];
        $kelamin_anggota = $_POST['tkelamin'];
        $status_anggota = $_POST['tstatus'];

        $nomor_anggota_formatted = sprintf('%03d', $nomor_anggota);

        // Pengecekan apakah nomor anggota sudah ada
        $existing_result = mysqli_query($db, "SELECT * FROM anggota WHERE nomor_anggota = $nomor_anggota");
        if(mysqli_num_rows($existing_result) > 0) {
            // Nomor anggota sudah ada, Anda dapat menangani kasus ini sesuai kebutuhan Anda
            echo "Nomor anggota sudah ada dalam database.";
        } else {
            // Nomor anggota belum ada, lakukan INSERT
            $query = "INSERT INTO anggota (nama, nomor_anggota, NIK, jabatan_anggota, koperasi_user, unit, alamat, email, nomor_telepon, tempat_lahir, tanggal_lahir, jenis_kelamin, status_anggota, username_user, password_user) 
                    VALUES ('$nama_anggota', '$nomor_anggota_formatted', '$NIK','$jabatan', '$nama_koperasi','$kelompok', '$alamat_anggota', '$email_anggota', '$telp_anggota', '$tlahir_anggota', '$lahir_anggota', '$kelamin_anggota', '$status_anggota', '$nomor_anggota_formatted', '$nomor_anggota_formatted')";
            
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
                        <p>Tambah Anggota Berhasil.</p>
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
                    window.location.href = "edit_anggota.php";
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
                        <p>Tambah Anggota Gagal, Nomor Anggota '.$nomor_anggota.' Sudah ada!</p>
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
                    window.location.href = "edit_anggota.php";
                }
            </script>';
        }
    
    }

