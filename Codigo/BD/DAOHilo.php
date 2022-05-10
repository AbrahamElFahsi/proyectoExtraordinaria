<?php
function consultaHilos($conexion){
    $consulta = "SELECT * from hilo INNER JOIN usuario where hilo.idUsuario=usuario.idUsuario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaSoloHilos($conexion){
    $consulta = "SELECT * from hilo ";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function eliminarHilosArticulos($conexion,$idHilo){
    $consulta = "DELETE FROM `articulo` WHERE `idHilo` = $idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    $consulta1 = "DELETE FROM `hilo` WHERE `idHilo` = $idHilo";
    $resultado1 = mysqli_query($conexion,$consulta1);
    return $resultado;
}
function eliminarHiloConCambioDeArticulos($conexion,$idHilo,$idHiloCambio){
    
    $consulta1 = "UPDATE `articulo` SET idHilo=$idHiloCambio WHERE `idHilo`=$idHilo";
    $resultado1 = mysqli_query($conexion,$consulta1);
    $consulta = "DELETE FROM `hilo` WHERE `idHilo` = $idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function consultaHilosPorId($conexion,$id){
    $consulta = "SELECT * from hilo INNER JOIN usuario where hilo.idUsuario=usuario.idUsuario AND hilo.idHilo=$id";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//para hilo
function consultaTemaHilo($conexion,$idHilo){
    $consulta = "select tema from hilo where idHilo=$idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function insertarHilo($conexion,$idUsuario,$imagen,$tema,$descripcion){
    $consulta = "INSERT INTO hilo (idUsuario, imagen, tema, descripcion) VALUES ($idUsuario, '$imagen', '$tema', '$descripcion')";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function modificarHilo($conexion,$idHilo,$campo,$nuevoValor){
    $consulta = "UPDATE hilo SET $campo = '$nuevoValor' WHERE idHilo = $idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>