<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
$ff = mysqli_query($link, "SELECT * FROM foot");
$ff1 = mysqli_fetch_assoc($ff);
//	echo "<img id='upfilew2' style='height:155px ;cursor:pointer;' data-c1='rrrr' src= 'archivosland/".$aboutw2['idland']."".$aboutw2['foto']."' onerror=this.src='curso.png'>";
?>

<?php
$about2 = mysqli_query($link, "SELECT * FROM land WHERE tipo='logo'");
$aboutw2 = mysqli_fetch_assoc($about2);
//	echo "<img id='upfilew2' style='height:155px ;cursor:pointer;' data-c1='rrrr' src= 'archivosland/".$aboutw2['idland']."".$aboutw2['foto']."' onerror=this.src='imagenes/curso.png'>";
?>

<div class="container-flex p-0 border-top">
    <div class="card text-center p-0 border-0">
        <div class="card-body ">

            <div class="row d-flex justify-content-center align-items-center">

                <div class="container text-center p-1  col-md-6 col-lg-4 col-xl-4">
                    <h3><?php echo $ff1['t1'] ?></h3>
                    <p class="footer-links"><?php echo $ff1['t2'] ?> </p>
                    <p class="footer-company-name"><?php echo $ff1['t3'] ?></p>
                    <div style="margin:10px">
                        <img src="archivosland/<?php echo $aboutw2['idland'] . "" . $aboutw2['foto'] ?>"
                            onerror=this.src="./imagenes/curso.png" style="height:100px;border-radius:5px;" alt="">
                    </div>
                </div>

                <div class="container text-center p-1 col-md-6 col-lg-4 col-xl-4">
                    <div>
                        <i class="text-secondary fa fa-map-marker fa-2x"></i>
                        <p><?php echo $ff1['t4'] ?></p>
                    </div>
                    <div>
                        <i class="text-secondary fa fa-phone fa-2x"></i>
                        <p><?php echo $ff1['t5'] ?></p>
                    </div>
                    <div>
                        <i class="text-secondary fa fa-envelope fa-2x"></i>
                        <p><a class="text-secondary" href="<?php echo $ff1['t6'] ?>"><?php echo $ff1['t6'] ?></a></p>
                    </div>
                </div>

                <div class="container text-center p-1  col-md-6 col-lg-4 col-xl-4">
                    <p class="text-center p-3"><?php echo $ff1['t7'] ?></p>
                    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
                    <!-- https://msng.link/o/?ricardo.mallquib=fm -->

                    <a class="text-secondary mx-1" target="_blank" href="<?php echo $ff1['t8'] ?>">
                        <i class="fa fa-whatsapp fa-2x"></i>
                    </a>
                    <a class="text-secondary mx-1 d-none" target="_blank" href="<?php echo $ff1['t9'] ?>">
                        <i class="fa fa-facebook-messenger fa-2x"></i></a>
                    <a class="text-secondary" target="_blank" href="<?php echo $ff1['t10'] ?>">
                        <i class="fa fa-facebook fa-2x"></i>
                    </a>
                    <a class="text-secondary mx-1 d-none" class="text-light" target="_blank" href="<?php echo $ff1['t11'] ?>">
                        <i class="fa fa-twitter fa-2x"></i>
                    </a>
                    <a class="text-secondary mx-1 d-none" target="_blank" rel="noopener noreferrer"
                        href="<?php echo $ff1['t12'] ?>">
                        <i class="fa fa-instagram  fa-2x"></i>
                    </a>
                    <a class="text-secondary mx-1" target="_blank" href="<?php echo $ff1['t13'] ?>">
                        <i class="fa fa-github fa-2x"></i>
                    </a>
<!--                    <a class="text-secondary mx-1" target="_blank" href="<?php echo $ff1['t14'] ?>">
                        <i class="fab fa-youtube fa-2x"></i>
                    </a>
-->                    <a class="text-secondary mx-1" target="_blank" href="<?php echo $ff1['t15'] ?>">
                        <i class="fa fa-blogger fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>