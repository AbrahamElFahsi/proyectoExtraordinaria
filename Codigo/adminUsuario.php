<?php
require 'ConectorBD.php';
require 'BD/DAOUsuario.php';
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
</head>
<body>
<?php   include 'nav.php';
            if ($_SESSION['Rol']!="adminnistrador") {
                header('Location: cerrarSesion.php');
            }
            $fecha = date("Y-m-d H:i:00",time());
            $baneo = $_SESSION['banner'];
    if ($fecha<$baneo || $_SESSION['perBanned']==1) {
        header('Location: principal.php');
    }
    ?>
<div class="container-fluid forms">
    <div class="row"><h1 class="text-center col-12">Panel de administrador de usuario</h1></div>
        <div class=row>  
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">dni</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Fecha de suscripcion</th>
                    <th scope="col">Comunidad</th>
                    <th scope="col">Provincia</th>
                    <th scope="col">Cp</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Baneo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $usuarios=consultaUsuarios($conexion);
                        While($usu=mysqli_fetch_assoc($usuarios)){
                    ?>
                    <tr>
                    <th scope="row"><?php echo $usu['idUsuario']; ?></th>
                    <td><?php echo $usu['usuario']; ?></td>
                    <td><?php echo $usu['nombre']; ?></td>
                    <td><?php echo $usu['apellidos']; ?></td>
                    <td><?php echo $usu['dni']; ?></td>
                    <td><?php echo $usu['telefono']; ?></td>
                    <td><?php echo $usu['fechaSuscripcion']; ?></td>
                    <td><?php echo $usu['comunidad']; ?></td>
                    <td><?php echo $usu['provincia']; ?></td>
                    <td><?php echo $usu['cp']; ?></td>
                    <td><?php echo $usu['direccion']; ?></td>
                    <td><?php 
                         $fecha = date("Y-m-d H:i:00",time());
                         $baneo = $usu['banner'];

                         if($fecha<$baneo || $usu['perBanned']==1){
                            ?>
                            <form action="adminUsuario.php" method="post"><input type="hidden" name="usuarioQbanneo" value="<?php echo $usu['idUsuario']; ?>"> <input type="submit" class="boton" name="quitarBaneo" value="Quitar banneo"></form>
                            <?php
                            if (isset($_POST['quitarBaneo'])){
                                echo $_POST['usuarioQbanneo'];
                                $AHORA = date("Y-m-d H:i:00",time());
                                $bannear=modificarUsuario($conexion,$_POST['usuarioQbanneo'], "perBanned", 0);
                                $bannear1=modificarUsuario($conexion,$_POST['usuarioQbanneo'], "banner", $AHORA);
                                
                            }
                         }

                    ?> </td>
                    
                    <td><?php echo $usu['Rol']; ?></td>
                    <td>
                        <form action="modificarUsuario.php" method="POST" class="row"><input type="hidden" name="idUsuMo" value="<?php echo $usu['idUsuario']; ?>"><input type="submit" value="modificar" name="ModificarUsuAdmin" class="btn boton col-12"></form>
                        <form action="eliminarUsuario.php" method="POST" class="row"><input type="hidden" name="idUsuElim" value="<?php echo $usu['idUsuario']; ?>"><input type="submit" value="Eliminar" name="eliminarUsuAdmin" class="btn botonElim col-12"></form>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <form action="crearUsuario.php" method="post">
            <input type="submit" value="Crear usuario" name="crearArticulo" class="mb-1 col-12 mx-auto boton">
        </form>

    
</div>
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
</html>