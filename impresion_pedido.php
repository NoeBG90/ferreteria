<?php
ini_set("display_errors","1");


require('pdf/fpdf.php');
$id_cotizacion=$_GET['id_cotizacion'];
include "conexion/conexion.php";
        $conexio=   conectar_bd();
        $query="select folio_operacion ,vigencia_operacion , tiempo_entrega ,consideraciones , 
                total , subtotal ,iva,iva_porcentual , e.nombre as empleado,c2.nombre as cliente ,c2.nom_contacto ,c.fecha_registro ,c2.direccion,c2.telefono ,metodo_pago
                from operaciones c ,empleados e,clientes c2 WHERE 
                c.id_empleado =e.id_empleado and c.id_cliente =c2.id_cliente and id_operacion =".$id_cotizacion;

        $result=$conexio->query($query);
        $folio_cotizacion="";
        $vigencia_cotizacion="";
        $tiempo_entrega="";
        $consideraciones="";
        $total="";
        $subtotal="";
        $iva="";
        $iva_porcentual="";
        $empleado="";
        $cliente="";
        $nom_contacto="";
        $fecha_registro="";
        $direccion="";
        $telefono="";
        $metodo_pago="";

        while($fila=$result->fetch_assoc()){
            $folio_cotizacion=$fila['folio_operacion'];
            $vigencia_cotizacion=$fila['vigencia_operacion'];
            $tiempo_entrega=$fila['tiempo_entrega'];
            $consideraciones=$fila['consideraciones'];
            $total=$fila['total'];
            $subtotal=$fila['subtotal'];
            $iva=$fila['iva'];
            $iva_porcentual=$fila['iva_porcentual'];
            $empleado=$fila['empleado'];
            $cliente=$fila['cliente'];
            $nom_contacto=$fila['nom_contacto'];
            $fecha_registro = $fila['fecha_registro'];
            $direccion= $fila['direccion'];
            $telefono= $fila['telefono'];
            $metodo_pago =$fila['metodo_pago'];
        }



            $queryvendedor="select e.* from clientes c,empleados e,operaciones c2 where
            c.id_empleado =e.id_empleado
            and c2.id_cliente =c.id_cliente 
            and c2.id_operacion=".$id_cotizacion;
            $vendedor="";
            $result_vendedor=$conexio->query($queryvendedor);
        while($filavendedor=$result_vendedor->fetch_assoc()){
            $vendedor=$filavendedor['nombre'];
        }


        $querydetalle="select p.producto, p.descripcion,dc.cantidad ,dc.precio ,dc.descuento ,dc.subtotal, p.unidad_medida from detalle_operaciones dc,productos p ,operaciones c 
where dc.id_producto =p.id_producto and dc.id_operacion =c.id_operacion and c.id_operacion = ".$id_cotizacion;
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

            $this->MultiCell($w,8,$data[$i],1,$a,'true');

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
    $this->Cell(30,10, iconv('utf-8', 'cp1252','Pedido'),0,0,'C');
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
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Folio: '.$folio_cotizacion),0,1,'R');
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Fecha: '.$fecha_registro ),0,1,'R');
$pdf->Cell(0,7,iconv('utf-8', 'cp1252',"Atendió: ".$empleado),0,1,'R');
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Consideraciones: '.$consideraciones),0,1,'R');
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'T. Entrega: '.$tiempo_entrega),0,1,'R');
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Método Pago: '.$metodo_pago),0,1,'R');

$pdf->Cell(0,7,iconv('utf-8', 'cp1252', 'Cliente: '.$cliente),0,1);
$pdf->Cell(0,7,iconv('utf-8', 'cp1252',"Dirección: ".$direccion),0,1);
$pdf->Cell(0,7,iconv('utf-8', 'cp1252',"Teléfono: ".$telefono),0,1);
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Vendedor: '.$vendedor),0,1);



$pdf->Ln(3);
$pdf->SetWidths(array(15,15,85, 25, 25,25));
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(29,29,29);
$pdf->SetTextColor(255);
// usamos nuestra funcion creada para listar celdas con varias lineas
$pdf->Row(array('Unidad','Cantidad','Producto', 'P. Unitario.', 'Descuento %','Importe'));
// Creamos nuestra funcion consulta
$i = 0;
$n=0;

while($fila_detalle=$result_detalle->fetch_assoc()){
    $n++;
    $pdf->SetFont('Arial','',9);

    if($i%2 == 1){

        $pdf->SetFillColor(181,175,173);
        $pdf->SetTextColor(0);
        $pdf->Row(array($fila_detalle['unidad_medida'],$fila_detalle['cantidad'],iconv('utf-8', 'cp1252', $fila_detalle['producto']),"$".$fila_detalle['precio'],$fila_detalle['descuento'],"$".$fila_detalle['subtotal']));
        $i++;
    }else{
        $pdf->SetFillColor(212,204,202);
        $pdf->SetTextColor(0);
        $pdf->Row(array($fila_detalle['unidad_medida'],$fila_detalle['cantidad'],iconv('utf-8', 'cp1252', $fila_detalle['producto']),"$".$fila_detalle['precio'],$fila_detalle['descuento'],"$".$fila_detalle['subtotal']));
        $i++;
    }

}
$pdf->Ln(3);
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Subtotal: $'. $subtotal),0,1,'R');
$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'IVA: $'.$iva),0,1,'R');

$pdf->Cell(0,7, iconv('utf-8', 'cp1252', 'Total: $'.$total),0,1,'R');

$pdf->Output();
?>
