<?php
header('Content-type: application/pdf; charset="utf-8"',true);
require('../pdf_lib/fpdf.php');
class PDF extends FPDF
{

var $B;
var $I;
var $U;
var $HREF;

var $widths;
var $aligns;

function PDF($orientation='P',$unit='mm',$format='A4')
{
	//Llama al constructor de la clase padre
	$this->FPDF($orientation,$unit,$format);
	//Iniciación de variables
	$this->B=0;
	$this->I=0;
	$this->U=0;
	$this->HREF='';
}

function WriteHTML($html)
{
	//Intérprete de HTML
	$html=str_replace("\n",' ',$html);
	$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
	foreach($a as $i=>$e)
	{
		if($i%2==0)
		{
			//Text
			if($this->HREF)
				$this->PutLink($this->HREF,$e);
			else
				$this->Write(5,$e);
		}
		else
		{
			//Etiqueta
			if($e[0]=='/')
				$this->CloseTag(strtoupper(substr($e,1)));
			else
			{
				//Extraer atributos
				$a2=explode(' ',$e);
				$tag=strtoupper(array_shift($a2));
				$attr=array();
				foreach($a2 as $v)
				{
					if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						$attr[strtoupper($a3[1])]=$a3[2];
				}
				$this->OpenTag($tag,$attr);
			}
		}
	}
}

function OpenTag($tag,$attr)
{
	//Etiqueta de apertura
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,true);
	if($tag=='A')
		$this->HREF=$attr['HREF'];
	if($tag=='BR')
		$this->Ln(5);
}

function CloseTag($tag)
{
	//Etiqueta de cierre
	if($tag=='B' || $tag=='I' || $tag=='U')
		$this->SetStyle($tag,false);
	if($tag=='A')
		$this->HREF='';
}

function SetStyle($tag,$enable)
{
	//Modificar estilo y escoger la fuente correspondiente
	$this->$tag+=($enable ? 1 : -1);
	$style='';
	foreach(array('B','I','U') as $s)
	{
		if($this->$s>0)
			$style.=$s;
	}
	$this->SetFont('',$style);
}

function PutLink($URL,$txt)
{
	//Escribir un hiper-enlace
	$this->SetTextColor(0,0,255);
	$this->SetStyle('U',true);
	$this->Write(5,$txt,$URL);
	$this->SetStyle('U',false);
	$this->SetTextColor(0);
}

//Tabla coloreada
function FancyTable($header)
{
	//Colores, ancho de línea y fuente en negrita
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	
	//Cabecera
	
	for($i=0;$i<count($header);$i++){
		$w=$this->widths[$i];
		$this->Cell($w,7,$header[$i],1,0,'C',1);}
	$this->Ln();
	//Restauración de colores y fuentes
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	
	
}



function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data, $fill)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
		
    //Draw the cells of the row
	 for($i=0;$i<count($data);$i++)
    {
	    $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
		
        $this->Rect($x,$y,$w,$h);
		
			
        //Print the text
        $this->MultiCell($w,5,$data[$i],1,$a,$fill);
	
		     
		//$this->Cell($w,5,$data[$i],'LR',0,$a);
		
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
		
   }
    //Go to the next line
    $this->Ln($h);
	
	
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
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



}

//end-of-CLASS


        // This displays all the data that was submitted. You can
        // remove this without effecting how the FDF data is generated.
        //echo'<pre>POST '; print_r($_POST);echo '</pre>';
        
        if(isset($_REQUEST['first'])){
            // the name field was submitted
            $pat='`[^a-z0-9\s]+$`i';
            if(empty($_REQUEST['first']) || preg_match($pat,$_REQUEST['first'])){
                // no value was submitted or something other than a
                // number, letter or space was included
                die('Invalid input for txtProfesor field.');
            }
            
            if(!isset($_REQUEST['name'])){
                // Why this? What if someone is spoofing form submissions
                // to see how your script works? Only allow the script to
                // continue with expected data, don't be lazy and insecure ;)
                die('You did not submit the correct form.');
            }
			
 function fecha ()
{
$vect=getdate();
$vect_dia=array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
$vect_mes=array("empty","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
return $vect_mes[$vect['mon']];
}

 $monthd =  fecha();       

$pdf=new PDF();

$pdf->AddPage();

$pdf->Cell(7);

//$pdf->Image('../images/canterburyLogo1.jpg',160, 6, 20, 20, 'JPG');

$pdf->SetX(60);
$html2='<u><b>IMPORTE RECIBIDO:</u></b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
//$pdf->SetFont('Arial','B',18);
//$pdf->Cell(150,10,'COPIA PARA EL CLIENTE',0,0,'C');

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(9,12,'Cliente: '.utf8_decode($_REQUEST['name']),0,0,'L');

$pdf->Ln(); 
$pdf->Cell(22,10,'Profesor: '.utf8_decode($_REQUEST['first']." ".$_REQUEST['last1']));
$pdf->Ln();
$pdf->Cell(9,12,'Codigo de ciclo de clase: '.utf8_decode($_REQUEST['entry_group_id']),0,0,'L');
$pdf->SetFont('Arial','',10);
 $pdf->Ln();
$pdf->MultiCell(175,5,'A continuacion le damos a conocer el rango de fechas en las cuales recibira clases de ingles durante el mes de '.$monthd,0,'L');
$pdf->Ln();

$productos0[] = array('Fecha de emision de este ciclo de clases de ingles: ',   $_REQUEST['fecha_recibo']);
$productos0[] = array('Iniciara nuevo ciclo de clases de ingles en la fecha: ', $_REQUEST['startt']);
$productos0[] = array('Terminara ciclo de clases de ingles en la fecha: ',      $_REQUEST['endd']);


$pdf->SetFont('Arial','',14);
$header0=array('Concepto','Valor');
$pdf->SetFont('Arial','',12);

$pdf->SetWidths(array(120,60));
$pdf->FancyTable($header0);

	$fill = false;
for($j=0;$j<count($productos0);$j++){   
    $pdf->Row($productos0[$j], $fill);
	$fill = !$fill;
	}

	
$pdf->Ln();

$pdf->SetFont('Arial','',10);


$pdf->MultiCell(175,5,'Estatus del ultimo ciclo de clases de ingles a: '.utf8_decode($_REQUEST['name']).": ",0,'L');

	
$pdf->Ln();

//Carga de datos


$productos[] = array(utf8_decode('Número de clases: '),$_REQUEST['quantity'],$_REQUEST['quantityr'],$_REQUEST['quantityrt']);
$productos[] = array(utf8_decode('Valor en euros: '),$_REQUEST['total'],$_REQUEST['totalr'],$_REQUEST['totalrt']);



$pdf->SetFont('Arial','',14);
//Títulos de las columnas
$header=array('Concepto','Emitido','Recibido','Diferencial');
$pdf->SetFont('Arial','',12);

//Table with 6 rows and 3 columns
$pdf->SetWidths(array(45,45,45,45));


$pdf->FancyTable($header);
$fill = false;
for($i=0;$i<sizeof($productos);$i++){
    $pdf->Row($productos[$i], $fill);
	$fill = !$fill;
	}
	
$pdf->Ln();


$productos1[] = array(iconv('UTF-8', 'windows-1252', $_REQUEST['observations']));



$pdf->SetFont('Arial','',14);
$header1=array('Observaciones');
$pdf->SetFont('Arial','',12);

$pdf->SetWidths(array(180));
$pdf->FancyTable($header1);

	$fill = false;
for($j=0;$j<count($productos1);$j++){   
    $pdf->Row($productos1[$j], $fill);
	$fill = !$fill;
	}

	
$pdf->Ln();

$html0='<u><b><i>FORMA DE PAGO:</i></u></b>';
$pdf->SetFont('Arial','B',14);
//$pdf->WriteHTML($html0);


 //$pdf->SetFont('Arial','B',14);
//$pdf->Cell(150,10,'FORMA DE PAGO: ',0,0,'C');
$pdf->SetFont('Arial','',10);

$pdf->Ln();
$pdf->Ln();

$html='
<b>*</b>  Las clases se abonan mensualmente, en efectivo y tras recibir la nota correspondiente. Usted recibirá, la nota del mes a lo largo de la primera quincena del mismo.
<br><br>

<b>*</b>  Rogamos rellene la hoja adjunta, que lleva escrito <b>"DEVOLVER ESTE  IMPRESO"</b>, con la cantidad que aparece en esta nota y, una vez firmada, introdúzcala, junto con el pago, en el sobre que incluimos aquí mismo. Entréguelo todo, <b>cerrado</b>, al profesor/a. Rogamos <b>no escriba</b> el importe fuera del sobre, sólo en la copia dentro del mismo.

<br><br>
<b><u>Primer pago de un nuevo cliente:</u></b> el primer pago de las clases de un cliente que acaba de empezar, se efectuará al finalizar la primera o segunda clase impartida.
<br><br>
<u><b>Siguientes pagos:</u></b> Los demás pagos se abonarán en la siguiente clase tras recibir la nota del importe del mes (dentro de la 1ª quincena del mes).';

//$pdf->WriteHTML(utf8_decode($html));

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$html1='<u><b><i>COMENTARIOS</i></u></b>';
$pdf->SetFont('Arial','B',14);
//$pdf->WriteHTML($html1);
//$pdf->Cell(150,10,'COMENTARIOS',0,0,'C');
$pdf->Ln();

/*$pdf->MultiCell(175,5,'_________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________',0,'L');*/
	
	

$pdf->Output();
//$pdf->Output("../attachment_tmp/LessonPlan.pdf");
 ///////////////////////////////////////////////////////////// correo 1
							
	
        }
		
 
	
	
			   




?>