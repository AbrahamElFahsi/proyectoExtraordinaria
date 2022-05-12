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
    <title>Administrador articulos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php   include 'partes/nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
    ?>
    <div class="container-fluid forms">
        <div class="row"><h1 class="text-center col-12">Panel de administrador de Articulo</h1></div>
            <div class="row">  
                <table class="table table-responsive table-striped col-12">
                    <thead>
                        <tr>
                        <th scope="col"><p>Id ARTICULO</p></th>
                        <th scope="col"><p>Cabecera</p></th>
                        <th scope="col"><p>cuerpo</p></th>
                        <th scope="col"><p>pie</p></th>
                        <th scope="col"><p>Usuario creador</p></th>
                        <th scope="col"><p>Imagen del articulo</p></th>
                        <th scope="col"><p>idHilo</p></th>
                        <th scope="col"><p>tema</p></th>
                        <th scope="col"><p>Imagen hilo</p></th>
                        <th scope="col"><p>descripcion</p></th>
                        <th scope="col"><p>Creador Hilo</p></th>
                        <th scope="col"><p>Id creador Hilo</p></th>
                        <th scope="col"><p>estado</p></th>
                        <th scope="col"><p>Acciones</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $articulos=todosArticulos($conexion);
                            While($articuloMostrar=mysqli_fetch_assoc($articulos)){
                        ?>
                        <tr>
                            <th scope="row"><p><?php echo $articuloMostrar['idArticulo']; ?></p></th>
                            <td><p><?php echo $articuloMostrar['cabecera']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['cuerpo']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['pie']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['idcreadorArticulo']; ?></p></td>
                            <td><img src="<?php echo $articuloMostrar['imagenArticulo']; ?>"></td>
                            <td><p><?php echo $articuloMostrar['idHilo']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['tema']; ?></p></td>
                            <td><img src="<?php echo $articuloMostrar['imagenHilo']; ?>"></td>
                            <td><p><?php echo $articuloMostrar['descripcion']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['creadorHilo']; ?></p></td>
                            <td><p><?php echo $articuloMostrar['idCreadorHilo']; ?></p></td>
                            <td><?php if ($articuloMostrar['estado']!="eliminado") { ?>  
                                <form action="adminArticulo.php" method="post"><input type="hidden" name="idArticuloMarcar" value="<?php echo $articuloMostrar['idArticulo']; ?>"> <input type="submit" class="text-danger boton" name="MarcarArticuEliminado" value="Marcar como eliminado"></form>
                                <?php
                                    }else {
                                ?>
                                <form action="adminArticulo.php" method="post"><input type="hidden" name="idArticuloQuitarMarcar" value="<?php echo $articuloMostrar['idArticulo']; ?>"> <input type="submit" class="text-danger boton" name="QuitarMarcaArticuEliminado" value="Quitar de eliminado"></form>
                                <?php
                                    }
                                    //Mecanismo para marcar como eliminado articulo si no lo esta
                                    if (isset($_POST['MarcarArticuEliminado']) && $articuloMostrar['idArticulo']==$_POST['idArticuloMarcar']) {
                                        $resultadoElim=actualizarArticulo($conexion,"estado","eliminado",$_POST['idArticuloMarcar']);
                                        if ($resultadoElim) {
                                            echo "<p>Se marco como eliminado</p>";
                                        }else {
                                            echo "<p>No se consigio modificar el estado</p>";
                                        }
                                        //Mecanismo para quitar marca de eliminado si esta marcado como eliminado
                                    }elseif (isset($_POST['QuitarMarcaArticuEliminado']) && $articuloMostrar['idArticulo']==$_POST['idArticuloQuitarMarcar']) {
                                        $resultadoElim=actualizarArticulo($conexion,"estado","Null",$_POST['idArticuloQuitarMarcar']);
                                        if ($resultadoElim) {
                                            echo "<p>Se quito marca eliminado</p>";
                                        }else {
                                            echo "<p>No se consigio modificar el estado</p>";
                                        }
                                    }
                                    echo "<p>".$articuloMostrar['estado']."</p>"; ?>
                            </td>
                            <td><?php if ($articuloMostrar['premium']!=1) { ?>  
                                <form action="adminArticulo.php" method="post"><input type="hidden" name="idArticuloMarcar" value="<?php echo $articuloMostrar['idArticulo']; ?>"> <input type="submit" class="text-danger boton" name="marcarComoPremium" value="Marcar como eliminado"></form>
                                <?php
                                    }else {
                                ?>
                                <form action="adminArticulo.php" method="post"><input type="hidden" name="idArticuloQuitarMarcar" value="<?php echo $articuloMostrar['idArticulo']; ?>"> <input type="submit" class="text-danger boton" name="quitarMarcarComoPremium" value="Quitar de eliminado"></form>
                                <?php
                                    }
                                    //Mecanismo para marcar como eliminado articulo si no lo esta
                                    if (isset($_POST['marcarComoPremium']) && $articuloMostrar['idArticulo']==$_POST['idArticuloMarcar']) {
                                        $resultadoElim=actualizarArticulo($conexion,"premium",1,$_POST['idArticuloMarcar']);
                                        if ($resultadoElim) {
                                            echo "<p>Se marco como premium</p>";
                                        }else {
                                            echo "<p>No se consigio modificar el estapremiumdo</p>";
                                        }
                                        //Mecanismo para quitar marca de eliminado si esta marcado como eliminado
                                    }elseif (isset($_POST['quitarMarcarComoPremium']) && $articuloMostrar['idArticulo']==$_POST['idArticuloQuitarMarcar']) {
                                        $resultadoElim=actualizarArticulo($conexion,"premium","0",$_POST['idArticuloQuitarMarcar']);
                                        if ($resultadoElim) {
                                            echo "<p>Se quito marca premium</p>";
                                        }else {
                                            echo "<p>No se consigio modificar el premium</p>";
                                        }
                                    }
                                    echo "<p>".$articuloMostrar['estado']."</p>"; ?>
                            </td>
                            <td>
                                <form action="modificarArticulo.php" method="POST" class="row"><input type="hidden" name="idArticuloModi" value="<?php echo $articuloMostrar['idArticulo']; ?>"><input type="submit" value="modificar" name="modificarArticulo" class="btn boton col-12"></form>
                                <form action="eliminarArticulo.php" method="POST" class="row"><input type="hidden" name="idArticuloElim" value="<?php echo $articuloMostrar['idArticulo']; ?>"><input type="submit" value="Eliminar" name="eliminarArticulo" class="btn botonElim col-12"></form>
                            </td>
                        </tr>
                        <?php    }   ?>
                    </tbody>
                </table>
            </div>
            <form action="crearArticulo.php" method="post">
                <input type="submit" value="Crear articulo" name="crearArticulo" class="mb-1 col-12 mx-auto boton">
            </form>
            <div class="row">
            <?php
                if (isset($_POST['crearArticulo'])) {
                
                    //Recogemos el archivo enviado por el formulario
                    $archivo = $_FILES['archivo']['name'];
                    //Si el archivo contiene algo y es diferente de vacio
                    if (isset($archivo) && $archivo != "") {
                    //Obtenemos algunos datos necesarios sobre el archivo
                    $tipo = $_FILES['archivo']['type'];
                    $tamano = $_FILES['archivo']['size'];
                    $temp = $_FILES['archivo']['tmp_name'];
                    
                    //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                        echo '<div><p><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></p></div>';
                    }
                    else {
                        //Si la imagen es correcta en tamaño y tipo
                        //Se intenta subir al servidor
                        $prefijo=strval($_SESSION['hiloAModificar']);
                        if (move_uploaded_file($temp, "images/".$prefijo."".$archivo)) {
                            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                            chmod('images/'.$archivo, 0777);
                            //Mostramos el mensaje de que se ha subido co éxito
                            echo '<div><p><b>Se ha subido correctamente la imagen.</b></p></div>';
                            $envio=true;
                        }
                        else {
                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            echo '<div><p><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></p></div>';
                        }
                        //Subir Hilo
                        $dir=strval("images/".$prefijo."".$archivo);
                        echo $dir;
                        echo $_SESSION['idUsuario']."".$_POST['tema']."".$_POST['descripcion'];
                        $resulCrearHilo=insertarArticulo($conexion,$dir,$_POST['hilo'],$_POST['cuerpo'],$_POST['pie'],$_POST['cabecera'],$_SESSION['idUsuario']);
                            if ($resulCrearHilo) {
                                echo "se creo correctamente el hilo";
                                ?>
                                <a href="adminArticulo.php" class="mb-1 col-12 mx-auto boton" role="button">Ver en tabla</a>
                                <?php
                            }else {
                                echo "<p>No se consiio crear el hilo, intentelo de nuevo</p>";
                            }
                    
                        }
                    }
                }
            ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>