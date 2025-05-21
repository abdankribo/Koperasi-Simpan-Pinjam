<?php
include '../database.php';

if (isset($_POST['bsimpan'])) {
    // Mendapatkan informasi file yang diunggah
    $file_name = $_FILES['tfile']['name'];
    $file_temp = $_FILES['tfile']['tmp_name'];
    $file_size = $_FILES['tfile']['size'];
    $file_type = $_FILES['tfile']['type'];
    
    // Direktori tempat menyimpan file di server
    $upload_dir = 'uploads/';

    // Mencari nama unik untuk file
    $unique_file_name = $file_name;
    $i = 1;
    while (file_exists($upload_dir . $unique_file_name)) {
        $unique_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . $i . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
        $i++;
    }

    // Pindahkan file ke direktori yang ditentukan
    if (move_uploaded_file($file_temp, $upload_dir . $unique_file_name)) {
        // File berhasil diunggah, selanjutnya simpan informasi ke database
        $nama_materi = $_POST['tpelatihan'];
        $tgl_pelatihan = $_POST['ttanggal'];

        // Query untuk menyimpan informasi ke dalam database
        $query = "INSERT INTO materi (nama_materi, tgl_pelatihan, dokumen_materi) 
                  VALUES ('$nama_materi', '$tgl_pelatihan', '$upload_dir$unique_file_name')";

        // Lakukan query
        $simpan = mysqli_query($db, $query);

        if ($simpan) {
            // Tampilkan pesan sukses dan redirect setelah 1 detik
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Materi</h5>
                    </div>
                    <div class="modal-body">
                        <p>Tambah Dokumen Berhasil.</p>
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
                    window.location.href = "tambah_materi.php";
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
                        <p>Tambah Dokumen Gagal.</p>
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
                    window.location.href = "tambah_materi.php";
                }
            </script>';
        }
    } else {
        // Tampilkan pesan gagal dan redirect setelah 1 detik
        echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Dokumen</h5>
                    </div>
                    <div class="modal-body">
                        <p>Upload Dokumen Gagal.</p>
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
                    window.location.href = "tambah_materi.php";
                }
            </script>';
    }
}
