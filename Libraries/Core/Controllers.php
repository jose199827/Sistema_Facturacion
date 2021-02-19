<?php
//Se crea la clase Controllers
class Controllers
{
  public function __construct()
  {
    $this->views = new Views();
    //Se manda a llamar el metodo loadModel para que cargue los archivos
    $this->loadModel();
  }
  public function loadModel()
  {
    $model = get_class($this) . "Model";
    //Ruta de los modelos
    $routClass = "Models/" . $model . ".php";
    //Se comprueba la existencia del modelo dentro del Model
    if (file_exists($routClass)) {
      //Se requiere el archivo
      require_once($routClass);
      //Se Crea una instancia de model
      $this->model = new $model();
    }
  }
}
