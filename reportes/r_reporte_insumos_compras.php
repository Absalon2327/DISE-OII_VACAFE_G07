<?php 
 date_default_timezone_set('America/El_Salvador');
require_once("../pdf/tfpdf.php");
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
$GLOBALS['total_inver'] = 0;
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
            $this->Cell(30,10,'REPORTE DE COMPRAS DE MEDICAMENTOS E INSUMOS',0,0,'C');
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
            if (count($header) == 4) {
                $w = array(60, 60, 20, 60);

            }else if (count($header) == 5)  {
                $w = array(60, 65, 40, 20, 40);
               
            }else{
                $w = array(60, 50, 50, 50, 20,40);
            }
            
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            
            // Datos
            //http://localhost/poryecto_DISE%C3%91OII/DISE%C3%91OII_VACAFE_G07/
           
            if (count($header) == 4) {
                if($result[0]=='1'){
                    $fill = false;
                    foreach ($result[2]  as $row) {

                       // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador";


                        $this->Cell($w[0],6,datetimeformateado($row['dat_fecha_sistema']),'LR',0,'C',$fill);
                        $this->Cell($w[1],6,$row['nva_nom_producto'],'LR',0,'L',$fill);
                        $this->Cell($w[2],6,$row['int_cantidad_compra'],'LR',0,'C',$fill);
                        $this->Cell($w[3],6,"$".number_format($row['dou_total_compra'], 2),'LR',0,'C',$fill);
                        $this->Ln();
                        $fill = !$fill;
                        $GLOBALS['total_inver'] = $GLOBALS['total_inver'] + $row['dou_total_compra'];
                    }
                }
            }else if (count($header) == 5)  {
                if($result[0]=='1'){
                    $fill = false;
                    if ($header[1] == 'Categoría') {                        
                   
                        foreach ($result[2]  as $row) {

                           // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador";
                           if ($row['nva_tipo_bovino'] == "vaca_lechera") {
                            $categoria = "Vaca Lechera";
                            } 

                            $this->Cell($w[0],6,datetimeformateado($row['dat_fecha_sistema']),'LR',0,'C',$fill);
                            $this->Cell($w[1],6,$categoria,'LR',0,'L',$fill);
                            $this->Cell($w[2],6,$row['nva_nom_producto'],'LR',0,'L',$fill);
                            $this->Cell($w[3],6,$row['int_cantidad_compra'],'LR',0,'C',$fill);
                            $this->Cell($w[4],6,"$".number_format($row['dou_total_compra'], 2),'LR',0,'C',$fill);
                            $this->Ln();
                            $fill = !$fill;
                            $GLOBALS['total_inver'] = $GLOBALS['total_inver'] + $row['dou_total_compra'];
                        }
                    }else{
                        foreach ($result[2]  as $row) {

                           // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador";
                           

                            $this->Cell($w[0],6,datetimeformateado($row['dat_fecha_sistema']),'LR',0,'C',$fill);
                            $this->Cell($w[1],6,$row['nva_nom_categoria'],'LR',0,'L',$fill);
                            $this->Cell($w[2],6,$row['nva_nom_producto'],'LR',0,'L',$fill);
                            $this->Cell($w[3],6,$row['int_cantidad_compra'],'LR',0,'C',$fill);
                            $this->Cell($w[4],6,"$".number_format($row['dou_total_compra'], 2),'LR',0,'C',$fill);
                            $this->Ln();
                            $fill = !$fill;
                            $GLOBALS['total_inver'] = $GLOBALS['total_inver'] + $row['dou_total_compra'];
                        }
                    }
                }
            }else{
                if($result[0]=='1'){
                    $fill = false;
                    foreach ($result[2]  as $row) {

                       // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador"; nva_nom_categoria
                       
                        $this->Cell($w[0],6,datetimeformateado($row['dat_fecha_sistema']),'LR',0,'C',$fill);
                        $this->Cell($w[1],6,$row['nva_nom_proveedor'],'LR',0,'L',$fill);
                        $this->Cell($w[2],6,$row['nva_nom_categoria'],'LR',0,'L',$fill);
                        $this->Cell($w[3],6,$row['nva_nom_producto'],'LR',0,'L',$fill);
                        $this->Cell($w[4],6,$row['int_cantidad_compra'],'LR',0,'C',$fill);
                        $this->Cell($w[5],6,"$".number_format($row['dou_total_compra'], 2),'LR',0,'C',$fill);
                        $this->Ln();
                        $fill = !$fill;
                        $GLOBALS['total_inver'] = $GLOBALS['total_inver'] + $row['dou_total_compra'];
                    }
                }
            }
           
            
            $this->Cell(array_sum($w),0,'','T');
        }
}
    




    $pdf = new PDF('L','mm','A4');   
    // Títulos de las columnas
    
    $fecha_inicio = $_GET['fei'];
    $fecha_fin = $_GET['fef'];
    $idproveedor = $_GET['idp'];
    $cate_pro = $_GET['cat'];
    $categoria = "";
    $fecha_actual = date('d-m-Y');
    $hora_actual = date('H:i:s');
    $feh = 0;
   

    if (($idproveedor != null) && ($cate_pro != null) ) {
        $sql = "SELECT
                    * 
                FROM
                    tb_compra
                    INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
                        INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                        INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
                        INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria  
                WHERE
                    tb_proveedor.int_idproveedor = $idproveedor 
                    AND tb_categoria.nva_nom_categoria = '$cate_pro' 
                    AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
                    AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

           $filtros = array('Fecha y Hora', 'Producto', 'Cantidad', 'Precio $');
           $total = 280;
           $feh = 225;

    }else if (($idproveedor != null) && ($cate_pro == null) ) {

        $sql = "SELECT
                        * 
                    FROM
                        tb_compra
                        INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
                        INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                        INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
                        INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
                    WHERE
                        tb_proveedor.int_idproveedor = $idproveedor
                        AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
                        AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

        $filtros = array('Fecha y Hora', utf8_decode('Categoría'), 'Producto', 'Cantidad', 'Precio $');
        $total = 350;
        $feh = 340;

    }else if (($idproveedor == null) && ($cate_pro != null)) {
        $sql = "SELECT
                        * 
                    FROM
                        tb_compra
                        INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
                        INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                        INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
                        INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
                    WHERE
                        tb_categoria.nva_nom_categoria = '$cate_pro' 
                        AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
                        AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

        $filtros = array('Fecha y Hora',utf8_decode('Proveedor'), 'Producto', 'Cantidad', 'Precio $');
        $total = 350;
        $feh = 340;
    
    }else{
        $sql = "SELECT
                        * 
                FROM
                    tb_compra
                    INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
                    INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
                    INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
                 WHERE
                    tb_detalle_compra.int_idproducto != 'null' 
                    AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
                    AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";


        $filtros = array('Fecha y Hora','Proveedor',utf8_decode('Categoría'), 'Producto', 'Cantidad', 'Precio $');
        $total = 440;
        $feh = 440;

    }

    $result = $modelo->get_query($sql);
    $header = $filtros;
    $pdf->AliasNbPages();
    $pdf->AddPage();
    if ($idproveedor != null && ($cate_pro == null) ) {
        $pdf->Cell(60,10,"Proveedor: ".$result[2][0]['nva_nom_proveedor'],0,0,'C');
    }else if (($idproveedor == null) && ($cate_pro != null)) {
        $pdf->Cell(65,10,utf8_decode("Categoría: ".$cate_pro),0,0,'C');
    }else if (($idproveedor != null) && ($cate_pro != null)) {
        $pdf->Cell(60,10,"Proveedor: ".$result[2][0]['nva_nom_proveedor'],0,0,'C');
        $pdf->Cell(65,10,utf8_decode("Categoría: ".$cate_pro),0,0,'C');
    }   
    $pdf->Cell($feh,10,"Fecha: ".$fecha_actual." "."Hora: ".$hora_actual,0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result);
    $pdf->Ln(5);
    $pdf->Cell(30,10,utf8_decode('Inversión total: '),0,0,'C');
    $pdf->Cell($total,10,"$".number_format($GLOBALS['total_inver'], 2),0,0,'C'); 
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