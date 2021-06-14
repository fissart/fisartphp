<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>


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

$estudian = mysqli_query($link, "SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.idusuario  AND misclases.clave ='" . $_SESSION['clave'] . "'");
$estudiant = mysqli_fetch_assoc($estudian);
$nm = mysqli_num_rows($estudian);

$nsesion = mysqli_query($link, "SELECT * FROM secciones WHERE clave ='" . $_SESSION['clave'] . "'");
$nsesionw = mysqli_fetch_assoc($nsesion);
$ns = mysqli_num_rows($nsesion);

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['estudiante'] . "'");
$w = mysqli_fetch_assoc($user);
$userw = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'");
$ww = mysqli_fetch_assoc($userw);

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

if (isset($_REQUEST['notas'])) {
    $id = $_REQUEST['id'];
    $est = $_REQUEST['est'];
    $nota = $_REQUEST['nota'];
    mysqli_query($link, "UPDATE  tareas SET evaluacion='$nota' WHERE idplan='$id' AND usuario='$est'");
}

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);


$estudian = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario ='" . $_SESSION['estudiante'] . "'");
$estudiant = mysqli_fetch_assoc($estudian);


?>

<!--
<textarea class='form-control m-1 rrr' name='texto' id='addtarea'
        required><?php //echo $arraytareas['texto'] ?></textarea>


<script>
$(document).ready(function() {
    $('.rrr').richText();
});
</script>
-->

<style>
.wrappww {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 50%;
    position: relative;
    object-fit: cover;
}
</style>

<style>
table,
th,
td {
    text-align: center;
    padding: 3px;
    border: 1px solid black;
    border-collapse: collapse;
}
</style>


<div class="container p-1 my-1 border bg-info rounded text-light">
    <img class="card-img-top -circle m-auto wrappww update"
        src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $estudiant["foto"];?>'
        onerror=this.src='imagenes/foto.png'>
    <?php echo $estudiant['nombre']?>
</div>









<div class="container p-0 my-0">
    <div class="card my-5 border border-info rounded pt-3 bg-light">
        <?php  
$foro = mysqli_query($link, "SELECT * FROM temas WHERE clave='".$_SESSION['clave']."'");
$fooro = mysqli_fetch_assoc($foro);
$nforo = mysqli_num_rows($foro);

?>
        <h3 class='componentWrapper color border border-info text-center rounded'>PARTICIPACIONES</h3>
        <div class="card-body p-2">
            <div class="row d-flex justify-content-center align-items-center">
                <?php if($nforo>0){
                $u=1;
            do{
                $qqccc = mysqli_query($link, "SELECT * FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['idusuario']."' AND idtema='".$fooro['idtema']."'");
                $nqcc = mysqli_num_rows($qqccc);

                $wwccc = mysqli_query($link, "SELECT SUM(ponderado) AS comm FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['idusuario']."' AND idtema='".$fooro['idtema']."'");
                $wwcc = mysqli_fetch_assoc($wwccc);
                $sumww = $wwcc['comm'];
                
?>

                <div class='card text-center m-3 pt-3 col-md-6 col-lg-3 border border-info rounded' style='display:'>
                    <div class="componentWrapper color border border-info p-1 rounded">
                        <?php echo "Tema ".$u;?>.
                    </div>
                    <?php if($nqcc==''){echo "Ud no tiene comentarios";}else{echo "Ud tiene ".$nqcc." comentarios";}?>.
                    <?php if($sumww==''){if($nqcc==''){echo "";}else{echo "Aun no calificadas";}}else{echo "La suma de sus puntajes es ".$sumww;}?>
                </div>
                <?php
            $u++;
            }while($fooro = mysqli_fetch_assoc($foro));
    }else{echo "No tiene participaciones";}?>

            </div>
        </div>
        <?php 
                $rwwccc = mysqli_query($link, "SELECT SUM(ponderado) AS comm FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['idusuario']."'");
                $rwwcc = mysqli_fetch_assoc($rwwccc);
                $rsumww = $rwwcc['comm'];      
?>

        <div class="componentWrapperbottom color border border-info rounded text-center d-none">
            <?php echo "Suma total ".$rsumww.", ".$nforo. " temas, 5 en cada una. Tu promedio es ".$rsumww."/(".$nforo."*5)=".$rsumww/($nforo*5)?>.
        </div>
    </div>

















    <div class="card border border-info my-5 pt-3 rounded bg-success">
        <h3 class='componentWrapper color border border-info text-center rounded'>EXÁMENES</h3>

        <div class="row d-flex justify-content-center align-items-center p-2">
            <?php 
            $con = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
            $ncap = mysqli_num_rows($con);
            $cap = mysqli_fetch_assoc($con);

            $sumae = 0;
            $i = 1;

            if ($ncap > 0) {
            do {
                ?>

            <div class='card text-center m-3 py-3 col-md-6 col-lg-3 border border-info rounded'>

                <?php
                $escrito = mysqli_query($link, "SELECT * FROM respuestas WHERE clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idalternativa ='0'  AND idcpt='".$cap['idcapitulo']."'");
                $escritow = mysqli_fetch_assoc($escrito);
                $nescr = mysqli_num_rows($escrito);
        
                
                $rw = mysqli_query($link, "SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
                WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta='correcta' AND usuario='" . $estudiant['idusuario'] . "' AND idcpt='" . $cap['idcapitulo'] . "')");
                $row = mysqli_fetch_assoc($rw);
                $sum = $row['sum'];

                $rww = mysqli_query($link, "SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "' AND idcpt='" . $cap['idcapitulo'] . "'");
                $roww = mysqli_fetch_assoc($rww);

                $sumw = $roww['sumw'];

                $ggg = $sumw + $sum;

                $dioexamen = mysqli_query($link, "SELECT * FROM  respuestas WHERE clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt=".$cap['idcapitulo']."");
                $dioexamenn = mysqli_num_rows($dioexamen);
                

  
              //averiguar el numero de preguntas en cada examen capitulo
                $npreg = mysqli_num_rows(mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND idcapitulo='".$cap['idcapitulo']."'"));
                //preguntas escritas 
                $nprege = mysqli_num_rows(mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND idcapitulo='".$cap['idcapitulo']."' AND tipo='escrita'"));
                ?>

                <div class='componentWrapper small color border border-info rounded text-center h6'>
                    Examen parcial <?php echo $i ?> de <?php echo $cap['nombre']." NP: ".$npreg." NE: ".$nprege?>
                </div>

                <div class="card-body p-1">

                    <?php if ($dioexamenn> 0) {?>
                    <div class='text-center container mb-1'>
                        <?php  if($sum==''){echo "0A";}else{echo $sum."A";} echo "+"; if($sumw==''){echo "0E";}else{echo $sumw."E";} echo "=".$ggg;?>
                        en <?php  echo "E".$i;?>
                    </div>

                    <?php 
                    do {
                    if($nescr>0){
                    if ($ww['tipo'] == 'docente') {
                    ?>
                    <?php 
                    $preg = mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND idcapitulo ='".$escritow['idcpt']."' AND tipo ='escrita'  AND idpregunta='".$escritow['clavepregunta']."'" );
                    $pregt = mysqli_fetch_assoc($preg);
                    $pregtt = mysqli_num_rows($preg);
                    ?>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Máx:
                                <?php  echo $pregt['calificativo'] ?>
                            </div>
                        </div>
                        <input type="text" class="form-control" <?php echo "id='fff' data-fffff='"
                            .$escritow["idrespuestas"]."' data-user='".$escritow["usuario"]."'
                            value='".$escritow["escritanota"]."'"?> placeholder=" Nota">
                    </div>

                    <?php } ?>


                    <button type="button" class="btn btn-LIGHT" data-toggle="modal"
                        data-target="#ww<?php  echo $escritow['idrespuestas']?>">
                        Respuesta escrita.
                        <?php  echo "Nota: "; if($escritow['escritanota']==""){echo "Falta calificar";}else{echo $escritow['escritanota'];} ?>
                    </button>

                    <div class="modal fade text-left" id="ww<?php  echo $escritow['idrespuestas']?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Respuesta ID:
                                        <?php  echo $estudiant['idusuario']?>. Punto máximo:
                                        <?php  echo $pregt['calificativo'] ?> </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <textarea class="<?php  echo $escritow['idrespuestas']?> modal-body text-left">
                                    <?php  echo $pregt['pregunta']?>
                                    <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                                    <?php  echo $escritow['respuesta']?>
                                </textarea>

                                <script>
                                $(document).ready(function() {
                                    $('.<?php  echo $escritow['idrespuestas']?>').richText();
                                });
                                </script>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                    }
                    } while ($escritow = mysqli_fetch_assoc($escrito));

                    }else{echo "Aún no dió el examen verifique la fecha indicada";}

                    $sumae += $ggg;
                    $i++;
                    ?>
                </div>

            </div>

            <?php 
            } while($cap = mysqli_fetch_assoc($con));
            ?>

            <div class="container text-center small mb-3 d-none">
                NP: Número de preguntas en el examen. NE: Número de preguntas escritas. EG: Examen general. iA: i puntos
                en las
                preguntas con alternativas. iE: i puntos en las preguntas escritas. Ei: Examen parcial del capítulo i
            </div>

        </div>

        <div class='componentWrapperbottom color border border-info text-center p-1 rounded'> Promedio exámenes
            parciales:
            <?php echo ($sumae) . "/" . ($i-1) . "=" . round(($sumae ) / ($i-1), 3) ?>
        </div>
    </div>

    <?php    
    $cce = round(($sumae) / ($i-2), 3);
    } else {
        echo "No capitulos";
    }



















    //TAREAs CURSO
    
?>

    <div class='card text-center py-4 border border-success rounded my-5 p-2 bg-info'>
        <div class='componentWrapper p-0 color border border-info text-uppercase rounded h3'>
            Tareas
        </div>
        <?php 
            $con = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
            $ncap = mysqli_num_rows($con);
            $cap = mysqli_fetch_assoc($con);

            $sumae = 0;
            $k = 1;

            if ($ncap > 0) {
            do {
                ?>
        <div class='card text-center py-3 border border-light rounded my-3 p-0 '>
            <div class='componentWrapper p-1 color border border-info text-uppercase rounded'>
                <?php echo "Capitulo ".$k;?>
            </div>


            <div class="row d-flex justify-content-center align-items-center p-2">
                <?php 
                $cal = mysqli_query($link, "SELECT * FROM secciones WHERE clavew ='" . $cap['idcapitulo'] . "' ");
                $acal = mysqli_fetch_assoc($cal);
                $ncal = mysqli_num_rows($cal);
                if ($ncal > 0) {
                $i = 1;
                $suma = 0;
                do {?>

                <div class='card text-center py-3 border border-info rounded m-3 p-0 col-md-6 col-lg-3 col-xl-3'>
                    <div class='componentWrapper p-1 color border border-info text-uppercase rounded'>
                        <?php echo "Tarea ".$i;?>
                    </div>
                    <div class="card-body p-2">
                        <button type="button" class="btn btn-outline-secondary m-1" data-toggle="modal"
                            data-target="#wwwww<?php  echo $acal['idseccion']?>">Tarea encargada</button>

                        <div class="modal fade" id="wwwww<?php  echo $acal['idseccion']?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Tarea encargada</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?php  echo $acal['tarea']?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                            $not = mysqli_query($link, "SELECT * FROM tareas WHERE usuario ='" . $_SESSION["estudiante"] . "' AND idseccion ='" . $acal['idseccion'] . "'");
                            $notw = mysqli_fetch_assoc($not);
                            $nnot = mysqli_num_rows($not);    
                                            
                        ?>

                        <button type="button" class="btn btn-outline-info m-1" data-toggle="modal"
                            data-target="#zzz<?php  echo $notw['idtarea']?>">
                            <?php  if (isset($notw['evaluacion'])) {echo"Tarea entregada. Nota: ".$notw['evaluacion'];}elseif($nnot > 0){echo "Tarea entregada, "; if($w['tipo']=='docente'){echo "falta evaluar";}else{echo "falta evaluar";}}else{echo "Tarea no entregada";}?>
                        </button>
                        <!-- <div class="container"><?php  echo $notw['fecha']?></div> -->

                        <div class="modal fade" id="zzz<?php  echo $notw['idtarea']?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header p-2">
                                        <h6 class="modal-title" id="exampleModalLabel">Tarea entregada</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?php $acceptable = array("jpeg","jpg","png","PNG");
                                    if(in_array(substr($notw["archivo"], strrpos($notw["archivo"], '.')+1), $acceptable)){?>
                                        <div class="card">
                                            <img class="img-fluid " src="archivostarea/<?php echo $notw["archivo"] ?>"
                                                alt="www">
                                        </div>
                                        <?php }else{}?>
                                        <?php  echo $notw['texto']?>
                                    </div>
                                    <div class="modal-footer p-2">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 

                        if (isset($notw['evaluacion'] ) || $nnot > 0) {
                        $j = 1;
                        ?>
                        <a class='btn btn-info border my-1' target='_blank'
                            href='archivostarea/<?php  echo $notw["archivo"] ?>'>
                            Descargar archivo (<?php echo substr($notw["archivo"], strrpos($notw["archivo"], '.')+1);?>)
                        </a>

                        <?php if($ww['tipo']==='docente'){?>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    de 0 a 20:
                                </div>
                            </div>
                            <input type="text" class="form-control" <?php  echo "id='nota' data-nota='" . $notw["idtarea"] ."'
                            value='". $notw["evaluacion"] ."'"?> placeholder=" Nota">
                        </div>

                        <?php  
                        }
                        $j++;
                        $suma += (int)$notw['evaluacion'];
                        }
                        ?>
                    </div>
                </div>
                <?php 
                $i++;
                } while ($acal = mysqli_fetch_assoc($cal));
                ?>
            </div>
            <div class='componentWrapperbottom color border border-info rounded text-center'> Suma puntos
                <?php echo $suma ?>
            </div>
        </div>

        <?php
        $k++;
        $cct = round(($suma) / ($i-1), 3);            
        } else {
            echo "No hay clases creadas";
        }
        ?>

        <?php
        } while($cap = mysqli_fetch_assoc($con));
        } 
        ?>

        <div class='componentWrapperbottom color border border-info rounded text-center text-uppercase'> Promedio tareas
            <!-- <?php echo ($suma) . "/" . ($i-2) . "=" . round(($suma) / ($i-2), 3) ?> -->
        </div>
    </div>







    <?php
$cal = mysqli_query($link, "SELECT * FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$acal = mysqli_fetch_assoc($cal);
$ncal = mysqli_num_rows($cal);

$caw = mysqli_query($link, "SELECT * FROM tareas WHERE clave='" . $_SESSION['clave'] . "' AND usuario='" . $_SESSION["estudiante"] . "' AND idcapitulo='idc' AND idseccion='ids'");
$acaw = mysqli_fetch_assoc($caw);
$ncaw = mysqli_num_rows($caw);

?>
    <div class="container my-5 p-0">
        <div class="card border border-info my-5 py-3 pt-4 p-1  bg-warning rounded">
            <div class='componentWrapper color border border-info text-center text-uppercase rounded h3'>
                Examen y tarea general (Final)
            </div>
            <div class='card text-center my-3 py-3 border border-info'>
                <?php
            $npregg = mysqli_num_rows(mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND idcapitulo='cpt'"));
            $npregge = mysqli_num_rows(mysqli_query($link, "SELECT * FROM examen WHERE clavecurso ='".$_SESSION['clave']."' AND idcapitulo='cpt'  AND tipo='escrita'"));
            ?>
                <div class='componentWrapper color border border-info text-center text-uppercase'>Examen general (Final)
                    <?php echo "NP: ".$npregg." NE: ".$npregge;?>
                </div>

                <div class="card-body p-1">
                    <?php 
                    $rw = mysqli_query($link, "SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM preguntas, respuestas
                    WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta='correcta' AND usuario='" . $estudiant['idusuario'] . "' AND idcpt='cpt')");

                    $row = mysqli_fetch_assoc($rw);
                    $sum = $row['sum'];

                    $rww = mysqli_query($link, "SELECT SUM(escritanota) AS sumw FROM respuestas WHERE idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "' AND idcpt='cpt'");
                    $roww = mysqli_fetch_assoc($rww);

                    $sumw = $roww['sumw'];
                    $wggg = $sumw + $sum;

                    $max = mysqli_query($link, "SELECT * FROM examen WHERE tipo = 'escrita' AND idcapitulo='cpt' AND clavecurso ='".$_SESSION['clave']."'");
                    $maxx = mysqli_fetch_assoc($max);
                    $maxn = mysqli_num_rows($max);

                    $dioexamen = mysqli_query($link, "SELECT * FROM respuestas WHERE clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "' AND idcpt='cpt'");
                    $dioexamenn = mysqli_num_rows($dioexamen);

                    $escritow = mysqli_query($link, "SELECT * FROM respuestas WHERE idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $estudiant['idusuario'] . "' AND idcpt='cpt'");
                    $escritoww = mysqli_fetch_assoc($escritow);
                    $nescrw = mysqli_num_rows($escritow);

                    if ($dioexamenn > 0) {
                    ?>
                    <div class='text-center bg-light container mb-1'>
                        <?php  if($sum==''){echo "0A";}else{echo $sum."A";} echo "+"; if($sumw==''){echo "0E";}else{echo $sumw."E";} echo "=".$wggg;?>
                        en EG
                    </div>

                    <?php
                    do {
                        if($nescrw>0){

                        if ($ww['tipo'] == 'docente') {
                    ?>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Máx: <?php  echo $maxx['calificativo'] ?>
                            </div>
                        </div>
                        <input type="text" class="form-control" <?php echo "id='fff' 
                        data-fffff='" .$escritoww['idrespuestas']."' data-user='".$escritoww["usuario"]."'
                            value='".$escritoww["escritanota"]."'"?> placeholder=" Nota">
                    </div>

                    <?php } ?>

                    <button type="button" class="btn btn-light" data-toggle="modal"
                        data-target="#w<?php  echo $escritoww['clavepregunta']?>">
                        Respuesta escrita. <?php  echo "Nota: ".$escritoww['escritanota'] ?>
                    </button>

                    <div class="modal fade" id="w<?php  echo $escritoww['clavepregunta']?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Respuesta</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-justify">
                                    <?php  echo $escritoww['respuesta'].$escritoww['clavepregunta']?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        }
                    } while ($escritoww = mysqli_fetch_assoc($escritow));
                    }else{
                    echo "Aún no dió el examen verifique la fecha indicada";
                    }
                    ?>
                </div>
                <div class='componentWrapperbottom border border-info color text-center text-uppercase'> Examen final:
                    <?php echo (int)$wggg; ?>
                </div>
            </div>


            <div class='card text-center my-3 border border-warning'>
                <div class='componentWrapper border border-warning color text-center '>TRABAJO FINAL DEL CURSO</div>
                <div class="py-3">
                    <button type="button" class="btn btn-light border" data-toggle="modal" data-target="#www">Trabajo
                        encargado</button>
                    <div class="modal fade" id="www" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Trabajo encargado</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body text-justify">
                                    <?php  echo $acal['tarea']?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-light border m-1" data-toggle="modal" data-target="#wwwr">
                        <?php  if (isset($acaw['evaluacion'] )) {echo"Trabajo entregado. Nota: ".$acaw['evaluacion'];}elseif($ncaw > 0){echo "Trabajo entregada, falta evaluar";}else{echo "Trabajo no entregado";}?>
                    </button>


                    <div class="modal fade" id="wwwr" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Tarea entregada</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-justify">
                                    <?php  echo $acaw['texto']?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 

                    if ($ncaw > 0) {
                    if ($acaw['evaluacion'] != "" || $ncaw > 0) {
                    $j = 1;
                    ?>
                    <a class='btn btn-info border  my-1' style='text-decoration:none; display:' target='_blank'
                        href='archivostarea/<?php  echo $acaw["idseccion"] . "_" . $acaw["archivo"] ?>'>
                        Descargar archivo
                    </a>

                    <?php if($ww['tipo']==='docente'){?>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">de 0 a 20: </div>
                        </div>
                        <input type="text" class="form-control" <?php  echo "id='nota' data-nota='" . $acaw["idtarea"] ."'
                            value='". $acaw["evaluacion" ] ."'"?> placeholder=" Nota">
                    </div>

                    <?php 
                        
                    }}       
                    $wwt = $acaw['evaluacion'];       
                    } else {
                    $wwt=0;
                    }
                    ?>
                </div>
                <div class='componentWrapperbottom color border border-warning text-center text-uppercase rounded'>
                    Trabajo
                    final:
                    <?php echo (int)$wwt; ?>
                </div>
            </div>
            <div
                class='componentWrapperbottom color border border-info text-center text-uppercase rounded text-uppercase'>
                Promedio de
                tarea y
                examen
                final
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card bg-info text-light border text-center pb-3 my-5 rounded d-none">
        PROMEDIO FINAL=0.2AP+0.2TE+0.3EP+0.3EF=
        <?php echo "(0.2)".(20)*$rsumww/($nforo*5*100)."+(0.2)".$cct."+(0.3)".$cce."+(0.3)".(int)$wwt."=" ?>
        <?php echo (0.2)*(20)*$rsumww/($nforo*5*100)."+".(0.2)*$cct."+".(0.3)*$cce."+".(0.3)*(int)$wwt."=" ?>
        <?php echo (0.2)*(20)*$rsumww/($nforo*5*100)+(0.2)*$cct+(0.3)*$cce+(0.3)*(int)$wwt ?>

        <div class="componentWrapperbottom color border border-info text-secondary p-0 rounded">
            Donde AP: Asistencia participación promedio, TE: Tareas encargadas promedio, EP:Examen parcial promedio
            EF:
            Examen final
        </div>
    </div>
</div>