<?php
const BASE_URL = "http://localhost/Sistema_Fact";
//Conexion a la base de datos
const DB_HOST = "localhost";
const DB_NAME = "db_tiendavirtual";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_CHARSET = "utf8";
// Variables para las conversion de modeda
const SPD = ".";
const SPM = ",";
const SMONEY = "$";
const CURRENCY = "USD";

//Modulos
const MPEDIDOS = 5;
const MCLIENTES = 3;
const MSUSCIPTORES = 8;
const MCONTACTO = 9;
const MPAGINAS = 10;

//Roles
const RADMINISTRADOR = 1;
const RCLIENTES = 2;

const NOMBRE_REMITENTE = "Tienda Virtual";
const NOMBRE_EMPRESA = "Tienda Virtual";
const WEB_EMPRESA = BASE_URL;
const EMAIL_EMPRESA = "josedesarrollop@gmail.com";
const DESCRIPCION = "La mejora tienda de articulos de venta";
const HASHTAGS = "TiendaVirtual";

// Variables para las conversion de modeda
const DIRECCION = "Honduras, Tegucigalpa";
const TELEFONO = "(504) 9874-8587";
const EMAIL_PEDIDO = "josedesarrollop@gmail.com";
const EMAIL_SUSCRIPCION = "josedesarrollop@gmail.com";
const FACEBOOK = "https://facebook.com/abelosh";
const INSTAGRAM = "https://instagram.com/febel24";

//Variable para la Zona horaria 
date_default_timezone_set("America/Tegucigalpa");
const CAT_SLIDER = "1,2,3";
const CAT_BANNER = "1,4,5";
const CAT_FOOTER = "3,1,8,7";

const KEY = "desarrollo";
const METHODENCRIPT = "AES-128-ECB";
const COSTOENVIO = 10;
const STATUS = array('Completo', 'Aprobado', 'Cancelado', 'Reembolsado', 'Pendiente', 'Entregado');
//Pruebas
const URLPAYPAL = "https://api-m.sandbox.paypal.com";
const PAYPALCLIENTE = "AR5-kYH92_DsmJAk1AbL5B3pFBbF_Hjc0B4sgO_tpBb1S43raFzt0vWkvYAIqHplGuIVHrNEjHK4Ft9k";
const SECRET = "EJ2z5_ySYqZ74RxsVUQQh6tQSgaYjAyKHFQyojpdhbxNifhxq8WhGdamWdZsnYB1KkqOsRMIXBg0O4VI";
/*Live
const URLPAYPAL = "https://api-m.paypal.com";
 const PAYPALCLIENTE = "AeqrzT3b0HMQJqxLGZrhwTOgEJ2nRHo1UkFHjwqpoP6ZwAKdm1uIT2GPLTfgUY9Io_WNQw4EPKJu1nl3"; 
 const SECRET = "EOk9bc8eMEQEyrkIQrDI4b8Pnaav24boiHLdye5na8VoAJxuEM_7u5SBwBNNBSt7NCjsEn-IiDpzZFbz";*/

//Productos

const CANTIDADPRODUCTOSHOME = 8;
const PORPAGINA = 8;
const PORCATEGORIA = 4;
const PORBUSQUEDA = 4;
