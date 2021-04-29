<?php
/* require_once("CategoriasModel.php"); */
//Se crea la clase homeModel
class HomeModel extends Mysql
{
  public $idMsg;
  public $txtTitulo;
  public $txtMensaje;
  /*   private $objCategoria; */
  public function __construct()
  {
    parent::__construct();
    /*     $this->objCategoria = new CategoriasModel(); */
  }
  public function getCategorias()
  {
    /*     return $this->objCategoria->selectCategorias(); */
  }
}
