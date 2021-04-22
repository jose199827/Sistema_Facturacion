<?php
//Se crea la clase homeModel
class CategoriasModel extends Mysql
{
  public $idCategoria;
  public $strCategoria;
  public $strDescripcion;
  public $intStatus;
  public $strPorta;
  public function __construct()
  {
    parent::__construct();
  }
  public function insertCategoria(string $strCategoria, string $strDescripcion, int $intStatus, string $imgPortada)
  {
    $this->strCategoria = $strCategoria;
    $this->strDescripcion = $strDescripcion;
    $this->intStatus = $intStatus;
    $this->strPorta = $imgPortada;
    $sql = "SELECT * FROM `categoria` WHERE  `nombre` ='{$this->strCategoria}'  AND `status`=1";
    $request = $this->selectAll($sql);
    if ($this->strCategoria == "" || $this->strDescripcion == "" || $this->intStatus == "" || $this->strPorta == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {

      $sql = "INSERT INTO `categoria` (`nombre`, `descripcion`, `portada`,`status`) VALUES (?,?,?,?)";
      $arrData = array($this->strCategoria, $this->strDescripcion, $this->strPorta, $this->intStatus);
      $request_insert = $this->insert($sql, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function updateCategoria($intidCategoria, $strCategoria, $strDescripcion, $intStatus, $imgPortada)
  {
    $this->idCategoria = $intidCategoria;
    $this->strCategoria = $strCategoria;
    $this->strDescripcion = $strDescripcion;
    $this->intStatus = $intStatus;
    $this->strPorta = $imgPortada;
    $sql = "SELECT * FROM `categoria` WHERE  `nombre` ='{$this->strCategoria}'  AND `idcategoria` !=$this->idCategoria   AND `status`=1 ";
    $request = $this->selectAll($sql);

    if ($this->idCategoria == "" || $this->strCategoria == "" || $this->strDescripcion == "" || $this->intStatus == "" || $this->strPorta == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $sql = "UPDATE `categoria` SET `nombre`=?,
        `descripcion`=?,
        `portada`=?,
        `status`=?
        WHERE `idcategoria`=$this->idCategoria";
      $arrData = array(
        $this->strCategoria,
        $this->strDescripcion,
        $this->strPorta,
        $this->intStatus
      );
      $request = $this->update($sql, $arrData);
      $return = $request;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function deleteCategoria(int $intIdpersona)
  {
    $this->idCategoria = $intIdpersona;
    $sql = "SELECT * FROM `producto` WHERE  `categoriaid`=  $this->idCategoria";
    $request = $this->selectAll($sql);
    if (empty($request)) {
      $sql = "UPDATE `categoria` SET `status`= ? WHERE `idcategoria` = $this->idCategoria";
      $arrData = array(0);
      $request = $this->update($sql, $arrData);
      if ($request) {
        $request = 'ok';
      } else {
        $request = 'error';
      }
    } else {
      $request = "exist";
    }
    return $request;
  }
  public function selectCategorias()
  {
    $sql = "SELECT `idcategoria`,`nombre`,`descripcion`,`portada`,`status` FROM `categoria` WHERE `status` != 0;";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function selectCategoria(int $idcategoria)
  {
    $this->idCategoria = $idcategoria;
    $sql = "SELECT * FROM `categoria` WHERE `idcategoria`= $this->idCategoria;";
    $request = $this->select($sql);
    return $request;
  }
}
