<?php
require 'BD/ConectorBD.php';
require 'BD/DAOHilo.php';
require 'BD/DAOArticulo.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php   include 'partes/nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
    ?>
<div class="container forms">
<?php
 if (isset($_POST['eliminarArticulo'])) {
     $_SESSION['idArticuloElimninar']=$_POST['idArticuloElim'];
 }
?>
    <div class="row"><h1 class="text-center col-12">Eliminar usuario</h1></div>
    <div class="row">
        <div class="col-12 jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">¿Esta seguro?</h1>
                
                <a href="adminArticulo.php" class="mb-1 col-11 mx-auto boton" role="button">Volver al administrador de articulos</a>
                <hr>
                <h3>Con este paso se eliminara permanente mente</h3>
                <form action="eliminarArticulo.php" method="POST">
                    <input type="submit" value="Eliminar Articulo" class="btn mb-1 col-11 mx-auto botonElim" name="EliminarArticulo">
                </form>
                <?php
                if (isset($_POST['EliminarArticulo'])) {
                    $resultadoEliminar=eliminarArticulo($conexion,$_SESSION['idArticuloElimninar']);
                    if ($resultadoEliminar) {
                        ?>
                        <p class="lead">Se elimino correctamente</p>
                        <?php
                    }else {
                        ?>
                        <p class="lead">No se consigio, Intentelo de nuevo</p>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>