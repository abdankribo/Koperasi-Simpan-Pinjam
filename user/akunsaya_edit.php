<?php 
include '../database.php';

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
    if(isset($_FILES['tfile']) && $_FILES['tfile']['size'] > 0) { // Check if a file is uploaded
        // Get file information
        $file_name = $_FILES['tfile']['name'];
        $file_size = $_FILES['tfile']['size'];
        $file_tmp = $_FILES['tfile']['tmp_name'];
        $file_type = $_FILES['tfile']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $upload_dir = 'image_user/';
        $extensions = array("jpeg", "jpg", "png");
    
        if (in_array($file_ext, $extensions) === false) {
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Edit Failed</h5>
                          
                      </div>
                      <div class="modal-body">
                          <p>Extensi file tidak valid, silakan pilih file JPEG, JPG, atau PNG.</p>
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
                  }, 2000);
              }

              function redirectToIndex() {
                  window.location.href = "akunsaya.php";
              }
          </script>';
            
        }
    
        elseif ($file_size > 5 * 1024 * 1024) {
            echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Edit Failed</h5>
                          
                      </div>
                      <div class="modal-body">
                          <p>Gagal Upload Gambar, File melebihi 5MB</p>
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
                  }, 2000);
              }

              function redirectToIndex() {
                  window.location.href = "akunsaya.php";
              }
          </script>';
            
        }else{
        $query_select_old_image = "SELECT foto_anggota FROM anggota WHERE id = $id_user";
        $result_select_old_image = mysqli_query($db, $query_select_old_image);
        $row = mysqli_fetch_assoc($result_select_old_image);
        $old_image = $row['foto_anggota'];

        // Check if there are no errors in the file upload process
        if (empty($errors)) {
            // Remove old photo if it exists
            if (!empty($old_image)) {
                $old_image_path = "image_user/" . $old_image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the old image file
                }
            }
            $unique_file_name = $file_name;
            $i = 1;
            while (file_exists($upload_dir . $unique_file_name)) {
                $unique_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . $i . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                $i++;
            }
    
            // Move the uploaded file to the destination folder
            move_uploaded_file($file_tmp, "image_user/" . $unique_file_name);
        }
    }
    
    // Build the SQL query
    $query = "UPDATE anggota SET
                
                password_user = '$password',
               
                
                last_update = $last";
    
    // If a file is uploaded, add it to the query
    if(isset($unique_file_name)) {
        $query .= ", foto_anggota = '$unique_file_name'";
    }
    
    $query .= " WHERE id = $id_user";
    
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
                          <p>Edit Profile Success.</p>
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
                  window.location.href = "akunsaya.php";
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
                          <p>Edit Profile Failed.</p>
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
                      window.location.href = "akunsaya.php";
                  }
              </script>';
        }   }
    
    }

    // Close the database connection
?>
