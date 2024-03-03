<div class="index-form text-center">
    <h3>SUSCRIBE TO OUR NEWSLETTER </h3>
    <h5>Suscribe to receive our News and Gifts</h5>
    <form class="form-horizontal" action="newsletterController.php" method="post">
        <div class="form-group">
            <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                <input class="form-control" type="text" placeholder="Type here your email address" name="email">
                <!-- <a href="" class="btn btn-lg sr-button">SUBSCRIBE</a> -->
                <button type="submit" class="btn btn-lg sr-button">SUBSCRIBE</button>
            </div>
        </div>
    </form>
    <?php if (isset($_GET["suscrito"]) && $_GET["suscrito"] == "true") { ?>
        <p style="color: white;">Suscripción realizada correctamente</p>
    <?php } else if (isset($_GET["error"])) {
        $error = "Error al suscribirse.";

        if ($_GET["error"] == "yaSuscrito")
            $error = "Error: ya estabas suscrito.";
        else if ($_GET["error"] == "errorBaseDatos")
            $error = "Error en la base de datos.";
        else if ($_GET["error"] == "correoNoValido")
            $error = "El correo introducido no es válido.";
    }
    echo "<p style='color: lightsalmon;'>$error</p>"
    ?>
</div>