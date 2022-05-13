const expr={telefono:/[0-9]{9}/, usuario:/[a-zA-ZáéíóúÁÉÍÓÚ]{6,45}/, dni:/^[0-9]{8}[a-zA-Z]$/, email:/^[A-Za-z]{1,15}[@]{1}[A-Za-z]{1,15}[.]{1}[A-Za-z]{1,5}$/, pass:/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,40}/, nombre:/^[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]{2,}?$/, direccion:/^([A-Za-záéíóúÁÉÍÓÚ/,0-9]{1,}[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}){0,50}?$/}


//Modificar usuario
//Validacion del usuario 
let usuarioM=document.getElementById('usuarioM');
let avisoUsuaM=document.getElementById('avisoUsuario');
let inputValidado={Usuario:false, Pass:false}
function validarUsuario(){
    if(usuarioM.value!="" && usuarioM.value!=undefined){
        //Comprobamos que sigue la expresion regular
        if(/[a-zA-ZáéíóúÁÉÍÓÚ]{6,45}/.test(usuarioM.value)){
            //cambiamos el color del borde
            usuarioM.classList.remove('is-invalid');
            usuarioM.classList.add('is-valid');
            //ponemos si se cumple que se ha validado
            inputValidado.Usuario=true;
            //inputValidadoIng[0]=true;
            //vaciamos el aviso 
            avisoUsuaM.innerHTML="  ";
        }else{
            usuarioM.classList.remove('is-valid');
            usuarioM.classList.add('is-invalid');
            
            //no sigue la expresion borde rojo, metemos el mensaje
            
            inputValidado.Usuario=false;
            //inputValidadoIng[0]=false;
            avisoUsuaM.innerHTML="El usuario de contener al menos 6 carecteres";
        }            
    }else{
        avisoUsuaM.innerHTML="Debe rellenar el campo usuario";
        usuarioM.classList.remove('is-valid');
        usuarioM.classList.add('is-invalid');
        inputValidado.Usuario=false;
        //inputValidadoIng[0]=false;
        avisoUsuaM.innerHTML=" ";
    }
}
usuarioM.addEventListener('keyup',validarUsuario);
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('modiUsuario').addEventListener('submit', validarFormularioUsu); 
  });
  
  function validarFormularioUsu(evento) {
    
    if(!inputValidado.Usuario){
        avisoUsuaM.innerHTML="Debe rellenar el campo usuario";
        evento.preventDefault();
    }
    
  }
  
  //validar contraseña
  let pass=document.getElementById('password');
  let avisoPass=document.getElementById('avisoPass');
  let inputValidadopass=false;
  function validarPass(){
    //Aseguramos que no esta vacio o no definido
    if(pass.value!="" && pass.value!=undefined){
        //aseguramos que sige la expresion
        if(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,40}/.test(pass.value)){
            pass.classList.remove('is-invalid');
            pass.classList.add('is-valid');
            inputValidadopass=true;
            //variable de control a true, color del bode rojo y vaciamos el aviso
            avisoPass.innerHTML=" ";
        }else{
            pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            avisoPass.innerHTML="No es suficientemente segura";
            inputValidadopass=false;
        }        
    }else{
        pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            avisoPass.innerHTML="Debe rellenar el campo contraseña";
            inputValidadopass=false;
    }
}
pass.addEventListener('keyup',validarPass);
let pass2=document.getElementById('pass1');
let avisoPass2=document.getElementById('avisoPass1');
let passValidation= false;
function validarPass2(){
    if(pass2.value!="" && pass2.value!=undefined){
        if(inputValidadopass){
            let contra1=pass.value;
            let contra2=pass2.value;
            if(contra1==contra2){
                pass2.classList.remove('is-invalid');
                pass2.classList.add('is-valid');
                avisoPass2.innerHTML=" ";
                passValidation=true;
            }else{
                avisoPass2.innerHTML="Las contraseña no coinciden";
                pass2.classList.remove('is-valid');
                pass2.classList.add('is-invalid');
                passValidation=false;
           
            }
        }else{
            avisoPass2.innerHTML="Debe de ser valida la primera contraseña";
            pass2.classList.remove('is-valid');
            pass2.classList.add('is-invalid');
            passValidation=false;
        }            
    }else{
        avisoPass2.innerHTML="Debe rellenar todos los campos";
        pass2.classList.remove('is-valid');
        pass2.classList.add('is-invalid');
        passValidation=false;
    }
}
pass2.addEventListener('keyup',validarPass2);
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("modiContra").addEventListener('submit', validarContrase); 
  });
  
  function validarContrase(evento) {
    if(!passValidation){
        evento.preventDefault();
        avisoPass2.innerHTML="No se relleno correctamente";
    }
    const myTimeout = setTimeout($("#tempo").css("display", "inline"), 100);
    clearTimeout(myTimeout);
}
  //Email
let email=document.getElementById('email');
let avisoEmail=document.getElementById('avisoEmail');
let validationEmail=false;
function validarEmail(){
    if(email.value!="" && email.value!=undefined){
        if(expr.email.test(email.value)){
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
            avisoEmail.innerHTML=" ";
            validationEmail=true;
        }else{
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            avisoEmail.innerHTML="Email no valido";
            validationEmail=false;
        } 
    }else{
        email.classList.remove('is-valid');
        email.classList.add('is-invalid');
        avisoEmail.innerHTML="Debe rellenar todos los campos";
        validationEmail=false;
    }
           
}

email.addEventListener('keyup',validarEmail);
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("validacionEmail").addEventListener('submit', valiEmail); 
  });
  
  function valiEmail(evento) {
    
    if(!validationEmail){
        avisoEmail.innerHTML="Debe ser rellenado correctamente";
        evento.preventDefault();
    }
    
  }
  //Validacion del telefono
  //Telefono
let telefono=document.getElementById('telefonoM');
let avisoTelefono=document.getElementById('avisoTel');
let validationTel=false;
//Fase123@as
function validarTelefono(){
    if(telefono.value!="" && telefono.value!=undefined){
        if(expr.telefono.test(telefono.value)){
            telefono.classList.remove('is-invalid');
            telefono.classList.add('is-valid');
            avisoTelefono.innerHTML=" ";
            validationTel=true;
        }else{
            telefono.classList.remove('is-valid');
            telefono.classList.add('is-invalid');
            avisoTelefono.innerHTML="Telefono no valido";
            validationTel=false;
        } 
    }else{
        telefono.classList.remove('is-valid');
        telefono.classList.add('is-invalid');
        avisoTelefono.innerHTML="Debe rellenar todos los campos";
        validationTel=false;
      
    }
           
}

telefono.addEventListener('keyup',validarTelefono);
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('telefonoValidation').addEventListener('submit', valiTelefono); 
  });
  
  function valiTelefono(evento) {
    
    if(!validationTel){
        evento.preventDefault();
        avisoTelefono.innerHTML="Debe ser rellenado correctamente";
    }
    
  }
  //nombre

let nombre=document.getElementById('nombre');
let avisoNombre=document.getElementById('avisoNombre');
let inputNombre=false;
//Fase123@as
function validarNombre(){
    if(nombre.value!="" && nombre.value!=undefined){
        if(expr.nombre.test(nombre.value)){
            nombre.classList.remove('is-invalid');
            nombre.classList.add('is-valid');
            avisoNombre.innerHTML=" ";
            inputNombre=true;
        }else{
            nombre.classList.remove('is-valid');
            nombre.classList.add('is-invalid');
            avisoNombre.innerHTML="Formato de nombre no valido";
            inputNombre=false;
        } 
    }else{
        nombre.classList.remove('is-valid');
        nombre.classList.add('is-invalid');
        avisoNombre.innerHTML="Debe rellenar todos los campos";
        inputNombre=false;
    }
           
}

nombre.addEventListener('keyup',validarNombre);
//controlar envio
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nombreForm').addEventListener('submit', envioNombre); 
  });
  
  function envioNombre(evento) {
    
    if(!inputNombre){
        evento.preventDefault();
        avisoNombre.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }
    //apellidos
let avisoapellido=document.getElementById('avisoApellidos');
let apellidosValidados=false;
//Fase123@as
function validarApellido1(){
    if(apellidos.value!="" && apellidos.value!=undefined){
        if(expr.nombre.test(apellidos.value)){
            apellidos.classList.remove('is-invalid');
            apellidos.classList.add('is-valid');
            avisoapellido.innerHTML=" ";
            apellidosValidados=true;
        }else{
            apellidos.classList.remove('is-valid');
            apellidos.classList.add('is-invalid');
            avisoapellido.innerHTML="Formato de apellidos no valido";
            apellidosValidados=false;
        } 
    }else{
        apellidos.classList.remove('is-valid');
        apellidos.classList.add('is-invalid');
        avisoapellido.innerHTML="Debe rellenar todos los campos";
        apellidosValidados=false;
    }
           
}

apellidos.addEventListener('keyup',validarApellido1);
//controlar envio
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('ApellidosForm').addEventListener('submit', envioApellidos); 
  });
  
  function envioApellidos(evento) {
    if(!apellidosValidados){
        evento.preventDefault();
        avisoapellido.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }
  //validación del dni
  let DNI=document.getElementById('dni');
let avisoDni=document.getElementById('avisoDNI');
let dniValidad=false;
function validarDNI(){
    if(DNI.value!="" && DNI.value!=undefined){
        if(expr.dni.test(DNI.value)){

            let numero = parseInt(DNI.value.substr(0, 8));
            let letraDNI = DNI.value.substr(8, 9);
            letraDNI=letraDNI.toUpperCase();
            console.log(numero);
            numero = numero%23;
            console.log(letraDNI);
            console.log(numero);
            letra=['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
            if (letra[numero]!=letraDNI){
                DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
                avisoDni.innerHTML="";
                avisoDni.innerHTML="La letra del DNI es incorrecta";
                dniValidad=false;
            }else{
                DNI.classList.remove('is-invalid');
                DNI.classList.add('is-valid');
                dniValidad=true;
                avisoDni.innerHTML="";
            }
        }else{
            DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
            avisoDni.innerHTML="00000000x";
            dniValidad=false;
        }
    }else{
        DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
                avisoDni.innerHTML="Debe rellenar todos los campos";
                dniValidad=false;
        
    }   
}
DNI.addEventListener('keyup',validarDNI);
//controlar envio
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dniForm').addEventListener('submit', enviodni); 
  });
  
  function enviodni(evento) {
    if(apellidosValidados){
        evento.preventDefault();
        avisoapellido.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }
//Comunidad, provincia, cp
    //apellidos
    let comunidad=document.getElementById('comunidad');
    let provincia=document.getElementById('provincia');
    let cp=document.getElementById('cp');
    let avisoCPC=document.getElementById('avisoComunidad');
    let CPCValidado=false;
function validarCPC(){
    if(comunidad.value!="" && comunidad.value!=undefined && comunidad.value!=0 && provincia.value!="" && provincia.value!=undefined && provincia.value!=0 && cp.value!="" && cp.value!=undefined && cp.value!=0){
        comunidad.classList.remove('is-invalid');
        comunidad.classList.add('is-valid');
        provincia.classList.remove('is-invalid');
        provincia.classList.add('is-valid');
        cp.classList.remove('is-invalid');
        cp.classList.add('is-valid');
        avisoCPC.innerHTML=" ";
        CPCValidado=true;
    }else{
        comunidad.classList.remove('is-valid');
        comunidad.classList.add('is-invalid');
        provincia.classList.remove('is-valid');
        provincia.classList.add('is-invalid');
        cp.classList.remove('is-valid');
        cp.classList.add('is-invalid');
        avisoCPC.innerHTML="Debe rellenar todos los campos";
        CPCValidado=false;
    }
           
}

comunidad.addEventListener('change',validarCPC);
provincia.addEventListener('change',validarCPC);
cp.addEventListener('change',validarCPC);
//controlar envio
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cpcForm').addEventListener('submit', envioCPC); 
  });
  
  function envioCPC(evento) {
    if(!CPCValidado){
        evento.preventDefault();
        avisoCPC.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }
  //Direccion
let direccion=document.getElementById('direccion');
let avisoDireccion=document.getElementById('avisoDirec');
let direccioValidado=false;
function validarDireccion(){
    if(direccion.value!="" && direccion.value!=undefined){
        if(expr.nombre.test(direccion.value)){
            direccion.classList.remove('is-invalid');
            direccion.classList.add('is-valid');
            avisoDireccion.innerHTML=" ";
            direccioValidado=true;
        }else{
            direccion.classList.remove('is-valid');
            direccion.classList.add('is-invalid');
            avisoDireccion.innerHTML="direccion no valida";
            direccioValidado=false;
        } 
    }else{
        direccion.classList.remove('is-valid');
        direccion.classList.add('is-invalid');
        avisoDireccion.innerHTML="Debe rellenar todos los campos";
        direccioValidado=false;
    }
           
}

direccion.addEventListener('keyup',validarDireccion);
//controlar envio
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dirForm').addEventListener('submit', envioDireccion); 
  });
  
  function envioDireccion(evento) {
    
    if(!direccioValidado){
        evento.preventDefault();
        avisoDireccion.innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  
  }
  //Mostrar nueva contraseña

