<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">
    <?php 
        
        require 'ConectorBD.php';
        require 'BD/DAOUsuario.php'; 
        require 'BD/DAOHilo.php'; 
        include 'nav.php';
        $conexion=conectar(false)
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php

        
    ?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Crear Articulo</h1></div>
    <div class="row">
        <div class="col-12">
            <form action="adminArticulo.php" method="post" enctype="multipart/form-data" id="crearHiloForm">
                <div class="form-group col-12">
                    <p class="text-center">Imagen del hilo</p>
                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>  
                    <input id="upload" name="archivo" id="image" type="file" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Elija una imagen representativa del Articulo</label>
                </div>   
                <div class="form-group col-12">
                    <label for="tema">Cabecera <i class="fa-solid fa-grip-lines"></i></i></label>
                    <textarea class="form-control" id="cabecera" maxlength="150" name="cabecera" rows="2"></textarea> 
                    <small id="avisoTema">La cabecera del que trata el hilo, maximo 100 caracteres</small>
                </div>
                <div class="form-group col-12">
                    <label for="tema">Cuerpo <i class="fa-solid fa-align-justify"></i></i></i></label>
                    <textarea class="form-control" id="cuerpo" maxlength="20000" name="cuerpo" rows="20"></textarea> 
                    <small id="avisoTema">El tema del que trata el hilo, maximo 100 caracteres</small>
                </div>
                <div class="form-group col-12">
                    <label for="tema">pie <i class="fa-solid fa-arrow-down"></i></label>
                    <textarea class="form-control" id="pie" maxlength="150" name="pie" rows="8"></textarea> 
                    <small id="avisoTema">El tema del que trata el hilo, maximo 100 caracteres</small>
                </div>        
                <input type="submit" value="Modificar tema" name="crearHilo" class="btn btn-primary col-11 mx-auto">           
            </form>
        </div>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a477e7ee05.js" crossorigin="anonymous"></script>
    <script src="js/crearArticulo.js"></script>
</body>
</html>