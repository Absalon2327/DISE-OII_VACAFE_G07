

CREATE TABLE `tb_baja` (
  `id_baja` int(11) NOT NULL AUTO_INCREMENT,
  `fehca_baja` date NOT NULL,
  `descripcion_baja` text NOT NULL,
  `idexpeiente_baja` int(11) NOT NULL,
  PRIMARY KEY (`id_baja`) USING BTREE,
  KEY `fk_bajaExpediente` (`idexpeiente_baja`) USING BTREE,
  CONSTRAINT `fk_bajaExpediente` FOREIGN KEY (`idexpeiente_baja`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2021424757 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;






CREATE TABLE `tb_botellas` (
  `int_idbotella` int(11) NOT NULL,
  `dat_fecha_vencimiento_botella` date DEFAULT NULL,
  `int_cantidad` int(11) DEFAULT NULL,
  `int_idproducto` int(11) DEFAULT NULL,
  `dou_costo_botella` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`int_idbotella`) USING BTREE,
  KEY `fk_producto` (`int_idproducto`) USING BTREE,
  CONSTRAINT `fk_producto` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;






CREATE TABLE `tb_cargo` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`idcargo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=202112355 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO tb_cargo VALUES("1","Administrador de Sistema");
INSERT INTO tb_cargo VALUES("2","Vaquero Ordeñador a Máquina");
INSERT INTO tb_cargo VALUES("3","Granjero");





CREATE TABLE `tb_categoria` (
  `int_idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_categoria` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`int_idcategoria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_categoria VALUES("1","DERIVADOS DE LECHE");
INSERT INTO tb_categoria VALUES("2","BOVINOS");
INSERT INTO tb_categoria VALUES("3","MEDICAMENTOS");
INSERT INTO tb_categoria VALUES("4","INSUMOS");





CREATE TABLE `tb_clientes` (
  `int_idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nva_dui_cliente` varchar(10) DEFAULT NULL,
  `nva_nom_cliente` varchar(25) DEFAULT NULL,
  `nva_ape_cliente` varchar(25) DEFAULT NULL,
  `txt_direc_cliente` text DEFAULT NULL,
  `nva_telefono_cliente` varchar(9) DEFAULT NULL,
  `nva_estado_cliente` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`int_idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_clientes VALUES("1","","Consumidor Final","","","","Activo");
INSERT INTO tb_clientes VALUES("2","05592129-3","Fabricio","Corvera","Santo Domingo","6300-3455","Activo");
INSERT INTO tb_clientes VALUES("3","32423423-4","Cluadia Yoselin","Rivas Arévalo","San Ildefonso","7894-5613","Activo");
INSERT INTO tb_clientes VALUES("4","78945654-6","José Hernán","Barahona Ayala","San Vicente","6598-7845","Activo");
INSERT INTO tb_clientes VALUES("5","12345678-9","Rolando Moisés","Corvera Mejía","Santo Domingo, San Vicente","7564-8796","Activo");
INSERT INTO tb_clientes VALUES("6","36987456-9","Rosa Excela","Mejía de Corvera","Santo Domingo","7762-3675","Activo");
INSERT INTO tb_clientes VALUES("7","65956234-4","Fabri","Mejía","Santo Domingo","7030-4095","inactivo");





CREATE TABLE `tb_compra` (
  `int_idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `txt_descrip_compra` text NOT NULL,
  `dou_total_compra` double(8,2) NOT NULL,
  `dou_iva_aplicado` double(8,2) DEFAULT NULL,
  `dat_fecha_compra` datetime NOT NULL,
  `dat_fecha_sistema` datetime NOT NULL,
  `nva_tipo_documento` varchar(35) NOT NULL,
  `nva_numero_documento` varchar(15) NOT NULL,
  `txt_sitio_compra` text DEFAULT NULL,
  `int_idproveedor` int(11) NOT NULL,
  `int_idempleado` int(11) NOT NULL,
  PRIMARY KEY (`int_idcompra`) USING BTREE,
  KEY `idempleado_fk` (`int_idempleado`),
  KEY `idproveedor_fk` (`int_idproveedor`),
  CONSTRAINT `idempleado_fk` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idproveedor_fk` FOREIGN KEY (`int_idproveedor`) REFERENCES `tb_proveedor` (`int_idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202159012 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_compra VALUES("1","Compra de Muestra","1.25","0.00","2022-01-05 10:15:07","2022-01-05 22:16:49","Factura","123154","n/a","2","1");
INSERT INTO tb_compra VALUES("2","Nueva Compra de Medicamentos","48.04","5.53","2022-01-11 01:16:33","2022-01-07 01:20:15","Crédito Fiscal","000001","n/a","1","2");
INSERT INTO tb_compra VALUES("3","Nueva Compra de Bovinos","16.01","1.84","2022-01-11 01:47:35","2022-01-11 01:49:48","Crédito Fiscal","000002","n/a","3","2");
INSERT INTO tb_compra VALUES("4","Nueva Compra para reporte","2.25","0.00","2022-01-12 12:05:11","2022-01-12 00:06:25","Factura","000003","n/a","1","2");





CREATE TABLE `tb_control_vacunas` (
  `int_id_control_vac` int(11) NOT NULL,
  `dat_fecha_aplicacion` date DEFAULT NULL,
  `nva_vacuna_aplicada` int(11) DEFAULT NULL,
  `id_exped_aplicado` int(11) DEFAULT NULL,
  `nva_dosis` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`int_id_control_vac`),
  KEY `tb_productos` (`nva_vacuna_aplicada`),
  KEY `tb_bovino` (`id_exped_aplicado`),
  CONSTRAINT `tb_bovino` FOREIGN KEY (`id_exped_aplicado`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_productos` FOREIGN KEY (`nva_vacuna_aplicada`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tb_control_vacunas VALUES("1","2021-12-11","1","1","");
INSERT INTO tb_control_vacunas VALUES("2","0000-00-00","1","1","");
INSERT INTO tb_control_vacunas VALUES("3","2022-01-10","3","3","2ml");
INSERT INTO tb_control_vacunas VALUES("4","2022-01-09","3","2","2ml");





CREATE TABLE `tb_detalle_compra` (
  `int_iddcompra` int(11) NOT NULL AUTO_INCREMENT,
  `int_cantidad_compra` int(11) NOT NULL,
  `dou_costo_compra` double(8,2) NOT NULL,
  `dou_subtotal_item_compra` double(8,2) NOT NULL,
  `int_idproducto` int(11) DEFAULT NULL,
  `int_idcompra` int(11) DEFAULT NULL,
  `int_idexpediente` int(11) DEFAULT NULL,
  PRIMARY KEY (`int_iddcompra`) USING BTREE,
  KEY `idproducto` (`int_idproducto`) USING BTREE,
  KEY `idcompra` (`int_idcompra`) USING BTREE,
  KEY `idexpediente` (`int_idexpediente`) USING BTREE,
  CONSTRAINT `fk_tbexpediente` FOREIGN KEY (`int_idexpediente`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_compra_ibfk_1` FOREIGN KEY (`int_idcompra`) REFERENCES `tb_compra` (`int_idcompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_compra_ibfk_2` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2021074711 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_detalle_compra VALUES("1","1","1.25","1.25","1","1","");
INSERT INTO tb_detalle_compra VALUES("2","3","6.20","18.60","3","2","");
INSERT INTO tb_detalle_compra VALUES("3","3","7.97","23.91","4","2","");
INSERT INTO tb_detalle_compra VALUES("4","1","6.20","6.20","","3","3");
INSERT INTO tb_detalle_compra VALUES("5","1","7.97","7.97","","3","4");
INSERT INTO tb_detalle_compra VALUES("6","3","0.75","2.25","3","4","");





CREATE TABLE `tb_detalle_venta` (
  `int_iddventa` int(11) NOT NULL AUTO_INCREMENT,
  `int_cantidad_vender` int(11) DEFAULT NULL,
  `dou_precio_venta` double(8,2) DEFAULT NULL,
  `dou_subtotal_item_vender` double(8,2) DEFAULT NULL,
  `int_idproducto` int(11) DEFAULT NULL,
  `int_idexpediente` int(11) DEFAULT NULL,
  `int_idventa` int(11) DEFAULT NULL,
  PRIMARY KEY (`int_iddventa`) USING BTREE,
  KEY `idventa` (`int_idventa`) USING BTREE,
  KEY `tb_producto` (`int_idproducto`),
  KEY `fk_expediente` (`int_idexpediente`),
  CONSTRAINT `fk_expediente` FOREIGN KEY (`int_idexpediente`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detalle_venta_ibfk_1` FOREIGN KEY (`int_idventa`) REFERENCES `tb_venta` (`int_idventa`),
  CONSTRAINT `tb_producto` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_detalle_venta VALUES("1","1","1.50","1.50","2","","1");
INSERT INTO tb_detalle_venta VALUES("2","1","1.50","1.50","2","","2");
INSERT INTO tb_detalle_venta VALUES("3","1","1.50","1.50","2","","3");
INSERT INTO tb_detalle_venta VALUES("4","1","1.50","1.50","2","","4");
INSERT INTO tb_detalle_venta VALUES("5","1","1.50","1.50","2","","5");
INSERT INTO tb_detalle_venta VALUES("6","1","1.50","1.50","2","","6");
INSERT INTO tb_detalle_venta VALUES("7","1","1.50","1.50","2","","7");
INSERT INTO tb_detalle_venta VALUES("8","1","1.50","1.50","2","","8");
INSERT INTO tb_detalle_venta VALUES("9","1","1.50","1.50","2","","9");
INSERT INTO tb_detalle_venta VALUES("10","1","375.00","375.00","","2","10");
INSERT INTO tb_detalle_venta VALUES("11","1","375.00","375.00","","1","11");
INSERT INTO tb_detalle_venta VALUES("12","1","375.00","375.00","","2","12");
INSERT INTO tb_detalle_venta VALUES("13","1","375.00","375.00","","1","13");
INSERT INTO tb_detalle_venta VALUES("14","1","850.00","850.00","","1","14");
INSERT INTO tb_detalle_venta VALUES("15","1","0.00","0.00","","2","15");
INSERT INTO tb_detalle_venta VALUES("16","1","375.00","375.00","","2","16");
INSERT INTO tb_detalle_venta VALUES("17","1","1.50","1.50","2","","17");
INSERT INTO tb_detalle_venta VALUES("18","1","1.50","1.50","2","","18");
INSERT INTO tb_detalle_venta VALUES("19","1","550.00","550.00","","2","19");
INSERT INTO tb_detalle_venta VALUES("20","1","444.00","444.00","","1","20");
INSERT INTO tb_detalle_venta VALUES("21","1","1.50","1.50","2","","21");
INSERT INTO tb_detalle_venta VALUES("22","1","1.50","1.50","2","","22");
INSERT INTO tb_detalle_venta VALUES("23","1","1.50","1.50","2","","23");
INSERT INTO tb_detalle_venta VALUES("24","2","3.00","6.00","1","","24");
INSERT INTO tb_detalle_venta VALUES("25","2","1.50","3.00","2","","25");
INSERT INTO tb_detalle_venta VALUES("26","1","3.00","3.00","1","","26");
INSERT INTO tb_detalle_venta VALUES("27","1","1.50","1.50","2","","27");
INSERT INTO tb_detalle_venta VALUES("28","1","3.00","3.00","1","","28");
INSERT INTO tb_detalle_venta VALUES("29","1","1.50","1.50","2","","29");
INSERT INTO tb_detalle_venta VALUES("30","1","1.50","1.50","2","","29");
INSERT INTO tb_detalle_venta VALUES("31","1","1.50","1.50","2","","30");
INSERT INTO tb_detalle_venta VALUES("32","1","3.00","3.00","1","","31");
INSERT INTO tb_detalle_venta VALUES("33","1","3.00","3.00","1","","32");
INSERT INTO tb_detalle_venta VALUES("34","3","3.00","9.00","1","","33");
INSERT INTO tb_detalle_venta VALUES("35","4","1.50","6.00","2","","34");
INSERT INTO tb_detalle_venta VALUES("36","1","3.00","3.00","1","","35");
INSERT INTO tb_detalle_venta VALUES("37","1","1500.00","1500.00","","4","36");
INSERT INTO tb_detalle_venta VALUES("38","1","9.00","9.00","","1","37");
INSERT INTO tb_detalle_venta VALUES("39","1","7.00","7.00","","3","37");
INSERT INTO tb_detalle_venta VALUES("40","1","7.00","7.00","","4","38");
INSERT INTO tb_detalle_venta VALUES("41","1","9.00","9.00","","2","38");
INSERT INTO tb_detalle_venta VALUES("42","1","376.00","376.00","","1","39");
INSERT INTO tb_detalle_venta VALUES("43","3","1.50","4.50","1","","40");
INSERT INTO tb_detalle_venta VALUES("44","1","1.50","1.50","2","","41");





CREATE TABLE `tb_empleado` (
  `int_idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `nva_dui_empledao` varchar(10) DEFAULT NULL,
  `nva_nom_empleado` varchar(25) DEFAULT NULL,
  `nva_ape_empleado` varchar(25) DEFAULT NULL,
  `txt_direc_empleado` text DEFAULT NULL,
  `dat_fechanaci_empleado` date DEFAULT NULL,
  `dou_salario_empleado` double DEFAULT NULL,
  `nva_telefono_empleado` varchar(9) DEFAULT NULL,
  `nva_email_empleado` varchar(50) DEFAULT NULL,
  `int_idcargo` int(11) DEFAULT NULL,
  `nva_estado_empleado` varchar(10) DEFAULT NULL,
  `nva_sexo_empleado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`int_idempleado`),
  KEY `idcargo` (`int_idcargo`) USING BTREE,
  CONSTRAINT `fk_idcargo` FOREIGN KEY (`int_idcargo`) REFERENCES `tb_cargo` (`idcargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202152262 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_empleado VALUES("1","98654578-9","Katherine Lorena","Peña Sigüenza","Cantón las Flores, municipio de Cojutepeque, departamento de Cuscatlán","1998-03-26","350","7856-5139","cm16057@ues.edu.sv","1","Activo","Femenino");
INSERT INTO tb_empleado VALUES("2","12345678-9","Fabricio","Corvera","Santo Domingo, San Vicente","1997-09-27","350","6300-3455","fabricio@gmail.com","1","Activo","Masculino");





CREATE TABLE `tb_expediente` (
  `int_idexpediente` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_bovino` varchar(25) DEFAULT NULL,
  `nva_estado_bovino` varchar(10) DEFAULT NULL,
  `nva_carta_venta` varchar(255) DEFAULT NULL,
  `nva_sexo_bovino` varchar(10) DEFAULT NULL,
  `int_cant_parto` int(11) DEFAULT NULL,
  `txt_descrip_expediente` text DEFAULT NULL,
  `int_id_propietario` int(11) DEFAULT NULL,
  `int_idraza` int(11) DEFAULT NULL,
  `nva_foto_bovino` varchar(255) DEFAULT NULL,
  `nva_tipo_bovino` varchar(25) DEFAULT NULL,
  `dat_fecha_ult_parto` date DEFAULT NULL,
  `dou_costo_bovino` double(8,2) DEFAULT NULL,
  `dou_precio_venta_bovino` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`int_idexpediente`),
  KEY `fk_propietario` (`int_id_propietario`),
  KEY `fk_raza` (`int_idraza`),
  CONSTRAINT `fk_propietario` FOREIGN KEY (`int_id_propietario`) REFERENCES `tb_propietario` (`int_id_propietario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_raza` FOREIGN KEY (`int_idraza`) REFERENCES `tb_raza` (`int_idraza`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

INSERT INTO tb_expediente VALUES("1","Antonia","vendido","../archivo_carta_venta/img_1.png","femenino","","aasdasdasd","1","1","../archivo_expdiente/img_1.jpeg","novia","","","");
INSERT INTO tb_expediente VALUES("2","loca","activo","../archivo_carta_venta/img_2.jpg","femenino","","Prueba","1","1","../archivo_expdiente/img_2.jpg","vaca_lechera","","","");
INSERT INTO tb_expediente VALUES("3","La Patoja café","preñada","../archivo_carta_venta/img_3.jpg","femenino","1","Prueba modificar","1","1","../archivo_expdiente/img_3.jpg","vaca_lechera","0000-00-00","6.20","750.00");
INSERT INTO tb_expediente VALUES("4","La Patoja","activo","../archivo_carta_venta/img_4.jpeg","femenino","0","sdfgsdfsdf","1","1","../archivo_expdiente/img_4.jpeg","vaca_lechera","0000-00-00","7.97","");
INSERT INTO tb_expediente VALUES("5","Bicicleta","activo","../archivo_carta_venta/img_5.png","femenino","","De cabos hacia abajo","1","1","../archivo_expdiente/img_5.jpg","novia","","378.00","575.00");
INSERT INTO tb_expediente VALUES("6","Chocolatada","activo","../archivo_carta_venta/img_6.png","femenino","1","Parches color café","1","1","../archivo_expdiente/img_6.jpg","vaca_lechera","2022-01-08","900.00","950.00");





CREATE TABLE `tb_gastos` (
  `int_idgastos` int(11) NOT NULL AUTO_INCREMENT,
  `dat_fecha_gasto` datetime DEFAULT NULL,
  `int_idproducto` int(11) DEFAULT NULL,
  `int_cantidad_gastar` int(11) DEFAULT NULL,
  `nva_estado_gasto` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`int_idgastos`),
  KEY `fk_tb_productos` (`int_idproducto`),
  CONSTRAINT `fk_tb_productos` FOREIGN KEY (`int_idproducto`) REFERENCES `tb_producto` (`int_idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO tb_gastos VALUES("1","2022-01-05 06:00:30","3","5","Activo");
INSERT INTO tb_gastos VALUES("2","2022-01-16 06:00:30","3","3","Activo");
INSERT INTO tb_gastos VALUES("3","2022-01-17 12:30:19","3","3","Activo");
INSERT INTO tb_gastos VALUES("4","2022-01-17 10:02:03","2","5","Activo");





CREATE TABLE `tb_natalidad` (
  `int_id_natalidad` int(11) NOT NULL AUTO_INCREMENT,
  `dat_fecha_nacimiento` date NOT NULL,
  `int_id_expe_madre` int(11) NOT NULL,
  `int_id_expe_ternero` int(11) NOT NULL,
  PRIMARY KEY (`int_id_natalidad`) USING BTREE,
  KEY `fk_madre` (`int_id_expe_madre`) USING BTREE,
  KEY `fk_hijo` (`int_id_expe_ternero`) USING BTREE,
  CONSTRAINT `fk_hijo` FOREIGN KEY (`int_id_expe_ternero`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_madre` FOREIGN KEY (`int_id_expe_madre`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2021523134 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;






CREATE TABLE `tb_preñez` (
  `int_id_preñez` int(11) NOT NULL AUTO_INCREMENT,
  `int_bovino_fk` int(11) DEFAULT NULL,
  `dat_fecha_monta` date DEFAULT NULL,
  `dat_fecha_parto` date DEFAULT NULL,
  `dat_fecha_celo` date DEFAULT NULL,
  PRIMARY KEY (`int_id_preñez`) USING BTREE,
  KEY `fk_expdt` (`int_bovino_fk`) USING BTREE,
  CONSTRAINT `fk_expdt` FOREIGN KEY (`int_bovino_fk`) REFERENCES `tb_expediente` (`int_idexpediente`)
) ENGINE=InnoDB AUTO_INCREMENT=202156247 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO tb_preñez VALUES("1","1","2021-12-14","2021-12-22","2021-12-15");
INSERT INTO tb_preñez VALUES("2","3","2022-01-15","2022-10-15","2022-01-08");





CREATE TABLE `tb_producto` (
  `int_idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_producto` varchar(25) DEFAULT NULL,
  `int_existencia` int(11) DEFAULT NULL,
  `dou_costo_producto` double(8,2) DEFAULT NULL,
  `dou_precio_venta_producto` double(8,2) DEFAULT NULL,
  `nva_image_producto` varchar(100) DEFAULT NULL,
  `txt_descrip_producto` text DEFAULT NULL,
  `dat_fecha_vencimiento` date DEFAULT NULL,
  `int_idcategoria` int(11) DEFAULT NULL,
  `nva_estado_producto` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`int_idproducto`) USING BTREE,
  KEY `idcategoria` (`int_idcategoria`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`int_idcategoria`) REFERENCES `tb_categoria` (`int_idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202152270 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_producto VALUES("1","Botella de Crema Pura","10","2.25","3.00","../archivo_expdiente/img_1.png","Crema pura sin pausterizar","2022-01-24","1","Activo");
INSERT INTO tb_producto VALUES("2","Botella de Leche","10","0.75","1.50","../archivo_expdiente/img_2.jpeg","Botella de Leche","2022-01-31","1","Activo");
INSERT INTO tb_producto VALUES("3","Desparacitante","0","8.50","0.00","../archivo_expdiente/img_3.jpg","Frasco de 10 ml","2022-01-31","3","Activo");
INSERT INTO tb_producto VALUES("4","Vitamina D","7","13.50","0.00","../archivo_expdiente/img_4.jpg","Dosis de Vitamina D de 5ml","2022-01-31","4","Activo");





CREATE TABLE `tb_propietario` (
  `int_id_propietario` int(11) NOT NULL AUTO_INCREMENT,
  `nva_dui_propietario` varchar(11) NOT NULL,
  `nva_nombres_propietario` varchar(25) NOT NULL,
  `nva_apellidos_propietario` varchar(25) NOT NULL,
  PRIMARY KEY (`int_id_propietario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO tb_propietario VALUES("1","12345678-9","Fabricio","Corvera");





CREATE TABLE `tb_proveedor` (
  `int_idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_proveedor` varchar(25) DEFAULT NULL,
  `txt_direc_proveedor` text DEFAULT NULL,
  `nva_telefono` varchar(9) DEFAULT NULL,
  `nva_nrc` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`int_idproveedor`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_proveedor VALUES("1","Salinera Turcios","san salvador","7878-9898","12345-6");
INSERT INTO tb_proveedor VALUES("2","Agroservicio El Frutal","san salvador","7979-7878","21213-4");
INSERT INTO tb_proveedor VALUES("3","Agua El Manantial","cuscatlan","7373-2121","31312-3");
INSERT INTO tb_proveedor VALUES("4","Finca Cuscatlán","cojutepeque","6398-6598","78932-4");





CREATE TABLE `tb_raza` (
  `int_idraza` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_raza` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`int_idraza`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_raza VALUES("1","holtein");





CREATE TABLE `tb_usuario` (
  `int_idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nva_nom_usuario` varchar(25) DEFAULT NULL,
  `nva_contraseña_usuario` text DEFAULT NULL,
  `int_idempleado` int(11) DEFAULT NULL,
  `nva_fotografia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`int_idusuario`) USING BTREE,
  KEY `fk_empleado` (`int_idempleado`),
  CONSTRAINT `fk_empleado` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202138342 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_usuario VALUES("1","kathy","$2y$10$aFc8RVPPBZZP.XuRdc0g..iaofO3OG0KjKIWy6b6HcJizaYyicyqK","1","../img/usuarios/user_20224310431500000015_1.jpg");
INSERT INTO tb_usuario VALUES("2","fabri","$2y$10$iTum7jYvLCRV9j5MVlbhZ.p44KBF1tO3/JA.NFu5/.LCYrpmn.Ava","2","../img/usuarios/user_20214127414700000047_2.jpeg");





CREATE TABLE `tb_venta` (
  `int_idventa` int(11) NOT NULL AUTO_INCREMENT,
  `dou_total_venta` double(8,2) NOT NULL,
  `dou_iva_venta` double(8,2) DEFAULT NULL,
  `dat_fecha_venta` datetime NOT NULL,
  `dat_fecha_sistema_venta` datetime NOT NULL,
  `nva_tipo_documento` varchar(25) NOT NULL,
  `int_idempleado` int(11) NOT NULL,
  `int_id_cliente` int(11) NOT NULL,
  `int_num_doc` int(11) NOT NULL,
  PRIMARY KEY (`int_idventa`) USING BTREE,
  KEY `idusuario` (`int_idempleado`) USING BTREE,
  KEY `tb_clientes_fk` (`int_id_cliente`),
  CONSTRAINT `tb_clientes_fk` FOREIGN KEY (`int_id_cliente`) REFERENCES `tb_clientes` (`int_idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_empleado_fk` FOREIGN KEY (`int_idempleado`) REFERENCES `tb_empleado` (`int_idempleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_venta VALUES("1","1.50","","2022-01-05 10:08:40","2022-01-05 22:11:50","Ticket","1","1","1");
INSERT INTO tb_venta VALUES("2","1.50","","2022-01-07 04:17:48","2022-01-07 16:43:17","Ticket","2","1","2");
INSERT INTO tb_venta VALUES("3","1.50","","2022-01-07 04:17:48","2022-01-07 16:43:34","Ticket","2","1","3");
INSERT INTO tb_venta VALUES("4","1.50","","2022-01-07 04:45:27","2022-01-07 16:46:10","Ticket","2","1","4");
INSERT INTO tb_venta VALUES("5","1.50","","2022-01-07 08:42:09","2022-01-07 20:42:28","Ticket","2","1","5");
INSERT INTO tb_venta VALUES("6","1.50","","2022-01-07 09:13:46","2022-01-07 21:13:59","Ticket","2","1","6");
INSERT INTO tb_venta VALUES("7","1.50","","2022-01-07 09:51:49","2022-01-07 21:52:10","Ticket","2","1","7");
INSERT INTO tb_venta VALUES("8","1.50","","2022-01-07 09:52:55","2022-01-07 21:53:05","Ticket","2","1","8");
INSERT INTO tb_venta VALUES("9","1.50","","2022-01-07 09:54:26","2022-01-07 21:54:43","Factura","2","1","9");
INSERT INTO tb_venta VALUES("10","375.00","0.00","2022-01-09 12:31:21","2022-01-09 00:31:57","Ticket","2","1","10");
INSERT INTO tb_venta VALUES("11","375.00","0.00","2022-01-09 12:32:26","2022-01-09 00:32:50","Ticket","2","1","11");
INSERT INTO tb_venta VALUES("12","375.00","0.00","2022-01-09 12:34:19","2022-01-09 00:34:35","Ticket","2","1","12");
INSERT INTO tb_venta VALUES("13","375.00","0.00","2022-01-09 12:37:28","2022-01-09 00:37:59","Ticket","2","1","13");
INSERT INTO tb_venta VALUES("14","850.00","0.00","2022-01-09 02:31:29","2022-01-09 14:32:34","Ticket","2","1","14");
INSERT INTO tb_venta VALUES("15","0.00","0.00","2022-01-09 02:32:58","2022-01-09 14:33:19","Ticket","2","1","15");
INSERT INTO tb_venta VALUES("16","375.00","0.00","2022-01-09 02:32:58","2022-01-09 14:33:29","Ticket","2","1","15");
INSERT INTO tb_venta VALUES("17","1.50","0.00","2022-01-09 02:35:38","2022-01-09 14:35:56","Ticket","2","1","17");
INSERT INTO tb_venta VALUES("18","1.50","0.00","2022-01-09 02:37:00","2022-01-09 14:37:13","Factura","2","1","18");
INSERT INTO tb_venta VALUES("19","550.00","0.00","2022-01-09 02:37:51","2022-01-09 14:38:13","Factura","2","1","19");
INSERT INTO tb_venta VALUES("20","444.00","0.00","2022-01-09 02:43:29","2022-01-09 14:43:45","Ticket","2","1","20");
INSERT INTO tb_venta VALUES("21","1.50","0.00","2022-01-09 03:06:17","2022-01-09 15:06:34","Factura","2","1","21");
INSERT INTO tb_venta VALUES("22","1.50","0.00","2022-01-09 03:06:47","2022-01-09 15:08:26","Factura","2","1","22");
INSERT INTO tb_venta VALUES("23","1.50","0.00","2022-01-09 03:10:58","2022-01-09 15:11:07","Ticket","2","1","23");
INSERT INTO tb_venta VALUES("24","10.17","0.00","2022-01-09 10:57:55","2022-01-09 23:00:03","Crédito Fiscal","2","1","24");
INSERT INTO tb_venta VALUES("25","3.39","0.39","2022-01-09 11:04:53","2022-01-09 23:05:36","Crédito Fiscal","2","1","25");
INSERT INTO tb_venta VALUES("26","1.70","0.20","2022-01-09 11:08:44","2022-01-09 23:09:05","Crédito Fiscal","2","1","26");
INSERT INTO tb_venta VALUES("27","3.00","0.00","2022-01-09 11:12:37","2022-01-09 23:12:51","Factura","2","1","27");
INSERT INTO tb_venta VALUES("28","1.70","0.20","2022-01-09 11:17:51","2022-01-09 23:20:20","Crédito Fiscal","2","1","28");
INSERT INTO tb_venta VALUES("29","1.70","0.20","2022-01-10 10:53:38","2022-01-10 11:02:32","Crédito Fiscal","2","1","29");
INSERT INTO tb_venta VALUES("30","1.50","0.00","2022-01-10 11:09:30","2022-01-10 11:09:49","Factura","2","1","30");
INSERT INTO tb_venta VALUES("31","3.00","0.00","2022-01-10 11:09:30","2022-01-10 11:18:15","Factura","2","1","30");
INSERT INTO tb_venta VALUES("32","3.00","0.00","2022-01-10 11:28:57","2022-01-10 11:31:06","Factura","2","1","32");
INSERT INTO tb_venta VALUES("33","10.17","1.17","2022-01-10 11:28:57","2022-01-10 11:31:35","Crédito Fiscal","2","1","32");
INSERT INTO tb_venta VALUES("34","6.78","0.78","2022-01-10 11:33:38","2022-01-10 11:34:05","Crédito Fiscal","2","1","34");
INSERT INTO tb_venta VALUES("35","3.00","0.00","2022-01-10 02:56:03","2022-01-10 15:15:39","Factura","2","2","35");
INSERT INTO tb_venta VALUES("36","1500.00","0.00","2022-01-10 03:17:07","2022-01-10 15:17:57","Factura","2","1","36");
INSERT INTO tb_venta VALUES("37","18.08","0.00","2022-01-10 10:53:17","2022-01-10 22:55:28","Crédito Fiscal","2","1","37");
INSERT INTO tb_venta VALUES("38","16.00","0.00","2022-01-10 11:08:09","2022-01-10 23:08:30","Factura","2","1","38");
INSERT INTO tb_venta VALUES("39","376.00","0.00","2022-01-10 11:09:24","2022-01-10 23:09:40","Ticket","2","1","39");
INSERT INTO tb_venta VALUES("40","4.50","0.00","2022-01-10 11:26:11","2022-01-10 23:27:33","Ticket","2","1","40");
INSERT INTO tb_venta VALUES("41","1.50","0.00","2022-01-10 11:29:51","2022-01-10 23:30:05","Ticket","2","1","41");



