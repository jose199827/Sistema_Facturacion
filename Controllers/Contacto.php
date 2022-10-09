<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Contacto extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    session_start();
  }
  //Se crea el método Nosotros
  public function contacto()
  {
    $data['page_tag'] = NOMBRE_EMPRESA;
    $data['page_title'] = NOMBRE_EMPRESA;
    $data['page_name'] = "contacto";
    /* $data['page_funtions_js'] = "funtions_login.js"; */
    $this->views->getView($this, "contacto", $data);
  }
}
