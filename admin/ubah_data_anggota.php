<?php

if (isset($_POST['ssimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $id_anggota = $_POST['id_anggota'];
        $nama_anggota = $_POST['tnama'];
        $nama_koperasi = $_POST['tnamakop'];
        $username = $_POST['tusername'];
        $password = $_POST['tpassword'];
        $nomor_anggota = $_POST['tnoanggota'];
        $kelompok = $_POST['tkelompok'];
        $jabatan = $_POST['tjabatan'];
        $alamat_anggota = $_POST['talamat'];
        $email_anggota = $_POST['temail'];
        $telp_anggota = $_POST['ttelp'];
        $lahir_anggota = $_POST['tlahir'];
        $tlahir_anggota = $_POST['ttempatlahir'];
        $kelamin_anggota = $_POST['tkelamin'];
        $status_anggota = $_POST['tstatus'];

        $nomor_anggota_formatted = sprintf('%03d', $nomor_anggota);

        if(!empty($lahir_anggota)) {

        } else {
            // Set $tgl to "00-00-0000" if it's empty
            $lahir_anggota = "00-00-0000";
        }
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        $query = "UPDATE anggota 
                  SET nama='$nama_anggota', koperasi_user='$nama_koperasi',nomor_anggota='$nomor_anggota_formatted', unit='$kelompok', jabatan_anggota='$jabatan', alamat='$alamat_anggota', nomor_telepon='$telp_anggota', email='$email_anggota', 
                    tempat_lahir='$tlahir_anggota', tanggal_lahir='$lahir_anggota',username_user='$username' ,password_user= '$password',
                    jenis_kelamin='$kelamin_anggota', status_anggota='$status_anggota'
                  WHERE id=$id_anggota";
        
        $query2 = "UPDATE pinjaman 
                  SET nama_anggota='$nama_anggota', unit='$kelompok'
                  WHERE nomor_anggota=$nomor_anggota";

        $query3 = "UPDATE simpanan 
        SET nama_anggota='$nama_anggota', unit='$kelompok'
        WHERE nomor_anggota=$nomor_anggota";
        // Lakukan query update
        $update = mysqli_query($db, $query);
        $update2 = mysqli_query($db, $query2);
        $update3 = mysqli_query($db, $query3);

        if ($update && $update2 && $update3) {
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
                    window.location.href = "edit_anggota.php";
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
                    window.location.href = "edit_anggota.php";
                }
            </script>';
        }
    }
?>