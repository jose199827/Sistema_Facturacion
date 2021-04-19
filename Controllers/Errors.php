<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Errors extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
    /*     session_start();
    if (empty($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/login');
    } */
  }
  //Se crea el método Home
  public function notFound()
  {
    $data['page_tag'] = "Error - Tienda Virtual";
    $data['page_title'] = "Error";
    $data['page_name'] = "error";
    $data['page_id'] = 2;
    /* $data['page_funtions_js'] = "funtions_login.js"; */
    $this->views->getView($this, "error", $data);
  }
}
$notFound = new Errors();
$notFound->notFound();
