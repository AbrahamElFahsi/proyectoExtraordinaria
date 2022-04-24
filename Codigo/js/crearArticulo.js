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
//Cabecera
let cabecera=document.getElementById('cabecera');
let cabeceraValidada=false;
function validarCabecera(){
  if (cabecera.value!=null && cabecera.value!=undefined) {
      cabeceraValidada=true;
  }else{
      cabeceraValidada=false;
  }
}

cabecera.addEventListener('keyup',validarCabecera);
//Hilo
let Hilo=document.getElementById('hilo');
let hiloValidado=false;
function validarHilo(){
  if (Hilo.value!=0) {
      hiloValidado=true;
      console.log(Hilo.value);
  }else{
      hiloValidado=false;
      console.log(Hilo.value);
  }
}

Hilo.addEventListener('change',validarHilo);
//Cuerpo
let cuerpo=document.getElementById('cuerpo');
let cuerpoValidado;
let cuerpoTratado;
function validarCuerpo(){
    if (cuerpo.value!="" || cuerpo.value!=undefined) {
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
        console.log(cuerpoTratado);
        
    }else{
        cuerpoValidado=false;
    }
}

cuerpo.addEventListener('keyup',validarCuerpo);
cuerpo.addEventListener('keypress',validarCuerpo);
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
//Validar Envio
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('crearArticuloForm').addEventListener('submit', envioArticulo); 
  });
  
  function envioArticulo(evento) {
    if(!cabeceraValidada || !cuerpoValidado || !pieValidado || !introImagen || Hilo.value==0){
        
        evento.preventDefault();
        document.getElementById('avisoForm').innerHTML="Debe ser rellenado correctamente antes de enviar";
    }else{
        cuerpo.value=cuerpoTratado;
        pie.value=pieTratado;
    }
    }
    
//Cambiar parrafos html a usuario si aparece
