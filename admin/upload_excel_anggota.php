<?php
require '../vendor/autoload.php';
include '../database.php';

$form_error = '';
$form_warning = '';
$form_success = '';
$jumlah_data = 0;
$jumlah_data_error = 0;
if(isset($_POST['aupload'])){
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


    if(empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Validasi header kolom
        $expected_headers = array('no', 'no.anggota', 'nama', 'jabatan', 'alamat', 'no.telp', 'tempat lahir', 'tgl lahir', 'jenis kelamin', 'status', 'kelompok');
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
                $jabatan = $sheetData[$i]['3'];
                $alamat = $sheetData[$i]['4'];
                $telp = $sheetData[$i]['5'];
                $tmptlahir = $sheetData[$i]['6'];
                $tgl = $sheetData[$i]['7'];
                $kelamin = $sheetData[$i]['8'];
                $status = $sheetData[$i]['9'];
                $keterangan = $sheetData[$i]['10'];
                if(empty($keterangan)) {
                    $form_warning = '<div class="alert alert-warning d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Data gagal di tambahkan, Kelompok wajib di isi!
                        </div>
                    </div>';
                } else {
               
                    // Check if $tgl is not empty before exploding
                    if(!empty($tgl)) {
                        $tgl_explode = explode("/", $tgl);
                        // Check if array keys exist before accessing them
                        $year = isset($tgl_explode[2]) ? $tgl_explode[2] : "00";
                        $month = isset($tgl_explode[0]) ? $tgl_explode[0] : "00";
                        $day = isset($tgl_explode[1]) ? $tgl_explode[1] : "0000";
                        $tgl = $year . "-" . $month . "-" . $day;
                    } else {
                        // Set $tgl to "00-00-0000" if it's empty
                        $tgl = "00-00-0000";
                    }
        
                    $row = null;
                    $simp_user = select("SELECT * FROM anggota WHERE nomor_anggota = '$no_anggota'");
                                
        
                    if (empty($simp_user)) {
                        $query = "INSERT INTO anggota (nomor_anggota, nama, username_user, password_user, jabatan_anggota, alamat, nomor_telepon, tempat_lahir, tanggal_lahir, jenis_kelamin, status_anggota, unit) 
                        VALUES ('$no_anggota','$nama', '$no_anggota', '$no_anggota', '$jabatan', '$alamat','$telp','$tmptlahir', '$tgl','$kelamin', '$status', '$keterangan' )";
                            
                            
                        $update = mysqli_query($db, $query);
                            
                        $jumlah_data ++;
                            
                    } else {
                        $jumlah_data_error ++;
                    }
                }
            }
        }
    
    
        if (isset($update)) {
            if ($jumlah_data > 0 && $jumlah_data_error == 0){
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
                
            }else{
                $form_success = '<div class="alert alert-success d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>' . $jumlah_data . ' data berhasil di upload !
                    </div>
                </div>';
                $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    '.$jumlah_data_error.' data gagal di tambahkan, data anggota telah terdaftar sebelumnya di sistem!
                    </div>
                </div>';}
        
        }else{
            $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
                '.$jumlah_data_error.' data gagal di tambahkan, akun sudah ada atau data tidak sesuai format!
                </div>
            </div>';
        }
    }

    else{
        $form_error = '<div class="alert alert-danger d-flex align-items-center col-md-12 mt-3" role="alert" style="height: 20px">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
             <div>
                Gagal Upload!, Isi dokumen tidak sesuai format.
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