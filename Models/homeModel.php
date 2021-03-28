<?php
//Se crea la clase homeModel
class HomeModel extends Mysql
{
  public $idMsg;
  public $txtTitulo;
  public $txtMensaje;
  public function __construct()
  {
    parent::__construct();
  }
}
