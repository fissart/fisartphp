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

$r=6;

$estudian = mysqli_query($link, "SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.idusuario  AND misclases.clave ='" . $_SESSION['clave'] . "' ORDER BY nombre ASC");
$estudiant = mysqli_fetch_assoc($estudian);
$nm = mysqli_num_rows($estudian);

$nsesion = mysqli_query($link, "SELECT * FROM secciones WHERE clave ='" . $_SESSION['clave'] . "'");
$nsesionw = mysqli_fetch_assoc($nsesion);
$ns = mysqli_num_rows($nsesion);

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

date_default_timezone_set("America/Lima");
function get_format($df)
{
    $str = '';
    $str .= ($df->invert == 1) ? '  ' : '';
    if ($df->y > 0) {
        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
    }
    if ($df->m > 0) {
        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
    }
    if ($df->d > 0) {
        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Dia ';
    }
    if ($df->h > 0) {
        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
    }
    if ($df->i > 0) {
        $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
    }
    if ($df->s > 0) {
        $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
    }
    echo $str;
}

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Calificaciones de <?php echo $wew['nombre'] ?></title>

<?php include('margin.php'); ?>

<style>
.wrappw {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 25%;
    position: relative;
    object-fit: cover;
}
</style>
<div class="container mt-2 p-1">
    <div class="progress small my-1" style="height:20px">
        <div class="progress-bar bg-danger" style="width:100%;height:20px">
            Promedio final=0.2AP+0.2TE+0.3EP+0.3EF
        </div>
    </div>

    <div class="progress small my-1" style="height:20px">
        <div class="progress-bar bg-secondary" style="width:100%;height:20px">
            Asistencia y/o participación-vigesimal promedio
        </div>
    </div>

    <div class="progress small my-1" style="height:20px">
        <div class="progress-bar bg-warning" style="width:100%;height:20px">
            Tareas encargadas promedio
        </div>
    </div>

    <div class="progress small my-1" style="height:20px">
        <div class="progress-bar bg-info" style="width:100%;height:20px">
            Examen parcial promedio
        </div>
    </div>

    <div class="progress small mt-1" style="height:20px">
        <div class="progress-bar bg-primary" style="width:100%;height:20px">
            Examen final
        </div>
    </div>

</div>

<div class="container p-1 my-1">
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
        

            $caw = mysqli_query($link, "SELECT * FROM tareas WHERE clave='" . $_SESSION['clave'] . "' AND usuario='" . $estudiant['idusuario'] . "' AND idcapitulo='idc' AND idseccion='ids'");
            $acaw = mysqli_fetch_assoc($caw);
            $ncaw = mysqli_num_rows($caw);
            $w7=$acaw['evaluacion'];
        if ($w['tipo'] == "docente") {
            ?>
    <a class='d-md-block text-dark' style='text-decoration:none'
        href='calificaciones.php?estudiante=<?php echo$estudiant["usuario"]."&cc=".$estudiant["usuario"]?>'>
        <div class="container border border-info rounded-lg  mb-1 p-1">
            <?php echo $i;?> <img class="card-img-top -circle m-auto wrappw update border"
                src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $estudiant["foto"];?>'
                onerror=this.src='foto.png'>
            <?php echo $estudiant['nombre']."--".$estudiant['idusuario']?>
            <div class="float-right ml-auto">
                <?php echo "#tareas ".$ntareasest." Nota examenes: ".round($ggg/($npreg+1),3)." Nota tareas: ".round($sumt/($ntareas+1),3)." Promedio: ".round(($ggg/($npreg+1)+$sumt/($ntareas+1))/2,3) ?>
            </div>

            <div class="progress small my-1" style="height:20px">
                <div class="progress-bar bg-danger text-left p-1" style="width:<?php echo ((0.2)*round($rsumww/($nforo*5)*20/100,3)+(0.2)*round($sumt/($ntareas+1),3)
                    +(0.3)*round(($ggg-$wggg)/($npreg),3)+(0.3)*($w7))*100/20?>%;height:20px">
                    PF=0.2AP+0.2TE+0.3EP+0.3EF=<?php echo (0.2)*round($rsumww/($nforo*5)*20/100,3)+
                    (0.2)*round($sumt/($ntareas),3)
                    +(0.3)*round(($ggg-$wggg)/($npreg-1),3)+
                    (0.3)*($w7)?>
                </div>
            </div>

            <div class="progress small my-1" style="height:20px">
                <div class="progress-bar bg-info  text-left p-1"
                    style="width:<?php echo ($ggg-$wggg)/($npreg)*100/20;?>%;height:20px">
                    <?php echo "Exa Parc=".round(($ggg-$wggg)/($npreg-1),3);?>
                </div>
            </div>

            <div class="progress small mt-1" style="height:20px">
                <div class="progress-bar bg-primary  text-left p-1" style="width:<?php echo $w7*100/20;?>%;height:20px">
                    <?php echo "Exa Fin=".$w7;?>
                </div>
            </div>

            <div class="progress small my-1" style="height:20px">
                <div class="progress-bar bg-warning  text-left p-1"
                    style="width:<?php echo round($sumt/($ntareas),3)*100/20;?>%;height:20px">
                    <?php echo ($sumt-$w7)."Tar encarg=".round(($sumt-$w7)/(6),3);?>
                </div>
            </div>
            <div class="progress small my-1" style="height:20px">
                <div class="progress-bar bg-secondary  text-left p-1"
                    style="width:<?php echo round($rsumww/($nforo*5),3);?>%;height:20px">
                    <?php echo "Asist-Part promedio=".round($rsumww/($nforo*5),3).". En vigesimal Asist-Part:".round($rsumww/($nforo*5)*20/100,3);?>
                </div>
            </div>




        </div>
    </a>

    <?php }else{}
    $i++;
}while ($estudiant = mysqli_fetch_assoc($estudian));
}else {echo "No hay inscritos";}
?>
</div>