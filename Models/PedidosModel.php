<?php
//Se crea la clase homeModel
class PedidosModel extends Mysql
{
   public function __construct()
   {
      parent::__construct();
   }
   public function selectPedidos($idpersona = NULL)
   {
      $where = "";
      if ($idpersona != NULL) {
         $where = " WHERE p.personaid = " . $idpersona;
      }
      $sql = "SELECT 
      p.idpedido,
      p.referenciacobro, 
      p.idtransaccionpaypal, 
      DATE_FORMAT(p.fecha,'%d/%m/%y') AS fecha,
      p.monto,
      p.tipopagoid, 
      t.tipopago, 
      p.status 
      FROM pedido p
      INNER JOIN tipopago t 
      ON t.idtipopago= p.tipopagoid  $where";
      $request = $this->selectAll($sql);
      return $request;
   }
   public function selectPedido($idpedido, $idpersona = NULL)
   {
      $bucar = "";
      if ($idpersona != NULL) {
         $bucar = " AND p.personaid = " . $idpersona;
      }
      $arrData = array();
      $request = array();
      $sql = "SELECT p.idpedido, 
      p.referenciacobro, 
      p.idtransaccionpaypal,
      p.personaid,
      DATE_FORMAT(p.fecha,'%d/%m/%y') AS fecha,
      p.costo_envio,
      p.monto,
      p.tipopagoid,
      t.tipopago,
      p.Direccion_envio,
      p.status 
      FROM pedido p 
      INNER JOIN tipopago t 
      ON p.tipopagoid= t.idtipopago 
      WHERE p.idpedido=$idpedido " . $bucar;
      $request = $this->select($sql);
      if (!empty($request)) {
         $idpersona = $request['personaid'];
         $sql_cliente = "SELECT `idpersona`,`nombres`,`apellidos`,`telefono`,`email_user`,`nit`,`nombrefical`,`direccionfiscal` FROM `persona` WHERE `idpersona`=$idpersona";
         $request_cliente = $this->select($sql_cliente);
         $sql_detalle = "SELECT p.idproducto,p.nombre AS producto, d.precio,d.cantidad FROM detalle_pedido d INNER JOIN producto p ON d.productoid=p.idproducto WHERE d.pedidoid=$idpedido ";
         $request_producto = $this->selectAll($sql_detalle);
         $arrData = array(
            'cliente' => $request_cliente,
            'orden' => $request,
            'detalle' => $request_producto
         );
      }
      $arrData;
      return $arrData;
   }
   public function selectTransaccionPaypal($transaccion, $idpersona = NULL)
   {
      $bucar = "";
      if ($idpersona != NULL) {
         $bucar = " AND personaid = " . $idpersona;
      }
      $objTransaccion = array();
      $sql = "SELECT `datospaypal` FROM `pedido` WHERE `idtransaccionpaypal` ='{$transaccion}'" . $bucar;
      $request = $this->select($sql);
      if (!empty($request)) {
         $objData = json_decode($request['datospaypal']);
         $urlTransaccion = $objData->purchase_units[0]->payments->captures[0]->links[0]->href;
         $urlOrden = $objData->purchase_units[0]->payments->captures[0]->links[2]->href;
         $objTransaccion = CurlConnectionGet($urlOrden, "application/json", getTokenPaypal());
      }
      return $objTransaccion;
   }
}
