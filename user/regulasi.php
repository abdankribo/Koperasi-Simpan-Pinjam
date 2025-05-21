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
    <link rel="stylesheet" href="../css/regulasicss.css">
    <?php
    include '../navbar/title.php'
    ?>
  </head>
  <body>
<!--Nav-->
<?php
    include '../navbar/nav.php'
    ?>

    <!--Section1-->
    <section id="hero">
        <div class="container h-100 d-flex align-items-end flex-column">
            <div class="row h-100 col-md-11">
                
                    <h2><b>Regulasi</b></h2>
                    <table class="table mt-5">   
                      <tr class="table-success">
                        <td>UU Koperasi</td>
                        <td><a href="https://www.kkmc.co.id/pdf/Regulasi/UU%20NO.17%20TAHUN%202012.pdf" class="link">UU No. 17 Tahun 2012</a><br>
                            <a href="https://www.kkmc.co.id/pdf/Regulasi/UU%20No.%2025%20TAHUN%201992.pdf" class="link">UU No. 25 Tahun 1992</a>
                        </td>
                      </tr>
                      <tr>
                        <td>AD/ART</td>
                        <td>PDF</td>
                      </tr>
                      <tr class="table-success">
                        <td>SK Ketua Umum</td>
                        <td>PDF</td>
                      </tr>
                      </table>
                
            </div>
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero"> -->
            <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img">

        </div>
    </section>
    <?php
        include '../footer/footer.php'
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