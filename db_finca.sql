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

 Date: 13/01/2022 20:25:29
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
INSERT INTO `tb_categoria` VALUES (2, 'BOVINOS');
INSERT INTO `tb_categoria` VALUES (3, 'MEDICINA');
INSERT INTO `tb_categoria` VALUES (4, 'INSUMOS');

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
INSERT INTO `tb_clientes` VALUES (2, NULL, 'Cliente Frecuente', NULL, NULL, NULL, 'Activo');
INSERT INTO `tb_clientes` VALUES (4, '05592129-3', 'Fabri', 'Corvera', 'Santo Domingo', '6300-3455', 'Activo');
INSERT INTO `tb_clientes` VALUES (8, '05966849-9', 'Moisés', 'Corvera', 'Santo Domingo', '7365-7821', 'Activo');
INSERT INTO `tb_clientes` VALUES (27, '98765432-1', 'Claudia', 'Rivas', 'San Ildefonso', '2235-2257', 'Inactivo');

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

-- ----------------------------
-- Table structure for tb_control_vacunas
-- ----------------------------
DROP TABLE IF EXISTS `tb_control_vacunas`;
CREATE TABLE `tb_control_vacunas`  (
  `int_id_control_vac` int NOT NULL,
  `dat_fecha_aplicacion` date NULL DEFAULT NULL,
  `nva_vacuna_aplicada` int NULL DEFAULT NULL,
  `id_exped_aplicado` int NULL DEFAULT NULL,
  PRIMARY KEY (`int_id_control_vac`) USING BTREE,
  INDEX `tb_productos`(`nva_vacuna_aplicada`) USING BTREE,
  INDEX `tb_bovino`(`id_exped_aplicado`) USING BTREE,
  CONSTRAINT `tb_bovino` FOREIGN KEY (`id_exped_aplicado`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_productos` FOREIGN KEY (`nva_vacuna_aplicada`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_control_vacunas
-- ----------------------------
INSERT INTO `tb_control_vacunas` VALUES (1, '2021-12-11', 1, 1);
INSERT INTO `tb_control_vacunas` VALUES (2, '0000-00-00', 1, 1);

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
INSERT INTO `tb_detalle_compra` VALUES (4, 1, 6.20, 6.20, NULL, 3, 3);
INSERT INTO `tb_detalle_compra` VALUES (5, 1, 7.97, 7.97, NULL, 3, 4);
INSERT INTO `tb_detalle_compra` VALUES (6, 3, 0.75, 2.25, 3, 4, NULL);

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
INSERT INTO `tb_detalle_venta` VALUES (1, 1, 1.50, 1.50, 2, NULL, 1);
INSERT INTO `tb_detalle_venta` VALUES (2, 1, 1.50, 1.50, 2, NULL, 2);
INSERT INTO `tb_detalle_venta` VALUES (3, 1, 1.50, 1.50, 2, NULL, 3);
INSERT INTO `tb_detalle_venta` VALUES (4, 1, 1.50, 1.50, 2, NULL, 4);
INSERT INTO `tb_detalle_venta` VALUES (5, 1, 1.50, 1.50, 2, NULL, 5);
INSERT INTO `tb_detalle_venta` VALUES (6, 1, 1.50, 1.50, 2, NULL, 6);
INSERT INTO `tb_detalle_venta` VALUES (7, 1, 1.50, 1.50, 2, NULL, 7);
INSERT INTO `tb_detalle_venta` VALUES (8, 1, 1.50, 1.50, 2, NULL, 8);
INSERT INTO `tb_detalle_venta` VALUES (9, 1, 1.50, 1.50, 2, NULL, 9);
INSERT INTO `tb_detalle_venta` VALUES (10, 1, 375.00, 375.00, NULL, 2, 10);
INSERT INTO `tb_detalle_venta` VALUES (11, 1, 375.00, 375.00, NULL, 1, 11);
INSERT INTO `tb_detalle_venta` VALUES (12, 1, 375.00, 375.00, NULL, 2, 12);
INSERT INTO `tb_detalle_venta` VALUES (13, 1, 375.00, 375.00, NULL, 1, 13);
INSERT INTO `tb_detalle_venta` VALUES (14, 1, 850.00, 850.00, NULL, 1, 14);
INSERT INTO `tb_detalle_venta` VALUES (15, 1, 0.00, 0.00, NULL, 2, 15);
INSERT INTO `tb_detalle_venta` VALUES (16, 1, 375.00, 375.00, NULL, 2, 16);
INSERT INTO `tb_detalle_venta` VALUES (17, 1, 1.50, 1.50, 2, NULL, 17);
INSERT INTO `tb_detalle_venta` VALUES (18, 1, 1.50, 1.50, 2, NULL, 18);
INSERT INTO `tb_detalle_venta` VALUES (19, 1, 550.00, 550.00, NULL, 2, 19);
INSERT INTO `tb_detalle_venta` VALUES (20, 1, 444.00, 444.00, NULL, 1, 20);
INSERT INTO `tb_detalle_venta` VALUES (21, 1, 1.50, 1.50, 2, NULL, 21);
INSERT INTO `tb_detalle_venta` VALUES (22, 1, 1.50, 1.50, 2, NULL, 22);
INSERT INTO `tb_detalle_venta` VALUES (23, 1, 1.50, 1.50, 2, NULL, 23);
INSERT INTO `tb_detalle_venta` VALUES (24, 2, 3.00, 6.00, 1, NULL, 24);
INSERT INTO `tb_detalle_venta` VALUES (25, 2, 1.50, 3.00, 2, NULL, 25);
INSERT INTO `tb_detalle_venta` VALUES (26, 1, 3.00, 3.00, 1, NULL, 26);
INSERT INTO `tb_detalle_venta` VALUES (27, 1, 1.50, 1.50, 2, NULL, 27);
INSERT INTO `tb_detalle_venta` VALUES (28, 1, 3.00, 3.00, 1, NULL, 28);
INSERT INTO `tb_detalle_venta` VALUES (29, 1, 1.50, 1.50, 2, NULL, 29);
INSERT INTO `tb_detalle_venta` VALUES (30, 1, 1.50, 1.50, 2, NULL, 29);
INSERT INTO `tb_detalle_venta` VALUES (31, 1, 1.50, 1.50, 2, NULL, 30);
INSERT INTO `tb_detalle_venta` VALUES (32, 1, 3.00, 3.00, 1, NULL, 31);
INSERT INTO `tb_detalle_venta` VALUES (33, 1, 3.00, 3.00, 1, NULL, 32);
INSERT INTO `tb_detalle_venta` VALUES (34, 3, 3.00, 9.00, 1, NULL, 33);
INSERT INTO `tb_detalle_venta` VALUES (35, 4, 1.50, 6.00, 2, NULL, 34);
INSERT INTO `tb_detalle_venta` VALUES (36, 1, 3.00, 3.00, 1, NULL, 35);
INSERT INTO `tb_detalle_venta` VALUES (37, 1, 1500.00, 1500.00, NULL, 4, 36);
INSERT INTO `tb_detalle_venta` VALUES (38, 1, 9.00, 9.00, NULL, 1, 37);
INSERT INTO `tb_detalle_venta` VALUES (39, 1, 7.00, 7.00, NULL, 3, 37);
INSERT INTO `tb_detalle_venta` VALUES (40, 1, 7.00, 7.00, NULL, 4, 38);
INSERT INTO `tb_detalle_venta` VALUES (41, 1, 9.00, 9.00, NULL, 2, 38);
INSERT INTO `tb_detalle_venta` VALUES (42, 1, 376.00, 376.00, NULL, 1, 39);
INSERT INTO `tb_detalle_venta` VALUES (43, 3, 1.50, 4.50, 1, NULL, 40);
INSERT INTO `tb_detalle_venta` VALUES (44, 1, 1.50, 1.50, 2, NULL, 41);

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
INSERT INTO `tb_expediente` VALUES (1, 'Antonia', 'vendido', '../archivo_carta_venta/img_1.png', 'femenino', NULL, 'aasdasdasd', 1, 1, '../archivo_expdiente/img_1.jpeg', 'novia', NULL, NULL, NULL);
INSERT INTO `tb_expediente` VALUES (2, 'loca', 'activo', '../archivo_carta_venta/img_2.jpg', 'femenino', NULL, 'Prueba', 1, 1, '../archivo_expdiente/img_2.jpg', 'vaca_lechera', NULL, NULL, NULL);
INSERT INTO `tb_expediente` VALUES (3, 'La Chorriada', 'activo', '../archivo_carta_venta/img_3.jpg', 'femenino', 1, 'Prueba jhonatahan', 1, 1, '../archivo_expdiente/img_3.jpg', 'vaca_lechera', '0000-00-00', 6.20, NULL);
INSERT INTO `tb_expediente` VALUES (4, 'La Patoja', 'activo', '../archivo_carta_venta/img_4.jpeg', 'femenino', 0, 'sdfgsdfsdf', 1, 1, '../archivo_expdiente/img_4.jpeg', 'vaca_lechera', '0000-00-00', 7.97, NULL);

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
INSERT INTO `tb_preñez` VALUES (1, 1, '2021-12-14', '2021-12-22', '2021-12-15');

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
  PRIMARY KEY (`int_idproducto`) USING BTREE,
  INDEX `idcategoria`(`int_idcategoria`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`int_idcategoria`) REFERENCES `tb_categoria` (`int_idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 202152270 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tb_producto
-- ----------------------------
INSERT INTO `tb_producto` VALUES (1, 'Botella de Crema Pura', 40, 2.25, 3.00, '../archivo_expdiente/img_1.png', 'Crema pura sin pausterizar', '2022-01-24', 1, 'Activo');
INSERT INTO `tb_producto` VALUES (2, 'Botella de Leche', 42, 0.75, 1.50, '../archivo_expdiente/img_2.jpeg', 'Botella de Leche', '2022-01-31', 1, 'Activo');
INSERT INTO `tb_producto` VALUES (3, 'Desparacitante', 9, 8.50, 0.00, '../archivo_expdiente/img_3.jpg', 'Frasco de 10 ml', '2022-01-31', 3, 'Activo');
INSERT INTO `tb_producto` VALUES (4, 'Vitamina D', 7, 13.50, 0.00, '../archivo_expdiente/img_4.jpg', 'Dosis de Vitamina D de 5ml', '2022-01-31', 4, 'Activo');

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
INSERT INTO `tb_usuario` VALUES (1, 'kathy', '$2y$10$aFc8RVPPBZZP.XuRdc0g..iaofO3OG0KjKIWy6b6HcJizaYyicyqK', 1, '../img/usuarios/user_20224310431500000015_1.jpg');
INSERT INTO `tb_usuario` VALUES (2, 'fabri', '$2y$10$iTum7jYvLCRV9j5MVlbhZ.p44KBF1tO3/JA.NFu5/.LCYrpmn.Ava', 2, '../img/usuarios/user_20214127414700000047_2.jpeg');

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
INSERT INTO `tb_venta` VALUES (1, 1.50, NULL, '2022-01-05 10:08:40', '2022-01-05 22:11:50', 'Ticket', 1, 2, 1);
INSERT INTO `tb_venta` VALUES (2, 1.50, NULL, '2022-01-07 04:17:48', '2022-01-07 16:43:17', 'Ticket', 2, 2, 2);
INSERT INTO `tb_venta` VALUES (3, 1.50, NULL, '2022-01-07 04:17:48', '2022-01-07 16:43:34', 'Ticket', 2, 2, 3);
INSERT INTO `tb_venta` VALUES (4, 1.50, NULL, '2022-01-07 04:45:27', '2022-01-07 16:46:10', 'Ticket', 2, 2, 4);
INSERT INTO `tb_venta` VALUES (5, 1.50, NULL, '2022-01-07 08:42:09', '2022-01-07 20:42:28', 'Ticket', 2, 2, 5);
INSERT INTO `tb_venta` VALUES (6, 1.50, NULL, '2022-01-07 09:13:46', '2022-01-07 21:13:59', 'Ticket', 2, 2, 6);
INSERT INTO `tb_venta` VALUES (7, 1.50, NULL, '2022-01-07 09:51:49', '2022-01-07 21:52:10', 'Ticket', 2, 2, 7);
INSERT INTO `tb_venta` VALUES (8, 1.50, NULL, '2022-01-07 09:52:55', '2022-01-07 21:53:05', 'Ticket', 2, 2, 8);
INSERT INTO `tb_venta` VALUES (9, 1.50, NULL, '2022-01-07 09:54:26', '2022-01-07 21:54:43', 'Factura', 2, 2, 9);
INSERT INTO `tb_venta` VALUES (10, 375.00, 0.00, '2022-01-09 12:31:21', '2022-01-09 00:31:57', 'Ticket', 2, 2, 10);
INSERT INTO `tb_venta` VALUES (11, 375.00, 0.00, '2022-01-09 12:32:26', '2022-01-09 00:32:50', 'Ticket', 2, 2, 11);
INSERT INTO `tb_venta` VALUES (12, 375.00, 0.00, '2022-01-09 12:34:19', '2022-01-09 00:34:35', 'Ticket', 2, 2, 12);
INSERT INTO `tb_venta` VALUES (13, 375.00, 0.00, '2022-01-09 12:37:28', '2022-01-09 00:37:59', 'Ticket', 2, 2, 13);
INSERT INTO `tb_venta` VALUES (14, 850.00, 0.00, '2022-01-09 02:31:29', '2022-01-09 14:32:34', 'Ticket', 2, 2, 14);
INSERT INTO `tb_venta` VALUES (15, 0.00, 0.00, '2022-01-09 02:32:58', '2022-01-09 14:33:19', 'Ticket', 2, 2, 15);
INSERT INTO `tb_venta` VALUES (16, 375.00, 0.00, '2022-01-09 02:32:58', '2022-01-09 14:33:29', 'Ticket', 2, 2, 15);
INSERT INTO `tb_venta` VALUES (17, 1.50, 0.00, '2022-01-09 02:35:38', '2022-01-09 14:35:56', 'Ticket', 2, 2, 17);
INSERT INTO `tb_venta` VALUES (18, 1.50, 0.00, '2022-01-09 02:37:00', '2022-01-09 14:37:13', 'Factura', 2, 2, 18);
INSERT INTO `tb_venta` VALUES (19, 550.00, 0.00, '2022-01-09 02:37:51', '2022-01-09 14:38:13', 'Factura', 2, 2, 19);
INSERT INTO `tb_venta` VALUES (20, 444.00, 0.00, '2022-01-09 02:43:29', '2022-01-09 14:43:45', 'Ticket', 2, 2, 20);
INSERT INTO `tb_venta` VALUES (21, 1.50, 0.00, '2022-01-09 03:06:17', '2022-01-09 15:06:34', 'Factura', 2, 2, 21);
INSERT INTO `tb_venta` VALUES (22, 1.50, 0.00, '2022-01-09 03:06:47', '2022-01-09 15:08:26', 'Factura', 2, 2, 22);
INSERT INTO `tb_venta` VALUES (23, 1.50, 0.00, '2022-01-09 03:10:58', '2022-01-09 15:11:07', 'Ticket', 2, 2, 23);
INSERT INTO `tb_venta` VALUES (24, 10.17, 0.00, '2022-01-09 10:57:55', '2022-01-09 23:00:03', 'Crédito Fiscal', 2, 2, 24);
INSERT INTO `tb_venta` VALUES (25, 3.39, 0.39, '2022-01-09 11:04:53', '2022-01-09 23:05:36', 'Crédito Fiscal', 2, 2, 25);
INSERT INTO `tb_venta` VALUES (26, 1.70, 0.20, '2022-01-09 11:08:44', '2022-01-09 23:09:05', 'Crédito Fiscal', 2, 2, 26);
INSERT INTO `tb_venta` VALUES (27, 3.00, 0.00, '2022-01-09 11:12:37', '2022-01-09 23:12:51', 'Factura', 2, 2, 27);
INSERT INTO `tb_venta` VALUES (28, 1.70, 0.20, '2022-01-09 11:17:51', '2022-01-09 23:20:20', 'Crédito Fiscal', 2, 2, 28);
INSERT INTO `tb_venta` VALUES (29, 1.70, 0.20, '2022-01-10 10:53:38', '2022-01-10 11:02:32', 'Crédito Fiscal', 2, 2, 29);
INSERT INTO `tb_venta` VALUES (30, 1.50, 0.00, '2022-01-10 11:09:30', '2022-01-10 11:09:49', 'Factura', 2, 2, 30);
INSERT INTO `tb_venta` VALUES (31, 3.00, 0.00, '2022-01-10 11:09:30', '2022-01-10 11:18:15', 'Factura', 2, 2, 30);
INSERT INTO `tb_venta` VALUES (32, 3.00, 0.00, '2022-01-10 11:28:57', '2022-01-10 11:31:06', 'Factura', 2, 2, 32);
INSERT INTO `tb_venta` VALUES (33, 10.17, 1.17, '2022-01-10 11:28:57', '2022-01-10 11:31:35', 'Crédito Fiscal', 2, 2, 32);
INSERT INTO `tb_venta` VALUES (34, 6.78, 0.78, '2022-01-10 11:33:38', '2022-01-10 11:34:05', 'Crédito Fiscal', 2, 2, 34);
INSERT INTO `tb_venta` VALUES (35, 3.00, 0.00, '2022-01-10 02:56:03', '2022-01-10 15:15:39', 'Factura', 2, 4, 35);
INSERT INTO `tb_venta` VALUES (36, 1500.00, 0.00, '2022-01-10 03:17:07', '2022-01-10 15:17:57', 'Factura', 2, 2, 36);
INSERT INTO `tb_venta` VALUES (37, 18.08, 0.00, '2022-01-10 10:53:17', '2022-01-10 22:55:28', 'Crédito Fiscal', 2, 2, 37);
INSERT INTO `tb_venta` VALUES (38, 16.00, 0.00, '2022-01-10 11:08:09', '2022-01-10 23:08:30', 'Factura', 2, 2, 38);
INSERT INTO `tb_venta` VALUES (39, 376.00, 0.00, '2022-01-10 11:09:24', '2022-01-10 23:09:40', 'Ticket', 2, 2, 39);
INSERT INTO `tb_venta` VALUES (40, 4.50, 0.00, '2022-01-10 11:26:11', '2022-01-10 23:27:33', 'Ticket', 2, 2, 40);
INSERT INTO `tb_venta` VALUES (41, 1.50, 0.00, '2022-01-10 11:29:51', '2022-01-10 23:30:05', 'Ticket', 2, 2, 41);

SET FOREIGN_KEY_CHECKS = 1;
