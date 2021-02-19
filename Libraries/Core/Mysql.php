<?php
class Mysql extends Conexion
{
  private $conexion;
  private $strquery;
  private $arrvalues;
  public function __construct()
  {
    $this->conexion = new conexion();
    $this->conexion = $this->conexion->conect();
  }
  public function insert(string $query, array $arrvalues)
  {
    # code...
  }
}
