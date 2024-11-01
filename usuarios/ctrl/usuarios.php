<?php

    session_start();
    require_once('../../ctrl/conecxion.php');

    if(count($_GET)>0){                  
        get_user_data();
    }else if(count($_POST)>0){
        $txt_nombres        = $_POST['txt_nombres'];     
        $txt_apellidos      = $_POST['txt_apellidos'];      
        $txt_tipoid         = $_POST['txt_tipoid'];   
        $txt_identificacion = $_POST['txt_identificacion'];   
        $txt_direccion      = $_POST['txt_direccion'];
        $ruta_img           = $_POST['ruta_img'];
           
        $accion             = $_POST['accion'];   

        switch ($accion) {
            case 1:
                set_actualizar($txt_nombres,$txt_apellidos ,$txt_tipoid, $txt_identificacion,$txt_direccion,$ruta_img);
                break;
            case 2:
                $txt_user    = $_POST['txt_usuario'];   
                $txt_clave   = $_POST['txt_clave'];
                $tip_user    = $_POST['txt_tipuser'];
                set_agregar_sub_user($txt_nombres,$txt_apellidos ,$txt_tipoid,
                 $txt_identificacion,$txt_direccion,
                 $ruta_img,$txt_user,$txt_clave,$tip_user);
                break; 
            case 3:
                get_listado_sub_usuarios();
                break;      
            case 4:
                $id_sub_user = $_POST['id_sub_user'];
                $sb_estado   = $_POST['sb_estado'];
                set_desactivar_activar($sb_estado,$id_sub_user);
                break;                        
            default:
                # code...
                break;
        }

    }


function get_user_data(){
    $datos_user = array();    
    array_push($datos_user,$_SESSION['usuario_logeado_id'] );
    array_push($datos_user,$_SESSION['usuario_logeado_nombres'] );
    array_push($datos_user,$_SESSION['usuario_logeado_apellidos'] );
    array_push($datos_user,$_SESSION['usuario_logeado_tipoid'] );
    array_push($datos_user,$_SESSION['usuario_logeado_identificacion'] );
    array_push($datos_user,$_SESSION['usuario_logeado_direccion'] ); 
    array_push($datos_user,$_SESSION['id_personal'] ); 
    array_push($datos_user,$_SESSION['user_img'] ); 

    echo json_encode($datos_user);
}


function set_actualizar($txt_nombres,$txt_apellidos ,$txt_tipoid, $txt_identificacion,$txt_direccion,$ruta_img){
    $conn = conectar();
    // Check connection
    if ($conn->connect_error) {
        $validacion=FALSE; 
        die("Connection failed: " . $conn->connect_error);
        $conn->close();
        echo 'error en coneccion bbdd';
    }else{
          $sql="UPDATE    datos_personales SET nombres='$txt_nombres',
                          apellidos='$txt_apellidos',
                          tipoid=$txt_tipoid,
                          identificacion='$txt_identificacion',
                          url_imagen='$ruta_img',
                          direccion='$txt_direccion'
           where id =".$_SESSION['id_personal'];
 
       if ($conn->query($sql) == TRUE) {		   
         // # Cogemos el identificador con que se ha guardado
         $id=$conn->insert_id;	
             $_SESSION['usuario_logeado_nombres']          =  $txt_nombres ;  
             $_SESSION['usuario_logeado_apellidos']        =  $txt_apellidos ;
             $_SESSION['usuario_logeado_tipoid']           =  $txt_tipoid ;   
             $_SESSION['usuario_logeado_identificacion']   =  $txt_identificacion ;
             $_SESSION['usuario_logeado_direccion']        =  $txt_direccion ; 
             $_SESSION['user_img']                         =  $ruta_img ; 
             echo  'MODIFICACION REALIZADA';
         }   else {
             echo "Error Modificacion: " . $sql . "<br>" . $conn->error;
         }
    }
}


function set_agregar_sub_user($txt_nombres,$txt_apellidos ,$txt_tipoid, $txt_identificacion,$txt_direccion,$ruta_img,$txt_user,$txt_clave,$tip_user){
    $id_usuario = $_SESSION['usuario_logeado_id'];
    $date = date('Y-m-d');

    $conn = conectar();
    $sql="INSERT INTO datos_personales (nombres,apellidos,tipoid,identificacion,direccion,url_imagen,fecha_actualizacion) 
    VALUES ('$txt_nombres', '$txt_apellidos',$txt_tipoid,'$txt_identificacion','$txt_direccion','$ruta_img','$date')";

    if ($conn->query($sql) == TRUE) {	
        $id=$conn->insert_id;

        $sql="INSERT INTO sub_usuarios (id_usuario,id_datos_personales,tipo,fecalta,fecha_actualizacion,usuario,clave) 
        VALUES ($id_usuario, $id,$tip_user,'$date',' $date','$txt_user','$txt_clave')";
    
        if ($conn->query($sql) == TRUE) {	
            echo 'CORRECTO';
        }else{
            echo 'AGREGADO INCORRECTO';
        }
    }else{
        echo 'AGREGADO INCORRECTO';
    }
}

function get_listado_sub_usuarios(){
    $id_usuario = $_SESSION['usuario_logeado_id'];

    $sql = "SELECT sub_user.id AS sb_id,sub_user.usuario AS sb_user,sub_user.clave AS sb_clave,
                   sub_user.estado AS sb_estado ,sub_user.tipo AS sb_tipo,
                   dp.nombres AS dp_name,dp.apellidos AS dp_apellidos,dp.tipoid AS dp_tipoid,dp.identificacion AS dp_identificacion,
                   dp.direccion AS dp_direccion, dp.url_imagen AS dp_url_foto
            FROM facturacion.sub_usuarios sub_user , facturacion.usuarios users , facturacion.datos_personales dp
            WHERE users.id = $id_usuario AND sub_user.id_usuario = users.id AND sub_user.id_datos_personales = dp.id;
            ";

    $conn = conectar();
    $date = date('Y-m-d');
    $listado_sub_users = array(); 
      // Check connection
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
          echo "error de coneccion bbdd";
     }else{
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc() ) {
            $sub_user = array();
            array_push($sub_user,$row["sb_id"]);
            array_push($sub_user,$row["sb_user"]);
            array_push($sub_user,$row["sb_clave"]);
            array_push($sub_user,$row["sb_estado"]);
            array_push($sub_user,$row["sb_tipo"]);
            array_push($sub_user,$row["dp_name"]);
            array_push($sub_user,$row["dp_apellidos"]);
            array_push($sub_user,$row["dp_tipoid"]);
            array_push($sub_user,$row["dp_identificacion"]);
            array_push($sub_user,$row["dp_direccion"]);
            array_push($sub_user,$row["dp_url_foto"]);


            array_push($listado_sub_users,$sub_user);
          }//fin bucle while		 
        }//fin if
     }

    echo json_encode($listado_sub_users);

}

function set_desactivar_activar($indicador,$id){
    $estado = $indicador;
    $conn = conectar();
    // Check connection
    if ($conn->connect_error) {
        $validacion=FALSE; 
        die("Connection failed: " . $conn->connect_error);
        $conn->close();
        echo 'error en coneccion bbdd';
    }else{
        $sql="UPDATE sub_usuarios SET estado=".$estado." where id =".$id;
 
        if ($conn->query($sql) == TRUE) {		   
         // # Cogemos el identificador con que se ha guardado
             $id=$conn->insert_id;	
             echo  'CORRECTO';
         }   else {
             echo "Error Modificacion: " . $sql . "<br>" . $conn->error;
         }
    }//fin del else
}

?>