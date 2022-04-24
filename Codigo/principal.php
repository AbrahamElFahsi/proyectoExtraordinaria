<?php
require 'ConectorBD.php';
require 'BD/DAOArticulo.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>
<body">
<?php include 'nav.php'; ?>
<! –– generamos un contenedor que va a estar compuesto por dos columnas–>
<div class="container-fluid">
    <div class="row">
    <! ––Para las tarjetas con los hilos que va a tener nuestra pagina–>
        <div class="col-md-9">
            <div class="container-fluid">
                <div class="row">
                <h1 class="text-center col-12" class="col-12 text-center">Hilos para el cuidado de tus gatos</h1>
                <?php
                $hilos=todosHilos($conexion);
                    while($hilo = mysqli_fetch_assoc($hilos)){
                ?>
                <div class="card col-md-5 tarjetas bg-dark p-3 m-3 text-center" >
                    <img class="card-img-top" src="<?php echo $hilo['imagen']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $hilo['tema']; ?></h5>
                        <div class="card-text" style="height:130px;"><?php echo $hilo['descripcion']; ?></div>
                        <form action="hilo.php" method="POST">
                            <input type="hidden" name="idHilo" value="<?php echo $hilo['idHilo']; ?>">
                            <input type="submit" class="btn boton" value="Mostrar Informacion" name="verHilo">
                        </form>
                    </div>
                </div>
                        <?php } ?>
            </div>
        </div>
    </div> 
    
    <! ––Para un carroussel que llevara 5 hilos y otro 15 articulos aleatorios–>
    <div class="col-md-3">
        <div class="container-fluid">
        <! ––Para un carroussel que llevara 5 hilos–>
            <div class="row">
                <h1 class="text-center col-12" class="col-12 text-center">Hilos</h1>
                <div id="carouselExampleFade" class="sombra carousel slide carousel-fade col-12" data-ride="carousel">
                    <div class="carousel-inner">
            
                                    <?php
                                    $secciones=hilosAleatorios($conexion);
                                    $contador=0;
                                    while($seccion = mysqli_fetch_assoc($secciones)){
                                        if($contador==0){
                                    ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $seccion['imagen']; ?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $seccion['tema']; ?></h5>
                                <form action="secciones.php" method="POST">
                                    <input type="hidden" name="seccion" value="<?php echo $seccion['idSeccion']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
                                </form>
                            </div>
                        </div>
                            <?php
                            $contador++;
                            }else{ ?>
                        <div class="carousel-item">
                            <img src="<?php echo $seccion['imagen']; ?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $seccion['tema']; ?></h5>
                                <form action="secciones.php" method="POST">
                                    <input type="hidden" name="seccion" value="<?php echo $seccion['idSeccion']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
                                </form>
                            </div>
                        </div>
                        <?php
                                }
                                }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            
            </div>
        </div>
        <div class="row">
        <h1 class="text-center col-12" class="col-12 text-center">articulos</h1>
                <div id="carouselExampleFade" class="sombra carousel slide carousel-fade col-12" data-ride="carousel">
                    <div class="carousel-inner">
            
                                    <?php
                                    $articulos=articulosAleatorios($conexion);
                                    $contador=0;
                                    while($articulo = mysqli_fetch_assoc($articulos)){
                                        if($contador==0){
                                    ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $articulo['image']; ?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $articulo['cabecera']; ?></h5>
                                <form action="secciones.php" method="POST">
                                    <input type="hidden" name="seccion" value="<?php echo $articulo['idSeccion']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
                                </form>
                            </div>
                        </div>
                            <?php
                            $contador++;
                            }else{ ?>
                        <div class="carousel-item">
                            <img src="<?php echo $articulo['image']; ?>" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $articulo['cabecera']; ?></h5>
                                <form action="secciones.php" method="POST">
                                    <input type="hidden" name="seccion" value="<?php echo $articulo['idSeccion']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Mostrar Informacion" name="filtrarSec">
                                </form>
                            </div>
                        </div>
                        <?php
                                }
                                }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            
        </div>
        <! ––Hasta aqui la la segunda columna del bloque de la derec–>
    </div>
    <! ––hasta aqui el bloque de la derecha–>
</div>
</div>
<?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
</body>
</html>