<?php
require_once("Libraries/Core/Mysql.php");
trait TTiposPagos
{
   private $con;
   public function getTiposPagoT()
   {
      $this->con = new Mysql();
      $sql = "SELECT * FROM tipopago WHERE `status`=1;";
      $request = $this->con->selectAll($sql);
      return $request;
   }
}
