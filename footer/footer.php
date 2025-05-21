
<?php

include '../database.php';
$koperasi = select("SELECT * FROM set_web"); 
foreach ($koperasi as $koperasiku):
?>
<footer class="d-flex align-items-center">
        <div class="container-fluid ">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <img class="imgfoot" src="../assets/img/<?=$koperasiku['logo_koperasi'];?>" alt="">
                        <a href="../index.php"><?= $koperasiku['nama_koperasi']; ?></a>
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
    <?php
endforeach;
  
?>