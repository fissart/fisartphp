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


if (isset($_REQUEST['idwel'])) {
  $u = $_POST['idwel'];
  $consulta = mysqli_query($link, "DELETE FROM temas WHERE idtema='$u'");
  if (!$consulta) {
    echo "no ok w";
  } else {
    echo "ok w";
  }
}

date_default_timezone_set("America/Lima");

if (isset($_REQUEST['clavew'])) {
  $u = $_POST['user'];
  $c = $_POST['clavew'];
  $t = $_POST['x1'];

  $datei = new DateTime("now");
  $d1 = date_format($datei, 'Y-m-d H:i:s');

  $t = mysqli_real_escape_string($link, $t);
  $consulta = mysqli_query($link, "INSERT INTO temas VALUES(NULL, '$c','$u','Editar tema', '2021-03-29 00:00:00','Editar link', 'block')");
  if (!$consulta) {
    echo "no ok w";
  } else {
    echo "ok w";
  }
}

//refresh tema
if (isset($_REQUEST['textow'])) {
  $id = $_POST['idw'];
  $texto = $_POST['textow'];
  $texto = mysqli_real_escape_string($link, $texto);
  $columna = $_POST['columnaw'];
  $consulta = mysqli_query($link, "UPDATE temas SET $columna='$texto' WHERE idtema ='$id'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok seccion refresh";
  }
}


$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$qtemas = mysqli_query($link, "SELECT * FROM temas WHERE clave='" . $_SESSION['clave'] . "'"); // ORDER BY fecha DESC");
$ntemas = mysqli_num_rows($qtemas);
$arraytemas = mysqli_fetch_assoc($qtemas);

?>


<script type="text/x-mathjax-config">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>

<style>
.richText .richText-editor {
    padding: 20px;
    background-color: white;
    font-family: Calibri, Verdana, Helvetica, sans-serif;
    height: 100px;
    outline: none;
    overflow-y: scroll;
    overflow-x: auto;
}
</style>

<?php
$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>


<?php  if ($w['tipo'] == 'docente') {?>
<div class="container p-0 my-1">
    <button class='btn btn-light border' id="foroww">Agregar tema y editar</button>
</div>


<?php }?>
<?php 
          if ($ntemas > 0) {
          $i=1;
          do {
            
            
            $now = new DateTime("now");
            
            $cc="4";
            $hh="0";
?>


<div class="container p-0 mb-2">
    <?php  if ($w['tipo'] == 'docente') {?>
    <button class='btn btn-info' id='showw' data-id='<?php echo $arraytemas["idtema"] ?>' data-sw='none'>Esconder
        tema</button>
    <button class='btn btn-info' id='showw' data-id='<?php echo $arraytemas["idtema"] ?>' data-sw='block'>Mostrar
        tema</button>
    <?php }
    
    $ff=new DateTime($arraytemas['fecha']);
    $fff=date_format(new DateTime($arraytemas['fecha'] ), 'Y-m-d H:i:s');
  //echo $ff;
//  $final = new DateTime   ('23-12-2020 12:00:00');
            
    ?>



    <div class="card my-5  border border-success py-3 rounded" style='display:<?php echo$arraytemas["mosesc"]?>'>
        <div class='componentWrapper color border border-success rounded text-center h6 p-1'>
            TEMA
            <?php echo$i;?>

        </div>

        <div class='card-body p-1'>

            <?php 
            $i++;
            ?>
            <?php 
                if ($arraytemas['file'] == 'Editar link') {?>
            <div class="embed-responsive embed-responsive-16by9" style='display:none'>
                <iframe class="embed-responsive-item" src='https://www.youtube.com/embed/zoGqt6ObPC8'
                    allowfullscreen>wwwww</iframe>
            </div>
            <?php } else {?>
            <div class="embed-responsive embed-responsive-16by9" style='display:none'>
                <iframe class="embed-responsive-item" src='<?php echo $arraytemas["file"]?>'
                    allowfullscreen>wwwww</iframe>
            </div>
            <?php }?>
            <?php if ($w['tipo'] == 'docente') {?>
            <div class='bg-light border my-1 -lg p-1' style='display:none' contenteditable id='link'
                <?php echo"data-id='".$arraytemas["idtema"]."'"?>>
                <?php echo$arraytemas['file']?>
            </div>

            <div class="md-form pink-textarea active-pink-textarea">
                <textarea id="<?php echo $arraytemas['idtema']?>" placeholder="Nuevo tema de foro"
                    data-id='<?php echo $arraytemas["idtema"]?>'
                    class="md-textarea form-control <?php echo $arraytemas['idtema'] ?> save"
                    rows="3"><?php echo $arraytemas['tema'] ?></textarea>
            </div>

            <label for="<?php echo $arraytemas['idtema']?>" class="btn btn-secondary mt-1" type="button">Guardar</label>

            <?php }?>

            <script>
            $(document).ready(function() {
                $('.<?php echo $arraytemas['idtema'] ?>').richText();
            });
            </script>
            <?php echo $arraytemas['tema'] ?>
        </div>


        <script>
        $(".www").TimeCircles().rebuild();;
        </script>


        <div class="card-footer text-center p-1">
            <?php if($now < $ff || $w['tipo'] == 'docente'){?>
            <a class='componentWrapperbottom border border-success btn btn-info rounded'
                href='comentarforo.php?idtema=<?php echo $arraytemas["idtema"]?>&numero=<?php echo ($i-1);?>'>Comentar
                tema <?php echo ($i-1);?></a>
            <?php }?>
            <?php if ($w['tipo'] == 'docente') {?>
            <a class='dropdown-item' id='del' href='' data-id='<?php echo $arraytemas["idtema"]?>'>Eliminar tema</a>
            <?php }?>
            <?php if($now < $ff){?>

            <div class="bg-info small my-1">Ud debe realizar 3 comentarios necesariamente y como máximo en cada
                tema,
                cada comentario
                tiene una calificación entre 0 y 20 (verifíquese en sus calificaciones)</div>
            <?php }?>
            <div class="container m-auto rounded col-md-6 col-lg-3 col-xl-3">
                <?php if($now < $ff){?>

                Culmina <?php echo $fff?>. Faltan

                <div class='www bg-light m-auto d-flex justify-content-center rounded' data-date="<?php echo $fff;?>">
                </div>

                <?php }else{?>

                Culminó hace

                <div class='www bg-warning m-auto d-flex justify-content-center rounded' data-date="<?php echo $fff?>">
                </div>
                <?php  }?>


            </div>
            <?php if ($w['tipo'] == 'docente') {?>
            <input type="text" id='fecha' data-www='<?php echo $arraytemas['idtema']?>'
                value='<?php echo $arraytemas['fecha']?>'>
            <?php }?>
            <span class='dropdown-item' style='display:'>Fecha limite:
                <?php echo $arraytemas['fecha']?>
            </span>
            <?php $cc = mysqli_num_rows(mysqli_query($link, "SELECT * FROM comentarios WHERE idtema=" . $arraytemas['idtema']));?>
            <div class='dropdown-item'>
                <?php echo$cc?> Comentarios
            </div>
        </div>


    </div>
    <?php 
  } while ($arraytemas = mysqli_fetch_assoc($qtemas));

} else {?>
    <div class='container bg-info text-center'>No hay temas</div>
    <?php }?>