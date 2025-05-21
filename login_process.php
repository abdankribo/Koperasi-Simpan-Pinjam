<?php
    
    include 'database.php';
    
    $form_error='';

    if(isset($_POST['ssubmit'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        $query = "SELECT * FROM anggota WHERE nomor_anggota='$username' AND password_user='$password'";
        $result = mysqli_query($db, $query);

        foreach ($result as $row) { 
			echo "{$row['nomor_anggota']}"; 
			echo "{$row['password_user']}";
		}
    
        if(mysqli_num_rows($result) == 1) {
        $_SESSION['IsUser'] = $row['id'] ;
        echo '<div class="modal" tabindex="-1" role="dialog" id="loginSuccessModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Login Successful</h5>
                            
                        </div>
                        <div class="modal-body">
                            <p>You have successfully logged in.</p>
                        </div>
                        
                    </div>
                </div>
            </div>';

        echo '<script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById("loginSuccessModal"));
                    myModal.show();

                    // Redirect to Index.php after 1 seconds
                    setTimeout(function() {
                        redirectToIndex();
                    }, 1000);
                }

                function redirectToIndex() {
                    window.location.href = "./user/akunsaya.php";
                }
            </script>';
    } else {
        if(isset($_POST['ssubmit'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
        
            $query = "SELECT * FROM admin WHERE username_admin='$username' AND password_admin='$password'";
            $result = mysqli_query($db, $query);
    
            foreach ($result as $row) { 
                echo "{$row['username_admin']}"; 
                echo "{$row['password_admin']}";
            }
        
            if(mysqli_num_rows($result) == 1) {
            
            $_SESSION['IsAdmin'] = $row['username_admin'] ;
            echo '<div class="modal" tabindex="-1" role="dialog" id="loginSuccessModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Login Successful</h5>
                                
                            </div>
                            <div class="modal-body">
                                <p>You have successfully logged by Admin.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>';
    
            echo '<script>
                    window.onload = function() {
                        var myModal = new bootstrap.Modal(document.getElementById("loginSuccessModal"));
                        myModal.show();
    
                        // Redirect to Index.php after 1 seconds
                        setTimeout(function() {
                            redirectToIndex();
                        }, 1000);
                    }   
    
                    function redirectToIndex() {
                        window.location.href = "admin/edit_anggota.php";
                    }
                </script>';
                } elseif (isset($_POST['ssubmit'])) {
                    $username = mysqli_real_escape_string($db, $_POST['username']);
                    $password = mysqli_real_escape_string($db, $_POST['password']);
                
                    $query = "SELECT * FROM master_admin WHERE username_master='$username' AND password_master='$password'";
                    $result = mysqli_query($db, $query);
            
                    foreach ($result as $row) { 
                        echo "{$row['username_master']}"; 
                        echo "{$row['password_master']}";
                    }
                
                    if(mysqli_num_rows($result) == 1) {
                    
                    $_SESSION['IsMaster'] = $row['id_master'] ;
                    echo '<div class="modal" tabindex="-1" role="dialog" id="loginSuccessModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Login Successful</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <p>You have successfully logged by Master Admin.</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>';
            
                    echo '<script>
                            window.onload = function() {
                                var myModal = new bootstrap.Modal(document.getElementById("loginSuccessModal"));
                                myModal.show();
            
                                // Redirect to Index.php after 1 seconds
                                setTimeout(function() {
                                    redirectToIndex();
                                }, 1000);
                            }   
            
                            function redirectToIndex() {
                                window.location.href = "./pihak3/pihak3_edit_anggota.php";
                            }
                        </script>';}else {
            // Login failed, display error message
            $form_error = '<div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px">
            <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              Username atau Password Salah
            </div>
          </div>';
        }
        } 
    }
    
    }
    
    }

    
?>