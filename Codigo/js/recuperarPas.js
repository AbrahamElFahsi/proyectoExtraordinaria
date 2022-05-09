  //Email
  const expr={telefono:/[0-9]{9}/, usuario:/[a-zA-ZáéíóúÁÉÍÓÚ]{6,45}/, dni:/^[0-9]{8}[a-zA-Z]$/, email:/^[A-Za-z]{1,15}[@]{1}[A-Za-z]{1,15}[.]{1}[A-Za-z]{1,5}$/, pass:/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,40}/, nombre:/^[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]+[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ]{2,}?$/, direccion:/^([A-Za-záéíóúÁÉÍÓÚ/,0-9]{1,}[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}[A-Za-záéíóúÁÉÍÓÚ/,0-9]*[ ]{0,1}){0,50}?$/}

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
            document.getElementById('avisoFormulario').innerHTML=" ";
        }else{
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            avisoEmail.innerHTML="Email no valido";
            validationEmail=false;
            document.getElementById('avisoFormulario').innerHTML=" ";
        } 
    }else{
        email.classList.remove('is-valid');
        email.classList.add('is-invalid');
        avisoEmail.innerHTML="Debe rellenar todos los campos";
        validationEmail=false;
        document.getElementById('avisoFormulario').innerHTML=" ";
    }
           
}

email.addEventListener('keyup',validarEmail);
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("validacionEmail").addEventListener('submit', valiEmail); 
  });
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
                document.getElementById('avisoFormulario').innerHTML=" ";
            }else{
                DNI.classList.remove('is-invalid');
                DNI.classList.add('is-valid');
                dniValidad=true;
                avisoDni.innerHTML="";
                document.getElementById('avisoFormulario').innerHTML=" ";
            }
        }else{
            DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
            avisoDni.innerHTML="00000000x";
            document.getElementById('avisoFormulario').innerHTML=" ";
            dniValidad=false;
        }
    }else{
        DNI.classList.remove('is-valid');
                DNI.classList.add('is-invalid');
                avisoDni.innerHTML="Debe rellenar todos los campos";
                document.getElementById('avisoFormulario').innerHTML=" ";
                dniValidad=false;
        
    }   
}
DNI.addEventListener('keyup',validarDNI);
//controlar envio
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('dniUsuarioForm').addEventListener('submit', enviodniEmail); 
  });
  
  function enviodniEmail(evento) {
    if(!validationEmail && !dniValidad){
        evento.preventDefault();
        document.getElementById('avisoFormulario').innerHTML="Debe ser rellenado correctamente antes de enviar";
    }
  }
usuarioM.addEventListener('keyup',validarUsuario);
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("dniUsuarioForm").addEventListener('submit', validarFormularioUsu); 
  });
  
  function validarFormularioUsu(evento) {
    
    if(!inputValidado.Usuario && !inputValidado.Usuario){
        document.getElementById('avisoFormulario').innerHTML="Debe rellenar el campo usuario antes de enviar";
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
            document.getElementById('avisoFormulario').innerHTML=" ";
            //variable de control a true, color del bode rojo y vaciamos el aviso
            avisoPass.innerHTML=" ";
        }else{
            pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            avisoPass.innerHTML="Al menos 8 caracteres, debe incluir Mayuscula, caracteres especiales y numeros";
            inputValidadopass=false;
            document.getElementById('avisoFormulario').innerHTML=" ";
        }        
    }else{
        pass.classList.remove('is-valid');
            pass.classList.add('is-invalid');
            avisoPass.innerHTML="Debe rellenar el campo contraseña";
            inputValidadopass=false;
            document.getElementById('avisoFormulario').innerHTML=" ";
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
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("modiContra").addEventListener('submit', validarContrase); 
  });
  
  function validarContrase(evento) {
    if(!passValidation){
        evento.preventDefault();
        avisoPass2.innerHTML="No se relleno correctamente";
    }
}