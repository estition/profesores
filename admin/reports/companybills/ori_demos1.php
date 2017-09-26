<?php include 'includes/constants.php'?>
<?php include 'includes/functions.php'?>
<?php include 'includes/database.php'?>
<?php include 'includes/authorize.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />

<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Recepción de Recibos" >
<meta name="description" content="Recepción de recibos que han sido emitidos " >
<title>PAYSHEET</title>

<link rel="stylesheet" type="text/css" media="all" href="css/buttom2.css"  />
<script src="highlight/jssc3.js" type="text/javascript"></script>
<link href="highlight/style.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="grid/calendar/JSCal2-1.9/src/js/jscal2.js"></script>
<script type="text/javascript" src="grid/calendar/JSCal2-1.9/src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="grid/calendar/JSCal2-1.9/src/css/jscal2.css"  />
<link rel="stylesheet" type="text/css" href="grid/calendar/JSCal2-1.9/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="grid/calendar/JSCal2-1.9/src/css/steel/steel.css" />

   

<link rel="stylesheet" type="text/css" href="grid/gt_grid.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/vista/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/mac/skinstyle.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/pink/skinstyle.css" />

<script type="text/javascript" src="grid/gt_msg_en.js"></script>
<script type="text/javascript" src="grid/gt_const.js"></script>
<script type="text/javascript" src="grid/ori_gt_grid_all.js"></script>
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

	var filterInfo=[
	{	
	    columnId :  Sigma.Util.getValue("f_fieldName1"),
		fieldName : Sigma.Util.getValue("f_fieldName1"),
		logic : "startWith",
		value : Sigma.Util.getValue("f_value1")
		
	},
	{
	    columnId :  "eg.startt",
		fieldName : "eg.startt",
		logic : "greatEqual",
		value : Sigma.Util.getValue("f_date_c1")
	}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo); 
}

function doFilter1() {
	
	
	if((Sigma.Util.getValue("info") != "") && (Sigma.Util.getValue("teacher_id") != "") ){
			if (0 < Sigma.Util.getValue("info").length) {
			
  			var dateRange = Sigma.Util.getValue("info").split(' ');
		}else{
	    	var currentTime = new Date();
			var month0 = currentTime.getMonth() + 1;
			var day0 = currentTime.getDate();
			var year0 = currentTime.getFullYear();
			endDate = year0+"-"+month0+"-"+day0;
			
			var month1 = currentTime.getMonth() + 1;
			var day1 = currentTime.getDate();
			var year1 = currentTime.getFullYear() - 1;
			startDate = year1+"-"+month1+"-"+day1;
	
	var dateRange = [startDate, " ", endDate];
	}
		
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
		logic : "greatEqual",
		value : dateRange[0]
	},
	{
	    columnId :  "a.day",
		fieldName : "a.day",
		logic : "lessEqual",
		value : dateRange[2]
	}
	]
	var grid=Sigma.$grid("myGrid1");
	var rowNOs=grid.applyFilter(filterInfo1); }
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
  

 
		{name : 'student_c'},
		{name : 'teacher_c'},
		{name : 'late_student'},
 
 {name : 'makeup_classes'},
 
 
		
		
		/*{name : 'taught_class'  ,initValue : function(record){

 var concept =record['concept'];
  var days =record['days'];
 var list1 =record['student_c'];			

 var lookup = {};
 

 //alert(list1);
   //alert(list1);
 for (var j in list2) {
	 if (typeof list2[j] != 'undefined' && list2[j] == 1) {
		var list3 = list1;
    
	}
	
 }
   alert('found ' + list3 + ' in both lists');
  //var list3 =  list1.split(',');
 // if(typeof list1=='string')
   

 // var  lista2 =    list1.replace(/\W/g, "-");
	//var pepe = lista2.split(",");
	
	 // alert(list2);
	// var list3 =  list4.split(',')
	 //if(typeof list=='string')
	  //alert(list3);	
	//lista5 = lista4.split();
 
 
/*var patt1=/1/gi;
//document.write(list1.length);


var lookup = {};
 
for (var j in list1) {
    lookup[list1[j]] = list2[j];
	//if(lookup[list1[j]] == '1')
	//return list1;
	
	
}
if(lookup != 'undefined')
alert(lookup);

for (var i in list1) {

    if (lookup[i] == '1') {
        //alert('found ' + lookup[i] + ' with concept 1');
		//document.write(i);
		//var list3 = list1[i];
        break;
    } 
}
			
		//return 	list3;
			
			
		
		// var v1 = record['concept'];
		// var v2 =   record['days'].split(',');
		//var v3 = v1.toString();
		 
		//alert(v1); 
	
	//	for (var i=0; i<v1.length; i++) 

//{ 
//alert(v1[i]);
//if(v1[i] == '1')
  //var days1 = v2[i].join(','); 
//}
//return days1;
			}  },*/
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
			 var v2 = Sigma.Util.getValue("info");
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
			 var v2 = Sigma.Util.getValue("info");
			 var v3 = Sigma.Util.getValue("teacher_id");
			 
						 
			if (v2 != ""){
				
   			 oAjax=newAjax();
         oAjax.open("POST", "total_prices_mes.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
				  
 				return decode;}else return 0;
			}
		}
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
       {id: 'chk' ,isCheckColumn : true, filterable: false, exportable:false},
	   //{id: 'user_id' 		,header: "Codigo" ,sortable:false,width :80 },
	   {id: 'hide' 			,header: "hide", 		hidden: "true"	,sortable:false,width :50},
	   {id: 'name' 			,header: "Cliente" 			,width :200,  toolTip : true ,toolTipWidth : 140, grouped : true },
	   

	  {id: 'months'   ,header: "Mes", hidden: "true"      ,sortable:false, width :100},
	  // {id: 'taught_class'   ,header: "taught class"       ,sortable:false, width :100},
	   {id: 'class_type' 			,header: "Categoria",  sortable:false,	renderer:class_type_render, toolTip : true ,toolTipWidth : 150, width :80, grouped : true },
	   
	   {id: 'taught' 			,header: "clase enseñada" 			,sortable:false,width :150,  toolTip : true ,toolTipWidth : 150},
	   
	  
	   {id: 'student_c' 			,header: "Est. Cancel" 			,sortable:false,width :50},
	   {id: 'teacher_c' 			,header: "teacher Cancel" 			,sortable:false,width :50},
	   {id: 'late_student' 			,header: "late stedent" 			,sortable:false,width :50},
	   {id: 'makeup_classes' 			,header: "Makeups" 			,sortable:false,width :50},
	   {id: 'hours'   ,header: "Horas"       ,sortable:false, width :80},
	   	{id: 'hxc' 			,header: "hr.C" 			,width :50},
	    {id: 'size' 			,header: "T.C." 			,sortable:false,width :50},
		
		{id: 'price' 			,header: "Rate" 			,sortable:false,width :50},
		{id: 'total' 			,header: "Total" 			,width :50, editor: { type :"text" ,validRule : ['R','F'] }},
		
	
		 {id: 'size1' 			,header: "TCRCV" 			,sortable:false,width :50, grouped : true },
		  {id: 'price1' 			,header: "TMRCV" 			,sortable:false,width :50, grouped : true }
	      
	       
];


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
		//{name : 'class_type'  },
		//{name : 'last1'  },
		{name : 'concept'  ,type: 'float' },
		{name : 'month' },
		{name : 'days'},
		{name : 'numer'},
		{name : 'admin_obs'},
		{name : 'observations'}
		
		
		
	],
recordType : 'object'
}
 
 
var colsGroupsOption = [
  	   {id: 'id' 		,header: "ID", 	sortable:false, hidden: "true", resizable:false	,width :40},
	   {id: 'name' 			,header: "Cliente" 	,toolTip : true ,toolTipWidth : 150, sortable:false,	width :150},
       {id: 'hours' 		,header: "Horas", 	sortable:false, resizable:false	,width :40},
	   //{id: 'last1' 		,header: "A.Prof." 	,width :80 },
	   {id: 'month'         ,header: "Mes"   ,width :40 , resizable:false	, sortable:false},
	 
	   //{id: 'class_type'   ,sortable:false, renderer:class_type_render, sortable:false, header: "Tipo"      ,width :60 },
	   {id: 'concept'  ,sortable:false, header: "Concepto", resizable:false,  sortable:false, renderer:concept_render ,width :80, toolTip : true ,toolTipWidth : 80 },
	    {id: 'days'         ,header: "Dias"  ,  sortable:false, width :80},
	   {id: 'numer'         ,header: "Status"   , resizable:false	    ,     sortable:false,  width :60},
	   {id: 'admin_obs' ,sortable:false, header: "Admin_Obs." , width :250,
    toolTip : true ,toolTipWidth : 150,editor:{
        type:"textarea",width:"300px",height:"200px"  }},
		
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
 
);

var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
    width: "1069",
	height: "400", 	
    container : 'gridbox', 
	replaceContainer : true, 
	editable : false,
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSizeList : [20,40,60],
	onCellDblClick  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	 var id = record.group_id;
	 var user_id = record.user_id;
	 var entry_id = record.id;
	  var grid=Sigma.$grid(grid_details_id);
     grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "&entry_id = " + entry_id + "&user_id = " + user_id + " ";
	  grid.parameters.id = id;
	   grid.parameters.user_id = user_id;
	    grid.parameters.entry_id = entry_id;
	 
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
		if (record.name == "TOTAL===>"){
			return 'style="height:25px; background-color:#ffddcc"';
		}
	},
	
	
    	toolbarContent : 'nav goto | pagesize | reload | print | mybutton1 | mybutton | state'
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
  
<body>  
<!-- grid container. -->
<?php include '../../../includes/top.php'?>

  
  <div id="header">
  <h1>
    PAYSHEET</h1>
  </div>

  <div id="content">

<table>
<tr><td>
   
</td>
<td valign ="top">
<br />




 <table width="1300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div></td>
    </tr>
  <tr>
    <td><div id="bigboxDetails" style="margin:15px;display:!none;">  
      <div id="gridboxDetails" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:250px;width:700px;" ></div>
    </div
    ><br /></td>
    <td><table>

      <tr>
      <td style="width: 20em">
        <div id="cont"></div>
          <input style="text-align: center" readonly="true" name="info" id="info" size="40" />
        </td>
        <td style="width: 90em">
           <?php 
include("authorize_user.php");
$authorize_eventos=new authorize_user;
        $teachers=$authorize_eventos->authorizeUser();
		
		
    ?>
    
   
  <select id="teacher_id" name="teacher_id" ><?php echo  $teachers; ?></select>
           
        <div class="buttons"> 
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
      </tr>
    </table>


 <!-- <input type="button" value="hide/show grid" onclick="showGrid()" />&nbsp;</p>
 -->
</td>
  </tr>
</table>

    
    


 </fieldset>

 </form>

</td>
</tr>
</table>



    <table id="myHead" style="display:none">
<tr>
    
     
     
     
    <td rowspan="2" columnId='chk' resizable='false'>
    <input id="g1_chk" type="checkbox"/></td>
    <td rowspan="2" columnId='hide' resizable='false'>Teacher</td>
         
  
     <td rowspan="2" columnId='name' resizable='true'>Cliente<img src="images/customer.gif"/></td>

   <td rowspan="2" columnId='months'>Mes</td>
    <!-- <td rowspan="2" columnId='taught_class'>Clases dadas</td>-->
     <td rowspan="2" columnId='class_type' resizable='true'>Categoria</td>
      <td rowspan="2" columnId='taught' resizable='true'>Fechas</td>
     
       
       <td rowspan="2" columnId='student_c' resizable='false'>S.C.</td>
        <td rowspan="2" columnId='teacher_c' resizable='false'>Te.C.</td>
         <td rowspan="2" columnId='late_student' resizable='false'>L.S.C</td>
         <td rowspan="2" columnId='makeup_classes' resizable='false'>M.UPS</td>
          <td rowspan="2" columnId='hours' resizable='false'>Horas</td>
            <td rowspan="2" columnId='hxc' resizable='false'>T.HrC.</td>
          <td rowspan="2" columnId='size' resizable='false'>T.C.</td>
         
          <td rowspan="2" columnId='price' resizable='false'>P.C/H</td>
           <td rowspan="2" columnId='total' resizable='false'>Total</td>
           
           <td rowspan="2" columnId='size1' resizable='false'>TCRCV</td>
           <td rowspan="2" columnId='price1' resizable='false'>TMRCV</td> 
     
	</tr>
 
</table>

     
</div>
 <script type="text/javascript">//<![CDATA[
var currentTime = new Date(); 
var year = currentTime.getFullYear();

var month = currentTime.getMonth() + 1;
if(month >= 5) month1 = month - 4;else month1 = 1;
var dayofMonth = {LastDay : function(Year,Month){ return 32 - new Date(Year,Month-1,32).getDate();}};
var day = dayofMonth.LastDay(year,month);
var date1 = year+"-"+month1+"-01";
var date2 = year+"-"+month+"-"+day; 
 


      var SELECTED_RANGE = null;
      function getSelectionHandler() {
              var startDate = null;
              var ignoreEvent = false;
              return function(cal) {
                      var selectionObject = cal.selection;

                      // avoid recursion, since selectRange triggers onSelect
                      if (ignoreEvent)
                              return;

                      var selectedDate = selectionObject.get();
                      if (startDate == null) {
                              startDate = selectedDate;
                              SELECTED_RANGE = null;
                              document.getElementById("info").value = "Click to select end date";

                              // comment out the following two lines and the ones marked (*) in the else branch
                              // if you wish to allow selection of an older will still select range)
                              cal.args.min = Calendar.intToDate(selectedDate);
                              cal.refresh();
                      } else {
                              ignoreEvent = true;
                              selectionObject.selectRange(startDate, selectedDate);
                              ignoreEvent = false;
                              SELECTED_RANGE = selectionObject.sel[0];

                              // alert(SELECTED_RANGE.toSource());
                              //
                              // here SELECTED_RANGE contains two integer numbers: start date and end date.
                              // you can get JS Date objects from them using Calendar.intToDate(number)
							 
                              startDate = null;
                              document.getElementById("info").value = selectionObject.print("%Y-%m-%d"); 

                              // (*)
                              cal.args.min = null;
                              cal.refresh();
                      }
              };
      };
	  
	        
      Calendar.setup({
              cont          : "cont",
              fdow          : 1,
			  min			:  date1,
              max			:  date2,
			  selectionType : Calendar.SEL_SINGLE,
			  onSelect      : getSelectionHandler()
      });
 
    //]]></script>
    



 </body>  
</html>
