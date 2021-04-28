<?php
//Se crea la clase homeModel
class ProductosModel extends Mysql
{
  private $idproducto;
  private $categoriaid;
  private $codigo;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $status;
  private $imgNombre;
  public function __construct()
  {
    parent::__construct();
  }
  public function selectProductos()
  {
    $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock, p.status FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.status !=0";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function selectProducto($idProducto)
  {
    $this->idproducto = $idProducto;
    $sql = "SELECT p.idproducto,p.codigo, p.nombre, p.descripcion, p.precio,p.stock,p.categoriaid, c.nombre AS categoria, p.status FROM producto p INNER JOIN categoria c ON p.categoriaid= c.idcategoria WHERE p.idproducto= $this->idproducto";
    $request = $this->select($sql);
    return $request;
  }
  public function selectImagenes($idProducto)
  {
    $this->idproducto = $idProducto;
    $sql = "SELECT productoid, img FROM `imagen` WHERE productoid= $this->idproducto";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function insertProducto($strNombre, $strDescripcion, $strCodigo, $intCategoriaid, $strPrecio, $intStock, $intStatus)
  {
    $this->nombre = $strNombre;
    $this->descripcion = $strDescripcion;
    $this->codigo = $strCodigo;
    $this->categoriaid = $intCategoriaid;
    $this->precio = $strPrecio;
    $this->stock = $intStock;
    $this->status = $intStatus;
    $return = 0;
    $sql = "SELECT * FROM `producto` WHERE `codigo`= '{$this->codigo}'";
    $request = $this->selectAll($sql);
    if ($this->nombre == "" || $this->descripcion == "" || $this->codigo == "" || $this->categoriaid == "" || $this->precio == "" || $this->stock == "" || $this->status == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $query_insert = "INSERT INTO `producto` (`categoriaid`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`,`status`) VALUES (?, ?, ?, ?, ?, ?,?)";
      $arrData = array(
        $this->categoriaid,
        $this->codigo,
        $this->nombre,
        $this->descripcion,
        $this->precio,
        $this->stock,
        $this->status
      );
      $request_insert = $this->insert($query_insert, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function updateProducto($idProducto, $strNombre, $strDescripcion, $strCodigo, $intCategoriaid, $strPrecio, $intStock, $intStatus)
  {
    $this->idproducto = $idProducto;
    $this->nombre = $strNombre;
    $this->descripcion = $strDescripcion;
    $this->codigo = $strCodigo;
    $this->categoriaid = $intCategoriaid;
    $this->precio = $strPrecio;
    $this->stock = $intStock;
    $this->status = $intStatus;
    $return = 0;
    $sql = "SELECT * FROM `producto` WHERE `codigo`= '{$this->codigo}' AND idproducto != $this->idproducto";
    $request = $this->selectAll($sql);
    if ($this->nombre == "" || $this->descripcion == "" || $this->codigo == "" || $this->categoriaid == "" || $this->precio == "" || $this->stock == "" || $this->status == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $query_insert = "UPDATE producto SET categoriaid=?, codigo=?,nombre=?,descripcion=?,precio=?,stock=?,`status`=? WHERE idproducto= $this->idproducto";
      $arrData = array(
        $this->categoriaid,
        $this->codigo,
        $this->nombre,
        $this->descripcion,
        $this->precio,
        $this->stock,
        $this->status
      );
      $request = $this->update($query_insert, $arrData);
      $return = $request;
    } else {
      $return = "exist";
    }
    return $return;
  }
  public function  insertImage($idProducto, $imgNombre)
  {
    $this->idproducto = $idProducto;
    $this->imgNombre = $imgNombre;
    $sql = "INSERT INTO `imagen` (`productoid`, `img`) VALUES (?, ?) ;";
    $arrData = array(
      $this->idproducto,
      $this->imgNombre
    );
    $request_insert = $this->insert($sql, $arrData);
    $return = $request_insert;
    return $return;
  }
  public function  delImage($idProducto, $imgNombre)
  {
    $this->idproducto = $idProducto;
    $this->imgNombre = $imgNombre;
    $sql = "DELETE FROM imagen WHERE productoid= $this->idproducto AND img='{$this->imgNombre}'";

    $request = $this->delete($sql);
    $return = $request;
    return $return;
  }
  public function deleteProducto($idProducto)
  {
    $this->idproducto = $idProducto;
    $sql = "UPDATE `producto` SET `status` = ? WHERE `producto`.`idproducto` = $this->idproducto; ";
    $arrData = array(0);
    $request = $this->update($sql, $arrData);
    return $request;
  }
}
