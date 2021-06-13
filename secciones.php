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

$_SESSION['idcpt'] = $_GET['clavezz'];
$_SESSION['idsec'] = $_GET['clavez'];

//echo $_SESSION['idcpt']."--";
//echo $_SESSION['idsec'];
$conw1 = mysqli_query($link, "SELECT * FROM secciones WHERE clavew='" . $_SESSION['idsec'] . "' AND idseccion='" . $_SESSION['idcpt'] . "'");
$ww1 = mysqli_fetch_assoc($conw1);
$nw1 = mysqli_num_rows($conw1);

$conwww = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wewwww = mysqli_fetch_assoc($conwww);
?>
<title>Editar <?php echo $wewwww['nombre'] ?></title>


<script src="jquery-3.0.0.min.js"></script>


<?php include('margin.php'); ?>

<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>



<?php
$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$conw1 = mysqli_query($link, "SELECT * FROM secciones WHERE clavew='" . $_SESSION['idsec'] . "' AND idseccion='" . $_SESSION['idcpt'] . "'");
$ww1 = mysqli_fetch_assoc($conw1);
$nw1 = mysqli_num_rows($conw1);

?>
<div class="container p-1 my-1">

    <div class="card">

        <div class='card-header'>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Título de la sección</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                    aria-describedby="basic-addon1" id='w77777' data-fff='<?php echo $ww1["idseccion"]?>'
                    value='<?php echo $ww1['nombre']?>'>
            </div>
        </div>
        <div class="card-body p-1">
            <textarea id='rrr' data-wwtexto='<?php echo $ww1["idseccion"]?>'
                contenteditable><?php echo $ww1['texto']?></textarea>
        </div>
        <div class="card-footer p-1 text-center">
            <div id='www1' type="button" class="container-flex p-1 mb-2 alert alert-info collapse" data-dismiss="alert"
                aria-label="Close">
                Ok guardado sección
            </div>
            <button class='btn btn-light' id='save'>Guardar sección</button>
        </div>
    </div>
</div>


<div class="container p-1 my-1">

    <div class="card">
        <div class='card-header text-center'>Tarea</div>
        <div class="card-body p-1">
            <textarea id='r777' data-www77='<?php echo $ww1["idseccion"]?>'
                contenteditable><?php echo $ww1['tarea']?></textarea>
        </div>
        <div class="card-footer p-1 text-center">
            <div id='www2' type="button" class="container-flex p-1 mb-2 alert alert-info collapse" data-dismiss="alert"
                aria-label="Close">
                Ok guardado tarea
            </div>
            <button class='btn btn-light' id='saveww'>Guardar tarea</button>
        </div>
    </div>
</div>

<?php 
    $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion='".$ww1['idseccion']."'");
    $notw=mysqli_fetch_assoc($not);
    $nnot=mysqli_num_rows($not);

    if($w['tipo']=='estudiante'){
      ?>

<div class=''>

    <?php         if($notw['evaluacion']!=""){?>
    Calificación:
    <?php echo $notw['evaluacion']?>";
    <?php }elseif($nnot>0){?>
    Tarea aún no evaluada -
    <a class='btn btn-info' href='sesion.php?claveww=<?php echo $ww1[' idseccion']?>'>Modificar</a>";
    <?php }else{?>
    Tarea no entregada -
    <a class='btn btn-info' href='sesion.php?claveww=<?php echo $ww1[' idseccion']?>'>Entregar</a>";
    <?php }?>
    <a style='text-decoration:none;color:rgb(255,255,255)' href='calificaciones.php'> - Resumen de
        <?php echo $ww1['idseccion']?>
    </a>";


</div>
<?php }?>



<script>
$(document).ready(function() {
    $('#rrr').richText();
});
</script>


<script>
$(document).ready(function() {
    $('#r777').richText();
});
</script>


<script>
$(document).ready(function() {
    function obtener_secciones() {
        $.ajax({
            url: "secciones_mostrar.php",
            method: "POST",
            success: function(data) {
                $("#resultadoseccionesww").html(data)
            }
        })
    }


    obtener_secciones();



    //ACTUALIZAR seccion
    function actualizarseccion(id, texto, columna) {
        $.ajax({
            url: "secciones_mostrar.php",
            method: "post",
            data: {
                id: id,
                texto: texto,
                columna: columna
            },
            success: function(data) {
                obtener_secciones();
                //  alert(data);

                //alert('Guardado satisfactoriamente');
            }
        })
    }

    //ACTUALIZAR tarea de seccion
    $(document).on("blur", "#w77777", function() {
        var idw = $(this).data("fff");
        var x1w = $(this).val();
        //   alert(idw);
        //   alert(x1w);
        actualizarseccion(idw, x1w, "nombre")
    })

    //ACTUALIZAR tarea de seccion
    $('#save').click(function() {
        var id = $('#rrr').data("wwtexto");
        var x1 = $('#rrr').val();
        //   alert(id);
        //   alert(x1);
        actualizarseccion(id, x1, "texto")
        $("#www1").show('fade');
        setTimeout(() => {
            $("#www1").hide('fade');
        }, 2000);
    })

    //ACTUALIZAR tarea de seccion
    $('#saveww').click(function() {
        var id = $('#r777').data("www77");
        var x1 = $('#r777').val();
        actualizarseccion(id, x1, "tarea")
        $("#www2").show('fade');
        setTimeout(() => {
            $("#www2").hide('fade');
        }, 2000);
    })


});
</script>


<div id="resultadoseccionesww"></div>