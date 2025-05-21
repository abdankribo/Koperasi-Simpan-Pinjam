<!-- GAK KEPAKE -->
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
    <link rel="stylesheet" href="css/admincss.css">
    <link rel="icon" href="assets/img/dikom.png" type="image/x-icon">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <title>Dinas Koperasi dan Usaha Mikro Sidoarjo</title>
  </head>
  <body>
<!--Nav-->
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #009D9D; ">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/dikom.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Dinkopum Sidoarjo</a>
        
        </div>
    </nav>
<?php
    include 'login_process.php'
?>
    <!--FORM LOGIN-->
    <div class="con-login">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-4 hero-tagline my-auto mx-auto">
                    <div class="login">
                    <h2>Login</h2>
                    <form action="admin.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>

                        <label for="password">Password:</label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                            <label for="showPassword" style="transform: translateY(-8%); cursor: pointer;"><small>Show Password</small></label>
                        </div>
                        

                        <input class="fw-bold" type="submit" name="ssubmit" value="Login">
                        <div class="">
                            <small class="form-error"><?php echo $form_error; //pesan eror ?></small>
                        </div>
                        <p>Belum ada akun? <a href="./user/register.php"><b>Buat Akun</b></a></p>
                    </form>
                    <script>
                        function togglePasswordVisibility() {
                            var passwordField = document.getElementById("password");
                            if (passwordField.type === "password") {
                                passwordField.type = "text";
                            } else {
                                passwordField.type = "password";
                            }
                        }
                    </script>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!--Footer-->

    <footer class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <img class="imgfoot" src="assets/img/dikom.png" alt="">
                        <a href="Index.html">Dinkopum</a>
                    </div>
                    
                </div>
                <div class="row  copyright  ">
                    <div class="col-12">
                        <p>Copyright By UTM All Right Deserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>