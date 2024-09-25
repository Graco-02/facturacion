function get_validar_acceso(){
    var usuario = document.getElementById('txt_user').value;
    var clave = document.getElementById('txt_clave').value;

    $.post("ctrl/logging.php"
        ,{"txt_user":usuario 
        ,"txt_clave":clave 
        }
        ,function(respuesta){            
            try {
              console.log(respuesta);
              if(respuesta=="CORRECTO"){
                alert("ACCESO ACEPTADO");
                //location.href="inscripciones/manejador_clientes.php";
              }else{
                  alert(respuesta);
              }
            } catch (error) {
              console.log(error);
              console.log(respuesta);
            }
        }); 
}