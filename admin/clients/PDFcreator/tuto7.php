<?php
define('FPDF_FONTPATH','../pdf_lib/font/');
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


			
            	
				function fecha ()
			{
				$vect=getdate();
				$vect_dia=array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
				$vect_mes=array("empty","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",	"Octubre","Noviembre","Diciembre");
				return $vect_mes[$vect['mon']];
			}

 $monthd =  fecha();    

$pdf=new PDF();

$pdf->AddPage();
$pdf->AddFont('Calligrapher','','calligra.php');
$pdf->SetFont('Calligrapher','',14);
$pdf->Cell(0,10,'Enjoy new fonts with FPDF!');

$pdf->Ln();
$pdf->Ln();

$pdf->SetX(60);
$html2='<u><b>COPIA PARA EL CLIENTE:</u></b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);


$pdf->Output();
?>
