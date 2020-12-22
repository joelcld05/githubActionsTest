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
		nombre_completo.pri_nombre = pn,
		nombre_completo.seg_nombre = sn,
		nombre_completo.pri_apellido = pa,
		nombre_completo.seg_apellido = sa,
		usuario.ID_rol = tprol,
		usuario.ID_sucursal= scr
	WHERE  usuario.ID_user = id_user;
END//
DELIMITER ;

-- Volcando estructura para procedimiento sig.add_venta
DELIMITER //
CREATE PROCEDURE `add_venta`(
	in usr int,
    in inv int,
    in cant int
)
BEGIN
	set @l_usr = (select us.ID_local_scr from usuario as us where us.ID_user = usr );
    set @prc = (select precio_vt from ganancia_perdida as gp where gp.ID_inv = inv);
    set @inv2 = inv;
    insert into venta(cantidad_solicitada,precio_total,fecha,ID_inv,ID_local_scr) values
    (cant,(cant * @prc),CURDATE(),inv,@l_usr);
    
    update ganancia_perdida set  cantidad_cp = (cantidad_cp - cant) where ID_inv = @inv2;
    update ganancia_perdida set  cantidad_vd = (cantidad_vd + cant) where ID_inv = @inv2;
    update ganancia_perdida set  ganancia = (ganancia + (cant * precio_vt)) where ID_inv = @inv2;
    call sp_val_REORDEN();
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
    IN `id_lc_scr` INT,
    IN `contra` VARCHAR(50),
    IN `correo` VARCHAR(50),
    IN `cell` CHAR(50),
    IN `p_nombre` VARCHAR(30),
    IN `p_apellido` VARCHAR(30)
)
BEGIN

   INSERT INTO nombre_completo(pri_nombre,pri_apellido)
    VALUES(p_nombre,p_apellido);

    INSERT INTO usuario(pass,email,celular,ID_rol,ID_nombre,ID_sucursal, ID_local_scr)
    VALUES(contra, correo, cell, id_rol,(SELECT MAX(ID_nombre) FROM nombre_completo),id_sucursal, id_lc_scr);

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
	`ubicación` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`producto` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`precio total` DECIMAL(10,2) NULL,
	`fecha` DATE NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.cliente_prov
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cliente_prov` (
	`Sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`Ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`Provincia` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`Producto` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Cantidad` INT(11) NULL,
	`Costo Total` DECIMAL(10,2) NULL,
	`Fecha` DATE NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.descripcion
CREATE TABLE IF NOT EXISTS `descripcion` (
  `ID_desc` int(11) NOT NULL,
  `desc` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.descripcion: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `descripcion` DISABLE KEYS */;
INSERT IGNORE INTO `descripcion` (`ID_desc`, `desc`) VALUES
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

-- Volcando estructura para tabla sig.ganancia_perdida
CREATE TABLE IF NOT EXISTS `ganancia_perdida` (
  `ID_inv` int(11) NOT NULL,
  `precio_cp` decimal(10,2) DEFAULT NULL,
  `cantidad_cp` int(11) DEFAULT NULL,
  `inversion` decimal(10,2) DEFAULT NULL,
  `precio_vt` decimal(10,2) DEFAULT NULL,
  `cantidad_vd` int(11) DEFAULT NULL,
  `ganancia` decimal(10,2) DEFAULT NULL,
  `cant_min` int(11) DEFAULT NULL,
  `reorden` int(1) DEFAULT NULL,
  KEY `ID_inv` (`ID_inv`),
  CONSTRAINT `FK_ganacia_perdida_inventario` FOREIGN KEY (`ID_inv`) REFERENCES `inventario` (`ID_inv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sig.ganancia_perdida: ~73 rows (aproximadamente)
/*!40000 ALTER TABLE `ganancia_perdida` DISABLE KEYS */;
INSERT IGNORE INTO `ganancia_perdida` (`ID_inv`, `precio_cp`, `cantidad_cp`, `inversion`, `precio_vt`, `cantidad_vd`, `ganancia`, `cant_min`, `reorden`) VALUES
	(1, 0.70, 458, 350.00, 0.80, 42, 33.60, 200, 0),
	(2, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(3, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(4, 1.90, 500, 950.00, 2.50, 0, 0.00, 200, 0),
	(5, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(6, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(7, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(8, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(9, 1.90, 500, 950.00, 2.50, 0, 0.00, 200, 0),
	(10, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(11, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(12, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(13, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(14, 1.90, 500, 950.00, 2.50, 0, 0.00, 200, 0),
	(15, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(16, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(17, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(18, 1.90, 500, 950.00, 2.50, 0, 0.00, 200, 0),
	(19, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(20, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(21, 0.70, 500, 350.00, 0.80, 0, 0.00, 200, 0),
	(22, 1.00, 500, 500.00, 1.25, 0, 0.00, 200, 0),
	(23, 1.90, 500, 950.00, 2.50, 0, 0.00, 200, 0),
	(24, 0.30, 500, 120.00, 0.50, 0, 0.00, 200, 0),
	(25, 0.50, 490, 200.00, 0.75, 10, 7.50, 200, 0),
	(26, 1.00, 500, 400.00, 1.25, 0, 0.00, 200, 0),
	(27, 2.00, 500, 900.00, 3.50, 0, 0.00, 200, 0),
	(28, 4.00, 500, 1800.00, 7.50, 0, 0.00, 200, 0),
	(29, 2.50, 500, 1125.00, 5.00, 0, 0.00, 200, 0),
	(30, 1.00, 500, 400.00, 2.00, 0, 0.00, 200, 0),
	(31, 1.50, 500, 600.00, 4.00, 0, 0.00, 200, 0),
	(32, 2.00, 500, 800.00, 8.00, 0, 0.00, 200, 0),
	(33, 4.00, 500, 1800.00, 16.00, 0, 0.00, 200, 0),
	(34, 1.00, 500, 400.00, 2.00, 0, 0.00, 200, 0),
	(35, 1.50, 500, 600.00, 4.00, 0, 0.00, 200, 0),
	(36, 2.00, 500, 800.00, 8.00, 0, 0.00, 200, 0),
	(37, 4.00, 500, 1600.00, 16.00, 0, 0.00, 200, 0),
	(38, 1.00, 500, 400.00, 2.00, 0, 0.00, 200, 0),
	(39, 1.50, 500, 600.00, 4.00, 0, 0.00, 200, 0),
	(40, 2.00, 500, 800.00, 8.00, 0, 0.00, 200, 0),
	(41, 4.00, 500, 1600.00, 16.00, 0, 0.00, 200, 0),
	(42, 1.00, 500, 300.00, 2.00, 0, 0.00, 200, 0),
	(43, 1.50, 500, 450.00, 4.00, 0, 0.00, 200, 0),
	(44, 2.00, 500, 600.00, 8.00, 0, 0.00, 200, 0),
	(45, 4.00, 500, 1200.00, 16.00, 0, 0.00, 200, 0),
	(46, 1.00, 500, 350.00, 2.00, 0, 0.00, 200, 0),
	(47, 1.50, 500, 525.00, 4.00, 0, 0.00, 200, 0),
	(48, 2.00, 500, 700.00, 8.00, 0, 0.00, 200, 0),
	(49, 4.00, 500, 1400.00, 16.00, 0, 0.00, 200, 0),
	(50, 2.00, 500, 300.00, 3.00, 0, 0.00, 200, 0),
	(51, 4.00, 500, 600.00, 5.00, 0, 0.00, 200, 0),
	(52, 6.00, 500, 900.00, 8.00, 0, 0.00, 200, 0),
	(53, 10.00, 500, 1500.00, 12.00, 0, 0.00, 200, 0),
	(54, 2.00, 500, 400.00, 3.00, 0, 0.00, 200, 0),
	(55, 4.00, 500, 800.00, 5.00, 0, 0.00, 200, 0),
	(56, 7.00, 500, 1400.00, 8.50, 0, 0.00, 200, 0),
	(57, 10.00, 500, 2000.00, 15.00, 0, 0.00, 200, 0),
	(58, 2.50, 500, 500.00, 3.50, 0, 0.00, 200, 0),
	(59, 4.50, 500, 900.00, 5.50, 0, 0.00, 200, 0),
	(60, 6.00, 500, 1200.00, 10.00, 0, 0.00, 200, 0),
	(61, 10.00, 500, 2000.00, 15.00, 0, 0.00, 200, 0),
	(62, 2.50, 500, 500.00, 3.50, 0, 0.00, 200, 0),
	(63, 4.00, 500, 800.00, 6.00, 0, 0.00, 200, 0),
	(64, 6.00, 500, 1200.00, 10.00, 0, 0.00, 200, 0),
	(65, 10.00, 500, 2000.00, 15.00, 0, 0.00, 200, 0),
	(66, 2.25, 500, 337.50, 3.75, 0, 0.00, 200, 0),
	(67, 4.00, 500, 600.00, 6.00, 0, 0.00, 200, 0),
	(68, 6.00, 500, 900.00, 10.00, 0, 0.00, 200, 0),
	(69, 10.00, 500, 1500.00, 15.00, 0, 0.00, 200, 0),
	(70, 2.00, 500, 500.00, 4.00, 0, 0.00, 200, 0),
	(71, 4.00, 500, 1000.00, 6.00, 0, 0.00, 200, 0),
	(72, 6.00, 500, 1500.00, 10.00, 0, 0.00, 200, 0),
	(73, 10.00, 500, 2500.00, 15.00, 0, 0.00, 200, 0);
/*!40000 ALTER TABLE `ganancia_perdida` ENABLE KEYS */;

-- Volcando estructura para vista sig.gp_globles
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `gp_globles` (
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cant stock` INT(11) NULL,
	`inversion` DECIMAL(10,2) NULL,
	`precio` DECIMAL(10,2) NULL,
	`cant vendida` INT(11) NULL,
	`ganancia` DECIMAL(10,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `ID_inv` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ID_desc` int(11) DEFAULT NULL,
  `ID_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_inv`),
  KEY `FK_inventario_descripcion` (`ID_desc`),
  KEY `FK_inventario_tipo_producto` (`ID_tipo`),
  CONSTRAINT `FK_inventario_descripcion` FOREIGN KEY (`ID_desc`) REFERENCES `descripcion` (`ID_desc`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_inventario_tipo_producto` FOREIGN KEY (`ID_tipo`) REFERENCES `tipo_producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPRESSED;

-- Volcando datos para la tabla sig.inventario: ~73 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT IGNORE INTO `inventario` (`ID_inv`, `nombre`, `ID_desc`, `ID_tipo`) VALUES
	(1, 'Cola original', 101, 1),
	(2, 'Cola original', 102, 1),
	(3, 'Cola original', 103, 1),
	(4, 'Cola original', 104, 1),
	(5, 'Cola sin Azucar', 101, 1),
	(6, 'Cola Fresa', 101, 1),
	(7, 'Cola Fresa', 102, 1),
	(8, 'Cola Fresa', 103, 1),
	(9, 'Cola Fresa', 104, 1),
	(10, 'Cola Vainilla', 101, 1),
	(11, 'Cola Piña', 101, 1),
	(12, 'Cola Piña', 102, 1),
	(13, 'Cola Piña', 103, 1),
	(14, 'Cola Piña', 104, 1),
	(15, 'Cola Uva', 101, 1),
	(16, 'Cola Uva', 102, 1),
	(17, 'Cola Uva', 103, 1),
	(18, 'Cola Uva', 104, 1),
	(19, 'Cola Mandarina', 101, 1),
	(20, 'Cola Mandarina', 103, 1),
	(21, 'Cola de limón', 101, 1),
	(22, 'Cola de limón', 103, 1),
	(23, 'Cola de limón', 104, 1),
	(24, 'Agua', 201, 2),
	(25, 'Agua', 202, 2),
	(26, 'Agua', 203, 2),
	(27, 'Agua', 204, 2),
	(28, 'Agua', 205, 2),
	(29, 'Agua', 206, 2),
	(30, 'Jugo Piña', 301, 3),
	(31, 'Jugo Piña', 302, 3),
	(32, 'Jugo Piña', 303, 3),
	(33, 'Jugo Piña', 304, 3),
	(34, 'Jugo de Naranja', 301, 3),
	(35, 'Jugo de Naranja', 302, 3),
	(36, 'Jugo de Naranja', 303, 3),
	(37, 'Jugo de Naranja', 304, 3),
	(38, 'Jugo Mandarina', 301, 3),
	(39, 'Jugo Mandarina', 302, 3),
	(40, 'Jugo Mandarina', 303, 3),
	(41, 'Jugo Mandarina', 304, 3),
	(42, 'Jugo Verdura', 301, 3),
	(43, 'Jugo Verdura', 302, 3),
	(44, 'Jugo Verdura', 303, 3),
	(45, 'Jugo Verdura', 304, 3),
	(46, 'Jugo de Ponche', 301, 3),
	(47, 'Jugo de Ponche', 302, 3),
	(48, 'Jugo de Ponche', 303, 3),
	(49, 'Jugo de Ponche', 304, 3),
	(50, 'C', 401, 4),
	(51, 'C', 402, 4),
	(52, 'C', 403, 4),
	(53, 'C', 404, 4),
	(54, 'D', 401, 4),
	(55, 'D', 402, 4),
	(56, 'D', 403, 4),
	(57, 'D', 404, 4),
	(58, 'E', 401, 4),
	(59, 'E', 402, 4),
	(60, 'E', 403, 4),
	(61, 'E', 404, 4),
	(62, 'ZING', 401, 4),
	(63, 'ZING', 402, 4),
	(64, 'ZING', 403, 4),
	(65, 'ZING', 404, 4),
	(66, 'MAGNECIO', 401, 4),
	(67, 'MAGNECIO', 402, 4),
	(68, 'MAGNECIO', 403, 4),
	(69, 'MAGNECIO', 404, 4),
	(70, 'COMPLEJO B', 401, 4),
	(71, 'COMPLEJO B', 402, 4),
	(72, 'COMPLEJO B', 403, 4),
	(73, 'COMPLEJO B', 404, 4);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;

-- Volcando estructura para vista sig.inventario_segmentado
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `inventario_segmentado` (
	`Producto` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`Descripcion` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`Nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Precio` DECIMAL(10,2) NULL,
	`Stock` INT(11) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.inv_global
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `inv_global` (
	`Nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`precio` DECIMAL(10,2) NULL,
	`cantidad_vd` INT(11) NULL,
	`descripcion` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tipo` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.local_scr
CREATE TABLE IF NOT EXISTS `local_scr` (
  `ID_local_src` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` varchar(50) DEFAULT NULL,
  `telf` varchar(11) DEFAULT NULL,
  `ID_scr` int(11) DEFAULT NULL,
  `ID_prov` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_local_src`),
  KEY `FK__sucursal` (`ID_scr`),
  KEY `FK__provincia` (`ID_prov`),
  CONSTRAINT `FK__provincia` FOREIGN KEY (`ID_prov`) REFERENCES `provincia` (`ID_prov`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__sucursal` FOREIGN KEY (`ID_scr`) REFERENCES `sucursal` (`ID_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sig.local_scr: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `local_scr` DISABLE KEYS */;
INSERT IGNORE INTO `local_scr` (`ID_local_src`, `ubicacion`, `telf`, `ID_scr`, `ID_prov`) VALUES
	(1, '﻿Westland Mall', '252-3444', 1, 2),
	(2, 'San Miguelito', '366-3500', 1, 1),
	(3, 'Villa Zaita', '280-7500', 1, 1),
	(4, 'El dorado', '260-6370', 2, 1),
	(5, 'Costa Verde', '830-4012', 2, 2),
	(6, 'Vista Alegre', '251-7904', 2, 2),
	(7, 'Centennial', '300-5536', 2, 1),
	(8, 'Via transismica', '290-9077', 3, 1),
	(9, 'Condado del Rey', '290-9069', 3, 2),
	(10, 'Chorrera', '244-5257', 3, 2),
	(11, 'Centro Comercial Colon', '447-3973', 4, 3),
	(12, 'Bugaba', '730-0786', 4, 4),
	(13, 'Albrook Mall', '323-8877', 4, 1);
/*!40000 ALTER TABLE `local_scr` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla sig.nombre_completo: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `nombre_completo` DISABLE KEYS */;
INSERT IGNORE INTO `nombre_completo` (`ID_nombre`, `pri_nombre`, `seg_nombre`, `pri_apellido`, `seg_apellido`) VALUES
	(1, 'Manuel', '', 'Jimenez', ''),
	(2, 'Francisco', '', 'Oliveiro', ''),
	(3, 'Evelyn ', '', 'Rosas', ''),
	(4, 'Kevin', '', 'Santamaria', ''),
	(5, 'Vairon', '', 'Dominguez', ''),
	(6, 'Arnoldo', 'Enrique', 'Dawson', 'Perez'),
	(7, 'Roberto', NULL, 'Gonzales', NULL);
/*!40000 ALTER TABLE `nombre_completo` ENABLE KEYS */;

-- Volcando estructura para vista sig.obtener_infoproducto
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `obtener_infoproducto` (
	`precio_cp` DECIMAL(10,2) NULL,
	`cantidad_cp` INT(11) NULL,
	`inversion` DECIMAL(10,2) NULL,
	`precio_vt` DECIMAL(10,2) NULL,
	`cantidad_vd` INT(11) NULL,
	`ganancia` DECIMAL(10,2) NULL,
	`cant_min` INT(11) NULL,
	`reorden` INT(1) NULL,
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`descripcions` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tipo_prod` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.productos_emp
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `productos_emp` (
	`ID` INT(11) NOT NULL,
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`cantidad` INT(11) NULL,
	`descripcion` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tipo` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`precio` DECIMAL(10,2) NULL,
	`reorden` INT(1) NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla sig.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `ID_prov` int(11) NOT NULL,
  `nombre_prov` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_prov`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.provincia: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT IGNORE INTO `provincia` (`ID_prov`, `nombre_prov`) VALUES
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
	`sucursal` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`provincia` VARCHAR(30) NOT NULL COLLATE 'utf8_general_ci',
	`telefono` VARCHAR(11) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.report_gananciagloabl
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `report_gananciagloabl` (
	`categoria` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`total producto` DECIMAL(32,0) NULL,
	`total inversion` DECIMAL(32,2) NULL,
	`total vendida` DECIMAL(32,0) NULL,
	`ganancia` DECIMAL(32,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.report_gananciaxproducto
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `report_gananciaxproducto` (
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`descripcion` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`stock` INT(11) NULL,
	`inversion` DECIMAL(10,2) NULL,
	`vendida` INT(11) NULL,
	`ganancia` DECIMAL(10,2) NULL,
	`gananciatot` DECIMAL(11,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista sig.report_historico
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `report_historico` (
	`Producto` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`Categoria` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`Tipo Producto` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`Precio` DECIMAL(10,2) NULL,
	`Cantidad` INT(11) NULL,
	`Precio Total` DECIMAL(10,2) NULL,
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
INSERT IGNORE INTO `rol` (`ID_rol`, `tip_rol`) VALUES
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

-- Volcando estructura para procedimiento sig.sp_val_REORDEN
DELIMITER //
CREATE PROCEDURE `sp_val_REORDEN`()
begin
	SET SQL_SAFE_UPDATES=0;
	UPDATE LOW_PRIORITY IGNORE ganancia_perdida 
	set reorden = case 
    when cantidad_cp < cant_min then 1
    when cantidad_cp >= cant_min then 0 end;
end//
DELIMITER ;

-- Volcando estructura para tabla sig.sucursal
CREATE TABLE IF NOT EXISTS `sucursal` (
  `ID_sucursal` int(11) NOT NULL,
  `nombre_sucursal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `perfil_sucursal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_sucursal`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.sucursal: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT IGNORE INTO `sucursal` (`ID_sucursal`, `nombre_sucursal`, `perfil_sucursal`) VALUES
	(1, 'Supermercado Fuerte', '../public/img/fuerte.png'),
	(2, 'Supermercado Rey', '../public/img/rey.png'),
	(3, 'Supermercado Extra', '../Assets/xtra.png'),
	(4, 'Super 99', '../public/img/super99.png');
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;

-- Volcando estructura para tabla sig.tipo_producto
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `ID_prod` int(11) NOT NULL,
  `tipo_prod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.tipo_producto: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT IGNORE INTO `tipo_producto` (`ID_prod`, `tipo_prod`) VALUES
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
  `ID_local_scr` int(11) DEFAULT NULL,
  `ID_nombre` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_user`) USING BTREE,
  UNIQUE KEY `ID_nombre` (`ID_nombre`),
  KEY `ID_rol` (`ID_rol`),
  KEY `ID_sucursal` (`ID_sucursal`),
  KEY `FK_local_scr` (`ID_local_scr`),
  CONSTRAINT `FK_local_scr` FOREIGN KEY (`ID_local_scr`) REFERENCES `local_scr` (`ID_local_src`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`ID_rol`) REFERENCES `rol` (`ID_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_sig.nombre_completo` FOREIGN KEY (`ID_nombre`) REFERENCES `nombre_completo` (`ID_nombre`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ID_sucursal` FOREIGN KEY (`ID_sucursal`) REFERENCES `sucursal` (`ID_sucursal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.usuario: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT IGNORE INTO `usuario` (`ID_user`, `pass`, `email`, `celular`, `token`, `ID_rol`, `ID_sucursal`, `ID_local_scr`, `ID_nombre`) VALUES
	(1, '40001', 'manuelj@outlook.com', '63086641', '5fb0b28b94ee1', 1, 1, 1, 1),
	(2, '40002', 'oliveiro20@outlook.com', '61274020', '5fb33184266b8', 2, 3, 8, 2),
	(3, '40003', 'evelyn19@gmail.com', '62440076', '5faf60aa57151', 5, 2, 4, 3),
	(4, '40004', 'kevinsa18@gmail.com', '63069163', '5faf60ba016ae', 4, 4, 12, 4),
	(5, '40005', 'domvairon15@outlook.com', '64161333', '5faf60cca11ab', 3, 2, 7, 5),
	(6, '40006', 'arnoldo96@gmail.com', '66804618', '5faf60e2351ae', 3, 3, 9, 6),
	(7, '40007', 'robert07@outlook.com', '6787290', NULL, 3, 2, 5, 7);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sig.venta
CREATE TABLE IF NOT EXISTS `venta` (
  `ID_venta` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_solicitada` int(11) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ID_inv` int(11) DEFAULT NULL,
  `ID_local_scr` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_venta`),
  KEY `FK_venta_inventario` (`ID_inv`),
  KEY `FK_sucursal` (`ID_local_scr`) USING BTREE,
  CONSTRAINT `FK_venta_inventario` FOREIGN KEY (`ID_inv`) REFERENCES `inventario` (`ID_inv`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_venta_scr` FOREIGN KEY (`ID_local_scr`) REFERENCES `local_scr` (`ID_local_src`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sig.venta: ~27 rows (aproximadamente)
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT IGNORE INTO `venta` (`ID_venta`, `cantidad_solicitada`, `precio_total`, `fecha`, `ID_inv`, `ID_local_scr`) VALUES
	(1, 100, 250.00, '2020-11-10', 4, 4),
	(2, 70, 56.00, '2020-11-10', 5, 3),
	(3, 100, 80.00, '2020-11-10', 11, 1),
	(4, 50, 375.00, '2020-11-10', 28, 2),
	(5, 100, 1600.00, '2020-11-10', 33, 4),
	(6, 55, 467.00, '2020-11-10', 63, 3),
	(7, 30, 24.00, '2020-10-13', 5, 3),
	(8, 40, 32.00, '2020-09-16', 5, 1),
	(9, 10, 8.00, '2020-08-16', 5, 2),
	(10, 60, 48.00, '2020-07-16', 5, 4),
	(11, 10, NULL, '2020-12-17', 1, 1),
	(12, 10, NULL, '2020-12-17', 1, 1),
	(13, 10, NULL, '2020-12-17', 1, 1),
	(14, 10, NULL, '2020-12-17', 1, 1),
	(15, 10, NULL, '2020-12-17', 1, 1),
	(16, 10, NULL, '2020-12-17', 1, 1),
	(17, 5, NULL, '2020-12-17', 1, NULL),
	(18, 5, NULL, '2020-12-17', 1, NULL),
	(19, 5, NULL, '2020-12-17', 1, NULL),
	(20, 5, NULL, '2020-12-17', 1, NULL),
	(21, 10, NULL, '2020-12-17', 1, 7),
	(22, 200, NULL, '2020-12-17', 1, 7),
	(23, 15, NULL, '2020-12-17', 1, 7),
	(24, 10, NULL, '2020-12-17', 25, 1),
	(25, 10, 8.00, '2020-12-17', 1, 1),
	(26, 12, 9.60, '2020-12-17', 1, 1),
	(27, 20, 16.00, '2020-12-17', 1, 1);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para vista sig.view_venta
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `view_venta` (
	`codigo` INT(11) NOT NULL,
	`cod_inv` INT(11) NOT NULL,
	`nombre` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`empresa` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`pedido` INT(11) NULL,
	`total` DECIMAL(10,2) NULL
) ENGINE=MyISAM;

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
	`ubicacion` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
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
local_scr.ubicacion AS 'ubicación',
inventario.nombre AS 'producto',
venta.cantidad_solicitada AS 'cantidad',
venta.precio_total AS 'precio total',
venta.fecha AS 'fecha' 
FROM sucursal
JOIN local_scr ON sucursal.ID_sucursal = local_scr.ID_scr
JOIN inventario ON sucursal.ID_sucursal= inventario.ID_inv
JOIN venta ON sucursal.ID_sucursal=venta.ID_venta 
ORDER BY venta.cantidad_solicitada DESC ;

-- Volcando estructura para vista sig.cliente_prov
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cliente_prov`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cliente_prov` AS SELECT 
sucursal.nombre_sucursal AS 'Sucursal',
local_scr.ubicacion AS 'Ubicacion',
provincia.nombre_prov AS 'Provincia',
inventario.nombre AS 'Producto',
venta.cantidad_solicitada AS 'Cantidad',
venta.precio_total AS 'Costo Total',
venta.fecha AS 'Fecha' 
FROM sucursal
JOIN local_scr ON sucursal.ID_sucursal = local_scr.ID_scr
JOIN provincia ON local_scr.ID_prov = provincia.ID_prov
JOIN inventario ON sucursal.ID_sucursal = inventario.ID_inv
JOIN venta ON sucursal.ID_sucursal= venta.ID_venta 
ORDER BY venta.cantidad_solicitada DESC ;

-- Volcando estructura para vista sig.gp_globles
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `gp_globles`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `gp_globles` AS SELECT 
	inv.nombre AS "nombre",
    gp.cantidad_cp as "cant stock",
    gp.inversion as "inversion",
    gp.precio_vt as "precio",
    gp.cantidad_vd as "cant vendida",
	gp.ganancia AS "ganancia"
FROM 
	inventario AS inv
	INNER JOIN  ganancia_perdida AS gp ON inv.ID_inv = gp.ID_inv ;

-- Volcando estructura para vista sig.inventario_segmentado
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `inventario_segmentado`;
CREATE ALGORITHM=TEMPTABLE SQL SECURITY DEFINER VIEW `inventario_segmentado` AS SELECT 
tipo_producto.tipo_prod AS Producto,
descripcion.`desc` AS 'Descripcion',
inventario.nombre AS Nombre,
ganancia_perdida.precio_vt AS Precio,
ganancia_perdida.cantidad_cp AS Stock
FROM inventario
JOIN ganancia_perdida ON inventario.ID_inv = ganancia_perdida.ID_inv
JOIN tipo_producto ON inventario.ID_tipo = tipo_producto.ID_prod
JOIN descripcion ON inventario.ID_desc= descripcion.ID_desc ;

-- Volcando estructura para vista sig.inv_global
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `inv_global`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `inv_global` AS SELECT 
inventario.nombre AS  Nombre, 
ganancia_perdida.precio_vt AS precio, 
ganancia_perdida.cantidad_vd AS cantidad_vd, 
descripcion.`desc` AS descripcion, 
tipo_producto.tipo_prod AS tipo
FROM inventario
JOIN ganancia_perdida ON inventario.ID_inv = ganancia_perdida.ID_inv 
JOIN descripcion ON inventario.ID_desc = descripcion.ID_desc
JOIN tipo_producto ON  inventario.ID_tipo = tipo_producto.ID_prod ;

-- Volcando estructura para vista sig.obtener_infoproducto
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `obtener_infoproducto`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `obtener_infoproducto` AS SELECT precio_cp,cantidad_cp,inversion,precio_vt,cantidad_vd,ganancia,cant_min,reorden,inv.nombre,des.`desc` AS 'descripcions',tp.tipo_prod
FROM ganancia_perdida 
INNER JOIN inventario AS inv ON ganancia_perdida.ID_inv = inv.ID_inv
INNER JOIN descripcion AS des ON inv.ID_desc = des.ID_desc
INNER JOIN tipo_producto AS tp ON inv.ID_tipo = tp.ID_prod ;

-- Volcando estructura para vista sig.productos_emp
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `productos_emp`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `productos_emp` AS SELECT  
	INV.id_inv as "ID", 
	INV.nombre, 
	GP.cantidad_cp AS "cantidad", 
	DSC.desc as "descripcion", 
	TPO.tipo_prod as "tipo", 
	GP.precio_vt AS "precio",
	GP.reorden AS "reorden" 
from inventario as INV 
	INNER JOIN ganancia_perdida AS GP ON INV.ID_inv = GP.ID_inv
	inner join descripcion as DSC on INV.ID_desc = DSC.ID_desc 
	inner join tipo_producto as TPO  on INV.ID_tipo = TPO.ID_prod ;

-- Volcando estructura para vista sig.report_clienteprov
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_clienteprov`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_clienteprov` AS SELECT 
sucursal.nombre_sucursal AS 'sucursal',
local_scr.ubicacion AS 'ubicacion',
provincia.nombre_prov AS 'provincia',
local_scr.telf AS 'telefono'
FROM sucursal
JOIN local_scr ON sucursal.ID_sucursal = local_scr.ID_scr
JOIN provincia ON local_scr.ID_prov= provincia.ID_prov ;

-- Volcando estructura para vista sig.report_gananciagloabl
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_gananciagloabl`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_gananciagloabl` AS SELECT 
    tp.tipo_prod as 'categoria',
    sum(gp.cantidad_cp) AS 'total producto',    
    sum(gp.inversion) as 'total inversion',
	sum(gp.cantidad_vd) AS 'total vendida', 
    sum(gp.ganancia) as 'ganancia'
FROM 
	ganancia_perdida AS gp
	INNER JOIN inventario AS iv ON gp.Id_inv = iv.ID_inv
	INNER JOIN tipo_producto AS tp ON iv.ID_tipo = tp.ID_prod 
group by tp.tipo_prod ;

-- Volcando estructura para vista sig.report_gananciaxproducto
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_gananciaxproducto`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_gananciaxproducto` AS SELECT 
	INV.nombre AS nombre, 
    des.desc as 'descripcion',
    gp.cantidad_cp AS 'stock',     
    gp.inversion as 'inversion',
	gp.cantidad_vd AS 'vendida', 
    gp.ganancia as 'ganancia',
    (gp.ganancia - gp.inversion ) as 'gananciatot'
FROM ganancia_perdida AS gp
	INNER JOIN inventario AS INV ON gp.Id_inv = INV.ID_inv
	INNER JOIN descripcion AS des ON INV.ID_desc = des.ID_desc ;

-- Volcando estructura para vista sig.report_historico
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `report_historico`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `report_historico` AS SELECT 
inventario.nombre AS Producto,
tipo_producto.tipo_prod AS Categoria,
descripcion.`desc` AS 'Tipo Producto',
ganancia_perdida.precio_vt AS Precio,
venta.cantidad_solicitada AS Cantidad,
venta.precio_total 'Precio Total',
venta.fecha AS Fecha,
sucursal.nombre_sucursal AS Supermercado,
local_scr.ubicacion AS Lugar,
provincia.nombre_prov AS Sede

FROM inventario
JOIN ganancia_perdida ON inventario.ID_inv = ganancia_perdida.ID_inv
JOIN tipo_producto ON inventario.ID_tipo = tipo_producto.ID_prod
JOIN descripcion ON inventario.ID_desc = descripcion.ID_desc
JOIN venta ON inventario.ID_inv = venta.ID_inv
JOIN local_scr ON venta.ID_local_scr = local_scr.ID_local_src
JOIN sucursal ON local_scr.ID_scr = sucursal.ID_sucursal
JOIN provincia ON local_scr.ID_prov = provincia.ID_prov 
ORDER BY inventario.nombre ;

-- Volcando estructura para vista sig.view_venta
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `view_venta`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_venta` AS Select 
	vt.ID_venta as 'codigo',
    iv.ID_inv as 'cod_inv',
    iv.nombre as 'nombre',
    sc.nombre_sucursal as 'empresa',
    ls.ubicacion as 'ubicacion',
    vt.cantidad_solicitada as 'pedido',
    vt.precio_total as 'total'
from 
	venta as vt 
    inner join inventario as iv on vt.ID_inv = iv.ID_inv
    inner join usuario as ur on ur.ID_local_scr = vt.ID_local_scr
    inner join local_scr as ls on ls.ID_local_src = ur.ID_local_scr
    inner join sucursal as sc on sc.ID_sucursal = ls.ID_scr ;

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
	local_scr.ubicacion AS 	ubicacion,
	usuario.pass AS contra,
	rol.tip_rol AS rol,
	rol.ID_rol AS id_rol
	FROM usuario
	JOIN nombre_completo ON usuario.ID_user = nombre_completo.ID_nombre
	JOIN rol ON usuario.ID_rol = rol.ID_rol
	JOIN local_scr ON  usuario.ID_local_scr = local_scr.ID_local_src
	JOIN sucursal ON usuario.ID_sucursal = sucursal.ID_sucursal
	ORDER BY nombre_completo.ID_nombre ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
