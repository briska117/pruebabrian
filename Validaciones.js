

function Login_Ajax(){
    
    var Correo= $('#correo').val();
    var Password=$('#password').val();

        var parametros = {
                "Correo" : Correo,
                "Password" : Password
        };
        $.ajax({
                data:  parametros,
                url:   'FuncionLoggin.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}

function Registro_Ajax(){
    var Matricula=$('#matricula').val();
    var Correo= $('#correo').val();
	var Especialiad=document.registro_form.especialidad.text;
	var Password=document.getElementById("pass").value;
	var Password1=document.getElementById("pass1").value;
	var Telefono =document.getElementById("telefono").value;
	alert(Password+Password1+Telefono);

        var parametros = {
			    "Matricula" : Matricula,
                "Correo" : Correo,
				"Especialidad" : Especialiad, 
                "Pass" : Password,
				"Pass1" : Password1,
				"Telefono" : Telefono 
				
        };
        $.ajax({
                data:  parametros,
                url:   'js/FuncionRegistro.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}


function numero(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validar(){
	 if (document.registro_form.matricula.value.length<6){
       alert("Tiene que escribir su Matricula o Numero de boleta");
       document.registro_form.matricula.focus();
       return 0;
    }
	 if (document.registro_form.matricula.value.length>10){
       alert("matricula no pude ser mayor a 10 digitos");
       document.registro_form.matricula.focus();
       return 0;
    }   
if (document.registro_form.correo.value.length<11){
       alert("Tiene que escribir su correo");
       document.registro_form.correo.focus();
       return 0;
    }
    
    var cadena=document.registro_form.correo.value
   if(cadena.indexOf('@gmail.com')  == -1){
alert("requires ingresar con una cuenta de 'Gmail' "+cadena);
       document.registro_form.correo.focus();
       return 0;
}
    var pass1=document.registro_form.pass.value;
    var pass2=document.registro_form.pass1.value;
    
    if(pass1 != pass2){
        
        alert("Contraseñas no coinciden ");
       document.registro_form.pass.focus();
       return 0;
    
    }
    
   
    
    if (document.registro_form.pass.value.length==0 && document.registro_form.pass1.value.length<8){
       alert("Tiene que escribir su contraseña");
       document.registro_form.pass.focus();
       return 0;
    }
    
    if (document.registro_form.pass.value.length<8 && document.registro_form.pass1.value.length<8){
       alert("contraseña debe tener almenos 8 caracteres");
       document.registro_form.pass.focus();
       return 0;
    }
   
alert("Muchas gracias por enviar el formulario");
    Registro_Ajax();
}

function Valida_log(){
  alert('entre a la funcion');
if (document.login_form.correo.value.length==0){
       alert("Tiene que escribir su Matricula");
       document.login_form.correo.focus();
       return 0;
    }
	 var cadena=document.login_form.correo.value
   if(cadena.indexOf('@gmail.com')  == -1){
alert("requires ingresar con una cuenta de 'Gmail' "+cadena);
       document.login_form.correo.focus();
       return 0;
}
    
    if (document.login_form.password.value.length==0){
       alert("Tiene que escribir su Pass");
       document.login_form.password.focus();
       return 0;
    }
    
     if (document.login_form.password.value.length<8){
       alert("Contraseña no menor a 8 digitos");
       document.login_form.password.focus();
       return 0;
    }
   
   Login_Ajax();

}