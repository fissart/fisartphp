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

$r=2;

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

$docent = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM clase, usuario WHERE clase.usuario=usuario.idusuario  AND clase.clave ='" . $_SESSION['clave'] . "'"));

$estudian = mysqli_query($link, "SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.idusuario  AND misclases.clave ='" . $_SESSION['clave'] . "' ORDER BY nombre ASC");
$estudiant = mysqli_fetch_assoc($estudian); 
$nm = mysqli_num_rows($estudian);
?>

<?php include('margin.php'); ?>


<?php
 if(isset($_REQUEST['www'])){
     mysqli_query($link,"DELETE FROM misclases WHERE idmiclase=".$_REQUEST['www']);
 }


$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>



<style>
.wrapperestf {
    width: 100px;
    height: 100px;
    overflow: hidden;
    border-radius: 50%;
    position: relative;
    object-fit: cover;
}
</style>



<title>Integrantes de <?php echo $wew['nombre'] ?></title>
<div class="container p-1 my-1 border border-info mb-3">

    <div class="card  border border-info p-2">
        <div class="row d-flex justify-content-center align-items-center">

            <div class='card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3  border border-info'>
                <div class='card-header p-1'>

                    <?php echo "Docente" ?>
                </div>

                <img class="card-img-top -circle m-auto wrapperestf update"
                    src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $docent["foto"];?>'
                    onerror=this.src='imagenes/foto.png'>

                <div class='card-footer p-1' style='height:3.5em'>
                    <?php echo $docent['nombre'] ?>
                </div>

                <?php 
        if ($docent['confirmar'] == 'confirmado') {
            ?>
                <a style='text-decoration:none;color:white' href='email.php?enviara=' <?php echo $docent['email'] ?>'>
                    <?php echo $estudiant['email'] ?>
                </a>
                <?php 
    } else {
    }
    ?>
            </div>

            <?php
        if ($nm > 0) {
            $i=1;
            do {
                $rw = mysqli_query($link, "SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM preguntas, respuestas
                WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta='correcta' AND usuario='" . $estudiant['idusuario'] . "' AND idcpt='cpt')");
        
                $row = mysqli_fetch_assoc($rw);
                $sum = $row['sum'];
        
                $rww = mysqli_query($link, "SELECT SUM(escritanota) AS sumw FROM respuestas WHERE idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "' AND idcpt='cpt'");
                $roww = mysqli_fetch_assoc($rww);
        
                $sumw = $roww['sumw'];
                $wggg = $sumw + $sum;
        
        /////////////////////////////////////////////////////////////////////////// EF
        
        
                $npreg = mysqli_num_rows(mysqli_query($link, "SELECT * FROM capitulo WHERE clave ='".$_SESSION['clave']."'"));
                //preguntas escritas 
                $nprege = mysqli_num_rows(mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND tipo='escrita'"));
                
                $rw = mysqli_query($link, "SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
                WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta='correcta' AND usuario='" . $estudiant['idusuario'] . "')");
                $row = mysqli_fetch_assoc($rw);
                $sum = $row['sum'];
                
                $rww = mysqli_query($link, "SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "'");
                $roww = mysqli_fetch_assoc($rww);
                
                $sumw = $roww['sumw'];
                $ggg = $sumw + $sum;
                //        echo $sum." -- ".$sumw." -- ".round($ggg/($npreg+1),3)." -- ".$npreg." -- ".$nprege;
                
                $ntareas = mysqli_num_rows(mysqli_query($link, "SELECT * FROM secciones WHERE clave ='".$_SESSION['clave']."'"));
                $ntareasest = mysqli_num_rows(mysqli_query($link, "SELECT * FROM tareas WHERE usuario='".$estudiant['idusuario']."'"));
        
                $not = mysqli_query($link, "SELECT SUM(evaluacion) AS sumt FROM tareas WHERE usuario ='" . $estudiant['idusuario'] . "' AND clave ='".$_SESSION['clave']."'");
                $notw = mysqli_fetch_assoc($not);
                $sumt=$notw['sumt'];
                //        echo "---".round($sumt/($nnot+1),3)."---".$nnot; Participaciones
                    $rwwccc = mysqli_query($link, "SELECT SUM(ponderado) AS comm FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['idusuario']."'");
                    $rwwcc = mysqli_fetch_assoc($rwwccc);
                    $rsumww = $rwwcc['comm'];
        
                    $foro = mysqli_query($link, "SELECT * FROM temas WHERE clave='".$_SESSION['clave']."'");
                    $fooro = mysqli_fetch_assoc($foro);
                    $nforo = mysqli_num_rows($foro);
               
                ?>
            <div class='card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3  border border-info'>

                <div class='card-header p-1'>
                    <?php echo "Estudiante - ".$i?>
                </div>

                <img class="card-img-top -circle m-auto wrapperestf update"
                    src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $estudiant["foto"];?>'
                    onerror=this.src='imagenes/foto.png'>


                <div class='card-footer p-1'>
                    <div class='card-footer p-1' style='height:3.5em'>

                        <?php echo $estudiant['nombre'] ?>
                    </div>
                    <?php if($w['tipo']=='docente') {?>

                    <a onClick="return confirm('Are you sure you want to delete?')"
                        href='participantes.php?www=<?php echo $estudiant['idmiclase'] ?>' type='button'
                        class='btn btn-danger'>Eliminar del curso</a>
                    <?php }?> <div class="progress small my-1" style="height:5px">
                        <div class="progress-bar bg-success"
                            style="width:<?php echo ((0.2)*round($rsumww/($nforo*5)*20/100,3)+(0.2)*round($sumt/($ntareas+1),3)+(0.3)*round(($ggg-$wggg)/($npreg),3)+(0.3)*($wggg))*100/20;?>%;height:5px">
                            <?php //echo (0.2)*round($rsumww/($nforo*5)*20/100,3)+(0.2)*round($sumt/($ntareas+1),3)+(0.3)*round(($ggg-$wggg)/($npreg),3)+(0.3)*($wggg)?>
                        </div>
                    </div>

                    <div class="progress small my-1" style="height:5px">
                        <div class="progress-bar bg-secondary"
                            style="width:<?php echo round($rsumww/($nforo*5),3);?>%;height:5px">
                            <?php //echo round($rsumww/($nforo*5),3)."-".round($rsumww/($nforo*5)*20/100,3);?>
                        </div>
                    </div>

                    <div class="progress small my-1" style="height:5px">
                        <div class="progress-bar bg-warning"
                            style="width:<?php echo round($sumt/($ntareas+1),3)*100/20;?>%;height:5px">
                            <?php //echo round($sumt/($ntareas+1),3);?>
                        </div>
                    </div>

                    <div class="progress small my-1" style="height:5px">
                        <div class="progress-bar bg-info"
                            style="width:<?php echo ($ggg-$wggg)/($npreg)*100/20;?>%;height:5px">
                            <?php //echo round(($ggg-$wggg)/($npreg),3);?>
                        </div>
                    </div>

                    <div class="progress small mt-1" style="height:5px">
                        <div class="progress-bar bg-primary" style="width:<?php echo $wggg*100/20;?>%;height:5px">
                            <?php //echo $wggg;?>
                        </div>
                    </div>

                </div>

                <?php 
                if ($estudiant['confirmar'] == 'confirmado') {
                ?>

                <a class="" href='email.php?enviara=' <?php echo $estudiant['email'] ?>'>
                    <?php echo $estudiant['email'] ?>
                </a>
                <?php 
            } else {
            }
            ?>
            </div>
            <?php 
            $i++;
            }while($estudiant = mysqli_fetch_assoc($estudian));
        } else {
            ?>
            <div class='card text-center m-3 p-0 col-md-6 col-lg-3 col-xl-3'>No hay inscritos</div>
            <?php 
        }
        ?>
        </div>

    </div>

    <div class="progress my-1" style="height:30px">
        <div class="progress-bar bg-success" style="width:100%;height:30px">
            Promedio final=0.2AP+0.2TE+0.3EP+0.3EF
        </div>
    </div>

    <div class="progress my-1" style="height:30px">
        <div class="progress-bar bg-secondary" style="width:100%;height:30px">
            Asistencia y/o participación-vigesimal promedio
        </div>
    </div>

    <div class="progress my-1" style="height:30px">
        <div class="progress-bar bg-warning" style="width:100%;height:30px">
            Tareas encargadas promedio
        </div>
    </div>

    <div class="progress my-1" style="height:30px">
        <div class="progress-bar bg-info" style="width:100%;height:30px">
            Examen parcial promedio
        </div>
    </div>

    <div class="progress mt-1" style="height:30px">
        <div class="progress-bar bg-primary" style="width:100%;height:30px">
            Examen final
        </div>
    </div>

</div>