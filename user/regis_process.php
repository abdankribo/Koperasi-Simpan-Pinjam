<?php
   $form_error='';
// Memeriksa apakah permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Melakukan koneksi ke database
    include '../database.php';

    // Memeriksa koneksi database
    if (!$db) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Mengambil nilai dari formulir
    // $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
    $telp = mysqli_real_escape_string($db, $_POST['telp']);
    // $nik = mysqli_real_escape_string($db, $_POST['nik']);
    $tkelamin = mysqli_real_escape_string($db, $_POST['tkelamin']);
    // $koperasi = mysqli_real_escape_string($db, $_POST['koperasi']);
    $jabatan = mysqli_real_escape_string($db, $_POST['jabatan']);
    $kelompok = mysqli_real_escape_string($db, $_POST['kelompok']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $tgllahir = mysqli_real_escape_string($db, $_POST['tgllahir']);
    $tempatlahir = mysqli_real_escape_string($db, $_POST['tempatlahir']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $nomor_anggota = mysqli_real_escape_string($db, $_POST['noanggota']);

    // Mengecek apakah username atau email sudah terdaftar sebelumnya
    $check_query = "SELECT * FROM anggota WHERE nomor_anggota = '$nomor_anggota'";
    $check_result = mysqli_query($db, $check_query);

    if (mysqli_num_rows($check_result) >= 1) {
        // Login failed, display error message
        $form_error = '<div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 50px">
        <svg class="bi flex-shrink-1 me-3" width="25" height="25" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Nomor Anggota Telah terdaftar Atau Username Telah Terdaftar!
        </div>
        </div>';
    } else {
        // $result = mysqli_query($db, "SHOW TABLE STATUS LIKE 'anggota'");
        // $row = mysqli_fetch_assoc($result);
        // $nextAutoIncrement = $row['Auto_increment'];
        
        // // Format nilai auto increment
        // $nomor_anggota = sprintf("%03d", $nextAutoIncrement); // Menghasilkan format "001", "002", dst.
        
        // Query INSERT dengan nilai yang sudah diformat
        $sql = "INSERT INTO anggota (nama, nomor_anggota,  jabatan_anggota, unit, alamat, email, nomor_telepon, tempat_lahir, tanggal_lahir, jenis_kelamin, status_anggota, username_user, password_user) 
                  VALUES ('$fullname', '$nomor_anggota', '$jabatan', '$kelompok', '$alamat', '$email', '$telp', '$tempatlahir', '$tgllahir', '$tkelamin', '$status', '$$nomor_anggota', '$password')";
        
        // Jika belum terdaftar, lakukan pendaftaran
        
        if (mysqli_query($db, $sql)) {
             // Tampilkan pesan sukses dan redirect setelah 1 detik
             echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Registrasi</h5>
                     </div>
                     <div class="modal-body">
                         <p>Pendaftaran Akun Anggota Berhasil.</p>
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
                     window.location.href = "../index.php";
                 }
             </script>';
        } else {
             // Tampilkan pesan sukses dan redirect setelah 1 detik
             echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Registrasi</h5>
                     </div>
                     <div class="modal-body">
                         <p>Pendaftaran Akun Anggota Gagal.</p>
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
                     window.location.href = "register.php";
                 }
             </script>';
        }
    }

    // Menutup koneksi database
    mysqli_close($db);
}
?>
