<?php
require('conect.php');

var_dump($_POST);

$name = $_POST['event-name'];
$loc = $_POST['event-location'];
$id = $_POST['event-index'];
echo $id;
$color = $_POST['event-color'];
$start = $_POST['event-start-date'];
$end = $_POST['event-end-date'];
	
if (isset($_POST['event-name'])){
$sql=mysqli_query($link,"DELETE FROM events WHERE id = $id");
if(!$sql){
echo "no ok";
}else{
  echo "ok";
}
}
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
