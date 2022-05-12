<?php
require 'BD/ConectorBD.php';
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
<?php include 'partes/nav.php'; ?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <?php
    if (empty($_SESSION['usuario'])) {
        header('Location: principal.php');
    }
                $fecha = date("Y-m-d H:i:00",time());
                $baneo = $_SESSION['banner'];
        if ($fecha<$baneo || $_SESSION['perBanned']==1) {
            header('Location: principal.php');
        }
    if ($_POST['verHilo']) {
        $_SESSION['verHilo']=$_POST['idHilo'];
    }
    if (isset($_SESSION['verHilo'])) {
        $te=consultaTemaHilo($conexion,$_SESSION['verHilo']);
        $tema=mysqli_fetch_assoc($te);
        ?>


    <div class="row">
        <h1 class="text-center col-12 titulo mt-2" class="col-12 text-center">Articulos de <?php echo $tema['tema']; ?></h1>
    <! ––Para las tarjetas con los hilos que va a tener nuestra pagina–>
       
            <?php
                $articulos=articulosPorIdHilo($conexion,$_SESSION['verHilo']);
                while($articulo = mysqli_fetch_assoc($articulos)){
                    $fechaHoy = date("Y-m-d H:i:s");
                    //Usuario con suscripcion activa cuando no este eliminado
                    if ($_SESSION['fechaSuscripcion']>$fechaHoy && $articulo['estado']!="eliminado" && $_SESSION['Rol']=="usuario") {
                       //Se muestra completo
            ?>
                    <div class="card tarjetas col-lg-11 col-xl-5  p-3 m-5 text-center">
                        <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                                <div class="col-12">
                                <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                                </div>
                                <form action="articulo.php" method="post">
                                        <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                        <input type="submit" class="btn boton col-12 mt-2" value="Ver" name="verArticulo">
                                </form>
                        </div>
                    </div>
                    <?php
                    //Usuario sin suscripción en articulos premium
                    }elseif (($articulo['premium'] && $_SESSION['fechaSuscripcion']<$fechaHoy && $articulo['estado']!="eliminado" && $_SESSION['Rol']=="usuario")) {
                    //Se le muestra difuminado
                    ?>
                    <div class="card tarjetas col-lg-11 col-xl-5  p-3 m-5 text-center" >
                        <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap" style="filter: blur(5px);">
                        <div class="card-body" style="filter: blur(5px);">
                            <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                            <p><?php echo $articulo['estado']; ?></p>
                                <div class="col-12">
                                <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                        </div>
                        <form action="articulo.php" method="post">
                            <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                            <input type="submit" class="btn boton col-12 mt-2" value="Ver" name="verArticulo">
                        </form>
                    </div>  
                            </div>
                                        <?php
                                        //articulos no premium para usuarios sin suscripción
                        
                        //Usuario sin loguear
                        }elseif (empty($_SESSION['dni'])) {
                            //Se le muestra difuminado
                            ?>
                            <div class="card tarjetas col-lg-11 col-xl-5  p-3 m-5 text-center" >
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap" style="filter: blur(5px);">
                                <div class="card-body" style="filter: blur(5px);">
                                    <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                                    <p><?php echo $articulo['estado']; ?></p>
                                        <div class="col-12">
                                        <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                                        </div>
                                </div>
                                
                            </div>
                                        <?php
                                        //articulos no premium para usuarios sin suscripción
                        }elseif (!$articulo['premium'] && $_SESSION['fechaSuscripcion']<$fechaHoy && $articulo['estado']!="eliminado" && $_SESSION['Rol']=="usuario") {
                            //Se muestra la tarjeta con sus detalles
                            ?>
                            <div class="card tarjetas col-lg-11 col-xl-5  p-3 m-5 text-center" style="background-color: rgba(0, 0, 0, .5);">
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                                        <div class="col-12">
                                        <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                                        </div>
                                        <form action="articulo.php" method="post">
                                                <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="submit" class="btn boton col-12 mt-2" value="Ver" name="verArticulo">
                                        </form>
                                </div>
                                
                            </div>
                                        <?php
                                        //administrador articulos marcados como eliminados
                        }elseif ($_SESSION['Rol']=="adminnistrador" && $articulo['estado']=="eliminado") {
                            ?>
                            <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center" style="background-color: rgba(0, 0, 0, .5);">
                            
                                <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                                        <div class="col-12">
                                        <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                                        </div>
                                        <form action="articulo.php" method="post">
                                                <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                                <input type="submit" class="btn boton col-12 mt-2" value="Ver" name="verArticulo">
                                        </form>
                            
                                
                                        <p class="botonElim"> Marcado como <?php echo $articulo['estado']; ?></p>
                                
                                </div>
                                
                            </div>
                                        <?php
                                        //administrador articulos no marcados como eliminados
                        }elseif ($_SESSION['Rol']=="adminnistrador" && $articulo['estado']!="eliminado") {
                ?>
                <div class="card tarjetas bg-dark col-lg-11 col-xl-5  p-3 m-5 text-center" style="background-color: rgba(0, 0, 0, .5);">
                
                    <img class="card-img-top" src="<?php echo $articulo['imagenArticulo']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="display-4"><?php echo $articulo['cabecera']; ?></h5>
                            <div class="col-12">
                            <p class="elipsis"><?php echo $articulo['cuerpo']; ?></p>
                            </div>
                            <form action="articulo.php" method="post">
                                    <input type="hidden" name="idArticulo" value="<?php echo $articulo['idArticulo']; ?>">
                                    <input type="submit" class="btn boton col-12 mt-2" value="Ver" name="verArticulo">
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
            echo "<p>Se comento correctamente</p>";
        }else{
            echo "<p>No se consiguio comentar intentelo de nuevo</p>";
        }
    }
   
    if (isset($_POST['responderComentario'])) {
        $fecha_actual = date("Y-m-d H:i:s");
        echo $_POST['contenido']." -".$_SESSION['idUsuario']." -".$_POST['idComen']." -".$fecha_actual." -".$_SESSION['idVerArticulo'];
        //responderAComentario($conexion,$contenido,$idUsuario,$idRespuesta,$fecha,$idArticulo)
        $respuesComentario=responderAComentario($conexion,$_POST['contenido'],$_SESSION['idUsuario'],$_POST['idComen'],$fecha_actual,$_SESSION['idVerArticulo']);
        if ($respuesComentario) {
            echo "<p>Se comento correctamente</p>";
            header('Location: articulo.php');
        }else{
            echo "<p>No se consiguio comentar intentelo de nuevo</p>";
        }
    }
    
            ?>
</div>
<?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>