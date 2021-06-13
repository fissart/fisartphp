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



if(isset($_REQUEST['user'])){
    $user=$_POST['user'];
    $clave=$_POST['clave'];
    $categoria=$_POST['categoria'];
    $curso=$_POST['curso'];
    $id=$_POST['id'];

mysqli_query($link,"INSERT INTO misclases VALUES(NULL,'$user','$clave','$categoria','$curso','$id')");
}


?>
