<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a477e7ee05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <?php 
  
            require 'ConectorBD.php';
            require 'BD/DAOUsuario.php'; 
            require 'BD/DAOArticulo.php'; 
            $conexion=conectar(false); 
            
            ?>
    <title>Login</title>
</head>
<body class="fondo"> 
<?php  include 'nav.php'; 
    if (empty(session_id())) {

        header('Location: cerrarSesion.php');
    }
    ?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
<?php
        $fecha = date("Y-m-d H:i:00",time());
        $baneo = $_SESSION['banner'];
if ($fecha<$baneo || $_SESSION['perBanned']==1) {
    ?>
<div class="jumbotron-fluid row titulo">
                <h1 class="text-center col-12">Lo siento esta usted baneado</h1>
                <h4 class="text-center col-12">Por no seguir las normas de uso</h4>
            </div>
    <?php
}else {
    

        ?>
    <div class="row mt-2">
    <! ––Para las tarjetas con los hilos que va a tener nuestra pagina–>
        <div class="col-md-9">
            <div class="container-fluid">
                <div class="row">
                <h1 class="text-center col-12 titulo">Hilos para el cuidado de tus gatos</h1>
                <?php
                $hilos=todosHilos($conexion);
                    while($hilo = mysqli_fetch_assoc($hilos)){
                ?>
                <div class="card col-md-5 tarjetas p-3 m-3 text-center" >
                    <img class="card-img-top" src="<?php echo $hilo['imagen']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="display-4"><?php echo $hilo['tema']; ?></h5>
                        <div class="col-12"><p><?php echo $hilo['descripcion']; ?></p></div>
                    </div>
                    <?php if (isset($_SESSION['usuario'])) { ?>
                        <form action="hilo.php" method="POST">
                            <input type="hidden" name="idHilo" value="<?php echo $hilo['idHilo']; ?>">
                            <input type="submit" class="btn boton col-10" value="Mostrar Información" name="verHilo">
                        </form>
                    <?php }else { ?>
                        <form action="hilo.php" class="blur" method="POST">
                            <input type="submit" class="btn boton col-10" value="Mostrar Información" name="verHilo">
                        </form>
                        <?php } ?>
                </div>
                        <?php } ?>
            </div>
        </div>
    </div> 
    
    <! ––Para un carroussel que llevara 5 hilos Aleatorios–>
    <aside class="col-md-3">
        <div id="carouselExampleIndicators" class="carousel slide col-12" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner mt-3">
                                        <?php
                                        $articulos=hilosAleatorios($conexion);
                                        $contador=0;
                                        while($articulo = mysqli_fetch_assoc($articulos)){
                                            if($contador==0){
                                        ?>
                            <div class="carousel-item active">
                                <img src="<?php echo $articulo['imagen']; ?>" class="d-block w-100">
                                <div class="carousel-caption">
                                    <h5><?php echo $articulo['tema']; ?></h5>
                                    <?php if (isset($_SESSION['usuario'])) { ?>
                        <form action="hilo.php" method="POST">
                            <input type="hidden" name="idHilo" value="<?php echo $articulo['idHilo']; ?>">
                        <input type="submit" class="btn boton col-10" value="Ver" name="verHilo">
                    </form>
                    <?php }else { ?>
                        <form action="hilo.php" class="blur" method="POST">
                            <input type="submit" class="btn boton col-10" value="Ver" name="verHilo">
                        </form>
                        <?php } ?>
                                </div>
                            </div>
                                <?php
                                $contador++;
                                }else{ ?>
                            <div class="carousel-item">
                                <img src="<?php echo $articulo['imagen']; ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption">
                                    <h5><?php echo $articulo['tema']; ?></h5>
                                    <?php if (isset($_SESSION['usuario'])) { ?>
                        <form action="hilo.php" method="POST">
                            <input type="hidden" name="idHilo" value="<?php echo $articulo['idHilo']; ?>">
                        <input type="submit" class="btn boton col-10" value="Ver" name="verHilo">
                    </form>
                    <?php }else { ?>
                        <form action="hilo.php" class="blur" method="POST">
                            <input type="submit" class="btn boton col-10" value="Ver" name="verHilo">
                        </form>
                        <?php } ?>
                                </div>
                            </div>
                            <?php
                                    }
                                    }
                            ?>
            </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="col-12 mt-5 d-flex justify-content-center" style="height: 300px;" id="cajaAnimacion">
                <img class="col-12 p-1" src="images/imagesAnimation/1.svg" id="imagen">
            </div>
        </div>
        <! ––hasta aqui el bloque de la derecha–>
        
        
        
    </aside>
    </div>
<?php
//cierro en caso de banneo
}
?>
</div>
<?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js\script.js"></script>
</body>
</html>