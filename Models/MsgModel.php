<?php
//Se crea la clase homeModel
class MsgModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }
  public function insertMsg(string $titulo, string $msg)
  {
    $return = "";
    $this->txtTitulo = $titulo;
    $this->txtMensaje = $msg;
    $sql = "SELECT * FROM `msg` WHERE  `mensaje` ='{$this->txtMensaje}' ";
    $request = $this->selectAll($sql);
    if ($this->txtMensaje == "") {
      $return = "sqlinjection";
    } else if (empty($request)) {
      $query_insert = "INSERT INTO `msg` ( `titulo`, `mensaje`) VALUES (?,?);";
      $arrData = array($this->txtTitulo, $this->txtMensaje);
      $request_insert = $this->insert($query_insert, $arrData);
      $return = $request_insert;
    } else {
      $return = "exist";
    }
    return $return;
  }
  /*  public function selectMsg()
  {
    $sql = "SELECT * FROM `msg`";
    $request = $this->selectAll($sql);
    return $request;
  } */
  public function selectMsg()
  {
    $sql = "SELECT `mensaje` FROM `msg` ORDER BY RAND() LIMIT 1";
    $request = $this->select($sql);
    return $request;
  }
}
