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

if (isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])) {
    $_SESSION['clave'] = $_REQUEST['clave'];
}



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



$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$queryarchivos = mysqli_query($link, "SELECT * FROM archivos WHERE clave='" . $_SESSION['clave'] . "'");
$numarchivos = mysqli_num_rows($queryarchivos);
$todoslosarchivo = mysqli_fetch_assoc($queryarchivos);

?>
<div class="container p-1 my-1 ">
    <div class="card text-center mb-1 bg-info text-white">
        Se considerará las horas de teóricas como sincrónicas (virtual presencial) y las horas de práctica como
        asincrónicas
        (trabajos prácticos, trabajos grupales, seminarios, trabajo semestral de investigación de un tema de interés en
        la carrera
        implicado con el aprendizaje significativo).
    </div>
    <div class="card text-center p-0  border border-info rounded mt-5">
        <h3 class='componentWrapper color rounded border border-info text-center'>ARCHIVOS</h3>
        <div class="card-body">
            <div class="row d-flex justify-content-center align-items-center">
                <?php if ($numarchivos > 0) {
      do {
      ?>
                <div class="card text-center p-1 m-1 col-md-6 col-lg-3 col-xl-3 border border-info rounded">
                    <?php if($todoslosarchivo["type"]==="link"){?>
                    <a class='btn btn-light ' target='_blank' href='<?php echo $todoslosarchivo["link"]?>'>
                        <?php echo $todoslosarchivo['nombre']?>
                    </a>
                    <?php }elseif($todoslosarchivo["type"]==="documento"){ ?>
                    <a class='btn btn-light ' target='_blank' href='<?php echo $todoslosarchivo["link"]?>'>
                        <?php echo $todoslosarchivo['nombre']?>
                    </a>
                    <?php }elseif($todoslosarchivo["type"]==="imagen"){ ?>
                    <a class='btn btn-light ' target='_blank' href='<?php echo $todoslosarchivo["link"]?>'>
                        <?php echo $todoslosarchivo['nombre']?>
                    </a>
                    <img src='<?php echo $todoslosarchivo["link"]?>' alt="ww">
                    <?php } ?>

                    <?php if ($w['tipo'] == 'docente') {?>
                    <div id='namefile' data-c1='<?php echo $todoslosarchivo["idarchivo"]?>' contenteditable>
                        <?php echo $todoslosarchivo['nombre']?></div>
                    <div id='linkfile' data-c1='<?php echo $todoslosarchivo["idarchivo"]?>' contenteditable>
                        <?php echo $todoslosarchivo['link']?></div>
                    <div id='typefile' data-c1='<?php echo $todoslosarchivo["idarchivo"]?>' contenteditable>
                        <select class="text-capitalize" name="wwwww" id="typefileww"
                            data-c1ww='<?php echo $todoslosarchivo["idarchivo"]?>'>
                            <option value='<?php echo $todoslosarchivo['type']?>'><?php echo $todoslosarchivo['type']?>
                            </option>
                            <option value="imagen">Imagen</option>
                            <option value="documento">Documento</option>
                            <option value="link">Link</option>
                        </select>

                    </div>
                    <button type='button' class=' btn btn-light mt-1' id='deletearchivos'
                        data-ff='<?php echo $todoslosarchivo["idarchivo"]?>'
                        data-name="<?php $todoslosarchivo['nombre']?>">
                        Eliminar
                    </button>
                    <?php }?>
                </div>


                <?php }while ($todoslosarchivo = mysqli_fetch_assoc($queryarchivos));
                }else {
                echo "";//No hay archivos del curso"
                }
                ?>
            </div>

        </div>
        <?php if ($w['tipo'] == 'docente') {?>

        <a class='componentWrapperbottom color rounded border border-info text-center btn btn-light' id='imagew'>
            Cargar archivos
        </a>

        <?php }?>

    </div>
</div>


<script>
function fileUpload() {
    $("#imagew").click();
}
</script>










<?php
$con = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
$n = mysqli_num_rows($con);
$a = mysqli_fetch_assoc($con);

$conw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
$nw = mysqli_num_rows($conw);
$ww = mysqli_fetch_assoc($conw);


$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);

$conw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
$nw = mysqli_num_rows($conw);
$ww = mysqli_fetch_assoc($conw);
?>
<div class="container p-1 my-1">

    <div class="card text-center  border border-info rounded my-5">
        <h3 class='componentWrapper color rounded border border-info text-center'>CONTENIDO</h3>

        <div class="card-body pt-3">
            <div class="row d-flex justify-content-center align-items-center mt-5 mb-5 pb-5">
                <?php if($nw>0){$i=1; do{
          $capitulo = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "' AND idcapitulo='" . $ww['idcapitulo'] . "'");
          $capitulow = mysqli_fetch_assoc($capitulo);
          ?>
                <div class="text-center pt-3 pb-5 col-md-5">
                    <div class="card px-1 my-5 py-5 mx-3 border border-warning rounded">
                        <?php 
                        $hour = date('H', strtotime($ww['timex'])); 
                        $min = date('i', strtotime($ww['timex']));
                        $now = new DateTime("now");
                        $inicio = new DateTime($ww['fechaexa']);
                        $final =  new DateTime($ww['fechaexa'].' + '.$hour.' hours + '.$min.' minutes');

                        ?>
                        <?php  
//echo $final;

?>
                        <div class="componentWrapper color border border-warning py-3 rounded">
                            <?php if ($w['tipo'] == 'docente') {?>
                            <button class="componentWrapper btn btn-warning btn-sm rounded" id='addsecciones'
                                data-c1='<?php echo $ww["idcapitulo"]?>'>Agregar
                                sección
                            </button>
                            <button class="componentWrapperbottom btn btn-warning btn-sm rounded" id='deletew'
                                data-idw='<?php echo $ww["idcapitulo"]?>'>Eliminar
                                capítulo
                            </button>

                            <?php }else{?>
                            <div class="componentWrapper color  bg-warning text-uppercase rounded">
                                <?php echo $ww['nombre']?>
                            </div>
                            <?php 

                            $examen = array(
                                '42',
                            );

                            if($inicio<$now && $now<$final || in_array($_SESSION['user'], $examen)){
                                ?>
                            <a style='display:'
                                class="componentWrapperbottom btn btn-primary btn-md border btn-sm <?php echo $ww["idcapitulo"].$i?>"
                                type="button" href='<?php echo "examen.php?idcapitulo=".$ww["idcapitulo"]."&cap=".$i?>'>
                                Examen <?php echo $i?>
                            </a>
                            <?php }?>

                            <?php }?>
                            <button class="btn btn-warning my-1 text-uppercase " data-toggle="collapse"
                                data-target="#collapseExample<?php echo$capitulow['idcapitulo']?>" aria-expanded="false"
                                aria-controls="collapseExample<?php echo$capitulow['idcapitulo']?>">
                                Capítulo <?php echo $i?>
                            </button>




                        </div>
                        <div class="componentWrapperbottom color border border-warning p-1 my-1 rounded ">
                            <?php if($now<$inicio){?>
                            <span class="text-info">

                                El examen es el
                                <?php echo date_format(new DateTime($ww["fechaexa"]), 'Y-m-d H:i:s')?>. Faltan</span>
                            <div class='w-75  m-auto'>
                                <div class='www bg-light' style='width:100%;border-radius:1em;'
                                    data-date="<?php echo date_format($inicio, 'Y-m-d H:i:s')?>">
                                </div>
                            </div>
                            Actualice la página al finalizar el conteo
                            <?php }elseif($inicio<$now && $now<$final){?>

                            <span class="text-warning">
                                El examen con una duracion de <?php echo $hour." horas y ".$min." minutos" ?> se esta
                                llevando a cabo ya transcurrieron</span>
                            <div class='w-750  m-auto'>
                                <div class='www bg-light' style='width:100%;border-radius:1em;'
                                    data-date="<?php echo date_format($inicio, 'Y-m-d H:i:s')?>"></div>
                            </div>
                            <?php  }else{?>
                            <span class="text-danger">

                                El examen finalizó hace</span>
                            <div class='w-50  m-auto'>
                                <div class='www bg-light' style='width:100%;border-radius:1em;'
                                    data-date="<?php echo date_format($inicio, 'Y-m-d H:i:s')?>"></div>
                            </div>
                            <?php  }?>
                        </div>



                        <script>
                        $(".www").TimeCircles();
                        </script>

                        <script type="text/javascript">
                        $('.<?php echo $ww["idcapitulo"].$i?>').on('click', function() {
                            return confirm('Está seguro de dar el examen parcial <?php echo $i?>?');
                        });
                        </script>




                        <div class="collapse" id="collapseExample<?php echo$capitulow['idcapitulo']?>">
                            <div class='h6 text-center border p-1 my-1' id='cpt'
                                data-c1='<?php echo $ww["idcapitulo"]?>'
                                <?php if ($w['tipo']=='docente' ) {echo "contenteditable" ;}?>>
                                <?php echo $ww['nombre']?>
                            </div>
                            <div class='text-center border p-1' id='cc1' data-c1='<?php echo $ww["idcapitulo"]?>' <?php if
                                ($w['tipo']=='docente' ) {echo "contenteditable" ;}?>>
                                <?php echo$ww['descripcion']?>
                            </div>
                        </div>


                        <?php $i++;?>


                        <div class="card-body px-1 mb-1">
                            <?php  
                    $conw1 = mysqli_query($link, "SELECT * FROM secciones WHERE clavew='" . $ww['idcapitulo'] . "'");
                    $ww1 = mysqli_fetch_assoc($conw1);
                    $nw1 = mysqli_num_rows($conw1);

                    
                    if ($nw1 > 0) {
                        $j = 1;
                        do {
                            
                            $wconw1 = mysqli_query($link, "SELECT * FROM tareas WHERE usuario='".$_SESSION["user"]."' AND idseccion='" . $ww1['idseccion'] . "'");
                            $www1 = mysqli_fetch_assoc($wconw1);
                            $wnw1 = mysqli_num_rows($wconw1);
                    ?>
                            <div class="container   p-1 my-1" style="">

                                <div class="modal fade" id="www<?php  echo $ww1['idseccion']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Sección
                                                    <?php echo $j." - Capítulo ".($i - 1).": "?>
                                                    <?php echo $ww1['nombre'];?>
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-justify">
                                                <?php  echo $ww1['texto']?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
            $j++;
            ?>

                                <div class="btn-group" role="group">
                                    <button
                                        class="btn <?php if ($wnw1 > 0) {echo "btn-warning";}else{echo "btn-info";}?>"
                                        data-toggle="collapse"
                                        data-target="#collapseExample<?php echo$ww1['idseccion']?>"
                                        aria-expanded="false"
                                        aria-controls="collapseExample<?php echo$ww1['idseccion']?>">
                                        Sección
                                        <?php echo ($j-1)?>
                                        <?php if ($wnw1 > 0) {echo "Tarea entregada";}else{echo "";}?>

                                    </button>
                                    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php if ($w['tipo'] == 'docente') {?>
                                        <a class="dropdown-item"
                                            href='secciones.php?clavezz=<?php echo$ww1["idseccion"]?>&clavez=<?php echo $ww["idcapitulo"]?>'>Editar
                                            sección
                                        </a>
                                        <button class="dropdown-item" id='deleteww'
                                            data-idw='<?php echo $ww1["idseccion"]?>'>
                                            Eliminar sección</button>
                                        <?php }?>
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#www<?php  echo $ww1['idseccion']?>">
                                            Ver sección
                                            <?php echo ($j-1).": ".$ww1['nombre'];?>
                                        </button>
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                            data-target="#ww<?php  echo $ww1['idseccion']?>">
                                            Tarea (sección
                                            <?php echo ($j-1)?> - capítulo
                                            <?php echo ($i-1)?>) hasta
                                            <?php echo $ww1["time"]?>
                                        </button>
                                    </div>
                                </div>


                                <div class="collapse" id="collapseExample<?php echo$ww1['idseccion']?>">
                                    <?php if ($wnw1 > 0) {echo "Tarea entregada puede editarla hasta";}else{echo "Tarea no entregada. Fecha de entrega de la tarea hasta";}?>
                                    <?php if ($w['tipo'] == 'docente') {?>
                                    <input class="form-control rounded-0 text-center" type='datetime-local' name='ff'
                                        id='time' value='<?php echo $ww1["time"]?>'
                                        data-ttt='<?php echo$ww1["idseccion"]?>'>
                                    <?php }else{echo "<br>".$ww1["time"];}?>
                                </div>





                                <!-- Modal -->
                                <div class="modal fade" id="ww<?php  echo $ww1['idseccion']?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">Tarea (sección
                                                    <?php echo ($j-1)?> -- capitulo
                                                    <?php echo ($i-1)?>)
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-justify">
                                                <?php  echo $ww1['tarea']?>
                                            </div>
                                            <div class="modal-footer">
                                                <?php 
                                        $strStart = $ww1['time'];
                                        $datew = new DateTime($strStart);
                                        $dateww = new DateTime("now");

                                        $not = mysqli_query($link, "SELECT * FROM tareas WHERE usuario ='" . $_SESSION['user'] . "' AND idseccion ='" . $ww1['idseccion'] . "'  AND clave ='" . $_SESSION['clave'] . "'");
                                        $notw = mysqli_fetch_assoc($not);
                                        $nnot = mysqli_num_rows($not);
                                        
                                        $acceptable = array(
                                            '154',
                                            '151',
                                        );
                                        
                                        ?>

                                                <a <?php if ($datew> $dateww || in_array($_SESSION['user'], $acceptable)) {echo "class='btn btn-outline-success'
                                                href='sendtarea.php?idcpt=".$ww["idcapitulo"]."&idsec=".$ww1["idseccion"]."'";}
                                                else{echo "class='btn btn-outline-danger'";}?>>
                                                    <?php
                                                if ($datew > $dateww) {
                                                    
                                                     if ($wnw1 > 0) {echo "Editar hasta: " . date_format($datew, 'd-m-Y H:i:s') . ". Faltan: ";}else{echo "Entregar hasta: " . date_format($datew, 'd-m-Y H:i:s') . ". Faltan: ";}
                                                }else{
                                                    echo "Culmino la fecha de entreaga hace: ";
                                                    }?>
                                                    <?php  get_format($datew->diff($dateww))?>


                                                    <?php if (isset($notw['evaluacion'])){echo "Calificación: " . $notw['evaluacion'];}
                                            elseif($nnot > 0){echo "Tarea aún no evaluada <a href='sendtarea.php?idcpt=" . $ww['idcapitulo'] . "&idsec=" . $ww1['idseccion'] . "'></a>";}
                                            else{echo "Tarea no entregada";}
                                            ?>
                                                </a>
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <?php }while ($ww1 = mysqli_fetch_assoc($conw1));}else {echo "No hay secciones creadas";}?>
                            $wnw1 = mysqli_num_rows($wconw1);
                        </div>
                        <?php if ($w['tipo'] == 'docente') {?>
                        <div class="bg-info p-1 mb-3">
                            <input class="form-control text-center" type='time' id='ext'
                                data-tt='<?php echo $ww["idcapitulo"]?>' value='<?php echo $capitulow["timex"]?>'>
                            <input class="form-control text-center" type='text' id='extt'
                                data-tt='<?php echo $ww["idcapitulo"]?>' value='<?php echo $capitulow["fechaexa"]?>'>
                            <textarea class="form-control text-center" type='text' id='exttt'
                                data-ttt='<?php echo $ww["idcapitulo"]?>'><?php echo $capitulow["examen"]?></textarea>
                            Tiempo de examen
                            <?php echo$capitulow["timex"]?>
                        </div>
                        <?php }else{?>
                        <div></div>
                        <?php }?>
                    </div>
                </div>

                <?php }while ($ww = mysqli_fetch_assoc($conw));} else {echo "No hay contenido creado";}?>
            </div>
        </div>

        <?php 
            $clase = mysqli_query($link, "SELECT * FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
            $clasew = mysqli_fetch_assoc($clase);

            $rrnot = mysqli_query($link, "SELECT * FROM tareas WHERE usuario ='" . $_SESSION['user'] . "' AND idseccion ='ids' AND clave ='" . $_SESSION['clave'] . "'");
            $rrnotw = mysqli_fetch_assoc($rrnot);
            $rrnnot = mysqli_num_rows($rrnot);

            $rrwnot = mysqli_query($link, "SELECT * FROM clase WHERE clave ='" . $_SESSION['clave'] . "'");
            $rrwnotw = mysqli_fetch_assoc($rrwnot);
            
            $strStart = $rrwnotw['fechatarea'];
            $datew = new DateTime($strStart);
            $dateww = new DateTime("now");
            date_format($datew, 'd-m-Y H:i:s')
            ?>
        <div class="modal fade" id="wwwww" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Trabajo del curso
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo$clasew['tarea']?>
                    </div>
                    <div class="modal-footer">
                        <a <?php if ($datew>$dateww) {?> href='sendtarea.php?idcpt=idc&idsec=ids' class="btn btn-info"
                            <?php }else{?> class="btn btn-info" <?php }?>>

                            <?php 
                            if($rrnotw['evaluacion'] != "") {
                              ?>
                            Calificación: <?php echo $rrnotw['evaluacion']?>
                            <?php } elseif ($rrnnot > 0) {?>
                            Trabajo aún no evaluado.
                            Modificar hasta:
                            <?php date_format($datew, 'd-m-Y H:i:s')?>. Faltan:
                            <?php get_format($datew->diff($dateww))?>
                            <?php 
                            }else{
                              ?>
                            Trabajo no entregado -
                            <?php 
                            if ($datew > $dateww) {
                            ?>
                            Entregar hasta:
                            <?php echo date_format($datew, 'd-m-Y H:i:s')?>. Faltan:
                            <?php get_format($datew->diff($dateww))?>
                            <?php 
                            }else{
                            ?>
                            Culminó el periodo de entrega hace
                            <?php get_format($datew->diff($dateww))?>
                            <?php 
                              }
                              }
                            ?>
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="componentWrapperbottom color border border-info rounded card-footer">
            <button type="button" class="btn btn-info d-none" data-toggle="modal" data-target="#wwwww">
                Trabajo (tarea) final del curso
            </button>

            <?php if ($w['tipo'] == 'docente') {?>



            <button class='btn btn-info' id='addcapitulos'>Agregar capítulo</button>
            <?php }?>

            <?php 
            $rrnot = mysqli_query($link, "SELECT * FROM tareas WHERE usuario ='" . $_SESSION['user'] . "' AND idseccion ='ids' AND clave ='" . $_SESSION['clave'] . "'");
            $rrnotw = mysqli_fetch_assoc($rrnot);
            $rrnnot = mysqli_num_rows($rrnot);

            $rrwnot = mysqli_query($link, "SELECT * FROM clase WHERE clave ='" . $_SESSION['clave'] . "'");
            $rrwnotw = mysqli_fetch_assoc($rrwnot);

            $strStart = $rrwnotw['fechatarea'];
            $datew = new DateTime($strStart);
            $dateww = new DateTime("now");
            ?>



            <?php 
            $clase = mysqli_query($link, "SELECT * FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
            $clasew = mysqli_fetch_assoc($clase);
            ?>

            <?php if ($w['tipo'] == 'docente') {?>

            <button class="btn btn-info" data-toggle="collapse" data-target="#collapseExamplew" aria-expanded="false"
                aria-controls="collapseExamplew">
                Editar trabajo del curso
            </button>
            <div class="collapse" id="collapseExamplew">
                <textarea class="form-control" id='clase' data-c1='<?php echo$clasew["idclase"]?>'
                    contenteditable><?php echo$clasew['tarea']?></textarea>

                <button type="button" class="btn btn-info m-1" id='ccccc'>Guardar tarea</button>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Entregar tarea hasta:
                        </div>
                    </div>
                    <input value='<?php echo$clasew["time"]?>' data-tt='<?php echo$ww["idcapitulo"]?>'
                        class="form-control text-center" type=datetime-local id="extt">
                </div>

            </div>


            <button class="btn btn-info" data-toggle="collapse" data-target="#collapseExamplewwwwww"
                aria-expanded="false" aria-controls="collapseExamplewwwwww">
                Editar examen del curso
            </button>
            <div class="collapse" id="collapseExamplewwwwww">
                <textarea class="form-control" id='examen' data-c1='<?php echo$clasew["idclase"]?>'
                    contenteditable><?php echo$clasew['examen']?></textarea>

                <button type="button" class="btn btn-info m-1" id='ccccc'>Guardar tarea</button>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Entregar tarea hasta:
                        </div>
                    </div>
                    <input value='<?php echo$clasew["time"]?>' data-tt='<?php echo$ww["idcapitulo"]?>'
                        class="form-control text-center" type=datetime-local id="extt">
                </div>

            </div>

            <div class="button-group">
                <a class='btn btn-info my-1' href='examen.php'>
                    Agregar examen general. Tiempo de examen
                    <?php echo$clasew['timex']?>
                </a>
                <input class="form-control text-center" type=time id='extww' data-tt='<?php echo$ww["idcapitulo"]?>'
                    <?php echo "value='" .$clasew["timex"]."'";?>>
            </div>

            <?php }else{?>
            <a class="btn btn-light btn-lg www btn-lg" style='display:none' href='examen.php'>
                Dar examen general. Tiempo de examen
                <?php echo$clasew['timex']?>
            </a>

            <?php }?>

        </div>
    </div>
</div>



<script>
$('.www').on('click', function() {
    return confirm('Está seguro de dar el examen general?');
});
</script>

<script>
$(document).ready(function() {
    $('#clase').richText();
});
</script>