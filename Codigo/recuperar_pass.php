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
                    <?php
            if (isset($_GET['id'])) {
                $id=$_GET['id'];
                $usu=usuarioPorId($conexion,$id);
                $usuario=mysqli_fetch_assoc($usu);
            
                ?>
            <form method="POST" action="recuperar_pass.php" id="login">
                <div class="form-group col-12">
                    <label for="email">Introduzca su correo electrónico: <i class="fas fa-user"></i></label>
                    <input type="text" class="form-control" id="email" placeholder="First name" name="email">
                    <small>termine de escribir su correo <?php echo substr($usuario['gmail'], 0, 4); ?>*******</small>
                    <small id="avisoFormulario"></small>
                </div>
            
        </div>
        <div class="col-md-6">
                <div class="form-group col-12">
                    <label for="email">Introduzca su dni: <i class="fas fa-user"></i></label>
                    <input type="text" class="form-control" id="dni" placeholder="dni" name="dni">
                    <input type="hidden" name="idUsuRe" value="<?php echo $id; ?>">
                    <small>termine de escribir su correo <?php echo substr($usuario['dni'], 0, 3); ?>*******</small>
                    <small id="avisoFormulario"></small>
                </div>
        </div>
        <div class="col-md-12">
                <input type="submit" value="Enviar valores" class="m-5 btn col-10 bg-info" name="recuperarContra">
                <?php } ?>   
            </form>
            <?php
        if (isset($_POST['recuperarContra'])) {
                $idUsu=$_POST['idUsuRe'];
                $usu=usuarioPorId($conexion,$idUsu);
                $usuario=mysqli_fetch_assoc($usu);
                if ($usuario['gmail']==$_POST['email'] && $usuario['dni']==$_POST['dni']) {
            ?>
                        <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Su contraseña es:</h5>
                                <p class="lead"><?php echo $usuario['pass']; ?></p>
                                <hr class="my-4">
                                <form action="login.php" method="POST" class="lead" id="modiContra">
                                    <div class="form-group col-12">
                                        <label for="password">contraseña <i class="fas fa-lock"></i></label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                                        <small id="avisoPass">Al menos 8 caracteres, debe incluir Mayuscula, caracteres especiales y numeros</small>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
                                        <input type="password" id="pass1" name="password1" class="form-control" placeholder="Enter password">
                                        <input type="hidden" name="id" value="<?php echo $usuario['idUsuario']; ?>">
                                        <small id="avisoPass1"></small>
                                    </div>       
                                    <input type="submit" value="Cambiar Contraseña" class="btn bg-info m-3" name="cambiarContra">
                                </form>
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
    <script src="js/ModificarUsuario.js"></script>
</body>
</html>