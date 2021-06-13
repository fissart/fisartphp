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
if (isset($_REQUEST['idtema'])) {
    $_SESSION['tema'] = $_REQUEST['idtema'];
}
if (isset($_REQUEST['numero'])) {
    $_SESSION['numero'] = $_REQUEST['numero'];
}

if (!isset($_REQUEST['page'])) {
    $_SESSION['page'] = 1;
  } else {
    $_SESSION['page'] = $_REQUEST['page'];
  }
//echo $numero;
$r=3;


$qtemas = mysqli_query($link, "SELECT * FROM temas WHERE idtema='" . $_SESSION['tema'] . "' ORDER BY fecha ASC");
$ntemas = mysqli_num_rows($qtemas);
$arraytemas = mysqli_fetch_assoc($qtemas);

$qqccc = mysqli_query($link, "SELECT * FROM comentarios WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idtema='".$_SESSION['tema']."'");
$nqcc = mysqli_num_rows($qqccc);
//echo $nqcc;

$user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
$w = mysqli_fetch_assoc($user);
?>
<?php include('margin.php');

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Comentarios del foro de <?php echo $wew['nombre'] ?></title>

<div class="container p-1 mt-1">

    <div class='card'>
        <div class='card-header h6 text-center p-1'>
            Tema <?php echo $_SESSION['numero']." " ?>
            <a href="https://github.com/ricardofisma/plataforma/raw/master/Rubrica%20general%20de%20participacion%20del%20foro.pdf"
                class="btn btn-info" target='_blank'>Indicadores a calificar</a>
        </div>


        <div class="card-body p-1">
            <?php if($arraytemas['file'] == 'Editar link') {?>
            <div class="embed-responsive embed-responsive-16by9" style='display:none'>
                <iframe class="embed-responsive-item" src='https://www.youtube.com/embed/zoGqt6ObPC8'
                    allowfullscreen>wwwww</iframe>
            </div>

            <?php }else{?>
            <div class="embed-responsive embed-responsive-16by9" style='display:none'>
                <iframe class="embed-responsive-item" src='<?php echo $arraytemas["file"]?>' allowfullscreen>ww</iframe>
            </div>
            <?php  } ?>
            <?php echo $arraytemas['tema'] ?>
        </div>
        <style>
        .richText .richText-editor {
            padding: 20px;
            background-color: white;
            font-family: Calibri, Verdana, Helvetica, sans-serif;
            height: 200px;
            outline: none;
            overflow-y: scroll;
            overflow-x: auto;
        }
        </style>
        <div class="card-footer p-1">
            <div class="md-form pink-textarea active-pink-textarea">
                <textarea id="comentar" placeholder="Nuevo comentario" class="md-textarea form-control"
                    rows="3"></textarea>
            </div>
            <script>
            $(document).ready(function() {
                $('#comentar').richText();
            });
            </script>

        </div>

    </div>
</div>




<script>
$(document).ready(function() {
    setInterval(obtener_comentarforo, 3000);

    function obtener_comentarforo() {
        $.ajax({
            url: "comentarforoajax.php",
            method: "POST",
            success: function(data) {
                $("#comentarforo").html(data)
            }
        })
    }
    obtener_comentarforo();


    $(document).on("click", "#comm", function() {
        // Get edit field value
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var tipo = "<?php echo $w['tipo'] ?>";
        var x1 = $('#comentar').val();
        var ww = $(this).data("www");
        //$("#comm").hide();
        $("#comentar").val('');
        if (x1 === "<div><br></div>" || x1 === "") {} else {
            if (ww > 2 && tipo == 'estudiante') {
                alert('Superó el límite de comentarios (3)');
            } else {
                $.ajax({
                    url: "comentarforoajax.php",
                    type: 'post',
                    data: {
                        clavew: clave,
                        user: user,
                        x1: x1
                    },
                    success: function(data) {
                        $('.richText-editor').empty();
                        //                        $("#comm").hide();
                        // alert(data);
                    }
                });
            }
        }

    });

    //actualizar ponderado de comentario
    $(document).on("blur", "#puntuacion", function() {
        // Get edit field value
        var id = $(this).data("idc");
        var ponderado = $(this).val();
        //alert(id);  
        //     alert(x1);  
        $.ajax({
            url: "comentarforoajax.php",
            type: 'post',
            data: {
                ponderado: ponderado,
                idc: id
            },
            success: function(data) {
                //       alert(data);
            }
        });
    });


    //INSERTAR foro
    $(document).on("blur", "#comentarw", function() {
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var x1 = $(this).val();
        //        $(this).val('');
        $('#comentar').empty();
        //   alert(clave);
        //   alert(user);
        //   alert(x1);
        $.ajax({
            url: "comentarforoajax.php",
            method: "post",
            data: {
                clavew: clave,
                user: user,
                x1: x1
            },
            success: function(data) {
                // var audio = new Audio('beep.mp3');
                //                audio.play();
                obtener_comentarforo();
                //   alert(data);
            }
        })
    })

    //ACTUALIZAR capitulo
    function actualizar_datos(id, texto, columna) {
        $.ajax({
            url: "datos_capitulos.php",
            method: "post",
            data: {
                id: id,
                texto: texto,
                columna: columna
            },
            success: function(data) {
                obtener_comentarforo();
                //alert(data);
            }
        })
    }

    //ACTUALIZAR nombre capitulo
    $(document).on("blur", "#cpt", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        obtener_foro(id, x1, "nombre")
    })

    //ACTUALIZAR descr capitulo
    $(document).on("blur", "#cc1", function() {
        var id = $(this).data("c1");
        var x = $(this).val();
        var x1 = x.replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "descripcion")
    })

    //ACTUALIZAR foro
    function actualizar_datosww(id, texto, columna) {
        $.ajax({
            url: "foroajax.php",
            method: "post",
            data: {
                idw: id,
                textow: texto,
                columnaw: columna
            },
            success: function(data) {
                obtener_foro();
                alert(data);
            }
        })
    }

    //ACTUALIZAR titulo seccion
    $(document).on("blur", "#www", function() {
        var id = $(this).data("id");
        var x1 = $(this).text();
        alert(x1);
        alert(id);
        actualizar_datosww(id, x1, "tema")
    })


    //ELIMINAR comentario
    $(document).on("click", "#delete", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("id");
            //alert(idw);
            $.ajax({
                url: "comentarforoajax.php",
                method: "post",
                data: {
                    id: idw
                },
                success: function(data) {
                    obtener_comentarforo();
                    //alert(data);
                }
            })
        };
    })


});
</script>


<div id="comentarforo"></div>