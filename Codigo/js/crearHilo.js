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
                descri=texto[0]+"<br>";
                break;
                case 2:
                descri=texto[0]+"<br>"+texto[1];
                break;
                case 3:
                descri=texto[0]+"<br>"+texto[1]+"<br>"+texto[2];
                break;
                case 4:
                descri=texto[0]+"<br>"+texto[1]+"<br>"+texto[2]+"<br>"+texto[3];
                break;
                case 5:
                descri=texto[0]+"<br><br>"+texto[1]+"<br>"+texto[2]+"<br>"+texto[3]+"<br>"+texto[4];
                break;
                case 6:
                descri=texto[0]+"<br>"+texto[1]+"<br>"+texto[2]+"<br>"+texto[3]+"<br>"+texto[4]+"<br>"+texto[5];
                break;
        
            default:
                break;
        }
        desceripcioValida=true;
        avisoDescrip.innerHTML="";
        console.log(descri);
        
    }else{
        desceripcioValida=false;
        avisoDescrip.innerHTML="Debe rellenar el campo para subirlo";
    }
}

descripcion.addEventListener('keyup',validarDescripcion);
descripcion.addEventListener('keypress',validarDescripcion);



  //Envio del tema
  let tema=document.getElementById('tema');
  let temaValidado=false;
  function validartema(){
    if (tema.value!=null && tema.value!=undefined) {
        temaValidado=true;
    }else{
        temaValidado=false;
    }
  }
  
  tema.addEventListener('keyup',validartema);
  //Validar Envio
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('crearHiloForm').addEventListener('submit', envioTema); 
  });
  
  function envioTema(evento) {
    descripcion.value=descri;
    if(!temaValidado || !desceripcioValida || !introImagen){
        
        evento.preventDefault();
        document.getElementById('avisoForm').innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }

