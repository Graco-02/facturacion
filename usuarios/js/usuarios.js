let fichero_seleccionado ="" ;

function actualizar(){
   var txt_nombres  = document.getElementById("txt_nombres").value          ;
   var txt_apellidos =  document.getElementById("txt_apellidos").value        ;
   var txt_tipoid =   document.getElementById("txt_tipoid").value          ;
   var txt_identificacion =   document.getElementById("txt_identificacion").value   ;
   var txt_direccion =  document.getElementById("txt_direccion").value        ;

   console.log('ACTUALIZANDO POR FAVOR ESPERE!');
   set_subir_adjunto(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion);

}


function set_actualizar_bbdd(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta){ 
         console.log('set_actualizar_bbdd');
          //inicio 
          $.post("ctrl/usuarios.php"
            ,{
                "txt_nombres":txt_nombres
               , "txt_apellidos":txt_apellidos 
               , "txt_tipoid":txt_tipoid 
               , "txt_identificacion":txt_identificacion 
               , "txt_direccion": txt_direccion
               , "ruta_img": ruta
               , "accion": 1
            }
            ,function(respuesta){            
                try {
                  console.log(respuesta);
                  if(respuesta == 'MODIFICACION REALIZADA'){
                      alert('MODIFICACION REALIZADA!');
                  }
                } catch (error) {
                  console.log(error);
                  console.log(respuesta);
                }
            }); 
          //fin de actualizacion
}

function set_datos_usuario() {
    
    $.get("ctrl/usuarios.php"
        ,{"p":0 }
        ,function(respuesta){            
            try {
              var json = $.parseJSON(respuesta);
             // console.log(json);
              var option = Number(json[3]);

              document.getElementById("txt_nombres").value          = json[1];
              document.getElementById("txt_apellidos").value        = json[2];
              document.getElementById("txt_tipoid").value           = option;
              document.getElementById("txt_identificacion").value   = json[4];
              document.getElementById("txt_direccion").value        = json[5];
              $imagenPrevisualizacion = document.querySelector("#logo_user_form");

              if(json[7].length > 0 && json[7]!=null ){
                $imagenPrevisualizacion.src =  '../'+json[7];
                fichero_seleccionado =  json[7];
              }
             
            } catch (error) {
              console.log(error);
              console.log(respuesta);
            }
        }); 
}

function set_subir_adjunto(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion){
  console.log('set_subir_adjunto');
  var formData = new FormData();
  var file_data = $('#pic').prop('files')[0];
  formData.append('file',file_data);

  $.ajax({
      url: '../ctrl/upload.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          var ruta ='';
          if(file_data!=null){
              ruta=response;
          }else{
               ruta = fichero_seleccionado;
          }
          console.log(ruta);
          set_actualizar_bbdd(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta);
      }
  });
}

function readURL(input) {
  const $seleccionArchivos = document.querySelector("#pic"),
  $imagenPrevisualizacion = document.querySelector("#logo_user_form");

  console.log('readURL');
  const archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    $imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  const primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  const objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  $imagenPrevisualizacion.src = objectURL;
}


function set_abrir_formulario_nuevo_subuser(){
  document.getElementById('contenedor_oculto').classList.toggle('display_none');
}

function set_tratar_nuevo_bususer(){
  
}