<?php
require 'BD/ConectorBD.php';
require 'BD/DAOHilo.php';
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
    
</head>
<body>
<?php   include 'partes/nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
    ?>
<div class="container forms">
<?php
 if (isset($_POST['eliminarHilo'])) {
     $_SESSION['hiloElim']=$_POST['idHiloElim'];
 }
?>
    <div class="row"><h1 class="text-center col-12">Eliminar usuario</h1></div>
    <div class="row">
        <div class="col-12 jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">¿Esta seguro?</h1>
                <a href="adminHilo.php" class="mb-1 col-11 mx-auto boton" role="button">Volver al administrador de hilos</a>
                <p class="lead">Eliminar junto a todos sus articulo tambien</p>
                <form action="eliminarHilo.php" method="POST">
                    <input type="submit" value="Eliminar Hilo articulos" class="mb-1 col-11 mx-auto botonElim" name="EliminarHiloArticulo">
                </form>
                <?php
                if (isset($_POST['EliminarHiloArticulo'])) {
                    $consultaHilo=consultaHilosPorId($conexion,$_SESSION['hiloElim']);
                    $HiloEliminar=mysqli_fetch_assoc($consultaHilo);
                    $_SESSION['imagenElim']=$HiloEliminar['image'];
                    $resultadoEliminar=eliminarHilosArticulos($conexion,$_SESSION['hiloElim']);
                    if ($resultadoEliminar) {
                        unlink($_SESSION['imagenElim']);
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
                <?php
                    

                        $hilosCambio=consultaHilos($conexion);
                                ?>
                <hr class="my-4">
                
                <p class="lead">Cambiar articulos de hilo</p>
                <form action="eliminarHilo.php" method="POST">
                    <label for="nuevoHilo">Asignar articulos a</label>
                    <select name="hiloNuevo" id="hiloNuevo">
                        <?php
                            while ($hilos=mysqli_fetch_assoc($hilosCambio)) {
                                if ($hilos['idHilo']!=$_SESSION['hiloElim']) {   
                                    ?>
                                    <option value="<?php echo $hilos['idHilo']; ?>"><?php echo $hilos['idHilo']."-".$hilos['tema']; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <input type="submit" value="Eliminar Hilo cambiando articulos" class="mb-1 col-11 mx-auto botonElim" name="eliminarHiloCambio">
                </form>
                <?php


                if (isset($_POST['eliminarHiloCambio'])) {
                    $resulEliminarHilo=eliminarHiloConCambioDeArticulos($conexion,$_SESSION['hiloElim'],$_POST['hiloNuevo']);
                    if ($resulEliminarHilo) {
                        echo "Se modifico el hilo de los articulos de la seccion de id".$_SESSION['hiloElim']." y se elimino el hilo";
                    }else{
                        echo "No se consigio intentelo de nuevo";
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