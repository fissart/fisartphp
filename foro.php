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

$r=3;

$con = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$wew = mysqli_fetch_assoc($con);
?>
<title>Foro de <?php echo $wew['nombre'] ?></title>





<?php include('margin.php'); ?>



<script>
$(document).ready(function() {
    function obtener_foro() {
        $.ajax({
            url: "foroajax.php",
            method: "POST",
            success: function(data) {
                $("#foro").html(data)
            }
        })
    }
    obtener_foro();

    //INSERTAR foro
    $(document).on("click", "#foroww", function() {
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var x1 = $(this).val();
        //   alert(clave);
        //   alert(user);
        //   alert(x1);
        $.ajax({
            url: "foroajax.php",
            method: "post",
            data: {
                clavew: clave,
                user: user,
                x1: x1
            },
            success: function(data) {
                obtener_foro();
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
                obtener_foro();
                //alert(data);
            }
        })
    }
    //ACTUALIZAR nombre capitulo
    $(document).on("blur", "#cpt", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        actualizar_datos(id, x1, "nombre")
    })
    //ACTUALIZAR descr capitulo
    $(document).on("blur", "#cc1", function() {
        var id = $(this).data("c1");
        var x = $(this).val();
        var x1 = x.replace('https://www.youtube.com/watch?v=',
            'https://www.youtube-nocookie.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_datos(id, x1, "descripcion")
    })



    //ACTUALIZAR tema
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
                //alert(data);
            }
        })
    }

    $(document).on("click", ".save", function() {
        var id = $(this).data("id");
        var x1 = $(this).val();

        actualizar_datosww(id, x1, "tema")
    })
    $(document).on("blur", "#fecha", function() {
        var id = $(this).data("www");
        var x1 = $(this).val();
        // alert(x1);
        actualizar_datosww(id, x1, "fecha")
    })
    $(document).on("blur", "#link", function() {
        var id = $(this).data("id");
        var x = $(this).text();
        var x1 = x.replace('https://www.youtube.com/watch?v=',
            'https://www.youtube-nocookie.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "file")
    })

    $(document).on("click", "#showw", function() {
        var id = $(this).data("id");
        var x1 = $(this).data("sw");
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "mosesc")
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
    $(document).on("change", "#time", function() {
        var id = $(this).data("ttt");
        var x1 = $(this).val();
        //alert(x1);
        //alert(id);
        actualizar_datosww(id, x1, "time")
    })

    //archivos insert.
    $(document).on("change", "#imagew", function() {
        var data = new FormData();
        var claves = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        data.append('file', $('#imagew')[0].files[0]);
        data.append('claves', claves);
        data.append('user', user);
        //  alert(data);

        $.ajax({
            type: 'post',
            url: "datos_capitulos.php",
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                obtener_capitulos();
                //        alert(data);
            }
        });
    });

    //INSERTAR archivos secciones
    $(document).on("click", "#send", function() {
        var claves = "<?php echo $_SESSION['clave'] ?>";

        var id = $(this).data("c1");
        //  alert(id);
        $.ajax({
            url: "datos_capitulos.php",
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
            url: "datos_capitulos.php",
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
            url: "datos_capitulos.php",
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
            url: "datos_capitulos.php",
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
            url: "datos_capitulos.php",
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
    $(document).on("blur", "#extt", function() {
        var claveff = "<?php echo $_SESSION['clave'] ?>";
        var extff = $(this).val();
        //alert(extff);
        //alert(claveff);
        $.ajax({
            url: "datos_capitulos.php",
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
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("idw");
            //alert(idw);
            $.ajax({
                url: "datos_capitulos.php",
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
                url: "datos_capitulos.php",
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
    $(document).on("click", "#del", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("id");
            //alert(idw);
            $.ajax({
                url: "foroajax.php",
                method: "post",
                data: {
                    idwel: idw
                },
                success: function(data) {
                    obtener_foro();
                    //alert(data);
                }
            })
        };
    })




});
</script>


<div id="foro"></div>