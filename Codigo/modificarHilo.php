<?php
require 'ConectorBD.php';
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
</head>
<body>
    <?php include 'nav.php'; ?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Modificar </h1></div>
        <div class="row">  
            <?php
            if (isset($_POST['modificarHilo'])) {
                $_SESSION['hiloAModificar']=$_POST['idHiloModi'];
               
            }
            $hiloAModificar=consultaHilosPorId($conexion,$_SESSION['hiloAModificar']);
            $hilo=mysqli_fetch_assoc($hiloAModificar);  


            ?>
            <div class="col-12">
                <form action="ModificarHilo.php" method="post" enctype="multipart/form-data">
                    <div class="form-group col-12">
                        <p class="text-center">Modificar imagen</p>
                        <div class="image-area mt-4"><img id="imageResult" src="<?php echo $hilo['imagen'] ?>" alt="" class="col-12 rounded shadow-sm mx-auto d-block"></div>  
                        <input id="upload" name="archivo" type="file" onchange="readURL(this);" class="form-control border-0">
                        <label id="upload-label" for="upload">Elija una imagen del producto</label>
                        
                    </div>
                    <input type="submit" value="Modificar Imagen" name="modificarImagenHilo" class="btn boton col-12 mx-auto">
                </form>
                    <?php
                                if (isset($_POST['modificarImagenHilo'])) {
                                
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
                                        echo '<div><b><p>Error. La extensión o el tamaño de los archivos no es correcta.</p>
                                        - <p>Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</p></b></div>';
                                    }
                                    else {
                                        //Si la imagen es correcta en tamaño y tipo
                                        //Se intenta subir al servidor
                                        $prefijo=strval($_SESSION['hiloAModificar']);
                                        if (move_uploaded_file($temp, "images/".$prefijo."".$archivo)) {
                                            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                            chmod('images/'.$archivo, 0777);
                                            //Mostramos el mensaje de que se ha subido co éxito
                                            echo '<div><b><p>Se ha subido correctamente la imagen.</p></b></div>';
                                            $envio=true;
                                        }
                                        else {
                                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                            echo '<div><b><p>Ocurrió algún error al subir el fichero. No pudo guardarse.</p></b></div>';
                                        }
                                        
                                        $dir=strval("images/".$prefijo."".$archivo);
                                        echo $dir;
                                        $resulModificarImagen=modificarHilo($conexion,$_SESSION['hiloAModificar'],"imagen",$dir);
                                            if ($resulModificarImagen) {
                                                echo "<p>se modifico la imagen</p>";
                                        }
                                    
                                    }
                                    }
                                    
                                }
                                
                            ?>
            </div>
            <div class="col-12">
                <form action="ModificarHilo.php" method="post" enctype="multipart/form-data" id="temaForm">
                    <div class="form-group col-12">
                        <label for="tema">Tema: <?php echo $hilo['tema']; ?><i class="fas fa-user"></i></label>
                        <input type="text" id="tema" name="tema" value="<?php echo $hilo['tema']; ?>" maxlength="99" class="form-control" placeholder="Enter User"> 
                        <small id="avisoTema">El tema del que trata el hilo, maximo 100 caracteres</small>
                    </div>
                    <input type="submit" value="Modificar tema" name="modificarTemaHilo" class="btn boton col-12 mx-auto">
                </form>
                <?php
                    if (isset($_POST['modificarTemaHilo'])) {
                        $resulModificarDescripcion=modificarHilo($conexion,$_SESSION['hiloAModificar'],"tema",$_POST['tema']);
                        if ($resulModificarDescripcion) {
                            echo "<p>Se modifico correctamente el tema</p></br>".$_POST['tema'];
                        }else{
                            echo "<p>No se consigio intentelo de nuevo</p>";
                        }
                    }
                ?>
            </div>
            <div class="col-12">
                <form action="ModificarHilo.php" method="post" enctype="multipart/form-data" id="modDescrip">
                    <div class="form-group col-12">
                        <label for="descripcion">Descripcion <i class="fas fa-user"></i></label>
                        <textarea class="form-control" id="descripcion" value="<?php echo str_replace('<br>',"\n", $hilo['descripcion']); ?>" maxlength="199" name="descripcion" rows="3"><?php echo str_replace('<br>',"\n", $hilo['descripcion']); ?></textarea>
                        <div id="parraf"></div>
                        <small id="avisoDescripcion">El Descripcion del que trata el hilo, maximo 200 caracteres</small>
                        
                    </div>
                    <input type="submit" value="Modificar descripción" name="modificarDescripHilo" class="btn boton col-12 mx-auto mb-2">
                </form>
                 
                <?php
                    if (isset($_POST['modificarDescripHilo'])) {
                        $resulModificarDescripcion=modificarHilo($conexion,$_SESSION['hiloAModificar'],"descripcion",$_POST['descripcion']);
                        if ($resulModificarDescripcion) {
                            echo "<p>Se modifico correctamente la descripcion</p></br><p>".$_POST['descripcion']."</p>";
                        }else{
                            echo "<p>No se consigio intentelo de nuevo</p>";
                        }
                    }
                ?>
            </div>
        </div>
    
</div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js/modificarHilo.js"></script>
</body>
</html>