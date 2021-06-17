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



//1 Derecho
if (isset($_REQUEST['clavesww'])) {
$user = $_POST['clavesww'];  
$clave = $_POST['idcurse'];  
$categoria="2";
$curso="MA-141 DERECHO";
$idcurso="69";

$cl=mysqli_query($link, "SELECT * FROM misclases WHERE usuario='$user'");
$ncl = mysqli_num_rows($cl);
$ccl = mysqli_fetch_assoc($cl);

if ($ncl > 1) {
    echo "Solo puede unirse a dos cursos";
}else{
$consulta=mysqli_query($link, "INSERT INTO misclases VALUES (NULL,'$user','$clave','$categoria','$curso', '$idcurso')");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok";
  }
}
}


//2 IA
if (isset($_REQUEST['clavesff'])) {
  $user = $_POST['clavesff'];  
  $clave="VmbwL0dPCbV";
  $categoria="2";
  $curso="MA-141 I IA";
  $idcurso="70";
  
  $cl=mysqli_query($link, "SELECT * FROM misclases WHERE usuario='$user'");
  $ncl = mysqli_num_rows($cl);
  $ccl = mysqli_fetch_assoc($cl);
  
  if ($ncl > 0) {
      echo "Ya te uniste a una clase ".$ccl['curso'];
  }else{
  $consulta=mysqli_query($link, "INSERT INTO misclases VALUES (NULL,'$user','$clave','$categoria','$curso', '$idcurso')");
    if (!$consulta) {
      echo "no ok";
    } else {
      echo "ok";
    }
  }
  }

//delete curso
if (isset($_REQUEST['idclasew'])) {
  $id = $_POST['idclasew'];
  $consulta = mysqli_query($link, "DELETE FROM misclases WHERE usuario='$id'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok deletecurso";
  }
}


//insert curso
if (isset($_REQUEST['clavecurso'])) {

  $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
  $cad = "";
  for ($i = 0; $i < 11; $i++) {
    $cad .= substr($str, rand(0, 62), 1);
  }
  $user = $_POST['clavecurso'];
  $categoria = $_POST['clavvcategoria'];
  echo $user;
  $consulta = mysqli_query($link, "INSERT INTO clase VALUES(NULL, 'Nombre','$cad', '$user', '2021-09-30 00:00:00', 'foto' , '250', 'Descripción', 'Link video', '$categoria','Edite la tarea del curso', '2021-09-30 00:00:00', '02:00:00', 'Edite el examen del curso')");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok";
  }
}

//insert categoria
if (isset($_REQUEST['clavewc'])) {

  $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
  $cad = "";
  for ($i = 0; $i < 11; $i++) {
    $cad .= substr($str, rand(0, 62), 1);
  }
  $user = $_POST['clavewc'];
  $consulta = mysqli_query($link, "INSERT INTO categoria VALUES(NULL, 'Nombre','Descripcion','rgb(10,10,100)' , '$cad', '$user')");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok";
  }
}
  

//actualizar clase foto perfil
if (isset($_REQUEST['image'])) {
  $nombre = $_FILES['image']['name'];
  echo $nombre;
  $identificador = $_POST["image_id"];
  $query = mysqli_query($link, "UPDATE clase SET foto='$nombre' WHERE idclase =$identificador");
  $idarchivo = mysqli_insert_id($link);
  copy($_FILES['image']['tmp_name'], "archivos/" . $identificador . $nombre);
  if (!$query) {
    echo "no ok";
  } else {
    echo "ok";
  }
}

//actualizar clase foto
if (isset($_REQUEST['action'])) {
  $nombre = $_FILES['image']['name'];
  echo $nombre;
  $identificador = $_POST["image_id"];
  $idcurso = $_POST["wimage_id"];
  $query = mysqli_query($link, "UPDATE clase SET foto='$nombre' WHERE idclase =$identificador");
  $idarchivo = mysqli_insert_id($link);
  copy($_FILES['image']['tmp_name'], "archivoscrearclase/" . $idcurso . "_" . $identificador . "_" . $nombre);
  if (!$query) {
    echo "no ok";
  } else {
    echo "ok";
  }
}


//refresh categoria
if (isset($_REQUEST['wtextt'])) {
  $id = $_POST['widd'];
  $text = $_POST['wtextt'];
  $text = mysqli_real_escape_string($link, $text);
  $columna = $_POST['wcolumnn'];
  $consulta = mysqli_query($link, "UPDATE categoria SET $columna='$text' WHERE id =$id");
  if (!$consulta) {
    echo "wwzzz";
  } else {
    echo "zzz";
  }
}



//refresh cursos
if (isset($_REQUEST['text'])) {
  $id = $_POST['id'];
  $text = $_POST['text'];
  $text = mysqli_real_escape_string($link, $text);
  $columna = $_POST['column'];
  $consulta = mysqli_query($link, "UPDATE clase SET $columna='$text' WHERE idclase =$id");
  $consulta = mysqli_query($link, "UPDATE misclases SET $columna='$text' WHERE curso =$id");
  mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
  if (!$consulta) {
    echo "ww";
  } else {
    echo "zzz";
  }
}


//delete categoria
if (isset($_REQUEST['delet'])) {
  $id = $_POST['delet'];
  echo $id;
  $wr = mysqli_query($link, "SELECT * FROM clase WHERE idclase='$id'");
  //$wr=mysqli_num_rows($wr);
  $wrw = mysqli_fetch_assoc($wr);

  $consulta = mysqli_query($link, "DELETE FROM categoria WHERE id='$id'");
  $consulta = mysqli_query($link, "DELETE FROM clase WHERE categoria='$id'");
  $consulta = mysqli_query($link, "DELETE FROM misclases WHERE categoria='$id'");
  //array_map('unlink', glob('archivoscrearclase/'.$id.'*'));
  array_map('unlink', glob("archivoscrearclase/" . $id . "_*"));
  //unlink('archivoscrearclase/'.$id.'_*');
  //$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
  //$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
  //mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok delete";
  }
}


//delete curso
if (isset($_REQUEST['deletw'])) {
  $id = $_POST['deletw'];
  $idc = $_POST['idc'];
  $wr = mysqli_query($link, "SELECT * FROM clase WHERE idclase='$id'");
  //$wr=mysqli_num_rows($wr);
  $wrw = mysqli_fetch_assoc($wr);
  echo $wrw['foto'];
  //$consulta=mysqli_query($link, "DELETE FROM categoria WHERE clavv='$id'");
  $consulta = mysqli_query($link, "DELETE FROM clase WHERE idclase='$id'");
  $consulta = mysqli_query($link, "DELETE FROM misclases WHERE idcurso='$id'");
  unlink('archivoscrearclase/' . $idc . "_" . $id . "_" . $wrw['foto']);
  //$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
  //$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
  //mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok deletecurso";
  }
}

//delete mycurse
if (isset($_REQUEST['idclase'])) {
  $id = $_POST['idclase'];
  $consulta = mysqli_query($link, "DELETE FROM misclases WHERE idmiclase='$id'");
  if (!$consulta) {
    echo "no ok";
  } else {
    echo "ok delete";
  }
}

?>
<?php include('first.php')
?>

<!-- <script src="https://checkout.culqi.com/js/v3"></script> -->

<title>Inicio - Fisart</title>

<?php


if (isset($_REQUEST['jj'])) {
    $n = $_REQUEST['clase'];
    $f1 = $_FILES['gg']['name'];
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad = "";
    for ($i = 0; $i < 11; $i++) {
        $cad .= substr($str, rand(0, 62), 1);
    }
    $u = $w['idusuario'];
    $price = $_REQUEST['price'];
    $cont = $_REQUEST['descripcion'];
    $cont = mysqli_real_escape_string($link, $cont);
    $video = $_REQUEST['link'];
    mysqli_query($link, "INSERT INTO clase VALUES(NULL, '$n','$cad','$u', NULL , '$f1', '$price', '$cont', '$video')");
    mysqli_query($link, "UPDATE clase SET  link = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
    copy($_FILES['gg']['tmp_name'], "archivoscrearclase/" . $u . $f1);
}

if (isset($_REQUEST['e'])) {
    mysqli_query($link, "DELETE FROM clase WHERE clase.idclase=" . $_REQUEST['e']);
}

$con = mysqli_query($link, "SELECT * FROM clase WHERE usuario='" . $w['idusuario'] . "'");
$n = mysqli_num_rows($con);
$a = mysqli_fetch_assoc($con);
?>


<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Seleccionar Imagen
            </div>

            <div class="modal-body">

                <form id="image_form" method="post" enctype="multipart/form-data">


                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="hidden" name="image_id" id="image_id" />
                    <!--hidden-->
                    <input type="hidden" name="wimage_id" id="wimage_id" />
                    <!--hidden-->
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <script>
                    $(".custom-file-input").on("change", function() {
                        var fileName = $(this).val().split("\\").pop();
                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                    });
                    </script>

            </div>
            <div class="modal-footer">

                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-light " />
                </form>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    function obtener_inicio() {
        $.ajax({
            url: "inicioajax.php",
            method: "POST",
            success: function(data) {
                $("#resultadoinicio").html(data)
            }
        })
    }


    obtener_inicio();

    //INSERTAR curso
    $(document).on("click", "#curso", function() {
        var claves = "<?php echo $_SESSION['user'] ?>";
        var clavvcategoria = $(this).data("c1");
        //
        //alert(clavvcategoria);
        //alert(claves);
        $.ajax({
            url: "inicio.php",
            method: "post",
            data: {
                clavecurso: claves,
                clavvcategoria: clavvcategoria
            },
            success: function(data) {
                obtener_inicio();
                //   alert(data);
            }
        })
    })












    //1
    $(document).on("click", "#ww1", function() {
        if (confirm("Está seguro de unirte a este curso")) {
            var clavesww = "<?php echo $_SESSION['user'] ?>";
            var id = $(this).data("ww");
            //alert(id);
            $.ajax({
                url: "inicio.php",
                method: "post",
                data: {
                    clavesww: clavesww,
                    idcurse: id
                },
                success: function(data) {
                    obtener_inicio();
                    alert(data);
                }
            })
        }
    })

    //1
    $(document).on("click", "#ww1ww", function() {
        if (confirm("Está seguro de borrar su curso")) {
            var id = $(this).data("ww");
            //alert(id);
            $.ajax({
                url: "inicio.php",
                method: "post",
                data: {
                    idclase: id
                },
                success: function(data) {
                    obtener_inicio();
                    //   alert(data);
                }
            })
        }
    })




    //eliminar clase
    $(document).on("click", "#elcl", function() {
        if (confirm("Esta seguro de eliminar esta la clase a la que te uniste")) {
            var idclasew = "<?php echo $_SESSION['user'] ?>";
            $.ajax({
                url: "inicio.php",
                method: "post",
                data: {
                    idclasew: idclasew
                },
                success: function(data) {
                    obtener_inicio();
                    //   alert(data);
                }
            })
        };
    })





    //INSERTAR categoria
    $(document).on("click", "#categoria", function() {
        var claves = "<?php echo $_SESSION['user'] ?>";
        //alert(claves);
        $.ajax({
            url: "inicio.php",
            method: "post",
            data: {
                clavewc: claves
            },
            success: function(data) {
                obtener_inicio();
                //   alert(data);
            }
        })
    })

    //ACTUALIZAR categoria
    function actualizar_datoc(id, texto, columna) {
        $.ajax({
            url: "inicio.php",
            method: "post",
            data: {
                widd: id,
                wtextt: texto,
                wcolumnn: columna
            },
            success: function(data) {
                obtener_inicio();
                //   alert(data);
            }
        })
    }
    //ACTUALIZAR nombre
    $(document).on("blur", "#nombre", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_datoc(id, x1, "nombre")
    })
    //ACTUALIZAR descripcion
    $(document).on("blur", "#desc", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_datoc(id, x1, "descripcion")
    })
    //ACTUALIZAR color
    $(document).on("change", "#color", function() {
        var id = $(this).data("c1");
        var x1 = $(this).val();
        // alert(x1);
        // alert(id); 
        actualizar_datoc(id, x1, "color")
    })




    //ACTUALIZAR curso
    function actualizar_dato(id, texto, columna) {
        $.ajax({
            url: "inicio.php",
            method: "post",
            data: {
                id: id,
                text: texto,
                column: columna
            },
            success: function(data) {
                obtener_inicio();
                //   alert(data);
            }
        })
    }
    //ACTUALIZAR nombre
    $(document).on("blur", "#www", function() {
        var id = $(this).data("c1");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "nombre")
    })

    //ACTUALIZAR precio
    $(document).on("blur", "#cc2", function() {
        var id = $(this).data("c2");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "precio")
    })
    //ACTUALIZAR precio
    $(document).on("blur", "#cc3", function() {
        var id = $(this).data("c3");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "descripcion")
    })
    //ACTUALIZAR examen
    $(document).on("blur", "#cc1w", function() {
        var id = $(this).data("c3");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "examen")
    })
    //ACTUALIZAR fechaexa
    $(document).on("blur", "#www1", function() {
        var id = $(this).data("c3");
        var x1 = $(this).val();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "fechaexa")
    })
    //ACTUALIZAR timex
    $(document).on("blur", "#cc3w", function() {
        var id = $(this).data("c3");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "timex")
    })
    //ACTUALIZAR fecha tarea
    $(document).on("blur", "#cc5", function() {
        var id = $(this).data("c3");
        var x1 = $(this).text();
        // alert(x1);
        // alert(id);
        actualizar_dato(id, x1, "timex")
    })
    $(document).on("blur", "#ccc", function() {
        var id = $(this).data("cc");
        var x = $(this).text();
        var x1 = x.replace('https://www.youtube.com/watch?v=',
            'http://www.youtube.com/embed/');
        //alert(x1);
        //alert(id);
        actualizar_dato(id, x1, "link")
    })

    //////////////////////////////////////////

    obtener_inicio();




    $('#image_form').submit(function(event) {
        event.preventDefault();
        var image_name = $('#image').val();
        if (image_name == '') {
            alert("Please Select Image");
            return false;

        } else {
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#image').val('');
                return false;
            } else {

                $.ajax({
                    url: "inicio.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //     alert(data);
                        obtener_inicio();
                        $('#image_form')[0].reset();
                        $('#imageModal').modal('hide');
                    }

                });
            }
        }

    });

    $(document).on('click', '.update', function() {
        $('#image_id').val($(this).attr("id"));
        $('#wimage_id').val($(this).data("id"));
        $('#action').val("update");
        $('.modal-title').text("Actualizar imágen");
        $('#insert').val("Actualizar");
        $('#imageModal').modal("show");
    });

    $(document).on('click', '.image', function() {
        $('#image_id').val($(this).attr("id"));
        $('#action').val("image");
        $('.modal-title').text("Actualizar imágen");
        $('#insert').val("Actualizar");
        $('#imageModal').modal("show");
    });


    //ELIMINAR categoria
    $(document).on("click", "#delete", function() {
        if (confirm("Esta seguro de eliminar esta categoria")) {
            var idw = $(this).data("c1");
            //   alert(idw);
            //  alert(idw);
            $.ajax({
                url: "inicio.php",
                method: "post",
                data: {
                    delet: idw
                },
                success: function(data) {
                    obtener_inicio();
                }
            })
        };
    })

    //ELIMINAR CURSO
    $(document).on("click", "#deletecurso", function() {
        if (confirm("Esta seguro de eliminar esta categoria")) {
            var idw = $(this).data("c1");
            var idc = $(this).data("cc1");
            //   alert(idw);
            //   alert(idw);
            $.ajax({
                url: "inicio.php",
                method: "post",
                data: {
                    deletw: idw,
                    idc: idc
                },
                success: function(data) {
                    obtener_inicio();
                    //   alert(data);
                }
            })
        };
    })



});
</script>


<div id="resultadoinicio"></div>













<!--Culqi-->



<script>
Culqi.publicKey = 'pk_test_18d083b191518652';
$(document).on('click', '.buyButtonw', function() {
    //  $('.buyButtonw').on('click', function(e) {

    producto = $(this).attr('data-producto');
    precio = $(this).attr('data-precio');
    user = $(this).attr('user');
    clave = $(this).attr('clave');
    categoria = $(this).attr('categoria');
    curso = $(this).attr('curso');
    id = $(this).attr('id');

    Culqi.settings({
        title: producto,
        currency: 'PEN',
        description: producto,
        amount: precio
    });

    // Abre el formulario con la configuración en Culqi.settings
    Culqi.open();
    e.preventDefault();
});




function culqi() {
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var email = Culqi.token.email;

        var data = {
            producto: producto,
            precio: precio,
            token: token,
            email: email,
            clave: clave,
            categoria: categoria,
            curso: curso,
            id: id
        };

        var url = "proceso.php";

        //$.ajax({
        //url:"cul.php",
        //method:"post", 
        //data:data,
        //success:function(data){
        //obtener_inicio();
        ////   alert(data);
        //}})

        $.post(url, data, function(resw) {
            if (resw.trim() === "exitoso") {
                alert(
                        'Tu pago fue exitoso. Agradecemos tu preferencia. Si es necesario, actualice la página para cargar su curso a su listado.'
                    ) ?
                    "" : location.reload();

                var httpr = new XMLHttpRequest();
                httpr.open("POST", "./cul.php", true);
                httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpr.send("user=" + user + "&clave=" + clave + "&categoria=" + categoria +
                    "&curso=" + curso +
                    "&id=" + id);

            } else {
                alert("No se logró realizar el pago.");

            }
        });

    } else { // ¡Hubo algún problema!
        // Mostramos JSON de objeto error en consola
        console.log(Culqi.error);
        alert(Culqi.error.user_message);
    }
};
</script>




















<script>
function Send_Data() {

    var user = document.getElementById("user").value;
    var clave = document.getElementById("clave").value;

    var httpr = new XMLHttpRequest();
    httpr.open("POST", "./cul.php", true);
    httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpr.send("user=" + user + " & clave=" + clave);
}
</script>

<!--  
<div class="form">
    <input type="text" name="user" id="user" placeholder="usuario" required><br>
    <input type="text" name="clave" id="clave" placeholder="Clave de la clase" required><br>
   <input type="submit" value="Unirse a clase" onclick="Send_Data()"><br>
<span id="response"></span>

</div>
-->






















<?php //include('footer.php'); ?>