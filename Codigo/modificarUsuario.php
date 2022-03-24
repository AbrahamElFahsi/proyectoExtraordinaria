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
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
<?php include 'nav.php'; ?>
<?php
 if (isset($_POST['ModificarUsuAdmin'])) {
     $_SESSION['accion']="administrador";
     $_SESSION['usuarioMo']=$_POST['idUsuMo'];
 }
?>
<div class="container forms">
    <div class="row"><h1 class="text-center col-12">Modificar Usuario</h1></div>
    <div class="row">
        <div class="col-md-6">
            
            <form action="modificarUsuario.php" method="POST" class="row" id="modiUsuario">
                <div class="form-group col-12">
                    <label for="usuario">Usuario <i class="fas fa-user"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $usu=campoUsuario($conexion,"usuario",$_SESSION['usuarioMo']);
                            $usuAModificar=mysqli_fetch_assoc($usu);
                            ?>
                            <small>Su usuario es: <b><?php echo $usuAModificar['usuario']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su usuario es: <b><?php echo $_SESSION['usuario']; ?></b></small>
                            <?php
                        }
                    ?>
                    
                    <input type="text" id="usuarioM" name="usuario" class="form-control" placeholder="Enter User"> 
                    <small id="avisoUsuario">Almenos 6 caracteres y puede incluir digitos</small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="envioModificarUsuario" class="btn btn-primary">
                </div>



            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['envioModificarUsuario'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyUsuario=modificarUsuario($conexion,$_SESSION['usuarioMo'],"usuario",$_POST['usuario']);
                        }else{
                            $resultModifyUsuario=modificarUsuario($conexion,$_SESSION['idUsuario'],"usuario",$_POST['usuario']);
                        }
                        if ($resultModifyUsuario) {
                            
                    ?>
                    <div class="jumbotron-fluid">
                    <div class="container">
                        <h5 class="display-5">Se modifico correctamente</h5>
                        <p class="lead">se modifico correctamente a <?php echo $_POST['usuario'];?></p>
                    </div>
                    </div>
                    <?php
                        }else {
                    ?>
                    <div class=" jumbotron-fluid">
                    <div class="container">
                        <h5 class="display-5">No se consiguio intentelo de nuevo</h5>
                    </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
            <form action="modificarUsuario.php" method="POST" class="row" id="modiContra">
                <div class="form-group col-12">
                    <label for="password">contraseña <i class="fas fa-lock"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $passModificar=campoUsuario($conexion,"pass",$_SESSION['usuarioMo']);
                            $usuAModificarPass=mysqli_fetch_assoc($passModificar);
                            ?>
                            <small>Su contraseña es: <b><?php echo substr($usuAModificarPass['pass'],0,3); ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su Contraseña es: <b><?php echo substr($_SESSION['pass'],0,1); ?>**</b></small>
                            <?php
                        }
                    ?>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
                    <small id="avisoPass">Al menos 8 caracteres, debe incluir Mayuscula, caracteres especiales y numeros</small>
                </div>
                <div class="form-group col-12">
                    <label for="password1">Vuelva a escribir la contraseña <i class="fas fa-lock"></i></label>
                    <input type="password" id="pass1" name="password1" class="form-control" placeholder="Enter password">
                    <small id="avisoPass1"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Contraseña" name="modificarPass" class="btn btn-primary">
                </div>
                
                
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarPass'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyPass=modificarUsuario($conexion,$_SESSION['usuarioMo'],"pass",$_POST['password']);
                        }else {
                            $resultModifyPass=modificarUsuario($conexion,$_SESSION['idUsuario'],"pass",$_POST['password']);
                        }
                        if ($resultModifyPass) {      
                    ?>
                    <div class="jumbotron-fluid">
                    <div class="container">
                        <h5 class="display-5">Se modifico correctamente</h5>
                        <p class="lead"><?php echo $_SESSION['usuario'];?> su contraseña a sido modificado recuerdala para evitar futuros problemas <div id="tempo" style="display: none;"><?php echo $_POST['password'];?></div></p>
                    </div>
                    </div>
                    <?php
                        }else {
                    ?>
                    <div class=" jumbotron-fluid">
                    <div class="container">
                        <h5 class="display-5">No se consiguio intentelo de nuevo</h5>
                    </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
            <form action="modificarUsuario.php" method="POST" class="row" id="validacionEmail">
                <div class="form-group col-12">
                    <label for="email">email <i class="fas fa-user"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $emailModificar=campoUsuario($conexion,"gmail",$_SESSION['usuarioMo']);
                            $usuAModificarEmail=mysqli_fetch_assoc($emailModificar);
                            ?>
                            <small>Su email es: <b><?php echo $usuAModificarEmail['gmail']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su email es: <b><?php echo $_SESSION['email']; ?></b></small>
                            <?php
                        }
                    ?>
                   
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter User"> 
                    <small id="avisoEmail"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarEmail" class="btn btn-primary">
                </div>

            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarEmail'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyEmail=modificarUsuario($conexion,$_SESSION['usuarioMo'],"gmail",$_POST['email']);
                        }else {
                            $resultModifyEmail=modificarUsuario($conexion,$_SESSION['idUsuario'],"gmail",$_POST['email']);
                        }
                       
                        if ($resultModifyEmail) {     
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead"> email a sido modificado a <?php echo $_POST['email'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
            <form action="modificarUsuario.php" method="post" class="row" id="telefonoValidation">
                <div class="form-group col-12">
                    <label for="telefono">telefono <i class="fas fa-user"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $telModificar=campoUsuario($conexion,"telefono",$_SESSION['usuarioMo']);
                            $usuAModificarTel=mysqli_fetch_assoc($telModificar);
                            ?>
                            <small>Su telefono es: <b><?php echo $usuAModificarTel['telefono']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su telefono es: <b><?php echo $_SESSION['telefono']; ?></b></small>
                            <?php
                        }
                    ?>
                    
                    <input type="text" id="telefonoM" name="telefono" class="form-control" placeholder="Enter User"> 
                    <small id="avisoTel"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarT" class="btn btn-primary">
                </div>
            </form>
                    <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarT'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyTelefono=modificarUsuario($conexion,$_SESSION['usuarioMo'],"telefono",$_POST['telefono']);
                        }else {
                            $resultModifyTelefono=modificarUsuario($conexion,$_SESSION['idUsuario'],"telefono",$_POST['telefono']);
                        }
                       
                        if ($resultModifyTelefono) {   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead">numero de telefono a sido modificado a <?php echo $_POST['telefono'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
            <form action="modificarUsuario.php" method="post" class="row" id="nombreForm">
                <div class="form-group col-12">
                    <label for="nombre">Nombre<i class="fas fa-user-tag"></i></label> 
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $NombreModificar=campoUsuario($conexion,"telefono",$_SESSION['usuarioMo']);
                            $usuAModificarNom=mysqli_fetch_assoc($NombreModificar);
                            ?>
                            <small>Su nombre es: <b><?php echo $usuAModificarNom['nombre']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su nombre es: <b><?php echo $_SESSION['nombre']; ?></b></small>
                            <?php
                        }
                    ?> 
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="ej ->Alberto">
                    <small id="avisoNombre"></small>                
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarN" class="btn btn-primary">
                </div>
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarN'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyNombre=modificarUsuario($conexion,$_SESSION['usuarioMo'],"nombre",$_POST['nombre']);
                        }else {
                            $resultModifyNombre=modificarUsuario($conexion,$_SESSION['idUsuario'],"nombre",$_POST['nombre']);
                        }
                        if ($resultModifyNombre) {   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead">Nombre de  a sido modificado a <?php echo $_POST['nombre'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
            ?>
        </div>

        <div class="col-md-6">
            <form action="modificarUsuario.php" method="post" class="row" id="ApellidosForm">
                <div class="form-group col-12">
                    <label for="apellidos">Apellidos<i class="fas fa-user-tag"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $apellidosModificar=campoUsuario($conexion,"nombre",$_SESSION['usuarioMo']);
                            $usuAModificarApellidos=mysqli_fetch_assoc($apellidosModificar);
                            ?>
                            <small>Su nombre es: <b><?php echo $usuAModificarApellidos['nombre']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su apellidos es: <b><?php echo $_SESSION['apellidos']; ?></b></small>
                            <?php
                        }
                    ?> 
                    
                    <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="ej ->Hernandez">
                    <small id="avisoApellidos"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarP" class="btn btn-primary">
                </div>
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarP'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyApellidos=modificarUsuario($conexion,$_SESSION['usuarioMo'],"apellidos",$_POST['apellidos']);
                        }else {
                            $resultModifyApellidos=modificarUsuario($conexion,$_SESSION['idUsuario'],"apellidos",$_POST['apellidos']);
                        }
                        
                       
                        if ($resultModifyApellidos) {   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead">Apellidos a sido modificado a <?php echo $_POST['apellidos'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
            ?>
            <form action="modificarUsuario.php" method="post" class="row" id="dniForm">
                <div class="form-group col-12">
                    <label for="dni">DNI <i class="fas fa-id-card"></i></label> 
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $dniModificar=campoUsuario($conexion,"dni",$_SESSION['usuarioMo']);
                            $usuAModificarDni=mysqli_fetch_assoc($dniModificar);
                            ?>
                            <small>Su dni es: <b><?php echo $usuAModificarDni['dni']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su dni es: <b><?php echo $_SESSION['dni']; ?></b></small>
                            <?php
                        }
                    ?>                            
                    
                    <input type="text" id="dni" name="dni" class="form-control" placeholder="ej ->Alberto">
                    <small id="avisoDNI"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarD" class="btn btn-primary">
                </div>
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarD'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyDNI=modificarUsuario($conexion,$_SESSION['usuarioMo'],"dni",$_POST['dni']);
                        }else {
                            $resultModifyDNI=modificarUsuario($conexion,$_SESSION['idUsuario'],"dni",$_POST['dni']);
                        }
                        
                       
                        if ($resultModifyDNI) {   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead">DNI  a sido modificado a <?php echo $_POST['dni'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
            ?>
            <form action="modificarUsuario.php" method="post" class="row" id="cpcForm">
                <div class="form-group col-12">
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $ComunidadModificar=campoUsuario($conexion,"comunidad",$_SESSION['usuarioMo']);
                            $usuAModificarComunidad=mysqli_fetch_assoc($ComunidadModificar);
                            ?>
                            <small>Su Comunidad es: <b><?php echo $usuAModificarComunidad['comunidad']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su Comunidad es: <b><?php echo $_SESSION['comunidad']; ?></b> Su provincia es: <b><?php echo $_SESSION['provincia']; ?></b> y Su cp es: <b><?php echo $_SESSION['cp']; ?></b></small>
                            <?php
                        }
                    ?>         
                                                                     
                    <div class="control_label">
                        <label for="vacante">Comunidad</label>                           
                        <div class="control_input">
                            <select name="comunidad" id="comunidad">
                                <option value="0">Seleccione una opción</option>
                                <option value="andalucia">Andalucia</option>
                                <option value="Aragón">Aragón</option>
                                <option value="Asturias">Asturias</option>
                                <option value="Baleares">Baleares</option>
                                <option value="Cantabria">Cantabria</option>
                                <option value="PaísVasco">PaísVasco</option>
                                <option value="CastillayLeón">CastillayLeón</option>
                                <option value="cataluña">cataluña</option>
                                <option value="CValenciana">C.Valenciana</option>
                                <option value="Galicia">Galicia</option>
                                <option value="Madrid">Madrid</option>
                                <option value="Navarra">Navarra</option>
                                <option value="Rioja">Rioja</option>
                                <option value="Extremadura">Extremadura</option>
                                <option value="Ceuta">Ceuta</option>
                                <option value="Madrid">Melilla</option>
                            </select>
                        </div>
                        <div class="control_label box--oculto col-12">
                            <label for="provincia">Provincia</label>
                        </div>
                        <div class="control_input box--oculto col-12">
                            <select name="provincia" id="provincia">
                            </select>
                        </div>
                        <div class="control_label box--oculto">
                            <label for="provincia">Codigo Postal</label>
                        </div>
                        <div class="control_input box--oculto">
                            <select name="cp" id="cp">
                            </select>
                        </div>
                    </div>
                    <small id="avisoCPC"> </small>                 
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarCPC" class="btn btn-primary">
                </div>
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarCPC'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyC=modificarUsuario($conexion,$_SESSION['usuarioMo'],"comunidad",$_POST['comunidad']);
                            $resultModifyP=modificarUsuario($conexion,$_SESSION['usuarioMo'],"provincia",$_POST['provincia']);
                            $resultModifyCP=modificarUsuario($conexion,$_SESSION['usuarioMo'],"cp",$_POST['cp']);
                        }else {
                            $resultModifyC=modificarUsuario($conexion,$_SESSION['idUsuario'],"comunidad",$_POST['comunidad']);
                            $resultModifyP=modificarUsuario($conexion,$_SESSION['idUsuario'],"provincia",$_POST['provincia']);
                            $resultModifyCP=modificarUsuario($conexion,$_SESSION['idUsuario'],"cp",$_POST['cp']);
                        }
                        
                        if ($resultModifyC && $resultModifyP && $resultModifyCP) {   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead">comunidad, provincia, cp a sido modificado a <?php echo $_POST['comunidad']."".$_POST['provincia']."".$_POST['cp'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
            ?>
            <form action="modificarUsuario.php" method="post" class="row" id="dirForm">
                <div class="form-group col-12">
                    <label for="direccion">Direccion <i class="fas fa-id-card"></i></label>
                    <?php
                        if ($_SESSION['accion']=="administrador") {
                            $direccionModificar=campoUsuario($conexion,"dirección",$_SESSION['usuarioMo']);
                            $usuAModificarDireccion=mysqli_fetch_assoc($direccionModificar);
                            ?>
                            <small>Su dirección es: <b><?php echo $usuAModificarDireccion['dirección']; ?></b></small>
                            <?php
                        }else{
                            ?>
                            <small>Su dirección es: <b><?php echo $_SESSION['direccion']; ?></b></small>
                            <?php
                        }
                    ?>
                    
                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="C/ Casanova, 8">
                    <small id="avisoDirec"></small>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarDir" class="btn btn-primary">
                </div>
            </form>
            <?php
                    //Hacemos el mecanismo para poder modificar los datos del usuario
                    if (isset($_POST['modificarDir'])) {
                        if ($_SESSION['accion']=="administrador") {
                            $resultModifyDireccion=modificarUsuario($conexion,$_SESSION['usuarioMo'],"direccion",$_POST['direccion']);
                        }else {
                            $resultModifyDireccion=modificarUsuario($conexion,$_SESSION['idUsuario'],"direccion",$_POST['direccion']);
                        }
                       
                       
                        if ($resultModifyDireccion) {   
                            $_SESSION['direccionBefore']=$_SESSION['direccion'];
                            $_SESSION['direccion']=$_POST['direccion'];   
                            ?>
                            <div class="jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">Se modifico correctamente</h5>
                                <p class="lead"><?php echo $_SESSION['usuario'];?> sus direccion de <?php echo $_SESSION['direccionBefore'];?> a sido modificado a <?php echo $_POST['direccion'];?></p>
                            </div>
                            </div>
                            <?php
                                }else {
                            ?>
                            <div class=" jumbotron-fluid">
                            <div class="container">
                                <h5 class="display-5">No se consiguio, intentelo de nuevo</h5>
                            </div>
                            </div>
                        <?php
                        }
                    }
            ?>
            <form action="modificarUsuario.php" method="post" class="row">
                <?php
                if ($_SESSION['Rol']=="administrador") {
                    ?>
                        <div class="form-group col-12">
                            <label for="rol">Rol <i class="fas fa-id-card"></i></label>
                            <small>Su Rol es: <b><?php echo $usMo['Rol']; ?></b></small>
                            <div>
                            <select name="rol">
                                <option value="usuario">Usuario</option>
                                <option value="adminnistrador">Administrador</option>
                            </select>
                            </div>
                        </div>
               
                <div class="form-group col-4">
                    <input type="submit" value="Modificar Usuario" name="modificarR" class="btn btn-primary">
                </div>
            </form>
            <?php
                }
                ?>                        
        </div>
    </div>
    

    
</div>

<?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>
</html>