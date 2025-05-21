<?php
include '../database.php';
if (isset($_POST['bsimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $nomor_anggota = $_POST['tnomoranggota'];
        $ppokok = $_POST['ppokok'];
        $pjasa = $_POST['pjasa'];
        $apokok = $_POST['apokok'];
        $ajasa = $_POST['ajasa'];
        $fullDate = $_POST['tbulan']; // Ambil tanggal lengkap dari form
        $bulan = date('m', strtotime($fullDate)); // Ambil hanya bulan dari tanggal lengkap
        
        $row ='';
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        
        $simp_user= select("SELECT * FROM pinjaman WHERE nomor_anggota = '$nomor_anggota'");
        foreach ($simp_user as $simp){
            $row = $simp['nomor_anggota'];
        }
        
        if (!empty($row)) {
            $query = "INSERT INTO pinjaman_record (id_anggota, pinjaman_pokok_rec, pinjaman_jasa_rec, angsuran_pokok, angsuran_jasa, tanggal_pinjaman, bulan) 
            VALUES ('$nomor_anggota','$ppokok', '$pjasa', '$apokok', '$ajasa', CURRENT_TIMESTAMP,'$bulan' )";
            
            $query2 = "UPDATE pinjaman 
            SET pinjaman_pokok = pinjaman_pokok + '$ppokok', pinjaman_jasa = pinjaman_jasa + '$pjasa', angsuran_pokok = angsuran_pokok + '$apokok', angsuran_jasa = angsuran_jasa + '$ajasa' WHERE nomor_anggota = '$nomor_anggota'";
            
            $update = mysqli_query($db, $query);
            $update2 = mysqli_query($db, $query2);

            if ($update && $update2) {
                echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Successful</h5>
                            
                        </div>
                        <div class="modal-body">
                            <p>Tambah data Pinjaman anggota Berhasil.</p>
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
            }else {
                echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Successful</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>Tambah data Pinjaman anggota Gagal.</p>
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
            } else {
                $simp_user = mysqli_query($db, "SELECT * FROM anggota WHERE nomor_anggota = '$nomor_anggota'");
                while ($simp = mysqli_fetch_array($simp_user)) {
                    $nomor_anggota2 = $simp['nomor_anggota'];
                    $nama = $simp['nama'];
                    $unit = $simp['unit'];

                    $query3 = "INSERT INTO pinjaman (nomor_anggota, nama_anggota, unit, pinjaman_pokok, pinjaman_jasa, angsuran_pokok, angsuran_jasa) 
                                VALUES ('$nomor_anggota2','$nama', '$unit', '$ppokok', '$pjasa', '$apokok','$ajasa')";
                    $update3 = mysqli_query($db, $query3);

                    $query4 = "INSERT INTO pinjaman_record (id_anggota, pinjaman_pokok_rec, pinjaman_jasa_rec, angsuran_pokok, angsuran_jasa, tanggal_pinjaman, bulan) 
                                VALUES ('$nomor_anggota2','$ppokok', '$pjasa', '$apokok', '$ajasa', CURRENT_TIMESTAMP,'$bulan' )";
                    $update4 = mysqli_query($db, $query4);
                }
                if ($update3 && $update4) {
                    echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Successful</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>Tambah data Pinjaman anggota baru Berhasil.</p>
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
                }else {
                    echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Failed</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>Tambah data Pinjaman anggota baru Gagal.</p>
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
        }
    
?>