<?php
function consultaUsuarios($conexion){
    $consulta = "Select * from usuario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function campoUsuario($conexion,$campo,$id){
    $consulta = "Select $campo from usuario where idUsuario=$id";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function buscarUsuarioEmail($conexion,$gmail,$dni){
    $consulta = "select * FROM usuario WHERE dni='$dni' AND gmail='$gmail'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function usuarioPorId($conexion,$id){
    $consulta = "Select * from usuario where idUsuario=$id";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaLogin($conexion,$usuario,$password){
    $consulta = "Select * from usuario WHERE  usuario = '$usuario' AND pass = '$password'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaUsuario($conexion,$usuario){
    $consulta = "Select * from usuario WHERE  usuario = '$usuario'";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//Modificar campo
function modificarUsuario($conexion,$idUsuario,$campo,$nuevoValor){
    $consulta = "UPDATE usuario SET $campo = '$nuevoValor' WHERE idUsuario = $idUsuario;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//Insertar usuario
function insertarUsuario($conexion,$nombre, $apellidos, $usuario, $pass, $dni, $direccion, $comunidad, $provincia, $cp, $rol, $email, $telefono){
    $consulta = "INSERT INTO `usuario` (`nombre`, `apellidos`, `usuario`, `pass`, `dni`, `direccion`, `comunidad`, `provincia`, `cp`, `Rol`, `gmail`, `telefono`) VALUES ('$nombre', '$apellidos', '$usuario', '$pass', '$dni', '$direccion', '$comunidad', '$provincia', '$cp', '$rol', '$email', '$telefono')";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//Eliminar usuario
function eliminarUsuario($conexion,$idUsuario){
    $consulta = "DELETE FROM `usuario` WHERE `idUsuario` = $idUsuario;";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function crearSesion($usuario){
    //Queremos que el id de session sea su dni
    session_id($usuario['dni']);
    //Creamos la session
    session_start();
    //Almacenamos en la session los datos del usuario
    foreach($usuario as $indice=>$valor){
        $_SESSION[$indice] = $valor;
    }
}
?>
