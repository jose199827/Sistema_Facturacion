<?php
require_once("Models/TTiposPagos.php");
class Pedidos extends Controllers
{
   use TTiposPagos;
   public function __construct()
   { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
      parent::__construct();
      session_start();
      session_regenerate_id(true);
      if (empty($_SESSION['login'])) {
         header('location: ' . Base_URL() . '/login');
      }
      getPermisos(5);
   }
   public function pedidos()
   {
      if (empty($_SESSION['permisosMod']['r'])) {
         header('location: ' . Base_URL() . '/Errors');
      }
      $data['page_tag'] = "Pedidos - Tienda Virtual";
      $data['page_title'] = "Pedidos";
      $data['page_name'] = "Listado de Pedidos";
      $data['page_funtions_js'] = "funtions_pedidos.js";
      $this->views->getView($this, "pedidos", $data);
   }
   public function getPedidos()
   {
      if ($_SESSION['permisosMod']['r']) {
         $idpersona = "";
         if ($_SESSION['userData']['idrol'] == RCLIENTES) {
            $idpersona = $_SESSION['userData']['idpersona'];
         }
         $arrData = $this->model->selectPedidos($idpersona);
         /* dep($arrData); */
         for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '';
            $btnEdit = '';
            $btnDel = '';
            $arrData[$i]['transaccion'] = $arrData[$i]['referenciacobro'];
            if ($arrData[$i]['idtransaccionpaypal'] != "") {
               $arrData[$i]['transaccion'] = $arrData[$i]['idtransaccionpaypal'];
            }

            $arrData[$i]['monto'] = SMONEY . formatMoney($arrData[$i]['monto']);

            if ($_SESSION['permisosMod']['r']) {
               $btnView = '
               <a class="dropdown-item" href="javascript:;" onClick="fntViewPedido(' . $arrData[$i]['idpedido'] . ')"><i class="dw dw-file2"></i> Generar PDF</a>

               <a class="dropdown-item btnViewPedido" href="' . base_url() . '/pedidos/orden/' . $arrData[$i]['idpedido'] .
                  '" target="_blanck" ><i class="dw dw-eye"></i> Ver Orden </a>';


               if ($arrData[$i]['tipopagoid'] == 1) {
                  $btnView .= '<a class="dropdown-item" href="' . base_url() . '/pedidos/transaccion/' . $arrData[$i]['idtransaccionpaypal'] . '" target="_blanck" ><i class="fa fa-paypal"></i> Ver Transacción</a>';
               }
            }
            if ($_SESSION['permisosMod']['u']) {
               $btnEdit = '<a class="dropdown-item" href="javascript:;" onClick="fntEditPedido(this,' . $arrData[$i]['idpedido'] . ')"><i class="dw dw-edit2"></i> Editar</a>';
            }
            if ($_SESSION['permisosMod']['d']) {
               $btnDel = '<a class="dropdown-item" href="javascript:;" onClick="fntDelPedido(' . $arrData[$i]['idpedido'] . ')"><i class="dw dw-delete-3"></i> Eliminar</a>';
            }

            $arrData[$i]['options'] = '<div class="dropdown ">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="javascript:;" role="button"
                                                  data-toggle="dropdown">
                                                  <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                  ' . $btnView . '
                                                  ' . $btnEdit . '
                                                  ' . $btnDel . '                                                 
                                                </div>
                                              </div>';
         }
         /**/
         echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
         die();
      }
   }

   public function orden($idpedido)
   {
      if (empty($_SESSION['permisosMod']['r'])) {
         header('location: ' . Base_URL() . '/Errors');
      }
      $idpersona = '';
      if ($_SESSION['userData']['idrol'] == RCLIENTES) {
         $idpersona = $_SESSION['userData']['idpersona'];
      }
      $data['page_tag'] = "Orden - Tienda Virtual";
      $data['page_title'] = "Ordenes";
      $data['page_name'] = "Orden de Compra";
      $data['arrPedido'] = $this->model->selectPedido($idpedido, $idpersona);
      $data['page_funtions_js'] = "funtions_pedidos.js";
      if ((empty($data['arrPedido']))) {
         header('location: ' . Base_URL() . '/Pedidos');
      }
      $this->views->getView($this, "orden", $data);
   }
   public function transaccion($transaccion)
   {
      if (empty($_SESSION['permisosMod']['r'])) {
         header('location: ' . Base_URL() . '/Errors');
      }
      $idpersona = '';
      if ($_SESSION['userData']['idrol'] == RCLIENTES) {
         $idpersona = $_SESSION['userData']['idpersona'];
      }
      $requestTransaccion = $this->model->selectTransaccionPaypal($transaccion, $idpersona);
      $data['page_tag'] = "Detalle Transacción - Tienda Virtual";
      $data['page_title'] = "Transacciones";
      $data['page_name'] = "Detalle Transacción";
      $data['objTransaccion'] = $requestTransaccion;
      if (empty($data['objTransaccion'])) {
         header('location: ' . Base_URL() . '/Pedidos');
      }
      $data['page_funtions_js'] = "funtions_pedidos.js";
      $this->views->getView($this, "transaccion", $data);
   }
   public function getTransaccion($idTransaccion)
   {
      if ($_SESSION['permisosMod']['r'] && $_SESSION['userData']['idrol'] != RCLIENTES) {
         if ($idTransaccion == "") {
            $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
         } else {
            $transaccion = strClean($idTransaccion);
            $requestTransaccion = $this->model->selectTransaccionPaypal($transaccion);

            if (empty($requestTransaccion)) {
               $arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
            } else {
               $htmlModal = getFile("Templante/Modals/modalReembolso", $requestTransaccion);
               $arrResponse = array("status" => true, "html" => $htmlModal);
            }
         }
         echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
   }
   public function setReembolso()
   {
      if ($_POST) {
         $arrResponse = array();
         if ($_SESSION['permisosMod']['u'] && $_SESSION['userData']['idrol'] != RCLIENTES) {
            /* dep($_POST); */
            $transaccion = strClean($_POST['idtransaccion']);
            $observacion = strClean($_POST['observacion']);
            $requestTransaccion = $this->model->reembolsoPaypal($transaccion, $observacion);
            if ($requestTransaccion) {
               $arrResponse = array("status" => true, "msg" => "Se ha proceso el Reembolso.");
            } else {
               $arrResponse = array("status" => false, "msg" => "No es posible procesar el Reembolso.");
            }
         } else {
            $arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, consulte al administrador.");
         }
         echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
   }
   public function getPedido($pedido)
   {
      if ($_SESSION['permisosMod']['u'] && $_SESSION['userData']['idrol'] != RCLIENTES) {
         if ($pedido == "") {
            $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
         } else {
            $idpedido = intval($pedido);
            $requestPedido = $this->model->selectPedido($idpedido, "");
            if (empty($requestPedido)) {
               $arrResponse = array("status" => false, "msg" => "Datos no Encontrados.");
            } else {
               $requestPedido['tiposPago'] = $this->getTiposPagoT();
               $htmlModal = getFile("Templante/Modals/modalPedido", $requestPedido);
               $arrResponse = array("status" => true, "html" => $htmlModal);
            }
         }
         echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
   }
   public function setPedido()
   {
      if ($_POST) {
         if ($_SESSION['permisosMod']['u'] && $_SESSION['userData']['idrol'] != RCLIENTES) {
            $idpedido = !empty($_POST['idPedido']) ? intval($_POST['idPedido']) : "";
            $txttrans = !empty($_POST['txttrans']) ? strClean($_POST['txttrans']) : "";
            $listTipoPago = !empty($_POST['listTipoPago']) ? intval($_POST['listTipoPago']) : "";
            $listStatus = !empty($_POST['listStatus']) ? strClean($_POST['listStatus']) : "";
            if ($idpedido == "") {
               $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
            } else {
               if ($listTipoPago == "") {
                  if ($listStatus == "") {
                     $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
                  } else {
                     $requestPedido = $this->model->updatePedido($idpedido, "", "", $listStatus);
                     if ($requestPedido) {
                        $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente.");
                     } else {
                        $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                     }
                  }
               } else {
                  if ($listStatus == "" || $txttrans == "" || $listTipoPago == "") {
                     $arrResponse = array("status" => false, "msg" => "Datos incorrectos.");
                  } else {
                     $requestPedido = $this->model->updatePedido($idpedido, $txttrans, $listTipoPago, $listStatus);
                     if ($requestPedido) {
                        $arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente.");
                     } else {
                        $arrResponse = array("status" => false, "msg" => "No es posible actualizar la información.");
                     }
                  }
               }
            }
         }
         echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
      }
      die();
   }
}
