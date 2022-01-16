<?php 
 date_default_timezone_set('America/El_Salvador');
require_once("../pdf/tfpdf.php");
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
$GLOBALS['utilidad_total'] = 0;
$GLOBALS['costo_total_pro'] = 0;
$GLOBALS['precio_total_pro'] = 0;
$GLOBALS['cantidad_total'] = 0;
$GLOBALS['costo_to'] = 0;
$GLOBALS['iva_total'] = 0;
$GLOBALS['venta_total_p'] = 0;
$utilidad = 0;
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
            $this->Cell(30,10,'REPORTE DE VENTAS DE LECHE Y DERIVADOS',0,0,'C');
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
        function FancyTable($header,$result){
            // Colores, ancho de línea y fuente en negrita

            $this->SetFillColor(224,235,255);//Color de las cabeceras
            $this->SetTextColor(0);
            //Color de las lineas de la tabla
            $this->SetDrawColor(176, 196, 222);
            $this->SetLineWidth(.3);
            $this->SetFont('Arial','B');
            // Cabecera
            
            $w = array(50, 30, 30, 30, 30, 30, 30, 30);
            
            
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            
            // Datos
            //http://localhost/poryecto_DISE%C3%91OII/DISE%C3%91OII_VACAFE_G07/
           
                $costo_total = 0;
                if($result[0] == '1' && $result[4] >= 1){
                    $fill = false;
                    foreach ($result[2]  as $row) {

                        
                        
                        $costo_total = ($row['dou_costo_producto'] * $row['int_cantidad_vender']);
                        $utilidad = ($row['dou_total_venta'] - $costo_total);

                        $this->Cell($w[0],6,$row['nva_nom_producto'],'LR',0,'L',$fill);
                        $this->Cell($w[1],6,"$".number_format($row['dou_costo_producto'], 2),'LR',0,'C',$fill); 
                        $this->Cell($w[2],6,"$".number_format($row['dou_precio_venta'], 2),'LR',0,'C',$fill);
                        $this->Cell($w[3],6,$row['int_cantidad_vender'],'LR',0,'C',$fill);
                        $this->Cell($w[4],6,"$".number_format($costo_total, 2),'LR',0,'C',$fill);
                        $this->Cell($w[5],6,"$".number_format($row['dou_iva_venta'], 2),'LR',0,'C',$fill);
                        $this->Cell($w[6],6,"$".number_format($row['dou_total_venta'], 2),'LR',0,'C',$fill);
                        $this->Cell($w[7],6,"$".number_format($utilidad, 2),'LR',0,'C',$fill);
                        $this->Ln();
                        $fill = !$fill;
                        $GLOBALS['utilidad_total'] = $GLOBALS['utilidad_total'] + $utilidad;
                        $GLOBALS['costo_total_pro'] = $GLOBALS['costo_total_pro'] + $row['dou_costo_producto'];
                        $GLOBALS['precio_total_pro'] = $GLOBALS['precio_total_pro'] + $row['dou_precio_venta'];
                        $GLOBALS['cantidad_total'] = $GLOBALS['cantidad_total'] + $row['int_cantidad_vender'];
                        $GLOBALS['costo_to'] = $GLOBALS['costo_to'] + $costo_total;
                        $GLOBALS['iva_total'] = $GLOBALS['iva_total'] + $row['dou_iva_venta'];
                        $GLOBALS['venta_total_p'] = $GLOBALS['venta_total_p'] + $row['dou_total_venta'];

                    }
                }else{
                    echo $result;
                }
            
           
            
            $this->Cell(array_sum($w),0,'','T');
        }
        function Totales($header){
            // Colores, ancho de línea y fuente en negrita

            $this->SetFillColor(224,235,255);//Color de las cabeceras
            $this->SetTextColor(0);
            //Color de las lineas de la tabla
            $this->SetDrawColor(176, 196, 222);
            $this->SetLineWidth(.3);
            $this->SetFont('Arial','B');
            // Cabecera
            
            $w = array(50, 30, 30, 30, 30, 30, 30, 30);
            
            
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Restauración de colores y fuentes
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
           
            
            $this->Cell(array_sum($w),0,'','T');
        }

}
    




    $pdf = new PDF('L','mm','A4');   
    // Títulos de las columnas
    
    $fecha_inicio = $_GET['fei'];
    $fecha_fin = $_GET['fef'];
    $idempleado = $_GET['ide'];
    $producto = $_GET['pro'];
    $tipo_pro = "";
    $fecha_actual = date('d-m-Y');
    $hora_actual = date('H:i:s');
    $feh = 0;
   

    if (($idempleado != null) && ($producto != null) ) {
       if ($producto == 'Botella de Leche') {
            $sql = "SELECT
                        * 
                    FROM
                        tb_venta
                        INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                        INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                        INNER JOIN tb_producto
                        INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                            AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                        INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                    WHERE
                        tb_venta.int_idempleado = $idempleado 
                        AND tb_producto.nva_nom_producto = '$producto'
                        AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
                        AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

        }else{
           $sql = "SELECT
                        * 
                    FROM
                        tb_venta
                        INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                        INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                        INNER JOIN tb_producto
                        INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                            AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                        INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                    WHERE
                        tb_venta.int_idempleado = $idempleado
                        AND tb_producto.int_idcategoria = '$producto'
                        AND tb_producto.nva_nom_producto != 'Botella de Leche '
                        AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
                        AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";
        }

           $feh = 225;

    }else if (($idempleado != null) && ($producto == null) ) {

      $sql = "SELECT
                    * 
                FROM
                    tb_venta
                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                    INNER JOIN tb_producto
                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                            AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                WHERE
                    tb_venta.int_idempleado = $idempleado
                    AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

        $feh = 310;

    }else if (($idempleado == null) && ($producto != null)) {
        if ($producto == 'Botella de Leche') {
                $sql = "SELECT
                            * 
                        FROM
                            tb_venta
                            INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                            INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                            INNER JOIN tb_producto
                            INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                            AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                            INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                        WHERE
                            tb_producto.nva_nom_producto = '$producto'
                            AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
                            AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

            }else{
                $sql = "SELECT
                            * 
                        FROM
                            tb_venta
                            INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                            INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                            INNER JOIN tb_producto
                            INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                            AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                            INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                        WHERE
                            tb_producto.int_idcategoria = '$producto' 
                            AND tb_producto.nva_nom_producto != 'Botella de Leche '
                            AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
                            AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";
            }
        $feh = 340;
    
    }else{
       $sql = "SELECT
                    * 
                FROM
                    tb_venta
                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                    INNER JOIN tb_producto
                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria    
                WHERE
                    tb_venta.dat_fecha_sistema_venta >= 'fecha_inicio' 
                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

        $feh = 440;

    }

    $result = $modelo->get_query($sql);

    $header = array('Nombre','Costo U.','Precio U.', 'Cantidad', 'Costo To.', 'Iva', 'Venta To.', 'Utilidad To.');
   
    $pdf->AliasNbPages();
    $pdf->AddPage();

    if ($idempleado != null && ($producto == null) ) {
        $pdf->Cell(90,10, utf8_decode("Empleado: ".$result[2][0]['nva_nom_empleado']." ".$result[2][0]['nva_ape_empleado']),0,0,'C');
    }else if (($idempleado != null) && ($producto != null)) {
        $pdf->Cell(60,10,utf8_decode("Empleado: ".$result[2][0]['nva_nom_empleado']." ".$result[2][0]['nva_ape_empleado']),0,0,'C');
    } 

    $pdf->Cell($feh,10,"Fecha: ".$fecha_actual." "."Hora: ".$hora_actual,0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result); 
    $header2 =  array('Totales',"$".number_format($GLOBALS['costo_total_pro'], 2),"$".number_format($GLOBALS['precio_total_pro'], 2), $GLOBALS['cantidad_total'], "$".number_format($GLOBALS['costo_to'], 2), "$".number_format($GLOBALS['iva_total'], 2), "$".number_format($GLOBALS['venta_total_p'], 2), "$".number_format($GLOBALS['utilidad_total'], 2)); 
    $pdf->Ln(10);
    $pdf->Totales($header2);
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