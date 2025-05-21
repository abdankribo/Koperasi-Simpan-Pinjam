<?php
    session_start();
    
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
$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Logo Title-->
    <link rel="stylesheet" href="../css/admincss.css">
    <link rel="icon" href="../assets/img/<?=$koperasiku['logo_koperasi'];?>" type="image/x-icon">

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

    <title>
    <?=$koperasiku['nama_koperasi'];?></title>

  </head>
  <body>
<!--Nav-->
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: #009D9D; ">
        <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <?=$koperasiku['nama_koperasi'];?></a>
        
        </div>
    </nav>

<?php
include 'regis_process.php';
?>
    <!--FORM LOGIN
    <div class="con-login">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-4 hero-tagline my-auto mx-auto">
                    <div class="login">
                    <h3>Daftar Akun</h3>
                    <form action="register.php" method="post">
                        <div class="mb-3">
                            <label for="username"  class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button class="btn btn-success" name="ssubmit" type="submit">Daftar</button>
                        </div>
    
                        </form>
                        <div class="box-from-error">
                            <small class="form-error"><?php echo $form_error; //pesan eror ?></small>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div> -->

    <section id="hero">
    <div class="container h-100">
            <div class="container col-md-6">

                <div class="card mb-3" style="max-width: 620px;">
                    <div class="row g-0">
                        <div class="col-md-3" style="background-color: #009D9D;">
                            
                            <img src="../assets/img/<?=$koperasiku['logo_koperasi'];?>" class="img-fluid rounded-start" alt="Img not found!">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Selamat Datang di <?=$koperasiku['nama_koperasi'];?></span></h5>
                                <p class="card-text">Silahkan isi form untuk buat akun!</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container col-md-6 rounded" style="background-color: white;">
            <?php
                include 'regis_process.php'
            ?>
            <form action="register.php" class="row g-2 needs-validation" style="color: black;" method="post" novalidate>
            <div class="col-md-7 mt-4">
                <label for="inputAddress" class="form-label">Nama Lengkap</label>
                <input type="text" name="fullname" class="form-control" id="inputAddress" required>
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-5 mt-4">
                <label for="inputAddress" class="form-label">No. Telp/ WA</label>
                <input type="text" name="telp" class="form-control" id="inputAddress" >
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Nomor Anggota</label>
                <input type="text" name="noanggota" class="form-control" id="inputAddress" required>
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-6">
                <label for="floatingInputstatus" class="form-label">Jenis Kelamin</label>
                <select name="tkelamin" class="form-select" id="inputAddress">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                
            </div>
            
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" id="inputAddress" >
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Kelompok</label>
                <input type="text" name="kelompok" class="form-control" id="inputAddress" >
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputAddress" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputAddress" >
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            
            <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <div class="input-group">
        <input type="password" name="password" class="form-control" id="inputPassword4" required>
        <button class="btn btn-outline-secondary" type="button" id="showPasswordToggle">Show</button>
    </div>
    <div class="invalid-feedback">
        Wajib di isi!
    </div>
</div>

<script>
    const passwordInput = document.getElementById('inputPassword4');
    const showPasswordToggle = document.getElementById('showPasswordToggle');

    showPasswordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordToggle.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            showPasswordToggle.textContent = 'Show';
        }
    });
</script>

            
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3"></textarea>
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-5">
                <label for="inputCity" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgllahir" class="form-control" id="inputCity" value="<?php echo date('Y-m-d'); ?>">
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Kota Kelahiran</label>
                <input type="text" name="tempatlahir" class="form-control" id="inputCity">
                <div class="invalid-feedback">
                    Wajib di isi!
                </div>
            </div>
            
            <div class="col-md-3">
                <label for="inputZip" class="form-label">Status</label>
                <select name="status" class="form-select" id="inputAddress">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="box-from-error">
                <small class="form-error"><?php echo $form_error; //pesan eror ?></small>
            </div>
            <div class= "d-grid gap-2 col-6 mx-auto mb-3 mt-4">
                <button type="submit" name="daftar" class="btn btn-warning">Daftar</button>
            </div>
            </form>
            
            </div>
            </div>

        </div>
    </section>
    
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
    <!--Footer-->

    <?php
        include '../footer/footer.php'
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
endforeach
?>