<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a477e7ee05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php 
  
            require 'BD/ConectorBD.php';
            require 'BD/DAOUsuario.php'; 
            $conexion=conectar(false); 
            
            ?>
    <title>Login</title>
</head>
<body>
<?php include 'partes/nav.php'; ?>
<div class="container forms mb-5">
    <div class="row"><h1 class="text-center col-10 p-5 mx-auto titulo">Login</h1></div>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="comprobar_usuario.php" id="login">
                <div class="form-group col-12">
                    <label for="usuario">Usuario <i class="fas fa-user"></i></label>
                    <input type="text" class="form-control" id="usuario" placeholder="First name" name="usuario">
                    <small id="avisoUsuario"></small>
                </div>
        </div>  
        <div class="col-md-6">
            <div class="form-group col-12">
                <label for="password">contraseña <i class="fas fa-lock"></i></label>
                <input type="password" name="password" class="form-control" placeholder="Enter User" id="pass">
                <small id="avisoPass"></small>
            </div>
        </div> 
        <div class="col-md-12 mb-2">
            <input type="submit" value="Login" class="btn col-12 boton mb-2" id="login">
            <a href="recuperar_pass.php" class="enlaceContra">¿Olvido su contraseña?</a>
        </div>
            </form>
        </div>
        <div class="col-md-12">
        <?php
        if (isset($_SESSION['usuario'])) {                  
            header("Location: cerrarSesion.php");
        }
            if (isset($_POST['cambiarContra'])) {
                $resultadoModificaContra=modificarUsuario($conexion,$_POST['id'],"pass",$_POST['password']);
                if ($resultadoModificaContra) {
                    ?>
                    <div class=" jumbotron-fluid">
                    <div class="container">
                        <p class="lead">Se modifico correctamente su contraseña</p>
                    </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="lead">Intentelo de nuevo hubo problemas</p>
                    </div>
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

    <script src="js/validacionLogin.js"></script>
</body>
</html>