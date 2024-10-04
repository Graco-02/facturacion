<?php 
    require_once('conecxion.php');
    session_start();
    
    if(count($_POST)>0){
        if(get_validar_usuario()){
            echo 'CORRECTO';
        }else{
            echo 'INCORRECTO';
        }
    }


function get_validar_usuario(){
    $user_name            = $_POST['txt_user'];
    $user_clave           = $_POST['txt_clave'];
    if(set_validar_caracteres($user_name,$user_clave)){
        $hash_clave = hash('sha256', $user_clave);
        $conn = conectar();
        // Check connection
        if ($conn->connect_error) {
            $validacion=FALSE; 
            die("Connection failed: " . $conn->connect_error);
            $conn->close();
        }else{
            $sql = "SELECT  user.id as userid,user.usuario as usuario,user.clave as clave,
            dp.nombres as nombres,dp.apellidos as apellidos,dp.url_imagen as url_img,
            dp.tipoid as tipoid, dp.identificacion as identificacion,dp.direccion as direccion, dp.id as id_personal
            FROM usuarios user , datos_personales dp
            where user.usuario='$user_name' AND user.estado = 0 
            AND user.id_data_personal = dp.id"; 
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($hash_clave == $row["clave"] || $row["clave"] == $user_clave){
                        $_SESSION['usuario_logeado'] = $row["usuario"];
                        $_SESSION['usuario_logeado_id'] = $row["userid"];
                        $_SESSION['usuario_logeado_nombres'] = $row["nombres"];
                        $_SESSION['usuario_logeado_apellidos'] = $row["apellidos"];
                        $_SESSION['usuario_logeado_tipoid'] = $row["tipoid"];
                        $_SESSION['usuario_logeado_identificacion'] = $row["identificacion"];
                        $_SESSION['usuario_logeado_direccion'] = $row["direccion"];
                        $_SESSION['id_personal'] = $row["id_personal"];
                        return true;
                    } else {
                        $validacion=FALSE; 
                        echo "INCORRECTO CLAVE INCORRECTA";
                    }
                }			 
                
            } else {
                echo "INCORRECTO USUARIO INEXISTENTE";
               $validacion=FALSE;
            }
    
            $conn->close();
        }
    }
    return false;
}


function set_validar_caracteres($user_name,$user_clave){
    $validacion = TRUE;
    $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ";
    for ($i=0; $i<strlen($user_name); $i++){
       if (strpos($permitidos, substr($user_name,$i,1))===false){
          echo 'NO SE ADMITEN CARATERES ILEGALES';
          $validacion = FALSE;
       }
    }

    for ($i=0; $i<strlen($user_clave); $i++){
        if (strpos($permitidos, substr($user_clave,$i,1))===false){
           echo 'NO SE ADMITEN CARATERES ILEGALES';
           $validacion = FALSE;
        }
     }

     return $validacion;
}

?>