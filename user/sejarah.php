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
    <link rel="stylesheet" href="../css/sejarahcss.css">
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
        <div class="container h-100">
            <div class="row h-100">
                <div class="textbox hero-tagline my-auto"> 
                <h2>Sejarah</h2> 
                <p style="text-indent: 0.5in;">
                    Koperasi pertama kali diperkenalkan oleh seorang berkebangsaan Skotlandia, yang bernama Robert Owen (1771-1858). Setelah koperasi berkembang dan diterapkan di beberapa Negara-negara eropa. Koperasi pun mulai masuk dan berkembang di Indonesia.
                    Di Indonesia koperasi mulai diperkenalkan oleh Patih R. Aria Wiria Atmaja pada tahun 1896, dengan melihat banyaknyak para pegawai negeri yang tersiksa dan menderita akibat bunga yang terlalu tinggi dari rentenir yang memberikan pinjaman uang.
                    
                    <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Melihat penderitaan tersebut Patih R. Aria Wiria Atmaja lalu mendirikan Bank untuk para pegawai negeri, beliau mengadopsi system serupa dengan yang ada di jerman yakni mendirikan koperasi kredit. Beliau berniat membantu orang-orang agar tidak lagi berurusan dengan renternir yang pasti akan memberikan bunga yang tinggi.
                    seorang asisten residen Belanda bernama De Wolffvan Westerrode, merespon tindakan Patih R. Aria Wiria, sewaktu mengunjungi Jerman De Wolffvan Westerrode menganjurkan akan mengubah Bank Pertolongan Tabungan yang sudah ada menjadi Bank Pertolongan, Tabungan dan Pertanian.
                    Setelah itu koperasi mulai cepat berkembang di Indonesia, hal ini juga didorong sifat orang-orang Indonesia yang cenderung bergotong royong dan kekeluargaan sesuai dengan prinsip koperasi. Bahkan untuk mengansitipasi perkembangan ekonomi yang berkembang pesat pemerintahan Hindia-Belanda pada saat itu mengeluarkan peraturan perundangan tentang perkoperasian. Pertama, diterbitkan Peraturan Perkumpulan Koperasi No. 43, Tahun 1915, lalu pada tahun 1927 dikeluarkan pula Peraturan No. 91, Tahun 1927, yang mengatur Perkumpulan-Perkumpulan Koperasi bagi golongan Bumiputra. Pada tahun 1933, Pemerintah Hindia-Belanda menetapkan Peraturan Umum Perkumpulan-Perkumpulan Koperasi No. 21, Tahun 1933. Peraturan tahun 1933 itu, hanya diberlakukan bagi golongan yang tunduk kepada tatanan hukum Barat, sedangkan Peraturan tahun 1927, berlaku bagi golongan Bumiputra.
                    
                    <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Setelah pemerintahan Hindia-belanda menunjukkan sikap diskriminasi dalam peraturan yang dibuatnya. Pada tahun 1908 Dr. Sutomo yang merupakan pendiri dari Boedi Utomo memberikan perananya bagi gerakan koperasi untuk memperbaiki kondisi kehidupan rakyat.
                    Serikat Dagang Islam (SDI) 1927, Dibentuk bertujuan untuk memperjuangkan kedudukan ekonomi pengusah-pengusaha pribumi. Kemudian pada tahun 1929, berdiri Partai Nasional Indonesia yang memperjuangkan penyebarluasan semangat koperasi.
                    Setelah jepang berhasil menguasai sebagian besar daerah asia, termasuk Indonesia, system pemerintahan pun berpindah tangan dari pemerintahan Hindia-Belanda ke pemerintahan Jepang. Jepang lalu mendirikan koperasi kumiyai, namun hal ini hanya dimanfaatkan Jepang untuk mengeruk keuntungan, dan menyengsarakan rakyat Indonesia. Setelah Indonesia merdeka, pada tanggal 12 juli 1947, pergerakan koperasi di Indonesia mengadakan Kongres Koperasi yang pertama di Tasikmalaya. Hari ini kemudian ditetapkan sebagai Hari Koperasi Indonesia.Sekaligus membentuk Sentral Organisasi Koperasi Rakyat Indonesia (SOKRI) yang berkedudukan di Tasikmalaya.
                    
                    <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lalu kita mengenal Moh. Hatta sebagai bapak koperasi. Beliau mengusulkan didirikannya 3 macam koperasi:
                    Pertama, adalah koperasi konsumsi yang terutama melayani kebutuhan kaum buruh dan pegawai.
                    Kedua, adalah koperasi produksi yang merupakan wadah kaum petani (termasuk peternak atau nelayan).
                    Ketiga, adalah koperasi kredit yang melayani pedagang kecil dan pengusaha kecil guna memenuhi kebutuhan modal.
                    Bung Hatta mengatakan bahwa tujuan koperasi yang sebenarnya bukan mencari laba atau keuntungan, namun bertujuan untuk memenuhi kebutuhan bersama anggota koperasi.
                </p>
                <p style="text-indent: 0.5in;">

                </p>
                </div>
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