<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>

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


if (isset($_REQUEST['clavecurso'])) {
  $clave = $_POST['clavecurso'];
  $idseccion = $_POST['idseccion'];
  $idcapitulo = $_POST['idcapitulo'];
  $user = $_POST['user'];
  $text = $_POST['text'];
  $text = mysqli_real_escape_string($link, $text);
  //$na=$_FILES['archivo']['name'];

  $tarea = mysqli_query($link, "SELECT * FROM tareas WHERE idseccion='$idseccion' AND usuario='$user' AND clave='$clave'");
  $ntarea = mysqli_num_rows($tarea);
  if ($ntarea > 0) {
    $consulta = mysqli_query($link, "UPDATE  tareas SET texto='$text' WHERE usuario='$user' AND idseccion='$idseccion'");
    if (!$consulta) {
      echo "no ok refresh";
    } else {
      echo "ok refresh";
    }
  } else {
    $consulta = mysqli_query($link, "INSERT INTO tareas VALUES(NULL, '$text','$user','$clave',NULL,'foto', NULL, '$idseccion', '$idcapitulo')");
    if (!$consulta) {
      echo "no ok insert";
    } else {
      echo "ok insert";
    }
  }
}

if (isset($_FILES["file"])) {
  //$na=$_FILES['file'];
  $idseccion = $_POST['idseccion'];
  $user = $_POST['user'];
  $na = $_FILES['file']['name'];
  echo $na;
  $tipo = $_FILES['file']['type'];
  $t = $_FILES['file']['size'];

  array_map('unlink', glob("archivostarea/" . $idseccion . "_*"));
  $consulta = mysqli_query($link, "UPDATE  tareas SET archivo='".$idseccion . "_" .$user. "_" . $na."' WHERE idseccion='$idseccion' AND usuario='$user'");
  copy($_FILES['file']['tmp_name'], "archivostarea/" . $idseccion . "_" .$user. "_" . $na);
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok";
  }
}


//delete tarea
if (isset($_REQUEST['ideleteww1'])) {
  $id = $_POST['ideleteww1'];
  $ids = $_POST['ideletew'];
  $consulta = mysqli_query($link, "DELETE FROM tareas WHERE idtarea=$id");
  array_map('unlink', glob("archivostarea/" . $ids . "_*"));
  //mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok delete seccion";
  }
}

$con = mysqli_query($link, "SELECT * FROM secciones WHERE idseccion='" . $_SESSION['idsec'] . "'");
$n = mysqli_num_rows($con);
$a = mysqli_fetch_assoc($con);

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);






$tareas = mysqli_query($link, "SELECT * FROM tareas WHERE idseccion='" . $_SESSION['idsec'] . "' AND clave='" . $_SESSION['clave'] . "' AND usuario='" . $_SESSION['user'] . "'");
$arraytareas = mysqli_fetch_assoc($tareas);
$nts = mysqli_num_rows($tareas);

?>
<?php if(isset($a['tarea'])){?>
<div class="container p-1 my-1 border text-justify">
    <?php echo $a["tarea"]."" ?>
</div>
<?php }?>
<div class="container p-1 my-1 border text-center text-info">
    Tareas repetidas no serán calificadas!.</div>

<?php 
if ($w['tipo'] == 'estudiante') {                                                                                                                                                     //
  if (!isset($arraytareas['evaluacion'])) {                                                                                                                                                     //

?>
<div class="container p-1 my-1 border  bg-info">

    <div class="container p-1 mb-1 border  bg-secondary">
        <?php if ($nts > 0) {?>
        <div class="text-center">
            <div class="container-flex">
                <?php if($arraytareas["archivo"] == "foto"){}else{?>
                <!-- <?php $acceptable = array("pdf", "jpeg","jpg","png","PNG");
                  if(in_array(substr($arraytareas["archivo"], strrpos($arraytareas["archivo"], '.')+1), $acceptable)){?>
                  <div class="card">
                <img class="img-fluid " src="archivostarea/<?php echo $arraytareas["archivo"] ?>" alt="www">
                </div>
                <?php }else{}?> -->
            </div>
            <a class="btn btn-light my-1" style='cursor: pointer;display:;'
                href='archivostarea/<?php echo  $arraytareas["archivo"] ?>' target="_blank">
                Descargar  <?php echo $arraytareas["archivo"];  ?> </a>
                 <?php } ?>
        </div class="text-center">
        <div class="container p-1 my-1 border text-center text-info" style='cursor: pointer;display:none;'>

            <?php if ($_SESSION['clave'] == 'APNJs7exKv'){?>
            <a class='btn btn-light  border' href="https://www.dropbox.com/request/3rLZXZQl6dkWHNvXAzTT"
                target="_blank">Cargar archivo de
                imagen o imagenes en pdf (Adjunte su nombre), no mayor a 1MB</a>
            <?php }else{?>
            <a class='btn btn-light m-1 border' href="https://www.dropbox.com/request/By4tGOHK8r8AdTLdmCqp"
                target="_blank">Cargar archivo de
                imagen o imagenes en pdf (Adjunte su nombre), no mayor a 1MB</a>
            <?php }?>
        </div>
        <div class="text-center">
        <a class="btn btn-light" onclick='fileUpload()'><?php if($arraytareas["archivo"] == "foto"){echo "Cargar archivo";}else{echo "Modificar archivo";}?> (Formatos permitidos: pdf, jpeg, jpg y png)</a>
        </div>

        <script>
        function fileUpload() {
            $("#imagew").click();
        }
        </script>
    </div>

    <textarea class='form-control m-1 rrr' name='texto' id='addtarea'
        required><?php echo $arraytareas['texto'] ?></textarea>

    <?php }?>

    <div id='w77' type="button" class="container-flex p-1 mb-2 alert alert-info collapse" data-dismiss="alert"
        aria-label="Close">
        Ok guardado tarea
    </div>

    <a class='btn btn-light border mt-1' id='adicionar1'
        data-idw='<?php echo $arraytareas['idtarea']."' data-ids='". $_SESSION["idsec"] ?>'>
        <?php if ($nts > 0) {echo "Guardar tarea del editor";}else{echo "Entregar";}?>
    </a>

    <?php if ($nts > 0) {?>

    <a class='btn btn-danger border mt-1' id='deleteww'
        <?php echo "data-idw='".$arraytareas['idtarea']."' data-ids='".$_SESSION['idsec']."'" ?>>
        Eliminar tarea
    </a>

    <div class="container p-1 my-1 text-center text-white">
        Puedes seguir editando hasta el cierre
    </div>

    <?php }?>

</div>
<?php }else{?>
<div class="container text-center border bg-info">Tarea evaluada</div>
<?php }?>
<input id='imagew' id='<?php echo $arraytareas["idtarea"] ?>' type='file' style='display:none'></input>


<script>
$(document).ready(function() {
    $('.rrr').richText();
});
</script>


<?php if(isset($arraytareas['texto'])){?>
<div class="container p-1 my-1  text-justify border bg-primary">

    <?php if ($nts > 0) {?>
    <div class='container-flex bg-light border'>
    <?php $acceptable = array("jpeg","jpg","png","PNG");
                  if(in_array(substr($arraytareas["archivo"], strrpos($arraytareas["archivo"], '.')+1), $acceptable)){?>
                  <div class="card">
                <img class="img-fluid " src="archivostarea/<?php echo $arraytareas["archivo"] ?>" alt="www">
                </div>
                <?php }else{}?>
        <?php echo $arraytareas['texto'] ?>
    </div>

    <div class='container-flex'>
        <?php 
        if ($arraytareas['evaluacion'] != "") {
          echo "[ Evaluacion: <span>" . $arraytareas['evaluacion'] . "</span> ]";
        }
        ?>
        Fecha de entrega:
        <?php echo $arraytareas['fecha'] ?>
    </div>
    <?php }?>

</div>
<?php }?>
<?php if(isset($a['nombre'])){?>
<div class="container p-1 my-1  text-justify border">

    <div class='container-flex  text-justify'>
        <h3>
            <?php echo $a['nombre'] ?>
        </h3>
        <div>
            <?php echo $a['texto'] ?>
        </div>
    </div>
</div>
<?php }?>

<?php                                                                                                                                            //
}
?>