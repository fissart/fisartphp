<?php
require('conect.php');

//var_dump($_POST);

$name = $_POST['event-name'];
$loc = $_POST['event-location'];
$id = $_POST['event-index'];
echo $id;
$color = $_POST['event-color'];
	$start = $_POST['event-start-date'];
	$end = $_POST['event-end-date'];
	
	if (isset($_POST['event-name'])){
		$sql=mysqli_query($link,"UPDATE events SET title='$name' , start = '$start', end = '$end', color='$color', lugar ='$loc' WHERE id = '$id'");


	if(!$sql){
  echo "no ok";
}else{
  echo "ok";
}
}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
