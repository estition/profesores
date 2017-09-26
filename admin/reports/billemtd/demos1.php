<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php if($is_admin_a){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>Recepción de Recibos</title>
<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Recepción de Recibos" >
<meta name="description" content="Recepción de recibos que han sido emitidos " >


<link rel="stylesheet" type="text/css" media="all" href="css/buttom2.css"  />
<script src="highlight/jssc3.js" type="text/javascript"></script>
<link href="highlight/style.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" media="all" href="grid/calendar/calendar-green.css"  />
<script type="text/javascript" src="grid/calendar/calendar.js"></script>
<script type="text/javascript" src="grid/calendar/calendar-en.js"></script>
<script type="text/javascript" src="grid/calendar/calendar-setup.js"></script>
   

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

function doFilter() {

	var filterInfo=[
	{
	
	
	    columnId :  Sigma.Util.getValue("f_fieldName1"),
		fieldName : Sigma.Util.getValue("f_fieldName1"),
		logic : "startWith",
		value : Sigma.Util.getValue("f_value1")
		
	},
	{
	    columnId :  "startt",
		fieldName : "startt",
		logic : "greatEqual",
		value : Sigma.Util.getValue("f_date_c1")
	}
	]
	var grid=Sigma.$grid("myGrid2");
	var rowNOs=grid.applyFilter(filterInfo); 
}

function doFilter1() {

	var filterInfo1=[
	{
	
	
	    columnId :  Sigma.Util.getValue("f_fieldName2"),
		fieldName : Sigma.Util.getValue("f_fieldName2"),
		logic : "startWith",
		value : Sigma.Util.getValue("f_value2")
		
	},
	{
	    columnId :  "startt",
		fieldName : "startt",
		logic : "greatEqual",
		value : Sigma.Util.getValue("f_date_c")
	}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo1); 
}

function doUnfilter(){
	var grid=Sigma.$grid("myGrid2");
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
		{name : 'codigo'     },
		{name : 'userGroup_id'     },
		{name : 'user_id'     },
		{name : 'group_id'     },
		{name : 'name'        },
		{name : 'first'  },
		//{name : 'last1'  },
		{name : 'price', type: 'float' },
		{name : 'supplement', type: 'float' },
		{name : 'price_suppl'},
		{name : 'quantity'  ,type: 'float' },
		{name : 'quantityr'  ,type: 'float'},
		{name : 'quantityrt'  ,type: 'float', initValue : function(record){
		
		 var decode;
		
			 var v1 =  parseFloat(record['quantity']);
		     var v2 =  parseFloat(record['quantityr']);
			 if (!isNaN(v1) && !isNaN(v2)){
			 decode = v2-v1;
			 if(decode == 0)
			 return 0;
			 else				
				return decode;}else return 0;
			} },
		{name : 'total'  ,type: 'float'},
		{name : 'totalr'  ,type: 'float'},
		{name : 'totalrt'  ,type: 'float', initValue : function(record){
		
		 var decode;
		
			 var v1 =  parseFloat(record['total']);
		     var v2 =  parseFloat(record['totalr']);
			 if (!isNaN(v1) && !isNaN(v2)){
			 decode = v2-v1;
			 if(decode == 0)
			 return 0;
			 else				
				return decode;}else return 0;
			} },
		{name : 'observations'},
		{name : 'startt' ,type: 'date'},
		{name : 'endd' ,type: 'date'}
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
       {id: 'chk' ,isCheckColumn : true, filterable: false, exportable:false},
	   {id: 'group_id' 			,header: "Codigo" 			,width :45},
	   {id: 'name' 			,header: "Cliente" 			,width :200},
	   {id: 'first' 		,header: "N.Prof." 		,width :80 },
	   //{id: 'last1' 		,header: "A.Prof." 	,width :80 },
	   {id: 'price'   ,header: "PXH"       ,sortable:false, width :40},
	   {id: 'price_suppl'   ,header: "PXH+S"       ,sortable:false, width :50},
	   {id: 'quantity' 	    ,header: "T.C.EMT."         ,sortable:false, width :40 },
	   {id: 'quantityr'		 	,header: "T.C.RCV."	,width :80,sortable:false,   editor: { type :"text" ,validRule : ['R','F'] }},
	   {id: 'quantityrt'	,header: "Dif.",sortable:false,  width :80 },
	   {id: 'total' 		,header: "T.EMT. €" ,sortable:false,width :40 },
	  
	  {id: 'totalr'   ,header: "T.RCV. €"   ,sortable:false,width :40 ,   editor: { type :"text" ,validRule : ['R','F'] }},
	   
	   {id: 'totalrt' 	    ,sortable:false,header: "Diferencial €"             ,width :80 },
	   {id: 'observations' , header: "Obs." ,sortable:false, width :100,   toolTip : true ,toolTipWidth : 150,editor:{
        type:"textarea",width:"300px",height:"200px"
    }},
		{id: 'startt' 		,header: "Inicio" 		,width :100},
	    {id: 'endd' 			,header: "Fin" 		,width :100}
	   
	       
];


var dsgrouOption= {

	fields :[
	    {name : 'userGroup_id'  },
		{name : 'group_id'   },
		{name : 'name'  },
		{name : 'first'  },
		//{name : 'last1'  },
		{name : 'startt' ,type: 'date'},
		{name : 'endd'  ,type: 'date'},
		{name : 'fecha_recibo'  ,type: 'date'},
		{name : 'quantity'  ,type: 'float' },
		{name : 'quantityr'  ,type: 'float' },
		{name : 'quantityrt'  ,type: 'float',initValue : function(record){
		
		 var decode;
		
			 var v1 =  parseFloat(record['quantity']);
		     var v2 =  parseFloat(record['quantityr']);
			 if (!isNaN(v1) && !isNaN(v2)){
			 decode = v2-v1;
			 if(decode == 0)
			 return 0;
			 else				
				return decode;}else return 0;
			}  },
		{name : 'total'  ,type: 'float'},
		{name : 'totalr'  ,type: 'float' },
		{name : 'totalrt'  ,type: 'float' },
		{name : 'observations'}
		
		
	],
recordType : 'object'
}
 
 
function my_renderer_link(value ,record,columnObj,grid,colNo,rowNo){

	 var v0 =  record['userGroup_id'];
   	 var v1 =  record['startt'];
	 var v2 =  record['first'];
	 //var v3 =  record['last1'];
	 var v4 =  record['name'];
	 var v5 =  record['quantity'];
			 
	 var v6 =  parseFloat(record['quantityr']);
	 var v7 =  parseFloat(record['quantityrt']);
	 var v8 =  parseFloat(record['total']);
	 var v9 =  parseFloat(record['totalr']);
	 var v10 =  parseFloat(record['totalrt']);
	 var v11 = record['observations'] ; 
	 var v12 = record['entry_group_id'] ;
	 var v13 = record['fecha_recibo'] ;
	 var v14 = record['endd'];
	 
	
	
	 
	  
     var url = "PDFcreator/factura_cliente.php?id="+v0+"&startt="+v1+"&first="+v2+"&name="+v4+"&quantity="+v5+"&quantityr="+v6+"&quantityrt="+v7+"&total="+v8+"&totalr="+v9+"&totalrt="+v10+"&observations="+v11+"&entry_group_id="+v12+"&fecha_recibo="+v13+"&endd="+v14;
        
     var name = record['name'];
	 if (name != null){
		return "<a target=\"blank\" href=\"" + url + "\" >" + name + "</a>";}else return name;
		
		
}

 
var colsGroupsOption = [
	   {id: 'group_id' 		,header: "Codigo" 			,width :45},
	   {id: 'name' 			,header: "Cliente" 	,toolTip : true ,toolTipWidth : 150,	renderer:my_renderer_link, width :80},
       {id: 'first' 		,header: "N.Prof." 		,width :80 },
	   //{id: 'last1' 		,header: "A.Prof." 	,width :80 },
	   {id: 'startt'         ,header: "Inicio"       ,width :80},
	   {id: 'endd'          ,header: "Fin"         ,width :80},
	   {id: 'quantity'   ,sortable:false, header: "T.C.EMT"      ,width :70 },
	   {id: 'quantityr'  ,sortable:false, header: "T.C.RCV"   ,width :70 ,  editor: { type :"text" ,validRule : ['R','F'] }},
	   {id: 'quantityrt'  ,sortable:false, header: "Dif."  ,renderer:my_conditional,width :80 },
	   {id: 'total'      ,sortable:false,header: "T.EMT €"            ,width :80},
	   {id: 'totalr'     ,sortable:false, header: "T.RCV. €" ,width :70 ,  editor: { type :"text" ,validRule : ['R','F'] }},
	   {id: 'totalrt'     ,sortable:false,header: "Dif. €"  ,renderer:my_conditional,width :80 },
	   {id: 'observations' ,sortable:false, header: "Obs." , width :100,
    toolTip : true ,toolTipWidth : 150,editor:{
        type:"textarea",width:"300px",height:"200px"  }}
       
];
 
 function my_conditional(value ,record,columnObj,grid,colNo,rowNo){
		var no= record[columnObj.fieldIndex];
		var color = no<0?"red":(no>0?"blue":"green");
		return "<span style=\"color:" + color +";\"><strong>" + no + "</strong></span>";
}

 
var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
    width: "1150",
	height: "280", 	
    container : 'gridbox', 
	replaceContainer : true, 
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSizeList : [20,40,60],
	onCellDblClick  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	 var id = record.group_id;
	  var grid=Sigma.$grid(grid_details_id);
      grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "";
	  grid.parameters.id = id;
      grid.reload();
	},
	parameters:{'id':""},
	SigmaGridPath : 'grid/',
	lightOverRow : false,
	
			onComplete:function( grid )
            {
			
	  var grid=Sigma.$grid(grid_details_id);
      //grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "";
	  grid.parameters.id = "";
      //grid.reload();
        },
		remoteFilter: true,
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
		if (record.codigo == "TOTAL===>"){
			return 'style="height:25px; background-color:#ffddcc"';
		}
	},
 
    	toolbarContent : 'nav goto | pagesize | reload | save | state'
};

var gridOptionDetails={
	id : grid_details_id,
	loadURL : "export_php/testMasterListD1.php",
	saveURL : "export_php/testMasterListD1.php",
	width: "880",
	height: "280", 	
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
	toolbarContent : 'nav goto | reload | save del | print | state',
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
	},
	
	customRowAttribute : function(record,rn,grid){
		if (record.totalrt<0){
			return 'style="height:25px; background-color:#ffddcc"';
		}
	}
};
 
var mygrid=new Sigma.Grid( gridOption );
var mygridDetails = new Sigma.Grid(gridOptionDetails);
		

Sigma.Util.onLoad( Sigma.Grid.render(mygrid) );


Sigma.Util.onLoad( Sigma.Grid.render(mygridDetails) );

//////////////////////////////////////////////////////////

function unlockAllColumn(){
	Sigma.Column.unlockAllColumn(grid_demo_id);
}

function lockColumnNAllBefore(){
	Sigma.Column.lockColumnNAllBefore(grid_demo_id,Sigma.$("idx2").value);
}



function showGrid(){

if (Sigma.$('bigbox').style.display!="none") {
	Sigma.$('bigbox').style.display="none";
}else{
Sigma.$('bigbox').style.display='';

// must call onShow() !!!!

mygrid.onShow();

}
}
  
</script>

</head>  
  
 <?php include '../../../includes/top.php'?>

  <h1 align="center">
     Recepcion de Recibos</h1>

  
<body>  
<!-- grid container. -->


  <div id="header">
  </div>
 <div style="position: relative;" align="right">  
  <div id="content">

<table>
<tr><td>
    <div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div>
</td></tr>


</table>
 <table>
   <tr>
   <td> 
      <div id="bigboxDetails" style="margin:15px;display:!none;">  
      <div id="gridboxDetails" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:250px;width:700px;" ></div>
    </div></td>
     <td valign ="top">
 <br />
   <form name="data_entry" action="#">
 <fieldset>
<legend><b><font size="2"><font color="#3333CC" >Buscar en primera tabla:</font></font></b></legend>
<select id="f_fieldName2" style="width:238px;">
      <option value="name" >Cliente</option>
  	 <option value="b.first" >Nombre del prof.</option>
      <option value="a.id">Codigo de factura emitida</option>
     </select>
 <br />
<input type="text" name="f_value2" id="f_value2" size="40" value="">
<br />
<input type="text" name="f_date_c" id="f_date_c" size="40" value="" readonly="1" onChange="doFilter1()">

<div class="buttons"> 
    <button type="button" onclick="doFilter1()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Search
    </button> 
       <button type="button" id="startt" value="startt" class="positive">
<img src="grid/calendar/img.gif"  width="26" height="20"/>By Date </button>
     <button  class="negative" value="Reset" type="reset" onclick="doUnfilter1()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
</div>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%Y-%m-%d",
		electric       :    false,  // format of the input field
        button         :    "startt",  // trigger for the calendar (button ID)
        singleClick    :    true,           
        step           :    1 
    });
</script>

 </fieldset>
 </form>
   <br />
<form name="data_entry1" action="#">
     <fieldset>
   <legend><b><font size="2"><font color="#3333CC" >Buscar en segunda tabla:</font></font></b></legend>
<select id="f_fieldName1" style="width:238px;">
  	 <option value="name" >Cliente</option>
      <option value="c.first" >Nombre Profesor</option>
     <option value="a.entry_group_id">Codigo de factura recibida</option>
 
  </select> 
   <br />
   <input type="text" name="f_value1" id="f_value1" size="40" value="" >

      <br />
      
<input type="text" name="f_date_c1" id="f_date_c1" size="40" value="" readonly="1" onChange="doFilter()">
<div class="buttons"> 
    <button type="button" onclick="doFilter()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Search
    </button> 
    
    <button type="button" id="startt1" value="startt1" class="positive">
<img src="grid/calendar/img.gif"  width="26" height="20"/>By Date </button>

 
   
  
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%Y-%m-%d",
		electric       :    false,  // format of the input field
        button         :    "startt1",  // trigger for the calendar (button ID)
        singleClick    :    true,           
        step           :    1 
    });
</script>

       <button  class="negative" value="Reset" type="reset" onclick="doUnfilter()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
</div>


     </fieldset>
 </form>
 



</td>
</tr>
</table>



    <table id="myHead" style="display:none">
<tr>
    
     
     
     
     <td rowspan="2" columnId='chk' resizable='false'>
  <input id="g1_chk" type="checkbox"/></td>
    <td rowspan="2" columnId='group_id' resizable='false'>Codigo</td>
     <td rowspan="2" columnId='name' resizable='false'>Cliente<img src="images/customer.gif"/></td>
	 <td rowspan="2" columnId='first' resizable='false'>N. Prof.</td>
   
    <td rowspan="2" columnId='price' resizable='false'>PXH</td>
     <td rowspan="2" columnId='price_suppl' resizable='false'>PXH+S</td>
	 <td rowspan="2" columnId='quantity'>T.C.EMT.</td>
    <td rowspan="2" columnId='quantityr'>T.C.RCV.</td>
    <td rowspan="2" columnId='quantityrt'>Dif.</td>
     <td rowspan="2" columnId='total'>T.EMT. €</td>
     <td rowspan="2" columnId='totalr'>T.RCV. €</td>
	<td rowspan="2" columnId='totalrt'>Dif. €</td>
     <td rowspan="2" columnId='observations'>Obs.</td>
     <td rowspan="2" columnId='startt'>Inicial</td>
	 <td rowspan="2" columnId='endd'>Fin</td>
  
	</tr>
</table>

     
</div>

 </body>  
</html>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>