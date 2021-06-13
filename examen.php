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

$r=1;

if (isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])) {
    $_SESSION['clave'] = $_REQUEST['clave'];
}

if (isset($_REQUEST['jjw'])) {
    $clave = $_SESSION['clave'];
    $pregunta = $_REQUEST['pregunta'];
    $nota = $_REQUEST['nota'];
    $tipo = $_REQUEST['tipo'];
    mysqli_query($link, "INSERT INTO examen VALUES(NULL, '$clave','$pregunta', '$nota', '$tipo', NULL)");
}

if (isset($_REQUEST['e'])) {
    mysqli_query($link, "DELETE FROM examen WHERE idpregunta='" . $_REQUEST['e'] . "'");
    mysqli_query($link, "DELETE FROM preguntas WHERE clavepregunta='" . $_REQUEST['e'] . "'");
    //mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
}

$conw = mysqli_query($link, "SELECT * FROM examen WHERE clavecurso='" . $_SESSION['clave'] . "'");
$nw = mysqli_num_rows($conw);
$ww = mysqli_fetch_assoc($conw);

if (!isset($_GET['idcapitulo'])) {
    $_GET['idcapitulo'] = 'cpt';
}
$_SESSION['idcapitulo'] = $_GET['idcapitulo'];


$_SESSION['clavew'] = $ww['idpregunta'];

if (!isset($_GET['cap'])) {
    $_GET['cap'] = 'cpt';
}

$_SESSION['cap'] = $_GET['cap'];


if (isset($_REQUEST['enviar'])) {
    $texto = $_REQUEST['respuesta'];
    $texto = mysqli_real_escape_string($link, $texto);
    mysqli_query($link, "UPDATE examen SET rptaescrita= '$texto', WHERE idpregunta = '" . $_SESSION['claves'] . "'");
    header("Location:examen.php?clave=" . $_SESSION['clave']);
}

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Examen de <?php echo $wew['nombre'] ?> capítulo <?php echo $_SESSION['cap']?></title>

<?php include('margin.php'); ?>


<script>
$(document).ready(function() {
    function obtener_datos() {
        $.ajax({
            url: "examen_mostrar.php",
            method: "POST",
            success: function(data) {
                $("#result").html(data)
            }
        })
    }
    obtener_datos();



    //INSERTAR Preguntas
    $(document).on("click", "#add", function() {
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var pregunta = "Escriba su pregunta aqui";
        var idcapitulo = $(this).data("idcapitulo");
        var calif = "3";
        var tipo = "alternativa";
        //   alert(idcapitulo);
        //   alert(calif);
        //   alert(tipo);
        $.ajax({
            url: "sendpreguntas.php",
            method: "post",
            data: {
                w1: pregunta,
                w2: calif,
                clavv: clave,
                ww: tipo,
                idcapitulo: idcapitulo
            },
            success: function(data) {
                obtener_datos(); //alert(data);
            }
        })
    })





    //ELIMINAR preguntas
    $(document).on("click", "#delete", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {

            var id = $(this).data("id");
            //alert(id);
            $.ajax({
                url: "delete.php",
                method: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    obtener_datos();
                    //alert(data);
                }
            })
        };
    })

    //ELIMINAR altr 
    $(document).on("click", "#deletealtr", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {

            var id = $(this).data("idaltr");
            //   alert(id);
            $.ajax({
                url: "deletealternativa.php",
                method: "post",
                data: {
                    id: id
                },
                success: function(data) {
                    obtener_datos();
                    //alert(data);
                }
            })
        };
    })



});
</script>

<div id="result"></div>