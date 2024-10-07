<?php 
   
   if (!file_exists('../imagenes/imagenes_subidas')) {
      mkdir('../imagenes/imagenes_subidas', 0777);
    }

    move_uploaded_file($_FILES['file']['tmp_name'], '../imagenes/imagenes_subidas/'. $_FILES['file']['name']);
    echo '/imagenes/imagenes_subidas/'.$_FILES['file']['name'];
?>