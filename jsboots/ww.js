$(function (e) {
    //Agregar sección
    $(document).on("blur", "#w", (e) => {
        //        var claves = "<?php echo $_SESSION['clave']?>";
        var id = $('#w').val();
        e.preventDefault();
        alert(id);
        //console.log('wwwwww');
        $.ajax({
            url: "/",
            method: "post",
            data: { id: id },
            success: (data) => {
                console.log(data);

                //   alert(data);
            }
        })
    })

})