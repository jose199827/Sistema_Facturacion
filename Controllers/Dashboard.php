<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Dashboard extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
  }
  //Se crea el método Home
  public function dashboard()
  {
    $data['page_tag'] = "Dashboard - Tienda Virtual";
    $data['page_title'] = "Dashboard";
    $data['page_name'] = "dashboard";
    $data['page_id'] = 2;
    $this->views->getView($this, "dashboard", $data);
  }
}
