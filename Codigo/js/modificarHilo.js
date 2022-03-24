function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
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

let descripcion=document.getElementById('descripcion');
let avisoDescrip=document.getElementById('avisoDescripcion');
let desceripcioValida;
let descri;
function validarDescripcion(){
    if (descripcion.value!="" || descripcion.value!=undefined) {
        
        let texto=descripcion.value.split(/\r?\n/g);
        let saltos=texto.length;
        switch (saltos) {
            case 1:
                descri="<p>"+texto[0]+"</p>";
                break;
                case 2:
                descri="<p>"+texto[0]+"</p><p>"+texto[1]+"</p>";
                break;
                case 3:
                descri="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p>";
                break;
                case 4:
                descri="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p>";
                break;
                case 5:
                descri="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p>";
                break;
                case 6:
                descri="<p>"+texto[0]+"</p><p>"+texto[1]+"</p><p>"+texto[2]+"</p><p>"+texto[3]+"</p><p>"+texto[4]+"</p><p>"+texto[5]+"</p>";
                break;
        
            default:
                break;
        }
        desceripcioValida=true;
        avisoDescrip.innerHTML="";
        console.log(descri);
        
    }else{
        desceripcioValida=false;
        avisoDescrip.innerHTML="Debe rellenar el campo para modificarlo";
    }
}

descripcion.addEventListener('keyup',validarDescripcion);
descripcion.addEventListener('keypress',validarDescripcion);

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('modDescrip').addEventListener('submit', envioDes); 
  });
  
  function envioDes(evento) {
    descripcion.value=descri;
    if(!desceripcioValida){
        
        evento.preventDefault();
        avisoDescrip.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }

  //Envio del tema
  let tema=document.getElementById('tema');
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('temaForm').addEventListener('submit', envioTema); 
  });
  
  function envioTema(evento) {
    if(tema.value==null || tema.value=="" || tema.value==undefined){
        evento.preventDefault();
        document.getElementById('avisoTema').innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }

