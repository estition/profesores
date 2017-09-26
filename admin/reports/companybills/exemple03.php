<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
    $pepe = '<page backtop="75mm" backcolor="#FEFEFE" backimg="./images/bas_page.png" backimgx="center" backimgy="bottom" backimgw="100%"  backtop="0"  footer="date;heure;page" style="font-size: 10pt" backbottom="75mm">
		
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td>
            </td>
            <td style="color: #444444;">
                <img style="width: 100%;" src="./images/imageCE.png" alt="Logo"><br>
                domingo 21 de abril de 2013            </td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
          
            <td>CLIENTE &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;ASISA</td>
            
        </tr>
        <tr>
            <td>DOMICILIO :  C/Juan Ignacio Luca de Tena, 10 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                               28027 Madrid            </td>
        </tr>
        <tr>
            <td colspan="3" style="width:50%;">CIF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;A 08169294 </td>
        </tr>
       
    </table>
    <br>
    <br>

    <i>
        <b>CODIGO <u>: -2013 </u></b><br>
                       Canterbury English S.L.<br>
        CIF : B81523292<br>
    </i>
    <br>
    <br>
    Desgloce de clases:<br>
    <br>
    <br>
  
        <br>
        
        <style type="text/css">
		.gt-table {
	font-family: arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #000000;
	border-collapse: collapse;
			
			width: 10.5%;
		}
		.gt-hd-row {
			border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #000000;
	background-color: #dedede;
		}
		
		.table-sumary{
			font-weight:bold;
			background-color:#000;
			color:#FFF;}
						
		
		.gt-table td {
			border-right:1px; border-bottom:1px;
		}

		.gt-inner {
			width: 18%;
		}
		
		

		


		</style>
        

		<style type="text/css">

</style>
<table id="myGrid1" class="gt-table" cellspacing="0"  cellpadding="0" border="0" ><!-- gt : head start  --><tr class="gt-hd-row">
   
  <td rowspan="0" columnid="name" resizable="false" class="gt-col-mygrid1-name"><div class="gt-inner" unselectable="on"><span>Cliente</span><div class="gt-hd-tool"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
 
   <td rowspan="0" columnid="hide" resizable="false" class="gt-col-mygrid1-hide"><div class="gt-inner" unselectable="on"><span>Teacher</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
   
     <td rowspan="0" columnid="daysclass" resizable="false" class="gt-col-mygrid1-daysclass"><div class="gt-inner" unselectable="on"><span>Dias</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
      <td rowspan="0" columnid="taught" resizable="true" class="gt-col-mygrid1-taught"><div class="gt-inner" unselectable="on"><span>Fechas</span><div class="gt-hd-tool"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="cursor: col-resize;"></span></div></div></td>
     
       
        <td rowspan="0" columnid="student_c" resizable="false" class="gt-col-mygrid1-student_c"><div class="gt-inner" unselectable="on"><span>Student cancelation</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
        
         <td rowspan="0" columnid="late_student" resizable="false" class="gt-col-mygrid1-late_student"><div class="gt-inner" unselectable="on"><span>Late student cancelation</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
        
       
            <td rowspan="0" columnid="hxc" resizable="false" class="gt-col-mygrid1-hxc"><div class="gt-inner" unselectable="on"><span>Total Horas</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
          <td rowspan="0" columnid="size" resizable="false" class="gt-col-mygrid1-size"><div class="gt-inner" unselectable="on"><span>Total clases</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
         
          <td rowspan="0" columnid="price" resizable="false" class="gt-col-mygrid1-price"><div class="gt-inner" unselectable="on"><span>Precio clase/hora</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
           <td rowspan="0" columnid="total" resizable="false" class="gt-col-mygrid1-total"><div class="gt-inner" unselectable="on"><span>Total</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
           
           
         
          <td rowspan="0" columnid="cp" resizable="false" class="gt-col-mygrid1-cp"><div class="gt-inner" unselectable="on"><span>CP</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
           <td rowspan="0" columnid="direccion" resizable="false" class="gt-col-mygrid1-direccion"><div class="gt-inner" unselectable="on"><span>Domicilio</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
            <td rowspan="0" columnid="cif" resizable="false" class="gt-col-mygrid1-cif"><div class="gt-inner" unselectable="on"><span>CIF</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
            <td rowspan="0" columnid="nombre" resizable="false" class="gt-col-mygrid1-nombre"><div class="gt-inner" unselectable="on"><span>Empresa</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>
            <td rowspan="0" columnid="codigo" resizable="false" class="gt-col-mygrid1-codigo"><div class="gt-inner" unselectable="on"><span>Codigo</span><div class="gt-hd-tool" style="display: none;"><span class="gt-hd-icon"></span><span class="gt-hd-button"></span><span class="gt-hd-split" style="display: none;"></span></div></div></td>


           
     
	</tr><!-- gt : head end  --><tbody><tr class="gt-row table-sumary" __gt_ds_index__="0"  id="" ><td  class="gt-col-mygrid1-name" ><div  " >TOTAL==></div></td><td  class="gt-col-mygrid1-hide" ><div  " ></div></td><td  class="gt-col-mygrid1-daysclass" ><div  " ></div></td><td  class="gt-col-mygrid1-taught" ><div  " >9</div></td><td  class="gt-col-mygrid1-student_c" ><div  " >0</div></td><td  class="gt-col-mygrid1-late_student" ><div  " >1</div></td><td  class="gt-col-mygrid1-hxc" ><div  " >14</div></td><td  class="gt-col-mygrid1-size" ><div  " >10</div></td><td  class="gt-col-mygrid1-price" ><div  " ></div></td><td  class="gt-col-mygrid1-total" ><div  " >346</div></td><td  class="gt-col-mygrid1-cp" ><div  " ></div></td><td  class="gt-col-mygrid1-direccion" ><div  " ></div></td><td  class="gt-col-mygrid1-cif" ><div  " ></div></td><td  class="gt-col-mygrid1-nombre" ><div  " ></div></td><td  class="gt-col-mygrid1-codigo" ><div  " ></div></td></tr>
<tr class="gt-row" __gt_ds_index__="1"  id="" ><td  class="gt-col-mygrid1-name" ><div  " >ASISA II Jose Vileya</div></td><td  class="gt-col-mygrid1-hide" ><div  " >Liliana Torres</div></td><td  class="gt-col-mygrid1-daysclass" ><div  " >V</div></td><td  class="gt-col-mygrid1-taught" ><div  " > 19 26</div></td><td  class="gt-col-mygrid1-student_c" ><div  " ></div></td><td  class="gt-col-mygrid1-late_student" ><div  " > 12</div></td><td  class="gt-col-mygrid1-hxc" ><div  " >3</div></td><td  class="gt-col-mygrid1-size" ><div  " >3</div></td><td  class="gt-col-mygrid1-price" ><div  " >25</div></td><td  class="gt-col-mygrid1-total" ><div  " >75</div></td><td  class="gt-col-mygrid1-cp" ><div  " >28027</div></td><td  class="gt-col-mygrid1-direccion" ><div  " >C/Juan Ignacio Luca de Tena, 10</div></td><td  class="gt-col-mygrid1-cif" ><div  " >A 08169294</div></td><td  class="gt-col-mygrid1-nombre" ><div  " >ASISA</div></td><td  class="gt-col-mygrid1-codigo" ><div  " ></div></td></tr>
<tr class="gt-row gt-row-even" __gt_ds_index__="2"  id="" ><td  class="gt-col-mygrid1-name" ><div  " >ASISA II Jose Vileya</div></td><td  class="gt-col-mygrid1-hide" ><div  " >Liliana Torres</div></td><td  class="gt-col-mygrid1-daysclass" ><div  " >V</div></td><td  class="gt-col-mygrid1-taught" ><div  " > 25</div></td><td  class="gt-col-mygrid1-student_c" ><div  " ></div></td><td  class="gt-col-mygrid1-late_student" ><div  " ></div></td><td  class="gt-col-mygrid1-hxc" ><div  " >2</div></td><td  class="gt-col-mygrid1-size" ><div  " >1</div></td><td  class="gt-col-mygrid1-price" ><div  " >25</div></td><td  class="gt-col-mygrid1-total" ><div  " >25</div></td><td  class="gt-col-mygrid1-cp" ><div  " >28027</div></td><td  class="gt-col-mygrid1-direccion" ><div  " >C/Juan Ignacio Luca de Tena, 10</div></td><td  class="gt-col-mygrid1-cif" ><div  " >A 08169294</div></td><td  class="gt-col-mygrid1-nombre" ><div  " >ASISA</div></td><td  class="gt-col-mygrid1-codigo" ><div  " ></div></td></tr>
<tr class="gt-row" __gt_ds_index__="3"  id="" ><td  class="gt-col-mygrid1-name" ><div  " >ASISA I  Jaime Ortiz</div></td><td  class="gt-col-mygrid1-hide" ><div  " >Alfred Aguilar</div></td><td  class="gt-col-mygrid1-daysclass" ><div  " >L,X</div></td><td  class="gt-col-mygrid1-taught" ><div  " > 02 04 09 11 16 18</div></td><td  class="gt-col-mygrid1-student_c" ><div  " ></div></td><td  class="gt-col-mygrid1-late_student" ><div  " ></div></td><td  class="gt-col-mygrid1-hxc" ><div  " >9</div></td><td  class="gt-col-mygrid1-size" ><div  " >6</div></td><td  class="gt-col-mygrid1-price" ><div  " >41</div></td><td  class="gt-col-mygrid1-total" ><div  " >246</div></td><td  class="gt-col-mygrid1-cp" ><div  " >28027</div></td><td  class="gt-col-mygrid1-direccion" ><div  " >C/Juan Ignacio Luca de Tena, 10</div></td><td  class="gt-col-mygrid1-cif" ><div  " >A 08169294</div></td><td  class="gt-col-mygrid1-nombre" ><div  " >ASISA</div></td><td  class="gt-col-mygrid1-codigo" ><div  " ></div></td></tr>
</tbody></table><br> <strong>Forma de Pago: </strong><font COLOR=BLUE>Transferencia Bancaria al BBVA Nº de Cta. Cte. 0182-0947-26-0201556780.</font> </page>
';
    $content = ob_get_clean();

    // convert to PDF
   require_once('export_php/html2pdf_v4.03/html2pdf.class.php');	
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($pepe, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple03.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
