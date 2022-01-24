/*
 Navicat Premium Data Transfer

 Source Server         : ConexionAND
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : db_finca

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 24/01/2022 05:27:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_baja
-- ----------------------------
DROP TABLE IF EXISTS `tb_baja`;
CREATE TABLE `tb_baja`  (
  `id_baja` int NOT NULL AUTO_INCREMENT,
  `fehca_baja` date NOT NULL,
  `descripcion_baja` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idexpeiente_baja` int NOT NULL,
  PRIMARY KEY (`id_baja`) USING BTREE,
  INDEX `fk_bajaExpediente`(`idexpeiente_baja`) USING BTREE,
  CONSTRAINT `fk_bajaExpediente` FOREIGN KEY (`idexpeiente_baja`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2021424757 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_baja
-- ----------------------------
INSERT INTO `tb_baja` VALUES (1, '2022-01-18', 'MUERTE NATURAL', 4);
INSERT INTO `tb_baja` VALUES (2, '2022-01-18', 'MUERTE NATURAL', 5);

-- ----------------------------
-- Table structure for tb_botellas
-- ----------------------------
DROP TABLE IF EXISTS `tb_botellas`;
CREATE TABLE `tb_botellas`  (
  `int_idbotella` int NOT NULL,
  `dat_fecha_vencimiento_botella` date NULL DEFAULT NULL,
  `int_cantidad` int NULL DEFAULT NULL,
  `int_idproducto` int NULL DEFAULT NULL,
  `dou_costo_botella` double(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`int_idbotella`) USING BTREE,
  INDEX `fk_producto`(`int_idproducto`) USING BTREE,
  CONSTRAINT `fk_producto` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_botellas
-- ----------------------------
INSERT INTO `tb_botellas` VALUES (1, '2022-01-20', 10, 1, 3.00);
INSERT INTO `tb_botellas` VALUES (2, '2022-01-31', 10, 2, 5.00);

-- ----------------------------
-- Table structure for tb_cargo
-- ----------------------------
DROP TABLE IF EXISTS `tb_cargo`;
CREATE TABLE `tb_cargo`  (
  `idcargo` int NOT NULL AUTO_INCREMENT,
  `nva_nom_cargo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idcargo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 202112355 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_cargo
-- ----------------------------
INSERT INTO `tb_cargo` VALUES (1, 'Administrador de Sistema');
INSERT INTO `tb_cargo` VALUES (2, 'Vaquero Ordeñador a Máquina');
INSERT INTO `tb_cargo` VALUES (3, 'Granjero');

-- ----------------------------
-- Table structure for tb_categoria
-- ----------------------------
DROP TABLE IF EXISTS `tb_categoria`;
CREATE TABLE `tb_categoria`  (
  `int_idcategoria` int NOT NULL AUTO_INCREMENT,
  `nva_nom_categoria` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idcategoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_categoria
-- ----------------------------
INSERT INTO `tb_categoria` VALUES (1, 'DERIVADOS DE LECHE');
INSERT INTO `tb_categoria` VALUES (2, 'MEDICAMENTOS');
INSERT INTO `tb_categoria` VALUES (3, 'INSUMOS');

-- ----------------------------
-- Table structure for tb_clientes
-- ----------------------------
DROP TABLE IF EXISTS `tb_clientes`;
CREATE TABLE `tb_clientes`  (
  `int_idcliente` int NOT NULL AUTO_INCREMENT,
  `nva_dui_cliente` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_nom_cliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_ape_cliente` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `txt_direc_cliente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nva_telefono_cliente` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_estado_cliente` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idcliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_clientes
-- ----------------------------
INSERT INTO `tb_clientes` VALUES (1, NULL, 'Consumidor Final', NULL, NULL, NULL, 'Activo');
INSERT INTO `tb_clientes` VALUES (2, '05592129-3', 'Fabricio', 'Corvera', 'Santo Domingo', '6300-3455', 'Activo');
INSERT INTO `tb_clientes` VALUES (3, '32423423-4', 'Cluadia Yoselin', 'Rivas Arévalo', 'San Ildefonso', '7894-5613', 'Activo');
INSERT INTO `tb_clientes` VALUES (4, '78945654-6', 'José Hernán', 'Barahona Ayala', 'San Vicente', '6598-7845', 'Activo');
INSERT INTO `tb_clientes` VALUES (5, '12345678-9', 'Rolando Moisés', 'Corvera Mejía', 'Santo Domingo, San Vicente', '7564-8796', 'Activo');
INSERT INTO `tb_clientes` VALUES (6, '36987456-9', 'Rosa Excela', 'Mejía de Corvera', 'Santo Domingo', '7762-3675', 'Activo');
INSERT INTO `tb_clientes` VALUES (7, '65956234-4', 'Fabri', 'Mejía', 'Santo Domingo', '7030-4095', 'inactivo');

-- ----------------------------
-- Table structure for tb_compra
-- ----------------------------
DROP TABLE IF EXISTS `tb_compra`;
CREATE TABLE `tb_compra`  (
  `int_idcompra` int NOT NULL AUTO_INCREMENT,
  `txt_descrip_compra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dou_total_compra` double(8, 2) NOT NULL,
  `dou_iva_aplicado` double(8, 2) NULL DEFAULT NULL,
  `dat_fecha_compra` datetime NOT NULL,
  `dat_fecha_sistema` datetime NOT NULL,
  `nva_tipo_documento` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nva_numero_documento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `txt_sitio_compra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `int_idproveedor` int NOT NULL,
  `int_idempleado` int NOT NULL,
  PRIMARY KEY (`int_idcompra`) USING BTREE,
  INDEX `idempleado_fk`(`int_idempleado`) USING BTREE,
  INDEX `idproveedor_fk`(`int_idproveedor`) USING BTREE,
  CONSTRAINT `idempleado_fk` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idproveedor_fk` FOREIGN KEY (`int_idproveedor`) REFERENCES `tb_proveedor` (`int_idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202159012 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_compra
-- ----------------------------
INSERT INTO `tb_compra` VALUES (1, 'Compra de Muestra', 1.25, 0.00, '2022-01-05 10:15:07', '2022-01-05 22:16:49', 'Factura', '123154', 'n/a', 2, 1);
INSERT INTO `tb_compra` VALUES (2, 'Nueva Compra de Medicamentos', 48.04, 5.53, '2022-01-11 01:16:33', '2022-01-07 01:20:15', 'Crédito Fiscal', '000001', 'n/a', 1, 2);
INSERT INTO `tb_compra` VALUES (3, 'Nueva Compra de Bovinos', 16.01, 1.84, '2022-01-11 01:47:35', '2022-01-11 01:49:48', 'Crédito Fiscal', '000002', 'n/a', 3, 2);
INSERT INTO `tb_compra` VALUES (4, 'Nueva Compra para reporte', 2.25, 0.00, '2022-01-12 12:05:11', '2022-01-12 00:06:25', 'Factura', '000003', 'n/a', 1, 2);
INSERT INTO `tb_compra` VALUES (5, 'Nueva Compra de Insumos', 61.00, 0.00, '2022-01-08 06:00:41', '2022-01-18 08:39:31', 'Factura', '256987', 'n/a', 1, 3);
INSERT INTO `tb_compra` VALUES (6, 'Nueva Compra Crédito Fiscal', 300.00, 34.51, '2022-01-19 01:00:06', '2022-01-22 00:26:07', 'Crédito Fiscal', '002326', 'n/a', 1, 2);
INSERT INTO `tb_compra` VALUES (7, 'Nueva Compra de Insumos-Agua', 100.00, 0.00, '2022-01-19 10:30:40', '2022-01-22 00:53:43', 'Ticket', '000323', 'n/a', 3, 2);

-- ----------------------------
-- Table structure for tb_control_vacunas
-- ----------------------------
DROP TABLE IF EXISTS `tb_control_vacunas`;
CREATE TABLE `tb_control_vacunas`  (
  `int_id_control_vac` int NOT NULL,
  `dat_fecha_aplicacion` date NULL DEFAULT NULL,
  `nva_vacuna_aplicada` int NULL DEFAULT NULL,
  `id_exped_aplicado` int NULL DEFAULT NULL,
  `nva_dosis` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_id_control_vac`) USING BTREE,
  INDEX `tb_productos`(`nva_vacuna_aplicada`) USING BTREE,
  INDEX `tb_bovino`(`id_exped_aplicado`) USING BTREE,
  CONSTRAINT `tb_bovino` FOREIGN KEY (`id_exped_aplicado`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_productos` FOREIGN KEY (`nva_vacuna_aplicada`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_control_vacunas
-- ----------------------------
INSERT INTO `tb_control_vacunas` VALUES (1, '2022-01-01', 7, 3, '1ML');
INSERT INTO `tb_control_vacunas` VALUES (2, '2022-01-10', 8, 2, '2ML');
INSERT INTO `tb_control_vacunas` VALUES (3, '2022-01-16', 7, 1, '1ML');
INSERT INTO `tb_control_vacunas` VALUES (4, '2022-01-10', 10, 2, '1ML');
INSERT INTO `tb_control_vacunas` VALUES (5, '2022-01-18', 7, 5, '2ML');

-- ----------------------------
-- Table structure for tb_detalle_compra
-- ----------------------------
DROP TABLE IF EXISTS `tb_detalle_compra`;
CREATE TABLE `tb_detalle_compra`  (
  `int_iddcompra` int NOT NULL AUTO_INCREMENT,
  `int_cantidad_compra` int NOT NULL,
  `dou_costo_compra` double(8, 2) NOT NULL,
  `dou_subtotal_item_compra` double(8, 2) NOT NULL,
  `int_idproducto` int NULL DEFAULT NULL,
  `int_idcompra` int NULL DEFAULT NULL,
  `int_idexpediente` int NULL DEFAULT NULL,
  PRIMARY KEY (`int_iddcompra`) USING BTREE,
  INDEX `idproducto`(`int_idproducto`) USING BTREE,
  INDEX `idcompra`(`int_idcompra`) USING BTREE,
  INDEX `idexpediente`(`int_idexpediente`) USING BTREE,
  CONSTRAINT `fk_tbexpediente` FOREIGN KEY (`int_idexpediente`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_compra_ibfk_1` FOREIGN KEY (`int_idcompra`) REFERENCES `tb_compra` (`int_idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_compra_ibfk_2` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2021074711 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_detalle_compra
-- ----------------------------
INSERT INTO `tb_detalle_compra` VALUES (1, 1, 1.25, 1.25, 1, 1, NULL);
INSERT INTO `tb_detalle_compra` VALUES (2, 3, 6.20, 18.60, 3, 2, NULL);
INSERT INTO `tb_detalle_compra` VALUES (3, 3, 7.97, 23.91, 4, 2, NULL);
INSERT INTO `tb_detalle_compra` VALUES (4, 3, 7.00, 21.00, 5, 5, NULL);
INSERT INTO `tb_detalle_compra` VALUES (5, 3, 0.75, 2.25, 3, 4, NULL);
INSERT INTO `tb_detalle_compra` VALUES (6, 1, 265.49, 265.49, NULL, 6, 3);
INSERT INTO `tb_detalle_compra` VALUES (7, 2, 50.00, 100.00, 4, 7, NULL);

-- ----------------------------
-- Table structure for tb_detalle_venta
-- ----------------------------
DROP TABLE IF EXISTS `tb_detalle_venta`;
CREATE TABLE `tb_detalle_venta`  (
  `int_iddventa` int NOT NULL AUTO_INCREMENT,
  `int_cantidad_vender` int NULL DEFAULT NULL,
  `dou_precio_venta` double(8, 2) NULL DEFAULT NULL,
  `dou_subtotal_item_vender` double(8, 2) NULL DEFAULT NULL,
  `int_idproducto` int NULL DEFAULT NULL,
  `int_idexpediente` int NULL DEFAULT NULL,
  `int_idventa` int NULL DEFAULT NULL,
  PRIMARY KEY (`int_iddventa`) USING BTREE,
  INDEX `idventa`(`int_idventa`) USING BTREE,
  INDEX `tb_producto`(`int_idproducto`) USING BTREE,
  INDEX `fk_expediente`(`int_idexpediente`) USING BTREE,
  CONSTRAINT `fk_expediente` FOREIGN KEY (`int_idexpediente`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_venta_ibfk_1` FOREIGN KEY (`int_idventa`) REFERENCES `tb_venta` (`int_idventa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tb_producto` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_detalle_venta
-- ----------------------------
INSERT INTO `tb_detalle_venta` VALUES (1, 30, 1.11, 33.30, 9, NULL, 1);
INSERT INTO `tb_detalle_venta` VALUES (2, 1, 456.00, 456.00, NULL, 4, 2);
INSERT INTO `tb_detalle_venta` VALUES (3, 1, 442.48, 442.48, NULL, 7, 3);
INSERT INTO `tb_detalle_venta` VALUES (4, 5, 1.25, 6.25, 9, NULL, 4);

-- ----------------------------
-- Table structure for tb_empleado
-- ----------------------------
DROP TABLE IF EXISTS `tb_empleado`;
CREATE TABLE `tb_empleado`  (
  `int_idempleado` int NOT NULL AUTO_INCREMENT,
  `nva_dui_empledao` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_nom_empleado` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_ape_empleado` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `txt_direc_empleado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `dat_fechanaci_empleado` date NULL DEFAULT NULL,
  `dou_salario_empleado` double NULL DEFAULT NULL,
  `nva_telefono_empleado` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_email_empleado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `int_idcargo` int NULL DEFAULT NULL,
  `nva_estado_empleado` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_sexo_empleado` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idempleado`) USING BTREE,
  INDEX `idcargo`(`int_idcargo`) USING BTREE,
  CONSTRAINT `fk_idcargo` FOREIGN KEY (`int_idcargo`) REFERENCES `tb_cargo` (`idcargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202152262 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_empleado
-- ----------------------------
INSERT INTO `tb_empleado` VALUES (1, '98654578-9', 'Katherine Lorena', 'Peña Sigüenza', 'Cantón las Flores, municipio de Cojutepeque, departamento de Cuscatlán', '1998-03-26', 350, '7856-5139', 'cm16057@ues.edu.sv', 1, 'Activo', 'Femenino');
INSERT INTO `tb_empleado` VALUES (2, '12345678-9', 'Fabricio', 'Corvera', 'Santo Domingo, San Vicente', '1997-09-27', 350, '6300-3455', 'fabricio@gmail.com', 1, 'Activo', 'Masculino');
INSERT INTO `tb_empleado` VALUES (3, '98756321-3', 'José Hernán', 'Barahona Ayala', 'Colonia las Flores, Estado Municipal, San Vicente', '1997-12-11', 3000, '7825-9865', 'fabricio.corvera.9@gmail.com', 1, 'Activo', 'Masculino');

-- ----------------------------
-- Table structure for tb_expediente
-- ----------------------------
DROP TABLE IF EXISTS `tb_expediente`;
CREATE TABLE `tb_expediente`  (
  `int_idexpediente` int NOT NULL AUTO_INCREMENT,
  `nva_nom_bovino` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_estado_bovino` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_carta_venta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_sexo_bovino` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `int_cant_parto` int NULL DEFAULT NULL,
  `txt_descrip_expediente` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `int_id_propietario` int NULL DEFAULT NULL,
  `int_idraza` int NULL DEFAULT NULL,
  `nva_foto_bovino` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_tipo_bovino` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dat_fecha_ult_parto` date NULL DEFAULT NULL,
  `dou_costo_bovino` double(8, 2) NULL DEFAULT NULL,
  `dou_precio_venta_bovino` double(8, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`int_idexpediente`) USING BTREE,
  INDEX `fk_propietario`(`int_id_propietario`) USING BTREE,
  INDEX `fk_raza`(`int_idraza`) USING BTREE,
  CONSTRAINT `fk_propietario` FOREIGN KEY (`int_id_propietario`) REFERENCES `tb_propietario` (`int_id_propietario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_raza` FOREIGN KEY (`int_idraza`) REFERENCES `tb_raza` (`int_idraza`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_expediente
-- ----------------------------
INSERT INTO `tb_expediente` VALUES (1, 'TRAILERA', 'preñada', '../archivo_carta_venta/imgcarta_1.jpg', 'femenino', 2, 'UNA VACA PRIETA SARDA', 1, 1, '../archivo_expdiente/imgfoto_1.jpeg', 'vaca_lechera', '2021-11-23', 567.00, 567.00);
INSERT INTO `tb_expediente` VALUES (2, 'DUQUESA', 'activo', '../archivo_carta_venta/imgcarta_2.jpg', 'femenino', 2, 'VACA CARETA CRIOLLA', 1, 1, '../archivo_expdiente/imgfoto_2.jpeg', 'vaca_lechera', '2021-09-06', 707.96, 789.00);
INSERT INTO `tb_expediente` VALUES (3, 'ESTRELLA', 'activo', '../archivo_carta_venta/imgcarta_3.jpg', 'femenino', NULL, 'TERNERITA PINTA', 1, 1, '../archivo_expdiente/imgfoto_3.jpeg', 'novia', NULL, 265.49, 567.00);
INSERT INTO `tb_expediente` VALUES (4, 'ANDALON', 'vendido', '../archivo_carta_venta/imgcarta_4.jpg', 'femenino', NULL, 'TERNERO CARETO', 1, 1, '../archivo_expdiente/imgfoto_4.jpg', 'ternero', NULL, 234.00, 456.00);
INSERT INTO `tb_expediente` VALUES (5, 'PATOJA', 'inactivo', '../archivo_carta_venta/imgcarta_5.jpg', 'femenino', 2, 'UNA VACA PINTA ', 1, 1, '../archivo_expdiente/imgfoto_5.jpeg', 'vaca_lechera', '2022-01-18', 456.00, 678.00);
INSERT INTO `tb_expediente` VALUES (6, 'COLORINA', 'activo', '../archivo_carta_venta/imgcarta_6.jpg', 'femenino', NULL, 'TERNERITO PARCHADO', 1, 1, '../archivo_expdiente/imgfoto_6.jpg', 'ternero', NULL, 707.96, 678.00);
INSERT INTO `tb_expediente` VALUES (7, 'BICICLETA', 'vendido', '../archivo_carta_venta/imgcarta_7.jpg', 'femenino', 1, 'De cabos hacia abajo', 1, 1, '../archivo_expdiente/imgfoto_7.jpeg', 'vaca_lechera', '2022-01-08', 300.00, 500.00);

-- ----------------------------
-- Table structure for tb_gastos
-- ----------------------------
DROP TABLE IF EXISTS `tb_gastos`;
CREATE TABLE `tb_gastos`  (
  `int_idgastos` int NOT NULL AUTO_INCREMENT,
  `dat_fecha_gasto` datetime NULL DEFAULT NULL,
  `int_idproducto` int NULL DEFAULT NULL,
  `int_cantidad_gastar` int NULL DEFAULT NULL,
  `nva_estado_gasto` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idgastos`) USING BTREE,
  INDEX `fk_tb_productos`(`int_idproducto`) USING BTREE,
  CONSTRAINT `fk_tb_productos` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_gastos
-- ----------------------------
INSERT INTO `tb_gastos` VALUES (1, '2022-01-05 06:00:30', 3, 5, 'Activo');
INSERT INTO `tb_gastos` VALUES (2, '2022-01-16 06:00:30', 3, 3, 'Activo');
INSERT INTO `tb_gastos` VALUES (3, '2022-01-17 12:30:19', 3, 3, 'Activo');
INSERT INTO `tb_gastos` VALUES (4, '2022-01-17 10:02:03', 2, 5, 'anulado');
INSERT INTO `tb_gastos` VALUES (5, '2022-01-13 02:00:24', 8, 5, 'anulado');

-- ----------------------------
-- Table structure for tb_natalidad
-- ----------------------------
DROP TABLE IF EXISTS `tb_natalidad`;
CREATE TABLE `tb_natalidad`  (
  `int_id_natalidad` int NOT NULL AUTO_INCREMENT,
  `dat_fecha_nacimiento` date NOT NULL,
  `int_id_expe_madre` int NOT NULL,
  `int_id_expe_ternero` int NOT NULL,
  PRIMARY KEY (`int_id_natalidad`) USING BTREE,
  INDEX `fk_madre`(`int_id_expe_madre`) USING BTREE,
  INDEX `fk_hijo`(`int_id_expe_ternero`) USING BTREE,
  CONSTRAINT `fk_hijo` FOREIGN KEY (`int_id_expe_ternero`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_madre` FOREIGN KEY (`int_id_expe_madre`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2021523134 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_natalidad
-- ----------------------------
INSERT INTO `tb_natalidad` VALUES (1, '2022-01-18', 5, 3);

-- ----------------------------
-- Table structure for tb_preñez
-- ----------------------------
DROP TABLE IF EXISTS `tb_preñez`;
CREATE TABLE `tb_preñez`  (
  `int_id_preñez` int NOT NULL AUTO_INCREMENT,
  `int_bovino_fk` int NULL DEFAULT NULL,
  `dat_fecha_monta` date NULL DEFAULT NULL,
  `dat_fecha_parto` date NULL DEFAULT NULL,
  `dat_fecha_celo` date NULL DEFAULT NULL,
  PRIMARY KEY (`int_id_preñez`) USING BTREE,
  INDEX `fk_expdt`(`int_bovino_fk`) USING BTREE,
  CONSTRAINT `fk_expdt` FOREIGN KEY (`int_bovino_fk`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 202156247 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_preñez
-- ----------------------------
INSERT INTO `tb_preñez` VALUES (1, 1, '2021-05-18', '2022-02-18', '2021-05-17');
INSERT INTO `tb_preñez` VALUES (2, 5, '2021-04-18', '2022-01-18', '2021-04-17');

-- ----------------------------
-- Table structure for tb_producto
-- ----------------------------
DROP TABLE IF EXISTS `tb_producto`;
CREATE TABLE `tb_producto`  (
  `int_idproducto` int NOT NULL AUTO_INCREMENT,
  `nva_nom_producto` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `int_existencia` int NULL DEFAULT NULL,
  `dou_costo_producto` double(8, 2) NULL DEFAULT NULL,
  `dou_precio_venta_producto` double(8, 2) NULL DEFAULT NULL,
  `nva_image_producto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `txt_descrip_producto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `dat_fecha_vencimiento` date NULL DEFAULT NULL,
  `int_idcategoria` int NULL DEFAULT NULL,
  `nva_estado_producto` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `int_existencia_minima` int NULL DEFAULT NULL,
  PRIMARY KEY (`int_idproducto`) USING BTREE,
  INDEX `idcategoria`(`int_idcategoria`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`int_idcategoria`) REFERENCES `tb_categoria` (`int_idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202152272 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_producto
-- ----------------------------
INSERT INTO `tb_producto` VALUES (1, 'Crema', 30, 2.50, 3.50, '../archivo_producto/img_1.jpg', 'Especial', '2022-01-31', 1, 'Activo', NULL);
INSERT INTO `tb_producto` VALUES (2, 'Quesillo', 25, 3.50, 4.00, '../archivo_producto/img_2.jpg', 'Especial', '2022-01-26', 1, 'Activo', NULL);
INSERT INTO `tb_producto` VALUES (3, 'Concentrado', 32, 23.00, NULL, '../archivo_producto/img_3.jpg', 'Para ganado Bovino', '2022-01-31', 3, 'Activo', 6);
INSERT INTO `tb_producto` VALUES (4, 'Agua ', 6, 30.00, NULL, '../archivo_producto/img_4.jpg', 'Agua galon', '2022-01-25', 3, 'Activo', 2);
INSERT INTO `tb_producto` VALUES (5, 'Sal', 8, 20.00, NULL, '../archivo_producto/img_5.jpg', 'Sal yodada', '2022-01-26', 3, 'Activo', 3);
INSERT INTO `tb_producto` VALUES (6, 'Gasolina', 30, 3.60, NULL, '../archivo_producto/img_6.jpg', 'Especial', '2022-01-27', 3, 'Activo', 6);
INSERT INTO `tb_producto` VALUES (7, 'Hexagan', 5, 30.00, NULL, '../archivo_producto/img_7.jpg', 'Para gripe de ganado bovino', '2022-01-31', 2, 'Activo', 2);
INSERT INTO `tb_producto` VALUES (8, 'Impulsor', 6, 20.00, NULL, '../archivo_producto/img_8.jpg', 'Para las pulgas del ganado', '2022-01-26', 2, 'Activo', 2);
INSERT INTO `tb_producto` VALUES (9, 'Botella de Leche', 45, 0.75, 1.25, '../archivo_producto/img_9.jpg', 'leche fresca', '2022-01-31', 1, 'Activo', NULL);
INSERT INTO `tb_producto` VALUES (10, 'Vacuna Aftogan', 10, 15.00, NULL, '../archivo_producto/img_10.jpg', 'Vacuna para el crecimiento del cabello', '2022-01-26', 2, 'Activo', 2);
INSERT INTO `tb_producto` VALUES (11, 'Queso', 5, 4.00, 5.00, '../archivo_producto/img_11.jpg', 'Queso duro especial', '2022-01-31', 1, 'activo', NULL);

-- ----------------------------
-- Table structure for tb_propietario
-- ----------------------------
DROP TABLE IF EXISTS `tb_propietario`;
CREATE TABLE `tb_propietario`  (
  `int_id_propietario` int NOT NULL AUTO_INCREMENT,
  `nva_dui_propietario` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nva_nombres_propietario` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nva_apellidos_propietario` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`int_id_propietario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_propietario
-- ----------------------------
INSERT INTO `tb_propietario` VALUES (1, '12345678-9', 'Fabricio', 'Corvera');

-- ----------------------------
-- Table structure for tb_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `tb_proveedor`;
CREATE TABLE `tb_proveedor`  (
  `int_idproveedor` int NOT NULL AUTO_INCREMENT,
  `nva_nom_proveedor` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `txt_direc_proveedor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nva_telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_nrc` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idproveedor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_proveedor
-- ----------------------------
INSERT INTO `tb_proveedor` VALUES (1, 'Salinera Turcios', 'san salvador', '7878-9898', '12345-6');
INSERT INTO `tb_proveedor` VALUES (2, 'Agroservicio El Frutal', 'san salvador', '7979-7878', '21213-4');
INSERT INTO `tb_proveedor` VALUES (3, 'Agua El Manantial', 'cuscatlan', '7373-2121', '31312-3');
INSERT INTO `tb_proveedor` VALUES (4, 'Finca Cuscatlán', 'cojutepeque', '6398-6598', '78932-4');

-- ----------------------------
-- Table structure for tb_raza
-- ----------------------------
DROP TABLE IF EXISTS `tb_raza`;
CREATE TABLE `tb_raza`  (
  `int_idraza` int NOT NULL AUTO_INCREMENT,
  `nva_nom_raza` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idraza`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_raza
-- ----------------------------
INSERT INTO `tb_raza` VALUES (1, 'holtein');

-- ----------------------------
-- Table structure for tb_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario`  (
  `int_idusuario` int NOT NULL AUTO_INCREMENT,
  `nva_nom_usuario` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nva_contraseña_usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `int_idempleado` int NULL DEFAULT NULL,
  `nva_fotografia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`int_idusuario`) USING BTREE,
  INDEX `fk_empleado`(`int_idempleado`) USING BTREE,
  CONSTRAINT `fk_empleado` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202138342 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_usuario
-- ----------------------------
INSERT INTO `tb_usuario` VALUES (1, 'admin', '$2y$10$YMb8RjgBNipfWkZ4yZUUFelEnfNtohFo18igHAhQTYslNjnt3wIA2', 1, '../img/usuarios/user_20224310431500000015_1.jpg');
INSERT INTO `tb_usuario` VALUES (2, 'fabri', '$2y$10$wWPMJbopzLmovVlNuLW70OML9BbNSeBsQ5MRkI1AsGKlNFzqBvJka', 2, '../img/usuarios/user_20214127414700000047_2.jpeg');
INSERT INTO `tb_usuario` VALUES (3, 'hernan', '$2y$10$rJ3nVoGeb/Xy6Ij5JkTj5eVcKcyNwYZUaty3YimeCid9yjedWq0qK', 3, '../img/usuarios/user_20220518051900000019_3.jpg');

-- ----------------------------
-- Table structure for tb_venta
-- ----------------------------
DROP TABLE IF EXISTS `tb_venta`;
CREATE TABLE `tb_venta`  (
  `int_idventa` int NOT NULL AUTO_INCREMENT,
  `dou_total_venta` double(8, 2) NOT NULL,
  `dou_iva_venta` double(8, 2) NULL DEFAULT NULL,
  `dat_fecha_venta` datetime NOT NULL,
  `dat_fecha_sistema_venta` datetime NOT NULL,
  `nva_tipo_documento` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `int_idempleado` int NOT NULL,
  `int_id_cliente` int NOT NULL,
  `int_num_doc` int NOT NULL,
  PRIMARY KEY (`int_idventa`) USING BTREE,
  INDEX `idusuario`(`int_idempleado`) USING BTREE,
  INDEX `tb_clientes_fk`(`int_id_cliente`) USING BTREE,
  CONSTRAINT `tb_clientes_fk` FOREIGN KEY (`int_id_cliente`) REFERENCES `tb_clientes` (`int_idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_empleado_fk` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_venta
-- ----------------------------
INSERT INTO `tb_venta` VALUES (1, 37.63, 4.33, '2022-01-18 08:46:17', '2022-01-18 08:49:03', 'Crédito Fiscal', 3, 5, 1);
INSERT INTO `tb_venta` VALUES (2, 456.00, 0.00, '2022-01-21 08:54:20', '2022-01-21 21:56:59', 'Factura', 2, 1, 2);
INSERT INTO `tb_venta` VALUES (3, 500.00, 0.00, '2022-01-21 10:20:16', '2022-01-21 22:33:06', 'Crédito Fiscal', 2, 1, 3);
INSERT INTO `tb_venta` VALUES (4, 6.25, 0.00, '2022-01-21 11:02:14', '2022-01-21 23:10:19', 'Ticket', 2, 1, 4);

SET FOREIGN_KEY_CHECKS = 1;
