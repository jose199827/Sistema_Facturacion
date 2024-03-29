<?php
//Se crea la clase homeModel
class CategoriasModel extends Mysql
{
  public $idCategoria;
  public $strCategoria;
  public $strDescripcion;
  public $intStatus;
  public $strPorta;
  private $ruta;
  public function __construct()
  {
    parent::__construct();
  }
  public function insertCategoria(
    string $strCategoria,
    string $strDescripcion,
    int $intStatus,
    string $imgPortada,
    string $ruta
  ) {
    $this->strCategoria = $strCategoria;
    $this->strDescripcion = $strDescripcion;
    $this->intStatus = $intStatus;
    $this->strPorta = $imgPortada;
    $this->ruta = $ruta;
    $sql = "SELECT * FROM `categoria` WHERE  `nombre` ='{$this->strCategoria}'  AND `status`=1";
    $request = $this->selectAll($sql);
    if ($this->strCategoria == "" || $this->strDescripcion == "" || $this->intStatus == "" || $this->strPorta == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {

      $sql = "INSERT INTO `categoria` (`nombre`, `descripcion`, `portada`,`ruta`,`status`) VALUES (?,?,?,?,?)";
      $arrData = array($this->strCategoria, $this->strDescripcion, $this->strPorta, $this->ruta, $this->intStatus);
      $request_insert = $this->insert($sql, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function updateCategoria($intidCategoria, $strCategoria, $strDescripcion, $intStatus, $imgPortada, string $ruta)
  {
    $this->idCategoria = $intidCategoria;
    $this->strCategoria = $strCategoria;
    $this->strDescripcion = $strDescripcion;
    $this->intStatus = $intStatus;
    $this->strPorta = $imgPortada;
    $this->ruta = $ruta;
    $sql = "SELECT * FROM `categoria` WHERE  `nombre` ='{$this->strCategoria}'  AND `idcategoria` !=$this->idCategoria   AND `status`=1 ";
    $request = $this->selectAll($sql);

    if ($this->idCategoria == "" || $this->strCategoria == "" || $this->strDescripcion == "" || $this->intStatus == "" || $this->strPorta == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $sql = "UPDATE `categoria` SET `nombre`=?,
        `descripcion`=?,
        `portada`=?,
        `ruta`=?,
        `status`=?
        WHERE `idcategoria`=$this->idCategoria";
      $arrData = array(
        $this->strCategoria,
        $this->strDescripcion,
        $this->strPorta,
        $this->ruta,
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
  public function getCategoriasFooter()
  {
    $sql = "SELECT * FROM categoria WHERE status=1 AND idcategoria IN(" . CAT_FOOTER . ");";
    $request = $this->selectAll($sql);
    if (count($request) > 0) {
      for ($c = 0; $c < count($request); $c++) {
        $request[$c]['portada'] = media() . '/img/imgUploads/imgCategorias/'
          . $request[$c]['portada'];
      }
    }
    return $request;
  }
}
