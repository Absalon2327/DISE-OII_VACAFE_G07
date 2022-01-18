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
            $this->Cell(30,10,'REPORTE DE CATEGORIAS POR PRODUCTO',0,0,'C');
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
            $w = array(45, 40, 50, 30, 30);
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

                    $this->Cell($w[0],6,dateformateado($row['dat_fecha_vencimiento']),'LR',0,'C',$fill);
                    $this->Cell($w[1],6,$row['nva_nom_producto'],'LR',0,'C',$fill);
                    $this->Cell($w[2],6,$row['txt_descrip_producto'],'LR',0,'C',$fill);
                    $this->Cell($w[3],6,"$".number_format($row['dou_precio_venta_producto'],2),'LR',0,'C',$fill);
                    $this->Cell($w[4],6,$row['int_existencia'],'LR',0,'C',$fill);
                     $this->Ln();
                    $fill = !$fill;
                }
            }
            
            $this->Cell(array_sum($w),0,'','T');
        }
}
    




    $pdf = new PDF();   
    // Títulos de las columnas
    $header = array('Fecha Vencimiento', 'Producto', utf8_decode('Descripción'), 'Precio', 'Existencia');
    $fecha_inicio = $_GET['fei'];
    $fecha_fin = $_GET['fef'];
    $idcategoria = $_GET['idp'];
    $sql = "SELECT * FROM tb_producto
            INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
            WHERE dat_fecha_vencimiento >= '$fecha_inicio' AND dat_fecha_vencimiento <= '$fecha_fin' 
            AND tb_producto.int_idcategoria = '$idcategoria'";
    $result = $modelo->get_query($sql);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cell(70,10,"Categoria: ".$result[2][0]['nva_nom_categoria'],0,0,'C');
    $pdf->Ln(10);
    $pdf->FancyTable($header,$result);
    $pdf->Ln(5);
    $pdf->Output();



function dateformateado($fecha){

            $pos = strpos($fecha, "/");
            if ($pos === false) $fecha = explode("-",$fecha);
            else $fecha = explode("/",$fecha);
            $dia1 = (strlen($fecha[0])==1) ? '0'.$fecha[0] : $fecha[0];
            $fecha1 = $fecha[2].'-'.$fecha[1].'-'.$dia1;
            return $fecha1;
}

?>
