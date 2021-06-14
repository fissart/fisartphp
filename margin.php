<?php

require('conect.php');

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

$conz = mysqli_query($link, "SELECT clase.nombre FROM clase WHERE clave='" . $_SESSION['clave'] . "'");
$zz = mysqli_fetch_assoc($conz);

$conzw = mysqli_query($link, "SELECT * FROM capitulo WHERE clave='" . $_SESSION['clave'] . "'");
$zzw = mysqli_fetch_assoc($conzw);

?>

<link rel="shortcut icon" type="image/x-icon" href="w.ico">
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<link rel="stylesheet" href="Css/css/bootstrap.css">

<script src="Css/jquery-3.0.0.min.js" crossorigin="anonymous"></script>

<script src="Css/popper.min.js"></script>
<script src="Css/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="Css/style.css">

<link rel="stylesheet" href="Css/richtext.min.css">
<script type="text/javascript" src="Css/jquery.richtext.js"></script>

<link rel="stylesheet" href="Css/TimeCirclesday.css">
<script type="text/javascript" src="Css/TimeCirclesday.js"></script>
<link rel="stylesheet" href="Css/font-awesome.min.css">

<!-- 
<link href="Css/css/bootstrap.min.css">
<script src="Css/jquery-3.0.0.min.js"></script>
<script src="Css/js/bootstrap.min.js"></script>


<style>
/* .card,
.btn,
.form-control {
    border-radius: 0;
}
*/
</style>
-->
<style>
.componentWrapper {
    position: absolute;
    top: 0%;
    left: 50%;
    width: 95%;
    transform: translate(-50%, -50%);
}

.componentWrapperbottom {
    position: absolute;
    top: 100%;
    left: 50%;
    width: 95%;
    transform: translate(-50%, -50%);
}

.color {
    background-color: white;
}

.componentWrapperbutton {
    position: absolute;
    top: 0%;
    left: 50%;
    transform: translate(-50%, -50%);
}

[data-title] {
    outline: red dotted 1px;
    /*optional styling*/
    font-size: 30px;
    /*optional styling*/

    position: relative;
    cursor: help;
}

[data-title]:hover::before {
    content: attr(data-title);
    position: absolute;
    bottom: 32px;
    display: inline-block;
    padding: 3px 6px;
    border-radius: 2px;
    background: rgb(29, 167, 160);
    color: rgb(255, 255, 255);
    font-size: 12px;
    border-radius: 0.5em;
    white-space: nowrap;
}

[data-title]:hover::after {
    content: "";
    position: absolute;
    bottom: 15px;
    left: 18%;
    display: inline-block;
    color: #fff;
    border: 8px solid transparent;
    border-top: 10px solid rgb(29, 167, 160);
}
</style>
<!--
    first
    margin
    index
-->


<?php $user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
    $w = mysqli_fetch_assoc($user);?>


<nav class="navbar smart-scroll navbar-expand-lg navbar-light bg-light border py-1">

    <a class="navbar-brand" href="inicio.php">
        <img class='rounded-circle border'
            style="width:35px;height:35px;overflow:hidden;border-radius:50%;position:relative;object-fit:cover"
            src='http://res.cloudinary.com/ciencias/image/upload/<?php echo $w["foto"];?>' onerror=this.src='foto.png'>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link <?php if($r==1){echo "active";}?>"
                    href="capitulo.php?clave=<?php echo $_SESSION['clave']; ?>">Curso</a></li>
            <li class="nav-item"><a class="nav-link <?php if($r==2){echo "active";}?>"
                    href="participantes.php">Integrantes</a></li>
            <li class="nav-item"><a class="nav-link <?php if($r==3){echo "active";}?>" href="foro.php">Foro</a></li>
            <!-- <li class="nav-item"><a class="nav-link <?php if($r==4){echo "active";}?>" href="messages.php">Chat</a></li>
            <li class="nav-item"><a class="nav-link <?php if($r==5){echo "active";}?>" href="calendario.php">Agenda</a> 
            </li>
            -->
            <li class="nav-item"><a class="nav-link <?php if($r==6){echo "active";}?>"
                    href="<?php if ($w['tipo'] == "docente"){echo "calificacionesnames.php";}else{echo "calificaciones.php?estudiante=".$_SESSION["user"]."&cc=".$_SESSION["user"];}?>">Calificaciones</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="inicio.php?cerrar=1">Cerrar sesión</a></li>
        </ul>
    </div> <!-- navbar-collapse.// -->
</nav>





<script>
$('body').css('padding-top', $('.navbar').outerHeight() + 'px')

// detect scroll top or down
if ($('.smart-scroll').length > 0) { // check if element exists
    var last_scroll_top = 0;
    $(window).on('scroll', function() {
        scroll_top = $(this).scrollTop();
        if (scroll_top < last_scroll_top) {
            $('.smart-scroll').removeClass('scrolled-down').addClass('scrolled-up');
        } else {
            $('.smart-scroll').removeClass('scrolled-up').addClass('scrolled-down');
        }
        last_scroll_top = scroll_top;
    });
}
</script>

<style>
.smart-scroll {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
}

.scrolled-down {
    transform: translateY(-100%);
    transition: all 0.3s ease-in-out;
}

.scrolled-up {
    transform: translateY(0);
    transition: all 0.3s ease-in-out;
}

body {
    margin: 0;
    margin-top: 0px;
    background-color: #fff;
    padding: 0px;
</style>