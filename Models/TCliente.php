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
      $monto,
      $tipopagoid,
      $direccionenvio,
      $status
   ) {
      $this->con = new Mysql();
      $query_insert = "INSERT INTO `pedido`(`idtransaccionpaypal`, `datospaypal`, `personaid`, `monto`, `tipopagoid`, `Direccion_envio`, `status`) VALUES (?,?,?,?,?,?,?)";
      $arrData = array(
         $idtransaccionpaypal,
         $datospaypal,
         $personaid,
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
}
