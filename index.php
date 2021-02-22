<?php
require_once("Config/config.php");
require_once("Helpers/Helpers.php");
//Se verifica que exista la variable en la url,
//de no existir se asignara a la pagina home
$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
//Divide la url en partes por el "/", para sacar el controlador, metodo, parametros; pasandolos a un  array
$arrUrl = explode("/", $url);
//Variable para el controlador
$controller = $arrUrl[0];
//Variable para el metodo o funcion
$method = $arrUrl[0];
//Verificando que exista el metodo en la url
if (!empty($arrUrl[1])) {
  if ($arrUrl[1] != "") {
    $method = $arrUrl[1];
  }
}
//Variable para el parametro
$param = "";
//Verificando que exista los parametros en la url
if (!empty($arrUrl[2])) {
  if ($arrUrl[2] != "") {
    //Recoriendo el array que almacena la informacion de la url en la pocision 2 ya que es la que almacena la informacion de los parametros
    for ($i = 2; $i < count($arrUrl); $i++) {
      //Concatenando en la variable param los parametros asignados, separados por coma ","
      $param .= $arrUrl[$i] . ',';
    }
    //Eliminando el ultimo caracter de los parametros
    $param = trim($param, ',');
  }
}
//Se manda a llamar al auto cargado de  Libraries/Core/Autoload.php
require_once("Libraries/Core/Autoload.php");
//Se manda a llamar a la cargado de  Libraries/Core/Load.php
require_once("Libraries/Core/Load.php");
