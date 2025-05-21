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

    // Query to fetch images from the database
    // $images = select("SELECT image_url FROM your_table_name");
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

        <!-- Vendor CSS Files -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"/>
    <!-- <link href="../vendor/aos/aos.css" rel="stylesheet" /> -->
    <link href="../vendor/glightbox/css/glightbox.min.css" rel="stylesheet"/>
    <link href="../vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <!-- <link href="assets/css/main.css" rel="stylesheet" /> -->


    <!--Logo Title-->
    <link rel="stylesheet" href="../css/dokumentasi_gambar.css">
    <?php include '../navbar/title.php' ?>

</head>
<body>
    <!--Nav-->
    <?php include '../navbar/nav.php' ?>
    <!-- <section id="portfolio" class="portfolio section">

        <div class="juduldeskripsi custom-style" style="margin-top: 100px; margin-bottom: 50px;">DOKUMENTASI</div>
            <div class="ibukcontainer">
                <?php foreach ($images as $image): ?>
                <div class="teamcontainer animated bounceIn portfolio-item">
                    <img src="<?php echo $image['image_url']; ?>" style="width: 300px;" alt="">
                    <div class="portfolio-info">

                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section> -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
    <!-- Section Title -->
        <div class="juduldeskripsi custom-style" style="margin-top: 100px; margin-bottom: 50px;">DOKUMENTASI</div>
        <div class="ibukcontainer">
            <div class="teamcontainer animated bounceIn portfolio-item">
                <img src="../assets/img/logokoper.png" style="width: 300px;" alt="">
                <div class="portfolio-info">
                    <h4>Ini Bapak Agus</h4>
                    <p>Ketua BEM UTM</p>
                    <a href="../assets/img/logokoper.png" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
            <!-- End Portfolio Item -->
            </div>
            <div class="teamcontainer animated bounceIn portfolio-item">
                <img src="../assets/img/logokoper.png" style="width: 300px;" class="img-fluid" alt=""/>
                <div class="portfolio-info">
                    <h4>Branding 3</h4>
                    <p>Lorem ipsum, dolor sit</p>
                    <a href="../assets/img/logokoper.png" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
            </div>
            <!-- End Portfolio Item -->

        </div>
    </section>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Vendor JS Files -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/php-email-form/validate.js"></script>
    <script src="../vendor/aos/aos.js"></script>
    <script src="../vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../vendor/isotope-layout/isotope.pkgd.min.js"></script>
    


    <!-- Main JS File -->
    <!-- <script src="../assets/js/main.js"></script> -->
    <script>
        // JavaScript untuk menampilkan overlay dan gambar yang diperbesar saat gambar diklik
        function toggleOverlay(imageUrl) {
            var overlay = document.getElementById("overlay");
            var overlayImg = document.getElementById("overlayImg");

            if (overlay.style.display === "flex") {
                // Jika overlay sedang ditampilkan, tutup overlay
                overlay.style.display = "none";
            } else {
                // Jika overlay belum ditampilkan, atur sumber gambar overlay dan tampilkan overlay
                overlayImg.src = imageUrl;
                overlay.style.display = "flex";
            }
        }

        function applyAnimation(element) {
            // Tambahkan kelas animasi bounceIn
            element.classList.add('bounceIn');

            // Tambahkan event listener untuk menghapus kelas animasi setelah animasi selesai
            element.addEventListener('animationend', function() {
                element.classList.add('bounceOut');
            });
        }
    </script>






</body>
</html>
