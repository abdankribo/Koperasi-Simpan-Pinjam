<?php
include '../database.php';
if (isset($_POST['ssimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $id_anggota = $_POST['id_anggota'];
        $nomor_anggota = $_POST['tnomoranggota'];
        $nama_koperasi = $_POST['tnama'];
        $keterangan = $_POST['keterangan'];
        $pokok = $_POST['tpokok'];
        $wajib = $_POST['twajib'];
        $sukarela = $_POST['tsukarela'];
        $hariraya = $_POST['thariraya'];
        $khusus = $_POST['tkhusus'];
        
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        $query = "UPDATE simpanan 
                  SET nomor_anggota='$nomor_anggota', nama_anggota='$nama_koperasi', unit='$keterangan',spokok='$pokok', swajib='$wajib',  
                    ssukarela ='$sukarela',shariraya='$hariraya', 
                    skhusus='$khusus',unit='$keterangan'
                  WHERE id_smp=$id_anggota";

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
                        <p>Edit data anggota Berhasil.</p>
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
                    window.location.href = "simpanan.php";
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
                        <p>Edit data anggota Gagal.</p>
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
                    window.location.href = "simpanan.php";
                }
            </script>';
        }
    }
?>