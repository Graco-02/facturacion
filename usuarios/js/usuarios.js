function actualizar(){
   var txt_nombres  = document.getElementById("txt_nombres").value          ;
   var txt_apellidos =  document.getElementById("txt_apellidos").value        ;
   var txt_tipoid =   document.getElementById("txt_tipoid").value          ;
   var txt_identificacion =   document.getElementById("txt_identificacion").value   ;
   var txt_direccion =  document.getElementById("txt_direccion").value        ;

    $.post("ctrl/usuarios.php"
        ,{
            "txt_nombres":txt_nombres
           , "txt_apellidos":txt_apellidos 
           , "txt_tipoid":txt_tipoid 
           , "txt_identificacion":txt_identificacion 
           , "txt_direccion": txt_direccion
           , "accion": 1
        }
        ,function(respuesta){            
            try {
              console.log(respuesta);
            } catch (error) {
              console.log(error);
              console.log(respuesta);
            }
        }); 

}


function set_datos_usuario() {
    
    $.get("ctrl/usuarios.php"
        ,{"p":0 }
        ,function(respuesta){            
            try {
              var json = $.parseJSON(respuesta);
              //console.log(json);
              var option = Number(json[3]);
              option+=1;


              document.getElementById("txt_nombres").value          = json[1];
              document.getElementById("txt_apellidos").value        = json[2];
              document.getElementById("txt_tipoid").value           = option;
              document.getElementById("txt_identificacion").value   = json[4];
              document.getElementById("txt_direccion").value        = json[5];

            } catch (error) {
              console.log(error);
              console.log(respuesta);
            }
        }); 
}