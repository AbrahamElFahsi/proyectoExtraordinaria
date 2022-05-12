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
            $conexion=conectar(false); ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php include 'partes/nav.php'; ?>
<div class="container forms mb-5">
<div class="jumbotron-fluid">
  <h1 class="display-4">Suscripcion tramitada</h1>
  <p class="lead"><?php
  
  if (isset($_SESSION['usuario'])) {
    
    $date = date("Y-m-d H:i:s");
    $mod_date = strtotime($date."+ 1 months");
    setlocale(LC_TIME, 'es_ES.UTF-8');
    echo "Su suscripcion termina el ". strftime("%d de %B del %Y", $mod_date);
      $resul=modificarUsuario($conexion,$_SESSION['idUsuario'],"fechaSuscripcion",date("Y-m-d H:i:s",$mod_date));

  }
  ?></p>
  
 
  <p class="lead">
    <a class="mx-auto btn col-12 mb-4 boton" href="principal.php" role="button">Página principal</a>
  </p>
</div>
</div>
<?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
    <script src="js/validacionLogin.js"></script>
</body>
</html>