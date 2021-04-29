<?php
require_once("Libraries/Core/Mysql.php");
trait TProducto
{
   private $con;
   private $strCategoria;
   private $strProducto;
   private $intIdCategoria;
   private $intCantidad;
   private $strOption;
   public function getProductosT()
   {
      $this->con = new Mysql();
      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.status !=0 ORDER BY p.idproducto DESC";
      $request = $this->con->selectAll($sql);

      if (count($request) > 0) {

         for ($i = 0; $i < count($request); $i++) {
            $intIdProducto = $request[$i]['idproducto'];
            $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
            $arrImg = $this->con->selectAll($sqlImg);
            if (count($arrImg) > 0) {
               for ($j = 0; $j < count($arrImg); $j++) {
                  $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
               }
            }
            $request[$i]['images'] = $arrImg;
         }
      }
      return $request;
   }
   public function getProductosCategodiaT(string $categoria)
   {
      $this->con = new Mysql();
      $this->strCategoria = $categoria;
      $sql = "SELECT `idcategoria` FROM `categoria` WHERE `nombre`= '{$this->strCategoria}';";
      $request = $this->con->select($sql);

      if (!empty($request)) {
         $this->intIdCategoria = $request['idcategoria'];
         $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.categoriaid= $this->intIdCategoria AND p.status !=0 ORDER BY p.idproducto DESC";
         $request = $this->con->selectAll($sql);

         if (count($request) > 0) {

            for ($i = 0; $i < count($request); $i++) {
               $intIdProducto = $request[$i]['idproducto'];
               $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
               $arrImg = $this->con->selectAll($sqlImg);
               if (count($arrImg) > 0) {
                  for ($j = 0; $j < count($arrImg); $j++) {
                     $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
                  }
               }
               $request[$i]['images'] = $arrImg;
            }
         }
      }


      return $request;
   }
   public function getProductoT(string $producto)
   {
      $this->con = new Mysql();
      $this->strProducto = $producto;
      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.status !=0 AND  p.nombre='{$this->strProducto}'";
      $request = $this->con->select($sql);

      if (!empty($request)) {
         $intIdProducto = $request['idproducto'];
         $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
         $arrImg = $this->con->selectAll($sqlImg);
         if (count($arrImg) > 0) {
            for ($j = 0; $j < count($arrImg); $j++) {
               $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
            }
         }
         $request['images'] = $arrImg;
      }
      return $request;
   }
   public function getProductosRandom(int $idcategoria, int $cant, string $option)
   {
      $this->con = new Mysql();
      $this->intIdCategoria = $idcategoria;
      $this->intCantidad = $cant;

      if ($option == "r") {
         $this->strOption = " RAND() ";
      } elseif ($option == "a") {
         $this->strOption = " p.idproducto ASC ";
      } else {
         $this->strOption = " p.idproducto DESC ";
      }

      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.categoriaid= $this->intIdCategoria AND p.status !=0 ORDER BY $this->strOption LIMIT $this->intCantidad";
      $request = $this->con->selectAll($sql);

      if (count($request) > 0) {

         for ($i = 0; $i < count($request); $i++) {
            $intIdProducto = $request[$i]['idproducto'];
            $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
            $arrImg = $this->con->selectAll($sqlImg);
            if (count($arrImg) > 0) {
               for ($j = 0; $j < count($arrImg); $j++) {
                  $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
               }
            }
            $request[$i]['images'] = $arrImg;
         }
      }



      return $request;
   }
}
