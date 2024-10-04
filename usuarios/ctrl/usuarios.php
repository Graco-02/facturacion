<?php

    session_start();
    if(count($_GET)>0){                  
        get_user_data();
    }else if(count($_POST)>0){
        $txt_nombres        = $_POST['txt_nombres'];     
        $txt_apellidos      = $_POST['txt_apellidos'];      
        $txt_tipoid         = $_POST['txt_tipoid'];   
        $txt_identificacion = $_POST['txt_identificacion'];   
        $txt_direccion      = $_POST['txt_direccion'];   
        $accion             = $_POST['accion'];   

        switch ($accion) {
            case 1:
                set_actualizar($txt_nombres,$txt_apellidos ,$txt_tipoid, $txt_identificacion,$txt_direccion);
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

    echo json_encode($datos_user);
}


function set_actualizar($txt_nombres,$txt_apellidos ,$txt_tipoid, $txt_identificacion,$txt_direccion){
    require_once('../../ctrl/conecxion.php');
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
             echo  'MODIFICACION REALIZADA';
         }   else {
             echo "Error Modificacion: " . $sql . "<br>" . $conn->error;
         }
    }
}

?>