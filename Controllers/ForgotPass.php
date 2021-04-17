<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class ForgotPass extends Controllers
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
  public function forgotPass()
  {
    $data['page_tag'] = "Login - Tienda Virtual";
    $data['page_title'] = "Login";
    $data['page_name'] = "login";
    $data['page_funtions_js'] = "funtions_login.js";
    $this->views->getView($this, "forgotPass", $data);
  }
}
