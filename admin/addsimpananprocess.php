<?php
include '../database.php';
if (isset($_POST['bsimpan'])) {
// File berhasil diunggah, selanjutnya simpan informasi ke database
        $nomor_anggota = $_POST['tnomoranggota'];
        $pokok = $_POST['tpokok'];
        $wajib = $_POST['twajib'];
        $sukarela = $_POST['tsukarela'];
        $hariraya = $_POST['thariraya'];
        $khusus = $_POST['tkhusus'];
        $fullDate = $_POST['tbulan']; // Ambil tanggal lengkap dari form
        $bulan = date('m', strtotime($fullDate)); // Ambil hanya bulan dari tanggal lengkap
        
        $row ='';
// Jika tidak ada file yang diunggah, lakukan update tanpa mengubah file
        
        $simp_user= select("SELECT * FROM simpanan WHERE nomor_anggota = '$nomor_anggota'");
        foreach ($simp_user as $simp){
            $row = $simp['nomor_anggota'];
        }
        if (!empty($row)) {
            $query = "INSERT INTO simpanan_record (id_anggota, pokok_rec, wajib_rec, sukarela_rec, hariraya_rec, khusus_rec, tgl_simpanan, bulan) 
            VALUES ('$nomor_anggota','$pokok', '$wajib', '$sukarela', '$hariraya', '$khusus', CURRENT_TIMESTAMP,'$bulan' )";
            
            $query2 = "UPDATE simpanan 
            SET spokok = spokok + '$pokok', swajib = swajib + '$wajib', ssukarela = ssukarela + '$sukarela', shariraya = shariraya + '$hariraya', skhusus = skhusus + '$khusus' WHERE nomor_anggota = '$nomor_anggota'";
            
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
                            <p>Tambah data Simpanan anggota Berhasil.</p>
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
            }else {
                echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Successful</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>Tambah data Simpanan anggota Gagal.</p>
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
            } else {
                $simp_user = mysqli_query($db, "SELECT * FROM anggota WHERE nomor_anggota = '$nomor_anggota'");
                while ($simp = mysqli_fetch_array($simp_user)) {
                    $nomor_anggota2 = $simp['nomor_anggota'];
                    $nama = $simp['nama'];
                    $unit = $simp['unit'];

                    $query3 = "INSERT INTO simpanan (nomor_anggota, nama_anggota, unit, spokok, swajib, ssukarela, shariraya, skhusus) 
                                VALUES ('$nomor_anggota2','$nama', '$unit', '$pokok', '$wajib', '$sukarela','$hariraya', '$khusus')";
                    $update3 = mysqli_query($db, $query3);

                    $query4 = "INSERT INTO simpanan_record (id_anggota, pokok_rec, wajib_rec, sukarela_rec, hariraya_rec, khusus_rec, tgl_simpanan, bulan) 
                                VALUES ('$nomor_anggota2','$pokok', '$wajib', '$sukarela', '$hariraya', '$khusus', CURRENT_TIMESTAMP,'$bulan' )";
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
                                <p>Tambah data Simpanan anggota baru Berhasil.</p>
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
                }else {
                    echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Failed</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>Tambah data Simpanan anggota baru Gagal.</p>
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
        }
    
?>