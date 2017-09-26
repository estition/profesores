<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php if($is_admin_a){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Recepción de Recibos" >
<meta name="description" content="Recepción de recibos que han sido emitidos " >
<title>Facturas</title>

<link rel="stylesheet" type="text/css" media="all" href="css/buttom2.css"  />
<script src="highlight/jssc3.js" type="text/javascript"></script>
<link href="highlight/style.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="grid/gt_grid.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/vista/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/mac/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/pink/skinstyle.css" />

<script type="text/javascript" src="grid/gt_msg_en.js"></script>
<script type="text/javascript" src="grid/gt_const.js"></script>
<script type="text/javascript" src="grid/gt_grid_all.js"></script>
<script type="text/javascript" src="grid/flashchart/fusioncharts/FusionCharts.js"></script>


<script type="text/javascript" >     
<!-- All the scripts will go here  -->

	Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) ++size;
    }
    return size/3;
	
} 

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function doFilter() {
	var filterInfo1=[
	{
	
	
	    columnId :  "day",
		fieldName : "day",
		logic : "like",
		value : Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month")
		
		
	},
		{
	
	
	    columnId :  "b.old_id",
		fieldName : "b.old_id",
		logic : "equal",
		value : Sigma.Util.getValue("teacher_id")
		
		
	},
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo1); 
}


function doFilter1() {
	
	var filterInfo=[
	
	{
	
	
	    columnId :  "day",
		fieldName : "day",
		logic : "like",
		value : Sigma.Util.getValue("year1")+"-"+Sigma.Util.getValue("month1")
		
		
	},
	{
	
	    columnId :  "b.name",
		fieldName : "b.name",
		logic : "startWith",
		value : Sigma.Util.getValue("f_value1")
	}
	
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo); 
}

function doUnfilter(){
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter([]);

}

function doUnfilter1(){
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter([]);

}


function newAjax(){
    var xmlhttp=false;
    try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
    xmlhttp = false;
    }
    }
 
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
    } 

var grid_demo_id = "myGrid1" ;
var grid_details_id = "myGrid2";

var dsOption= {

	fields :[
		{name : 'company_id'  },
	
		
		{name : 'group_id'     },
		

		{name : 'hide'},

		{name : 'name' },
		{name : 'daysclass'     },
		
		{name : 'ciudad'     },
	    
		{name : 'months'     },
		{name : 'codigo'},
			{name : 'dia_factura1' ,
			initValue : function(record){
			
			 var v3 = Sigma.Util.getValue("dia_factura");
			 if(v3 != "")
				record = v3;
   			else record = "31";
				  
 				return record;}
			
		},

		
		
		{name : 'hours'     },
		
	    {name : 'taught_class'     },
		{name : 'taught' },
  

 
		{name : 'student_c'},
		{name : 'late_student'},
		{name : 'teacher_c'},
 
 {name : 'class_type'     },
	
		
		{name : 'user_id'     },
		{name : 'hxc'},
		{name : 'size'},
	
  		{name : 'price',
			initValue : function(record){
		
		
			 var v1 =  parseFloat(record['price']);
		     if (!isNaN(v1)){
					
				return v1+' €';}
		}
		
	},
		{name : 'total',
			initValue : function(record){
		
		
			 var v1 =  parseFloat(record['total']);
		    		     if (!isNaN(v1)){

					
				return v1+' €';}
		}
		
	}
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
       // {id: 'chk' ,isCheckColumn : true, filterable: false, exportable:false},
	   
	   {id: 'name' 			,header: "Cliente"	,width :200},
	    {id: 'hide' 			,header: "hide", 		sortable:false,width :125},
	   
	
		
	  
		{id: 'daysclass'   ,header: "Dias clases"    ,sortable:false, width :50, editor: { type :"text"}},
  
	   
{id: 'taught' ,header: "clase enseñada" 	,sortable:false,width :150,  toolTip : true ,toolTipWidth : 150, editor: { type :"text"}},
	   
	  
	   {id: 'student_c' 			,header: "Est. Cancel" 			,sortable:false,width :100, editor: { type :"text"}},
	  
	   {id: 'late_student' 			,header: "late stedent" 			,sortable:false,width :100, editor: { type :"text"}},
	   {id: 'teacher_c' 			,header: "teacher cancelation" 			,sortable:false,width :50, editor: { type :"text"}},
	  // {id: 'hours'   ,header: "Horas"       ,sortable:false, width :80},
	   	{id: 'hxc' 			,header: "hr.C" 	,sortable:false		,width :50, editor: { type :"text"}},
	    {id: 'size' 			,header: "T.C." 			,sortable:false,width :50, editor: { type :"text"}},
		
		{id: 'price' 			,header: "Rate" 			,sortable:false,width :50, editor: { type :"text"}},
		{id: 'total' 			,header: "Total" 		,sortable:false	,width :50, editor: { type :"text" }},
		
		{id: 'ciudad'   ,header: "Ciudad", hidden: "true"     ,sortable:false, width :0},
		
		 {id: 'months'   ,header: "Mes", hidden: "true"     ,sortable:false, width :0},
		{id: 'codigo', header: "Codigo"	,width :50, sortable:false, editor: { type :"text"}},
		 {id: 'dia_factura1'   ,header: "DF", hidden: "true"     ,sortable:false, width :0}
];


 
 


var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
	exportURL : './billsgen.php?export=true',
	exportFileName : 'test_export_doc',
    width: "1049",
	height: "400", 	
    container : 'gridbox', 
	replaceContainer : true, 
	editable : false,
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSizeList : [20,40,60],
	/*onCellDblClick  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	 var id = record.group_id;
	 var user_id = record.user_id;
	 var entry_id = record.id;
	  var grid=Sigma.$grid(grid_details_id);
     //grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "&entry_id = " + entry_id + "&user_id = " + user_id + " ";
	  grid.parameters.id = id;
	   grid.parameters.user_id = user_id;
	    grid.parameters.entry_id = entry_id;
	 
      grid.reload();
	},*/
	
	
	
	parameters:{'id':""},
	SigmaGridPath : 'grid/',
	lightOverRow : false,
	
			/*onComplete:function( grid )
            {
			
	 // var grid=Sigma.$grid(grid_details_id);
      //grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "";
	  grid.parameters.id = "";
      //grid.reload();
        },*/
		remoteFilter: true,
		//selectRowByCheck : true,
	    pageSize : 20 ,
       
        remotePaging : true,
        autoLoad : true,
        showIndexColumn : true,
		remoteSort : true,
	
	
	defaultRecord : ["","","","",0,0,0,0,"2008-01-01"],

		onMouseOver : function(value,  record,  cell,  row,  colNo, rowNo,  columnObj,  grid){
		
		
		if (columnObj && columnObj.toolTip) {
			grid.showCellToolTip(cell,columnObj.toolTipWidth);
		}else{
			grid.hideCellToolTip();
		}
	},
	onMouseOut : function(value,  record,  cell,  row,  colNo, rowNo,  columnObj,  grid){
		grid.hideCellToolTip();
	},
	
	
	beforeEdit : function(value,record,col,grid){
    if(!this.activeValue)
     {
         this.activeValue = "";  
      }
         return true;
 },
 
 customRowAttribute : function(record,rn,grid){
		if (record.name == "TOTAL===>"){
			return 'style="height:25px; background-color:#ffddcc"';
		}
	},
	
	
    	toolbarContent : 'nav goto | pagesize | reload  | pdf | state '
};
/*
var gridOptionDetails={
	id : grid_details_id,
	loadURL : "export_php/testMasterListD1.php",
	saveURL : "export_php/testMasterListD1.php",
	width: "1000",
	height: "310", 	
	container : 'gridboxDetails', 
	replaceContainer : true, 
	editable : true,
    groupable : true,
        remoteFilter: true,
	    pageSize : 20 ,
        pageSizeList : [20, 40, 60],
        remotePaging : true,
        autoLoad : true,
        showIndexColumn : true,
		remoteSort : true,
	dataset : dsgrouOption ,
	columns : colsGroupsOption ,
	clickStartEdit : true ,
	toolbarContent : 'reload | save del | print | state',
	showGridMenu : false,
	allowCustomSkin	: true ,
	allowFreeze	: true ,
	allowHide	: true ,
	allowGroup	: true,
	lightOverRow : false,

		onMouseOver : function(value,  record,  cell,  row,  colNo, rowNo,  columnObj,  grid){
		
		
		if (columnObj && columnObj.toolTip) {
			grid.showCellToolTip(cell,columnObj.toolTipWidth);
		}else{
			grid.hideCellToolTip();
		}
	},
	onMouseOut : function(value,  record,  cell,  row,  colNo, rowNo,  columnObj,  grid){
		grid.hideCellToolTip();
	}
	
};*/
 
var mygrid=new Sigma.Grid( gridOption );
//var mygridDetails = new Sigma.Grid(gridOptionDetails);
		

Sigma.Util.onLoad( Sigma.Grid.render(mygrid) );


//Sigma.Util.onLoad( Sigma.Grid.render(mygridDetails) );

//////////////////////////////////////////////////////////


function unlockAllColumn(){
	Sigma.Column.unlockAllColumn(grid_demo_id);
}

function lockColumnNAllBefore(){
	Sigma.Column.lockColumnNAllBefore(grid_demo_id,Sigma.$("idx2").value);
}

  
</script>
</head>  
  
<body>  
<!-- grid container. -->
<?php include '../../../includes/top.php'?>

  
  
  <h1 align="center">
     Generacion de Facturas</h1>

  
<body>  
<!-- grid container. -->


  <div id="header">
  </div>
 <div style="position: relative;" align="center">  
  <div id="content">

<table>
<tr><td>
   
</td>
<td valign ="top">
<br />




 <table>
  <tr>
    <td colspan="2"><div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div></td>
    </tr></table>
  
    <!--<td><div id="bigboxDetails" style="margin:15px;display:!none;">  
      <div id="gridboxDetails" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:250px;width:700px;" ></div>
    </div
    ><br /></td>-->
    <table>

      <tr>
      
        <td>
          <?php 
 
 $sqlClients = "select c.nombre, c.id as ident from groups b, companies c where b.old_id = c.id and c.baja = '0' and c.historical = '0' and c.active = '1' group by ident order by nombre  ";
$resultClients = mysqli_query($link, $sqlClients) or die("Invalid query: " . mysqli_error($link));
$clientsOptions="";
$clientsOptions .= "<option selected value= ''>COMPANY GROUPS</option>";

while ($rowClients = mysqli_fetch_array($resultClients, MYSQLI_ASSOC)) {
	//echo $id."PEPEPE"; echo $rowClients['ident']."RRRRRRRRRR"; 
	if ($company == $rowClients['nombre']) {
		//echo $id."PEPEPE"; echo $rowClients['ident']."RRRRRRRRRR"; 
		$selected = "selected=\"selected\"";
		
	} else {
		//echo "FFFFFFFFFF"; 
		$selected = "";
	}
	$clientsOptions .= "\n<option " . $selected . " value=\"" . $rowClients['ident'] . "\">" . $rowClients['nombre']."</option>";
}
	    $year1 = date("Y")+2;
		$year2 = date("Y")-1;
		for ($year2; $year2 < $year1; $year2++) {
			
			
			 $selected = (date("Y") == $year2) ? 'selected="selected"' : '--';

     $years .= "<option value=\"{$year2}\" {$selected}>{$year2}</option>\n";

	
}

    ?>
    
   
   <form name="data_entry" action="#">
 <fieldset>
<legend><b><font size="2"><font color="#3333CC" >Buscar por Empresa:</font></font></b></legend>

 <select id="teacher_id" name="teacher_id" ><?php echo  $clientsOptions; ?></select>
<br><br>
<select name="year" id="year"><?php echo  $years; ?></select>
<br><br>
<select name="month" id="month" style="width:238px;">
<option value="01"<?=date('m') == 01 ? ' selected="selected"' : '------';?>>Enero</option>
<option value="02"<?=date('m') == 02 ? ' selected="selected"' : '------';?>>Febrero</option>
<option value="03"<?=date('m') == 03 ? ' selected="selected"' : '------';?>>Marzo</option>
<option value="04"<?=date('m') == 04 ? ' selected="selected"' : '------';?>>Abril</option>
<option value="05"<?=date('m') == 05 ? ' selected="selected"' : '------';?>>Mayo</option>
<option value="06"<?=date('m') == 06 ? ' selected="selected"' : '------';?>>Junio</option>
<option value="07"<?=date('m') == 07 ? ' selected="selected"' : '------';?>>Julio</option>
<option value="08"<?=date('m') == 08 ? ' selected="selected"' : '------';?>>Agosto</option>
<option value="09"<?=date('m') == 09 ? ' selected="selected"' : '------';?>>Septiembre</option>
<option value="10"<?=date('m') == 10 ? ' selected="selected"' : '------';?>>Octubre</option>
<option value="11"<?=date('m') == 11 ? ' selected="selected"' : '------';?>>Noviembre</option>
<option value="12"<?=date('m') == 12 ? ' selected="selected"' : '------';?>>Diciembre</option>
     </select>
        <br />
        
         Dia de facturacion:
        
        <select name="dia_factura" id="dia_factura" style="width:80px;">

<option value="01"<?=date('d') == 01 ? ' selected="selected"' : '------';?>>1</option>
<option value="02"<?=date('d') == 02 ? ' selected="selected"' : '------';?>>2</option>
<option value="03"<?=date('d') == 03 ? ' selected="selected"' : '------';?>>3</option>
<option value="04"<?=date('d') == 04 ? ' selected="selected"' : '------';?>>4</option>
<option value="05"<?=date('d') == 05 ? ' selected="selected"' : '------';?>>5</option>
<option value="06"<?=date('d') == 06 ? ' selected="selected"' : '------';?>>6</option>
<option value="07"<?=date('d') == 07 ? ' selected="selected"' : '------';?>>7</option>
<option value="08"<?=date('d') == 08 ? ' selected="selected"' : '------';?>>8</option>
<option value="09"<?=date('d') == 09 ? ' selected="selected"' : '------';?>>9</option>
<option value="10"<?=date('d') == 10 ? ' selected="selected"' : '------';?>>10</option>
<option value="11"<?=date('d') == 11 ? ' selected="selected"' : '------';?>>11</option>
<option value="12"<?=date('d') == 12 ? ' selected="selected"' : '------';?>>12</option>
<option value="13"<?=date('d') == 13 ? ' selected="selected"' : '------';?>>13</option>
<option value="14"<?=date('d') == 14 ? ' selected="selected"' : '------';?>>14</option>
<option value="15"<?=date('d') == 15 ? ' selected="selected"' : '------';?>>15</option>
<option value="16"<?=date('d') == 16 ? ' selected="selected"' : '------';?>>16</option>
<option value="17"<?=date('d') == 17 ? ' selected="selected"' : '------';?>>17</option>
<option value="18"<?=date('d') == 18 ? ' selected="selected"' : '------';?>>18</option>
<option value="19"<?=date('d') == 19 ? ' selected="selected"' : '------';?>>19</option>
<option value="20"<?=date('d') == 20 ? ' selected="selected"' : '------';?>>20</option>
<option value="21"<?=date('d') == 21 ? ' selected="selected"' : '------';?>>21</option>
<option value="22"<?=date('d') == 22 ? ' selected="selected"' : '------';?>>22</option>
<option value="23"<?=date('d') == 23 ? ' selected="selected"' : '------';?>>23</option>
<option value="24"<?=date('d') == 24 ? ' selected="selected"' : '------';?>>24</option>
<option value="25"<?=date('d') == 25 ? ' selected="selected"' : '------';?>>25</option>
<option value="26"<?=date('d') == 26 ? ' selected="selected"' : '------';?>>26</option>
<option value="27"<?=date('d') == 27 ? ' selected="selected"' : '------';?>>27</option>
<option value="28"<?=date('d') == 28 ? ' selected="selected"' : '------';?>>28</option>
<option value="29"<?=date('d') == 29 ? ' selected="selected"' : '------';?>>29</option>
<option value="30"<?=date('d') == 30 ? ' selected="selected"' : '------';?>>30</option>
<option value="31"<?=date('d') == 31 ? ' selected="selected"' : '------';?>>31</option>

     </select>
        <br />

<div class="buttons"> 
    <button type="button" onclick="doFilter()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Search
    </button> 
     <button  class="negative" value="Reset" type="reset" onclick="doUnfilter1()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
        
</div>



 </fieldset>
 </form>

</div>
        </td>
      
      <td><form name="data_entry1" action="#">
 <fieldset>
<legend><b><font size="2"><font color="#3333CC" >Buscar por Grupo:</font></font></b></legend>
<input type="text" name="f_value1" id="f_value1" size="40" value="">


<br><br>
<select name="year1" id="year1"><?php echo  $years; ?></select>
<br><br>
<select name="month1" id="month1" style="width:238px;">

<option value="01"<?=date('m') == 01 ? ' selected="selected"' : '------';?>>Enero</option>
<option value="02"<?=date('m') == 02 ? ' selected="selected"' : '------';?>>Febrero</option>
<option value="03"<?=date('m') == 03 ? ' selected="selected"' : '------';?>>Marzo</option>
<option value="04"<?=date('m') == 04 ? ' selected="selected"' : '------';?>>Abril</option>
<option value="05"<?=date('m') == 05 ? ' selected="selected"' : '------';?>>Mayo</option>
<option value="06"<?=date('m') == 06 ? ' selected="selected"' : '------';?>>Junio</option>
<option value="07"<?=date('m') == 07 ? ' selected="selected"' : '------';?>>Julio</option>
<option value="08"<?=date('m') == 08 ? ' selected="selected"' : '------';?>>Agosto</option>
<option value="09"<?=date('m') == 09 ? ' selected="selected"' : '------';?>>Septiembre</option>
<option value="10"<?=date('m') == 10 ? ' selected="selected"' : '------';?>>Octubre</option>
<option value="11"<?=date('m') == 11 ? ' selected="selected"' : '------';?>>Noviembre</option>
<option value="12"<?=date('m') == 12 ? ' selected="selected"' : '------';?>>Diciembre</option>
     </select>
        <br />
        
        Dia de facturacion:
        
        <select name="dia_factura" id="dia_factura" style="width:80px;">

<option value="01"<?=date('d') == 01 ? ' selected="selected"' : '------';?>>1</option>
<option value="02"<?=date('d') == 02 ? ' selected="selected"' : '------';?>>2</option>
<option value="03"<?=date('d') == 03 ? ' selected="selected"' : '------';?>>3</option>
<option value="04"<?=date('d') == 04 ? ' selected="selected"' : '------';?>>4</option>
<option value="05"<?=date('d') == 05 ? ' selected="selected"' : '------';?>>5</option>
<option value="06"<?=date('d') == 06 ? ' selected="selected"' : '------';?>>6</option>
<option value="07"<?=date('d') == 07 ? ' selected="selected"' : '------';?>>7</option>
<option value="08"<?=date('d') == 08 ? ' selected="selected"' : '------';?>>8</option>
<option value="09"<?=date('d') == 09 ? ' selected="selected"' : '------';?>>9</option>
<option value="10"<?=date('d') == 10 ? ' selected="selected"' : '------';?>>10</option>
<option value="11"<?=date('d') == 11 ? ' selected="selected"' : '------';?>>11</option>
<option value="12"<?=date('d') == 12 ? ' selected="selected"' : '------';?>>12</option>
<option value="13"<?=date('d') == 13 ? ' selected="selected"' : '------';?>>13</option>
<option value="14"<?=date('d') == 14 ? ' selected="selected"' : '------';?>>14</option>
<option value="15"<?=date('d') == 15 ? ' selected="selected"' : '------';?>>15</option>
<option value="16"<?=date('d') == 16 ? ' selected="selected"' : '------';?>>16</option>
<option value="17"<?=date('d') == 17 ? ' selected="selected"' : '------';?>>17</option>
<option value="18"<?=date('d') == 18 ? ' selected="selected"' : '------';?>>18</option>
<option value="19"<?=date('d') == 19 ? ' selected="selected"' : '------';?>>19</option>
<option value="20"<?=date('d') == 20 ? ' selected="selected"' : '------';?>>20</option>
<option value="21"<?=date('d') == 21 ? ' selected="selected"' : '------';?>>21</option>
<option value="22"<?=date('d') == 22 ? ' selected="selected"' : '------';?>>22</option>
<option value="23"<?=date('d') == 23 ? ' selected="selected"' : '------';?>>23</option>
<option value="24"<?=date('d') == 24 ? ' selected="selected"' : '------';?>>24</option>
<option value="25"<?=date('d') == 25 ? ' selected="selected"' : '------';?>>25</option>
<option value="26"<?=date('d') == 26 ? ' selected="selected"' : '------';?>>26</option>
<option value="27"<?=date('d') == 27 ? ' selected="selected"' : '------';?>>27</option>
<option value="28"<?=date('d') == 28 ? ' selected="selected"' : '------';?>>28</option>
<option value="29"<?=date('d') == 29 ? ' selected="selected"' : '------';?>>29</option>
<option value="30"<?=date('d') == 30 ? ' selected="selected"' : '------';?>>30</option>
<option value="31"<?=date('d') == 31 ? ' selected="selected"' : '------';?>>31</option>

     </select>
        <br />
 

<div class="buttons"> 
    <button type="button" onclick="doFilter1()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Buscar
    </button> 
    <button  class="negative" value="Reset" type="reset" onclick="doUnfilter1()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
</div>



 </fieldset>
 </form></td></tr>
    </table>


 <!-- <input type="button" value="hide/show grid" onclick="showGrid()" />&nbsp;</p>
 -->
</td>
  </tr>
</table>

    

</table>



    <table id="myHead" style="display:none">
<tr>
   
  <td rowspan="0" columnId='name' resizable='false'>Cliente</td>
 
   <td rowspan="0" columnId='hide' resizable='false'>Teacher</td>
   
     <td rowspan="0" columnId='daysclass' resizable='false'>Dias</td>
      <td rowspan="0" columnId='taught' resizable='true'>Fechas</td>
     
       
        <td rowspan="0" columnId='student_c' resizable='false'>SC*</td>
        
         <td rowspan="0" columnId='late_student' resizable='false'>LSC*</td>
        <td rowspan="0" columnId='teacher_c' resizable='false'>TC*</td>
       
            <td rowspan="0" columnId='hxc' resizable='false'>T.Horas</td>
          <td rowspan="0" columnId='size' resizable='false'>T.Clases</td>
         
          <td rowspan="0" columnId='price' resizable='false'>Precio</td>
           <td rowspan="0" columnId='total' resizable='false'>Total</td>
           
           
         <td rowspan="0" columnId='ciudad' resizable='false'  >Ciudad</td>
         
             <td rowspan="0" columnId='months'>Mes</td> 
            <td rowspan="0" columnId='codigo' resizable='false'>Codigo</td>
			<td rowspan="0" columnId='dia_factura1' resizable='false'>DF</td>

           
     
	</tr>
 
</table>
</div>  

 </body>  
</html>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>