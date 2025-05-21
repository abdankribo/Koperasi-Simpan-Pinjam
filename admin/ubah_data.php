<?php
include '../database.php';

if (isset($_POST['ssimpan'])) {
    // Mendapatkan informasi file yang diunggah
    $file_name = $_FILES['sfile']['name'];
    $file_temp = $_FILES['sfile']['tmp_name'];
    $file_size = $_FILES['sfile']['size'];
    $file_type = $_FILES['sfile']['type'];
    
    // Direktori tempat menyimpan file di server
    $upload_dir = 'uploads/';

    // Mendapatkan nilai dari form
    $id_materi = $_POST['id_materi']; // Ambil id materi dari form
    $nama_materi = $_POST['spelatihan'];
    $tgl_pelatihan = $_POST['stanggal'];

    // Jika ada file yang diunggah, lakukan proses upload
    if ($file_name) {
        if (move_uploaded_file($file_temp, $upload_dir . $file_name)) {
            // File berhasil diunggah, selanjutnya simpan informasi ke database
            $query = "UPDATE materi 
                      SET nama_materi='$nama_materi', tgl_pelatihan='$tgl_pelatihan', dokumen_materi='$upload_dir$file_name' 
                      WHERE id_materi=$id_materi";

            // Lakukan query update
            $update = mysqli_query($db, $query);

            if ($update) {
                echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Successful</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Edit Dokumen Berhasil.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();

                    // Redirect to Index.php after 1 second
                    setTimeout(function() {
                        redirectToIndex();
                    }, 1000);
                }

                function redirectToIndex() {
                    window.location.href = "tambah_materi.php";
                }
            </script>';
            } else {
                echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Successful</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Edit Dokumen Gagal.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();

                    // Redirect to Index.php after 1 second
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
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Successful</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Edit Dokumen Berhasil.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();

                    // Redirect to Index.php after 1 second
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
        // Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        $query = "UPDATE materi 
                  SET nama_materi='$nama_materi', tgl_pelatihan='$tgl_pelatihan' 
                  WHERE id_materi=$id_materi";

        // Lakukan query update
        $update = mysqli_query($db, $query);

        if ($update) {
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Successful</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Edit Dokumen Berhasil.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();

                    // Redirect to Index.php after 1 second
                    setTimeout(function() {
                        redirectToIndex();
                    }, 1000);
                }

                function redirectToIndex() {
                    window.location.href = "tambah_materi.php";
                }
            </script>';
        } else {
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Failed</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Edit Dokumen Gagal.</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("editUserSuccess"));
                    myModal.show();

                    // Redirect to Index.php after 1 second
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
}
?>
