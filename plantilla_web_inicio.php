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
    <link rel="stylesheet" href="css/inicio.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="js/inicio.js"></script>

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
                    <img src="imagenes/iconos/account-circle.png" alt="" class="iconos_2" id="logo_user">
                    <div class="flex">
                        <span class="titulos"><?php echo $user;?></spa>
                    </div>
                    <a href="#modificar">Actualizar Datos</a>
                </div>
                <hr>

                <div class="opcion_menu_p">
                    <img src="imagenes/iconos/account-cog.png" alt="" class="iconos" id="logo_user">
                    <a href=""><span>usuarios</span></a>
                </div>

                <div class="opcion_menu_p">
                    <img src="imagenes/iconos/account-circle.png" alt="" class="iconos" id="logo_user">
                    <a href=""><span>clientes</span></a>
                </div>

                <div class="opcion_menu_p">
                    <img src="imagenes/iconos/NCF.png" alt="" class="iconos" id="logo_user">
                    <a href=""><span>comprobantes</span></a>
                </div>

                <div class="opcion_menu_p flex_centrado_colum clas_relative">
                    <div class="flex">
                        <img src="imagenes/iconos/inventario.png" alt="" class="iconos" id="logo_user" onclick="set_cerrar_opciones_inventario();">
                        <a href="#" onclick="set_cerrar_opciones_inventario();"><span>inventario</span></a>

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
                    <img src="imagenes/iconos/cash-register.png" alt="" class="iconos" id="logo_user">
                    <a href="#"><span>ventas</span></a>
                </div>

                <div class="opcion_menu_p clas_relative">
                    <img src="imagenes/iconos/invoice-text-plus.png" alt="" class="iconos" id="logo_user">
                    <a href="#"><span>compras</span></a>
                </div>







        </section>
        <section></section>
    </main>
    <footer></footer>
</body>
</html>