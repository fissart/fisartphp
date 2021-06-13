<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="w.ico">
<link rel="stylesheet" href="font-awesome.min.css">

<!-- CSS only -->
<link rel="stylesheet" href="css/css/bootstrap.css">

<!-- JS, Popper.js, and jQuery -->
<script src="jsboots/jquery-3.2.1.js" crossorigin="anonymous"></script>

<script src="popper.min.js">
</script>
<script src="css/js/bootstrap.min.js">
</script>

<!--
<style>
.card, .btn, .form-control { border-radius: 0; }
</style>

<style>
* {
    margin: 0;
    font-family: 'Merriweather', serif;
    box-sizing: border-box;
    font-weight: 500;
}
.card, .btn, .form-control { border-radius: 0; }

</style>
    first
    margin
    index
-->


<?php $user = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario='" . $_SESSION['user'] . "'");
    $w = mysqli_fetch_assoc($user);?>

<div class='container'>
    <div class='container'>

        <nav class="navbar smart-scroll navbar-expand-lg navbar-light bg-light border py-1">

            <a class="navbar-brand" href="inicio.php">
            <?php echo "<div style='width:35px;height:35px;overflow:hidden;border-radius:50%;position:relative;  object-fit:cover;'>
                <img class='rounded-circle' style='width:35px;height:35px;overflow:hidden;border-radius:50%;position:relative;  object-fit:cover;' 
                src='http://res.cloudinary.com/ciencias/image/upload/".$w["foto"]."' onerror=this.src='foto.png'></div>";?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="inicio.php?cerrar=1">Cerrar sesión</a></li>
                </ul>
            </div> <!-- navbar-collapse.// -->
        </nav>

    </div>
</div>



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