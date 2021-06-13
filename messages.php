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

$r=4;


?>
<?php include('margin.php'); ?>


<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>

<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({ "fast-preview": {disabled:true},TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {preview: "none", inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>

<style>
.richText .richText-editor {
    padding: 20px;
    background-color: rgb(100, 100, 0, 0.3);
    border-left: #FFFFFF solid 2px;
    font-family: Calibri, Verdana, Helvetica, sans-serif;
    height: 100px;
    overflow-y: scroll;
    overflow-x: auto;
}
</style>





<div class="container p-1 my-1">
    <div class="md-form pink-textarea active-pink-textarea">
        <textarea id="comentarww" placeholder="Nuevo mensaje" class="md-textarea form-control" rows="3"></textarea>
    </div>
    <button class="btn bg-light mt-1 border" id="saveww">Enviar mensaje</button>
</div>



<script>
$(document).ready(function() {
    $('.www').richText();
});
</script>




<script>
$(document).ready(function() {
    setInterval(obtener_chat, 3000);

    function obtener_chat() {
        $.ajax({
            url: "messages_ajax.php",
            method: "POST",
            success: function(data) {
                $("#comentarchat").html(data)
            }
        })
    }


    obtener_chat();


    $('#saveww').click(function() {
        // Get edit field value
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var x1 = $('#comentarww').val();

        if (x1 === "") {} else {

            $('#comentarww').val('');

            //     alert(x1);  
            $.ajax({
                url: "messages_ajax.php",
                type: 'post',
                data: {
                    clavew: clave,
                    user: user,
                    x1: x1
                },
                success: function(data) {

                    //  var audio = new Audio('beep.mp3');
                    //                audio.play();
                    //obtener_chat();
                    //   alert(data);
                }
            });
        }

    });


    //INSERTAR foro
    $(document).on("blur", "#comentar", function() {
        var clave = "<?php echo $_SESSION['clave'] ?>";
        var user = "<?php echo $_SESSION['user'] ?>";
        var x1 = $(this).val();

        //   alert(clave);
        //   alert(user);
        //   alert(x1);
        $.ajax({
            url: "messages_ajax.php",
            method: "post",
            data: {
                clavew: clave,
                user: user,
                x1: x1
            },
            success: function(data) {
                obtener_comentarforo();
                //  var audio = new Audio('beep.mp3');
                //                audio.play();
                //obtener_chat();
                alert(data);
            }
        })
    })




    function actualizar_datos(id, texto, columna) {
        $.ajax({
            url: "messages_ajax.php",
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
        actualizar_datos(id, x1, "nombre")
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


    //ELIMINAR archivos
    $(document).on("click", "#delete", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("id");
            //alert(idw);
            $.ajax({
                url: "messages_ajax.php",
                method: "post",
                data: {
                    id: idw
                },
                success: function(data) {
                    obtener_chat();
                    //alert(data);
                }
            })
        };
    })


});
</script>


<div id="comentarchat"></div>