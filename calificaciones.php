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

$r=6;


$_SESSION['cc'] = $_GET['cc'];
$_SESSION['estudiante'] = $_GET['estudiante'];

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Calificación de <?php echo $wew['nombre'] ?></title>


<?php include('margin.php'); ?>



<script>
$(document).ready(function() {
    function mostrar_datos() {
        $.ajax({
            url: "calificacion_ajax.php",
            method: "POST",
            success: function(data) {
                $("#resultado").html(data)
            }
        })
    }
    mostrar_datos();


    //INSERTAR y actualizar DATOS respuestas escrita
    $(document).on("blur", "#fff", function() {
        var user = $(this).data("user");
        var clavepregunta = $(this).data("fffff");
        var x3 = $(this).val();
        //alert(clavepregunta);
        $.ajax({
            url: "sendrespuestas.php",
            method: "post",
            data: {
                clavepregw: clavepregunta,
                xww: x3,
                userww: user
            },
            success: function(data) {
                mostrar_datos();
//                alert(data);
            }
        })
    })


    //INSERTAR nota tareas
    $(document).on("blur", "#nota", function() {
        var ids = $(this).data("nota");
        //var clavepregunta=$(this).data("fffff");
        var x3 = $(this).val(); ///
        //alert(ids);
        $.ajax({
            url: "sendrespuestas.php",
            method: "post",
            data: {
                ids: ids,
                x3: x3
            },
            success: function(data) {
                mostrar_datos();
                //alert(data);
            }
        })
    })


});
</script>

<div id="resultado"></div>