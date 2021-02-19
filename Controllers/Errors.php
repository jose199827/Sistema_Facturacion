<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Errors extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
  }
  //Se crea el método Home
  public function notFound()
  {
    $this->views->getView($this, "error");
  }
}
$notFound = new Errors();
$notFound->notFound();
