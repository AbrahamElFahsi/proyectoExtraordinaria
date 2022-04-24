<?php
require 'ConectorBD.php';
require 'BD/DAOArticulo.php';
require 'BD/DAOHilo.php';
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
<?php include 'nav.php'; ?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <?php
    if ($_POST['verHilo']) {
        $_SESSION['verHilo']=$_POST['idHilo'];
    }
    if (isset($_SESSION['verHilo'])) {
        $te=consultaTemaHilo($conexion,$_SESSION['verHilo']);
        $tema=mysqli_fetch_assoc($te);
        ?>


    <div class="row">
        <h1 class="text-center col-12" class="col-12 text-center">Articulos de <?php echo $tema['tema']; ?></h1>
    <! ––Para las tarjetas con los hilos que va a tener nuestra pagina–>
       
<?php
                $articulos=articulosPorIdHilo($conexion,$_SESSION['verHilo']);
                    while($articulo = mysqli_fetch_assoc($articulos)){
                        $fechaHoy = date("Y-m-d H:i:s");
                        if ($_SESSION['fechaSuscripcion']>$fechaHoy && $articulo['estado']!="eliminado") {
                           
                            ?>
                <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center">
                    <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $articulo['cabecera']; ?></h5>
                            <div id="elipsis">
                            <?php echo $articulo['cuerpo']; ?>
                            </div>
                            <form action="articulo.php" method="post">
                                    <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                    <input type="submit" class="btn boton mt-2" value="Mostrar Informacion" name="verArticulo">
                            </form>
                    </div>
                    
                </div>
                            <?php
                        }elseif ($articulo['premium'] && $_SESSION['fechaSuscripcion']<$fechaHoy && $articulo['estado']!="eliminado") {
                            ?>
                            <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center" >
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap" style="filter: blur(5px);">
                                <div class="card-body" style="filter: blur(5px);">
                                    <h5 class="card-title"><?php echo $articulo['cabecera']; ?></h5>
                                    <p><?php echo $articulo['estado']; ?></p>
                                        <div id="elipsis">
                                        <?php echo $articulo['cuerpo']; ?>
                                        </div>
                                </div>
                                
                            </div>
                                        <?php
                        }elseif (!$articulo['premium'] && $_SESSION['fechaSuscripcion']<$fechaHoy && $articulo['estado']!="eliminado") {
                            ?>
                            <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center" style="background-color: rgba(0, 0, 0, .5);">
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $articulo['cabecera']; ?></h5>
                                        <div id="elipsis">
                                        <?php echo $articulo['cuerpo']; ?>
                                        </div>
                                        <form action="articulo.php" method="post">
                                                <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="submit" class="btn boton mt-2" value="Mostrar Informacion" name="verArticulo">
                                        </form>
                                </div>
                                
                            </div>
                                        <?php
                        }elseif ($_SESSION['Rol']=="adminnistrador" && $articulo['estado']="eliminado") {
                            ?>
                            <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center" style="background-color: rgba(0, 0, 0, .5);">
                            <p class="bg-danger"> Marcado como <?php echo $articulo['estado']; ?></p>
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $articulo['cabecera']; ?></h5>
                                        <div id="elipsis">
                                        <?php echo $articulo['cuerpo']; ?>
                                        </div>
                                        <form action="articulo.php" method="post">
                                                <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="submit" class="btn boton mt-2" value="Mostrar Informacion" name="verArticulo">
                                        </form>
                                </div>
                                
                            </div>
                                        <?php
                        }
                ?>
                
                        <?php } ?>
        
    </div>
    <?php
    }else{
        header('Location: principal.php');
    }
   
    if (isset($_POST['comentarNivelOne'])) {
        $fechaactual = date("Y-m-d H:i:s");
        echo $_POST['comentario']." -".$_SESSION['idUsuario']." -".$_POST['idComen']." -".$fechaactual." -".$_SESSION['idVerArticulo'];
        //responderAComentario($conexion,$contenido,$idUsuario,$idRespuesta,$fecha,$idArticulo)
        $respuesComentario=responderAComentario($conexion,$_POST['comentario'],$_SESSION['idUsuario'],"0",$fechaactual,$_SESSION['idVerArticulo']);
        if ($respuesComentario) {
            header('Location: articulo.php');
            echo "Se comento correctamente";
        }else{
            echo "No se consiguio comentar intentelo de nuevo";
        }
    }
   
    if (isset($_POST['responderComentario'])) {
        $fecha_actual = date("Y-m-d H:i:s");
        echo $_POST['contenido']." -".$_SESSION['idUsuario']." -".$_POST['idComen']." -".$fecha_actual." -".$_SESSION['idVerArticulo'];
        //responderAComentario($conexion,$contenido,$idUsuario,$idRespuesta,$fecha,$idArticulo)
        $respuesComentario=responderAComentario($conexion,$_POST['contenido'],$_SESSION['idUsuario'],$_POST['idComen'],$fecha_actual,$_SESSION['idVerArticulo']);
        if ($respuesComentario) {
            echo "Se comento correctamente";
            header('Location: articulo.php');
        }else{
            echo "No se consiguio comentar intentelo de nuevo";
        }
    }
    
            ?>
</div>
<?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>