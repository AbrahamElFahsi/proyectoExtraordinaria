<?php
require 'ConectorBD.php';
require 'BD/DAOUsuario.php';
$conexion=conectar(false);
   //Voy a recoger los datos del formulario
   $usuario = $_POST['usuario'];
   $password = $_POST['password'];


   //Imprimo por pantalla
   echo "Usuario: $usuario <br>";
   echo "Password: $password <br>";
   //Hacemos la consulta
   $existeUsuario = consultaLogin($conexion,$usuario,$password);
   //Hacemos la consulta del usuario para saber si no se acuerda de la contraseña
   //Comprobamos si existe el usuario
   $existeSoloUsuario=consultaUsuario($conexion, $usuario);
   if(mysqli_num_rows($existeUsuario)==1){
       $fila = mysqli_fetch_assoc($existeUsuario);

       crearSesion($fila);

       header('Location: principal.php');
       
      
   }else{
       if(mysqli_num_rows($existeSoloUsuario)==1){
           //echo "contraseña incorrecta";
           $fila = mysqli_fetch_assoc($existeSoloUsuario);
           /*
           foreach($fila as $atributo=>$valor){
               echo $atributo." : ".$valor." <br>";
           }
           */
           crearSesion($fila);
           $url ="recuperar_pass.php";
           $texto= "recuperar la contraseña";
           echo "<a href=$url>$texto</a><br>";
           $url1 ="Login.html";
           $texto1= "volver al login";
           echo "<a href=$url1>$texto1</a>";
           header('Location: login.php');
       }else{
           echo "<p> El usuario no existe </p>";
           $url ="ingresar_usuario.php";
           $texto= "Ingresar usuario";
           echo "<a href=$url>$texto</a>";
           header('Location: ingreso.php');
       }
       
   }
?>