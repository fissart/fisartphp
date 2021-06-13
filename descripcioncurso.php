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

if(isset($_REQUEST['confirmar'])){
$chekar=mysqli_num_rows(mysqli_query($link,"SELECT * FROM usuario WHERE email='".$_REQUEST['confirmar']."'"));
if($chekar>0){
mysqli_query($link, "UPDATE  usuario SET confirmar='confirmado' WHERE usuario='".$_REQUEST['confirmar']."'");
}
}

if(isset($_REQUEST['email'])){
$to=$_REQUEST['email'];
mysqli_query($link, "UPDATE  usuario SET email='".$_REQUEST['email']."', confirmar='enviado' WHERE usuario='".$_SESSION['user']."'");
$titulo='Confirmar correo eltronico';

$header='scrion@gmail.com';
$mensaje='Confirme su correo haciendo click sobre el enlace siguiente\n

https://skrion.net/net/eduk/email.php?confirmar='.$_REQUEST['email'];

mail($to, $titulo, $mensaje, $header);
}



if(isset($_REQUEST['to'])){
$to=$_REQUEST['to'];
$titulo=$_REQUEST['titulo'];
$header='from '.$_REQUEST['de'];
$mensaje= $_REQUEST['mensaje']."\n\n
Plataforma e learning U\n https://ww.com/eduk/";

mail($to, $titulo, $mensaje, $header);
echo "<script> alert('Mensaje enviado')</script>";
}
?>



<title>Miembros</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>
<article>


<?php
if($ww['user']!='confirmado' && !isset($_REQUEST['enviara'])){
if(isset($_REQUEST['confirmar'])){
    echo "Correo electronico confirmado: '".$_REQUEST['confirmar']."' confirmado";
}else{
?>

<form action="email.php" method="post">
<input type="email" name="email" placeholder="Introduce tu email" required>
<input type="submit" value="Registrar">
</form>

<?php
}
}else{
echo "ww";

?>
<h1>Enviar mensaje</h1>
<form action="email.php" method="post"></form>
<input type="text" name="titulo" placeholder="Introduce asunto" required>
<textarea name="mensaje" id="" cols="30" rows="10" required></textarea>
<input type="hidden" name="to" value="<?php echo $_REQUEST['enviara'];  ?>">
<input type="hidden" name="de" value="<?php echo $_ww['email'];  ?>">
<input type="submit" value="Enviar">
<?php
}
?>
</article>

<?php include "footer.php"; ?>