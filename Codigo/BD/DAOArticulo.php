<?php
//funcion todos los hilos con consulta de todos los hilos trata
function todosHilos($conexion){
    $consulta = "Select * from hilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//Todos los articulos
function todosArticulos($conexion){
    $consulta = "select articulo.idHilo, usuario.idUsuario as idCreadorHilo, usuario.usuario as creadorHilo, articulo.idUsuario as idcreadorArticulo, articulo.estado, hilo.imagen as imagenHilo, hilo.tema, hilo.descripcion, articulo.image as imagenArticulo, articulo.idArticulo, articulo.cuerpo, articulo.pie, articulo.cabecera from usuario inner join hilo inner join articulo where usuario.idUsuario=hilo.idUsuario AND hilo.idHilo=articulo.idHilo ORDER BY articulo.idHilo ASC, articulo.idArticulo ASC";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function articulosPorIdArticulo($conexion,$idArticulo){
    $consulta = "select usuario.idUsuario as creadorHilo, usuario.usuario as creadorHilo, articulo.idUsuario as idcreadorArticulo, articulo.estado, hilo.imagen as imagenHilo, hilo.tema, hilo.descripcion, articulo.image as imagenArticulo, articulo.idArticulo as idArticulo, articulo.cuerpo, articulo.pie, articulo.cabecera, articulo.idUsuario as creadorArticulo from usuario inner join hilo inner join articulo where usuario.idUsuario=hilo.idUsuario AND hilo.idHilo=articulo.idHilo AND articulo.idArticulo=$idArticulo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function articulosPorIdHilo($conexion,$idHilo){
    $consulta = "select usuario.idUsuario as creadorHilo, usuario.usuario as creadorHilo, articulo.idUsuario as idcreadorArticulo, articulo.estado, hilo.imagen as imagenHilo, hilo.tema, hilo.descripcion, articulo.image as imagenArticulo, articulo.idArticulo as idArticulo, articulo.cuerpo, articulo.pie, articulo.cabecera, articulo.idUsuario as creadorArticulo, articulo.premium from usuario inner join hilo inner join articulo where usuario.idUsuario=hilo.idUsuario AND hilo.idHilo=articulo.idHilo AND articulo.idHilo=$idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function hilosAleatorios($conexion){
    $consulta = "SELECT * FROM hilo ORDER BY rand() LIMIT 5";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//actualizar articulo
function actualizarArticulo($conexion,$campo,$nuevoValor,$idArticulo){
    $consulta = "UPDATE articulo SET $campo = '$nuevoValor' WHERE idArticulo = $idArticulo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//insertar usuario
function insertarArticulo($conexion,$image,$idHilo,$cuerpo,$pie,$cabecera,$idUsuario){
    $consulta = "INSERT INTO `articulo` (`image`, `idHilo`, `cuerpo`, `pie`, `cabecera`, `idUsuario`) VALUES ('$image', '$idHilo', '$cuerpo', '$pie', '$cabecera', '$idUsuario')";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
//Eliminar Articulo
function eliminarArticulo($conexion,$idArticulo){
    $consulta = "DELETE FROM `articulo` WHERE `idArticulo` = $idArticulo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function articulosAleatorios($conexion){
    $consulta = "SELECT * FROM articulo ORDER BY rand() LIMIT 10";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>