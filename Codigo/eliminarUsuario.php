<?php
require 'BD/ConectorBD.php';
require 'BD/DAOUsuario.php';
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
    <link rel="stylesheet" href="css/style.css">

    
</head>
<body>
    <?php include 'partes/nav.php'; ?>
<div class="container forms">
<?php
 if (isset($_POST['eliminarUsuAdmin'])) {
   if ($_SESSION['Rol']=="adminnistrador") {
    $_SESSION['accion']="administrador";
   }
   $fecha = date("Y-m-d H:i:00",time());
   $baneo = $_SESSION['banner'];
if ($fecha<$baneo || $_SESSION['perBanned']==1) {
header('Location: principal.php');
}
     $_SESSION['usuarioMo']=$_POST['idUsuElim'];
 }
?>
    <div class="row"><h1 class="text-center col-12">Eliminar usuario</h1></div>
    <div class="row">
      <?php
    
      if ($_SESSION['accion']=="administrador") {
        $usuEliminar=usuarioPorId($conexion,$_SESSION['usuarioMo']);
        $usuElim=mysqli_fetch_assoc($usuEliminar);
        if ($usuElim['fechaSuscripcion']!=null && $usuElim['fechaSuscripcion']!="") {
          $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
          $fecha_entrada =$usuElim['fechaSuscripcion'];
          if($fecha_actual > $fecha_entrada)
            {
      ?>
              <div class="jumbotron-fluid col-12 mb-5 ml-2">
                <h1 class="display-4">¿Esta seguro?</h1>
                <p class="lead">La suscripcion de <?php echo $usuElim['usuario']; ?> termina el <?php echo date("d-m-Y", strtotime($usuElim['fechaSuscripcion'])); ?></p>
                <form action="eliminarUsuario.php" method="POST">
                  <hr class="my-4">
                  <p>Recuerde que si elimina su cuenta perderá lo que reste de su suscripcion </p>
                  <p class="lead">
                  <input type="hidden" name="idUsuElim" value="<?php echo $_SESSION['usuarioMo']; ?>">
                  <input type="submit" value="eliminarUsuario" name="eliminarUsu" class="btn botonElim">
                </form>
                <hr class="my-4">
                <p class="lead">Elija esta opcion para volver a la pagina principal</p>
                <a href="principal.php" class="btn boton">Volver a la página principal</a>
              </div>

      <?php

            }
          }
          else
              {
?>
              <div class="jumbotron-fluid col-12 mb-5 ml-2">
                <h1 class="lead">Elija esta opcion para volver a la pagina principal</h1>
                <a href="principal.php" class="btn boton">Volver a la página principal</a>
                <hr class="my-4">
                <h1 class="display-4">¿Esta seguro?</h1>
                <p class="lead">Con este paso <?php echo $usuElim['usuario']; ?> no tendra acceso a todos los articulos</p>
                <form action="eliminarUsuario.php" method="POST">
                  <input type="hidden" name="idUsuElim" value="<?php echo $_SESSION['usuarioMo']; ?>">
                  <input type="submit" value="eliminarUsuario" name="eliminarUsu" class="btn botonElim">
                </form>
              </div>

<?php
              }
      }else{
        
        if ($_SESSION['Rol']=="usuario") {
      
          if ($_SESSION['fechaSuscripcion']!=null && $_SESSION['fechaSuscripcion']!="") {
              $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
              $fecha_entrada =$_SESSION['fechaSuscripcion'];
              if($fecha_actual > $fecha_entrada)
                {
          ?>
                  <div class="jumbotron-fluid col-12 mb-5 ml-2">
                    <h1>Elija esta opcion para volver a la pagina principal</h1h1>
                    <a href="principal.php" class="btn boton">Volver a la página principal</a>
                    <hr class="my-4">
                    <h1 class="display-4">¿Esta seguro?</h1>
                    <p class="lead">Su suscripcion termina el <?php echo date("d-m-Y", strtotime($_SESSION['fechaSuscripcion'])); ?></p>
                    <p class="lead">¿Desea anular su suscripción antes?</p>
                    <a href="pago.php" class="boton">Anular</a>
                    <form action="eliminarUsuario.php" method="POST">
                      <hr class="my-4">
                      <p>Recuerde que si elimina su cuenta perderá lo que reste de su suscripcion </p>
                      <p class="lead">
                      <input type="hidden" name="idUsuElim" value="<?php echo $_SESSION['idUsuario']; ?>">
                      <input type="submit" value="eliminarUsuario" name="eliminarUsu" class="btn botonElim">
                    </form>
                  </div>

          <?php

                }else {
                  ?>
                  <div class="jumbotron-fluid col-12 mb-5 ml-2">
                    <h1>Elija esta opcion para volver a la pagina principal</h1>
                    <a href="principal.php" class="btn boton">Volver a la página principal</a>
                    <hr class="my-4">
                    <h1 class="display-4">¿Esta seguro?</h1>
                    <p class="lead txt-danger">Con este paso perdera <?php echo $_SESSION['usuario']; ?> acceso a todos los articulos</p>
                    <form action="eliminarUsuario.php" method="POST">
                      <input type="hidden" name="idUsuElim" value="<?php echo $_SESSION['idUsuario']; ?>">
                      <input type="submit" value="eliminarUsuario" name="eliminarUsu" class="btn botonElim">
                    </form>
                  </div>

    <?php
                }
              }
              else
                  {
    ?>
                  <div class="jumbotron-fluid col-12 mb-5 ml-2">
                    <h1 class="lead">Elija esta opcion para volver a la pagina principal</h1>
                    <a href="principal.php" class="btn boton">Volver a la página principal</a>
                    <hr class="my-4">
                    <h1 class="display-4">¿Esta seguro?</h1>
                    <p class="lead txt-danger">Con este paso perdera <?php echo $_SESSION['usuario']; ?> acceso a todos los articulos</p>
                    <form action="eliminarUsuario.php" method="POST">
                      <input type="hidden" name="idUsuElim" value="<?php echo $_SESSION['idUsuario']; ?>">
                      <input type="submit" value="eliminarUsuario" name="eliminarUsu" class="btn botonElim">
                    </form>
                  </div>

    <?php
                  }
            }
    }
        ?>


    </div>
    <div class="row">
    <?php
      if (isset($_POST['eliminarUsu'])) {
        $resultadoEliminar=eliminarUsuario($conexion,$_POST['idUsuElim']);
        if ($resultadoEliminar) {
          ?>
            <div class="jumbotron-fluid col-12 mb-5">
              <h3 class="display-5">Se elimino correctamente</h3>
              <?php
              if ($_SESSION['Rol']=="administrador") {
                ?>
                <a href="adminUsuario.php" class="btn btn-primary">Administrador de usuario</a>
                            
                <?php
              }else {
                session_destroy();
                ?>
                <a href="principal.php" class="btn btn-primary">pagina principal</a>
                            
                <?php
              }
              ?>
            </div>
          <?php 
        }
      }
    ?>
    </div>
</div>
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>