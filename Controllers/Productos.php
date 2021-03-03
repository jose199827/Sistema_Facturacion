<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Productos extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
  }
  //Se crea el método Home
  public function productos()
  {
    $data['page_tag'] = "Productos";
    $data['page_title'] = "Pagina Productos";
    $data['page_name'] = "productos";
    $data['page_id'] = 2;
    $data['page_content'] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam explicabo neque ullam recusandae eum odit, animi facere repellendus laboriosam, dolorum fuga quod harum, dicta asperiores? Nostrum ullam veniam cum quae.";
    $this->views->getView($this, "productos", $data);
  }
}
