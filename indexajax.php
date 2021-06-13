<?php
require('conect.php');
session_start();


?>
<title>Fisart - Matemáticas</title>
<meta charset="UTF-8">
<meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="w.ico">

<script type="text/javascript" src="jsxgraphcore.js"></script>
<link rel="stylesheet" href="./css/css/bootstrap.min.css">

<script src="jquery-3.0.0.min.js"></script>
<script src="jquery-1.12.4.js"></script>
<script src="jquery-ui.min.js"></script>






<div class="container p-1 my-5 text-center">
    <?php 
    if (isset($_SESSION['user'])){?>
    <a class="btn btn-info mb-2" href='inicio.php'>
        DASHBOARD
    </a>
    <?php }

    $about2 = mysqli_query($link, "SELECT * FROM land WHERE tipo='logo'");
    $aboutw2 = mysqli_fetch_assoc($about2);

    ?>

    <div class="h2 text-center bg-light border" id='wwnombre' data-c1='<?php echo $aboutw2["idland"] ?>' <?php if
        (isset($_SESSION['user']) && $_SESSION['user']=="8" ){echo "contenteditable" ;}else{;}?>>
        <?php echo $aboutw2['nombre'] ?>
    </div>

    <img class='card-img-top-circle m-auto'
        style=" width: 200px;height: 200px;overflow: hidden;border-radius: 50%;position: relative;" <?php if
        (isset($_SESSION['user']) && $_SESSION['user']=="8" ){echo "id='upfilew2' style='cursor:pointer'" ;}else{;}?>
    src='
    <?php echo "archivosland/".$aboutw2["idland"] . "" . $aboutw2["foto"] ?>' onerror=this.src='curso.png'>

    <button class="btn btn-info" style='display:none' id='deleter' data-ff='<?php echo $aboutw2["idland"] ?>'><i
            class='fa fa-trash'></i></button>

    <input type='file' name='file' id='imagew2' <?php echo "data-c1='" .$aboutw2["idland"]."'"?> style='display:none' />

    <script>
    $("#upfilew2").click(function() {
        $("#imagew2").trigger('click');
    });
    </script>

</div>


<?php 
//videos
        $www1 = mysqli_query($link, "SELECT * FROM land WHERE tipo='video'");
        $nwww1 = mysqli_num_rows($www1);
        $wwwr1 = mysqli_fetch_assoc($www1);
        ?>
<div class="container my-5" style='display:none'>
    <div class="card text-center">
        <div class="card-header">
            Videos
        </div>
        <div class="card-body">
            <div class="row d-flex justify-content-center align-items-center">
                <?php 
        do {
            ?>
                <div class="card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3">
                    <div class='card-header p-1' id='wwnombre' data-c1='<?php echo $wwwr1["idland"] ?>' <?php if
                        (isset($_SESSION['user']) && $_SESSION['user']=="8" ) {echo "contenteditable" ;}?>>
                        <?php echo $wwwr1['nombre'] ?>
                    </div>
                    
                    
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src='<?php echo $wwwr1["archivo"] ?>' allowfullscreen>
                        </iframe>
                    </div>
                    <div class="card-footer p-1">

                        <div id='ww1' data-c1='<?php echo $wwwr1["idland"] ?>' <?php if (isset($_SESSION['user']) &&
                            $_SESSION['user']=="8" ) {echo "contenteditable" ;}?>>
                            <?php echo $wwwr1['texto'] ?>
                        </div>
                        <div class='bg-info' id='wwvideo' data-c1='<?php echo $wwwr1["idland"] ?>' <?php if
                            (isset($_SESSION['user']) && $_SESSION['user']=="8" ){echo "contenteditable" ; }else
                            {echo "style='display:none'" ;}?>>
                            <?php echo $wwwr1['archivo'] ?>
                        </div>
                        <button <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){}else
                            {echo "style='display:none'" ;}?>
                            id='deleter' data-ff='
                            <?php echo $wwwr1["idland"] ?>'><i class='fa fa-trash'></i>
                        </button>
                    </div>
                </div>
                <?php } while ($wwwr1 = mysqli_fetch_assoc($www1));    
?>
            </div>
        </div>

        <div class="card-footer text-center" <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){}else
            {echo "style='display:none'" ;}?>>
            <button class="btn btn-info" id='addvideo'>Agregar</button>
        </div>
    </div>

</div>











<?php
//Acerca
	$about=mysqli_query($link,"SELECT * FROM land WHERE tipo='acerca'");
	//	$about=mysqli_num_rows($about);  
	$aboutw=mysqli_fetch_assoc($about);
?>
<div class="container my-5" style='display:none'>

    <div class='card text-center'>

        <div class='card-header' id='wwnombre' data-c1='<?php echo$aboutw["idland"]?>' <?php if (isset($_SESSION['user']) &&
            $_SESSION['user']=="8" ) {echo "contenteditable" ;}?>>
            <?php echo$aboutw['nombre']?>
        </div>
        <div class="card-body">
            <div class='container bg-light border p-1' id=' ww1' data-c1='<?php echo$aboutw["idland"]?>' <?php if
                (isset($_SESSION['user']) && $_SESSION['user']=="8" ) {echo "contenteditable" ;}?>>
                <?php echo$aboutw['texto']?>
            </div>
            <?php 
    $about1=mysqli_query($link,"SELECT * FROM land WHERE tipo='acercaitems'");
    $aboutw1=mysqli_fetch_assoc($about1);
    do{
    ?>
            <div class='container bg-white border my-1' id='ww1' data-c1='<?php echo$aboutw1["idland" ]?>' <?php if
                (isset($_SESSION['user']) && $_SESSION['user']=="8" ) {echo "contenteditable" ;}?>>
                <?php echo$aboutw1['texto']?>
                <button id='deleter' data-ff='<?php echo$aboutw1["idland" ]?>' <?php if(isset($_SESSION['user']) &&
                    $_SESSION['user']=="8" ){;}else{echo "style='display:none'" ;}?>><i
                        class='fa fa-trash'></i></button>
            </div>
            <?php 
    }while($aboutw1=mysqli_fetch_assoc($about1));
    ?>
        </div>

        <div class='card-footer p-1' <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){}else
            {echo "style='display:none'" ;}?>>
            <button class='btn btn-info' id='additems'>Agregar items</button>
        </div>
    </div>
</div>







<?php  $www=mysqli_query($link, "SELECT * FROM land WHERE tipo='beneficios'" ); $nwww=mysqli_num_rows($www);
    $wwwr=mysqli_fetch_assoc($www); ?>
<div class="container my-5" style='display:none'>

    <div class="card text-center bg-light text-center">

        <div class="card-header text-uppercase">
            Beneficios
        </div>

        <div class="card-body">
            <?php 
            do {
      ?>
            <div class="container text-center bg-white p-1 border my-1" id='ww1' data-c1='<?php echo $wwwr["idland"] ?>'
                <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){echo "contenteditable" ;}else{;}?>>
                <?php echo $wwwr['texto'] ?>
                <button class="" id='deleter' data-ff='<?php echo $wwwr["idland"] ?>' <?php if(isset($_SESSION['user']) &&
                    $_SESSION['user']=="8" ){;}else{echo "style='display:none'" ;}?>><i
                        class='fa fa-trash'></i></button>
            </div>
            <?php 
    } while ($wwwr = mysqli_fetch_assoc($www));
        ?>
        </div>
        <div class="card-footer p-1" <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){}else
            {echo "style='display:none'" ;}?>>
            <button class="btn btn-warning" id='add'>
                Agregar beneficios
            </button>
        </div>
    </div>
</div>







<?php
        $www1 = mysqli_query($link, "SELECT * FROM land WHERE tipo='foto'");
        $nwww1 = mysqli_num_rows($www1);
        $wwwr1 = mysqli_fetch_assoc($www1);
        ?>
<div class="container my-1" style='display:'>
    <div class=" card">
    <div class="row d-flex justify-content-center align-items-center">
        <?php 
    if ($nwww1 > 0) {
        do {
            ?>
        <div class="card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3">
            <div class="card-header p-1" id='wwnombre' data-c1='<?php echo $wwwr1["idland"] ?>' <?php if (isset($_SESSION['user'])
                && $_SESSION['user']=="8" ){echo "contenteditable" ;}?>>
                <?php echo$wwwr1['nombre'] ?>
            </div>

            <img class='card-img-top -circle m-auto wrapperest' id='upfilew2' <?php echo "src='archivosland/"
                .$wwwr1['idland']."".$wwwr1['foto']?>' onerror=this.src='curso.png'>


            <div class="card-footer p-1" id='ww1' data-c1='<?php echo $wwwr1["idland"] ?>' <?php if (isset($_SESSION['user']) &&
                $_SESSION['user']=="8" ){echo "contenteditable" ; } ?>>
                <?php echo $wwwr1['texto'] ?>
            </div>


            <div <?php if (isset($_SESSION['user']) && $_SESSION['user']=="8" ){}else{echo "style='display:none'"
                ;}?>class="btn btn-danger" id='deleter' type="button"
                data-ff='
                <?php echo $wwwr1["idland"] ?>'><i class='fa fa-trash'></i>
            </div>
        </div>
        <?php 
            } while ($wwwr1 = mysqli_fetch_assoc($www1));
            ?>
        <?php 
            }

            if (isset($_SESSION['user']) && $_SESSION['user']=="8") {
            ?>

        <div class="container text-center mb-2">
            <div class='btn btn-info' id="upfilew">Agregar imagen descriptiva</div>
            <input type="file" name="file" id="imagew" style="display:none" />
        </div>

        <script>
        $("#upfilew").click(function() {
            $("#imagew").trigger('click');
        });
        </script>

        <?php }?>

    </div>
</div>
</div>







<?php
  
if (isset($_SESSION['user']) && $_SESSION['user'] == "8") {

$ff = mysqli_query($link, "SELECT * FROM foot");
$nff = mysqli_num_rows($ff);
$ff1 = mysqli_fetch_assoc($ff);
?>
<div class='container bg-info mb-1' id='ffw' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t1'] ?>
</div>
<div class='container bg-info mb-1' id='ffw2' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t2'] ?>
</div>
<div class='container bg-info mb-1' id='ffw3' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1["t3"] ?>
</div>
<div class='container bg-info mb-1' id='ffw4' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t4'] ?>
</div>
<div class='container bg-info mb-1' id='ffw5' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t5'] ?>
</div>
<div class='container bg-info mb-1' id='ffw6' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t6'] ?>
</div>
<div class='container bg-info mb-1' id='ffw7' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t7'] ?>
</div>
<div class='container bg-info mb-1' id='ffw8' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t8'] ?>
</div>
<div class='container bg-info mb-1' id='ffw9' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t9'] ?>
</div>
<div class='container bg-info mb-1' id='ffw10' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t10'] ?>
</div>
<div class='container bg-info mb-1' id='ffw11' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t11'] ?>
</div>
<div class='container bg-info mb-1' id='ffw12' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t12']?>>
</div>
<div class='container bg-info mb-1' id='ffw13' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t13'] ?>
</div>
<div class='container bg-info mb-1' id='ffw14' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t14'] ?>
</div>
<div class='container bg-info mb-1' id='ffw15' data-c1='<?php echo $ff1["idfoot"] ?>' contenteditable>
    <?php echo $ff1['t15'] ?>
</div>
<?php 
}
?>








<?php 
        $conw = mysqli_query($link, "SELECT * FROM categoria");
        $nw = mysqli_num_rows($conw);
        $curso1 = mysqli_fetch_assoc($conw);
        ?>

<div class="container my-5">
    <div class="text-center p-0">
        <div class="card-header h5 d-none">
            ÁREAS
        </div>
        <div class="p-0">
            <?php 
            if($nw>0){do{
            ?>
            <div class="card text-center bg-light my-2 rounded-lg">

                <div class="card-header">
                    <input class='' type='hidden' colorformat='rgba' id='color' data-c1='<?php echo$curso1["id"]?>'
                        value='<?php echo$curso1[' color']?>'>
                    <h5 class='m-0 text-uppercase text-center' id='nombre' data-c1='<?php echo$curso1["id"]?>'>
                        <?php echo$curso1['nombre']?>
                    </h5>
                
                </div>

                <div class="card-body">

                    <div class="row d-flex justify-content-center align-items-center">

                        <?php 
                                $con = mysqli_query($link, "SELECT * FROM clase WHERE categoria='" . $curso1['id'] . "'");
                                $n = mysqli_num_rows($con);
                                $curso = mysqli_fetch_assoc($con);
                                    if($n>0){
                                do{
                                ?>

                        <div class="card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3 
                            <?php if ($nmisclases > 0) {echo " bg-warning";}?>">
                            <div class="card-header p-1">
                                <div class='card-text h5 p-1' id='www' data-c1='<?php echo $curso["idclase"] ?>'
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "8") {echo "contenteditable";}?>   >
                                    <?php echo $curso['nombre']?>
                                </div>
                            </div>
                            <div class="card-body p-2">
                            <img class="card-img-top -circle m-auto wrapperest update" name='update'
                                id='<?php echo$curso["idclase"]?>' data-id='<?php echo $curso1["id"]?>'
                                src='<?php echo"archivoscrearclase/".$curso1["id"] . "_" . $curso["idclase"] . "_" . $curso["foto"]?>'
                                onerror=this.src='curso.png'>
                            </div>

                            <div class="card-footer p-1" style="display:none;">
                                <?php 
                                $conzw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $curso['clave'] . "'");
                                $zzw = mysqli_fetch_assoc($conzw);
                                $ww = mysqli_num_rows($conzw);
              
                                ?>
                                <button type="button" class="btn btn-LIGHT" data-toggle="modal"
                                    data-target="#ww<?php  echo $curso['idclase']?>">
                                    INTRODUCCIÓN
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="ww<?php  echo $curso['idclase']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">INTRODUCCIÓN
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <?php  echo $curso['descripcion']?>
                                                <br><br>
                                                <?php do{?>
                                                <ul class="text-left">
                                                    <li>
                                                        <?php echo $zzw['nombre']?>
                                                        <?php 
                                                    $conzww = mysqli_query($link, "SELECT * FROM secciones WHERE clavew='" . $zzw['idcapitulo'] . "'");
                                                    $zzww = mysqli_fetch_assoc($conzww);
                                                    $www = mysqli_num_rows($conzww);
                                                    ?>
                                                        <?php do{?>
                                                        <ul>
                                                            <li>
                                                                <?php echo $zzww['nombre']?>
                                                            </li>
                                                        </ul>
                                                        <?php }while($zzww = mysqli_fetch_assoc($conzww));?>

                                                    </li>
                                                </ul>
                                                <?php }while($zzw = mysqli_fetch_assoc($conzw));?>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php 
                        }while($curso=mysqli_fetch_assoc($con));
                        }else {
                        echo "No hay curso cree uno nuevo";
                        }
                        ?>
                    </div>

                </div>

            </div>
            <?php 
} while ($curso1 = mysqli_fetch_assoc($conw));
}else {
  echo "No hay cree uno nuevo";
}
?>
        </div>
    </div>
</div>


<style>
.wrapperest {
    width: 200px;
    height: 200px;
    overflow: hidden;
    border-radius: 30%;
    position: relative;
    object-fit: cover;
}
</style>
