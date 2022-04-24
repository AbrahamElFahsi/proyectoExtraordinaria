<?php
require 'ConectorBD.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
<?php   include 'nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: principal.php');
            }
    ?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Panel de administrador de usuario</h1></div>
        <div class="row">  
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id Comentario</th>
                    <th scope="col">Id Usuario</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Cabecera Articulo</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $hilo=todosComentarios($conexion);
                        While($hiloMostrar=mysqli_fetch_assoc($hilo)){
                    ?>
                    <tr>
                    <th scope="row"><?php echo $hiloMostrar['idComentario']; ?></th>
                    <td><?php echo $hiloMostrar['idUsuario']; ?></td>
                    <td><?php echo $hiloMostrar['usuario']; ?></td>
                    <td><?php echo $hiloMostrar['contenido']; ?></td>
                    <td><?php echo $hiloMostrar['cabecera']; ?></td>
                    <td>
                        <form action="panelModeracion.php" method="POST" class="row"><input type="hidden" name="idComent" value="<?php echo $hiloMostrar['idComentario']; ?>"><input type="submit" value="modificar" name="moderador" class="btn btn-primary col-12"></form>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row v-center">
            <a href="crearHilo.php" class="btn btn-primary col-11 mx-auto mb-3" role="button">Crear usuario</a>
        </div>
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
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>