<?php

if (isset($_POST['ssimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $id_master = $_POST['tmaster'];
        $username = $_POST['tusername'];
        $password = $_POST['tpassword'];
        $kelompok = $_POST['tkelompok'];
        
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file

        $query = "UPDATE master_admin 
                  SET username_master='$username', password_master='$password', unit='$kelompok'
                  WHERE id_master=$id_master";


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
                        <p>Edit data Akun Master Berhasil.</p>
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
                    window.location.href = "pihak3.php";
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
                        <p>Edit data Akun Master Gagal.</p>
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
                    window.location.href = "pihak3.php";
                }
            </script>';
        }
    }
?>