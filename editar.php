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

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$g = mysqli_fetch_assoc($user);


require  'autoload.php';
require  'cloudinary/Helpers.php'; // opcional para usar los métodos auxiliares cl_image_tag y cl_video_tag
require  'config_cloud.php';



if (isset($_REQUEST['actualizar']) && !empty($_REQUEST['actualizar'])) {
    $p = $_REQUEST['pass'];
    $n = $_REQUEST['nombre'];
    $t = $_REQUEST['tipo']; 
    $id = $_REQUEST['id'];
    $c = $_REQUEST['correo'];
    
    $img = $_FILES['foto']['name'];
    $imgt = $_FILES['foto']['type'];
    $imgs = $_FILES['foto']['size'];
    $acceptable = array(
        //        'application/pdf',
        'image/jpeg',
        'image/jpg',
        //        'image/gif',
        'image/png'
    );
    $f = "";
    if($img == ""){
        $f = $_REQUEST['fotow'];
        mysqli_query($link, "UPDATE usuario SET passw= '$p', nombre = '$n', foto = '$f', email='$c' WHERE idusuario='".$_SESSION['user']."'");
        header("Location:inicio.php");
    }else{
        if (in_array($imgt, $acceptable) && $imgs < 300000) {
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $randon = "";
            for ($i = 0; $i < 11; $i++) {
                $randon .= substr($str, rand(0, 62), 1);
            }
            //        unlink('archivos/' . $g['usuario'] . $g['foto']);
            //echo '<script>alert("'.$_REQUEST['fotow'].'");</script>';
            if ($_REQUEST['fotow'] !== "") {
                \Cloudinary\Uploader::destroy($_REQUEST['fotow']);
            }
            $f = $id."_".$randon;
            \Cloudinary\Uploader::upload($_FILES['foto']['tmp_name'],array("public_id" => $f));
            //        move_uploaded_file($_FILES['foto']['tmp_name'], "archivos/" . $g['idusuario'] . $f);
            mysqli_query($link, "UPDATE usuario SET passw= '$p', nombre = '$n', foto = '$f', email='$c' WHERE idusuario='".$_SESSION['user']."'");
            header("Location:inicio.php");
            mysqli_query($link, "UPDATE usuario SET passw= '$p', nombre = '$n', foto = '$f', email='$c' WHERE idusuario='".$_SESSION['user']."'");
            header("Location:inicio.php");
        }else{
            echo '<script>alert("Su imagen supera el tamaño permitido (0.3MB) o su archivo no es una imágen");</script>';
        }
    } 
}


?>



<style>
.custom-file-input~.custom-file-label::after {
    content: "Elegir foto";
}
</style>



<?php include('first.php'); ?>


<div class="container-flex m-5 text-center">
    <form action="editar.php" method="post" enctype="multipart/form-data">
        <h3 class='bg-light text-center p-1'>
            Hola <?php echo $g['nombre']; ?> cambie sus datos actuales</h3>

        <div class="input-group my-1" style="display:none">
            <input class="form-control" type="password" name="pass" value="<?php echo $g['passw']; ?>" required>
            <div class="input-group-prepend text-center">
                <div class="input-group-text" id="btnGroupAddon">Contraseña</div>
            </div>
        </div>

        <div class="input-group">
            <input class="form-control" type="hidden" name="id" value="<?php echo $g['idusuario']; ?>" required>
            <input class="form-control" type="text" name="correo" value="<?php echo $g['email']; ?>" required>
            <div class="input-group-prepend">
                <div class="input-group-text" id="btnGroupAddon">Correo. No lo cambie si no esta seguro</div>
            </div>
        </div>

        <div class="input-group my-1">
            <input class="form-control" type="text" name="nombre" value="<?php echo $g['nombre']; ?>" required>
            <div class="input-group-prepend">
                <div class="input-group-text" id="btnGroupAddon">Apellidos y nombres</div>
            </div>
        </div>

        <div class="custom-file text-left">
            <input type="file" class="custom-file-input" id="customFile" name="foto">
            <label class="custom-file-label" for="customFile">Cambiar foto actual:
                <?php echo $g['foto']; ?></label>
        </div>
        <input class="form-control" type="hidden" name="tipo" value="<?php echo $g['tipo']; ?>">
        <input class="form-control" type="hidden" name="fotow" value="<?php echo $g['foto']; ?>"><br>


        <input class="btn btn-info mt-1" type="submit" value="Actualizar" name="actualizar"><br>
    </form>
</div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>