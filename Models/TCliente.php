<?php
require_once("Libraries/Core/Mysql.php");
trait TCliente
{
   private $con;
   private $intIdTransaccion;
   private $intIdUsuario;
   private $strNombre;
   private $strApellido;
   private $strTelefono;
   private $strEmail;
   private $strPassword;
   private $strToken;
   private $intTipoId;

   /*    private $idtransaccionpaypal;
   private $datospaypal;
   private $personaid;
   private $monto;
   private $tipopagoid;
   private $direccionenvio;
   private $status; */

   public function insertClienteT(
      $strNombre,
      $strApellido,
      $strTelefono,
      $strEmail,
      $strPasswordEncript,
      $intTipoId
   ) {
      $this->con = new Mysql();
      $this->strNombre = $strNombre;
      $this->strApellido = $strApellido;
      $this->strTelefono = $strTelefono;
      $this->strEmail = $strEmail;
      $this->strPassword = $strPasswordEncript;
      $this->intTipoId = $intTipoId;
      $return = "";
      $sql = "SELECT * FROM `persona` WHERE `email_user`= '{$this->strEmail}';";
      $request = $this->con->selectAll($sql);
      if ($this->strNombre == "" || $this->strApellido == "" || $this->strTelefono == "" || $this->strEmail == "" || $this->strPassword == "") {
         $return = "sqlinjection";
      } else if (empty($request)) {
         $sql = "INSERT INTO `persona` (`nombres`, `apellidos`, `telefono`, `email_user`, `password`,rolid) VALUES (?,?,?,?,?,?)";
         $arrData = array(
            $this->strNombre,
            $this->strApellido,
            $this->strTelefono,
            $this->strEmail,
            $this->strPassword,
            $this->intTipoId
         );
         $request_insert = $this->con->insert($sql, $arrData);
         $return = $request_insert;
      } else {
         $return = "exist";
      }
      return $return;
   }
   public function insertDetalleTemp(array $pedido)
   {
      $this->con = new Mysql();
      $this->intIdUsuario = $pedido['idcliente'];
      $this->intIdTransaccion = $pedido['idtransaccion'];
      $productos = $pedido['productos'];
      $sql = "SELECT * FROM `detalle_temp` WHERE `transaccionid`='{$this->intIdTransaccion}' AND `personaid`=$this->intIdUsuario";
      $request = $this->con->selectAll($sql);
      if (empty($request)) {
         foreach ($productos  as $producto) {
            $query_insert = "INSERT INTO `detalle_temp`(`personaid`, `productoid`, `precio`, `cantidad`, `transaccionid`) VALUES (?,?,?,?,?)";
            $arrData = array(
               $this->intIdUsuario,
               $producto['idproducto'],
               $producto['precio'],
               $producto['cantidad'],
               $this->intIdTransaccion
            );
            $request_insert = $this->con->insert($query_insert, $arrData);
         }
      } else {
         $sqlDelete = "DELETE FROM `detalle_temp`  WHERE `transaccionid`='{$this->intIdTransaccion}' AND `personaid`=$this->intIdUsuario";
         $request = $this->con->delete($sqlDelete);
         foreach ($productos  as $producto) {
            $query_insert = "INSERT INTO `detalle_temp`(`personaid`, `productoid`, `precio`, `cantidad`, `transaccionid`) VALUES (?,?,?,?,?)";
            $arrData = array(
               $this->intIdUsuario,
               $producto['idproducto'],
               $producto['precio'],
               $producto['cantidad'],
               $this->intIdTransaccion
            );
            $request_insert = $this->con->insert($query_insert, $arrData);
         }
      }
   }
   public function
   insertPedido(
      $idtransaccionpaypal,
      $datospaypal,
      $personaid,
      $costoEnvio,
      $monto,
      $tipopagoid,
      $direccionenvio,
      $status
   ) {
      $this->con = new Mysql();
      $query_insert = "INSERT INTO `pedido`(`idtransaccionpaypal`, `datospaypal`, `personaid`,`costo_envio`, `monto`, `tipopagoid`, `Direccion_envio`, `status`) VALUES (?,?,?,?,?,?,?,?)";
      $arrData = array(
         $idtransaccionpaypal,
         $datospaypal,
         $personaid,
         $costoEnvio,
         $monto,
         $tipopagoid,
         $direccionenvio,
         $status
      );
      $request_insert = $this->con->insert($query_insert, $arrData);
      return $request_insert;
   }
   public function insertDetalle($pedido, $productoid, $precio, $cantidad)
   {
      $this->con = new Mysql();
      $query_insert = "INSERT INTO `detalle_pedido`(`pedidoid`, `productoid`, `precio`, `cantidad`) VALUES (?,?,?,?)";
      $arrData = array($pedido, $productoid, $precio, $cantidad);
      $request_insert = $this->con->insert($query_insert, $arrData);
      return $request_insert;
   }
   public function getPedido($idpedido)
   {
      $this->con = new Mysql();
      $request = array();
      $sql = "SELECT p.idpedido, p.referenciacobro, p.idtransaccionpaypal,p.personaid,p.fecha,p.costo_envio,p.monto,p.tipopagoid,t.tipopago,p.Direccion_envio,p.status FROM pedido p INNER JOIN tipopago t ON p.tipopagoid= t.idtipopago WHERE p.idpedido=$idpedido";
      $requestpedido = $this->con->select($sql);
      if (count($requestpedido) > 0) {
         $sql_detalle = "SELECT p.idproducto,p.nombre AS producto, d.precio,d.cantidad FROM detalle_pedido d INNER JOIN producto p ON d.productoid=p.idproducto WHERE d.pedidoid=$idpedido ";
         $request_producto = $this->con->selectAll($sql_detalle);
         $request = array(
            'orden' => $requestpedido,
            'detalle' => $request_producto
         );
      }
      return $request;
   }
}
