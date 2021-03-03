<?php
//Load
$controller = ucwords($controller);
$controllerFile = "Controllers/" . $controller . ".php";
//Se comprueba la existencia del controlador 
if (file_exists($controllerFile)) {
  //Se requiere el archivo
  require_once($controllerFile);
  //Se crea una instancia para el controlador
  $controller = new $controller();
  //Se comprueba la existencia del método dentro del controlador
  if (method_exists($controller, $method)) {
    $controller->{$method}($param);
  } else {
    require_once("Controllers/Errors.php");
  }
} else {
  require_once("Controllers/Errors.php");
}
