<?php
require('conect.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location:index.php");
}

if (isset($_REQUEST['cerrar'])) {
    session_destroy();
    header("Location:index.php");
}

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$conwW = mysqli_query($link, "SELECT * FROM categoria WHERE user='" . $_SESSION['user'] . "'");
$conw = mysqli_query($link, "SELECT * FROM categoria");
$nw = mysqli_num_rows($conw);
$curso1 = mysqli_fetch_assoc($conw);

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user); 
//require  'autoload.php';
//require  'src/Helpers.php'; // opcional para usar los métodos auxiliares cl_image_tag y cl_video_tag
//require  'config_cloud.php';
//http://res.cloudinary.com/ciencias/image/upload/<?php echo $w["foto"] 

?>
<style>
.componentWrapper {
    position: absolute;
    top: 0%;
    left: 50%;
    width: 95%;
    transform: translate(-50%, -50%);
}

.componentWrapperbottom {
    position: absolute;
    top: 100%;
    left: 50%;
    width: 95%;
    transform: translate(-50%, -50%);
}

.color {
    background-color: white;
}

.componentWrapperbutton {
    position: absolute;
    top: 0%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.img {
    position: absolute;
    top: 0%;
    left: 50%;
    transform: translate(-50%, -50%);
}

[data-title] {
    outline: red dotted 1px;
    /*optional styling*/
    font-size: 30px;
    /*optional styling*/

    position: relative;
    cursor: help;
}

[data-title]:hover::before {
    content: attr(data-title);
    position: absolute;
    bottom: 32px;
    display: inline-block;
    padding: 3px 6px;
    border-radius: 2px;
    background: rgb(29, 167, 160);
    color: rgb(255, 255, 255);
    font-size: 12px;
    border-radius: 0.5em;
    white-space: nowrap;
}

[data-title]:hover::after {
    content: "";
    position: absolute;
    bottom: 15px;
    left: 18%;
    display: inline-block;
    color: #fff;
    border: 8px solid transparent;
    border-top: 10px solid rgb(29, 167, 160);
}
</style>



<div class="container p-1 my-1 mb-3">

    <div class="card text-center  border border-info">
        <div class="card-header pt-5">

            <div class="card border bg-light border-info my-5" style='width:300px;margin:auto'>

                <div class="card-body p-3 my-5">
                    <a href="editar.php" class="img">
                        <img class='card-img-top-circle m-auto wrapperest border border-info' href='editar.php'
                            id='<?php echo $w["idusuario"] ?>'
                            src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $w["foto"];?>'
                            onerror=this.src='foto.png'>
                    </a>
                </div>
                <div class='componentWrapperbottom border border-info color rounded' id='nombre'
                    data-c1='<?php echo $w["idusuario"] ?>'>
                    <div class='text-uppercase P-1'>
                        <?php echo $w['nombre'] ?>
                    </div>
                </div>

            </div>
            <div class=''>
                Estimado estudiante rectifique sus apellidos y nombres en ese orden (es decir primero los
                apellidos y luego los nombres) haciendo click sobre la foto. Por ejemplo CHAVEZ GAMBOA, NANCY
                YENY.
            </div>

        </div>

        <div class="container p-1" style="display:none;">
            Solo puede unirse a una clase </br>

            <button type="button" id="ww1" class="btn btn-secondary" data-dismiss="modal">MA-141
                Derecho</button>
            <button type="button" id="ww2" class="btn btn-primary" data-dismiss="modal">MA-141 Industrias
                Alimentarias</button>
            <button type="button" style="display:none" id="elcl" class="btn btn-danger" data-dismiss="modal">Eliminar la
                clase a la que te uniste</button>
        </div>

        <div class="card-body pt-5">
            <?php
            if ($nw > 0) {
                do {
                    ?>
            <div class="card text-center mb-5  border border-info rounded">

                <div class="componentWrapper h5 text-uppercase color border border-info rounded p-0 text-center"
                    id='nombre' data-c1='<?php echo $curso1["id"] ?>' <?php if ($w['tipo'] == 'docente') {
                        echo "contenteditable";
                        } ?>>
                    <?php echo $curso1['nombre'] ?>


                </div>


                <div class="card-body">

                    <div class="row d-flex justify-content-center align-items-center">
                        <?php
                                $con = mysqli_query($link, "SELECT * FROM clase WHERE categoria='" . $curso1['id'] . "'");
                                $n = mysqli_num_rows($con);
                                $curso = mysqli_fetch_assoc($con);
                                
                                
                                
                                if ($n > 0) {
                                    do {
                                        $misclases = mysqli_query($link, "SELECT * FROM misclases WHERE clave='" . $curso['clave'] . "' AND usuario='" . $_SESSION['user'] . "'");
                                        $nmisclases = mysqli_num_rows($misclases);
                                        $misclasesw = mysqli_fetch_assoc($misclases);
                                        ?>

                        <div class="card text-center m-1 pt-5 my-5 mx-3 col-md-6 col-lg-3 col-xl-3  border border-info
                             <?php if ($nmisclases > 0) {
                                 echo " bg-info";
                                } ?>">
                            <div class="componentWrapper pb-3 color border border-info rounded">
                                <div class='h5 p-1 m-0' id='www' data-c1='<?php echo $curso["idclase"] ?>'
                                    <?php if ($w['tipo'] == 'docente') {echo "contenteditable";} ?>>
                                    <?php echo $curso['nombre'] ?>
                                </div>
                                <div class="componentWrapperbottom color border border-info rounded">
                                    <?php echo $curso['descripcion'] ?>

                                </div>
                            </div>
                            <a class='dropdown-item <?php if ($w['tipo'] == 'estudiante') {echo "d-none";} ?>'
                                href='capitulo.php?clave=<?php echo $curso["clave"] ?>'>Editar
                                curso
                            </a>
                            <div class="card-body mb-5">

                                <img <?php if ($w['tipo'] == 'docente') {
                                echo "class='card-img-top -circle m-auto wrapperest
                                update' style='cursor:pointer'";
                            } else {
                                echo "class='card-img-top -circle m-auto wrapperest'";
                            } ?> <?php echo "name='update' id='" . $curso["idclase"] . "' data-id='" . $curso1["id"] . "' src='archivoscrearclase/" . $curso1["id"] . "_" . $curso["idclase"] . "_" . $curso["foto"] . "'" ?>
                                    onerror=this.src='curso.png'>

                            </div>

                            <div class="componentWrapperbottom  py-2 border border-info color rounded">
                                <?php if ($nmisclases > 0 && $w['tipo'] == 'estudiante'){
                                ?>
                                <a class='componentWrapper border border-info btn btn-light'
                                    href='capitulo.php?clave=<?php echo $curso["clave"] ?>'>Ir al curso</a>
                                <hr>
                                <a class='componentWrapperbottom border border-info btn btn-light btn-sm' id="ww1ww"
                                    data-ww='<?php echo $misclasesw["idmiclase"] ?>'>Eliminar de mi curso</a>
                                <?php 
                            }else{
                                ?>
                                <a class='border border-info btn btn-light' id="ww1"
                                    data-ww='<?php echo $curso["clave"] ?>'>Unirse</a>
                                <?php 
                            }?>

                            </div>

                            <div class="componentWrapperbottom color border border-info rounded p-1"
                                <?php if ($w['tipo'] == 'estudiante'){echo "style='display:none;'";}?>>
                                <?php
                                                $conzw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $curso['clave'] . "'");
                                                $zzw = mysqli_fetch_assoc($conzw);
                                                $ww = mysqli_num_rows($conzw);



                                                ?>

                                <?php if ($w['tipo'] == 'docente') { ?>
                                <button class="btn btn-light" data-toggle="collapse"
                                    data-target="#w<?php echo $curso['idclase'] ?>" aria-expanded="false" aria-controls="w
                                <?php echo $curso['idclase'] ?>">
                                    Descripción
                                </button>
                                <div class="collapse" id="w<?php echo $curso['idclase'] ?>">

                                    <div class='card-text bg-light my-2' id='cc3'
                                        data-c3='<?php echo $curso["idclase"] ?>'
                                        <?php if ($w['tipo'] == 'docente') {echo "contenteditable";} ?>>
                                        <?php echo $curso['descripcion'] ?>
                                    </div>
                                </div>
                                <button class="btn btn-light" data-toggle="collapse"
                                    data-target="#ww<?php echo $curso['idclase'] ?>" aria-expanded="false"
                                    aria-controls="ww<?php echo $curso['idclase'] ?>">
                                    Examen
                                </button>
                                <div class="collapse" id="ww<?php echo $curso['idclase'] ?>">

                                    <div class='bg-light my-2' id='cc1w' data-c3='<?php echo $curso["idclase"] ?>'
                                        <?php if ($w['tipo'] == 'docente') {echo "contenteditable";} ?>>
                                        <?php echo $curso['examen'] ?>
                                    </div>



                                    <div>
                                        Fecha examen
                                        <input class='form-control bg-light my-2' id='www1'
                                            data-c3='<?php echo $curso["idclase"] ?>'
                                            value='<?php echo $curso['fechaexa'] ?>' />
                                    </div>
                                    <div>
                                        Fecha tarea
                                        <div class='bg-light my-2' id='cc5' data-c3='<?php echo $curso["idclase"] ?>'
                                            <?php if ($w['tipo'] == 'docente') {echo "contenteditable";} ?>>
                                            <?php echo $curso['fechatarea'] ?>
                                        </div>
                                    </div>

                                    <div>

                                        Tiempo examen
                                        <div class='card-text bg-light my-2' id='cc3w'
                                            data-c3='<?php echo $curso["idclase"] ?>'
                                            <?php if ($w['tipo'] == 'docente') {echo "contenteditable";} ?>>
                                            <?php echo $curso['timex'] ?>
                                        </div>
                                    </div>

                                </div>
                                <?php } ?>

                                <button class="btn btn-light dropdown-toggle" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opciones
                                </button>

                                <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                                    <?php if ($w['tipo'] == 'docente') { ?>
                                    <button class='dropdown-item' type='button' name='delete' id='deletecurso'
                                        data-c1='<?php echo $curso["idclase"] ?>' data-cc1='
                                        <?php echo $curso1["id"] ?>'>Eliminar curso</button>
                                    <a class='dropdown-item'
                                        href='capitulo.php?clave=<?php echo $curso["clave"] ?>'>Editar
                                        curso
                                    </a>
                                    <?php } ?>
                                    <button style='display:none' type="button" class='dropdown-item' data-toggle="modal"
                                        data-target="#ww<?php echo $curso['idclase'] ?>">
                                        Introducción
                                    </button>
                                    <?php if ($nmisclases > 0) { ?>
                                    <a class='dropdown-item' href='capitulo.php?clave=<?php echo $curso["clave"] ?>'>Ir
                                        al
                                        curso
                                    </a>

                                    <?php } else {?>
                                    <input style='display:none' type='button' name='' class='dropdown-item buyButtonw'
                                        value='Comprar el curso' <?php echo "user='" . $_SESSION["user"] . "'
                                        categoria='" . $curso1["id"] . "' clave='" . $curso["clave"] . "'
                                        curso='" . $curso["nombre"] . "' data-producto='" . $curso["nombre"] . "'
                                        id='" . $curso["idclase"] . "' data-precio='" . $curso["precio"] . "00'" ?>>

                                    <?php } ?>
                                </div>



                                <?php if ($w['tipo'] == 'docente') { ?>
                                <div class='bg-light mt-1' id='ccc' data-cc='<?php echo $curso["idclase"] ?>'
                                    contenteditable>
                                    <?php echo $curso['link'] ?>
                                </div>
                                <?php } ?>

                            </div>

                        </div>
                        <?php
                                    } while ($curso = mysqli_fetch_assoc($con));
                                } else {
                                    echo "No hay curso cree uno nuevo";
                                }

                                ?>
                    </div>

                </div>

                <div class="card-footer text-muted">
                    <?php if ($w['tipo'] == 'docente') { ?>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" id='delete' data-c1='<?php echo $curso1["id"] ?>'>Eliminar
                                categoría</button>
                            <button class="dropdown-item" id='curso' data-c1='<?php echo $curso1["id"] ?>'>Adicionar
                                curso</button>
                        </div>
                    </div>

                    <?php } ?>
                </div>

            </div>
            <?php
                } while ($curso1 = mysqli_fetch_assoc($conw));
            } else {
                ?>
            No hay cree uno nuevo;
            <?php
            }
            ?>

        </div>





        <div class="card-footer p-1">
            <?php if ($w['tipo'] == 'docente') { ?>
            <button class='btn bg-light' id='categoria'>ADICIONAR CATEGORIA</button>
            <?php } ?>

            <?php

            if (isset($_REQUEST['ew'])) {
                mysqli_query($link, "DELETE FROM misclases WHERE idmiclase=" . $_REQUEST['ew']);
            }
            $con = mysqli_query($link, "SELECT * FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='" . $_SESSION['user'] . "'");
            $n = mysqli_num_rows($con);
            $ww = mysqli_fetch_assoc($con);
            if($w['tipo']=='estudiante'){
            ?>
            <h5 class='text-center bg-light border p-1 mb-1'>TUS CURSOS</h5>

            <?php
            $con = mysqli_query($link, "SELECT * FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='" . $_SESSION['user'] . "'");
            $n = mysqli_num_rows($con);
            $ww = mysqli_fetch_assoc($con);
            if($n>0){
            ?>

            <div class="container-fluid bg-info p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                $i = 0;
                                foreach ($con as $row) {
                                    $actives = '';
                                    if ($i == 0) {
                                        $actives = 'active';
                                    }
                                ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>"
                                    class="<?= $actives; ?>"></li>
                                <?php $i++;
                                } ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                $i = 0;
                                foreach ($con as $row) {
                                    $actives = '';
                                    if ($i == 0) {
                                        $actives = 'active';
                                    }
                                ?>
                                <div class="carousel-item <?= $actives; ?>">
                                    <img class="d-block m-auto wrapperestw "
                                        src='<?php echo "archivoscrearclase/" . $row["categoria"] . "_" . $row["idclase"] . "_" . $row["foto"]; ?>'>
                                    <div class="carousel-caption d-none d-md-block">
                                        <a class="btn btn-outline-light  border h3 m-1"
                                            href='<?php echo "capitulo.php?clave=" . $row["clave"] ?>'>
                                            <?= $row['nombre'] ?>
                                        </a>
                                        <div class="container">

                                            <div class="btn-outline-light rounded p-2">
                                                <?= $row['descripcion'] ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php $i++;
                                } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }else{
                ?>
            No tiene cursos
            <?php
            }}
            ?>
        </div>
    </div>
</div>


<style>
.wrapperest {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border-radius: 50%;
    position: relative;
    object-fit: cover;
}

.wrapperestw {
    height: 100%;
    overflow: hidden;
    border-radius: 0%;
    position: relative;
    object-fit: cover;
}
</style>