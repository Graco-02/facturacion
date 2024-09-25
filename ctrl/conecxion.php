<?php
function conectar(){
   //local
    $servername = "localhost";
    $username = "graco";
    $password = "0287";
    $dbname = "facturacion";
  
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        return $conn;
    }
}

?>