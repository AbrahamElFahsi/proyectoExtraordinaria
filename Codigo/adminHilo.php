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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php   include 'partes/nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
    ?>
<div class="containerfluid forms">
    <div class="row"><h1 class="text-center col-12">Panel de administrador de Hilo</h1></div>
        <div class="row">  
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id Hilo</th>
                    <th scope="col">Tema del Hilo</th>
                    <th scope="col">Descripcion del hilo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Usuario creador</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">dni</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $hilo=consultaHilos($conexion);
                        While($hiloMostrar=mysqli_fetch_assoc($hilo)){
                    ?>
                    <tr>
                    <th scope="row"><?php echo $hiloMostrar['idHilo']; ?></th>
                    <td><?php echo $hiloMostrar['tema']; ?></td>
                    <td><?php echo $hiloMostrar['descripcion']; ?></td>
                    <td><img src="<?php echo $hiloMostrar['imagen']; ?>"></td>
                    <td><?php echo $hiloMostrar['usuario']; ?></td>
                    <td><?php echo $hiloMostrar['nombre']; ?></td>
                    <td><?php echo $hiloMostrar['apellidos']; ?></td>
                    <td><?php echo $hiloMostrar['dni']; ?></td>
                    <td>
                        <form action="modificarHilo.php" method="POST" class="row"><input type="hidden" name="idHiloModi" value="<?php echo $hiloMostrar['idHilo']; ?>"><input type="submit" value="modificar" name="modificarHilo" class="btn boton col-12"></form>
                        <form action="eliminarHilo.php" method="POST" class="row"><input type="hidden" name="idHiloElim" value="<?php echo $hiloMostrar['idHilo']; ?>"><input type="submit" value="Eliminar" name="eliminarHilo" class="btn botonElim col-12"></form>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <form action="crearHilo.php" method="post">
            <input type="submit" value="Crear hilo" name="crearArticulo" class="mb-1 col-12 mx-auto boton">
        </form>
        <?php
                                            if (isset($_POST['crearHilo'])) {
                                            
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
                                                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                                                }
                                                else {
                                                    //Si la imagen es correcta en tamaño y tipo
                                                    //Se intenta subir al servidor
                                                    $prefijo=strval($_SESSION['hiloAModificar']);
                                                    if (move_uploaded_file($temp, "images/".$prefijo."".$archivo)) {
                                                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                                        chmod('images/'.$archivo, 0777);
                                                        //Mostramos el mensaje de que se ha subido co éxito
                                                        echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                                        $envio=true;
                                                    }
                                                    else {
                                                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                                    }
                                                    //Subir Hilo
                                                    $dir=strval("images/".$prefijo."".$archivo);
                                                    echo $dir;
                                                    echo $_SESSION['idUsuario']."".$_POST['tema']."".$_POST['descripcion'];
                                                    $resulCrearHilo=insertarHilo($conexion,$_SESSION['idUsuario'],$dir,$_POST['tema'],$_POST['descripcion']);
                                                        if ($resulCrearHilo) {
                                                            echo "se creo correctamente el hilo";
                                                            ?>
                                                            <a href="adminHilo.php" class="btn btn-primary col-11 mx-auto mb-3" role="button">Ver en tabla</a>
                                                            <?php
                                                        }else {
                                                            echo "No se consiio crear el hilo, intentelo de nuevo";
                                                        }
                                                
                                                }
                                                }
                                                
                                            }
                                        ?>
    
</div>
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>