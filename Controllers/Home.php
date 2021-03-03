<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Home extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core
    parent::__construct();
  }
  //Se crea el método Home
  public function home()
  {
    $data['page_tag'] = "Home";
    $data['page_title'] = "Pagina Principal";
    $data['page_name'] = "home";
    $data['page_id'] = 1;
    $data['page_content'] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam explicabo neque ullam recusandae eum odit, animi facere repellendus laboriosam, dolorum fuga quod harum, dicta asperiores? Nostrum ullam veniam cum quae.";
    $this->views->getView($this, "home", $data);
  }
  //Insertando un registro
  public function insertar()
  {
    $data = $this->model->setUser("Carlos", 23);
    print_r($data);
  }
  //Ver registro
  public function verusuario($id)
  {
    $data = $this->model->getUser($id);
    print_r($data);
  }
  //Actualizando un registro
  public function actualizar()
  {
    $data = $this->model->updateUser(1, "Jose Pineda", 22);
    print_r($data);
  }
  //Ver todos los registros
  public function verusuarios()
  {
    $data = $this->model->getUsers();
    print_r($data);
  }
  //Ver todos los registros
  public function elimimarusuario($id)
  {
    $data = $this->model->deleteUser($id);
    print_r($data);
  }
}
