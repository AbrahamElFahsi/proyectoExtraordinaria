<?php
require 'BD/ConectorBD.php';
require 'BD/DAOArticulo.php';
require 'BD/DAOHilo.php';
require 'BD/DAOUsuario.php';
require 'BD/DAOComentarios.php';
$conexion=conectar(false);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'partes/nav.php'; 
?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <?php
        if (isset($_POST['verArticulo'])) {
            $_SESSION['idVerArticulo']=$_POST['idArticulo'];
            
        }
            $artic=articulosPorIdArticulo($conexion,$_SESSION['idVerArticulo']);
            $articulo=mysqli_fetch_assoc($artic);
    ?>
    <div class="row mt-5">
        <div class="card m-auto col-11 mb-5 articulo">
            
                <img src="<?php  echo $articulo['imagenArticulo']; ?>" alt="" class="card-img-top mt-3">
                <div class="card-body col-12">
                    <h5 class="card-title"><?php  echo $articulo['cabecera']; ?></h5>
                    <hr>
                    <div class="col-12">
                        <p><?php echo $articulo['cuerpo']; ?></p>
                    </div>
                    <hr>
                    <div class="col-12">
                        <p><?php echo $articulo['pie']; ?></p>
                    </div>
                    
                    <p class="card-text float-right">Autor <u><?php 
                        $usu=usuarioPorId($conexion,$articulo['idcreadorArticulo']);
                        $usuario=mysqli_fetch_assoc($usu);
                        echo $usuario['usuario']; ?></u>
                    </p>
                </div>
            
        </div>

    </div>
    <div class="row mt-1">
        <div class="col-12 m-auto">
            <div class="jumbotron comentarios">
                <div class="container">
                    <div class="row">
                        <h4 class="center-text">Aporte su granito de arena</h4>
                    </div>
                    <br>
                    <br>
                </div> 
                <?php
                $consultaComentarios=comentariosPorIdArticulo($conexion,$_SESSION['idVerArticulo']);
                if (mysqli_num_rows($consultaComentarios)>0) {
                    while ($comentario=mysqli_fetch_assoc($consultaComentarios)) {
                        if ($comentario['idRespuesta']==0) {
                            
                        
                            ?>
                                    <div class="container comentariolevelOne mb-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class=""><?php echo $comentario['usuario']; ?></h5>
                                                <small class="float-right col-3 mr-3"><?php $fecha = new DateTime($comentario['fecha']); echo date_format($fecha,"d/m/Y H:i"); ?></small>
                                            </div>
                                        </div>
<?php
$fechaFin=date("Y-m-d H:i:s",strtotime($comentario['fecha']."+ 20 minute"));
$fecha_actual = date("Y-m-d H:i:s");
if (($fechaFin>=$fecha_actual && $_SESSION['idUsuario']==$comentario['idUsuario']) || $_SESSION['Rol']=="administrador") {
?>
<form action="modificarComentario.php" method="post" class="ml-3"> 
    <div class="form-group col-12">
        <input type="hidden" name="idComen" value="<?php echo $comentario['idComentario']; ?>">
        <input type="text" name="contenido" class="col-12" value="<?php echo $comentario['contenido']; ?>">
        <input type="submit" value="Modificar" name="modificarComen" class="btn boton col-12">
    </div>
</form>
<?php

}else{
?>
    <p class="lead ml-2"><?php echo $comentario['contenido']; ?></p>
<?php
}             
                                            if ($_SESSION['Rol']=="adminnistrador") {
                                            ?>
                                                <form action="panelModeracion.php" method="post" class="form-group mt-1 ml-5 float-left col-5">
                                                    <input type="hidden" name="idComent" value="<?php echo $comentario['idComentario']; ?>">
                                                    <input type="submit" value="Moderación" name="moderador" class="btn boton col-12 mx-auto">
                                                </form>
                                            <?php
                                            }
                                        ?>
                                    </div> 
                                    <hr>                       
                            <?php
                        }
                    }
                }else {
                ?>
                    <div class="container">
                        <h5>Añade tu opinion </h5>
                    </div>
                <?php
                    
                }

                if (isset($_SESSION['usuario'])) {
                                        ?>
                        <form action="hilo.php" method="post" class="">
                            <div class="col-12">
                                <div class="form-group col-12">
                                    <label for="comentario">Escribe aqui tu aportacion al foro</label>
                                    <input type="text" id="comentario" class="col-12" name="comentario" maxlength="99" class="form-control" placeholder="Enter User"> 
                                    <input type="submit" value="comentar" name="comentarNivelOne" class="btn boton col-12 mx-auto mt-1">   
                                </div>
                            </div>
                        </form>
        <?php
                }
        ?>
            </div>            
        </div>
        
    </div>
</div>
<?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>