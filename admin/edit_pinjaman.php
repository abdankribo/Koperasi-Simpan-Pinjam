<?php
include '../database.php';
if (isset($_POST['ssimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $id_anggota = $_POST['id_anggota'];
        $nomor_anggota = $_POST['tnomoranggota'];
        $nama_anggota = $_POST['tnama'];
        $ppokok = $_POST['ppokok'];
        $pjasa = $_POST['pjasa'];
        $apokok = $_POST['apokok'];
        $ajasa = $_POST['ajasa'];
        $keterangan = $_POST['keterangan'];
        
        
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        $query = "UPDATE pinjaman 
                  SET nomor_anggota='$nomor_anggota', nama_anggota='$nama_anggota', pinjaman_pokok='$ppokok', pinjaman_jasa='$pjasa',  
                    angsuran_pokok ='$apokok',angsuran_jasa='$ajasa', 
                    unit='$keterangan'
                  WHERE id_pinjaman=$id_anggota";

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
                    window.location.href = "pinjaman.php";
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
                    window.location.href = "pinjaman.php";
                }
            </script>';
        }
    }
?>