

CREATE TABLE `tb_baja` (
  `id_baja` int(11) NOT NULL AUTO_INCREMENT,
  `fehca_baja` date NOT NULL,
  `descripcion_baja` text NOT NULL,
  `idexpeiente_baja` int(11) NOT NULL,
  PRIMARY KEY (`id_baja`) USING BTREE,
  KEY `fk_bajaExpediente` (`idexpeiente_baja`) USING BTREE,
  CONSTRAINT `fk_bajaExpediente` FOREIGN KEY (`idexpeiente_baja`) REFERENCES `tb_expediente` (`int_idexpediente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2021424757 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO tb_baja VALUES("1","2022-01-18","MUERTE NATURAL","4");





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

INSERT INTO tb_botellas VALUES("1","2022-01-20","10","1","3.00");
INSERT INTO tb_botellas VALUES("2","2022-01-31","10","2","5.00");





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
INSERT INTO tb_categoria VALUES("2","MEDICAMENTOS");
INSERT INTO tb_categoria VALUES("3","INSUMOS");





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

INSERT INTO tb_control_vacunas VALUES("1","2022-01-01","7","3","1ML");
INSERT INTO tb_control_vacunas VALUES("2","2022-01-10","8","2","2ML");
INSERT INTO tb_control_vacunas VALUES("3","2022-01-16","7","1","1ML");





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
INSERT INTO tb_empleado VALUES("3","98756321-3","José Hernán","Barahona Ayala","Colonia las Flores, Estado Municipal, San Vicente","1997-12-11","3000","7825-9865","fabricio.corvera.9@gmail.com","1","Activo","Masculino");





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

INSERT INTO tb_expediente VALUES("1","TRAILERA","preñada","../archivo_carta_venta/imgcarta_1.jpg","femenino","2","UNA VACA PRIETA SARDA","1","1","../archivo_expdiente/imgfoto_1.jpeg","vaca_lechera","2021-11-23","567.00","567.00");
INSERT INTO tb_expediente VALUES("2","DUQUESA","activo","../archivo_carta_venta/imgcarta_2.jpg","femenino","2","VACA CARETA CRIOLLA","1","1","../archivo_expdiente/imgfoto_2.jpeg","vaca_lechera","2021-09-06","567.00","789.00");
INSERT INTO tb_expediente VALUES("3","ESTRELLA","activo","../archivo_carta_venta/imgcarta_3.jpg","femenino","","TERNERITA PINTA","1","1","../archivo_expdiente/imgfoto_3.jpeg","novia","","234.00","567.00");
INSERT INTO tb_expediente VALUES("4","ANDALON","inactivo","../archivo_carta_venta/imgcarta_4.jpg","femenino","","TERNERO CARETO","1","1","../archivo_expdiente/imgfoto_4.jpg","ternero","","234.00","456.00");





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

INSERT INTO tb_preñez VALUES("1","1","2021-05-18","2022-02-18","2021-05-17");





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
  `int_existencia_minima` int(11) DEFAULT NULL,
  PRIMARY KEY (`int_idproducto`) USING BTREE,
  KEY `idcategoria` (`int_idcategoria`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`int_idcategoria`) REFERENCES `tb_categoria` (`int_idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=202152272 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

INSERT INTO tb_producto VALUES("1","Crema","30","2.50","3.50","../archivo_producto/img_1.jpg","Especial","2022-01-31","1","Activo","");
INSERT INTO tb_producto VALUES("2","Quesillo","20","3.50","4.00","../archivo_producto/img_2.jpg","Especial","2022-01-26","1","Activo","");
INSERT INTO tb_producto VALUES("3","Concentrado","30","23.00","","../archivo_producto/img_3.jpg","Para ganado Bovino","2022-01-31","3","Activo","6");
INSERT INTO tb_producto VALUES("4","Agua ","4","30.00","","../archivo_producto/img_4.jpg","Agua galon","2022-01-25","3","Activo","2");
INSERT INTO tb_producto VALUES("5","Sal","5","20.00","","../archivo_producto/img_5.jpg","Sal yodada","2022-01-26","3","Activo","3");
INSERT INTO tb_producto VALUES("6","Gasolina","30","3.60","","../archivo_producto/img_6.jpg","Especial","2022-01-27","3","Activo","6");
INSERT INTO tb_producto VALUES("7","Hexagan","5","30.00","","../archivo_producto/img_7.jpg","Para gripe de ganado bovino","2022-01-31","2","Activo","2");
INSERT INTO tb_producto VALUES("8","Impulsor","6","20.00","","../archivo_producto/img_8.jpg","Para las pulgas del ganado","2022-01-26","2","Activo","2");
INSERT INTO tb_producto VALUES("9","Botella de Leche","30","0.75","1.25","../archivo_producto/img_9.jpg","leche fresca","2022-01-31","1","Activo","");
INSERT INTO tb_producto VALUES("10","Vacuna Aftogan","10","15.00","","../archivo_producto/img_10.jpg","Vacuna para el crecimiento del cabello","2022-01-26","2","Activo","2");
INSERT INTO tb_producto VALUES("11","Queso","5","4.00","5.00","../archivo_producto/img_11.jpg","Queso duro especial","2022-01-31","1","activo","");





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

INSERT INTO tb_usuario VALUES("1","kathy","$2y$10$wC1niewN.y/x65ShFYlbdebKCRtuQrhv.dOHYAJq.gQm7PiwEYCzG","1","../img/usuarios/user_20224310431500000015_1.jpg");
INSERT INTO tb_usuario VALUES("2","fabri","$2y$10$iTum7jYvLCRV9j5MVlbhZ.p44KBF1tO3/JA.NFu5/.LCYrpmn.Ava","2","../img/usuarios/user_20214127414700000047_2.jpeg");
INSERT INTO tb_usuario VALUES("3","hernan","$2y$10$rJ3nVoGeb/Xy6Ij5JkTj5eVcKcyNwYZUaty3YimeCid9yjedWq0qK","3","../img/usuarios/user_20220518051900000019_3.jpg");





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




