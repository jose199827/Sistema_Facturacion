<?php
require_once("Models/TCategoria.php");
require_once("Models/TProducto.php");
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Tienda extends Controllers
{
   use TCategoria, TProducto;
   public function __construct()
   { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
      parent::__construct();
   }
   //Se crea el método Home
   public function tienda()
   {
      $data['page_tag'] = NOMBRE_EMPRESA;
      $data['page_title'] = NOMBRE_EMPRESA;
      $data['page_name'] = "tienda";
      $data['productos'] = $this->getProductosT();
      /* $data['page_funtions_js'] = "funtions_login.js"; */
      $this->views->getView($this, "tienda", $data);
   }
   public function Categoria($params)
   {
      if (empty($params)) {
         header('Location: ' . Base_URL());
      } else {
         $arrParras = explode(",", $params);
         $idcategoria = intval($arrParras[0]);
         $ruta = strClean($arrParras[1]);
         $infoCategoria = $this->getProductosCategodiaT($idcategoria, $ruta);
         $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $infoCategoria['categoria'];
         $data['page_title'] = $infoCategoria['categoria'];
         $data['page_name'] = "categoría";
         $data['productos'] = $infoCategoria['productos'];
         $this->views->getView($this, "categoria", $data);
      }
   }
   public function Producto($params)
   {
      if (empty($params)) {
         header('Location: ' . Base_URL());
      } else {
         $arrParras = explode(",", $params);
         $idproducto = intval($arrParras[0]);
         $ruta = strClean($arrParras[1]);
         $infoProducto = $this->getProductoT($idproducto, $ruta);
         if (empty($infoProducto)) {
            header('Location: ' . Base_URL() . '/Tienda');
         }
         $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $infoProducto['nombre'];
         $data['page_title'] = $infoProducto['nombre'];
         $data['page_name'] = "producto";
         $data['producto'] = $infoProducto;
         $data['productos'] = $this->getProductosRandom($infoProducto['categoriaid'], 8, "r");
         $this->views->getView($this, "producto", $data);
      }
   }
}
