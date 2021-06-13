<?php
require('conect.php');

//var_dump($_POST);

$name = $_POST['event-name'];
$loc = $_POST['event-location'];
	$color = $_POST['event-color'];
	$start = $_POST['event-start-date'];
	$end = $_POST['event-end-date'];
$user=$_POST['event-user'];
$curso=$_POST['event-curso'];
	if (isset($_POST['event-name'])){
	$sql=mysqli_query($link,"INSERT INTO events VALUES (NULL, '$name', '$loc', '$color', '$start', '$end', '$curso', '$user')");
	if(!$sql){
  echo "no ok";
}else{
  echo "ok";
}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
