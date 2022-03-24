<?php
//funcion todos los hilos con consulta de todos los hilos trata
function todosHilos($conexion){
    $consulta = "Select * from hilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function articulosPorIdHilo($conexion,$idHilo){
    $consulta = "select usuario.idUsuario as creadorHilo, usuario.usuario as creadorHilo, articulo.idUsuario as idcreadorArticulo, hilo.imagen as imagenHilo, hilo.tema, hilo.descripcion, articulo.image as imagenArticulo, articulo.idArticulo, articulo.cuerpo, articulo.pie, articulo.cabecera, articulo.idUsuario as creadorArticulo from usuario inner join hilo inner join articulo where usuario.idUsuario=hilo.idUsuario AND hilo.idHilo=articulo.idHilo AND articulo.idHilo=$idHilo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function hilosAleatorios($conexion){
    $consulta = "SELECT * FROM hilo ORDER BY rand() LIMIT 5";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function articulosAleatorios($conexion){
    $consulta = "SELECT * FROM articulo ORDER BY rand() LIMIT 10";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>