<?php

require('conect.php');
session_start();

if(!isset($_SESSION['user'])){
header("Location:index.php");
        }

if(isset($_REQUEST['cerrar'])){
   session_destroy();
   header("Location:index.php");
}



$idsec=$_SESSION['idsec']=$_GET['idsec'];
$idcpt=$_SESSION['idcpt']=$_GET['idcpt'];



?>

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
$(document).ready(function() {
    function obtenersendtarea() {
        $.ajax({
            url: "sendtareajax.php",
            method: "POST",
            success: function(data) {
                $("#tarea").html(data)
            }
        })
    }
    obtenersendtarea();

    //archivos insert.
    $(document).on("change", "#imagew", function() {
        var tt = this.files[0].type;
        var ww = this.files[0].size;

       // alert(tt);
        var acceptable = ["application/pdf","image/jpeg","image/jpg","image/png",];
        //alert($.inArray(tt,acceptable));
        if ($.inArray(tt, acceptable)<0) {
            alert('Su arhivo no es un pdf o una imgen');
        }else{
            if (ww > 1048576) {
                //alert(this.files[0].type);
                alert('El tamaño del archivo es ' + Math.round((ww) / 1048576) +
                    'MB mayor a 1MB');
            } else {
                var idseccion = "<?php echo $_SESSION['idsec']?>";
                var user = "<?php echo $_SESSION['user']?>"; //
                var data = new FormData();
                data.append('file', $('#imagew')[0].files[0]);
                data.append('idseccion', idseccion);
                data.append('user', user);
                //            alert(idseccion);

                $.ajax({
                    type: 'post',
                    url: "sendtareajax.php",
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(data) {
                        obtenersendtarea();
                        //        alert(data);
                    }
                });
            }
        }
    });


    //INSERTAR y actualizar tarea
    $(document).on("click", "#adicionar1", function() {
        //var id=$('#rrr').data("wwtexto");
        //var x1=$('#rrr').val();
        //$(document).on("blur", "#addtarea", function(){
        var clavecurso = "<?php echo $_SESSION['clave']?>"; //
        var idseccion = "<?php echo $_SESSION['idsec']?>";
        var idcapitulo = "<?php echo $_SESSION['idcpt']?>";
        var user = "<?php echo $_SESSION['user']?>"; //
        var text = $('#addtarea').val();
        $("#w77").show('fade');
        setTimeout(() => {
            $("#w77").hide('fade');
        }, 2000);
        //   alert(clavecurso);
        //   alert(idseccion);
        //   alert(idcapitulo);
        //   alert(user);
        //   alert(text);
        if (text === "") {} else {
            $.ajax({
                url: "sendtareajax.php",
                method: "post",
                data: {
                    clavecurso: clavecurso,
                    idseccion: idseccion,
                    idcapitulo: idcapitulo,
                    user: user,
                    text: text
                },
                success: function(data) {
                    obtenersendtarea();
                    //  alert('data');
                }
            })
        }
    })


    //ELIMINAR tarea
    $(document).on("click", "#deleteww", function() {
        if (confirm("Esta seguro de eliminar esta fila")) {
            var idw = $(this).data("idw");
            var ids = $(this).data("ids");
           // alert(ids);
            $.ajax({
                url: "sendtareajax.php",
                method: "post",
                data: {
                    ideleteww1: idw,
                    ideletew: ids
                },
                success: function(data) {
                    obtenersendtarea();
                    //alert(data);
                }
            })
        };
    })



})
</script>

<div id="tarea"></div>