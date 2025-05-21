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

$data_materi = select("SELECT * FROM materi");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!--Plugin Asset-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    
    <!--Logo Title-->
    <link rel="stylesheet" href="../css/docstyle.css">

    <script>
        $(document).ready(function() {
        $('#tabledoc').DataTable({
            scrollX: true // Enable horizontal scrolling
        });

        // Disable horizontal scrolling when in responsive mode
        $('#tabledoc').on('init.dt', function() {
            var table = $(this).DataTable();
            var scrollBody = $('.dataTables_scrollBody');

            // Only enable scrolling if table width is greater than window width
            if (table.table().width() <= $(window).width()) {
                scrollBody.css('overflow-x', 'hidden');
            }

            $(window).on('resize', function() {
                if (table.table().width() <= $(window).width()) {
                    scrollBody.css('overflow-x', 'hidden');
                } else {
                    scrollBody.css('overflow-x', 'auto');
                }
            });
        });
    });

    </script>

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
        <div class="container">
            <div class="row h-100 tabel">
                <div class="box col-md-8 hero-tagline my-auto mx-auto table-responsive align-items-center">
                    <table class="table table-bordered table-striped mt-3 zi" id="tabledoc">
                        
                    <h2 style="font-family: Poppins;"><b>DOKUMEN</b></h2>
                        
                        <hr>
                        <thead>
                            <tr>    
                                <th class="col-md-1 text-start">No</th>
                                <th class="col-md-7">Nama Pelatihan</th>
                                <th class="col-md-2 text-start">Tanggal</th>
                                <th class="col-md-2">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                            ?>
                            <?php
                            foreach ($data_materi as $materi): ?>
                            <tr>
                                <td class="text-start"><?= $no++; ?></td>
                                <td><?= $materi['nama_materi']; ?></td>
                                <td class="text-start"><?= $materi['tgl_pelatihan']; ?></td>
                                <td><a class="pdf_style" href="../admin/download.php?file=<?=urlencode($materi['dokumen_materi']); ?>" target="_blank">Detail File</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> 
            
            <!-- <img src="#" alt="" class="position-absolute end-0 bottom-0 img-hero">
            <img src="../assets/img/Accsent 1.png" alt="" class="h-100 position-absolute top-0 start-0 accsent-img"> -->

        </div>
    </section>

    <!--Footer-->
    

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