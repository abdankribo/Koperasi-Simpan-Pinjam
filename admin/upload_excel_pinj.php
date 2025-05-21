<?php
require '../vendor/autoload.php';
include '../database.php';

$form_error = '';
$form_warning = '';
$form_success = '';
$jumlah_data = 0;
$jumlah_data_error = 0;
if(isset($_POST['eupload'])){
    $err = "";
    $ekstensi = "";
    $success = "";

    $file_name = $_FILES['tfile']['name'];
    $file_data = $_FILES['tfile']['tmp_name'];

    if(empty($file_name)){
        $err = "<li>Silahkan masukkan file yang akan di upload</li>";
        
    }else{
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls","xlsx");
    if(!in_array($ekstensi,$ekstensi_allowed)){
        $err = "Silahkan masukkan file sesuai format xls atau xlsx, File sebelumnya : <b>$file_name</b> berformat <b>$ekstensi</b>";
    }

    if(empty($err)){
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        // Validasi header kolom
        $expected_headers = array('no', 'no. anggota', 'nama', 'pinjaman pokok', 'pinjaman jasa', 'pinjaman pokok','pinjaman jasa', 'tanggal');
        $headers = array_map('strtolower', array_values($sheetData[0])); // Ambil header dari baris pertama dan ubah ke huruf kecil
    
        if (count(array_diff($expected_headers, $headers)) !== 0) {
            // Jika ada perbedaan antara header yang diharapkan dan yang ada dalam file
            $form_warning = '<div class="alert alert-warning d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                Data gagal di tambahkan, format data didalam file '.$file_name.' tidak sesuai!
                </div>
            </div>';
        } else {
            // Iterasi melalui data setelah header
            for ($i = 1; $i < count($sheetData); $i++) {
                // Isi kode Anda untuk iterasi data di sini
                $no_anggota = $sheetData[$i]['1'];
                $nama = $sheetData[$i]['2'];
                $ppokok = $sheetData[$i]['3'];
                $pjasa = $sheetData[$i]['4'];
                $apokok = $sheetData[$i]['5'];
                $ajasa = $sheetData[$i]['6'];
                $tgl = $sheetData[$i]['7'];
                
                if(empty($tgl)) {
                    $form_warning = '<div class="alert alert-warning d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Data gagal di tambahkan, Tanggal wajib di isi!
                        </div>
                    </div>';
                } else {
                    $bulan = date('m', strtotime($tgl));
        
                    $tgl_explode = explode("/",$tgl);
                    $tgl = $tgl_explode['2']."-".$tgl_explode['0']."-".$tgl_explode['1'];
                    
                    $simp_user= select("SELECT * FROM pinjaman WHERE nomor_anggota = '$no_anggota'");
                    $simp_user2 = select("SELECT * FROM anggota WHERE nomor_anggota = '$no_anggota'");
                    
                    $row = null;
                    if (!empty($simp_user)) { // Pastikan query mengembalikan hasil
                        $simp_user= select("SELECT * FROM pinjaman WHERE nomor_anggota = '$no_anggota'");
                        foreach ($simp_user as $simp) {
                            // Mengakses data dari $simp
                            $row = $simp['nomor_anggota'];
                        }
                        $row = $simp['nomor_anggota'];
                        if (!empty($row)) {
                            $query = "INSERT INTO pinjaman_record (id_anggota, pinjaman_pokok_rec, pinjaman_jasa_rec, angsuran_pokok, angsuran_jasa, tanggal_pinjaman, bulan) 
                            VALUES ('$no_anggota','$ppokok', '$pjasa', '$apokok', '$ajasa', '$tgl','$bulan' )";
                            
                            $query2 = "UPDATE pinjaman 
                            SET pinjaman_pokok = pinjaman_pokok + '$ppokok', pinjaman_jasa = pinjaman_jasa + '$pjasa', angsuran_pokok = angsuran_pokok + '$apokok', angsuran_jasa = angsuran_jasa + '$ajasa' WHERE nomor_anggota = '$no_anggota'";
                            
                            $update = mysqli_query($db, $query);
                            $update2 = mysqli_query($db, $query2);
                            $jumlah_data ++;
                            
                        } 
                    }else if(!empty($simp_user2)){
                            $simp_user2 = mysqli_query($db, "SELECT * FROM anggota WHERE nomor_anggota = '$no_anggota'");
                            while ($simp = mysqli_fetch_array($simp_user2)) {
                                $nomor_anggota2 = $simp['nomor_anggota'];
                                $nama = $simp['nama'];
                                $unit = $simp['unit'];
            
                                $query3 = "INSERT INTO pinjaman (nomor_anggota, nama_anggota, unit, pinjaman_pokok, pinjaman_jasa, angsuran_pokok, angsuran_jasa) 
                                            VALUES ('$nomor_anggota2','$nama', '$unit', '$ppokok', '$pjasa', '$apokok','$ajasa')";
                                $update3 = mysqli_query($db, $query3);
        
                                $query4 = "INSERT INTO pinjaman_record (id_anggota, pinjaman_pokok_rec, pinjaman_jasa_rec, angsuran_pokok, angsuran_jasa, tanggal_pinjaman, bulan) 
                                            VALUES ('$nomor_anggota2','$ppokok', '$pjasa', '$apokok', '$ajasa', '$tgl','$bulan' )";
                                $update4 = mysqli_query($db, $query4);
                                            $jumlah_data ++;
                            } 
                    }else{
                        $jumlah_data_error ++;
                    }
                }
            }
        }
    
    
        if (isset($update) && isset($update2)) {
            if ($jumlah_data > 0 && $jumlah_data_error == 0){
                
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
            
                // Menambahkan script JavaScript untuk pengalihan halaman setelah 2 detik
                $form_success .= '<script>
                    window.onload = function() {
                        // Redirect to pinjaman.php after 2 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 3000);
                    }
            
                    function redirectToIndex() {
                        window.location.href = "pinjaman.php";
                    }
                </script>';
            }
            else{
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
                $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    '.$jumlah_data_error.' data gagal di tambahkan, data anggota tidak ditemukan/tidak terdaftar di sistem!
                    </div>
                </div>';
                $form_success .= '<script>
                    window.onload = function() {
                        // Redirect to pinjaman.php after 2 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 3000);
                    }
            
                    function redirectToIndex() {
                        window.location.href = "pinjaman.php";
                    }
                </script>';
            }
        }elseif (isset($update3) && isset($update4)) {
            if ($jumlah_data > 0 && $jumlah_data_error == 0){
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
                $form_success .= '<script>
                    window.onload = function() {
                        // Redirect to pinjaman.php after 2 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 3000);
                    }
            
                    function redirectToIndex() {
                        window.location.href = "pinjaman.php";
                    }
                </script>';
            }else{
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
                $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    '.$jumlah_data_error.' data gagal di tambahkan, data anggota tidak ditemukan/tidak terdaftar di sistem!
                    </div>
                </div>';
                $form_success .= '<script>
                    window.onload = function() {
                        // Redirect to pinjaman.php after 2 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 3000);
                    }
            
                    function redirectToIndex() {
                        window.location.href = "pinjaman.php";
                    }
                </script>';
            }
        }else{
            $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
                '.$jumlah_data_error.' data gagal di tambahkan, data anggota tidak ditemukan/tidak terdaftar di sistem!
                </div>
            </div>';
            $form_success .= '<script>
                    window.onload = function() {
                        // Redirect to pinjaman.php after 2 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 3000);
                    }
            
                    function redirectToIndex() {
                        window.location.href = "pinjaman.php";
                    }
                </script>';
        }
    }

    if($err){
        $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
                '.$err.'
                </div>
            </div>';
    }

    if($success){
        ?>
        <div class="alert alert-success">
            <ul><?php echo $success ?></ul>
        </div>
        <?php
    }

}

?>