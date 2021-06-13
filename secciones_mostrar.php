<?php

require('conect.php');
session_start();

if(!isset($_SESSION['user'])){
  header("Location:index.php");
        }

if(isset($_REQUEST['cerrar'])){
  session_destroy();
   header("Location:index.php");
}


//   echo $_SESSION['idcpt']."--";
//   echo $_SESSION['idsec'];
?>

<title>Inicio</title>

<?php

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

?>


<?php

//refresh seccion
if(isset($_REQUEST['texto'])){
  $id=$_POST['id'];
$texto=$_POST['texto'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE secciones SET $columna='$texto' WHERE idseccion =$id");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccionww refresh";
}
}


        
        ?>