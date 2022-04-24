let introImagen=false;
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
                introImagen=true;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}
//Validar Envio imagen
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modificarImagenArticulo').addEventListener('submit', modificarImagenArticulo); 
  });
  
  function modificarImagenArticulo(evento) {
    if(!introImagen){
        
        evento.preventDefault();
        document.getElementById('avisoImagen').innerHTML="Seleccione una imagen antes de modificar";
    }
    }
//Cabecera
let cabecera=document.getElementById('cabecera');
let cabeceraValidada=false;
function validarCabecera(){
  if (cabecera.value!=null && cabecera.value!=undefined && cabecera.value!="") {
      cabeceraValidada=true;
      document.getElementById('avisocabecera').innerHTML=" ";
  }else{
      cabeceraValidada=false;
      document.getElementById('avisocabecera').innerHTML="Rellene la cabecera para modificarla";
  }
}
cabecera.addEventListener('keyup',validarCabecera);
//Validar Envio cabecera
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modificarCabeceraArticulo').addEventListener('submit', modificarCabeceraArticulo); 
  });
  
  function modificarCabeceraArticulo(evento) {
    if(!cabeceraValidada){
        evento.preventDefault();
        document.getElementById('avisoEnvioCabecera').innerHTML="Rellene la cabecera";
    }
    }

//Hilo
let Hilo=document.getElementById('hilo');
let hiloValidado=false;
function validarHilo(){
  if (Hilo.value!=0) {
      hiloValidado=true;
  }else{
      hiloValidado=false;
  }
}
Hilo.addEventListener('change',validarHilo);
//Validar Envio Hilo
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modificarHilodeArticulo').addEventListener('submit', modificarHiloArticulo); 
  });
  
  function modificarHiloArticulo(evento) {
    if(!hiloValidado){
        evento.preventDefault();
        document.getElementById('avisoHilo').innerHTML="elija una opcion valida";
    }
    }

//Cuerpo
let cuerpo=document.getElementById('cuerpo');
let cuerpoValidado;
let cuerpoTratado;
function validarCuerpo(){
    if (cuerpo.value!="" || cuerpo.value!=undefined || cuerpo.value!=null) {
        let texto=cuerpo.value.split(/\r?\n/g);
        let saltos=texto.length;
        switch (saltos) {
            case 1:
                cuerpoTratado="<p>"+texto[0]+"</p>";
                break;
                case 2:
                cuerpoTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p>";
                break;
                case 3:
                cuerpoTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p>";
                break;
                case 4:
                cuerpoTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p>";
                break;
                case 5:
                cuerpoTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p>";
                break;
                case 6:
                cuerpoTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p><p>"+texto[5]+"</p>";
                break;
        
            default:
                break;
        }
        cuerpoValidado=true;
        document.getElementById('avisoCuerpo').innerHTML=" ";
        console.log(cuerpoTratado);
        
    }else{
        cuerpoValidado=false;
        document.getElementById('avisoCuerpo').innerHTML="Rellene el campo para modificarlo ";
    }
}

cuerpo.addEventListener('keypress',validarCuerpo);
//Validar Envio Cuerpo
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modiCuerArticulo').addEventListener('submit', modificarCuerpoArticulo); 
  });
  
  function modificarCuerpoArticulo(evento) {
    if(!cuerpoValidado){
        evento.preventDefault();
        document.getElementById('avisoEnvioCuerpo').innerHTML="Debe rellenar correctamente el campo";
    }else{
        cuerpo.value=cuerpoTratado;
    }
    }

//Pie de Post
let pie=document.getElementById('pie');
let pieValidado;
let pieTratado;
function validarPie(){
    if (pie.value!="" || pie.value!=undefined) {
        let texto=pie.value.split(/\r?\n/g);
        let saltos=texto.length;
        switch (saltos) {
            case 1:
                pieTratado="<p>"+texto[0]+"</p>";
                break;
                case 2:
                pieTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p>";
                break;
                case 3:
                pieTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p>";
                break;
                case 4:
                pieTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p>";
                break;
                case 5:
                pieTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p>";
                break;
                case 6:
                pieTratado="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p><p>"+texto[5]+"</p>";
                break;
        
            default:
                break;
        }
        pieValidado=true;
        console.log(pieTratado);
        
    }else{
        pieValidado=false;
    }
}

pie.addEventListener('keyup',validarPie);
pie.addEventListener('keypress',validarPie);
//Validar Envio pie
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modiPieForm').addEventListener('submit', envioPieArticulo); 
  });
  
  function envioPieArticulo(evento) {
    if(!pieValidado){
        
        evento.preventDefault();
        document.getElementById('avisoenvioPie').innerHTML="Debe ser rellenado correctamente antes de enviar";
    }else{
      
        pie.value=pieTratado;
    }
    }
    