<?php
//Se crea la clase homeModel
class homeModel extends Mysql
{
  public function __construct()
  {
    parent::__construct();
  }
  //Funcion que resive la información para registrar un usuario
  public function setUser(string $nombre, int $edad)
  {
    $query_insert = "INSERT INTO `usuario` (`nombre`, `edad`) VALUES (?, ?)";
    $arrData = array($nombre, $edad);
    $request_insert = $this->insert($query_insert, $arrData);
    return $request_insert;
  }
  //Funcion para ver un usuario
  public function getUser($id)
  {
    $sql = "SELECT * FROM `usuario` WHERE `id`=$id;";
    $request = $this->select($sql);
    return $request;
  }
  //Funcion para actualizar
  public function updateUser(int $id, string $nombre, int $edad)
  {
    $sql = "UPDATE `usuario` SET `nombre` =? ,`edad`=? WHERE `usuario`.`id` = $id;";
    $arrData = array($nombre, $edad);
    $request_update = $this->update($sql, $arrData);
    return $request_update;
  }
  //Funcion para ver todos los usuarios
  public function getUsers()
  {
    $sql = "SELECT * FROM `usuario` ;";
    $request = $this->selectAll($sql);
    return $request;
  }
  //Funcion para eliminar un usuario
  public function deleteUser(int $id)
  {
    $sql = "DELETE  FROM `usuario` WHERE `usuario`.`id` = $id;";
    $request = $this->delete($sql);
    return $request;
  }
}
