
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
<?php include 'partes/nav.php'; 
if ($_SESSION['Rol']!="adminnistrador") {
    header('Location: principal.php');
}
?>

<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <div class="row forms">
    <?php
if ($_SESSION['Rol']!="adminnistrador") {
    header('Location: cerrarSesion.php');
}
        if (isset($_POST['moderador'])) {
            $_SESSION['comenModerar']=$_POST['idComent'];
        }
            $consulModera=comentarioModeracion($conexion,$_SESSION['comenModerar']);
            if (mysqli_num_rows($consulModera)>0) {
                $moderador=mysqli_fetch_assoc($consulModera)   
            
            
            ?>
        <div class="col-12"> 
            <div class="col-12">
                <h5 class="col-5"><?php echo $moderador['usuario']; ?></h5>
                <small class="float col-2 mr-3"><?php $fecha = new DateTime($moderador['fecha']); echo date_format($fecha,"d/m/Y H:i"); ?></small>
            </div>
            <form action="panelModeracion.php" method="post" class="ml-3 col-12"> 
                    <input type="hidden" name="idComen" value="<?php echo $moderador['idComentario']; ?>">
                    <input type="text" name="contenido" class="col-12" value="<?php echo $moderador['contenido']; ?>">
                    <input type="submit" value="Modificar" name="modificarComen" class="boton col-12">
            </form>
            
            <hr>
            <h3 class="col-12">¿Eliminar comentario?</h3>
            <form method="post" class="ml-3 col-12"> 
                    <input type="submit" value="Eliminar" name="eliminarComentar" class="botonElim col-12">
            </form>
            <?php
if ($moderador['idUsuario']!=$_SESSION['idUsuario']) {
    

            ?>
            <hr>
            <h3 class="col-12">¿Bannear a <?php echo $moderador['usuario']; ?> ?</h3>
            <?php
            if ($moderador['usuario']!=$_SESSION['usuario']) {
            ?>
            
            <form method="post" class="ml-3 col-12"> 
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <input type="radio" class="form-check-input" name="bannear" id="" value="0">
                <label class="form-check-label" for="check">
                    permanente: 
                </label>
                </div>
                <div class="form-check">
                <input type="radio" name="bannear" class="form-check-input" id="fecha" value="1" onchange="javascript:showContent()">
                <label class="form-check-label" for="check">
                    Hasta fecha: 
                </label>
                <div id="content" style="">
                <?php $fechaymd = date("Y-m-d"); $fechahis = date("H:i");?>
                        <input type="datetime-local" class="" min="<?php echo $fechaymd."T".$fechahis; ?>" name="fechaBaneo" id="">
                </div>
            </div>
                   
                    <input type="submit" value="Banear" name="banneado" class="boton col-12 mb-2">
            </form>
       
       
            <?php
        }

}else {
    ?>
<h4 class="col-12"><?php echo $moderador['usuario']; ?> Es su usuario no lo puede banear</h4>
    <?php
}
            ?>
            <?php
if (isset($_POST['banneado'])) {
    if ($_POST['bannear']==0) {
        $bannear=modificarUsuario($conexion,$moderador['idUsuario'],"perBanned",1);
        $bannear1=modificarUsuario($conexion,$moderador['idUsuario'],"banner","null");
        if ($bannear && $bannear1) {
            ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">Se banneo correctamente el usuario <?php echo $moderador['usuario']; ?></h1>
                            <hr class="my-4">
                            <p>Para volver al articulo</p>
                            <a class="enlaceContra col-12" href="articulo.php" role="button">Volver al Post</a>
                        </div>
            <?php
        }
    }else{
        
        $fecha = date("Y-m-d H:i:s", strtotime($_POST['fechaBaneo']));
        $bannear2=modificarUsuario($conexion,$moderador['idUsuario'],"perBanned",0);
        echo $fecha;
        $bannear3=modificarUsuario($conexion,$moderador['idUsuario'],"banner","$fecha");
        if ($bannear3 && $bannear2) {
            ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">Se banneo correctamente el usuario <?php echo $moderador['usuario']; ?> hasta</h1>
                            <hr class="my-4">
                            <p>Para volver al articulo</p>
                            <a class="enlaceContra col-12" href="articulo.php" role="button">Volver al Post</a>
                        </div>
            <?php
        }
    }
    
}
            ?>

            <?php
            }
            if (isset($_POST['eliminarComentar'])) {
                $resulElim=eliminarComentario($conexion,$_SESSION['comenModerar']);
                if ($resulElim) {
                    ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">Se eliminó correctamente</h1>
                            <hr class="my-4">
                            <p>Para volver al articulo</p>
                            <a class="enlaceContra col-12" href="articulo.php" role="button">Volver al Post</a>
                        </div>
                    <?php
                }else {
                    ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">No se consigió eliminar intentelo de nuevo</h1>
                            <hr class="my-4">
                            <p>Para volver al articulo</p>
                            <a class="enlaceContra col-12" href="adminComentarios.php" role="button">Volver al Post</a>
                        </div>
                    <?php
                }
            }
            
if (isset($_POST['modificarComen'])) {
    $resulModiComentario=modificarComentario($conexion,$_POST['idComen'],$_POST['contenido']);
    if ($resulModiComentario) {
    ?>
        <div class="col-12 mb-2">
            <h1 class="display-5">Se modifico correctamente</h1>
            <p class="lead">El contenido del comentario tras el cambio es: <?php echo $_POST['contenido']; ?></p>
            <hr class="my-4">
            <p>Para volver al articulo</p>
            <a class="enlaceContra col-12" href="articulo.php" role="button">Volver al Post</a>
        </div>
    <?php
    }else {
    ?>
        <div class="col-12 mb-2">
            <h1 class="display-5">Hubó un error al modificar</h1>
            <p class="lead">No se consigio modificar intentelo de nuevo</p>
            <hr class="my-4">
            <p>Para volver al articulo</p>
            <a class="enlaceContra col-12" href="articulo.php" role="button">Volver al Post</a>
        </div>
    <?php
    }
}
        ?>
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