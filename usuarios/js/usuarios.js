let fichero_seleccionado ="" ;
let abierto = false;

function actualizar(){
   var txt_nombres  = document.getElementById("txt_nombres").value          ;
   var txt_apellidos =  document.getElementById("txt_apellidos").value        ;
   var txt_tipoid =   document.getElementById("txt_tipoid").value          ;
   var txt_identificacion =   document.getElementById("txt_identificacion").value   ;
   var txt_direccion =  document.getElementById("txt_direccion").value        ;

   //console.log('ACTUALIZANDO POR FAVOR ESPERE!');
   set_subir_adjunto(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,0);

}

function set_actualizar_bbdd(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta){ 
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
                 // console.log(respuesta);
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

function set_subir_adjunto(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,opcion){
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
          switch (opcion) {
            case 1:
                var txt_usuario =  document.getElementById("txt_sub_user_usuario").value        ;
                var txt_clave =  document.getElementById("txt_sub_user_clave").value        ;
                var txt_tipuser =  document.getElementById("user_tipe").value        ;
                set_agregar_subuser(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta,txt_usuario,txt_clave,txt_tipuser);
              break;
            default:
                set_actualizar_bbdd(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta);
              break;
          }
         
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
  if(abierto==false){
    document.getElementById('img_bt_abrir_formulario').src='../imagenes/iconos/cerrar.png';
    abierto=true;
  }else{
    document.getElementById('img_bt_abrir_formulario').src='../imagenes/iconos/account-box-plus-outline.png';
    abierto=false;
  }

  document.getElementById('contenedor_oculto').classList.toggle('display_none');
}

function set_tratar_nuevo_subuser(){
  var txt_nombres  = document.getElementById("txt_sub_user_data_p_nombres").value          ;
  var txt_apellidos =  document.getElementById("txt_sub_user_data_p_apeliidos").value        ;
  var txt_tipoid =   document.getElementById("txt_sub_user_data_p_tipoid").value          ;
  var txt_identificacion =   document.getElementById("txt_sub_user_data_p_identificacion").value   ;
  var txt_direccion =  document.getElementById("txt_sub_user_data_p_direccion").value        ;


  set_subir_adjunto(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,1);
}

function set_agregar_subuser(txt_nombres,txt_apellidos,txt_tipoid,txt_identificacion,txt_direccion,ruta,txt_usuario,txt_clave,txt_tipuser){ 
   //inicio 
   console.log('set_agregar_subuser');
   $.post("ctrl/usuarios.php"
     ,{
         "txt_nombres":txt_nombres
        , "txt_apellidos":txt_apellidos 
        , "txt_tipoid":txt_tipoid 
        , "txt_identificacion":txt_identificacion 
        , "txt_direccion": txt_direccion
        , "ruta_img": ruta
        , "txt_usuario": txt_usuario
        , "txt_clave": txt_clave
        , "txt_tipuser": txt_tipuser
        , "accion": 2
     }
     ,function(respuesta){            
         try {
           console.log(respuesta);
           if(respuesta == 'CORRECTO'){
               alert('AGREGADO CORRECTO!');
           }
         } catch (error) {
           console.log(error);
           console.log(respuesta);
         }
     }); 
   //fin de actualizacion
}


function set_cargar_datos_tabla(json){
  var tbody = document.getElementById('cuerpo_tabla');
  tbody.innerHTML=''; //limpio el contenedor

  for(i=0;i<json.length;i++){

      //console.log(json[i]);
      var fila = document.createElement('tr');
      var data_user = document.createElement('td');
      var data_identificacion = document.createElement('td');
      var data_estado = document.createElement('td');
      let data_user_all = json[i];  

      data_user.innerHTML=json[i][5]+' '+json[i][6];
      data_identificacion.innerHTML=json[i][8];


      var estado = Number(json[i][3]);
      switch (estado) {
        case 1:
          data_estado.innerHTML='Inactivo';
          break;
      
        default:
          data_estado.innerHTML='Activo';
          break;
      }

      fila.appendChild(data_user);
      fila.appendChild(data_identificacion);
      fila.appendChild(data_estado);

      var celda_bts = document.createElement('td');
    
      var bts_ver = document.createElement('button');
      bts_ver.innerHTML='<img src="../imagenes/iconos/account-eye.png" alt="" srcset="" class="incono_bt_tabla">';
      bts_ver.classList.toggle('bt_opcion_tabla');
      bts_ver.onclick = function() {  bt_ver_onclick(data_user_all); };

      var bts_borrar = document.createElement('button');
      bts_borrar.innerHTML='<img src="../imagenes/iconos/account-multiple-remove.png" alt="" srcset="" class="incono_bt_tabla">';
      bts_borrar.classList.toggle('bt_opcion_tabla');
      bts_borrar.onclick = function() {  bt_borrar_onclick(data_user_all); };
 
      //agrego los botones a la celda
      celda_bts.appendChild(bts_ver);
      celda_bts.appendChild(bts_borrar);
     
      fila.appendChild(celda_bts);
      tbody.appendChild(fila);
  }
}


function get_listado_sub_usuarios(){
  //console.log('set_agregar_subuser');
  $.post("ctrl/usuarios.php"
    ,{
        "txt_nombres":' '
       , "txt_apellidos":' ' 
       , "txt_tipoid":' ' 
       , "txt_identificacion":' ' 
       , "txt_direccion": ' '
       , "ruta_img": ' '
       , "txt_usuario": ' '
       , "txt_clave": ' '
       , "txt_tipuser": ' '
       , "accion": 3
    }
    ,function(respuesta){            
        try {
          var json = $.parseJSON(respuesta);
         // console.log(respuesta);
          set_cargar_datos_tabla(json);
        } catch (error) {
          console.log(error);
          console.log(respuesta);
        }
    }); 
}

function bt_ver_onclick(json){

  console.log(json);
  var sb_id             = json[0];
  var sb_user           = json[1];
  var sb_clave          = json[2];
  var sb_estado         = json[3];
  var sb_tipo           = json[4];
  var dp_name           = json[5];
  var dp_apellidos      = json[6];
  var dp_tipoid         = json[7];
  var dp_identificacion = json[8];
  var dp_direccion      = json[9];
  var dp_url_foto       = json[10];

  var txt_nombres        =  document.getElementById("txt_sub_user_data_p_nombres");
  var txt_apellidos      =  document.getElementById("txt_sub_user_data_p_apeliidos");
  var txt_tipoid         =  document.getElementById("txt_sub_user_data_p_tipoid");
  var txt_identificacion =  document.getElementById("txt_sub_user_data_p_identificacion");
  var txt_direccion      =  document.getElementById("txt_sub_user_data_p_direccion");
  var txt_usuario        =  document.getElementById("txt_sub_user_usuario");
  var txt_clave          =  document.getElementById("txt_sub_user_clave");
  var user_tipe          =  document.getElementById("user_tipe");

  txt_nombres.value        = dp_name;
  txt_apellidos.value      = dp_apellidos;
  txt_tipoid.value         = dp_tipoid;
  txt_identificacion.value = dp_identificacion;
  txt_direccion.value      = dp_direccion;
  txt_usuario.value        = sb_user;
  user_tipe.value          = sb_tipo;


  $imagenPrevisualizacion = document.querySelector("#logo_user_form");

  if(dp_url_foto.length > 0 && dp_url_foto!=null ){
    $imagenPrevisualizacion.src =  '../'+dp_url_foto;
    fichero_seleccionado =  dp_url_foto;
  }

  set_abrir_formulario_nuevo_subuser();
}

function bt_borrar_onclick(json){
  console.log(json);
}