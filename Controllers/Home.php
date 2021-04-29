<?php
require_once("Models/TCategoria.php");
require_once("Models/TProducto.php");
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Home extends Controllers
{
  use TCategoria, TProducto;
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
  }
  //Se crea el método Home
  public function home()
  {
    $data['page_tag'] = NOMBRE_EMPRESA;
    $data['page_title'] = NOMBRE_EMPRESA;
    $data['page_name'] = "home";
    $data['slider'] = $this->getCategoriasT(CAT_SLIDER);
    $data['banner'] = $this->getCategoriasT(CAT_BANNER);
    $data['productos'] = $this->getProductosT();
    /* $data['page_funtions_js'] = "funtions_login.js"; */
    $this->views->getView($this, "home", $data);
  }
}
