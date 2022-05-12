<?php
require 'BD/ConectorBD.php';
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
<?php   include 'partes/nav.php';
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
                            }else {
                                ?>
<form method="post" class="ml-3 col-12"> 
            <div class="form-check">
                <input type="hidden" name="usuBanear" value="<?php echo $usu['idUsuario']; ?>">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <input type="radio" class="form-check-input" name="bannear" id="" value="0">
                <label class="form-check-label" for="check">
                    permanente: 
                </label>
                </div>
                <div class="form-check">
                <input type="radio" name="bannear" class="form-check-input" id="fecha" value="1" onchange="javascript:showContent()">
                <label class="form-check-label" for="check">
                    Hasta fecha: 
                </label>
                <div id="content" style="display: none;">
                <?php $fechaymd = date("Y-m-d"); $fechahis = date("H:i");?>
                        <input type="datetime-local" class="" min="<?php echo $fechaymd."T".$fechahis; ?>" name="fechaBaneo" id="">
                </div>
            </div>
                   
                    <input type="submit" value="Banear" name="banneado" class="boton col-12 mb-2">
            </form>
<?php
                         }
if (isset($_POST['banneado'])) {
    if ($_POST['bannear']==0) {
        $bannear=modificarUsuario($conexion,$_POST['usuBanear'],"perBanned",1);
        $bannear1=modificarUsuario($conexion,$_POST['usuBanear'],"banner","null");
        if ($bannear && $bannear1) {
            ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">Se banneo correctamente el usuario <?php echo $moderador['usuario']; ?></h1>
                        </div>
            <?php
        }
    }elseif($_POST['bannear']==1){
        $fecha = date("Y-m-d H:i:s", strtotime($_POST['fechaBaneo']));
        $bannear2=modificarUsuario($conexion,$_POST['usuBanear'],"perBanned",0);
        echo $fecha;
        $bannear3=modificarUsuario($conexion,$_POST['usuBanear'],"banner","$fecha");
        if ($bannear3 && $bannear2) {
            ?>
                        <div class="col-12 mb-2">
                            <h1 class="display-5">Se banneo correctamente el usuario <?php echo $moderador['usuario']; ?> hasta</h1>
                        </div>
            <?php
        }
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
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>