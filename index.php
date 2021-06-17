<?php
require('conect.php');
session_start();
if (isset($_REQUEST['correo']) && !empty($_REQUEST['correo'])) {
    $u = $_POST['correo'];
    $p = $_POST['pass'];
    $esta = mysqli_query($link, "SELECT * FROM usuario WHERE  passw='$p' AND email='$u'");
    $nesta = mysqli_num_rows($esta);
    $estaw = mysqli_fetch_assoc($esta);
    if ($nesta == 1) {
        //		echo "<script> alert('".$estaw['idusuario']."')</script>";
        $_SESSION['user'] = $estaw['idusuario'];
        header("Location:inicio.php");
    } else {
        echo "<script> alert('Email o contraseña incorrecto')</script>";
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if (isset($_REQUEST['nombreww']) && !empty($_REQUEST['nombreww'])) {
    //	$str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //    $u="";
    //    for($i=0;$i<11;$i++){
    //        $u .=substr($str,rand(0,62),1);
    //    }
    $p = $_REQUEST['password'];
    $c = $_REQUEST['correoww'];
    $n = $_REQUEST['nombreww'];
    $t = $_REQUEST['tipo'];

    if (str_word_count($n) > 2 && str_word_count($n) < 6) {
        if (filter_var($c, FILTER_VALIDATE_EMAIL)) {
            $ff = mysqli_num_rows(mysqli_query($link, "SELECT * FROM usuario WHERE email='" . $c . "'"));
            if ($ff > 0) {
                echo "<script> alert('Email ya esta registrado')</script>";
            } else {
                mysqli_query($link, "INSERT INTO usuario VALUES (NULL,'$p','$n',NULL,'$t','$c', 'enviado')");
                //				copy($_FILES['picture']['tmp_name'],"archivos/".$u.$f);




                $registro = mysqli_query($link, "SELECT * FROM usuario WHERE email='$c'");
                $nregistro = mysqli_num_rows($registro);
                $registrow = mysqli_fetch_assoc($registro);

                $_SESSION['user'] = $registrow['idusuario'];
                header("Location:inicio.php");
            }
        } else {
            echo ("<script> alert('Formato de email incorrecto')</script>");
        }
    } else {
        echo ("<script> alert('Especifique dos apellidos y un nombre como minimo y como máximo cinco palabras')</script>");
    }
}

if(isset($_REQUEST['textitems'])){
    $texto=$_POST['textitems'];
    $texto = mysqli_real_escape_string($link, $texto); 
    $consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, NULL , 'acercaitems', NULL, NULL)");
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    }
      
    //insert beneficios
    if(isset($_REQUEST['text'])){
    $texto=$_POST['text'];
    $texto = mysqli_real_escape_string($link, $texto); 
    $consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, NULL, 'beneficios', NULL, NULL)");
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    }
    
    
    //insert videodescripcion
    if(isset($_REQUEST['textvideo'])){
    $texto=$_POST['textvideo'];
    $texto = mysqli_real_escape_string($link, $texto); 
    $consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, 'Link de video aqui' , 'video', NULL, NULL)");
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    }
    
    
    //refresh ITEMS
    if(isset($_REQUEST['texto'])){
      $id=$_POST['id'];
      $texto=$_POST['texto'];
      $texto = mysqli_real_escape_string($link, $texto); 
      $columna=$_POST['columna'];
    $consulta=mysqli_query($link,"UPDATE land SET $columna='$texto' WHERE idland =$id");
     mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    }
    //refresh FOOTER
    if(isset($_REQUEST['textff'])){
    $id=$_POST['id'];
    $texto=$_POST['textff'];
    $texto = mysqli_real_escape_string($link, $texto); 
    $columna=$_POST['columna'];
    $consulta=mysqli_query($link,"UPDATE foot SET $columna='$texto' WHERE idfoot ='$id'");
    // mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
    if(!$consulta){
      echo "no ok ww";
    }else{
      echo "ok";
    }
    }
    
    //upload logo
    if(isset($_FILES["filesww"])){
    $na=$_FILES['filesww']['name'];
    $id=$_POST['id'];
    $tipo=$_FILES['filesww']['type'];
    $t=$_FILES['filesww']['size'];
    $wr=mysqli_query($link,"SELECT * FROM land WHERE idland='$id' AND tipo='foto' OR tipo='logo'");
    $wrw=mysqli_fetch_assoc($wr);
    
    unlink('archivoslandscape/'.$id.$wrw['foto']);
    
    
    $consulta=mysqli_query($link,"UPDATE land SET foto='$na' WHERE idland =$id");
    
    //$idarchivo=mysqli_insert_id($link);
    copy($_FILES['filesww']['tmp_name'],"archivoslandscape/".$id.$na);
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    }
    
    //upload fotos
    if(isset($_FILES["filesw"])){
    //  $clave=$_POST['claves'];
    //$user=$_POST['user'];
    //echo $user;
    $na=$_FILES['filesw']['name'];
    //echo $na;
    $tipo=$_FILES['filesw']['type'];
    $t=$_FILES['filesw']['size'];
    $consulta=mysqli_query($link,"INSERT INTO land VALUES (NULL, 'Nombre', 'Texto', '$na', NULL , 'foto', NULL, NULL)");
    $idarchivo=mysqli_insert_id($link);
    copy($_FILES['filesw']['tmp_name'],"archivoslandscape/".$idarchivo.$na);
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok";
    }
    
    }
    
    //delete ids
    if(isset($_REQUEST['idele'])){
      $id=$_POST['idele'];
      echo "zzz";
    $wr=mysqli_query($link,"SELECT * FROM land WHERE idland='$id' AND tipo='foto' OR tipo='logo'");
    //$wr=mysqli_num_rows($wr);
    $wrw=mysqli_fetch_assoc($wr);
    
    $consulta=mysqli_query($link, "DELETE FROM land WHERE idland=$id");
    unlink('archivoslandscape/'.$id.$wrw['foto']);
    //$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
    //$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
    //mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
    if(!$consulta){
      echo "no ok";
    }else{
      echo "ok delete";
    }
    }
?>


<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="imagenes/w.ico">


<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<link rel="stylesheet" href="Css/css/bootstrap.css">
<link rel="stylesheet" href="Css/font-awesome.min.css">

<script src="Css/jquery-3.0.0.min.js" crossorigin="anonymous"></script>
<script src="Css/js/bootstrap.js" crossorigin="anonymous"></script>


<!--
<style>
.card, .btn, .form-control { border-radius: 0; }
</style>

<style>
* {
    margin: 0;
    font-family: 'Merriweather', serif;
    box-sizing: border-box;
    font-weight: 500;
}

</style>
    first
    margin
    index
-->



<?php
if(!isset($_SESSION['user'])){
?>
    <nav class="navbar smart-scroll navbar-expand-lg navbar-light bg-light border py-1">
        <a class="navbar-brand" href="inicio.php">Fisart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="" class="nav-link" data-toggle="modal"
                        data-target="#modalRegisterForm">Registro</a>
                </li>
                <li class="nav-item active"><a href="" class="nav-link" data-toggle="modal"
                        data-target="#modalLoginForm">Iniciar sesión</a>
                </li>
            </ul>
        </div>

    </nav>

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            <form action="index.php" method="post">

                <div class="modal-header text-center">
                    <div style="text-align:center"><img src="imagenes/ww2.svg" style="width:80px;" alt=""></div>
                    <h4 class="modal-title w-100 font-weight-bold">Iniciar sesión</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class='fa fa-envelope prefix grey-text' style='font-size:20px'></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="correo" aria-label="Text input with checkbox"
                            placeholder="email">
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class='fa fa-lock prefix grey-text' style='font-size:20px'></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="pass"
                            aria-label="Text input with radio button" placeholder="password">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-light ">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div style="text-align:center"><img src="imagenes/ww2.svg" style="width:80px;" alt=""></div>

                <h4 class="modal-title w-100 font-weight-bold">Resgístrese</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="modal-body mx-3">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class='fa fa-user prefix grey-text' style='font-size:20px'></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with checkbox"
                            placeholder="Nombre" name="nombreww">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class='fa fa-envelope prefix grey-text' style='font-size:20px'></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with radio button"
                            placeholder="Correo" name="correoww">
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class='fa fa-lock prefix grey-text' style='font-size:20px'></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" aria-label="Text input with radio button"
                            placeholder="Contraseña" name="password">
                    </div>
                    <select style="display:none" type="tipo" name="tipo">
                        <option value="estudiante">Estudiante</option>
                        <option value="docente">Docente</option>
                    </select>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-light ">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('body').css('padding-top', $('.navbar').outerHeight() + 'px')
// detect scroll top or down
if ($('.smart-scroll').length > 0) { // check if element exists
    var last_scroll_top = 0;
    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop();
        if (scroll_top < last_scroll_top) {
            $('.smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        } else {
            $('.smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
        }
        last_scroll_top = scroll_top;
    });
}
</script>

<style>
.smart-scroll {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
}

.scrolled-down {
    transform: translateY(-100%);
    transition: all 0.3s ease-in-out;
}

.scrolled-up {
    transform: translateY(0);
    transition: all 0.3s ease-in-out;
}

body {
    margin: 0;
    margin-top: 0px;
    background-color: #fff;
    padding: 0px;
}
</style>


<?php }else{include('first.php'); }?>


<!--

<script type='text/javascript'>
JXG.Options.text.useMathJax = true;
JXG.Options.text.fontSize = 14;
JXG.Options = JXG.merge(JXG.Options, {
    showNavigation: false,
    point: {
        face: 'o',
        showInfobox: false,
        size: 1,
        color: '#000000'
    }
});
</script>


<iframe style="border:none;border-radius:30px 1px 30px 1px;width:95%;height:360px;display:block;margin:auto;" src="3/examples/webgl_points_dynamic.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/physics_ammo_break.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/my.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="untitled.html" seamless></iframe>
-->

<script>
$(document).ready(function() {
    function getw_data() {
        $.ajax({
            url: "indexajax.php",
            method: "POST",
            success: function(data) {
                $("#resulta").html(data)
            }
        })
    }

    //INSERTAR BENEFICIOS
    $(document).on("click", "#additems", function() {
        var text = "Edite";
        //   alert(text);
        $.ajax({
            url: "index.php",
            method: "post",
            data: {
                textitems: text
            },
            success: function(data) {
                getw_data();
                //   alert(data);
            }
        })
    })

    //INSERTAR BENEFICIOS
    $(document).on("click", "#add", function() {
        var text = "Edite";
        //   alert(text);
        $.ajax({
            url: "index.php",
            method: "post",
            data: {
                text: text
            },
            success: function(data) {
                getw_data();
                //   alert(data);
            }
        })
    })



    //INSERTAR videodescripcion
    $(document).on("click", "#addvideo", function() {
        var text = "Edite";
        //   alert(text);
        $.ajax({
            url: "index.php",
            method: "post",
            data: {
                textvideo: text
            },
            success: function(data) {
                getw_data();
                //   alert(data);
            }
        })
    })


    //ACTUALIZAR
    function actualizar_datos(id, texto, columna) {
        $.ajax({
            url: "index.php",
            method: "post",
            data: {
                id: id,
                texto: texto,
                columna: columna
            },
            success: function(data) {
                getw_data();
                //alert(data);
            }
        })
    }

    //ACTUALIZAR texto
    $(document).on("blur", "#ww1", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        //alert(id);
        actualizar_datos(id, x1, "texto")
    })
    //ACTUALIZAR videoescripcion
    $(document).on("blur", "#wwvideo", function() {
        var id = $(this).data("c1");
        var x = $(this).text();
        https: //www.youtube.com/watch?v=1sWBVXUQTII&ab_channel=VidaMRR
            var x1 = x.replace('https://www.youtube.com/watch?v=',
                'https://www.youtube-nocookie.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "archivo")
    })
    //ACTUALIZAR nombre
    $(document).on("blur", "#wwnombre", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        // alert(id);
        actualizar_datos(id, x1, "nombre")
    })
    //ACTUALIZAR color
    $(document).on("change", "#color", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "color")
    })

    //ACTUALIZAR color2
    $(document).on("change", "#color2", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "color2")
    })


    //actualizar archivos logo.
    $(document).on("change", "#imagew2", function() {
        var id = $(this).data("c1");
        var data = new FormData();
        data.append('filesww', $('#imagew2')[0].files[0]);
        data.append('id', id);
        //    data.append('user',user);	
        //  alert(id);
        $.ajax({
            type: 'post',
            url: "index.php",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                getw_data();
                //        alert(data);
            }
        });
    });


    //archivos foto insert.
    $(document).on("change", "#imagew", function() {
        var data = new FormData();
        data.append('filesw', $('#imagew')[0].files[0]);
        //    data.append('claves',claves);
        //    data.append('user',user);	
        //  alert("data");

        $.ajax({
            type: 'post',
            url: "index.php",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                getw_data();
                //        alert(data);
            }
        });
    });



    //ACTUALIZAR footer
    function actualizarw(id, texto, columna) {
        $.ajax({
            url: "index.php",
            method: "post",
            data: {
                id: id,
                textff: texto,
                columna: columna
            },
            success: function(data) {
                getw_data();
                //   alert(data);
            }
        })
    }
    //ACTUALIZAR textff
    $(document).on("blur", "#ffw", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t1")
    })
    $(document).on("blur", "#ffw2", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t2")
    })
    $(document).on("blur", "#ffw3", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t3")
    })
    $(document).on("blur", "#ffw4", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t4")
    })
    $(document).on("blur", "#ffw5", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t5")
    })
    $(document).on("blur", "#ffw6", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t6")
    })
    $(document).on("blur", "#ffw7", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t7")
    })
    $(document).on("blur", "#ffw8", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t8")
    })
    $(document).on("blur", "#ffw9", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t9")
    })
    $(document).on("blur", "#ffw9", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t9")
    })
    $(document).on("blur", "#ffw10", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t10")
    })
    $(document).on("blur", "#ffw11", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t11")
    })
    $(document).on("blur", "#ffw12", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t12")
    })
    $(document).on("blur", "#ffw13", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t13")
    })
    $(document).on("blur", "#ffw14", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t14")
    })
    $(document).on("blur", "#ffw15", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizarw(id, x1, "t15")
    })




    //ELIMINAR ids
    $(document).on("click", "#deleter", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("ff");
            //   alert(idw);
            //   alert(idw);
            $.ajax({
                url: "index.php",
                method: "post",
                data: {
                    idele: idw
                },
                success: function(data) {
                    getw_data();
                    //alert(data);
                }
            })
        };
    })

    getw_data();

});
</script>


<div id="resulta"></div>


<?php include('footer.php'); ?>