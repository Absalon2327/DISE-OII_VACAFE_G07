<?php 

require_once("../pdf/tfpdf.php");
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
$GLOBALS['total_inver'] = 0;
$fecha_inicio = "";
$fecha_fin = "";
$genera_report = "si_generar";

class PDF extends tFPDF{
            // Cabecera de página

        function Header(){
            // Arial bold 15
            
            
            $this->SetFont('Arial','B',12);
            $this->Image('../dist/img/logo-n.png',10,8,33);
             $this->Image('../dist/img/ues-a.png',160,8,33);
            $this->Cell(80);

            $this->Cell(30,10,utf8_decode('FINCA LA VACA CAFÉ'),0,0,'C');
             $this->Cell(80);             
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,'Calle La India',0,0,'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,'Poligono A, Lote 4,',0,0,'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30,10,utf8_decode('Barrio San Juan, Cojutepeque, Cuscatlán.'),0,0,'C');
            $this->Cell(80);
           
           
          
           // Salto de línea
            $this->Ln(20);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,10,utf8_decode('REPORTE DE MORTALIDAD'),0,0,'C');
            // Salto de línea
            $this->Ln(10);

            
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
            $w = array(70,50,70);
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

                   // $tipo = ($row['tipo_persona']==2) ? "Empleado": "Administrador"; 

                    $this->Cell($w[0],6,$row['nva_nom_bovino'],'LR',0,'C',$fill);
                    $this->Cell($w[1],6,$row['fehca_baja'],'LR',0,'C',$fill);
                     $this->Cell($w[2],6,$row['descripcion_baja'],'LR',0,'C',$fill);
                   
                     $this->Ln();
                    $fill = !$fill;
                    //$GLOBALS['total_inver'] = $GLOBALS['total_inver'] + $row['dou_total_compra'];
                }
            }
            
            $this->Cell(array_sum($w),0,'','T');
        }
}
    




    $pdf = new PDF();   
    // Títulos de las columnas
    $header = array('BOVINO','FECHA DE BAJA',utf8_decode('DESCRIPCIÓN'));
    $sql = "SELECT
    nva_nom_bovino, 
descripcion_baja, 
date_format(fehca_baja, '%d/%m/%Y') as fehca_baja

FROM
    tb_baja
    INNER JOIN
    tb_expediente
    ON 
        idexpeiente_baja = tb_expediente.int_idexpediente";
    $result = $modelo->get_query($sql);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    //$pdf->Cell(60,10,"BOVINO: ".$result[2][0]['mama'],0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result);
    $pdf->Ln(5);
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