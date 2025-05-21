<?php
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
?>
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
if(isset($_GET['datae']) && !empty($_GET['datae'])) {
    // Get the id_materi value from the URL parameter
    $id_materi = $_GET['datae'];

    // Establish a connection to the MySQL database
    $db = mysqli_connect('localhost', 'root', '', 'dinkopum_base');

    // Check if the connection was successful
    if(!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define the SELECT query to get the file path from the database
    $sql_select = "SELECT dokumen_materi FROM materi WHERE id_materi = $id_materi";
    $result = mysqli_query($db, $sql_select);
    $row = mysqli_fetch_assoc($result);
    $file_path = $row['dokumen_materi'];

    // Delete the file from the storage directory
    if (file_exists($file_path)) {
        unlink($file_path); // Deletes the file
    }

    // Define the DELETE SQL query
    $sql_delete = "DELETE FROM materi WHERE id_materi = $id_materi";

    // Execute the DELETE query
    if(mysqli_query($db, $sql_delete)) {
        echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Hapus Data Dokumen Berhasil.</p>
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
                    window.location.href = "tambah_materi.php";
                }
            </script>';
    } else {
        echo '<div class="modal" tabindex="-1" role="dialog" id="editUserSuccess">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Hapus Data Dokumen Gagal.</p>
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
                    window.location.href = "tambah_materi.php";
                }
            </script>';
    }

    // Close the database connection
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
