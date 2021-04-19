<?php
function Base_URL()
{
  return BASE_URL;
}

function media()
{
  return BASE_URL . "/Assets";
}
function vendors()
{
  return BASE_URL . "/Vendors";
}
function headerAdmin($data = "")
{
  $view_header = "Views/Templante/admin_header.php";
  require_once($view_header);
}
function footerAdmin($data = "")
{
  $view_footer = "Views/Templante/admin_footer.php";
  require_once($view_footer);
}
function footer($data = "")
{
  $view_footer = "Views/Templante/footer.php";
  require_once($view_footer);
}

//Muestra los objetos de forma formateada
function dep($data)
{
  $format = print_r("<pre>");
  $format = print_r($data);
  $format = print_r("</pre>");
  return $format;
}
function getModal(string $nombreModal, $data)
{
  $view_modal = "Views/Templante/Modals/{$nombreModal}.php";
  require_once($view_modal);
}
//Envio de Correo
function sendEmail($data, $template)
{
  $asunto = $data['asunto'];
  $emailDestino = $data['email'];
  $empresa = NOMBRE_REMITENTE;
  $remitente = EMAIL_EMPRESA;
  //ENVIO DE CORREO
  $de = "MIME-Version: 1.0\r\n";
  $de .= "Content-type: text/html; charset=UTF-8\r\n";
  $de .= "From: {$empresa} <{$remitente}>\r\n";
  ob_start();
  require_once("Views/Templante/Email/{$template}.php");
  $mensaje = ob_get_clean();
  $send = mail($emailDestino, $asunto, $mensaje, $de);
  return $send;
}
function getPermisos(int $idModulo)
{
  require_once("Models/PermisosModel.php");
  $objPermisos = new PermisosModel();
  $idrol = $_SESSION['userData']['idrol'];
  $arrPermisos = $objPermisos->permisosModulo($idrol);
  $permisos = '';
  $permisosMod = '';
  if (count($arrPermisos) > 0) {
    $permisos = $arrPermisos;
    $permisosMod =  isset($arrPermisos[$idModulo]) ? $arrPermisos[$idModulo] : "";
  }
  $_SESSION['permisos'] = $permisos;
  $_SESSION['permisosMod'] = $permisosMod;
}
//Elimina el exceso de espacios entre palabras
function strClean($strCadena)
{
  $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena); //Deja un solo espacio entre palabras
  $string = trim($string); //Elimina espacios en blanco al inicio y al final
  $string = stripslashes($string); // Elimina las \ invertidas
  $string = str_ireplace("<script>", "", $string);
  $string = str_ireplace("</script>", "", $string);
  $string = str_ireplace("<script src>", "", $string);
  $string = str_ireplace("<script type=>", "", $string);
  $string = str_ireplace("SELECT * FROM", "", $string);
  $string = str_ireplace("DELETE FROM", "", $string);
  $string = str_ireplace("INSERT INTO", "", $string);
  $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
  $string = str_ireplace("DROP TABLE", "", $string);
  $string = str_ireplace("OR '1'='1", "", $string);
  $string = str_ireplace('OR "1"="1"', "", $string);
  $string = str_ireplace('OR ´1´=´1´', "", $string);
  $string = str_ireplace("is NULL; --", "", $string);
  $string = str_ireplace("is NULL; --", "", $string);
  $string = str_ireplace("LIKE '", "", $string);
  $string = str_ireplace('LIKE "', "", $string);
  $string = str_ireplace("LIKE ´", "", $string);
  $string = str_ireplace("OR 'a'='a", "", $string);
  $string = str_ireplace('OR "a"="a', "", $string);
  $string = str_ireplace("OR ´a´=´a", "", $string);
  $string = str_ireplace("OR ´a´=´a", "", $string);
  $string = str_ireplace("--", "", $string);
  $string = str_ireplace("^", "", $string);
  $string = str_ireplace("[", "", $string);
  $string = str_ireplace("]", "", $string);
  $string = str_ireplace("==", "", $string);
  return $string;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
  $pass = "";
  $longitudPass = $length;
  $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
  $longitudCadena = strlen($cadena);

  for ($i = 1; $i <= $longitudPass; $i++) {
    $pos = rand(0, $longitudCadena - 1);
    $pass .= substr($cadena, $pos, 1);
  }
  return $pass;
}
//Genera un token
function token()
{
  $r1 = bin2hex(random_bytes(10));
  $r2 = bin2hex(random_bytes(10));
  $r3 = bin2hex(random_bytes(10));
  $r4 = bin2hex(random_bytes(10));
  $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
  return $token;
}
//Formato para valores monetarios
function formatMoney($cantidad)
{
  $cantidad = number_format($cantidad, 2, SPD, SPM);
  return $cantidad;
}
function sessionUser($idpersona)
{
  require_once("Models/LoginModel.php");
  $objLogin = new LoginModel();
  $request = $objLogin->sessionLogin($idpersona);
  return $request;
}
