<?php
function todosComentarios($conexion){
    $consulta = "SELECT comentarios.idComentario, comentarios.idUsuario, comentarios.fecha, comentarios.contenido, comentarios.idArticulo, usuario.usuario, articulo.cabecera FROM comentarios INNER JOIN usuario INNER JOIN articulo WHERE usuario.idUsuario=comentarios.idUsuario AND comentarios.idArticulo=articulo.idArticulo";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function comentariosPorIdArticulo($conexion,$idArticulo){
    $consulta = "SELECT comentarios.idComentario, comentarios.idUsuario, comentarios.idRespuesta, comentarios.fecha, comentarios.fecha, comentarios.contenido, comentarios.idArticulo, usuario.usuario FROM comentarios INNER JOIN usuario INNER JOIN articulo WHERE usuario.idUsuario=comentarios.idUsuario AND comentarios.idArticulo=articulo.idArticulo AND comentarios.idArticulo=$idArticulo order by comentarios.fecha DESC";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function respuestasDeComentario($conexion,$idComenResponde){
    $consulta = "SELECT comentarios.idComentario, comentarios.idUsuario, comentarios.idRespuesta, comentarios.fecha, comentarios.fecha, comentarios.contenido, comentarios.idArticulo, usuario.usuario FROM comentarios INNER JOIN usuario INNER JOIN articulo WHERE usuario.idUsuario=comentarios.idUsuario AND comentarios.idArticulo=articulo.idArticulo AND comentarios.idRespuesta<>0 AND comentarios.idRespuesta=$idComenResponde order by comentarios.fecha DESC";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function responderAComentario($conexion,$contenido,$idUsuario,$idRespuesta,$fecha,$idArticulo){
    $consulta = "INSERT INTO `comentarios` (`idUsuario`, `idRespuesta`, `fecha`, `contenido`, `idArticulo`) VALUES ('$idUsuario', '$idRespuesta', '$fecha', '$contenido', '$idArticulo')";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function modificarComentario($conexion,$idComentario,$nuevo){
    $consulta = "UPDATE comentarios SET contenido = '$nuevo' WHERE idComentario = $idComentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function comentarioModeracion($conexion,$idComentario){
    $consulta = "select usuario.usuario, comentarios.idComentario, comentarios.idUsuario, comentarios.idRespuesta, comentarios.fecha, comentarios.contenido from usuario inner join comentarios where comentarios.idUsuario=usuario.idUsuario AND comentarios.idComentario=$idComentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
function eliminarComentario($conexion,$idComentario){
    $consulta = "DELETE FROM `comentarios` WHERE `idComentario` = $idComentario";
    $resultado = mysqli_query($conexion,$consulta);
    return $resultado;
}
?>