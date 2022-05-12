<?php
require 'BD/ConectorBD.php';
require 'BD/DAOArticulo.php';
require 'BD/DAOHilo.php';
require 'BD/DAOUsuario.php';
require 'BD/DAOComentarios.php';
$conexion=conectar(false);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'partes/nav.php'; ?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <div class="row forms">
        <?php
if (isset($_POST['modificarComen'])) {
    $resulModiComentario=modificarComentario($conexion,$_POST['idComen'],$_POST['contenido']);
    if ($resulModiComentario) {
    ?>
        <div class="col-12">
            <h1 class="display-5">Se modifico correctamente</h1>
            <p class="lead">El contenido del comentario tras el cambio es: <?php echo $_POST['contenido']; ?></p>
            <hr class="my-4">
            <p>Para volver al articulo</p>
            <a class="boton mb-2 col-12" href="articulo.php" role="button">Volver al Post</a>
        </div>
    <?php
    }else {
    ?>
        <div class="col-12">
            <h1 class="display-5">Hubó un error al modificar</h1>
            <p class="lead">No se consigio modificar intentelo de nuevo</p>
            <hr class="my-4">
            <p>Para volver al articulo</p>
            <a class="btn boton btn-lg" href="articulo.php" role="button">Volver al Post</a>
        </div>
    <?php
    }
}
        ?>
    </div>
</div>
<?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>