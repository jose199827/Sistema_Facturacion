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
  //Funcion para insertar un registro
  public function insert(string $query, array $arrvalues)
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;
    $insert = $this->conexion->prepare($this->strquery);
    $resInsert = $insert->execute($this->arrvalues);
    if ($resInsert) {
      $lastInsert = $this->conexion->lastInsertId();
    } else {
      $lastInsert = 0;
    }
    return $lastInsert;
  }
  //Funcion para buscar un registro
  public function select(string $query)
  {
    $this->strquery = $query;
    $result = $this->conexion->prepare($this->strquery);
    $result->execute();
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  //Funcion para devolver todos los registros
  public function selectAll(string $query)
  {
    $this->strquery = $query;
    $result = $this->conexion->prepare($this->strquery);
    $result->execute();
    $data = $result->fetchall(PDO::FETCH_ASSOC);
    return $data;
  }
  //Funcion para actualizar un registro
  public function update(string $query, array $arrvalues)
  {
    $this->strquery = $query;
    $this->arrvalues = $arrvalues;
    $update = $this->conexion->prepare($this->strquery);
    $resExecute = $update->execute($this->arrvalues);
    return $resExecute;
  }
  //Funcion para borrar un registro
  public function delete(string $query)
  {
    $this->strquery = $query;
    $result = $this->conexion->prepare($this->strquery);
    $del = $result->execute();
    return $del;
  }
}
