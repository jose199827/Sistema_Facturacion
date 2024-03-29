<?php
//Se crea la clase homeModel
class LoginModel extends Mysql
{
  private $intIdUsuario;
  private $strUsuario;
  private $strPassword;
  private $strToken;
  public function __construct()
  {
    parent::__construct();
  }
  public function loginUser(string $usuario, string $password)
  {
    $this->strUsuario = $usuario;
    $this->strPassword = $password;
    $sql = "SELECT `idpersona`, `status` FROM `persona` WHERE `email_user`='$this->strUsuario' AND `password` ='$this->strPassword' AND `status`!=0";
    $request = $this->select($sql);
    return $request;
  }
  public function sessionLogin(int $idUsuario)
  {
    $this->intIdUsuario = $idUsuario;
    $sql = "SELECT p.idpersona, p.indentificacion, p.nombres, p.apellidos, p.telefono, p.email_user, p.nit, p.nombrefical, p.direccionfiscal, r.idrol, r.nombrerol, p.status FROM persona p INNER JOIN rol r ON p.rolid= r.idrol WHERE p.idpersona=$this->intIdUsuario";
    $request = $this->select($sql);
    $_SESSION['userData'] = $request;
    return $request;
  }
  public function getUserEmail(string $email)
  {
    $this->strUsuario = $email;
    $sql = "SELECT `idpersona`,`nombres`,`apellidos`,`status` FROM `persona` WHERE `email_user`='$this->strUsuario' AND `status`=1";
    $request = $this->select($sql);
    return $request;
  }
  public function setTokenUser(int $idPersona, string $token)
  {
    $this->intIdUsuario = $idPersona;
    $this->strToken = $token;
    $sql = "UPDATE `persona` SET `toke`=? WHERE `idpersona`= $this->intIdUsuario";
    $arrData = array($this->strToken);
    $request = $this->update($sql, $arrData);
    return $request;
  }
  public function getUsuario(string $email, string $token)
  {
    $this->strUsuario = $email;
    $this->strToken = $token;
    $sql = "SELECT `idpersona`FROM `persona` WHERE `email_user`='$this->strUsuario' AND `toke`= '$this->strToken' AND `status`=1";
    $request = $this->select($sql);
    return $request;
  }
  public function insertPass($idUsuario, $password)
  {
    $this->intIdUsuario = $idUsuario;
    $this->strPassword = $password;
    $sql = "UPDATE `persona`SET `password`=?, `toke`=? WHERE `idpersona`= $this->intIdUsuario;";
    $arrData = array($this->strPassword, "");
    $request = $this->update($sql, $arrData);
    return $request;
  }
}
