<?php
session_start();
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">

    <a class="logo" href="principal.php">
      <img src="images/logogato.svg" /> 
      <img src="images/logoHover.svg" />
    </a>
   <div class="navbar w-100 order-3">
        <ul class="navbar-nav ml-auto">
      <?php
          if(isset($_SESSION['dni'])){
            if($_SESSION['Rol']=="adminnistrador"){
              ?>
              <li class="nav-item dropdown">
                <a class="footerLink dropdown-toggle" href="" id="" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarScrollingDropdown">
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="pago.php">Suscribirse</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="crearArticulo.php">Subir articulo</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="crearHilo.php">Subir Hilo</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="adminUsuario.php">Panel usuario</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="adminArticulo.php">Panel articulo</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="adminHilo.php">Panel hilo</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="adminComentarios.php">Panel Comentarios</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li class="deplegableEnlace"><hr class="dropdown-divider"></li>
                  <li class="deplegableEnlace"><a class="text-danger ml-1 text-decoration-none" href="eliminarUsuario.php">Eliminar Usuario</a></li>
                </ul>
              </li>
              <?php
            }else{
              ?>
              <li class="nav-item dropdown">
                <a class="footerLink dropdown-toggle" href="" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  <?php echo  "Bienvenido ".$_SESSION['usuario']; ?>
                </a>
                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarScrollingDropdown">
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="pago.php">Suscribirse</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="modificarUsuario.php">Modificar usuario</a></li>
                  <li class="deplegableEnlace"><a class="footerLink ml-1" href="cerrarSesion.php">Cerrar Usuario</a></li>
                  <li class="deplegableEnlace"><hr class="dropdown-divider"></li>
                  <li class="deplegableEnlace"><a class="text-danger ml-1 text-decoration-none" href="eliminarUsuario.php">Eliminar Usuario</a></li>
                </ul>
              </li>
              
              <?php
            }
       

          }else{
        ?>
        
        <li class="nav-item">
          <a class="footerLink" href="login.php">
            Log in
          </a>
        </li>
        <li>
          <a class="footerLink ml-3" href="ingreso.php">
            Registrarse
          </a>
        </li>
        <?php
          }
        ?>
        
      </ul>
    </div>
  </nav>