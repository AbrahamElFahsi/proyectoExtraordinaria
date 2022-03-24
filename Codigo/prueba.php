<?php
require 'ConectorBD.php';
$conexion=conectar(false);
$consulta="select * from usuario";
$con=mysqli_query($conexion,$consulta);
while($usu=mysqli_fetch_assoc($con)){
    echo $usu['nombre'];
}
?>