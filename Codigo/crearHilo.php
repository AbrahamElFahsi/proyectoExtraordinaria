<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="css/style.css">
    <?php 
        include 'nav.php';
        require 'ConectorBD.php';
        require 'BD/DAOUsuario.php'; 
        require 'BD/DAOHilo.php'; 
         
        $conexion=conectar(false)
    ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php

        
    ?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Crear Hilo</h1></div>
    <div class="row">
        <div class="col-12">
            <form action="adminHilo.php" method="post" enctype="multipart/form-data" id="crearHiloForm">
                    
                                <div class="form-group col-12">
                                    <p class="text-center">Imagen del hilo</p>
                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>  
                                    <input id="upload" name="archivo" id="image" type="file" onchange="readURL(this);" class="form-control border-0">
                                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Elija una imagen representativa del hilo</label>
                                    
                                </div>
                                
                        </div>
                        <div class="col-12">

                                <div class="form-group col-12">
                                    <label for="tema">Tema: <?php echo $hilo['tema']; ?><i class="fas fa-user"></i></label>
                                    <input type="text" id="tema" name="tema" maxlength="99" class="form-control" placeholder="Enter User"> 
                                    <small id="avisoTema">El tema del que trata el hilo, maximo 100 caracteres</small>
                                </div>


                        </div>
                        <div class="col-12">
                            
                                <div class="form-group col-12">
                                    <label for="descripcion">Descripcion <i class="fas fa-user"></i></label>
                                    <textarea class="form-control" id="descripcion" maxlength="199" name="descripcion" rows="3"><?php echo str_replace('</p>',"\n",str_replace('<p>', '', $hilo['descripcion'])); ?></textarea>
                                    <div id="parraf"></div>
                                    <small id="avisoDescripcion">El Descripcion del que trata el hilo, maximo 200 caracteres</small>
                                    <small id="avisoForm"></small>
                                </div>
                        </div>
                        
                            <input type="submit" value="Modificar tema" name="crearHilo" class="btn btn-primary col-11 mx-auto">
                          
            </form>
       
        </div>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/crearHilo.js"></script>
</body>
</html>