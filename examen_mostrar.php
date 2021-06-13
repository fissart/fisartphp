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
$w = mysqli_fetch_assoc($user);


if ($_SESSION['idcapitulo'] == 'cpt' && $w['tipo'] == 'estudiante') {
  $conw = mysqli_query($link, "SELECT * FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
  $nw = mysqli_num_rows($conw);
  $ww = mysqli_fetch_assoc($conw);
} else {
  $conw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'  AND idcapitulo='" . $_SESSION['idcapitulo'] . "'");
  $nw = mysqli_num_rows($conw);
  $ww = mysqli_fetch_assoc($conw);
}
//https://fisart.cf/examen.php?idcapitulo=177&cap=2
$hour = date('H', strtotime($ww['timex']));
$min = date('i', strtotime($ww['timex']));

$conw = mysqli_query($link, "SELECT * FROM examen WHERE clavecurso='" . $_SESSION['clave'] . "' AND idcapitulo='" . $_SESSION['idcapitulo'] . "' order by rand()");
$nw = mysqli_num_rows($conw);
$ww = mysqli_fetch_assoc($conw);

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

$rr = mysqli_query($link, "SELECT * FROM respuestas WHERE clavecurso='" . $_SESSION['clave'] . "' AND idcpt='" . $ww['idcapitulo'] . "' AND usuario='" . $_SESSION['user'] . "' AND clavepregunta='Cap: " . $_SESSION['cap'] . "'");
$nrr = mysqli_num_rows($rr);
$rrw = mysqli_fetch_assoc($rr);
/*
if($_REQUEST['idcapitulo'] = $_SESSION['idcapitulo'] && $w['tipo'] == 'docente') {
  $claves = $_SESSION['clave'];
  $user = $_SESSION['user'];
  $cap = $_SESSION['cap'];
  $idw = date_format(new DateTime('now + '.$hour.' hours + '.$min.' minutes'), 'd-m-Y H:i:s');//15-12-2020 12:00:00
  $idc = $_SESSION['idcapitulo'];
  $cnota = mysqli_query($link, "SELECT * FROM  respuestas WHERE usuario='$user' AND clavecurso='$claves' AND idalternativa='inicio' AND respuesta='inicio' AND idcpt='$idc' OR idcpt='cpt' AND clavepregunta='Cap: " . $_SESSION['cap'] . "' AND escritanota='" . $rrw['escritanota'] . "'");
  $nnota = mysqli_num_rows($cnota);
  //  echo $nnota;
  if ($nnota > 0) {
  } else {
    $idcww = mysqli_query($link, "SELECT * FROM  examen WHERE idcapitulo='$idc'");
    $idcpww = mysqli_num_rows($idcww);
    if ($idcpww > 0) {
     // $consulta = mysqli_query($link, "INSERT INTO respuestas VALUES(NULL, '$user', '$claves', 'Cap: $cap', 'inicio','inicio', '15-12-2020 12:00:00','$idc')");
    } else {
     // $consulta = "www";
    }

    if (!$consulta) {
    } else {
      header('Location: ' . $_SERVER['PHP_SELF']);
    }
  }
}
*/
$strStart = $rrw['escritanota'];
$datei = new DateTime("now");
//$datef = new DateTime($strStart);
$datef = new DateTime('24-12-2020 13:45:00');


$d1 = date_format($datei, 'd-m-Y H:i:s') . "<br>";
$d2 = date_format($datef, 'Y-m-d H:i:s') . "<br>";
//echo $d1;
//echo $d2;
//echo $idw;
$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Examen de <?php echo $wew['nombre'] ?> capítulo <?php echo $_SESSION['cap']?></title>


<?php 
    if ($datef < $datei && $w['tipo']=='estudiante') { ?>

<div class="container bg-light text-center border rounded my-1">
    El examen culminó hace
    <?php  get_format($datei->diff($datef)) ?>
</div>
<?php } else {?>
<div class="container my-1 bg-light border text-center p-1">
    <a class="btn btn-info d-none" target="_blank" href="https://meet.google.com/oxf-baef-wsg">Meet</a>
    Tiene hasta:
    <?php echo  date_format($datef, 'd-m-Y H:i:s') ?>. Faltan:
      <div class="container m-auto rounded col-md-6 col-lg-4 col-xl-4">

    <div class='www bg-info m-auto d-flex justify-content-center rounded' data-date="<?php echo date_format($datef, 'Y-m-d H:i:s');?>">
    </div>
    </div>

</div>

<script>
$(".www").TimeCircles();
</script>






<?php 
  if ($_SESSION['cap'] == 'cpt') {
  $capitulo = mysqli_query($link, "SELECT * FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
  $capitulow = mysqli_fetch_assoc($capitulo);
    ?>
<div class="container bg-info text-center">
    Examen del curso. Tiempo de examen:
    <?php echo $capitulow['timex']?>
</div>

<?php 
      } else {
      $capitulo = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "' AND idcapitulo='" . $_SESSION['idcapitulo'] . "'");
      $capitulow = mysqli_fetch_assoc($capitulo);
    ?>
<div class="container bg-light text-center border">
<h5 class="bg-warning"><?php echo "Su ID es ".$_SESSION['user']?></h5>

    Examen del capítulo
    <?php echo $_SESSION['cap']?>. Tiempo de examen:
    <?php echo $capitulow['timex']?>
    <br>
    <span class="text-info h6">Cada vez que guarde su respuesta, el orden de las preguntas cambiarán
        aleatoriamente.</span><br>
    Sugerencia: Use shift+enter para poder adicionar más texto en el mismo items <br>
    Tenga cuidado al pegar y modificar su respuesta podria desconfigurar su página y
    reempezar nuevamente. Se le sugiere que lo elabore en el mismo editor.

</div>
<?php 
        }
      ?>













<div class='container my-2 p-0'>

    <?php 
        if ($nw > 0) {                                                                                                                      
          $i = 1;
          do {                                                                                                              
      ?>
    <div class='card my-5 p-1 border-info'>

        <div class="border rounded p-1 h6 m-0">
            <?php echo "Pregunta: ".$i." -- "?>
            <?php if($w['tipo']=='docente') {?>
            <button class="btn btn-danger" id='delete' data-id='<?php echo $ww["idpregunta"] ?>'>Delete</button>
            <button class="btn btn-outline-danger btn-sm" id='esc'
                data-escrita='<?php echo $ww["idpregunta"] ?>'>escrita</button>
            <button class="btn btn-outline-success btn-sm" id='alt' data-alternativa='<?php echo $ww["idpregunta"]
                    ?>'>alternativa</button>
            <div id='cc3' data-c3='<?php echo $ww["idpregunta"] ?>' class='btn btn-dark'>Tipo:
                <?php echo $ww['tipo'] ?>
            </div>
            <?php }?>
            <button class="bg-white h6 p-0 m-0  border-0" id='cc2' data-c2='<?php echo $ww["idpregunta"] ?>'
                data-idcapitulo='<?php echo $ww["idcapitulo"] ?>' <?php if($w['tipo']=='docente' )
                {echo"contenteditable";}else{echo"";}?>><?php echo$ww['calificativo']?></button> Puntos
        </div>

        <?php if($w['tipo']=='docente') {?>
        <script>
        $(document).ready(function() {
            $('.<?php echo $_SESSION["user"].$ww["idpregunta"]."www77"?>').richText();
        });
        </script>

        <textarea
            class="form-control rounded my-1 bg-info <?php echo $_SESSION["user"].$ww["idpregunta"]."www77"?> pregunta"
            row="5" id='<?php echo $_SESSION['user'].$ww["idpregunta"]."zzz"?>' data-c1='<?php echo $ww["idpregunta"]?>'
            <?php if($w['tipo']=='docente' ) {echo"contenteditable";}else{}?>
            placeholder='Escriba pregunta'><?php echo $ww['pregunta']?></textarea>
        <label for="<?php echo $_SESSION['user'].$ww['idpregunta']."zzz"?>" class="btn btn-info">Guardar pregunta</label>
        <?php }else{?>
        <div class="bg-light container border rounded my-1">
            <?php echo $ww['pregunta'];?>
        </div>
        <?php 
    }
    $i++;?>



        <?php 
      if ($ww['tipo'] == 'alternativa') {                                                                                                                             

        $conw1 = mysqli_query($link, "SELECT * FROM preguntas WHERE clavepregunta='" . $ww['idpregunta'] . "'");
        $ww1 = mysqli_fetch_assoc($conw1);
        $nw1 = mysqli_num_rows($conw1);

        if ($nw1 > 0) {                                                                                                       

          $j = 1;

          do {                                                                                                                                
            if ($w['tipo'] == 'docente') {
              if ($ww1['rpta'] == 'correcta') {
                          ?>
        <div class="container bg-success mb-1 p-1">
            <div class="btn btn-danger">
                <?php echo $j ?>
            </div>
            <button class="btn btn-warning" id='deletealtr' data-idaltr='<?php echo $ww1["idalternativa"]?>'>Delete
            </button>
            <div class="btn btn-light" id='alternativaww' data-altww='<?php echo $ww1["idalternativa"] ?>'
                data-altw='<?php echo $ww1['idalternativa'] ?>' contenteditable><?php echo $ww1['alternativa'] ?></div>
        </div>
        <?php } else {?>
        <div class="container bg-info mb-1 p-1">
            <div class="btn btn-danger">
                <?php echo $j ?>
            </div>
            <button class="btn btn-light" id='deletealtr' data-idaltr='<?php echo $ww1["idalternativa"] ?>'>Delete
            </button>
            <div class="btn btn-success" id='alternativa' data-alt='<?php echo $ww1["idalternativa"] ?>'
                data-altw='<?php echo $ww1["clavepregunta"] ?>'>
                <?php echo $ww1['alternativa'] ?>
            </div>
        </div>
        <?php }
            } else {
              $conwzz = mysqli_query($link, "SELECT * FROM respuestas WHERE idalternativa='" . $ww1['idalternativa'] . "' AND usuario='" . $_SESSION['user'] . "'  AND idcpt='" . $_SESSION['idcapitulo'] . "'");
              $wwz = mysqli_fetch_assoc($conwzz);
              $nwz = mysqli_num_rows($conwzz);
              $json_array = array();

              if ($nwz == 0) {
                ?>
        <div class="container btn-light border my-1" style='cursor:pointer' id='addresp'
            <?php echo "data-altresp='"
            .$ww1["idalternativa"]."' data-idcpt='".$_SESSION["idcapitulo"]."' data-altwresp='".$ww1["clavepregunta"]."'" ?>>
            <?php echo  $j . " . " . $ww1['alternativa'] ?>
        </div>
        <?php } else {

                do {
                  if ($wwz['respuesta'] == 'correcta') {
                  ?>
        <div class=" container bg-dark" id='addresp' <?php echo "data-altresp='" .$ww1["idalternativa"] ."'
            data-idcpt='".$_SESSION["idcapitulo"]."' data-altwresp='".$ww1["clavepregunta"]."'" ?>>
            <?php echo $j." . ".$ww1['alternativa'] ?>

        </div>
        <?php } else {?>

        <div class=" container bg-info" style='cursor:pointer' id='addresp' <?php echo"data-altresp='".$ww1["idalternativa"] ."' data-idcpt='".$_SESSION["idcapitulo"]."'
            data-altwresp='".$ww1["clavepregunta"] ."'"?>>
            <?php echo $j . ". " . $ww1['alternativa'] ?>
        </div>
        <?php  
                  }
                } while ($wwz = mysqli_fetch_assoc($conwzz));
              }
            }
            $j++;
          } while ($ww1 = mysqli_fetch_assoc($conw1));                                                              


        } else {
        }

        if ($ww['tipo'] == 'alternativa') {
          if ($w['tipo'] == 'docente') {
            ?>
        <div class=" container text-center">
            <button class="btn btn-outline-success" id='altr' data-idpregunta='<?php echo $ww["idpregunta"] ?>'
                data-idcpt='<?php echo $_SESSION["idcapitulo"] ?>'>
                Agregar alternativa
            </button>
        </div>
        <?php }
        }

        



      }else{
        if ($w['tipo'] == 'estudiante'){


          $escrita = mysqli_query($link, "SELECT * FROM respuestas WHERE idalternativa='0' AND usuario='" . $_SESSION['user'] . "' AND clavecurso='" . $_SESSION['clave'] . "' AND idcpt='" . $_SESSION['idcapitulo'] . "' AND clavepregunta ='" . $ww['idpregunta'] . "'");
          $escritaw = mysqli_fetch_assoc($escrita);
          $nescrita = mysqli_num_rows($escrita);
          ?>


        <textarea class="form-control my-1 <?php echo $_SESSION["user"].$ww["idpregunta"]."ww"?> example"
            id='<?php echo $_SESSION['clave'].$_SESSION['user'].$ww['idpregunta']?>' data-cc='<?php echo $ww["idpregunta"]?>' data-idcpt='<?php echo $_SESSION["idcapitulo"]
            ?>' contenteditable placeholder='Escriba su respuesta aqui'><?php echo $escritaw['respuesta']?></textarea>

        <script>
        $(document).ready(function() {
            $('.<?php echo $_SESSION["user"].$ww["idpregunta"]."ww"?>').richText();
        });
        </script>

        <div class="p-1 text-center">
            <label for="<?php echo $_SESSION['clave'].$_SESSION['user'].$ww['idpregunta']?>" class="btn btn-info  m-0" type="button">Guardar respuesta <?php echo $ww['idpregunta']?></label>
        </div>
        <?php if(isset($escritaw['respuesta'])){?>
        <div class="border rounded p-1"><?php echo $escritaw['respuesta']?></div>
        <?php }?>
        <?php 
  


        }
      }





      $cnota = mysqli_query($link, "SELECT * FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.clavepregunta='" . $ww['idpregunta'] . "' AND preguntas.rpta=respuestas.respuesta AND usuario='" . $_SESSION['user'] . "'");
      $nota = mysqli_fetch_assoc($cnota);
      $nnota = mysqli_num_rows($cnota);

      if ($w['tipo'] == 'estudiante') {

        if ($nnota == 1) {
          $cpunto = mysqli_query($link, "SELECT * FROM  examen, respuestas WHERE idpregunta='" . $ww['idpregunta']."'");
          $punto = mysqli_fetch_assoc($cpunto);
          $gg = $punto['calificativo'];
          //echo "<div style='background:rgb(10,100,200)'>".$gg."</div>";
        } else {
          $gg = 0;
          //echo "<div style='background:rgb(10,100,200)'>".$gg."</div>";
        }
      }

?>
    </div>

    <?php 
    } while ($ww = mysqli_fetch_assoc($conw));                                                                                              //do1


  } else {                                                                                                                              //iff//
    //
  }











  if ($w['tipo'] == 'docente') {
?>

    <div class="container text-center">
        <button class='btn btn-info' id='add' data-idcapitulo='<?php echo $_SESSION["idcapitulo"] ?>'>
            Agregar pregunta
        </button>
    </div>
    <?php 
    $fila = mysqli_query($link, "SELECT SUM(calificativo) AS suma FROM  examen WHERE clavecurso='" . $_SESSION['clave'] . "' AND idcapitulo='" . $_SESSION['idcapitulo'] . "'");
    $filaw = mysqli_fetch_assoc($fila);
    $suma = $filaw['suma'];
        ?>
    <div class='container text-center bg-info mb-3 mt-1'>
        <?php echo $suma ?> puntos examen
    </div>
    <?php 
           } else {


    $rw = mysqli_query($link, "SELECT SUM(calificativo) AS sum FROM  examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='" . $_SESSION['user'] . "' AND idcapitulo='" . $_SESSION['idcapitulo'] . "')");
    $row = mysqli_fetch_assoc($rw);
    $sum = $row['sum'];

    $rww = mysqli_query($link, "SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='" . $_SESSION['clave'] . "' AND usuario ='" . $_SESSION['user'] . "'  AND idcpt ='" . $_SESSION['idcapitulo'] . "'");
    $roww = mysqli_fetch_assoc($rww);
    $sumw = $roww['sumw'];
    $ggg = $sumw + $sum;


    //echo $_SESSION['clave'];
    //echo "<div style='background:rgb(100,200,200)'>Alternativas: ".$sum." -- Escritas: ".$sumw."</div>";

    //  echo "<div style='margin:5px auto;width:90%;color:black;text-align:center;background:rgb(100,200,100);'><p>Total ".$ggg." puntos </p></div>";

  }


      ?>
    <?php 
}
?>
</div>