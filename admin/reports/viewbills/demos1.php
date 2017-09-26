<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>Ver de Recibos</title>
<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Recepción de Recibos" >
<meta name="description" content="Recepción de recibos que han sido emitidos " >


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
<script type="text/javascript" src="grid/gt_grid_all.js"></script>
<script type="text/javascript" src="grid/flashchart/fusioncharts/FusionCharts.js"></script>


<script type="text/javascript" >  
<!-- All the scripts will go here  --> 

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
	
	var opr = "";
	var val = 0;
	var selector = Sigma.Util.getValue("f_fieldName3");

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
		
	if(selector){
	
	
		switch(selector)
               {
                 case "nodo":
				 
                    opr = "null";
					val = "null";
					columntb =  "b.total";
		            fieldNametb = "b.total"
					
				 
                 break;
                 case "todo":
				 	
					opr = "notnull";
					val = "null";
					columntb =  "a.totalr";
		            fieldNametb = "a.totalr"
									
				    break;
					  
                 
				}}
				
	var filterInfo1=[
	{
	
	
	    columnId :  Sigma.Util.getValue("f_fieldName2"),
		fieldName : Sigma.Util.getValue("f_fieldName2"),
		logic : "startWith",
		value : Sigma.Util.getValue("f_value2")
		
		
	},
	{
	    columnId :  "a.startt",
		fieldName : "a.startt",
		logic : "greatEqual",
		value : dateRange[0]
	},
	{
	    columnId :  "a.startt",
		fieldName : "a.startt",
		logic : "lessEqual",
		value : dateRange[2]
	},
	{
		columnId :  columntb,
		fieldName : fieldNametb,
		logic : opr,
		value : val
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

var dsOption= {

	fields :[
		{name : 'codigo'     },
		{name : 'user_id'     },
		{name : 'group_id'     },
		{name : 'name'        },
		{name : 'first'  },
		{name : 'price', type: 'float' },
		{name : 'totalrt', initValue : function(record){
		
		 var decode;
		
		    
			 var v1 =  parseFloat(record['total']);
		     var v2 =  parseFloat(record['totalr']);
			 if (!isNaN(v1) && !isNaN(v2)){
			 decode = v2-v1;
			 if(decode == 0)
			 return 0;
			 else				
				return addCommas(decode);}else return 0;
			} },
		{name : 'total'  , initValue : function(record){
		
		 
		     var tot =  parseFloat(record['total']);
			 if (!isNaN(tot)){
			 		
				return addCommas(tot);}else return 0;
			}},
		{name : 'totalr'  , initValue : function(record){
		
		 
		     var totr =  parseFloat(record['totalr']);
			 if (!isNaN(totr)){
			 		
				return addCommas(totr);}else return 0;
			}}
		
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
       {id: 'chk' ,isCheckColumn : true, filterable: false, exportable:false},
	   {id: 'codigo' 			,header: "Codigo" 			,width :45},
	   {id: 'name' 			,header: "Cliente" 			,width :200},
	   {id: 'first' 		,header: "N.Prof." 		,width :150 },
	   {id: 'price'   ,header: "PXH"       ,sortable:false, width :40},
	   {id: 'total' 		,header: "Imp. Emitido" ,sortable:false,width :80 },
	  
	  {id: 'totalr'   ,header: "Imp. Cobrado"   ,sortable:false,width :80 },
	   
	   {id: 'totalrt' 	    ,sortable:false,header: "Diferencial €"             ,width :80 }
	      
	       
];


var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
    width: "730",
	height: "500", 	
    container : 'gridbox', 
	replaceContainer : true, 
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSizeList : [60,120,180],
	SigmaGridPath : 'grid/',
	lightOverRow : false,

		remoteFilter: true,
	    pageSize : 60 ,
       
        remotePaging : true,
        autoLoad : true,
        showIndexColumn : true,
		remoteSort : true,
	
	//defaultRecord : ["","","","",0,0,0,0,"2008-01-01"],

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
 
    	toolbarContent : 'nav goto | pagesize | reload | state'
		
};


var mygrid=new Sigma.Grid( gridOption );
	

Sigma.Util.onLoad( Sigma.Grid.render(mygrid) );



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
     Ver Recibos</h1>

  
<body>  
<!-- grid container. -->


  <div id="header">
  </div>
 <div style="position: relative;" align="center">  
  <div id="content">

<table>
<tr><td>
    <div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div>
</td>
<td valign ="top">
<br />
   <form name="data_entry" action="#">
 <fieldset>
<legend><b><font size="2"><font color="#3333CC" >Buscar por:</font></font></b></legend>
<select id="f_fieldName3" onchange="doFilter1()" style="width:238px;">
	<option value="todo" selected="selected">Todo</option>
    <option value="nodo">Sobres no Entregados</option>
    
      </select>
<br />
<select id="f_fieldName2" style="width:238px;">
      <option value="name" >Cliente</option>
  	 <option value="c.first">Nombre del prof.</option>
     <option value="a.group_id">Codigo de factura emitida</option>
     </select>
 <br />
<input type="text" name="f_value2" id="f_value2" size="40" value="">
<br />

<table align="center">
      <tr>
        <td style="width: 20em">
          <div id="cont"></div>
          <input style="text-align: center" readonly="true" name="info" id="info" size="40" />
        </td>
      </tr>
    </table>

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




 </fieldset>

 </form>
   <br />
<!--<form name="data_entry1" action="#">
     <fieldset>
   <legend><b><font size="2"><font color="#3333CC" >Buscar en segunda tabla:</font></font></b></legend>
<select id="f_fieldName1" style="width:238px;">
  	 <option value="name" >Cliente</option>
      <option value="first">Nombre del prof.</option>
     <option value="last1">Apellido del prof.</option>
     <option value="eg.id">Codigo de factura recibida</option>
 
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
 </form>-->
 

</td>

</tr>


</table>
 
    <table id="myHead" style="display:none">
<tr>
    
     
     
     
     <td rowspan="2" columnId='chk' resizable='false'>
    <input id="g1_chk" type="checkbox"/></td>
    <td rowspan="2" columnId='codigo' resizable='false'>Codigo</td>
     <td rowspan="2" columnId='name' resizable='false'>Cliente<img src="images/customer.gif"/></td>
	 <td rowspan="2" columnId='first' resizable='false'>N. Prof.</td>
     <td rowspan="2" columnId='price' resizable='false'>PXH</td>
	 <td rowspan="2" columnId='total'>Imp. Emitido</td>
     <td rowspan="2" columnId='totalr'>Imp. Cobrado</td>
	 <td rowspan="2" columnId='totalrt'>Diferencia</td>
  
	</tr>
</table>

     

 </div>  
       
 
  <script type="text/javascript">//<![CDATA[

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
                              // if you wish to allow selection of an older date (will still select range)
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
			  selectionType : Calendar.SEL_SINGLE,
			  onSelect      : getSelectionHandler()
      });

    //]]></script>
    



 </body>  
</html>