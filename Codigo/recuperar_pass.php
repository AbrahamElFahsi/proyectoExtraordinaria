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
        require 'ConectorBD.php';
        require 'BD/DAOUsuario.php'; 
        $conexion=conectar(false);
        
    ?>
    <title>Document</title>
</head>
<body>
    <?php  include 'nav.php'; ?>


<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Recuperar contraseña</h1></div>
    <div class="row">
        <div class="col-md-6">

            <form method="POST" action="recuperar_pass.php"  id="dniUsuarioForm" class="mb-4">
                <div class="form-group col-12">
                    <label for="email">Introduzca su correo electrónico: <i class="fas fa-user"></i></label>
                    <input type="text" class="form-control" id="email" placeholder="xxxxxxx@gmail.com" name="email">
                    <small id="avisoEmail"></small>
                    <small id="avisoFormulario"></small>
                </div>
            
        </div>
        <div class="col-md-6">
                <div class="form-group col-12">
                    <label for="dni">DNI <i class="fas fa-id-card"></i></label>                          
                    
                    <input type="text" id="dni" name="dni" class="form-control" placeholder="00000000X">
                    <small id="avisoDNI"></small>
                </div>
        </div>
        <div class="col-md-12">
                <input type="submit" value="Enviar valores" class="mx-auto btn col-12 mb-4 boton" name="recuperarContraSE">
                <small id="avisoFormulario" class="col-12"> </small>
            </form>
        </div>
            
            <?php
        if (isset($_POST['recuperarContraSE'])) {
                $usu=buscarUsuarioEmail($conexion,$_POST['email'],$_POST['dni']);
                //$usu=usuarioPorId($conexion,$idUsu);
                if (mysqli_num_rows($usu)==1) {
                    
                
                $usuario=mysqli_fetch_assoc($usu);
                crearSesion($usuario);
                if ($usuario['gmail']==$_POST['email'] && $usuario['dni']==$_POST['dni']) {
            ?>
                        <div class=" jumbotron-fluid">
                            <div class="container">
                            <form action="modificarUsuario.php" method="POST" class="row" id="modiContra">
                                <div class="form-group col-12">
                                    <label for="password">contraseña <i class="fas fa-lock"></i></label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                                    <small id="avisoPass">al menos 8 caracteres e incluir Mayuscula, caracteres especiales y numeros</small>
                                </div>
                                <div class="form-group col-12">
                                    <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
                                    <input type="password" id="pass1" name="password1" class="form-control" placeholder="Enter password">
                                    <small id="avisoPass1"></small>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" value="Modificar Contraseña" name="modificarPass" class="mx-auto btn col-12 mb-4 boton">
                                
                                </div>
                                
                            </form>
                            </div>
                        </div>
            <?php
            }
            }else {
                ?>
                        <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Los datos son incorrectos intentelo de nuevo</h5>
                            </div>
                        </div>
                <?php
            }
        }
            ?>
            
        </div>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/recuperarPas.js"></script>
</body>
</html>