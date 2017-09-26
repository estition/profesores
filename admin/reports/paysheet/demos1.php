<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>
<?php if($is_admin_a){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" 
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Recepción de Recibos" >
<meta name="description" content="Recepción de recibos que han sido emitidos " >
<title>PAYSHEET</title>

<link rel="stylesheet" type="text/css" media="all" href="css/buttom2.css"  />
<script src="highlight/jssc3.js" type="text/javascript"></script>
<link href="highlight/style.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="grid/gt_grid.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/vista/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/mac/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/pink/skinstyle.css" />

<script type="text/javascript" src="grid/gt_msg_en.js"></script>

<script type="text/javascript" src="grid/copy_gt_grid_all.js"></script>
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

function doFilter1() {
	
			
	var filterInfo1=[
	{
	
	
	    columnId :  "a.user_id",
		fieldName : "a.user_id",
		logic : "equal",
		value : Sigma.Util.getValue("teacher_id")
		
		
	},
	{
	    columnId :  "a.day",
		fieldName : "a.day",
		logic : "like",
		value : Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month")
	}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo1); 
}



/*function doFilter2() {
	
	var selector = Sigma.Util.getValue("f_fieldName3");
	var opr = "";
	var val = 0;
	
		switch(selector)
               {
                 case "nodo":
				 
                    opr = "null";
					val = "null";
				 
                 break;
                 case "moroso":
	
					opr = "less";
					val = "eg.total"
								 
				    break;
                 case "doit":
				 	
					opr = "aldia";
					val = "eg.total"
									
				    break;
					  case "todo":
				 	
					opr = "less";
					val = "eg.total or totalr is null"
									
				    break;
                 		 
                 
				}

	var filterInfo2=[
{
	
				
							 
		columnId :  "eu.totalr",
		fieldName : "eu.totalr",
		logic : opr,
		value : val
		
}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo2); 
}
*/
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

		{name : 'id'     },
		{name : 'hide'},
		{name : 'name' },
		{name : 'hours'     },
		{name : 'months'     },
	    {name : 'concept'     },
		{name : 'taught' },
		{name : 'dias_c' }, 
		{name : 'student_c'},
		{name : 'teacher_c'},
		{name : 'late_student'},
 
 {name : 'makeup_classes'},
 
 
		

			{name : 'status1' ,
			initValue : function(record){
			 var decode;
			 var v1 =  record['group_id'];
			 var v2 = Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month");
			 var v3 = Sigma.Util.getValue("teacher_id");
			 
						 
			if (v3 != ""){
				
   			 oAjax=newAjax();
         oAjax.open("POST", "status.php?valor1="+v1+"&valor3="+v3+"&valor2="+v2,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
				  
 				return decode;}else return 0;
			}
		},
		{name : 'class_type'     },
	
		{name : 'group_id'     },
		{name : 'user_id'     },
		{name : 'hxc'},
		{name : 'size'},
	
  		{name : 'price'},
		{name : 'total'},
		
	   
		
		{name : 'size1' ,
			initValue : function(record){
			 var decode;
			 var v1 =  record['group_id'];
			 var v2 = Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month");
			 var v3 = Sigma.Util.getValue("teacher_id");
			
						 
			if (v2 != ""){
				
   			 oAjax=newAjax();
         oAjax.open("POST", "total_clases_mes.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
				  
 				return decode;}else return 0;
			}
		},
  		{name : 'price1' ,type: 'float',
			initValue : function(record){
			 var decode;
			 var v1 =  record['group_id'];
			 
			 var v2 = Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month");
			 var v3 = Sigma.Util.getValue("teacher_id");
			 
						 
			if (v2 != ""){
				
   			 oAjax=newAjax();
         oAjax.open("POST", "total_clases_mes_emitido.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
				 
				 // alert(decode[1]);
				  // alert(decode[0]);
				// alert(decode["quantity"]);
				  //alert(decode);customRowAttribute : function(record,rn,grid){
				
				  
 				return decode;}else return 0;
			}
		},
		{name : 'dif'  ,type: 'float',initValue : function(record){
		
		 var decode;
		
			 var v1 =  record['size1'];
			 var v3 = record['price1'];
			// var v3 = v2.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
		    var v3 =  parseFloat(v3);
			// alert(v4);
			 if (!isNaN(v1) && !isNaN(v3)){
			 decode = v1-v3;
			 //alert(decode);
			 if(decode == 0)
			 return 0;
			 else				
				return decode;}else return 0;
				
			}  },
		
		{name : 'day' ,
			initValue : function(record){
			
			 return Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month");
			
			}
		}
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
    
	   //{id: 'user_id' 		,header: "Codigo" ,sortable:false,width :80 },
	   {id: 'hide' 			,header: "name", 		hidden: "true"	,sortable:false,width :0},
	   {id: 'name' 			,header: "Cliente" 			,width :200, renderer:my_renderer_link,  toolTip : true ,toolTipWidth : 140, grouped : true },
	   

	
	   {id: 'class_type' 			,header: "Categoria",  sortable:false,	renderer:class_type_render, toolTip : true ,toolTipWidth : 150, width :80, grouped : true },
	   
	   {id: 'taught' 			,header: "clase enseñada" 			,sortable:false,width :160,  toolTip : true ,toolTipWidth : 150},
	    {id: 'dias_c' 			,header: "dias" 			,sortable:false,width :60},
	  
	   {id: 'student_c' 			,header: "Est. Cancel" 			,sortable:false,width :70},
	   {id: 'teacher_c' 			,header: "teacher Cancel" 			,sortable:false,width :70},
	   {id: 'late_student' 			,header: "late stedent" 			,sortable:false,width :70},
	   {id: 'makeup_classes' 			,header: "Makeups" 			,sortable:false,width :70},
	   {id: 'status1' 			,header: "ESTATUS",  resizable:false,renderer:my_conditional	    ,     sortable:false,  width :55},
	   {id: 'hours'   ,header: "Horas"       ,sortable:false, width :40},
	   	{id: 'hxc' 			,header: "hr.C" 			,width :40},
	    {id: 'size' 			,header: "T.C." 			,sortable:false,width :30},
		
		{id: 'price' 			,header: "Rate" 			,sortable:false,width :50},
		{id: 'total' 			,header: "Total" 			,width :50, editor: { type :"text" ,validRule : ['R','F'] }},
		
	{id: 'price1' 			,header: "TMRCV", resizable:false 	 	,sortable:false,width :50, grouped : true },
		 {id: 'size1' 			,header: "TCRCV", resizable:false	 			,sortable:false,width :50, grouped : true },

 {id: 'dif'  ,sortable:false, header: "Dif."  ,renderer:my_conditional,width :40 }

	    
	       
	       
];
 function my_conditional(value ,record,columnObj,grid,colNo,rowNo){
		var no= record[columnObj.fieldIndex];
		var color = no<0?"red":(no>0?"blue":"green");
		return "<span style=\"color:" + color +";\"><strong>" + no + "</strong></span>";
}


function my_renderer_link(value ,record,columnObj,grid,colNo,rowNo){

	 var v5 =  record['group_id'];
			 
	
  	  
     var url =  "http://www.canterburyenglish.com/profesores/admin/clients/group_profile.php?id="+v5;
        
     var name = record['name'];
	 if (name != null){
		return "<a target=\"blank\" href=\"" + url + "\" >" + name + "</a>";}else return name;
		
		
}





function class_type_render(value ,record,columnObj,grid,colNo,rowNo){
       var options = {'1': 'Individual','2':'GC I', '3':'GC II','4': 'GC III'};
       var ret = options[value];
       if(ret==null){
       ret = value;
     }
       return ret;
}

var dsgrouOption= {

	fields :[
		 {name : 'id'  },
	    {name : 'name'  },
		//{name : 'supplement'   },
		{name : 'hours'  },
		{name : 'group_id '  },
		//{name : 'last1'  },
		{name : 'concept'  ,type: 'float' },
		{name : 'month' },
		{name : 'days'},
		{name : 'numer'},
		{name : 'admin_obs' ,
			initValue : function(record){
			 var decode;
			 var v1 =  record['group_id'];
			 var v2 = Sigma.Util.getValue("year")+"-"+Sigma.Util.getValue("month");
			 var v3 = Sigma.Util.getValue("teacher_id");
			
						 
			if (v2 != ""){
				
   			 oAjax=newAjax();
         oAjax.open("POST", "admin_obs.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
				  
 				return decode;}else return 0;
			}
		},
		
		{name : 'observations'}
		
		
		
	],
recordType : 'object'
}
 
 
var colsGroupsOption = [
  	   {id: 'id' 		,header: "ID", 	sortable:false, hidden: "true", resizable:false	, width :40},
	   {id: 'name' 			,header: "Cliente" 	,toolTip : true ,toolTipWidth : 150, sortable:false, grouped : true,	width :150},
       {id: 'hours' 		,header: "Horas", 	sortable:false, resizable:false	,width :40},
	   //{id: 'last1' 		,header: "A.Prof." 	,width :80 },
	   {id: 'month'         ,header: "Mes"   ,width :40 , resizable:false	, sortable:false, grouped : true},
	 
	   //{id: 'class_type'   ,sortable:false, renderer:class_type_render, sortable:false, header: "Tipo"      ,width :60 },
	   {id: 'concept'  ,sortable:false, header: "Concepto", resizable:false,  sortable:false, renderer:concept_render ,width :80, toolTip : true ,toolTipWidth : 80 },
	    {id: 'days'         ,header: "Dias"  ,  sortable:false, width :80},
	   {id: 'numer'         ,header: "Status"   , resizable:false	    ,     sortable:false,  width :60},
	   {id: 'admin_obs' ,sortable:false, header: "Admin_Obs." , width :250,
    toolTip : true ,toolTipWidth : 150},
		
		{id: 'observations' 			,header: "Obs." 	,toolTip : true ,toolTipWidth : 150,	sortable:false, width :250}
        
];
 
 function my_conditional(value ,record,columnObj,grid,colNo,rowNo){
		var no= record[columnObj.fieldIndex];
		var color = no<0?"red":(no>0?"blue":"green");
		return "<span style=\"color:" + color +";\"><strong>" + no + "</strong></span>";
}

function concept_render(value ,record,columnObj,grid,colNo,rowNo){
       var options = {'2': 'Student Cancellation','3':'Late Student Cancellation', '4':'Teacher Cancellation','5': 'Makeup Class Taught (Only previous months)','6': 'Makeup Class Taught (Only previous months)'};
       var ret = options[value];
       if(ret==null){
       ret = value;
     }
       return ret;
}

/*
Sigma.ToolFactroy.register(
 'mybutton1',  
   {
      cls : 'mybutton-cls1',  
      toolTip : 'Close Month',
      action : function(event,grid) {   
 

	  grid.parameters.myactionsave = "customupsave";
	  grid.parameters.myActionUpdate = "";
         // tell grid to save:
         grid.save();
		
 
      }
   }

 );

Sigma.ToolFactroy.register(
   'mybutton',  
   {
      cls : 'mybutton-cls',  
      toolTip : 'Re-Open Month',
      action : function(event,grid) {   
 
      grid.parameters.myActionUpdate = "customupdate";
	  grid.parameters.myactionsave ="";

         // tell grid to save:
         grid.save();
		  
 
      }
   }
 
);*/

var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
    width: "1135",
	height: "310", 	
    container : 'gridbox', 
	replaceContainer : true, 
	selectRowByCheck : true,
	editable : false,
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSizeList : [20,40,60],
	onCellDblClick  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	 var id = record.group_id;
	 var user_id = record.user_id;
	// var entry_id = record.id;
	 var partdate = record.day;
	  var grid=Sigma.$grid(grid_details_id);
  grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "&partdate = " + partdate + "&user_id = " + user_id + " ";
	  grid.parameters.id = id;
	    grid.parameters.partdate = partdate;
	   grid.parameters.user_id = user_id;
	   // grid.parameters.entry_id = entry_id;
	 
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
			var res = record.price1.substring(2,3);
	
		//var pepe = res.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
		//alert(res);
		if(res == " "){
		
			return 'style="height:25px; background-color:#ffddcc"';
		}
	},
	
	
    	toolbarContent : 'nav goto | pagesize | reload | print | state'
};

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
	toolbarContent : 'reload | state',
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

if (Sigma.$('bigboxDetails').style.display!="none") {
	Sigma.$('bigboxDetails').style.display="none";
}else{
Sigma.$('bigboxDetails').style.display='';

// must call onShow() !!!!

mygrid.onShow();

}
}
  
</script>
</head>  
  
  
 <?php include '../../../includes/top.php'?>

  <h1 align="center">
     Paysheet</h1>

  
<body>  
<!-- grid container. -->


 
  <div id="content">






 <table border="0" align="right" cellspacing="0" cellpadding="0">
 

  <tr>
  <td >
 
  
          </br>  </br> </br>  </br></br>  </br></br>  </br></br>  </br></br>  </br>         <?php 
include("authorize_user.php");
$authorize_eventos=new authorize_user;
        $teachers=$authorize_eventos->authorizeUser($link);
		
		
		$year1 = date("Y")+2;
		$year2 = date("Y")-1;
		for ($year2; $year2 < $year1; $year2++) {
			
			
			 $selected = (date("Y") == $year2) ? 'selected="selected"' : '--';

     $years .= "<option value=\"{$year2}\" {$selected}>{$year2}</option>\n";

	
}   
    ?>
    
   
  <select id="teacher_id" name="teacher_id" ><?php echo  $teachers; ?></select>
          <br><br> 
           <select name="year" id="year"><?php echo  $years; ?></select>
<br><br>
<select name="month" id="month">
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
        <br ><br >

           
           
        <div align="center" class="buttons"> 
    <button type="button" onclick="doFilter1()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Search
    </button> 
      
     <button  class="negative" value="Reset" type="reset" onclick="doUnfilter1()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
</div>
 
 
</td>
    <td colspan="2"><div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div></td>
    </tr>
    
  <tr>
   <td valign="top">
      
        </td>
     
    <td align="left"><div id="bigboxDetails" style="margin:15px;display:!none;">  
      <div id="gridboxDetails" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:250px;width:700px;" ></div>
    </div
    ><br /></td>
    
       
      </tr>
    
</table>



    <table id="myHead" align="center" style="display:none">
<tr>
    
    
  <td rowspan="2" columnId='hide' resizable='false'></td>
     <td rowspan="2" columnId='name' resizable='true'>Cliente<img src="images/customer.gif"/></td>
<td rowspan="2" columnId='class_type' resizable='true'>Categ</td>
      <td rowspan="2" columnId='taught' resizable='true'>Fechas</td>
       <td rowspan="2" columnId='dias_c' resizable='false'>dias</td>
      <td rowspan="2" columnId='student_c' resizable='false'>S.C.</td>
      
        <td rowspan="2" columnId='teacher_c' resizable='false'>Te.C.</td>
         <td rowspan="2" columnId='late_student' resizable='false'>L.S.C</td>
         <td rowspan="2" columnId='makeup_classes' resizable='false'>M.UPS</td>
          <td rowspan="2" columnId='status1' resizable='true'>ST</td>
          <td rowspan="2" columnId='hours' resizable='false'>Horas</td>
          <td rowspan="2" columnId='hxc' resizable='false'>T.HrC.</td>
          <td rowspan="2" columnId='size' resizable='false'>T.C.</td>
             <td rowspan="2" columnId='price' resizable='false'>PXH+S</td>
           <td rowspan="2" columnId='total' resizable='false'>Total</td>
           
               
              <td rowspan="2" columnId='size1' resizable='true'>TCEMT</td>
              <td rowspan="2" columnId='price1' resizable='true'>TCRCV</td>
           
           <td rowspan="2" columnId='dif' resizable='true'>DIF</td>
           
     
	</tr>
 
</table>
 
 </body>  
</html>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>