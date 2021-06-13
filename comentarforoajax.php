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

date_default_timezone_set("America/Lima");


if (isset($_POST['id'])) {
  $cc = $_POST['id'];
  $consulta = mysqli_query($link, "DELETE FROM comentarios WHERE idcom='$cc'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok seccion refresh";
  }
}



if (isset($_REQUEST['clavew'])) {
  $u = $_SESSION['user'];
  $c = $_SESSION['clave'];
  $id = $_SESSION['tema'];
  $cc = $_POST['x1'];
  //$cc = mysqli_real_escape_string($link, $cc);

  $datei = new DateTime("now");
  $d1 = date_format($datei, 'Y-m-d H:i:s');
  //echo $d1;
  $consulta = mysqli_query($link, "INSERT INTO comentarios VALUES(NULL, '$id', '$c','$u','$cc', '$d1', NULL)");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok";
  }
}
//refresh number
if (isset($_REQUEST['idc'])) {
  $id = $_POST['idc'];
  $ponderado = $_POST['ponderado'];
//  $cc = mysqli_real_escape_string($link, $cc);
  $consulta = mysqli_query($link, "UPDATE comentarios SET ponderado='$ponderado' WHERE idcom=$id");
  if (!$consulta) {
    echo "ok";
  } else {
    echo "no ok";
  }
}


$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$qcomen = mysqli_query($link, "SELECT * FROM comentarios, usuario WHERE comentarios.usuario=usuario.idusuario AND idtema='" . $_SESSION['tema'] . "' ORDER BY fecha DESC");
$ncomen = mysqli_num_rows($qcomen);
$arraycomen = mysqli_fetch_assoc($qcomen);

$qqccc = mysqli_query($link, "SELECT * FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idtema='".$_SESSION['tema']."'");
$nqcc = mysqli_num_rows($qqccc);

$wwccc = mysqli_query($link, "SELECT SUM(ponderado) AS comm FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idtema='".$_SESSION['tema']."'");
$wwcc = mysqli_fetch_assoc($wwccc);
$sumww = $wwcc['comm'];

$results_per_page = 20;

$number_of_pages = ceil($ncomen/$results_per_page);


$this_page_first_result = ($_SESSION['page']-1)*$results_per_page;


$qcomen = mysqli_query($link, "SELECT * FROM comentarios, usuario WHERE comentarios.usuario=usuario.idusuario AND idtema='".$_SESSION['tema']."' ORDER BY fecha DESC LIMIT ".$this_page_first_result.", ".$results_per_page."");
$arraycomen = mysqli_fetch_assoc($qcomen);
?>





<style>
.wrap {
    width: 35px;
    height: 35px;
    overflow: hidden;
    border-radius: 50%;
    position: relative;
    object-fit: cover;
}
</style>
<div class="container p-1">
    <button class="btn bg-info border mb-1 mt-0" id="comm" data-www='<?php echo $nqcc;?>'>Comentar</button>
</div>

<div class="container p-1 my-1">

    <div class="container p-1 my-1">
    </div>
    <?php if ($w['tipo'] == 'estudiante') {?>
    <div class="text-center text-danger">
        Ud debe realizar 3 comentarios (C1, C2, C3) por separado y distintos necesariamente, el ponderado por tema es
        (C1+C2+C3)/3. Cada Comentario se califica en base vigesimal es decir de 0 a 20. Comentarios repetidos se
        calificarán con notas bajas. Solo puede visualizar su
        comentarios.
    </div>
    <div class="card text-info p-1">
        Ud tiene <?php echo $nqcc?> comentarios de 3.
        <?php if($sumww==''){echo 'Aún no calificada';}else{echo "La suma de sus ponderados es: ".$sumww;}?>
    </div>
    <?php }?>
    <?php





    if ($ncomen > 0) {



  

      
    $i = 1;
    do {?>
    <div
        class='card border-danger <?php if($arraycomen['usuario']==$_SESSION['user']){echo "bg-info";}elseif($arraycomen['tipo'] == 'docente'){echo "bg-warning";} ?> p-1 my-3'>
        <div class="container p-0 ">
            <img class='wrap border d-none'
                src="http://res.cloudinary.com/ciencias/image/upload/<?php echo $arraycomen["foto"];?>"
                onerror=this.src="foto.png">
            <div class="btn p-0 text-left">
                <?php echo $arraycomen['nombre']; if($arraycomen['tipo'] == 'estudiante'){echo " </br> (" . $arraycomen['fecha']. ") ";}?>
                <?php if($arraycomen['usuario']==$_SESSION['user']){if($arraycomen['ponderado']==''){echo "Aún no calificado";}else{echo " Calificación: ".$arraycomen['ponderado'];}
                }
                ?>



                <?php if ($w['tipo'] == 'docente' || $arraycomen['usuario']==$_SESSION['user']) {?>
                <a class='btn btn-light border' id='delete' data-id='<?php echo $arraycomen["idcom"] ?>'> Eliminar
                    comentario <?php  echo $arraycomen['tipo'];?>
                </a>
                <?php }?>

                <?php if ($w['tipo'] == 'docente' && $arraycomen['tipo'] !== 'docente') {?>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Calificación: <span
                                class='text-danger  bg-warning'><?php echo $arraycomen['ponderado']?></span>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="puntuacion"
                        data-idc="<?php echo $arraycomen['idcom'] ?>" placeholder=" Nota"
                        <?php echo "value=".$arraycomen['ponderado']?>>
                </div>

                <?php }?>





            </div>
        </div>
        <?php if ($arraycomen['usuario']==$_SESSION['user']) {?>

        <script>
        $(document).ready(function() {
            $('#<?php echo $arraycomen['idcom'] ?>').richText();
        });
        </script>

        <div class='bg-light  p-1 mt-1' id=''>
            <?php echo $arraycomen['comentario'] ?>
        </div>

        <?php } ?>

        <?php if ($w['tipo']=='docente') {?>

        <div class='bg-light  p-1 mt-1' id=''>
            <?php //echo $arraycomen['comentario'] ?>
        </div>

        <?php } ?>

        <?php $i++;?>
        <?php if ($arraycomen['tipo'] == 'estudiante') {?>
        <style>
        .progress {
            background-image: linear-gradient(to right, rgb(255, 85, 51), #00F);
        }

        .progress-bar {
            box-shadow: 0px 0px 0px 2000px white;
            /* white or whatever color you like */
            background-image: none !important;
            background-color: transparent !important;
        }
        </style>
        <div class="progress small mt-1" style="height:3px">
            <div class="progress-bar" style="width:<?php echo $arraycomen['ponderado']?>%;height:15px">
                <?php //echo "Asist-Part promedio=".round($rsumww/($nforo*5),3).". En vigesimal Asist-Part:".round($rsumww/($nforo*5)*20/100,3);?>
            </div>
        </div>
        <?php }?>
    </div>
    <?php  
    }while($arraycomen=mysqli_fetch_assoc($qcomen)); } else {?>
    No hay comentarios aún para este tema.
    <?php }
    ?>



    <?php for ($page=1;$page<=$number_of_pages;$page++) {?>
    <a class="btn btn-info m-1"
        href='comentarforo.php?idtema=<?php echo $_SESSION['tema']."&numero=".$_SESSION['numero']."&page=".$page;?>'>
        <?php echo $page;?>
    </a>
    <?php } ?>




</div>
</div>