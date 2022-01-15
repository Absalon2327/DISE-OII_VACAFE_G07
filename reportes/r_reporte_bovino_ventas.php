<?php 
 date_default_timezone_set('America/El_Salvador');
require_once("../pdf/tfpdf.php");
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
$GLOBALS['utilidad_total'] = 0;
$GLOBALS['costo_total'] = 0;
$GLOBALS['precio_total'] = 0;
$GLOBALS['iva_total'] = 0;
$GLOBALS['subtotal_item'] = 0;
$fecha_inicio = "";
$fecha_fin = "";
$genera_report = "si_generar";
$i = 0;
class PDF extends tFPDF{
            // Cabecera de página

        function Header(){
            // Arial bold 15
            
            
            $this->SetFont('Arial','B',12);
            $this->Image('../dist/img/logo-n.png',10,8,33);
             $this->Image('../dist/img/ues-a.png',260,8,33);
            $this->Cell(130);

            $this->Cell(30,10,utf8_decode('FINCA LA VACA CAFÉ'),0,0,'C');
             $this->Cell(130);             
            $this->Ln(5);
            $this->Cell(130);
            $this->Cell(30,10,'Calle La India',0,0,'C');
            $this->Ln(5);
            $this->Cell(130);
            $this->Cell(30,10,'Poligono A, Lote 4,',0,0,'C');
            $this->Ln(5);
            $this->Cell(130);
            $this->Cell(30,10,utf8_decode('Barrio San Juan, Cojutepeque, Cuscatlán.'),0,0,'C');
            $this->Cell(130);
           
           
          
           // Salto de línea
            $this->Ln(20);
            // Movernos a la derecha
            $this->Cell(130);
            // Título
            $this->Cell(30,10,'REPORTE DE COMPRAS DE BOVINOS',0,0,'C');
            // Salto de línea
            $this->Ln(15);

            
        }

            // Pie de página
        function Footer(){
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
        }
        function FancyTable($header,$result)
        {
            // Colores, ancho de línea y fuente en negrita

            $this->SetFillColor(224,235,255);//Color de las cabeceras
            $this->SetTextColor(0);
            //Color de las lineas de la tabla
            $this->SetDrawColor(176, 196, 222);
            $this->SetLineWidth(.3);
            $this->SetFont('Arial','B');
            // Cabecera
            
            $w = array(60, 40, 40, 40, 40, 40);
            
            
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            
            // Datos
            //http://localhost/poryecto_DISE%C3%91OII/DISE%C3%91OII_VACAFE_G07/
           
            
                if($result[0]=='1'){
                    $fill = false;
                    foreach ($result[2]  as $row) {

                        $utilidad = ($row['dou_precio_venta_bovino'] - $row['dou_costo_bovino']) + $row['dou_iva_venta'];

                        $this->Cell($w[0],6,$row['nva_nom_bovino'],'LR',0,'C',$fill);                       
                        $this->Cell($w[1],6,"$".$row['dou_costo_bovino'],'LR',0,'L',$fill); 
                        $this->Cell($w[2],6,"$".$row['dou_precio_venta_bovino'],'LR',0,'L',$fill);
                        $this->Cell($w[3],6,"$".$row['dou_subtotal_item_vender'],'LR',0,'L',$fill);
                        $this->Cell($w[4],6,"$".$row['dou_iva_venta'],'LR',0,'C',$fill);
                        $this->Cell($w[5],6,"$".$utilidad,'LR',0,'C',$fill);
                        $this->Ln();
                        $fill = !$fill;
                        $GLOBALS['utilidad_total'] = $GLOBALS['utilidad_total'] + $utilidad;
                        $GLOBALS['costo_total'] = $GLOBALS['costo_total'] + $row['dou_costo_bovino'];
                        $GLOBALS['precio_total'] = $GLOBALS['precio_total'] + $row['dou_precio_venta_bovino'];
                        $GLOBALS['iva_total'] = $GLOBALS['iva_total'] + $row['dou_iva_venta'];
                        $GLOBALS['subtotal_item'] = $GLOBALS['subtotal_item'] + $row['dou_subtotal_item_vender'];
                    }
                }
            
           
            
            $this->Cell(array_sum($w),0,'','T');
        }
}
    




    $pdf = new PDF('L','mm','A4');   
    // Títulos de las columnas
    
    $fecha_inicio = $_GET['fei'];
    $fecha_fin = $_GET['fef'];
    $idempleado = $_GET['ide'];
    $cate_bov = $_GET['cat'];
    $categoria = "";
    $fecha_actual = date('d-m-Y');
    $hora_actual = date('H:i:s');
    $feh = 0;
    if ($cate_bov == "vaca_lechera") {
        $categoria = "Vaca Lechera";
    }

    if (($idempleado != null) && ($cate_bov != null) ) {
        $sql = "SELECT
                    * 
                FROM
                    tb_compra
                    INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
                    INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
                    INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                    INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
                WHERE
                    tb_proveedor.int_idempleado = $idempleado 
                    AND tb_expediente.nva_tipo_bovino = '$cate_bov' 
                    AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
                    AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

           $filtros = array('Fecha y Hora', 'Bovino', 'Precio $');
           $total = 240;
           $feh = 225;

    }else if (($idempleado != null) && ($cate_bov == null) ) {

        $sql = "SELECT
                        * 
                    FROM
                        tb_compra
                        INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
                        INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
                        INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                        INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
                    WHERE
                        tb_proveedor.int_idempleado = $idempleado
                        AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
                        AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

        $filtros = array('Fecha y Hora', utf8_decode('Categoría'), 'Bovino', 'Precio $');
        $total = 312;
        $feh = 340;

    }else if (($idempleado == null) && ($cate_bov != null)) {
        $sql = "SELECT
                        * 
                    FROM
                        tb_compra
                        INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
                        INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
                        INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                        INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
                    WHERE
                        tb_expediente.nva_tipo_bovino = '$cate_bov' 
                        AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
                        AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

        $filtros = array('Fecha y Hora',utf8_decode('Proveedor'), 'Bovino', 'Precio $');
        $total = 312;
        $feh = 340;
    }else{
        $sql = "SELECT
                        * 
                    FROM
                        tb_venta
                        INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                        INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                        INNER JOIN tb_detalle_venta ON tb_venta.int_idventa = tb_detalle_venta.int_idventa
                        INNER JOIN tb_expediente ON tb_detalle_venta.int_idexpediente = tb_expediente.int_idexpediente  
                    WHERE
                        tb_detalle_venta.int_idexpediente != 'null' 
                        AND tb_venta.dat_fecha_sistema_venta >= 'fecha_inicio' 
                        AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";


        $filtros = array('Fecha y Hora','Proveedor',utf8_decode('Categoría'), 'Bovino', 'Precio $');
        $total = 340;
        $feh = 440;

    }

    $result = $modelo->get_query($sql);
    $header = array('Nombre','Costo U.','Precio U.', 'Iva', 'Venta', 'Utilidad Total');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    if ($idempleado != null && ($cate_bov == null) ) {
        $pdf->Cell(60,10,"Proveedor: ".$result[2][0]['nva_nom_proveedor'],0,0,'C');
    }else if (($idempleado == null) && ($cate_bov != null)) {
        $pdf->Cell(65,10,utf8_decode("Categoría: ".$categoria),0,0,'C');
    }else if (($idempleado != null) && ($cate_bov != null)) {
        $pdf->Cell(60,10,"Proveedor: ".$result[2][0]['nva_nom_proveedor'],0,0,'C');
        $pdf->Cell(65,10,utf8_decode("Categoría: ".$categoria),0,0,'C');
    }   
    $pdf->Cell($feh,10,"Fecha: ".$fecha_actual." "."Hora: ".$hora_actual,0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result);
    $pdf->Ln(5);
    //$pdf->Cell(30,10,utf8_decode('Inversión total: '),0,0,'C');
    $pdf->Cell($total,10,utf8_decode("$".$GLOBALS['utilidad_total']),0,0,'C');
    $pdf->Cell($total,10,utf8_decode("$".$GLOBALS['costo_total']),0,0,'C');
    $pdf->Cell($total,10,utf8_decode("$".$GLOBALS['precio_total']),0,0,'C');
    $pdf->Cell($total,10,utf8_decode("$".$GLOBALS['iva_total']),0,0,'C');
    $pdf->Cell($total,10,utf8_decode("$".$GLOBALS['subtotal_item']),0,0,'C'); 
    $pdf->Output(); 



function datetimeformateado($fecha3){

            //divido la feha de la hora
            $separacion= explode(" ",$fecha3);
            $hora = $separacion[1];
            $fecha = $separacion[0];

            $pos = strpos($fecha, "/");
            if ($pos === false) $fecha = explode("-",$fecha);
            else $fecha = explode("/",$fecha);
            $dia1 = (strlen($fecha[0])==1) ? '0'.$fecha[0] : $fecha[0];

            //Concateno la fecha formteada con la hora y un espacio
            $fecha1 = $fecha[2].'-'.$fecha[1].'-'.$dia1.' '.$hora;
            return $fecha1;
}  

?>