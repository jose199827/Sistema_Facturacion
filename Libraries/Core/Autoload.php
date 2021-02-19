<?php
//Funcion para auto cargar los archivos, pasando la clase del archivo
spl_autoload_register(function ($class) {
  //Se comprueba la existencia del archivo
  if (file_exists("Libraries/" . 'Core/' . $class . ".php")) {
    //Se requiere el archivo
    require_once("Libraries/" . 'Core/' . $class . ".php");
  }
});
