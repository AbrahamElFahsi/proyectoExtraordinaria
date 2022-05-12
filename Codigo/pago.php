<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="F6G4CRHPDD6TU">
<input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>
<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=CWJ3LRNEHZBCJ">
<IMG SRC="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_unsubscribe_LG.gif" BORDER="0">
</A>
-->
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
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'partes/nav.php'; ?>
<div class="container forms p-3">
      <?php
    
 

          $fecha_actual = date("Y-m-d H:i:00",time());
          $fecha_entrada =$_SESSION['fechaSuscripcion'];
          if($fecha_actual < $fecha_entrada){
              ?>
            <div class="jumbotron-fluid">
                <h1 class="text-center col-12">Suscripción</h1>
                <h4 class="text-center">Su suscripción esta activa hasta el <?php echo $fecha_entrada; ?></h4>
                <p class="text-center">Desea anular su suscripción</p>
                <div class="col-12 d-flex justify-content-center">
                    <A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=CWJ3LRNEHZBCJ">
                        <IMG SRC="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_unsubscribe_LG.gif" BORDER="0">
                    </A>
                </div>
            </div>

              <?php
            }else {
                ?>
            <div class="jumbotron-fluid mb-3 col-12">
                <h4 class="text-center">Suscríbase para disfrutar de los articulos premium, y da lo mejor de ti con tu gato</h4>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="d-flex justify-content-center ">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="F6G4CRHPDD6TU">
                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>

              <?php
            }
      ?>

</div>
    <?php include 'partes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b57da3fc72.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>