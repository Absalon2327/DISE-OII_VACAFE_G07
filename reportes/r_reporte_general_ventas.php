<?php 

require_once("../pdf/tfpdf.php");
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
$GLOBALS['total_venta'] = 0;
$fecha_inicio = "";
$fecha_fin = "";
$genera_report = "si_generar";

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
            $this->Cell(30,10,'REPORTE DE VENTAS GENERALES',0,0,'C');
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
            
            $w = array(45, 30, 30, 75, 25, 25);
            
            
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
                        if ($row['nva_ape_cliente'] == null) {
                            $ape_cliente ="";
                        }else{
                            $ape_cliente = $row['nva_ape_cliente'];
                        }
                        if ($row['dou_iva_venta'] == '0.00') {
                            $iva ="";
                        }else{
                            $iva = $row['dou_iva_venta'];
                        }

                       // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador"; 

                        $this->Cell($w[0],6,datetimeformateado($row['dat_fecha_sistema_venta']),'LR',0,'C',$fill);
                        $this->Cell($w[1],6,utf8_decode($row['nva_tipo_documento']),'LR',0,'R',$fill);
                        $this->Cell($w[2],6,numerofactura($row['int_num_doc']),'LR',0,'L',$fill);
                        $this->Cell($w[3],6,$row['nva_nom_cliente']." ".$ape_cliente,'LR',0,'L',$fill);
                        $this->Cell($w[4],6,"$".$iva,'LR',0,'C',$fill);
                        $this->Cell($w[5],6,"$".$row['dou_total_venta'],'LR',0,'C',$fill);                       
                         $this->Ln();
                        $fill = !$fill;
                       
                        $GLOBALS['total_venta'] = $GLOBALS['total_venta'] + $row['dou_total_venta'];
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
    $fecha_actual = date('d-m-Y');
    $hora_actual = date('H:i:s');
    $feh= 0;
    $total = 0;
    if ($idempleado != null) {
        $sql = "SELECT
                    * 
                FROM
                    tb_venta
                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado  
                WHERE
                    dat_fecha_sistema_venta >= '$fecha_inicio' 
                    AND dat_fecha_sistema_venta <= '$fecha_fin' 
                    AND tb_venta.int_idempleado ='$idempleado'";
    $feh= 240;
    $total = 410;      
    }else{
        $sql = "SELECT
                    * 
                FROM
                    tb_venta
                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado  
                WHERE
                    dat_fecha_sistema_venta >= '$fecha_inicio' 
                    AND dat_fecha_sistema_venta <= '$fecha_fin'";
       $feh= 440;
       $total = 420;
    }
    $header = array('Fecha y Hora','Documento', 'No.', 'Cliente', 'Iva', 'Total');
    $result = $modelo->get_query($sql);

    $pdf->AliasNbPages();
    $pdf->AddPage();
    if ($idempleado != null) {
        $pdf->Cell(100,10,utf8_decode("Empleado: ".$result[2][0]['nva_nom_empleado']." ".$result[2][0]['nva_ape_empleado']),0,0,'C');
    }    
    $pdf->Cell($feh ,10,"Fecha: ".$fecha_actual." "."Hora: ".$hora_actual,0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result);   
    $pdf->Ln(5);
    $pdf->Cell($total,10,"Venta Total: $".$GLOBALS['total_venta'],0,0,'C'); 
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
function numerofactura($numero){
        //divido la feha de la hora
        $cifras = $numero;
        $numero_factura = "";


        if (strlen($cifras) == 1) {
            return $numero_factura = '00000'.$numero;

        }else if (strlen($cifras) == 2){
            return $numero_factura = '0000'.$numero;

        }else if (strlen($cifras) == 3){
            return $numero_factura = '000'.$numero;

        }else if (strlen($cifras) == 4){
            return $numero_factura = '00'.$numero;

        }else if (strlen($cifras) == 5){
            return $numero_factura = '0'.$numero;

        }else{
            return $numero;
        }
}

?>