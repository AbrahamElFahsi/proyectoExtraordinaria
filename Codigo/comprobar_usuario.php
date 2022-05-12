<?php
require 'BD/ConectorBD.php';
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
           crearSesion($fila);
           header('Location: login.php');
       }else{
           header('Location: ingreso.php');
       }
       
   }
?>