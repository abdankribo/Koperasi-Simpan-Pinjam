<?php 
require './admin_session.php';
include '../database.php';
function select($query) {

    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
$id_admin = $_SESSION['IsAdmin']; // Ambil user_id dari session?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Logo Title-->
    <link rel="stylesheet" href="css/style.css">
    <?php
    include '../navbar/title.php'
    ?> 
  </head>
  <body>
<?php
if(isset($_POST['bsimpan'])) {
    // $nama_lengkap = $_POST['tnamalengkap'];
    // $nik_user = $_POST['tnik'];
    // $no_telp = $_POST['ttelp'];
    // $username = $_POST['tusername'];
    // $koperasi = $_POST['tkoperasi'];
    // $jabatan = $_POST['tjabatan'];
    // $email = $_POST['temail'];
    $password = $_POST['tpassword'];
    // $alamat = $_POST['talamat'];
    // $tanggal_lahir = $_POST['ttanggal'];
    // $tempat_lahir = $_POST['tkota'];
    // $status = $_POST['tstatus'];
    $last = time();

    // File upload handling
    // if(isset($_FILES['tfile']) && $_FILES['tfile']['size'] > 0) { // Check if a file is uploaded
    //     // Get file information
    //     $file_name = $_FILES['tfile']['name'];
    //     $file_size = $_FILES['tfile']['size'];
    //     $file_tmp = $_FILES['tfile']['tmp_name'];
    //     $file_type = $_FILES['tfile']['type'];
    //     $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    //     $upload_dir = 'image_user/';
    //     $extensions = array("jpeg", "jpg", "png");
    
    //     if (in_array($file_ext, $extensions) === false) {
    //         echo "Extensi file tidak valid, silakan pilih file JPEG, JPG, atau PNG.";
    //         exit; // Stop execution if file extension is not valid
    //     }
    
    //     if ($file_size > 5 * 1024 * 1024) {
    //         echo "Ukuran file melebihi batas maksimum (5 MB).";
    //         exit; // Stop execution if file size exceeds the limit
    //     }
    //     $query_select_old_image = "SELECT foto_anggota FROM anggota WHERE id = $id_user";
    //     $result_select_old_image = mysqli_query($db, $query_select_old_image);
    //     $row = mysqli_fetch_assoc($result_select_old_image);
    //     $old_image = $row['foto_anggota'];

    //     // Check if there are no errors in the file upload process
    //     if (empty($errors)) {
    //         // Remove old photo if it exists
    //         if (!empty($old_image)) {
    //             $old_image_path = "image_user/" . $old_image;
    //             if (file_exists($old_image_path)) {
    //                 unlink($old_image_path); // Delete the old image file
    //             }
    //         }
    //         $unique_file_name = $file_name;
    //         $i = 1;
    //         while (file_exists($upload_dir . $unique_file_name)) {
    //             $unique_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . $i . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
    //             $i++;
    //         }
    
    //         // Move the uploaded file to the destination folder
    //         move_uploaded_file($file_tmp, "image_user/" . $unique_file_name);
    //     }
    // }
    
    // Build the SQL query
    $query = "UPDATE admin SET
            password_admin = '$password'
            WHERE username_admin = '$id_admin'";

    // Execute the query
    $result = mysqli_query($db, $query);
    

        // Check if the update was successful
        if($result) {
          echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Edit Successful</h5>
                          
                      </div>
                      <div class="modal-body">
                          <p>Ganti Password Berhasil.</p>
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
                          <h5 class="modal-title">Edit Successful</h5>
                          
                      </div>
                      <div class="modal-body">
                          <p>Ganti Password Gagal.</p>
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
        mysqli_close($db);
    }

?>
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>