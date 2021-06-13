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

$r=1;

if (isset($_REQUEST['subir']) && !empty($_REQUEST['subir'])) {
    $clave = $_SESSION['clave'];
    $user = $_SESSION['user'];
    $na = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $t = $_FILES['archivo']['size'];
    mysqli_query($link, "INSERT INTO archivos VALUES(NULL, '$na','$tipo','$t','$clave','$user')");
    $idarchivo = mysqli_insert_id($link);
    copy($_FILES['archivo']['tmp_name'], "archivosclase/" . $idarchivo . $na);
}


if (isset($_REQUEST['eliminararchivos'])) {
    mysqli_query($link, "DELETE FROM archivos WHERE idarchivo=" . $_REQUEST['eliminararchivos']);
    header("Location:archivos.php");
}


$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Capítulos de <?php echo $wew['nombre'] ?></title>

<link rel="shortcut icon" type="image/x-icon" href="w.ico">


<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>


<?php include('margin.php'); ?>

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


<script>
function refreshAt(hours, minutes, seconds, day) {
    var now = new Date();
    var then = new Date();
    var dayUTC = new Date();

    if (dayUTC.getUTCDay() == day) {

        if (now.getUTCHours() > hours ||
            (now.getUTCHours() == hours && now.getUTCMinutes() > minutes) ||
            now.getUTCHours() == hours && now.getUTCMinutes() == minutes && now.getUTCSeconds() >= seconds) {
            then.setUTCDate(now.getUTCDate() + 1);
        }

        then.setUTCHours(hours);
        then.setUTCMinutes(minutes);
        then.setUTCSeconds(seconds);


        var timeout = (then.getTime() - now.getTime());
        setTimeout(function() {
            window.location.reload(true);
        }, timeout);
    }
}
</script>
<script>
refreshAt(18, 02, 0, 3);
</script>

<script>
$(document).ready(function() {
    function obtener_capitulos() {
        $.ajax({
            url: "capitulos_mostrar.php",
            method: "POST",
            success: function(data) {
                $("#resultadocapitulo").html(data)
            }
        })
    }
    obtener_capitulos();

    //INSERTAR CAPITULOS
    $(document).on("click", "#addcapitulos", function() {
        var clave = "<?php echo $_SESSION['clave'] ?>";
        //   alert(clave);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavew: clave
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })

    //INSERTAR secciones
    $(document).on("click", "#addsecciones", function() {
        var claves = "<?php echo $_SESSION['clave'] ?>";
        var id = $(this).data("c1");
        //   alert(id);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavewws: claves,
                id: id
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })


    //ACTUALIZAR tarea clase
    function actualizar_clase(id, texto, columna) {
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                idclase: id,
                textoc: texto,
                columnac: columna
            },
            success: function(data) {
                obtener_capitulos();
                //alert(data);
            }
        })
    }

    $(document).on("click", "#ccccc", function() {
        var id = $('#clase').data("c1");
        var x1 = $('#clase').val();
        alert('Actualizado correctamente');
        actualizar_clase(id, x1, "tarea")
    })

    //ACTUALIZAR capitulo
    function actualizar_datos(id, texto, columna) {
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                id: id,
                texto: texto,
                columna: columna
            },
            success: function(data) {
                obtener_capitulos();
                //alert(data);
            }
        })
    }
    //ACTUALIZAR nombre capitulo
    $(document).on("blur", "#cpt", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        actualizar_datos(id, x1, "nombre")
    })
    //ACTUALIZAR FECHAEXA
    $(document).on("blur", "#extt", function() {
        var id = $(this).data("tt");
        var x1 = $(this).val();
        //alert(x1);
        actualizar_datos(id, x1, "fechaexa")
    })
    //ACTUALIZAR examen
    $(document).on("blur", "#exttt", function() {
        var id = $(this).data("ttt");
        var x1 = $(this).val();
        //alert(x1);
        actualizar_datos(id, x1, "examen")
    })
    //ACTUALIZAR descr capitulo
    $(document).on("blur", "#cc1", function() {
        var id = $(this).data("c1");
        var x = $(this).text();
        var x1 = x.replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "descripcion")
    })



    //ACTUALIZAR seccion
    function actualizar_datosww(id, texto, columna) {
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                idw1: id,
                textow1: texto,
                columnaw1: columna
            },
            success: function(data) {
                obtener_capitulos();
                //alert(data);
            }
        })
    }
    //ACTUALIZAR titulo seccion
    $(document).on("blur", "#wsec", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "nombre")
    })
    //
    //ACTUALIZAR contenido de seccion
    $(document).on("blur", "#wtexto", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "texto")
    })
    //ACTUALIZAR tarea de seccion
    $(document).on("blur", "#sec_tarea", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "tarea")
    })
    //ACTUALIZAR fecha
    $(document).on("blur", "#time", function() {
        var id = $(this).data("ttt");
        var x1 = $(this).val();
        //      alert(x1);
        //      alert(id);
        actualizar_datosww(id, x1, "time")
    })

    //archivos insert.
    $(document).on("click", "#imagew", function() {

        var claves = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        // alert(claves);

        $.ajax({
            type: 'post',
            url: "capitulos_datos.php",
            data: {
                clavessww: claves,
                userr: user
            },
            success: function(data) {
                obtener_capitulos();
                //  alert(data);
            }
        });
    });
    //ACTUALIZAR archivos
    function actualizar_file(id, texto, columna) {
        // alert(id);
        // alert(texto);
        // alert(columna);  
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                idwwu: id,
                textowwu: texto,
                columnawwu: columna
            },
            success: function(data) {
                obtener_capitulos();
                // alert(data);
            }
        })
    }
    //ACTUALIZAR nombre
    $(document).on("blur", "#namefile", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        //alert(x1);
        //alert(id);
        actualizar_file(id, x1, "nombre")
    })
    //ACTUALIZAR link
    $(document).on("blur", "#linkfile", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        //alert(x1);
        //alert(id);
        actualizar_file(id, x1, "link")
    })
    $(document).on("change", "#typefileww", function() {
        var id = $(this).data("c1ww");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_file(id, x1, "type")
    })
    //INSERTAR archivos secciones
    $(document).on("click", "#send", function() {
        var claves = "<?php echo $_SESSION['clave'] ?>";

        var id = $(this).data("c1");
        //  alert(id);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavews: claves,
                id: id
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })

    //Agregar sección
    $(document).on("click", "#addsecciones", function() {
        var claves = "<?php echo $_SESSION['clave'] ?>";
        var id = $(this).data("c1");
        //  alert(id);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavews: claves,
                id: id
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })

    //Agregar inicio tiempo examen
    $(document).on("click", "#empezar", function() {
        var claves = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var cap = $(this).data("cpt");
        var idw = $(this).data("tiempo");
        var idc = $(this).data("idc");
        //var name=$(this).data("name");
        alert(idw);
        //   alert(idc);
        //   alert(cap);
        //      alert(claves);
        //   alert(user);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavee: claves,
                user: user,
                cap: cap,
                idw: idw,
                idc: idc
            },
            success: function(data) {
                obtener_capitulos();
                alert(data);
            }
        })
    })



    //insert tiempo de examen capitulo
    $(document).on("blur", "#ext", function() {
        var clavef = "<?php echo $_SESSION['clave'] ?>";
        var idc = $(this).data('tt'); //alert(clavef);
        var ext = $(this).val();
        //alert(ext);
        //alert(idc);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavef: clavef,
                ext: ext,
                idc: idc
            },
            success: function(data) {
                obtener_capitulos();
                //alert(data);
            }
        })
    })

    //insert tiempo de examen curso
    $(document).on("blur", "#extww", function() {
        var clavw = "<?php echo $_SESSION['clave'] ?>";
        var ext = $(this).val();
        //alert(clavw);
        //alert(ext);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                clavw: clavw,
                ext: ext
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })



    //insert tiempo entrega tarea
    $(document).on("blur", "#extt", function(e) {
        e.preventDefault();
        var claveff = "<?php echo $_SESSION['clave'] ?>";
        var extff = $(this).val();
        //      alert(extff);
        //      alert(claveff);
        $.ajax({
            url: "capitulos_datos.php",
            method: "post",
            data: {
                claveff: claveff,
                extff: extff
            },
            success: function(data) {
                obtener_capitulos();
                //   alert(data);
            }
        })
    })

    //ELIMINAR capitulo
    $(document).on("click", "#deletew", function() {
        if (confirm("Esta seguro de eliminar este capítulo")) {
            var idw = $(this).data("idw");
            //alert(idw);
            $.ajax({
                url: "capitulos_datos.php",
                method: "post",
                data: {
                    ideletew: idw
                },
                success: function(data) {
                    obtener_capitulos();
                    //alert(data);
                }
            })
        };
    })



    //ELIMINAR seccionw
    $(document).on("click", "#deleteww", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("idw");
            //alert(idw);
            $.ajax({
                url: "capitulos_datos.php",
                method: "post",
                data: {
                    ideleteww: idw
                },
                success: function(data) {
                    obtener_capitulos();
                    //alert(data);
                }
            })
        };
    })



    //ELIMINAR archivos
    $(document).on("click", "#deletearchivos", function() {
        if (confirm("Esta seguro de eliminar este archivo")) {
            var idw = $(this).data("ff");
            var name = $(this).data("name");
            //   alert(idw);
            //   alert(name);
            $.ajax({
                url: "capitulos_datos.php",
                method: "post",
                data: {
                    ideletewww: idw,
                    name: name
                },
                success: function(data) {
                    obtener_capitulos();
                    //alert(data);
                }
            })
        };
    })



});
</script>


<div id="resultadocapitulo"></div>