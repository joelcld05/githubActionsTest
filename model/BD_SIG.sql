-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.14-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sig
CREATE DATABASE IF NOT EXISTS `sig` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sig`;

-- Volcando estructura para procedimiento sig.Actualizar_usuario
DELIMITER //
CREATE PROCEDURE `Actualizar_usuario`(
	IN `contra` VARCHAR(50),
	IN `correo` VARCHAR(50),
	IN `cell` VARCHAR(50),
	IN `pn` VARCHAR(30),
	IN `sn` VARCHAR(30),
	IN `pa` VARCHAR(30),
	IN `sa` VARCHAR(30),
	IN `tprol` INT,
	IN `scr` INT,
	IN `id_user` INT
)
BEGIN
UPDATE usuario
JOIN nombre_completo ON usuario.ID_nombre = nombre_completo.ID_nombre
JOIN rol ON usuario.ID_rol = usuario.ID_rol
JOIN sucursal ON usuario.ID_sucursal = sucursal.ID_sucursal
	SET
		usuario.pass= contra,
		usuario.email = correo,
		usuario.celular = cell,
		nombre_completo.pri_nombre = pa,
		nombre_completo.seg_nombre = sn,
		nombre_completo.pri_apellido = pa,
		nombre_completo.seg_apellido = sa,
		usuario.ID_rol = tprol,
		usuario.ID_sucursal= scr
	WHERE  usuario.ID_user = id_user;
END//
DELIMITER ;

-- Volcando estructura para procedimiento sig.Agregar_token
DELIMITER //
CREATE PROCEDURE `Agregar_token`(
	IN `token` VARCHAR(50),
	IN `contra` VARCHAR(50)
)
BEGIN

 UPDATE usuario
	SET
	   token = token
 WHERE pass = contra;

END//
DELIMITER ;

-- Volcando estructura para procedimiento sig.Agregar_usuario
DELIMITER //
CREATE PROCEDURE `Agregar_usuario`(
	IN `id_rol` INT,
	IN `id_sucursal` INT,
	IN `contra` VARCHAR(50),
	IN `correo` VARCHAR(50),
	IN `cell` CHAR(50),
	IN `p_nombre` VARCHAR(30),
	IN `p_apellido` VARCHAR(30)
)
BEGIN
 
   INSERT INTO nombre_completo(pri_nombre,pri_apellido)
	VALUES(p_nombre,p_apellido);
   
	INSERT INTO usuario(pass,email,celular,ID_rol,ID_nombre,ID_sucursal)
	VALUES(contra, correo, cell, id_rol,(SELECT MAX(ID_nombre) FROM nombre_completo),id_sucursal);
 
END//
DELIMITER ;

-- Volcando estructura para vista sig.cliente
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cliente` (
	`sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`fecha` DATE NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.cliente_producto
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cliente_producto` (
	`sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`total` DOUBLE(22,0) NULL,
	`fecha` DATE NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.cliente_prov
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cliente_prov` (
	`sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`provincia` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`total` DOUBLE(22,0) NULL,
	`fecha` DATE NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.descripcion
CREATE TABLE IF NOT EXISTS `descripcion` (
  `ID_desc` int(11) NOT NULL,
  `desc` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.descripcion: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `descripcion` DISABLE KEYS */;
INSERT INTO `descripcion` (`ID_desc`, `desc`) VALUES
	(101, 'Lata'),
	(102, 'Botella'),
	(103, 'Litro'),
	(104, '2 Litros'),
	(201, '8 Onzas'),
	(202, '12 Onzas'),
	(203, '20 Onzas'),
	(204, '5 Litros'),
	(205, 'Garrafones con Agua'),
	(206, 'Agua del garrafón'),
	(301, '8 Onzas'),
	(302, '16 Onzas'),
	(303, 'Medio Galon'),
	(304, '1 Galon'),
	(401, '25 capsulas '),
	(402, '50 capsulas '),
	(403, '100 capsulas '),
	(404, '200 capsulas ');
/*!40000 ALTER TABLE `descripcion` ENABLE KEYS */;

-- Volcando estructura para procedimiento sig.Eliminar_usuario
DELIMITER //
CREATE PROCEDURE `Eliminar_usuario`(
	IN `id_nombre` INT
)
BEGIN

DELETE usuario, nombre_completo FROM 
usuario
JOIN nombre_completo ON
usuario.ID_nombre = nombre_completo.ID_nombre
WHERE usuario.ID_nombre = id_nombre;

END//
DELIMITER ;

-- Volcando estructura para tabla sig.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `ID_inv` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cant_min` int(11) DEFAULT NULL,
  `reorden` int(1) DEFAULT NULL,
  `ID_desc` int(11) DEFAULT NULL,
  `ID_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_inv`),
  KEY `FK_inventario_descripcion` (`ID_desc`),
  KEY `FK_inventario_tipo_producto` (`ID_tipo`),
  CONSTRAINT `FK_inventario_descripcion` FOREIGN KEY (`ID_desc`) REFERENCES `descripcion` (`ID_desc`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inventario_tipo_producto` FOREIGN KEY (`ID_tipo`) REFERENCES `tipo_producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sig.inventario: ~73 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` (`ID_inv`, `nombre`, `precio`, `cantidad`, `ID_desc`, `ID_tipo`) VALUES
	(1, 'Cola original', '0,80', 500, 101, 1),
	(2, 'Cola original', '0,80', 500, 102, 1),
	(3, 'Cola original', '1,25', 500, 103, 1),
	(4, 'Cola original', '2,50', 500, 104, 1),
	(5, 'Cola sin Azucar', '0,80', 500, 101, 1),
	(6, 'Cola Fresa', '0,80', 500, 101, 1),
	(7, 'Cola Fresa', '0,80', 500, 102, 1),
	(8, 'Cola Fresa', '1,25', 500, 103, 1),
	(9, 'Cola Fresa', '2,50', 500, 104, 1),
	(10, 'Cola Vainilla', '0,80', 500, 101, 1),
	(11, 'Cola Piña', '0,80', 500, 101, 1),
	(12, 'Cola Piña', '0,80', 500, 102, 1),
	(13, 'Cola Piña', '1,25', 500, 103, 1),
	(14, 'Cola Piña', '2,50', 500, 104, 1),
	(15, 'Cola Uva', '0,80', 500, 101, 1),
	(16, 'Cola Uva', '0,80', 500, 102, 1),
	(17, 'Cola Uva', '1,25', 500, 103, 1),
	(18, 'Cola Uva', '2,50', 500, 104, 1),
	(19, 'Cola Mandarina', '0,80', 500, 101, 1),
	(20, 'Cola Mandarina', '1,25', 500, 103, 1),
	(21, 'Cola de limón', '0,80', 500, 101, 1),
	(22, 'Cola de limón', '1,25', 500, 103, 1),
	(23, 'Cola de limón', '2,50', 500, 104, 1),
	(24, 'Agua', '0,50', 400, 201, 2),
	(25, 'Agua', '0,75', 400, 202, 2),
	(26, 'Agua', '1,25', 400, 203, 2),
	(27, 'Agua', '3,50', 450, 204, 2),
	(28, 'Agua', '7,50', 450, 205, 2),
	(29, 'Agua', '5,00', 450, 206, 2),
	(30, 'Jugo Piña', '2,00', 400, 301, 3),
	(31, 'Jugo Piña', '4,00', 400, 302, 3),
	(32, 'Jugo Piña', '8,00', 400, 303, 3),
	(33, 'Jugo Piña', '16,00', 450, 304, 3),
	(34, 'Jugo de Naranja', '2,00', 400, 301, 3),
	(35, 'Jugo de Naranja', '4,00', 400, 302, 3),
	(36, 'Jugo de Naranja', '8,00', 400, 303, 3),
	(37, 'Jugo de Naranja', '16,00', 400, 304, 3),
	(38, 'Jugo Mandarina', '2,00', 400, 301, 3),
	(39, 'Jugo Mandarina', '4,00', 400, 302, 3),
	(40, 'Jugo Mandarina', '8,00', 400, 303, 3),
	(41, 'Jugo Mandarina', '16,00', 400, 304, 3),
	(42, 'Jugo Verdura', '2,00', 300, 301, 3),
	(43, 'Jugo Verdura', '4,00', 300, 302, 3),
	(44, 'Jugo Verdura', '8,00', 300, 303, 3),
	(45, 'Jugo Verdura', '16,00', 300, 304, 3),
	(46, 'Jugo de Ponche', '2,00', 350, 301, 3),
	(47, 'Jugo de Ponche', '4,00', 350, 302, 3),
	(48, 'Jugo de Ponche', '8,00', 350, 303, 3),
	(49, 'Jugo de Ponche', '16,00', 350, 304, 3),
	(50, 'C', '3,00', 150, 401, 4),
	(51, 'C', '5,00', 150, 402, 4),
	(52, 'C', '8,00', 150, 403, 4),
	(53, 'C', '12,00', 150, 404, 4),
	(54, 'D', '3,00', 200, 401, 4),
	(55, 'D', '5,00', 200, 402, 4),
	(56, 'D', '8,50', 200, 403, 4),
	(57, 'D', '15,00', 200, 404, 4),
	(58, 'E', '3,50', 200, 401, 4),
	(59, 'E', '5,50', 200, 402, 4),
	(60, 'E', '10,00', 200, 403, 4),
	(61, 'E', '15,00', 200, 404, 4),
	(62, 'ZING', '3,50', 200, 401, 4),
	(63, 'ZING', '6,00', 200, 402, 4),
	(64, 'ZING', '10,00', 200, 403, 4),
	(65, 'ZING', '15,00', 200, 404, 4),
	(66, 'MAGNECIO', '3,75', 150, 401, 4),
	(67, 'MAGNECIO', '6,00', 150, 402, 4),
	(68, 'MAGNECIO', '10,00', 150, 403, 4),
	(69, 'MAGNECIO', '15,00', 150, 404, 4),
	(70, 'COMPLEJO B', '4,00', 250, 401, 4),
	(71, 'COMPLEJO B', '6,00', 250, 402, 4),
	(72, 'COMPLEJO B', '10,00', 250, 403, 4),
	(73, 'COMPLEJO B', '15,00', 250, 404, 4);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;

-- Volcando estructura para vista sig.inventario_segmentado
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `inventario_segmentado` (
	`Producto` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`Descripcion` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`Nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Precio` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Stock` INT(11) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.inv_global
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `inv_global` (
	`Nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`precio` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`descripciÖn` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tipo` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Volcando estructura para procedimiento sig.Mostrar_usuario
DELIMITER //
CREATE PROCEDURE `Mostrar_usuario`(
	IN `id_usuario` INT
)
BEGIN

SELECT * FROM usuario
WHERE usuario.ID_user = id_usuario;

END//
DELIMITER ;

-- Volcando estructura para tabla sig.nombre_completo
CREATE TABLE IF NOT EXISTS `nombre_completo` (
  `ID_nombre` int(11) NOT NULL AUTO_INCREMENT,
  `pri_nombre` varchar(30) DEFAULT NULL,
  `seg_nombre` varchar(30) DEFAULT NULL,
  `pri_apellido` varchar(30) DEFAULT NULL,
  `seg_apellido` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_nombre`),
  UNIQUE KEY `ID_nombre` (`ID_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sig.nombre_completo: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `nombre_completo` DISABLE KEYS */;
INSERT INTO `nombre_completo` (`ID_nombre`, `pri_nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`) VALUES
	(1, 'Manuel', '', 'Jimenez', ''),
	(2, 'Francisco', '', 'Oliveiro', ''),
	(3, 'Evelyn ', '', 'Rosas', ''),
	(4, 'Kevin', '', 'Santamaria', ''),
	(5, 'Vairon', '', 'Dominguez', ''),
	(6, 'Arnoldo', 'Enrique', 'Dawson', 'Perez'),
	(7, 'Roberto', NULL, 'Gonzales', NULL);
/*!40000 ALTER TABLE `nombre_completo` ENABLE KEYS */;

-- Volcando estructura para tabla sig.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `ID_prov` int(11) NOT NULL,
  `nombre_prov` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_prov`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.provincia: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` (`ID_prov`, `nombre_prov`) VALUES
	(1, 'Panama  Oeste'),
	(2, 'Panama'),
	(3, 'Colon'),
	(4, 'Chame'),
	(5, 'Chiriqui'),
	(6, 'Cocle'),
	(7, 'Veraguas'),
	(8, 'Los Santos'),
	(9, 'Herrera');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

-- Volcando estructura para vista sig.report_clienteprov
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `report_clienteprov` (
	`nombre_sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`provincia` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.report_historico
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `report_historico` (
	`Producto` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Categoria` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`Tipo Producto` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`Precio` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`Precio Total` DOUBLE(22,0) NULL,
	`Fecha` DATE NULL,
	`Supermercado` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`Lugar` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`Sede` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `ID_rol` int(11) NOT NULL,
  `tip_rol` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.rol: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`ID_rol`, `tip_rol`) VALUES
	(1, 'Operativo Cliente'),
	(2, 'Administrador'),
	(3, 'Operativo Empresa'),
	(4, 'Reporte'),
	(5, 'Estrategico');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para procedimiento sig.Sesion_usuario
DELIMITER //
CREATE PROCEDURE `Sesion_usuario`(
	IN `id_usuario` INT,
	IN `correo` VARCHAR(50)
)
BEGIN

	SELECT 
		*
	FROM usuario 
	JOIN nombre_completo ON usuario.ID_nombre = nombre_completo.ID_nombre
	JOIN rol ON usuario.ID_rol = rol.ID_rol
	WHERE usuario.pass  = id_usuario  AND email = correo;

END//
DELIMITER ;

-- Volcando estructura para tabla sig.sucursal
CREATE TABLE IF NOT EXISTS `sucursal` (
  `ID_sucursal` int(11) NOT NULL,
  `nombre_sucursal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `perfil_sucursal` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ID_prov` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_sucursal`) USING BTREE,
  KEY `FK_ID_prov` (`ID_prov`) USING BTREE,
  CONSTRAINT `FK_ID_prov` FOREIGN KEY (`ID_prov`) REFERENCES `provincia` (`ID_prov`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.sucursal: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` (`ID_sucursal`, `nombre_sucursal`, `perfil_sucursal`, `ubicacion`, `ID_prov`) VALUES
	(1, 'Supermercado Fuerte', '../Assets/fuerte.png', 'Vacamonte', 1),
	(2, 'Supermercado Rey', '../Assets/rey.png', 'Vista Alegre', 1),
	(3, 'Supermercado Extra', '../Assets/xtra.png', 'Arraijan', 1),
	(4, 'Super 99', '../Assets/Super99logo.png', 'Balboa', 2);
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;

-- Volcando estructura para tabla sig.tipo_producto
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `ID_prod` int(11) NOT NULL,
  `tipo_prod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.tipo_producto: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT INTO `tipo_producto` (`ID_prod`, `tipo_prod`) VALUES
	(1, 'Soda'),
	(2, 'Agua'),
	(3, 'Jugo'),
	(4, 'Vitamina');
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;

-- Volcando estructura para tabla sig.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `celular` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `token` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ID_rol` int(11) DEFAULT NULL,
  `ID_sucursal` int(11) DEFAULT NULL,
  `ID_nombre` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_user`) USING BTREE,
  UNIQUE KEY `ID_nombre` (`ID_nombre`),
  KEY `ID_rol` (`ID_rol`),
  KEY `ID_sucursal` (`ID_sucursal`),
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ID_rol`) REFERENCES `rol` (`ID_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_sig.nombre_completo` FOREIGN KEY (`ID_nombre`) REFERENCES `nombre_completo` (`ID_nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ID_sucursal` FOREIGN KEY (`ID_sucursal`) REFERENCES `sucursal` (`ID_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.usuario: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`ID_user`, `pass`, `email`, `celular`, `token`, `ID_rol`, `ID_sucursal`, `ID_nombre`) VALUES
	(1, '40001', 'manuelj@outlook.com', '63086641', '5fb0b28b94ee1', 1, 1, 1),
	(2, '40002', 'oliveiro20@outlook.com', '61274020', '5fb33184266b8', 2, 3, 2),
	(3, '40003', 'evelyn19@gmail.com', '62440076', '5faf60aa57151', 5, 2, 3),
	(4, '40004', 'kevinsa18@gmail.com', '63069163', '5faf60ba016ae', 4, 4, 4),
	(5, '40005', 'domvairon15@outlook.com', '64161333', '5faf60cca11ab', 3, 2, 5),
	(6, '40006', 'arnoldo96@gmail.com', '66804618', '5faf60e2351ae', 3, 3, 6),
	(7, '40007', 'robert07@outlook.com', '6787290', NULL, 3, 2, 7);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sig.venta
CREATE TABLE IF NOT EXISTS `venta` (
  `ID_venta` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_solicitada` int(11) DEFAULT NULL,
  `precio_total` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ID_inv` int(11) DEFAULT NULL,
  `ID_sucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_venta`),
  KEY `FK_venta_inventario` (`ID_inv`),
  KEY `FK_sucursal` (`ID_sucursal`),
  CONSTRAINT `FK_sucursal` FOREIGN KEY (`ID_sucursal`) REFERENCES `sucursal` (`ID_sucursal`),
  CONSTRAINT `FK_venta_inventario` FOREIGN KEY (`ID_inv`) REFERENCES `inventario` (`ID_inv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.venta: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`ID_venta`, `cantidad_solicitada`, `precio_total`, `fecha`, `ID_inv`, `ID_sucursal`) VALUES
	(1, 100, 250, '2020-11-10', 4, 4),
	(2, 70, 56, '2020-11-10', 5, 3),
	(3, 100, 80, '2020-11-10', 11, 1),
	(4, 50, 375, '2020-11-10', 28, 2),
	(5, 100, 1600, '2020-11-10', 33, 4),
	(6, 55, 467, '2020-11-10', 63, 3);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para vista sig.vista_rol
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_rol` (
	`ID_rol` INT(11) NOT NULL,
	`Rol` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.vista_sucursal
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_sucursal` (
	`ID_sucursal` INT(11) NOT NULL,
	`Sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.vista_usuario
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_usuario` (
	`nombre` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`apellido` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`s_nombre` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`s_apellido` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`ID_user` INT(11) NOT NULL,
	`correo` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`celular` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`id_sucursal` INT(11) NOT NULL,
	`sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`perfil` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`contra` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rol` VARCHAR(30) NOT NULL COLLATE 'utf8_unicode_ci',
	`id_rol` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.cliente
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cliente`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cliente` AS SELECT 
sucursal.nombre_sucursal AS 'sucursal',
inventario.nombre AS nombre,
venta.cantidad_solicitada AS cantidad,
venta.fecha AS fecha 
FROM sucursal
JOIN inventario ON sucursal.ID_sucursal= inventario.ID_inv
JOIN venta ON sucursal.ID_sucursal=venta.ID_venta 
ORDER BY venta.cantidad_solicitada DESC ;

-- Volcando estructura para vista sig.cliente_producto
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cliente_producto`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cliente_producto` AS SELECT 
sucursal.nombre_sucursal AS 'sucursal',
inventario.nombre AS nombre,
venta.cantidad_solicitada AS cantidad,
venta.precio_total AS total,
venta.fecha AS fecha 
FROM sucursal
JOIN inventario ON sucursal.ID_sucursal= inventario.ID_inv
JOIN venta ON sucursal.ID_sucursal=venta.ID_venta 
ORDER BY venta.cantidad_solicitada DESC ;

-- Volcando estructura para vista sig.cliente_prov
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cliente_prov`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cliente_prov` AS SELECT 
sucursal.nombre_sucursal AS 'sucursal',
sucursal.ubicacion AS ubicacion,
provincia.nombre_prov AS 'provincia',
inventario.nombre AS nombre,
venta.cantidad_solicitada AS cantidad,
venta.precio_total AS total,
venta.fecha AS fecha 
FROM sucursal
JOIN provincia ON sucursal.ID_prov=provincia.ID_prov
JOIN inventario ON sucursal.ID_sucursal= inventario.ID_inv
JOIN venta ON sucursal.ID_sucursal=venta.ID_venta 
ORDER BY venta.cantidad_solicitada DESC ;

-- Volcando estructura para vista sig.inventario_segmentado
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `inventario_segmentado`;
CREATE ALGORITHM=TEMPTABLE SQL SECURITY DEFINER VIEW `inventario_segmentado` AS SELECT 
tipo_producto.tipo_prod AS Producto,
descripcion.`desc` AS 'Descripcion',
inventario.nombre AS Nombre,
inventario.precio AS Precio,
inventario.cantidad AS Stock
FROM inventario
JOIN tipo_producto ON inventario.ID_tipo = tipo_producto.ID_prod
JOIN descripcion ON inventario.ID_desc= descripcion.ID_desc ;

-- Volcando estructura para vista sig.inv_global
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `inv_global`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `inv_global` AS SELECT 
inventario.nombre AS  Nombre, 
inventario.precio AS precio, 
inventario.cantidad AS cantidad, 
descripcion.`desc` AS descripciÖn, 
tipo_producto.tipo_prod AS tipo
FROM inventario 
JOIN descripcion ON inventario.ID_desc = descripcion.ID_desc
JOIN tipo_producto ON  inventario.ID_tipo = tipo_producto.ID_prod ;

-- Volcando estructura para vista sig.report_clienteprov
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_clienteprov`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_clienteprov` AS SELECT 
sucursal.nombre_sucursal AS nombre_sucursal,
sucursal.ubicacion AS ubicacion,
provincia.nombre_prov AS provincia
FROM sucursal
JOIN provincia ON sucursal.ID_prov= provincia.ID_prov ;

-- Volcando estructura para vista sig.report_historico
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_historico`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_historico` AS SELECT 
inventario.nombre AS Producto,
tipo_producto.tipo_prod AS Categoria,
descripcion.`desc` AS 'Tipo Producto',
inventario.precio AS Precio,
venta.cantidad_solicitada AS cantidad,
venta.precio_total 'Precio Total',
venta.fecha AS Fecha,
sucursal.nombre_sucursal AS Supermercado,
sucursal.ubicacion AS Lugar,
provincia.nombre_prov AS Sede

FROM inventario
JOIN tipo_producto ON inventario.ID_tipo = tipo_producto.ID_prod
JOIN descripcion ON inventario.ID_desc = descripcion.ID_desc
JOIN venta ON inventario.ID_inv = venta.ID_inv
JOIN sucursal ON venta.ID_sucursal = sucursal.ID_sucursal
JOIN provincia ON sucursal.ID_prov = provincia.ID_prov 
ORDER BY inventario.nombre ;

-- Volcando estructura para vista sig.vista_rol
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_rol`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_rol` AS SELECT ID_rol, tip_rol AS 'Rol' FROM rol ;

-- Volcando estructura para vista sig.vista_sucursal
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_sucursal`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_sucursal` AS SELECT ID_sucursal,nombre_sucursal AS 'Sucursal' FROM sucursal ;

-- Volcando estructura para vista sig.vista_usuario
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_usuario`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_usuario` AS SELECT 
	nombre_completo.pri_nombre AS nombre,
	nombre_completo.pri_apellido AS apellido,
	nombre_completo.seg_nombre AS s_nombre,
	nombre_completo.seg_apellido AS s_apellido,
	usuario.ID_user,
	usuario.email AS correo,
	usuario.celular AS celular,
	sucursal.ID_sucursal AS id_sucursal,
	sucursal.nombre_sucursal AS sucursal,
	sucursal.perfil_sucursal AS perfil,
	usuario.pass AS contra,
	rol.tip_rol AS rol,
	rol.ID_rol AS id_rol
	FROM usuario
	JOIN nombre_completo ON usuario.ID_user = nombre_completo.ID_nombre
	JOIN rol ON usuario.ID_rol = rol.ID_rol 
	JOIN sucursal ON usuario.ID_sucursal = sucursal.ID_sucursal
	ORDER BY nombre_completo.ID_nombre ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
