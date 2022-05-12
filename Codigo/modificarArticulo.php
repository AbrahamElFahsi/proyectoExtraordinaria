<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">
    <?php 
        
        require 'BD/ConectorBD.php';
        require 'BD/DAOUsuario.php'; 
        require 'BD/DAOHilo.php';
        require 'BD/DAOArticulo.php'; 
        include 'partes/nav.php';
        $conexion=conectar(false)
    ?>
    <title>Document</title>
</head>
<body>
<?php

if ($_SESSION['Rol']!="adminnistrador") {
    header('Location: cerrarSesion.php');
}
            if (isset($_POST['modificarArticulo'])) {
                $_SESSION['articuloAModificar']=$_POST['idArticuloModi'];
            }
            if (isset($_SESSION['articuloAModificar'])) {
                $articuloAModificar=articulosPorIdArticulo($conexion,$_SESSION['articuloAModificar']);
                $articulo=mysqli_fetch_assoc($articuloAModificar);
            }
             


            ?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Crear Articulo</h1></div>
    <div class="row">
        <div class="col-12">
            <form action="modificarArticulo.php" method="post" enctype="multipart/form-data" id="modificarImagenArticulo">
                <div class="form-group col-12">
                    <p class="text-center">Imagen del hilo</p>
                    <div class="image-area mt-4"><img id="imageResult" src="<?php echo $articulo['imagenArticulo']; ?>" class="col-12" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>  
                    <input id="upload" name="archivo" id="image" type="file" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload">Elija una imagen representativa del Articulo</label>
                </div>  
                <div class="form-group col-12">
                    <small id="avisoImagen"> </small>
                    <input type="submit" value="Modificar tema" name="modificarImaArticulo" class="btn boton col-12 mx-auto">   
                </div>
            </form>
            <div class="col-12">
                <?php
                    if (isset($_POST['modificarImaArticulo'])) {
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
                            
                            $dir=strval("images/".$prefijo."".$archivo);
                            echo $dir;
                            $resulModificarImagen=actualizarArticulo($conexion,"image",$dir,$_SESSION['articuloAModificar']);
                                if ($resulModificarImagen) {
                                    echo "se modifico la imagen";
                                    ?>
                                    <hr>
                                    <a href="adminArticulo.php" class="btn btn-primary col-12 mb-2 center mx-auto"> Volver al administrador de Articulos</a>
                                    <?php

                                }else {
                                    echo "No se consigio modificar la imagen, intentelo de nuevo";
                                }
                        }
                        }
                    }
                ?>
            </div>
            <form action="modificarArticulo.php" method="post" enctype="multipart/form-data" id="modificarHilodeArticulo">
                <div class="form-group col-12">
                    <label for="hilo">Hilo del articulo <i class="fa-solid fa-arrows-to-dot"></i></i> Actual:<?php echo $articulo['tema']; ?></label>
                    <select name="hilo" id="hilo" class="col-12">
                        <option value=<?php echo $articulo['idHilo']; ?>><?php echo $articulo['tema']; ?></option>
                        <?php
                        $hilo=consultaSoloHilos($conexion);
                        
                        while ($HiloArticulo=mysqli_fetch_assoc($hilo)) {
                            ?>
                            <option value=<?php echo $HiloArticulo['idHilo'] ?>><?php echo $HiloArticulo['tema'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-12">
                    <small id="avisoHilo"></small>
                    <input type="submit" value="Modificar Hilo" name="modiHiloArticul" class="boton col-12 mx-auto mb-2">   
                </div>
            </form>  
            <div class="col-12">
                <?php
                    if (isset($_POST['modiHiloArticul'])) {
                        $resulModificarHilo=actualizarArticulo($conexion,"idHilo",$_POST['hilo'],$_SESSION['articuloAModificar']);
                            if ($resulModificarHilo) {
                                echo "<p>se modifico correctamente el hilo</p>";
                                ?>
                                <hr>
                                <a href="adminArticulo.php" class="btn btn-primary col-12 mb-2 center mx-auto"> Volver al administrador de Articulos</a>
                                <?php
                            }else {
                                echo "<p>No se consigio modificar la hilo</p>";
                            }
                    }
                ?>
            </div>
            <form action="modificarArticulo.php" method="post" enctype="multipart/form-data" id="modificarCabeceraArticulo">


                <div class="form-group col-12">
                    <label for="cabecera">Cabecera <i class="fa-solid fa-grip-lines"></i></i></label>
                    <textarea class="form-control" id="cabecera" maxlength="150" name="cabecera" rows="2"><?php echo $articulo['cabecera']; ?></textarea> 
                    <small id="avisocabecera">La cabecera del que trata el hilo, maximo 100 caracteres</small>
                </div>
                <div class="form-group col-12">
                    <small id="avisoEnvioCabecera"> </small>
                    <input type="submit" value="Modificar cabecera" name="modiCabeceraArticulo" class="boton col-12 mx-auto mb-2">   
                </div>
            </form> 
            <div class="col-12">
                <?php
                    if (isset($_POST['modiCabeceraArticulo'])) {
                        $resulModificarcabecera=actualizarArticulo($conexion,"cabecera",$_POST['cabecera'],$_SESSION['articuloAModificar']);
                            if ($resulModificarcabecera) {
                                echo "<p>se modifico correctamente el Cabecera</p>";
                                ?>
                                    <hr>
                                    <a href="adminArticulo.php" class="btn btn-primary col-12 mb-2 center mx-auto"> Volver al administrador de Articulos</a>
                                <?php
                            }else {
                                echo "<p>No se consigio modificar la Cabecera</p>";
                            }
                    }
                ?>
            </div>
            <form action="modificarArticulo.php" method="POST" enctype="multipart/form-data" id="modiCuerArticulo">
                <div class="form-group col-12">
                    <label for="cuerpo">Cuerpo <i class="fa-solid fa-align-justify"></i></i></i></label>
                    <textarea class="form-control" id="cuerpo" maxlength="20000" name="cuerpo" rows="20"><?php echo str_replace('<br>',"\n", $articulo['cuerpo']); ?></textarea> 
                    <small id="avisoCuerpo"> </small>
                </div>
                <div class="form-group col-12">
                    <small id="avisoEnvioCuerpo"> </small>
                    <input type="submit" value="Modificar cuerpo" name="modiCuerpo" class="btn boton col-12 mx-auto">   
                </div>
            </form> 
            <div class="col-12">
                <?php
                    if (isset($_POST['modiCuerpo'])) {
                        $resulModificarCuerpo=actualizarArticulo($conexion,"cuerpo",$_POST['cuerpo'],$_SESSION['articuloAModificar']);
                            if ($resulModificarCuerpo) {
                                echo "<p>se modifico correctamente el cuerpo del articulo</p>";
                                ?>
                                    <hr>
                                    <a href="adminArticulo.php" class="boton col-12 mx-auto mb-2"> Volver al administrador de Articulos</a>
                                <?php
                            }else {
                                echo "<p>No se consigio modificar la cuerpo del articulo</p>";
                            }
                    }
                ?>
            </div>
            <form action="modificarArticulo.php" method="post" enctype="multipart/form-data" id="modiPieForm">
                <div class="form-group col-12">
                    <label for="pie">pie <i class="fa-solid fa-arrow-down"></i></label>
                    <textarea class="form-control" id="pie" maxlength="150" name="pie" rows="8"><?php echo str_replace('<br>',"\n", $articulo['pie']); ?></textarea> 
                    <small id="avisopie">El tema del que trata el hilo, maximo 100 caracteres</small> 
                </div>
                <div class="form-group col-12">
                    <small id="avisoenvioPie"> </small>
                    <input type="submit" value="Modificar pie" name="modiPie" class="boton col-12 mx-auto mb-2">   
                    
                </div>
            </form> 
            <div class="col-12">
                <?php
                    if (isset($_POST['modiPie'])){
                        $resulModificarPie=actualizarArticulo($conexion,"pie",$_POST['pie'],$_SESSION['articuloAModificar']);
                            if ($resulModificarPie) {
                                echo "<p>se modifico correctamente el pie del articulo</p>";
                                ?>
                                <hr>
                               <a href="adminArticulo.php" class="boton col-12 mx-auto mb-2"> Volver al administrador de Articulos</a>
                                <?php
                            }else {
                                echo "<p>No se consigio modificar el pie del articulo</p>";
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
    <script src="https://kit.fontawesome.com/a477e7ee05.js" crossorigin="anonymous"></script>
    <script src="js/modificarArticulo.js"></script>
</body>
</html>