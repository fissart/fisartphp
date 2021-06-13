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

if (isset($_POST['id'])) { 
  $cc = $_POST['id'];
  $consulta = mysqli_query($link, "DELETE FROM chat WHERE id='$cc'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok seccion refresh";
  }
}

//echo $_SESSION['tema'];

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

if (isset($_REQUEST['clavew'])) {
  $nom = $w['nombre'];
  $men = $_POST['x1'];
  $men = mysqli_real_escape_string($link, $men);

  $uu = $_POST['user'];
  $cc = $_POST['clavew'];

  $consulta = mysqli_query($link, "INSERT INTO chat VALUES(NULL, '$nom', '$men', NULL, '$cc', '$uu')");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
    //  echo "ok seccion refresh";
  }
}



$qcomen = mysqli_query($link, "SELECT * FROM chat, usuario WHERE chat.idusuario=usuario.idusuario AND clave='" . $_SESSION['clave'] . "' ORDER BY fecha DESC");
$ncomen = mysqli_num_rows($qcomen);
$arraycomen = mysqli_fetch_assoc($qcomen);

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Chat de <?php echo $wew['nombre'] ?></title>


<script type="text/x-mathjax-config">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>



<title>Tema actual</title>



<style>
.wrap {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 50%;
    position: relative;
    object-fit: cover;
}

.wrap img {
    height: 50px;
    position: absolute;
    top: 50%;
    object-fit: cover;
    left: 50%;
    transform: translate(-50%, -50%)
}
</style>


<script>
$("[data-toggle=popover]")
    .popover({
        html: true
    })
</script>




<div class="container p-0 my-5">
    <?php


if ($ncomen > 0) {
  $i = 1;
  do {?>
    <?php if($arraycomen['idusuario']==$_SESSION['user']){?>
    <div class='container border p-1 text-right my-1'>
        <div class='btn text-left p-0'>
            <?php echo $arraycomen['nombre'] ."<br>" . $arraycomen['fecha']?>
            <a class='btn btn-light' id='delete' data-id='<?php echo $arraycomen[' id'] ?>'> Eliminar mensaje</a>
        </div>
        <div class='wrap btn'><img src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $arraycomen["foto"];?>' onerror=this.src='foto.png'></div>
        <div class='bg-light mt-1 p-1'>
            <?php echo $arraycomen['mensaje'] ?>
        </div>
    </div>
    <?php }else{?>
    <div class='container border my-1 p-1 text-left'>
        <div class='wrap btn'><img src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $arraycomen["foto"];?>' onerror=this.src='foto.png'></div>
        <div class='btn bg-white p-0'>
            <?php echo $arraycomen['nombre'] ."<br>" . $arraycomen['fecha']?>
        </div>
        <div class='bg-light mt-1 p-1'>
            <?php echo $arraycomen['mensaje'] ?>
        </div>
    </div>
    <?php }?>
    <?php 
    $i++;
    //echo $i;
    
  } while ($arraycomen = mysqli_fetch_assoc($qcomen));
}?>
</div>













