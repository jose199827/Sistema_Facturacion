<?php
require_once("Models/TCategoria.php");
require_once("Models/TProducto.php");
require_once("Models/TCliente.php");
require_once("Models/LoginModel.php");
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Tienda extends Controllers
{
    use TCategoria, TProducto, TCliente;
    public $login;
    public function __construct()
    { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
        parent::__construct();
        session_start();
        $this->login = new LoginModel();
    }
    //Se crea el método Home
    public function tienda()
    {
        $data['page_tag'] = NOMBRE_EMPRESA;
        $data['page_title'] = NOMBRE_EMPRESA;
        $data['page_name'] = "tienda";
        $data['productos'] = $this->getProductosT();
        /* $data['page_funtions_js'] = "funtions_login.js"; */
        $this->views->getView($this, "tienda", $data);
    }
    public function Categoria($params)
    {
        if (empty($params)) {
            header('Location: ' . Base_URL());
        } else {
            $arrParras = explode(",", $params);
            $idcategoria = intval($arrParras[0]);
            $ruta = strClean($arrParras[1]);
            $infoCategoria = $this->getProductosCategodiaT($idcategoria, $ruta);
            $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $infoCategoria['categoria'];
            $data['page_title'] = $infoCategoria['categoria'];
            $data['page_name'] = "categoría";
            $data['productos'] = $infoCategoria['productos'];
            $this->views->getView($this, "categoria", $data);
        }
    }
    public function Producto($params)
    {
        if (empty($params)) {
            header('Location: ' . Base_URL());
        } else {
            $arrParras = explode(",", $params);
            $idproducto = intval($arrParras[0]);
            $ruta = strClean($arrParras[1]);
            $infoProducto = $this->getProductoT($idproducto, $ruta);
            if (empty($infoProducto)) {
                header('Location: ' . Base_URL() . '/Tienda');
            }
            $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $infoProducto['nombre'];
            $data['page_title'] = $infoProducto['nombre'];
            $data['page_name'] = "producto";
            $data['producto'] = $infoProducto;
            $data['productos'] = $this->getProductosRandom($infoProducto['categoriaid'], 8, "r");
            $this->views->getView($this, "producto", $data);
        }
    }
    public function addCarrito()
    {
        if ($_POST) {
            $arrCarrito = array();
            $cantCarrito = 0;
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $cantidad = $_POST['cant'];
            if (is_numeric($idproducto) && is_numeric($cantidad)) {
                $arraInfoProducto = $this->getProductoIdT($idproducto);
                if (!empty($arraInfoProducto)) {
                    $arrProducto = array(
                        'idproducto' => $idproducto,
                        'producto' => $arraInfoProducto['nombre'],
                        'cantidad' => $cantidad,
                        'precio' => $arraInfoProducto['precio'],
                        'ruta' => $arraInfoProducto['ruta'],
                        'imagen' => $arraInfoProducto['images'][0]['url_img']
                    );
                    if (isset($_SESSION['arrCarrito'])) {
                        $on = true;
                        $arrCarrito = $_SESSION['arrCarrito'];
                        for ($i = 0; $i < count($arrCarrito); $i++) {
                            if ($arrCarrito[$i]['idproducto'] == $idproducto) {
                                $arrCarrito[$i]['cantidad'] +=  $cantidad;
                                $on = false;
                            }
                        }
                        if ($on) {
                            array_push($arrCarrito, $arrProducto);
                        }
                        $_SESSION['arrCarrito'] = $arrCarrito;
                    } else {
                        array_push($arrCarrito, $arrProducto);
                        $_SESSION['arrCarrito'] = $arrCarrito;
                    }
                    foreach ($_SESSION['arrCarrito'] as $pro) {
                        /* dep($pro);
                        exit(); */
                        $cantCarrito += $pro['cantidad'];
                    }
                    $htmlCarrito = "";
                    $htmlCarrito = getFile('Templante/Modals/modalCarrito', $_SESSION['arrCarrito']);
                    $arrResponse = array(
                        "status" => true,
                        "msg" => '¡Se ha agregado al carrito!',
                        "cantCarrito" => $cantCarrito,
                        "htmlCarrito" => $htmlCarrito
                    );
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Producto no existente');
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function delCarrito()
    {
        if ($_POST) {
            //Punto de depuración para ver lo que se esta mandando
            /* dep($_POST); */
            $arrCarrito = array();
            $cantCarrito = 0;
            $subtotal = 0;
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $option = $_POST['option'];
            if (is_numeric($idproducto) && ($option == 1 || $option == 2)) {
                $arrCarrito = $_SESSION['arrCarrito'];
                for ($i = 0; $i < count($arrCarrito); $i++) {
                    if ($arrCarrito[$i]['idproducto'] == $idproducto) {
                        unset($arrCarrito[$i]);
                    }
                }
                sort($arrCarrito);
                $_SESSION['arrCarrito'] = $arrCarrito;
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $cantCarrito += $pro['cantidad'];
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $total = $subtotal + COSTOENVIO;
                $htmlCarrito = "";
                if ($option == 1) {
                    $htmlCarrito = getFile('Templante/Modals/modalCarrito', $_SESSION['arrCarrito']);
                }
                $arrResponse = array(
                    "status" => true,
                    "msg" => '¡Se ha eliminado del carrito!',
                    "cantCarrito" => $cantCarrito,
                    "subtotal" => SMONEY . formatMoney($subtotal),
                    "total" => SMONEY . formatMoney($total),
                    "htmlCarrito" => $htmlCarrito
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function updCarrito()
    {
        if ($_POST) {
            $arrCarrito = array();
            $totalProducto = 0;
            $subtotal = 0;
            $total = 0;
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
            $cantidad = intval($_POST['cantidad']);
            if (is_numeric($idproducto) && $cantidad > 0) {
                $arrCarrito = $_SESSION['arrCarrito'];

                for ($i = 0; $i < count($arrCarrito); $i++) {
                    if ($arrCarrito[$i]['idproducto'] == $idproducto) {
                        $arrCarrito[$i]['cantidad'] = $cantidad;
                        $totalProducto = $arrCarrito[$i]['precio'] * $cantidad;
                        break;
                    }
                }
                $_SESSION['arrCarrito'] = $arrCarrito;
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $subtotal  += $pro['cantidad'] * $pro['precio'];
                }
                $total = $subtotal + COSTOENVIO;
                $arrResponse = array(
                    "status" => true,
                    "msg" => '¡Producto actualizado carrito!',
                    "totalProducto" => SMONEY . formatMoney($totalProducto),
                    "subtotal" => SMONEY . formatMoney($subtotal),
                    "total" => SMONEY . formatMoney($total)
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function registro()
    {
        if ($_POST) {
            if (empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtEmailCliente']) || empty($_POST['txtTelefono'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strApellido = ucwords(strClean($_POST['txtApellido']));
                $strTelefono = strClean($_POST['txtTelefono']);
                $strEmail = strtolower(strClean($_POST['txtEmailCliente']));
                $intTipoId = 2;
                $request_user = "";

                $strPassword = passGenerator();
                $strPasswordEncript = hash("SHA256", $strPassword);
                $request_user = $this->insertClienteT(
                    $strNombre,
                    $strApellido,
                    $strTelefono,
                    $strEmail,
                    $strPasswordEncript,
                    $intTipoId
                );

                if ($request_user > 0) {
                    $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente, Se ha mandado un correo a tu cuenta.');
                    $nombreUsuario = $strNombre . ' ' . $strApellido;
                    $dataUsuario = array(
                        'nombreUsuario' => $nombreUsuario,
                        'email' => $strEmail,
                        'password' => $strPassword,
                        'asunto' => 'Bienvenido a tu Tienda en Linea',
                    );
                    $_SESSION['idUser'] = $request_user;
                    $_SESSION['login'] = true;
                    $this->login->sessionLogin($request_user);
                    sendEmail($dataUsuario, 'email_bienvenidaCliente');
                } else if ($request_user == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! el email  ya existe.');
                } else if ($request_user == 'sqlinjection') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! Se ha detectado una inserción de SQL Injection.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function procesarVenta()
    {
        /* dep($_POST); */
        if ($_POST) {
            $idtransaccionpaypal = NULL;
            $datospaypal = NULL;
            $personaid = $_SESSION['idUser'];
            $monto = 0;
            $tipopagoid = intval($_POST['inttipopago']);
            $direccionenvio = strClean($_POST['direccion'] . ', ' . strClean($_POST['ciudad']));
            $status = "Pendiente";
            $subtotal = 0;

            if (!empty($_SESSION['arrCarrito'])) {
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $monto = formatMoney($subtotal + COSTOENVIO);
                if (empty($_POST['datapay'])) {
                    # code...
                } else {
                    $jsonPaypal = $_POST['datapay'];
                    $objPaypal = json_decode($jsonPaypal);
                    $status = "Aprobado";
                    if (is_object($objPaypal)) {
                        $datospaypal = $jsonPaypal;
                        $idtransaccionpaypal = $objPaypal->purchase_units[0]->payments->captures[0]->id;
                        if ($objPaypal->status == "COMPLETED") {
                            $totalPaypal = formatMoney($objPaypal->purchase_units[0]->amount->value);
                            if ($monto ==  $totalPaypal) {
                                $status = "Completo";
                            }
                            $request_pedido = $this->insertPedido(
                                $idtransaccionpaypal,
                                $datospaypal,
                                $personaid,
                                $monto,
                                $tipopagoid,
                                $direccionenvio,
                                $status
                            );
                            if ($request_pedido > 0) {
                                foreach ($_SESSION['arrCarrito'] as $producto) {
                                    $productoid = $producto['idproducto'];
                                    $precio = $producto['precio'];
                                    $cantidad = $producto['cantidad'];
                                    $this->insertDetalle($request_pedido, $productoid, $precio, $cantidad);
                                }
                                $orden = openssl_encrypt($request_pedido, METHODENCRIPT, KEY);
                                $transaccion = openssl_encrypt($idtransaccionpaypal, METHODENCRIPT, KEY);
                                $arrResponse = array(
                                    "status" => true,
                                    "orden" =>   $orden,
                                    "transaccion" => $transaccion,
                                    "msg" => 'Se ha realizado el pedido.',
                                );
                                $_SESSION['dataorden'] =  $arrResponse;
                                unset($_SESSION['arrCarrito']);
                                session_regenerate_id(true);
                            } else {
                                $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
                            }
                        } else {
                            $arrResponse = array("status" => false, "msg" => 'No es posible completar el pago con PayPal.');
                        }
                    } else {
                        $arrResponse = array("status" => false, "msg" => 'Hubo un error en la transacción.');
                    }
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
            }
        } else {
            $arrResponse = array("status" => false, "msg" => 'No es posible procesar el pedido.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function confirmarPedido()
    {
        if (empty($_SESSION['dataorden'])) {
            header('location: ' . Base_URL());
        } else {
            $dataorden = $_SESSION['dataorden'];
            $idpedido = openssl_decrypt($dataorden['orden'], METHODENCRIPT, KEY);
            $idtransaccion = openssl_decrypt($dataorden['transaccion'], METHODENCRIPT, KEY);
            $data['idpedido'] = $idpedido;
            $data['idtransaccion'] = $idtransaccion;
            $data['page_tag'] = "Confirmar Pedido";
            $data['page_title'] = "Confirmar Pedido";
            $data['page_name'] = "Confirmar Pedido";
            $this->views->getView($this, "confirmarpedido", $data);
        }
        unset($_SESSION['dataorden']);
    }
}
