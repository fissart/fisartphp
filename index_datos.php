<?php
require('conect.php');

//insert items
if(isset($_REQUEST['textitems'])){
$texto=$_POST['textitems'];
$texto = mysqli_real_escape_string($link, $texto); 
$consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, NULL , 'acercaitems', NULL, NULL)");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}

//insert beneficios
if(isset($_REQUEST['text'])){
$texto=$_POST['text'];
$texto = mysqli_real_escape_string($link, $texto); 
$consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, NULL, 'beneficios', NULL, NULL)");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}


//insert videodescripcion
if(isset($_REQUEST['textvideo'])){
$texto=$_POST['textvideo'];
$texto = mysqli_real_escape_string($link, $texto); 
$consulta=mysqli_query($link,"INSERT INTO land VALUES(NULL, 'wzw', '$texto', NULL, 'Link de video aqui' , 'video', NULL, NULL)");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}


//refresh ITEMS
if(isset($_REQUEST['texto'])){
  $id=$_POST['id'];
  $texto=$_POST['texto'];
  $texto = mysqli_real_escape_string($link, $texto); 
  $columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE land SET $columna='$texto' WHERE idland =$id");
 mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}
//refresh FOOTER
if(isset($_REQUEST['textff'])){
$id=$_POST['id'];
$texto=$_POST['textff'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE foot SET $columna='$texto' WHERE idfoot ='$id'");
// mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
if(!$consulta){
  echo "no ok ww";
}else{
  echo "ok";
}
}

//upload logo
if(isset($_FILES["filesww"])){
$na=$_FILES['filesww']['name'];
$id=$_POST['id'];
$tipo=$_FILES['filesww']['type'];
$t=$_FILES['filesww']['size'];
$wr=mysqli_query($link,"SELECT * FROM land WHERE idland='$id' AND tipo='foto' OR tipo='logo'");
$wrw=mysqli_fetch_assoc($wr);

unlink('archivoslandscape/'.$id.$wrw['foto']);


$consulta=mysqli_query($link,"UPDATE land SET foto='$na' WHERE idland =$id");

//$idarchivo=mysqli_insert_id($link);
copy($_FILES['filesww']['tmp_name'],"archivoslandscape/".$id.$na);
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}

//upload fotos
if(isset($_FILES["filesw"])){
//  $clave=$_POST['claves'];
//$user=$_POST['user'];
//echo $user;
$na=$_FILES['filesw']['name'];
//echo $na;
$tipo=$_FILES['filesw']['type'];
$t=$_FILES['filesw']['size'];
$consulta=mysqli_query($link,"INSERT INTO land VALUES (NULL, 'Nombre', 'Texto', '$na', NULL , 'foto', NULL, NULL)");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['filesw']['tmp_name'],"archivoslandscape/".$idarchivo.$na);
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}

}

//delete ids
if(isset($_REQUEST['idele'])){
  $id=$_POST['idele'];
  echo "zzz";
$wr=mysqli_query($link,"SELECT * FROM land WHERE idland='$id' AND tipo='foto' OR tipo='logo'");
//$wr=mysqli_num_rows($wr);
$wrw=mysqli_fetch_assoc($wr);

$consulta=mysqli_query($link, "DELETE FROM land WHERE idland=$id");
unlink('archivoslandscape/'.$id.$wrw['foto']);
//$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
//$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete";
}

}