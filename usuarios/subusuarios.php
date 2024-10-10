<?php 
    session_start();
    $user = $_SESSION['usuario_logeado_nombres'].' '.$_SESSION['usuario_logeado_apellidos'];
    $user_direccion = $_SESSION['usuario_logeado_direccion'];
    $user_identificacion = $_SESSION['usuario_logeado_identificacion'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="css/subuser.css">
    <link rel="stylesheet" href="css/usuarios.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="../js/inicio.js"></script>
    <script src="js/usuarios.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>



    <title>Facturacion 1.0</title>
</head>
<body>

    <header>
        <span>factura facil 1.0</span>
    </header>
    <main>

    <section id="menu_principal" class="menu_p">
                <div class="flex_centrado_colum" id="">
                    <img src="../imagenes/iconos/account-circle.png" alt="" class="iconos_2" id="logo_user">
                    <div class="flex">
                        <span class="titulos"><?php echo $user;?></spa>
                    </div>
                    <a href="actualiza_user_data.php">Actualizar Datos</a>
                </div>
                <hr>

                <div class="opcion_menu_p">
                    <img src="../imagenes/iconos/account-circle.png" alt="" class="iconos" id="logo_user">
                    <a href="" class="enlaces_menu"><span>clientes</span></a>
                </div>

                <div class="opcion_menu_p">
                    <img src="../imagenes/iconos/NCF.png" alt="" class="iconos" id="logo_user">
                    <a href="" class="enlaces_menu"><span>comprobantes</span></a>
                </div>

                <div class="opcion_menu_p flex_centrado_colum clas_relative">
                    <div class="flex">
                        <img src="../imagenes/iconos/inventario.png" alt="" class="iconos" id="logo_user" onclick="set_cerrar_opciones_inventario();">
                        <a href="#" onclick="set_cerrar_opciones_inventario();" class="enlaces_menu"><span>inventario</span></a>

                    </div>
                    <div class="cerrado bacg_p"  id="contenedor_opciones_inventario">
                         <ul>
                            <li class="opciones_inventario"><a href="#">provehedores</a></li>
                            <li class="opciones_inventario"><a href="#">productos</a></li>
                            <li class="opciones_inventario"><a href="#">marcas</a></li>
                            <li class="opciones_inventario"><a href="#">categorias</a></li>
                        </ul>
                    </div>
                </div>

                <div class="opcion_menu_p clas_relative">
                    <img src="../imagenes/iconos/cash-register.png" alt="" class="iconos" id="logo_user">
                    <a href="#" class="enlaces_menu"><span>ventas</span></a>
                </div>

                <div class="opcion_menu_p clas_relative">
                    <img src="../imagenes/iconos/invoice-text-plus.png" alt="" class="iconos" id="logo_user">
                    <a href="#" class="enlaces_menu"><span>compras</span></a>
                </div>


        </section>


        <section class="contenedor_main" id="">
            <div id="contenedor_controles_tabla" class="width_100">

            </div>

            <div class="width_100" id="divicion_formulario">
                <table class="width_100">
                    <thead id="" class="bbk_color_1">
                        <tr>
                            <th scope="col">usuario</th>
                            <th scope="col">identificacion</th>
                            <th scope="col">estado</th>
                            <th scope="col">acciones</th>
                        </tr>
                    </thead>
                    <tbody id="" class="width_100">
                      <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><div class="felx_normal"> 
                            <button class="bt_opcion_tabla"><img src="../imagenes/iconos/account-eye.png" alt="" srcset="" class="incono_bt_tabla"></button>
                            <button class="bt_opcion_tabla"><img src="../imagenes/iconos/account-multiple-remove.png" alt="" srcset="" class="incono_bt_tabla"></button>
                        </div></td>
                      </tr>

                      <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><div class="felx_normal"> 
                            <button class="bt_opcion_tabla"><img src="../imagenes/iconos/account-eye.png" alt="" srcset="" class="incono_bt_tabla"></button>
                            <button class="bt_opcion_tabla"><img src="../imagenes/iconos/account-multiple-remove.png" alt="" srcset="" class="incono_bt_tabla"></button>
                        </div></td>
                      </tr>

                    </tbody>
                </table>
            </div>

            <button class="bt_opcion_flotable" onclick="set_abrir_formulario_nuevo_subuser();"><img src="../imagenes/iconos/account-box-plus-outline.png" alt="" srcset="" class="icono_bt_flotable"></button>
            


            <div id="contenedor_oculto" class="display_none">
                <form action="" class="formulario_emergente" action="javascript:actualizar();" enctype=" multipart/form-data">
                    <div class="felx_normal">
                        <div class="flex_column">
                            <img src="../imagenes/iconos/account-circle.png" alt="" srcset="" class="img_formulario_emergente" id="logo_user_form">
                            <input type="file" name="pic" id="pic" onchange="readURL(this.value)"/>
                        </div>

                        <div class="flex_column">
                           <div class="felx_normal">
                               <label for="txt_sub_user_usuario" class="lb_form">usuario</label>
                               <input type="text" name="txt_sub_user_usuario" id="txt_sub_user_usuario" placeholder="fulanito" class="input_form_text">
                           </div>

                           <div class="felx_normal">
                               <label for="txt_sub_user_clave" class="lb_form">clave</label>
                               <input type="password" name="txt_sub_user_usuario" id="txt_sub_user_usuario" placeholder="fulanito" class="input_form_text">
                           </div>

                           <div class="felx_normal">
                               <label for="txt_sub_user_clave" class="lb_form">tipo de usuario</label>
                               <select name="user_tipe" id="user_tipe" class="input_form_text">
                                   <option value="1">ADMIN</option>
                                   <option value="2">VENTAS</option>
                                   <option value="3">COMPRAS</option>
                               </select>
                            </div>

                           <div class="felx_normal">
                               <label for="txt_sub_user_data_p_nombres" class="lb_form">nombres</label>
                               <input type="text" name="txt_sub_user_data_p_nombres" id="txt_sub_user_data_p_nombres" placeholder="fulanito" class="input_form_text">
                           </div>
   
                           <div class="felx_normal">
                               <label for="txt_sub_user_data_p_apeliidos" class="lb_form">apellidos</label>
                               <input type="text" name="txt_sub_user_data_p_apeliidos" id="txt_sub_user_data_p_apeliidos" placeholder="de tal" class="input_form_text">
                           </div>
   
                           <div class="felx_normal">
                               <select name="txt_sub_user_data_p_tipoid" id="txt_sub_user_data_p_tipoid" class="input_form_text">
                                   <option value="0">CEDULA DE IDENTIDAD</option>
                                   <option value="1">PASAPORTE</option>
                               </select>
                               <input type="text" name="txt_sub_user_data_p_identificacion" id="txt_sub_user_data_p_identificacion" 
                               class="input_form_text" placeholder="000-0000000-0">
                           </div>

                           <div class="felx_normal">
                              <label for="txt_sub_user_data_p_direccion" class="lb_form">Direccion</label>
                              <textarea name="txt_sub_user_data_p_direccion" id="txt_sub_user_data_p_direccion" class="input_form_text heig_textarea"></textarea>
                           </div>

                            <button id="" class="input_form_text bt_form " onclick="">  
                                <img src="../imagenes/iconos/account-box-plus-outline.png" alt="" srcset="" class="button_img"> 
                                crear   
                            </button>

                            <button id="" class="input_form_text bg_color_red " onclick="set_abrir_formulario_nuevo_subuser();">  
                                <img src="../imagenes/iconos/cerrar.png" alt="" srcset="" class="button_img"> 
                                cerrar   
                            </button>

                        </div>


                    </div>
                </form>
            </div>






        </section>

           

    </main>
    <footer></footer>
    <script>set_datos_usuario();</script>
</body>
</html>