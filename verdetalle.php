<?php
ini_set("display_errors","1");
require('pdf/fpdf.php');
$idcompra=$_GET['idcompra'];
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="SELECT folio_compra,folio_factura,e.nombre as 'empleado', p.nombre as 'proveedor' ,c.fecha_compra ,c.fecha_registro ,c.total ,c.subtotal ,c.iva_monto
        FROM compras c,empleados e, proveedores p where
         c.id_empleado =e.id_empleado  and c.id_proveedor =p.id_proveedor  and id_compra=".$idcompra;
        $result=$conexio->query($query);
        $folio_factura="";
        $folio_compra="";
        $empleado="";
        $proveedor="";
        $fecha_compra="";
        $fecha_registro="";
        $subtotal="";
        $total="";
        $iva="";
        while($fila=$result->fetch_assoc()){
          $folio_factura=$fila['folio_factura'];
          $folio_compra=$fila['folio_compra'];
          $empleado=$fila['empleado'];
          $proveedor=$fila['proveedor'];
          $fecha_compra=$fila['fecha_compra'];
          $fecha_registro=$fila['fecha_registro'];
          $subtotal=$fila['subtotal'];
          $iva=$fila['iva_monto'];
          $total=$fila['total'];
        }


        $querydetalle="select p.producto ,p.SKU ,dc.cantidad ,dc.precio_compra  from detalle_compras dc, productos p ,compras c where dc.id_producto =p.id_producto and dc.id_compra =c.id_compra  and c.id_compra= ".$idcompra;
        $result_detalle=$conexio->query($querydetalle);

class PDF extends FPDF
{
var $widths;
    var $aligns;


function SetWidths($w)
    {

        $this->widths=$w;
    }

    function SetAligns($a)
    {

        $this->aligns=$a;
    }

    function Row($data)
    {

        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=8*$nb;

        $this->CheckPageBreak($h);

        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

            $x=$this->GetX();
            $y=$this->GetY();


            $this->Rect($x,$y,$w,$h);

            $this->MultiCell($w,8,$data[$i],0,$a,'true');

            $this->SetXY($x+$w,$y);
        }

        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {

        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {

        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10, iconv('utf-8', 'cp1252','Compra'),1,0,'C');
    // Salto de línea
    $this->Ln(30);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10, iconv('utf-8', 'cp1252','Folio de compra: '.$folio_compra),0,1,'R');
$pdf->Cell(0,10, iconv('utf-8', 'cp1252', 'Factura: '.$folio_factura),0,1,'R');
$pdf->Cell(0,10, iconv('utf-8', 'cp1252', 'Capturó: '.$empleado),0,1,'R');
$pdf->Cell(0,10, iconv('utf-8', 'cp1252', 'Proveedor: '.$proveedor),0,1,'R');

$pdf->Cell(30,6,'Fecha Compra: '.$fecha_compra,0,1);
$pdf->Cell(0,6,"Fecha Registro: ".$fecha_registro,0,1);

$pdf->Ln(10);

$pdf->SetWidths(array(10,40, 90, 25, 25));
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(29,29,29);
$pdf->SetTextColor(255);
// usamos nuestra funcion creada para listar celdas con varias lineas
$pdf->Row(array('#','SKU','Producto', 'Cantidad', 'Precio'));
// Creamos nuestra funcion consulta
$i = 0;
$n=0;

while($fila_detalle=$result_detalle->fetch_assoc()){
    $n++;
    $pdf->SetFont('Arial','',9);

    if($i%2 == 1){

        $pdf->SetFillColor(181,175,173);
        $pdf->SetTextColor(0);
        $pdf->Row(array($n,$fila_detalle['SKU'],$fila_detalle['producto'],$fila_detalle['cantidad'],"$".$fila_detalle['precio_compra']));
        $i++;
    }else{
        $pdf->SetFillColor(212,204,202);
        $pdf->SetTextColor(0);
        $pdf->Row(array($n,$fila_detalle['SKU'],$fila_detalle['producto'],$fila_detalle['cantidad'],"$".$fila_detalle['precio_compra']));
        $i++;
    }

}
$pdf->Cell(0,5, iconv('utf-8', 'cp1252', 'Subtotal: $'. $subtotal),0,1,'R');
$pdf->Cell(0,5, iconv('utf-8', 'cp1252', 'IVA: $'.$iva),0,1,'R');

$pdf->Cell(0,5, iconv('utf-8', 'cp1252', 'Total: $'.$total),0,1,'R');

$pdf->Output();
?>
