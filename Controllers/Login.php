<?php
//Se crea la clase Home y se hace una herencia hacia la clase de controllers de la carpeta Librares/Core
class Login extends Controllers
{
  public function __construct()
  { //Se manda a llamar el constructor de la clase heredada de controllers de la carpeta Librares/Core


    parent::__construct();
    session_start();
    if (isset($_SESSION['login'])) {
      header('location: ' . Base_URL() . '/dashboard');
    }
  }
  //Se crea el método Home
  public function login()
  {
    $data['page_tag'] = "Login - Tienda Virtual";
    $data['page_title'] = "Login";
    $data['page_name'] = "login";
    $data['page_funtions_js'] = "funtions_login.js";
    $this->views->getView($this, "login", $data);
  }
  public function loginUser()
  {
    /* dep($_POST); */
    if ($_POST) {
      if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
        $arrResponse = array('status' => false, 'msg' => 'Error de Datos.');
      } else {
        $strUsuario = strtolower(strClean($_POST['txtEmail']));
        $strPassword = hash("SHA256", ($_POST['txtPassword']));
        $requestUser = $this->model->loginUser($strUsuario, $strPassword);
        if (empty($requestUser)) {
          $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecta.');
        } else {
          $arrData = $requestUser;
          if ($arrData['status'] == 1) {
            $_SESSION['idUser'] = $arrData['idpersona'];
            $_SESSION['login'] = true;
            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
            $_SESSION['userData'] = $arrData;
            $arrResponse = array('status' => true, 'msg' => 'ok.');
          } else {
            $arrResponse = array('status' => false, 'msg' => 'El usuario esta inactivo.');
          }
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function resetPass()
  {
    if ($_POST) {
      /* error_reporting(0); */
      if (empty($_POST['txtEmailReset'])) {
        $arrResponse = array('status' => false, 'msg' => 'Error de Datos.');
      } else {
        $token = token();
        $strEmail = strtolower(strClean($_POST['txtEmailReset']));
        $arrData = $this->model->getUserEmail($strEmail);
        if (empty($arrData)) {
          $arrResponse = array('status' => false, 'msg' => 'Usuario no existente.');
        } else {
          $idPersona = $arrData['idpersona'];
          $nombreUsuario = $arrData['nombres'] . ' ' . $arrData['apellidos'];
          $url_recovery = Base_URL() . '/Login/confirmUser/' . $strEmail . '/' . $token;
          $requestUpdate = $this->model->setTokenUser($idPersona, $token);

          $dataUsuario = array(
            'nombreUsuario' => $nombreUsuario,
            'email' => $strEmail,
            'asunto' => 'Recuperar cuenta - ' . NOMBRE_REMITENTE,
            'url_recovery' => $url_recovery
          );
          if ($requestUpdate) {
            $sendEmail = sendEmail($dataUsuario, 'email_cambioPassword');
            if ($sendEmail) {
              $arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
            } else {
              $arrResponse = array('status' => false, 'msg' => 'No se ha podido realizar el proceso, intenta más tarde.');
            }
          } else {
            $arrResponse = array('status' => false, 'msg' => 'No se ha podido realizar el proceso, intenta más tarde.');
          }
        }
      }
      echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
  }
  public function confirmUser(string $params)
  {
    if (empty($params)) {
      header('Location: ' . Base_URL());
    } else {
      $arrParams = explode(',', $params);
      $strEmail = strClean($arrParams[0]);
      $strToken = strClean($arrParams[1]);
      $arraResponse = $this->model->getUsuario($strEmail, $strToken);
      if (empty($arraResponse)) {
        header('Location: ' . Base_URL());
      } else {
        $data['page_tag'] = "Cambiar Contraseña";
        $data['page_title'] = "Login";
        $data['page_name'] = "login";
        $data['idpersona'] = $arraResponse['idpersona'];
        $data['email'] = $strEmail;
        $data['token'] = $strToken;
        $data['page_funtions_js'] = "funtions_login.js";
        $this->views->getView($this, "cambiarPass", $data);
      }
    }
    die();
  }
  public function setPass()
  {
    if (empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']) || empty($_POST['txtEmail']) || empty($_POST['txtToken'])) {
      $arrResponse = array('status' => false, 'msg' => 'Error de Datos.');
    } else {
      $intIdPersona = intval($_POST['idUsuario']);
      $strPassword = $_POST['txtPassword'];
      $strPasswordConfirm = $_POST['txtPasswordConfirm'];
      $strEmail = strtolower(strClean($_POST['txtEmail']));
      $strToken = strClean($_POST['txtToken']);
      if ($strPassword != $strPasswordConfirm) {
        $arrResponse = array('status' => false, 'msg' => 'Las contraseñas no son iguales.');
      } else {
        $arraResponseUser = $this->model->getUsuario($strEmail, $strToken);
        if (empty($arraResponseUser)) {
          $arrResponse = array('status' => false, 'msg' => 'Error de Datos.');
        } else {
          $strPass = hash("SHA256", $strPassword);
          $requestPass = $this->model->insertPass($intIdPersona, $strPass);

          if ($requestPass) {
            $arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con éxito.');
          } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
          }
        }
      }
    }
    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    die();
  }
}
