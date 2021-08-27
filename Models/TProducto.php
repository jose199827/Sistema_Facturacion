<?php
require_once("Libraries/Core/Mysql.php");
trait TProducto
{
   private $con;
   private $strCategoria;
   private $strProducto;
   private $strRuta;
   private $intIdCategoria;
   private $intIdProducto;
   private $intCantidad;
   private $strOption;

   public function getProductosT()
   {
      $this->con = new Mysql();
      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock, p.ruta FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.status !=0 ORDER BY p.idproducto DESC LIMIT " . CANTIDADPRODUCTOSHOME;
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
   public function getProductosPageT($desde, $porpagina)
   {
      $this->con = new Mysql();
      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria, p.precio, p.stock, p.ruta FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.status =1 ORDER BY p.idproducto DESC LIMIT $desde, $porpagina";
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
   public function getProductosCategodiaT($idcategoria, $ruta, $desde = null, $porcategoria = null)
   {
      $this->con = new Mysql();
      $this->strRuta = $ruta;
      $this->intIdCategoria = $idcategoria;
      $where = "";
      if ($desde != null && $porcategoria != null) {
         $where = " LIMIT " . $desde . ", " . $porcategoria;
      }

      $sql = "SELECT `idcategoria`,`nombre` FROM `categoria` WHERE `idcategoria`= $this->intIdCategoria;";
      $request = $this->con->select($sql);

      if (!empty($request)) {
         $this->strCategoria = $request['nombre'];
         $sql = "SELECT p.idproducto, 
         p.codigo, 
         p.nombre,
          p.descripcion,
           p.categoriaid, 
           c.nombre AS categoria,  
           p.ruta, 
           p.precio, 
           p.stock 
           FROM producto p 
           INNER JOIN categoria c ON p.categoriaid = c.idcategoria 
           WHERE 
           p.categoriaid= $this->intIdCategoria AND 
           p.status !=0 
           AND c.ruta= '{$this->strRuta}'  
           ORDER BY p.idproducto DESC " . $where;
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
         $request = array(
            'idcategoria' => $this->intIdCategoria,
            'categoria' => $this->strCategoria,
            'productos' => $request
         );
      }
      return $request;
   }
   public function getProductoT($idproducto, string $ruta)
   {
      $this->con = new Mysql();
      $this->strRuta = $ruta;
      $this->intIdProducto = $idproducto;
      $sql = "SELECT p.idproducto, 
                               p.codigo, 
                               p.nombre, 
                              p.descripcion, 
                              p.categoriaid, 
                              c.nombre AS categoria, 
                              c.ruta AS categoriaRuta, 
                              p.precio, 
                              p.ruta,
                              p.stock 
                              FROM producto p 
                              INNER JOIN categoria c 
                              ON p.categoriaid = c.idcategoria 
                              WHERE p.status !=0 AND  p.idproducto=$this->intIdProducto AND p.ruta= '{$this->strRuta}' ";
      $request = $this->con->select($sql);

      if (!empty($request)) {
         $intIdProducto = $request['idproducto'];
         $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
         $arrImg = $this->con->selectAll($sqlImg);
         if (count($arrImg) > 0) {
            for ($j = 0; $j < count($arrImg); $j++) {
               $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
            }
         } else {
            $arrImg[0]['url_img'] = media() . '/img/imgUploads/imgProductos/Producto_Default.png';
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

      $sql = "SELECT p.idproducto, p.codigo, p.nombre, p.descripcion, p.categoriaid, c.nombre AS categoria,p.ruta, p.precio, p.stock FROM producto p INNER JOIN categoria c ON p.categoriaid = c.idcategoria WHERE p.categoriaid= $this->intIdCategoria AND p.status !=0 ORDER BY $this->strOption LIMIT $this->intCantidad";
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

   public  function getProductoIdT($idproducto)
   {
      $this->con = new Mysql();
      $this->intIdProducto = $idproducto;
      $sql = "SELECT p.idproducto, 
                               p.codigo, 
                               p.nombre, 
                              p.descripcion, 
                              p.categoriaid, 
                              c.nombre AS categoria, 
                              c.ruta AS categoriaRuta, 
                              p.precio, 
                              p.ruta,
                              p.stock 
                              FROM producto p 
                              INNER JOIN categoria c 
                              ON p.categoriaid = c.idcategoria 
                              WHERE p.status !=0 AND  p.idproducto=$this->intIdProducto";
      $request = $this->con->select($sql);

      if (!empty($request)) {
         $intIdProducto = $request['idproducto'];
         $sqlImg = "SELECT productoid, img FROM `imagen` WHERE productoid=  $intIdProducto";
         $arrImg = $this->con->selectAll($sqlImg);
         if (count($arrImg) > 0) {
            for ($j = 0; $j < count($arrImg); $j++) {
               $arrImg[$j]['url_img'] = media() . '/img/imgUploads/imgProductos/' . $arrImg[$j]['img'];
            }
         } else {
            $arrImg[0]['url_img'] = media() . '/img/imgUploads/imgProductos/Producto_Default.png';
         }
         $request['images'] = $arrImg;
      }
      return $request;
   }
   public  function cantProductos($idcategoria = null)
   {
      $where = "";
      if ($idcategoria != null) {
         $where = " AND `categoriaid` = " . $idcategoria;
      }
      $this->con = new Mysql();
      $sql = "SELECT COUNT(*) AS total FROM `producto` WHERE `status` =1 " . $where;
      $result = $this->con->select($sql);
      $total = $result;
      return $total;
   }
}
