/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.21-MariaDB : Database - db_tiendavirtual
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tiendavirtual` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_tiendavirtual`;

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `categoria` */

LOCK TABLES `categoria` WRITE;

insert  into `categoria`(`idcategoria`,`nombre`,`descripcion`,`portada`,`datecreated`,`ruta`,`status`) values 
(1,'Tennis','Zapatos Deportivos','img_categoria_2be183d6a0fd010c1c90225122e22622.jpg','2021-04-21 14:16:41','tennis',1),
(2,'Autos','Autos de Lujo','img_categoria_dc10f66f9331f5f78c7c1041741c9a4e.jpg','2021-04-21 14:18:38','autos',1),
(3,'Pantalones','Pantalones Mixtos','img_categoria_03babe8c99f81259015f9078f24d7d25.jpg','2021-04-21 14:19:53','pantalones',1),
(4,'Camisas','Camisas Parejas','img_categoria_a484df79a2df84e1b26443fdc0881833.jpg','2021-04-21 14:21:21','camisas',1),
(5,'Maquillaje','Maquillaje Mixto','img_categoria_24025ce3d84fe2b98845753e6c0f2808.jpg','2021-04-21 14:23:52','maquillaje',1),
(6,'Botas','Botas','img_categoria_e1c3693cafbfed5b6bb40e43151e0637.jpg','2021-04-21 14:25:44','botas',1),
(7,'Sudaderas','Sudaderas Adidas','img_categoria_4fd96bcbe24cf94174a9e4e68641d0ed.jpg','2021-04-21 14:50:34','sudaderas',1),
(8,'Bolsos','Bolsos de Lujo','img_categoria_82a33c4ab875da9370141495fbed5ead.jpg','2021-04-21 14:53:04','bolsos',1),
(9,'Aviones','Aviones','img_categoria_e14d211af0cf732ddb0835cd1886a292.jpg','2021-04-21 14:55:28','aviones',1),
(10,'Categoría con la ruta','Comprobando el Funcionamiento','portada_categoria.png','2021-04-28 23:17:44','categoria-con-la-ruta',1),
(11,'Categoría con la ruta dos','Comprobando el Funcionamiento','portada_categoria.png','2021-04-28 23:18:06','categoria-con-la-ruta-dos',1),
(12,'comoas dasre','dasdas','portada_categoria.png','2021-04-28 23:21:53','comoas-dasre',1),
(13,'qwewqev fsdf','eqweqwewqe','portada_categoria.png','2021-04-28 23:23:16','qwewqev-fsdf',2),
(14,'Juguetes','Descripcio de los Juguetes','portada_categoria.png','2022-08-10 23:21:06','juguetes',1);

UNLOCK TABLES;

/*Table structure for table `detalle_pedido` */

DROP TABLE IF EXISTS `detalle_pedido`;

CREATE TABLE `detalle_pedido` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedidoid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoid` (`pedidoid`),
  KEY `productoid` (`productoid`),
  CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `detalle_pedido` */

LOCK TABLES `detalle_pedido` WRITE;

insert  into `detalle_pedido`(`id`,`pedidoid`,`productoid`,`precio`,`cantidad`) values 
(1,2,23,33.00,1),
(2,2,1,8513.00,1),
(3,2,5,4234.00,2),
(4,3,22,6555.00,1),
(5,4,22,6555.00,1),
(6,5,5,4234.00,1),
(7,6,7,4234.00,3),
(8,6,2,4322.00,1),
(9,6,1,8513.00,1),
(10,7,4,3299.00,1),
(11,8,23,33.00,1),
(12,9,23,33.00,3),
(13,9,7,4234.00,2),
(14,10,1,8513.00,1),
(15,11,10,34.00,1),
(16,11,2,4322.00,1),
(17,12,10,34.00,1),
(18,12,2,4322.00,1),
(19,13,10,34.00,1),
(20,13,2,4322.00,1),
(21,14,1,8513.00,2),
(22,15,22,6555.00,1),
(23,16,23,33.00,1),
(24,17,6,42.00,1),
(25,18,23,33.00,1),
(26,19,6,42.00,2),
(27,19,1,8513.00,1),
(28,20,23,33.00,1),
(29,21,23,33.00,1),
(30,22,22,6555.00,1),
(31,23,2,4322.00,1),
(32,24,21,97.00,2);

UNLOCK TABLES;

/*Table structure for table `detalle_temp` */

DROP TABLE IF EXISTS `detalle_temp`;

CREATE TABLE `detalle_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `personaid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `transaccionid` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`),
  KEY `personaid` (`personaid`),
  CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `detalle_temp` */

LOCK TABLES `detalle_temp` WRITE;

UNLOCK TABLES;

/*Table structure for table `imagen` */

DROP TABLE IF EXISTS `imagen`;

CREATE TABLE `imagen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`),
  CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

/*Data for the table `imagen` */

LOCK TABLES `imagen` WRITE;

insert  into `imagen`(`id`,`productoid`,`img`) values 
(11,9,'img_producto_3c56099d848d3a70fd78f35cee0a07e6.jpg'),
(12,22,'img_producto_4313c448cb934abf821919abacbfeca1.jpg'),
(13,21,'img_producto_6a400350a72e550b1ad835f1ea52a14e.jpg'),
(15,10,'img_producto_7b03817907970de8de94f02951338114.jpg'),
(16,10,'img_producto_a0ecc95ab62723e5efcb0056edb62bc2.jpg'),
(17,10,'img_producto_8b7d6015367b1a1c1b6767a1e78f2e53.jpg'),
(20,23,'img_producto_afafaf41fb7c6f73cb57843189711673.jpg'),
(21,1,'img_producto_a492c238098bc2d326781d4e81f8a347.jpg'),
(22,1,'img_producto_79268d4ead91a97020b1b3fa69514660.jpg'),
(23,1,'img_producto_b79d8c1c17e7066cdcdd37ae33615a0c.jpg'),
(24,1,'img_producto_514ef7a36f9249ceff189a12ba5a0294.jpg'),
(25,2,'img_producto_5eda7d7faa0d7f51b896259fc6df1f4f.jpg'),
(28,2,'img_producto_28b8715ed2ddfacea163bd6690141241.jpg'),
(32,4,'img_producto_467ac7d15b5d20f54ae3bc5c7573f789.jpg'),
(33,4,'img_producto_8b1b47155908d1d000d3269961893266.jpg'),
(34,4,'img_producto_9609d6fd3e764b021efd16b752185742.jpg'),
(36,4,'img_producto_52b3856d5eb2eeb37758481884ad7b77.jpg'),
(37,5,'img_producto_d247e3f4a11a3420a8cc4a2a1d6bba92.jpg'),
(38,5,'img_producto_07a39301e645a3f97de9dae9d917a05f.jpg'),
(39,5,'img_producto_6f5a159333f00dc1fef269e3290caed7.jpg'),
(40,5,'img_producto_cd4df843aa7f299354babf5f5f89a31f.jpg'),
(41,5,'img_producto_bf04ec7c55c135a24a77284dcbb06b40.jpg'),
(42,6,'img_producto_43c90bafb832fe7b986ec19b66821d7e.jpg'),
(43,6,'img_producto_3ca4de91b320ac8f012d3a56229b4b60.jpg'),
(44,6,'img_producto_7d8549c9e25a8b0a2bc615ca2ea7c078.jpg'),
(45,6,'img_producto_ed686a23d16d63dafe9ddcc1c3dbdf1b.jpg'),
(46,6,'img_producto_d8ed855204e927ffe92dfe01f6174275.jpg'),
(47,7,'img_producto_d2c69cca13f7ff32ad7555857c699df0.jpg'),
(48,7,'img_producto_85dbbc4424573bd06665ad3f2fc7d269.jpg'),
(49,7,'img_producto_2972385cf52dc6d351e5dff33e6177ec.jpg'),
(50,7,'img_producto_74ea064030a2e584d7744d169e74aa91.jpg'),
(51,8,'img_producto_1b41ecd6ac785d2182b57aa29e46f695.jpg'),
(52,8,'img_producto_0766f79cbbf5d0e5f5fc50e01785f157.jpg'),
(53,8,'img_producto_c299a129488041ccd972c6fa0bc39bbb.jpg'),
(54,8,'img_producto_4b5f8a741b009083c6094c8bf8686822.jpg'),
(55,3,'img_producto_ec858c1e522e6b6488117e1f970017c6.jpg'),
(56,3,'img_producto_db978dec24eb4f5c1aa9f8a619d1d407.jpg');

UNLOCK TABLES;

/*Table structure for table `modulo` */

DROP TABLE IF EXISTS `modulo`;

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `modulo` */

LOCK TABLES `modulo` WRITE;

insert  into `modulo`(`idmodulo`,`titulo`,`descripcion`,`status`) values 
(1,'Dashboard','Dashboard del sistema',1),
(2,'Usuarios','Modulo de los usuarios del sistema',1),
(3,'Clientes ','Modulo de los clientes del sistema',1),
(4,'Producto ','Modulo de los producto del sistema',1),
(5,'Pedidos','Modulo de los pedidos del sistema',1),
(6,'Categorías','Categorías de los productos',1),
(7,'Rol','Roles que tienen los usuarios en el sistema',1),
(8,'Suscriptores','Suscriptores del sitio web.',1);

UNLOCK TABLES;

/*Table structure for table `msg` */

DROP TABLE IF EXISTS `msg`;

CREATE TABLE `msg` (
  `idMsg` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL DEFAULT 'Mensaje de Bienvenida',
  `mensaje` text NOT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `msg` */

LOCK TABLES `msg` WRITE;

insert  into `msg`(`idMsg`,`titulo`,`mensaje`) values 
(23,'Mensaje de Bienvenida','Elige un trabajo que te guste y no tendrás que trabajar ni un día de tu vida.'),
(34,'Mensaje de Bienvenida','Reza como si todo dependiera de Dios. Trabaja como si todo dependiera de ti.'),
(35,'Mensaje de Bienvenida','Nunca te das cuenta de lo que has hecho; sólo puedes ver lo que queda por hacer.'),
(36,'Mensaje de Bienvenida','El trabajo endulza siempre la vida, pero los dulces no le gustan a todo el mundo.'),
(37,'Mensaje de Bienvenida','Sólo los necios se encuentran satisfechos y confiados con la calidad de su trabajo.');

UNLOCK TABLES;

/*Table structure for table `pedido` */

DROP TABLE IF EXISTS `pedido`;

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `referenciacobro` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `idtransaccionpaypal` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datospaypal` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `personaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `costo_envio` decimal(10,0) NOT NULL DEFAULT 0,
  `monto` decimal(11,2) NOT NULL,
  `tipopagoid` bigint(20) NOT NULL,
  `Direccion_envio` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `personaid` (`personaid`),
  KEY `tipopagoid` (`tipopagoid`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`tipopagoid`) REFERENCES `tipopago` (`idtipopago`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `pedido` */

LOCK TABLES `pedido` WRITE;

insert  into `pedido`(`idpedido`,`referenciacobro`,`idtransaccionpaypal`,`datospaypal`,`personaid`,`fecha`,`costo_envio`,`monto`,`tipopagoid`,`Direccion_envio`,`status`) values 
(2,NULL,'9G846742KW642053P','{\"create_time\":\"2021-05-04T05:22:58Z\",\"update_time\":\"2021-05-04T05:23:50Z\",\"id\":\"7PF510627C7151321\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $17164\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"17164.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"9G846742KW642053P\",\"final_capture\":true,\"create_time\":\"2021-05-04T05:23:50Z\",\"update_time\":\"2021-05-04T05:23:50Z\",\"amount\":{\"value\":\"17164.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/9G846742KW642053P\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/9G846742KW642053P/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7PF510627C7151321\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7PF510627C7151321\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',5,'2021-05-03 23:23:59',0,17.00,1,'rewr, sdf','Reembolsado'),
(3,NULL,NULL,NULL,5,'2021-05-04 15:42:55',0,6.00,3,'dsa, asd','Pendiente'),
(4,NULL,NULL,NULL,5,'2021-05-04 15:47:42',0,6.00,2,'fd, df','Pendiente'),
(5,NULL,NULL,NULL,5,'2021-05-04 15:49:12',0,4384.00,2,'fsd, sdf','Pendiente'),
(6,NULL,NULL,NULL,5,'2021-05-04 15:50:43',0,25687.00,2,'tyu, tyu','Pendiente'),
(7,NULL,'79F14285GB2482811','{\"create_time\":\"2021-05-04T21:54:22Z\",\"update_time\":\"2021-05-04T21:54:45Z\",\"id\":\"2FE42540M9562212W\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $3449\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"3449.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"79F14285GB2482811\",\"final_capture\":true,\"create_time\":\"2021-05-04T21:54:45Z\",\"update_time\":\"2021-05-04T21:54:45Z\",\"amount\":{\"value\":\"3449.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/79F14285GB2482811\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/79F14285GB2482811/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2FE42540M9562212W\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2FE42540M9562212W\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',5,'2021-05-04 15:54:46',0,3449.00,1,'ewr, rwer','Aprobado'),
(8,NULL,'84T04711S0347702E','{\"create_time\":\"2021-05-05T20:58:29Z\",\"update_time\":\"2021-05-05T20:58:58Z\",\"id\":\"12N07735XE084701J\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $183\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"183.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"84T04711S0347702E\",\"final_capture\":true,\"create_time\":\"2021-05-05T20:58:58Z\",\"update_time\":\"2021-05-05T20:58:58Z\",\"amount\":{\"value\":\"183.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/84T04711S0347702E\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/84T04711S0347702E/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/12N07735XE084701J\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/12N07735XE084701J\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',5,'2021-05-05 14:59:00',150,183.00,1,'das, dsa','Aprobado'),
(9,NULL,NULL,NULL,5,'2021-05-05 15:04:08',150,8717.00,3,'tyuy, ytut','Pendiente'),
(10,NULL,NULL,NULL,5,'2021-05-05 15:59:11',150,8663.00,2,'yrtyry, tryt','Pendiente'),
(11,NULL,NULL,NULL,7,'2021-05-06 00:08:40',10,4366.00,2,'Honduras, Tegucigalpa','Pendiente'),
(12,NULL,'6W228646VX561410B','{\"create_time\":\"2021-05-06T06:10:41Z\",\"update_time\":\"2021-05-06T06:11:17Z\",\"id\":\"8DE14365ST890671M\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $4366\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"4366.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"6W228646VX561410B\",\"final_capture\":true,\"create_time\":\"2021-05-06T06:11:17Z\",\"update_time\":\"2021-05-06T06:11:17Z\",\"amount\":{\"value\":\"4366.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/6W228646VX561410B\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/6W228646VX561410B/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8DE14365ST890671M\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8DE14365ST890671M\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',7,'2021-05-06 00:11:18',10,4366.00,1,'r, re','Aprobado'),
(13,NULL,NULL,NULL,7,'2021-05-06 00:12:43',10,4366.00,2,'r, re','Pendiente'),
(14,NULL,'8S215182BF8141648','{\"create_time\":\"2021-05-06T06:17:29Z\",\"update_time\":\"2021-05-06T06:17:53Z\",\"id\":\"5J7696903R2664530\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $17036\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"17036.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"8S215182BF8141648\",\"final_capture\":true,\"create_time\":\"2021-05-06T06:17:53Z\",\"update_time\":\"2021-05-06T06:17:53Z\",\"amount\":{\"value\":\"17036.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8S215182BF8141648\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8S215182BF8141648/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/5J7696903R2664530\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/5J7696903R2664530\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',7,'2021-05-06 00:17:54',10,17036.00,1,'ytyyt, yyyy','Aprobado'),
(15,NULL,'8W0339798W147511A','{\"create_time\":\"2021-05-06T06:24:28Z\",\"update_time\":\"2021-05-06T06:25:15Z\",\"id\":\"8LC55718BC089263L\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $6565\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"6565.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"8W0339798W147511A\",\"final_capture\":true,\"create_time\":\"2021-05-06T06:25:15Z\",\"update_time\":\"2021-05-06T06:25:15Z\",\"amount\":{\"value\":\"6565.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8W0339798W147511A\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8W0339798W147511A/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8LC55718BC089263L\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8LC55718BC089263L\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',7,'2021-05-06 00:25:16',10,6565.00,1,'re, re','Aprobado'),
(16,NULL,'26F42066G3084240L','{\"create_time\":\"2021-05-06T06:27:27Z\",\"update_time\":\"2021-05-06T06:27:53Z\",\"id\":\"2BM746130J330233E\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $43\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"26F42066G3084240L\",\"final_capture\":true,\"create_time\":\"2021-05-06T06:27:53Z\",\"update_time\":\"2021-05-06T06:27:53Z\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/26F42066G3084240L\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/26F42066G3084240L/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2BM746130J330233E\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2BM746130J330233E\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',7,'2021-05-06 00:27:54',10,43.00,1,'uy, uy','Completo'),
(17,NULL,'2UW27864V1789874P','{\"create_time\":\"2021-05-06T06:31:18Z\",\"update_time\":\"2021-05-06T06:31:42Z\",\"id\":\"38D17413F10501114\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $52\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"52.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"2UW27864V1789874P\",\"final_capture\":true,\"create_time\":\"2021-05-06T06:31:42Z\",\"update_time\":\"2021-05-06T06:31:42Z\",\"amount\":{\"value\":\"52.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/2UW27864V1789874P\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/2UW27864V1789874P/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/38D17413F10501114\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/38D17413F10501114\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',7,'2021-05-06 00:31:43',10,52.00,1,'uy, ytu','Completo'),
(18,NULL,'91E075079T722911M','{\"create_time\":\"2021-05-08T20:12:05Z\",\"update_time\":\"2021-05-08T20:12:33Z\",\"id\":\"46A94333N6120053F\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $43\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"91E075079T722911M\",\"final_capture\":true,\"create_time\":\"2021-05-08T20:12:33Z\",\"update_time\":\"2021-05-08T20:12:33Z\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/91E075079T722911M\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/91E075079T722911M/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/46A94333N6120053F\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/46A94333N6120053F\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',5,'2021-05-08 14:12:35',10,43.00,1,'ds, sdv','Completo'),
(19,NULL,'4LW67286TW528344R','{\"create_time\":\"2021-05-09T22:33:49Z\",\"update_time\":\"2021-05-09T22:34:26Z\",\"id\":\"98A45056771623619\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-tgja41252052@personal.example.com\",\"payer_id\":\"H2Q5WFNDNB4FQ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $8607\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"8607.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"4LW67286TW528344R\",\"final_capture\":true,\"create_time\":\"2021-05-09T22:34:26Z\",\"update_time\":\"2021-05-09T22:34:26Z\",\"amount\":{\"value\":\"8607.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/4LW67286TW528344R\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/4LW67286TW528344R/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/98A45056771623619\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/98A45056771623619\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',1,'2022-05-09 16:34:28',10,8607.00,5,'Honduras, Mi casa','Completo'),
(20,NULL,'8R9600393B226963V','{\"create_time\":\"2021-05-09T23:37:41Z\",\"update_time\":\"2021-05-09T23:40:32Z\",\"id\":\"4D9105736E670250F\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"josemanuelpineda2016@gmail.com\",\"payer_id\":\"VT3K43AJZYUZJ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"Jose\",\"surname\":\"Pineda\"}},\"purchase_units\":[{\"description\":\"Compra de artículos en Tienda Virtual por un monto de $43\",\"reference_id\":\"default\",\"soft_descriptor\":\"PAYPAL *JOHNDOESTES\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-pkw2i4863308@business.example.com\",\"merchant_id\":\"RYYN9LSRBEXQW\"},\"shipping\":{\"name\":{\"full_name\":\"Jose Pineda\"},\"address\":{\"address_line_1\":\"kjh\",\"admin_area_2\":\"honduras\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"8R9600393B226963V\",\"final_capture\":true,\"create_time\":\"2021-05-09T23:40:32Z\",\"update_time\":\"2021-05-09T23:40:32Z\",\"amount\":{\"value\":\"43.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"NOT_ELIGIBLE\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8R9600393B226963V\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/8R9600393B226963V/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4D9105736E670250F\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4D9105736E670250F\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',1,'2022-05-09 17:40:34',10,2343.00,1,'fd, fgd','Completo'),
(21,'ytyr',NULL,NULL,1,'2022-05-05 20:47:53',10,3443.00,2,'cas, dsds','Completo'),
(22,'trrt',NULL,NULL,1,'2022-05-07 12:13:16',10,6565.00,3,'prueba, prueba','Completo'),
(23,'65655g',NULL,NULL,1,'2022-05-07 12:19:32',10,4332.00,4,'HFFHFHFH, HFHFG','Completo'),
(24,NULL,NULL,NULL,1,'2022-05-29 21:54:43',10,204.00,2,'jghjg, jh','Pendiente');

UNLOCK TABLES;

/*Table structure for table `permisos` */

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idpermiso`),
  KEY `rolid` (`rolid`),
  KEY `moduloid` (`moduloid`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=710 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `permisos` */

LOCK TABLES `permisos` WRITE;

insert  into `permisos`(`idpermiso`,`rolid`,`moduloid`,`r`,`w`,`u`,`d`) values 
(671,2,1,1,0,0,0),
(672,2,2,0,0,0,0),
(673,2,3,0,0,0,0),
(674,2,4,0,0,0,0),
(675,2,5,1,0,0,0),
(676,2,6,0,0,0,0),
(677,2,7,0,0,0,0),
(702,1,1,1,1,1,1),
(703,1,2,1,1,1,1),
(704,1,3,1,1,1,1),
(705,1,4,1,1,1,1),
(706,1,5,1,1,1,1),
(707,1,6,1,1,1,1),
(708,1,7,1,1,1,1),
(709,1,8,1,1,1,1);

UNLOCK TABLES;

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL AUTO_INCREMENT,
  `indentificacion` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombrefical` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccionfiscal` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `toke` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpersona`),
  KEY `rolid` (`rolid`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `persona` */

LOCK TABLES `persona` WRITE;

insert  into `persona`(`idpersona`,`indentificacion`,`nombres`,`apellidos`,`telefono`,`email_user`,`password`,`nit`,`nombrefical`,`direccionfiscal`,`toke`,`rolid`,`datecreated`,`status`) values 
(1,'001','Jose Manuel','Pineda',98980000,'trabajojosepineda@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','','','','86cd816169a39ec24a72-a2f6d1a9424e2d1b3415-6bcceeb63a1012a5baaf-9761f3bb7e2414d65e57',1,'2021-04-19 16:04:09',1),
(2,'002','Marlon','Said',9999999,'marlon@gmail.com','03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4','','','','',1,'2021-04-19 16:52:58',1),
(3,'312','Marcela','Giron',87450222,'marcelsa@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','1234567890','Desarrollos SA','Colonia La Era','',2,'2021-04-19 18:00:57',1),
(4,'43','Emili','Giron',87450222,'emili@gmail.com','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','4343','fsdfsdf','sdfsd','',2,'2021-04-19 18:38:19',1),
(5,'4234','Alla Fernado','Fonceca',12345678,'alla@gmail.com','7fecff7ecad2671b0fe4b41be41bdd41623b278358ccd0bb0c26e014c40fbb11','4343','rfsd','e','',2,'2021-04-19 21:28:23',1),
(6,'312121232','Jose','Pineda Prueba',32324343,'josemanuelsssspineda2016@gmail.com','38b13efeb59d69c428ee9b5ba49f4283b133e0bfbdfac7b930f1ba26e4089971','Identificación Fisca','Nombre Fiscal Prueba','Dirección Fiscal Prueba','',2,'2021-04-20 22:01:45',1),
(7,'434342','Josd','Sdfd',54545454,'josemanuelpineda2016@gmail.com','5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5','','','','',2,'2021-05-01 17:32:40',1);

UNLOCK TABLES;

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoriaid` bigint(20) NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproducto`),
  KEY `categoriaid` (`categoriaid`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `producto` */

LOCK TABLES `producto` WRITE;

insert  into `producto`(`idproducto`,`categoriaid`,`codigo`,`nombre`,`descripcion`,`precio`,`stock`,`imagen`,`datecreated`,`ruta`,`status`) values 
(1,14,'01124','Producto 1','<p>Core Black / Core Black / Core Black</p>',210.00,10,'','2021-04-21 23:08:55','producto-1',1),
(2,4,'312312','Producto 2','<p><strong>????????</strong></p> <p>Non Dyed</p> <p><span style=\"text-decoration: underline;\">yhtytryr</span></p> <table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"> <tbody> <tr> <td style=\"width: 97.8671%;\">gdfgdg</td> </tr> </tbody> </table> <p>&nbsp;</p>',4322.00,3,'','2021-04-22 18:30:21','producto-2',1),
(3,7,'12345','Producto 3','<p>Wireless Gaming Up to 10 teraflops of processing power enables in-car gaming on-par with today&rsquo;s newest consoles. Wireless controller compatibility lets you game from any seat.</p>',1201.43,4,'','2021-04-22 18:35:13','tesla-model-x',1),
(4,6,'64532','Producto 4','<p>Elaborada con cuero de la m&aacute;s alta calidad. -30060423001</p>',3299.00,20,'','2021-04-22 18:37:24','bota-recast-dk-olive',1),
(5,1,'42323','Ultraboost DNA Shoes','<p>Non Dyed / Non Dyed / Crew Blue</p>',4234.00,19,'','2021-04-22 18:41:16','ultraboost-dna-shoes',1),
(6,1,'123213','NMD_R1 Shoes','<p>Cloud White / Cloud White / Crystal White</p>',42.00,3,'','2021-04-22 18:43:07','nmd_r1-shoes',1),
(7,3,'10345','Adicross Woven Pants','<p>Black</p>',4234.00,4,'','2021-04-22 18:52:11','adicross-woven-pants',1),
(8,8,'4324324','Gucci Horsebit mini bag','<ol> <li><span style=\"background-color: #f1c40f;\">sdfsdfsdfsdf</span></li> <li><span style=\"background-color: #fbeeb8;\">sdfsd</span></li> <li>sdf</li> <li><span style=\"background-color: #c2e0f4;\">dsf</span></li> </ol> <p><sup>tretretre????</sup></p> <p><sup><iframe src=\"https://www.youtube.com/embed/RSNqHX3YqQQ\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></sup></p> <p><sup><a title=\"Texo para las graficas\" href=\"https://www.chartjs.org/docs/latest/\">https://www.chartjs.org/docs/latest/</a></sup></p>',100.00,1,'','2021-04-27 16:17:51','gucci-horsebit-mini-bag',1),
(9,5,'5345345','gdfgdfgdfg','<p>dfgdffdgfdgdfg</p>',345.00,3,'','2021-04-27 16:23:19','gdfgdfgdfg',1),
(10,2,'534534534','tertertre','<p>tertretretret</p> <ol> <li>gdftgertert</li> <li>dfgdf</li> <li>gdf</li> <li>dfteter</li> </ol> <p>erter</p> <p style=\"text-align: center;\"><strong>Lorem Ipsum</strong> is simply dummy text of the</p> <p style=\"text-align: center;\">&nbsp;</p> <p style=\"text-align: right;\">printing and typesetting industry.</p> <p style=\"text-align: right;\">&nbsp;</p> <p style=\"text-align: justify; padding-left: 80px;\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a <span style=\"background-color: #fbeeb8;\">type specimen book.</span> It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> <p style=\"text-align: justify;\">&nbsp;</p> <p><em>It was popularised in the <span style=\"background-color: #bfedd2;\">1960s</span> with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</em></p> <p>&nbsp;</p> <p><strong>Enlace <span style=\"color: #e03e2d;\">Ali:????</span></strong></p> <p>&nbsp;</p> <p><a title=\"Prueba\" href=\"https://www.lipsum.com/\" target=\"_blank\" rel=\"noopener\">https://www.lipsum.com/</a></p> <p>&nbsp;</p> <table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"> <tbody> <tr> <td style=\"width: 97.8107%;\">dfdssssssssssssssssssssssssss</td> </tr> </tbody> </table>',34.00,5,'','2021-04-27 16:27:08','tertertre',1),
(11,1,'34534','tertertrerwerwer','<p>345345345</p>',345.00,4,'','2021-04-27 16:29:06','tertertrerwerwer',1),
(12,6,'56345435','ertretretre','<p>345trter</p>',534.00,4,'','2021-04-27 16:31:21','ertretretre',1),
(13,6,'56766','TYUTY','<p>56</p>',567.00,5,'','2021-04-27 16:34:06','tyuty',1),
(14,1,'56666','FG','<p>HFGH</p>',65.00,6,'','2021-04-27 16:36:15','fg',1),
(15,7,'5465464','TRE','<p>ERTRE</p>',5.00,5,'','2021-04-27 16:37:59','tre',1),
(16,1,'43333','RTETER','<p>2323</p>',4.00,4,'','2021-04-27 16:39:13','rteter',1),
(17,1,'567567','Prueba','<p>tyuytutyu</p>',89.00,6,'','2021-04-27 16:43:44','prueba',1),
(18,1,'54344','rwerwer','<p>4trtr</p>',5345.00,454,'','2021-04-27 16:49:26','rwerwer',1),
(19,1,'34543','sadsa','<p>3fd</p>',45.00,4,'','2021-04-27 16:53:01','sadsa',1),
(20,1,'15244','utyutyu','<p>Hopllas adfasdfafasdfgsdgsd</p> <p>&nbsp;</p>',66.00,65,'','2021-04-27 16:57:49','utyutyu',1),
(21,1,'87877','Producto de Avion','<p>yuiuyiuy</p>',97.00,7,'','2021-04-27 17:04:51','producto-de-avion',1),
(22,1,'45454','terter sdfsdfsdwrwerwe','<p>dfgdfgfd</p>',6555.00,4,'','2021-04-27 17:07:23','terter-sdfsdfsdwrwerwe',1),
(23,6,'54345','Productos de pruebas nuevo ruta í','<p>sdfsdfsdf</p>',33.00,4,'','2021-04-28 22:47:31','productos-de-pruebas-nuevo-ruta-i',1);

UNLOCK TABLES;

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `rol` */

LOCK TABLES `rol` WRITE;

insert  into `rol`(`idrol`,`nombrerol`,`descripcion`,`status`) values 
(1,'Administrador','Acceso a todo el sistema para Administrador',1),
(2,'Cliente','Acceso al sistema para Cliente',1),
(3,'jjj','jjjj',2);

UNLOCK TABLES;

/*Table structure for table `suscripciones` */

DROP TABLE IF EXISTS `suscripciones`;

CREATE TABLE `suscripciones` (
  `idsuscripcion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datedreated` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idsuscripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

/*Data for the table `suscripciones` */

LOCK TABLES `suscripciones` WRITE;

insert  into `suscripciones`(`idsuscripcion`,`nombre`,`email`,`datedreated`) values 
(1,'Tertre','trabajojosepineda@gmail.com','2022-08-15 22:45:56'),
(2,'Tertre','trabajojosedpineda@gmail.com','2022-08-15 22:47:10'),
(3,'Asdasd','trabajojosepinfsdfdseda@gmail.com','2022-08-15 23:12:56'),
(4,'Jose Prueba Sus','josemanuelpityrtyneda2016@gmail.com','2022-08-16 23:22:33'),
(5,'Ytryr','josemanutyutyutyutyuelpineda2016@gmail.com','2022-08-16 23:24:32'),
(6,'Yrtyrt','josemrtertertertanuelpineda2016@gmail.com','2022-08-16 23:27:24'),
(7,'Rtyrty','josemanuetrtrlpineda2016@gmail.com','2022-08-16 23:32:58'),
(8,'Ert','josemanuelpineda2016@gmail.com','2022-08-16 23:49:49');

UNLOCK TABLES;

/*Table structure for table `tipopago` */

DROP TABLE IF EXISTS `tipopago`;

CREATE TABLE `tipopago` (
  `idtipopago` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipopago` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tipopago` */

LOCK TABLES `tipopago` WRITE;

insert  into `tipopago`(`idtipopago`,`tipopago`,`status`) values 
(1,'Paypal',1),
(2,'Efectivo',1),
(3,'Tarjeta',1),
(4,'Cheque',1),
(5,'Depósito Bancario',1);

UNLOCK TABLES;

/* Procedure structure for procedure `dasdsad` */

/*!50003 DROP PROCEDURE IF EXISTS  `dasdsad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `dasdsad`(IN `d` INT(11))
    NO SQL
BEGIN
END */$$
DELIMITER ;

/* Procedure structure for procedure `proveedoresxx` */

/*!50003 DROP PROCEDURE IF EXISTS  `proveedoresxx` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `proveedoresxx`(IN `id_proveedor_` BIGINT, IN `rtn_empresa_` INT, IN `nom_empresa_` VARCHAR(50), IN `con_empresa_` VARCHAR(50), IN `id_banco_` BIGINT, IN `num_cuenta_` BIGINT, IN `accion` VARCHAR(20))
BEGIN
	case accion 
    WHEN 'nuevo' THEN
    INSERT into proveedores(rtn_empresa,nom_empresa,con_empresa,id_banco,num_cuenta)
    VALUES (rtn_empresa_,nom_empresa_,con_empresa_,id_banco_,num_cuenta_);
    WHEN 'editar' THEN
    UPDATE proveedores SET
    rtn_empresa=rtn_empresa_,nom_empresa=nom_empresa_,con_empresa=con_empresa_,id_banco=id_banco_,num_cuenta=num_cuenta_
    WHERE id_proveedor=id_proveedor_;
    WHEN 'eliminar' THEN
    DELETE from proveedores WHERE id_proveedor=id_proveedor_;
    WHEN 'consultar' THEN
    SELECT * FROM proveedores WHERE id_proveedor= id_proveedor_;
    END CASE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `prueba` */

/*!50003 DROP PROCEDURE IF EXISTS  `prueba` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `prueba`(IN `id_` BIGINT)
    NO SQL
BEGIN
SELECT * FROM `ENTIDAD_BANCO` WHERE `id_banco`=id_;
END */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_cargos` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_cargos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_cargos`()
SELECT * FROM `CARGOS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Categorias` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Categorias` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Categorias`()
SELECT * FROM `CATEGORIAS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Empresas` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Empresas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Empresas`()
SELECT * FROM `EMPRESAS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Entidad_Banco` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Entidad_Banco` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Entidad_Banco`()
SELECT * FROM `ENTIDAD_BANCO` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Grupos` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Grupos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Grupos`()
SELECT * FROM `GRUPOS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Marcas` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Marcas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Marcas`()
SELECT * FROM `MARCAS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Regimen_Facturacion` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Regimen_Facturacion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Regimen_Facturacion`()
SELECT * FROM `REGIMEN_FACTURACION` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Tipos_Empleados` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Tipos_Empleados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Tipos_Empleados`()
SELECT * FROM `TIPOS_EMPLEADO` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Tipo_Clientes` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Tipo_Clientes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Tipo_Clientes`()
SELECT * FROM `TIPO_CLIENTES` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Tipo_Impuesto` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Tipo_Impuesto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Tipo_Impuesto`()
SELECT * FROM `TIPOS_IMPUESTOS` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Tipo_Rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Tipo_Rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Tipo_Rol`()
SELECT * FROM `TIPO_ROL` */$$
DELIMITER ;

/* Procedure structure for procedure `Sp_Select_Unidades_Medidas` */

/*!50003 DROP PROCEDURE IF EXISTS  `Sp_Select_Unidades_Medidas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`id13273764_adminpicki`@`%` PROCEDURE `Sp_Select_Unidades_Medidas`()
SELECT * FROM `UNIDADES_MEDIDAS` */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
