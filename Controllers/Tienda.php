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
         $categoria = strClean($params);
         $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $categoria;
         $data['page_title'] = $categoria;
         $data['page_name'] = "categoría";
         $data['productos'] = $this->getProductosCategodiaT($categoria);
         $this->views->getView($this, "categoria", $data);
      }
   }
   public function Producto($params)
   {
      if (empty($params)) {
         header('Location: ' . Base_URL());
      } else {
         $producto = strClean($params);
         $arrProducto = $this->getProductoT($params);
         $data['page_tag'] =  NOMBRE_EMPRESA . " - " . $producto;
         $data['page_title'] = $producto;
         $data['page_name'] = "producto";
         $data['producto'] = $arrProducto;
         $data['productos'] = $this->getProductosRandom($arrProducto['categoriaid'], 8, "r");
         $this->views->getView($this, "producto", $data);
      }
   }
}
