<?php
session_start();
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-2">

    <a class="navbar-brand" href="principal.php"><img src="images/logogato.png"></a>
   <div class="navbar w-100 order-3">
        <ul class="navbar-nav ml-auto">
      <?php
          if(isset($_SESSION['usuario'])){
            if($_SESSION['Rol']=="adminnistrador"){
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: #fcffb4;" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="mostrarProductosComprar.php">Suscribirse</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="crearArticulo.php">Subir articulo</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="crearHilo.php">Añadir Hilo</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="adminUsuario.php">Panel usuario</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="adminArticulo.php">Panel articulo</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="adminHilo.php">Panel hilo</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="adminComentarios.php">Panel Comentarios</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" style="color: red;" href="EliminarUsuario.php">Eliminar Usuario</a></li>
                </ul>
              </li>
              <?php
            }else if($_SESSION['Rol']=="usuario"){
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: #fcffb4;" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="mostrarProductosComprar.php">Suscribirse</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="modificarUsuario.php">Modificar usuario</a></li>
                  <li><a class="dropdown-item" style="color: #fcffb4;" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" style="color: red;" href="EliminarUsuario.php">Eliminar Usuario</a></li>
                </ul>
              </li>
              
              <?php
            }
       

          }else{
        ?>
        
        <li class="nav-item">
          <a class="nav-link" style="color: #fcffb4;" href="login.php">
            Log in
          </a>
        </li>
        <li>
          <a class="nav-link" style="color: #fcffb4;" href="ingreso.php">
            Registrarse
          </a>
        </li>
        <?php
          }
        ?>
        
      </ul>
    </div>
  </nav>