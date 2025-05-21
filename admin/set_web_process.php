<?php 
include '../database.php';

if(isset($_POST['bsimpan'])) {
    $id_web = $_POST['id_web'];
    $nama_koperasi = $_POST['knama'];
    $deskripsi = $_POST['kdeskripsi'];
    $alamat = $_POST['kalamat'];
    $telp = $_POST['ktelp'];
    $email = $_POST['kemail'];    

    // File upload handling
    if(isset($_FILES['tfile']) && $_FILES['tfile']['size'] > 0) { // Check if a file is uploaded
        // Get file information
        $file_name = $_FILES['tfile']['name'];
        $file_size = $_FILES['tfile']['size'];
        $file_tmp = $_FILES['tfile']['tmp_name'];
        $file_type = $_FILES['tfile']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $upload_dir = '../assets/img';
        $extensions = array("jpeg", "jpg", "png");
    
        if (in_array($file_ext, $extensions) === false) {
            echo "Extensi file tidak valid, silakan pilih file JPEG, JPG, atau PNG.";
            exit; // Stop execution if file extension is not valid
        }
    
        if ($file_size > 5 * 1024 * 1024) {
            echo "Ukuran file melebihi batas maksimum (5 MB).";
            exit; // Stop execution if file size exceeds the limit
        }
        $query_select_old_image = "SELECT logo_koperasi FROM set_web WHERE id_set = $id_web";
        $result_select_old_image = mysqli_query($db, $query_select_old_image);
        $row = mysqli_fetch_assoc($result_select_old_image);
        $old_image = $row['logo_koperasi'];

        // Check if there are no errors in the file upload process
        if (empty($errors)) {
            // Remove old photo if it exists
            if (!empty($old_image)) {
                $old_image_path = "../assets/img/" . $old_image;
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
            move_uploaded_file($file_tmp, "../assets/img/" . $unique_file_name);
        }
    }
    
    // Build the SQL query
    $query = "UPDATE set_web SET               
                
                nama_koperasi = '$nama_koperasi',
                deskripsi_koperasi = '$deskripsi',
                alamat_koperasi = '$alamat',
                telp_koperasi = '$telp',
                email_koperasi = '$email'";

    // If a file is uploaded, add it to the query
    if(isset($unique_file_name)) {
        $query .= ", logo_koperasi = '$unique_file_name'";
    }
    
    $query .= " WHERE id_set = $id_web";
    
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
                          <p>Edit Success.</p>
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
                  window.location.href = "set_web.php";
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
                          <p>Edit Failed.</p>
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
                      window.location.href = "set_web.php";
                  }
              </script>';
        }
    }

    // Close the database connection
?>
