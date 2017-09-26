<?php
header('Content-type: application/pdf; charset="utf-8"',true);
include '../includes/constants.php';
include '../includes/database.php';
define('FPDF_FONTPATH','../pdf_lib/font/');
require('../pdf_lib/fpdf.php');
class PDF extends FPDF
{

var $B;
var $I;
var $U;
var $HREF;
var $ALIGN='';
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
	$this->ALIGN='';
}

 function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n", ' ', $html);
        $a=preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF, $e);
                elseif($this->ALIGN == 'center')
                    $this->Cell(0, 5, $e, 0, 1, 'C');
                else
                    $this->Write(5, $e);
            }
            else
            {
                //Tag
                if($e{0}=='/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else
                {
                    //Extract properties
                    $a2=split(' ', $e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                        if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$', $v, $a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    $this->OpenTag($tag, $prop);
                }
            }
        }
    }

    function OpenTag($tag, $prop)
    {
        //Opening tag
        if($tag=='B' or $tag=='I' or $tag=='U')
            $this->SetStyle($tag, true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( $prop['WIDTH'] != '' )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x, $y, $x+$Width, $y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' or $tag=='I' or $tag=='U')
            $this->SetStyle($tag, false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag, $enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B', 'I', 'U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
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

    if(utf8_decode($_REQUEST['start']) == ""){
	$start = "________";}else{
	$start = utf8_decode($_REQUEST['start']);}
	
	if(utf8_decode($_REQUEST['end']) == ""){
	$end = "________";}else{
	$end = utf8_decode($_REQUEST['end']);}
	
	if($_REQUEST['dias'] == "Array"){
	$dias = "______________";}else{
	$dias = $_REQUEST['dias'];}
	
	if(utf8_decode($_REQUEST['starttime']) == ""){
	$starttime = "_______";}else{
	$starttime = utf8_decode($_REQUEST['starttime']);}
	
	if(utf8_decode($_REQUEST['endtime']) == ""){
	$endtime = "_______";}else{
	$endtime = utf8_decode($_REQUEST['endtime']);}
	
	if(utf8_decode($_REQUEST['length']) == ""){
	$length = "____";}else{
	$length = utf8_decode($_REQUEST['length']);}
	
	if(utf8_decode($_REQUEST['teacher']) == ""){
	$teacher = "______________________________________________";}else{
	$teacher = utf8_decode($_REQUEST['teacher']);}
	
	if(utf8_decode($_REQUEST['nivel']) == ""){
	$nivel = "__________";}else{
	$nivel = utf8_decode($_REQUEST['nivel']);}
	
	
	if(utf8_decode($_REQUEST['class_type']) == ""){
	$class_type = "__________";}else{
	$class_type = utf8_decode($_REQUEST['class_type']);}
	
  switch ($class_type) {
    case "1": 

	$tag1  = "Individual 13 € + Sup. ".$_REQUEST['supplement']." €";
	 break;
    case "2":
	$tag1  = "Grupo I 15 € + Sup. ".$_REQUEST['supplement']." €";
	 break;
	   case "3": 
	$tag1  = "Grupo II 18 € + Sup. ".$_REQUEST['supplement']." €";
	 break;
	
			}

           

            	
			/*	function fecha ()
			{
				$vect=getdate();
				$vect_dia=array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
				$vect_mes=array("empty","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",	"Octubre","Noviembre","Diciembre");
				return $vect_mes[$vect['mon']];
			}

 $monthd =  fecha(); */   
  

$pdf=new PDF();

$pdf->AddPage();

$pdf->Cell(7);

//$pdf->Image('../images/canterburyLogo1.jpg',160, 6, 20, 20, 'JPG');

$pdf->SetX(150); 

	$pdf->Ln();
	$html2='<b>DATOS DEL CLIENTE</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$pdf->SetFont('courier','',14);

//LOCALIDAD :<b>MADRID </b>    PROVINCIA: <b>MADRID</b>    C.P. :<b>'.utf8_decode($_REQUEST['zip']).'</b>
	
$html2='CODIGO    :<b>'.utf8_decode($_REQUEST['group_id']).'</b><br><br>CLIENTE   :<b>'. utf8_decode($_REQUEST['name']).'</b><br><br>METRO     :<b>'.utf8_decode($_REQUEST['Metro']).'</b><br><br>'.utf8_decode('DIRECCIÓN').' :<b>'. utf8_decode($_REQUEST['address1']).'</b><br><br>TELEFONO  :<b>'. utf8_decode($_REQUEST['telephone1']).'</b>        MOVIL :<b>'.utf8_decode($_REQUEST['mobile']).'</b><br><br>EMAIL     :<b>'. utf8_decode($_REQUEST['email']).'</b>';
$pdf->WriteHTML($html2);
$pdf->Ln();
$pdf->Ln();


$html2='<b>DATOS DE LA CLASE</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$pdf->SetFont('courier','',14);

$html2='F. INICIO:  <b>'.$start.'</b> F. FIN: <b>'.$end.'</b> DIAS: <b>'.$dias.'</b><br><br>H. INICIAL: <b>'.$starttime.'</b> H. FINAL: <b>'.$endtime.'</b>    '.utf8_decode('DURACIÓN').':<b>'.$length.'hr/s</b><br><br>PROFESOR:   <b>'
.$teacher.'</b><br><br>NIVEL:      <b>'.$nivel.'</b>    TYPE: <b>'. 	iconv('UTF-8', 'windows-1252',$tag1 ).'</b>';
$pdf->WriteHTML($html2);
$pdf->Ln();
$pdf->Ln();
$html2='<b>ALUMNOS</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$html2= utf8_decode($_REQUEST['alumnos']);

$pdf->SetFont('courier','',14);
$pdf->WriteHTML($html2);

$pdf->Ln();
$pdf->Ln();


$html2='<b>OBSERVACIONES</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$html2= utf8_decode($_REQUEST['Objetivos']);

$pdf->SetFont('courier','',14);
$pdf->WriteHTML($html2);

$pdf->Ln();
$pdf->Ln();
$html2='<b>PREFERENCIA</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$html2= utf8_decode($_REQUEST['Preferencia']);

$pdf->SetFont('courier','',14);
$pdf->WriteHTML($html2);

$pdf->Ln();
$pdf->Ln();
$html2='<b>SEGUIMIENTO</b>';
$pdf->SetFont('Arial','B',18);
$pdf->WriteHTML($html2);
$pdf->Ln();
$html2='<HR>';
$pdf->WriteHTML($html2);
$pdf->Ln();

$html2= utf8_decode($_REQUEST['Seguimiento']);

$pdf->SetFont('courier','',14);
$pdf->WriteHTML($html2);

$pdf->Ln();

$pdf->Output();
//$pdf->Output("../attachment_tmp/LessonPlan.pdf");
 ///////////////////////////////////////////////////////////// correo 1

?>