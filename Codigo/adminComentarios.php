<?php
require 'BD/ConectorBD.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php   include 'partes/nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
    ?>
<div class="container-fluid forms">
    <div class="row"><h1 class="text-center col-12">Panel de administrador de usuario</h1></div>
    <div class="row">  
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                <th scope="col">Id Comentario</th>
                <th scope="col">Id Usuario</th>
                <th scope="col">Usuario</th>
                <th scope="col">Comentario</th>
                <th scope="col">Cabecera Articulo</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $hilo=todosComentarios($conexion);
                    While($hiloMostrar=mysqli_fetch_assoc($hilo)){
                ?>
                <tr>
                <th scope="row"><?php echo $hiloMostrar['idComentario']; ?></th>
                <td><?php echo $hiloMostrar['idUsuario']; ?></td>
                <td><?php echo $hiloMostrar['usuario']; ?></td>
                <td><?php echo $hiloMostrar['contenido']; ?></td>
                <td><?php echo $hiloMostrar['cabecera']; ?></td>
                <td>
                    <form action="panelModeracion.php" method="POST" class="row"><input type="hidden" name="idComent" value="<?php echo $hiloMostrar['idComentario']; ?>"><input type="submit" value="modificar" name="moderador" class="btn boton col-12"></form>
                </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
        
</div>
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>