<?php
//Se crea la clase homeModel
class ContactosModel extends Mysql
{
  public function selectContactos()
  {
    $sql = "SELECT `id`,`nombre`,`email`, DATE_FORMAT(datecreated, '%d/%m/%Y') as  fecha FROM `contacto` ORDER BY id DESC;";
    $request = $this->selectAll($sql);
    return $request;
  }
  public function selectMensaje(int $idMensaje)
  {
    $sql = "SELECT `id`,`nombre`,`email`, DATE_FORMAT(datecreated, '%d/%m/%Y') as  fecha, `mensaje` FROM `contacto` WHERE `id` ={$idMensaje};";
    $request = $this->select($sql);
    return $request;
  }
}
