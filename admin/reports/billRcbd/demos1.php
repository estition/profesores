<?php include '../../../includes/constants.php'?>
<?php include '../../../includes/functions.php'?>
<?php include '../../../includes/database.php'?>
<?php include '../../../includes/authorize.php'?>

<?php if($is_admin_a) { ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html><head>

<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>Emision de Recibos</title>
<meta http-equiv="Content-Language" content="en-us" /> 
<meta name="keywords" content="Emision de Recibos" >
<meta name="description" content="Emision de recibos a clientes " >


<link rel="stylesheet" type="text/css" media="all" href="css/buttom2.css"  />
<link rel="stylesheet" type="text/css" media="all" href="grid/calendar/calendar-green.css"  />
<script type="text/javascript" src="grid/calendar/calendar.js"></script>
<script type="text/javascript" src="grid/calendar/calendar-en.js"></script>
<script type="text/javascript" src="grid/calendar/calendar-setup.js"></script>

<script src="highlight/jssc3.js" type="text/javascript"></script>
<link href="highlight/style.css" rel="stylesheet" type="text/css" />



<link rel="stylesheet" type="text/css" href="grid/gt_grid.css" />
<link rel="stylesheet" type="text/css" href="grid/skin/vista/skinstyle.css" />

<script type="text/javascript" src="grid/gt_msg_en.js"></script>
<script type="text/javascript" src="grid/gt_const.js"></script>
<script type="text/javascript" src="grid/gt_grid_all.js"></script>


<script type="text/javascript" >  
<!-- All the scripts will go here  --> 

function doFilter() {
 
	var filterInfo=[
	{
	
	    columnId :  Sigma.Util.getValue("f_fieldName1"),
		fieldName : Sigma.Util.getValue("f_fieldName1"),
		logic : "startWith",
		value : Sigma.Util.getValue("f_value1")
	}
	]
	var grid=Sigma.$grid("myGrid1");
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
	var grid=Sigma.$grid("myGrid2");
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
		{name : 'userGroup_id' },
		{name : 'user_id'      },
		{name : 'group_id'     },
		{name : 'name'         },
		{name : 'first'        },
		{name : 'days'  },
	    {name : 'class_type'  },
		{name : 'length'    ,type: 'float' },
		{name : 'price' ,type: 'float'},
		{name : 'supplement',type: 'float' },
		{name : 'price_suppl',
			initValue : function(record){
		
		 var decode;
		
			 var v1 =  parseFloat(record['price']);
		     var v2 =  parseFloat(record['supplement']);
		
			 if (!isNaN(v1) && !isNaN(v2)){
			 
			 decode = v1+"+"+v2; 
			 if(v1 == 0)
			 return 0;
			 else				
				return decode;}else return 0;
			}
		},
		{name : 'start' ,type: 'date'},
		{name : 'endd' ,type: 'date',
			initValue : function(record){
			if(record['endd'] == null || record['endd'] == ''){
	var d = new Date();
	var day = 32 - new Date(d.getFullYear(), d.getMonth(), 32).getDate();
	var month = d.getMonth()+1;
	if(month < 10){month = "0"+month;}
	
	value = d.getFullYear()+"-"+month+"-"+day;
	return value;}else{return record['endd'];}
	
			}
		
		},
		{name : 'classes' ,type: 'float',
			initValue : function(record){
                        if(!isNaN(record["classes"]) &&  record["classes"] > 0 && record["classes"] !== null && typeof record["classes"] !=="undefined"){
                        
                        return record["classes"];
                        }else {
			 var decode;
			 var v1 =  record['start'];
		     var v2 =  record['endd'];
		
			
			 var v3 =  record['days'];
			 
			if (v1 != null && v2 != null){
   			 oAjax=newAjax();
         oAjax.open("POST", "class.bills.php?valor1="+v1+"&valor2="+v2+"&valor3="+v3,false);
					//ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
                  oAjax.send(null);
                  decode =oAjax.responseText;
 				
				return decode;}else return 0;
			}
                        }
		},
		{name : 'bill' ,type: 'float',
			initValue : function(record){
		
		 var decode;
		
			 var v1 =  parseFloat(record['price']);
		     var v2 =  parseFloat(record['classes']);
			 var v3 =  parseFloat(record['supplement']);
		
			 if (!isNaN(v1) && !isNaN(v2) && !isNaN(v3)){
			 
			 decode = (v3+v1)*v2;
			 if(decode == 0)
			 return 0;
			 else				
				return decode;}else return 0;
			}
		},
		
		{name : 'observations1'}	
	
		
	],
  uniqueField : 0 ,
	recordType : 'object'
}
 
 
 
var colsOption = [
       {id: 'name' 			,header: "Cliente" 			,width :200},
	   {id: 'first' 		,header: "N.Prof." 		,width :140 },
	   {id: 'days'		 	,header: "dias",		sortable:false	 	,width :80 },
	   {id: 'class_type'	,header: "TC",  sortable:false,	renderer:class_type_render, toolTip : true ,toolTipWidth : 150, width :80 },
	   {id: 'length' 		,header: "Duracion",  sortable:false	,width :40 },
	   {id: 'price'   ,header: "PXH"    ,sortable:false, width :40,   editor: { type :"text" ,validRule : ['R','F'] }},
	   { id : 'supplement'    , header : "Sup." , width : 40 , sortable:false,
                  editor: { type :'text' ,
                      validator : function(value,record,colObj,grid){ 
                          value=Number(value);
                          if ( !isNaN(value) && ( value>0 && value< 5 ) ) {
                              return true;
                          }
                          return "0~5 accepted only";
                      } 
                  }  
              },
	  
	   {id: 'start' 		,header: "Inicio", 	sortable:false	,width :100,  editor: { type :"date"}},
	   {id: 'endd' 			,header: "Fin" 	,sortable:false,  width :100,  editor: { type :"date",validRule:['R'] }},
	   {id: 'classes' 	    ,header: "T.C.EMT."           ,sortable:false, width :100,   editor: { type :"text" ,validRule : ['R','F'] } },
	   {id: 'bill' 	    	,header: "T.EMT. €"             ,sortable:false, width :60 },
	   {id: 'observations1' , header: "Obs1." , sortable:false, width :100,
    toolTip : true ,toolTipWidth : 150,editor:{
        type:"textarea",width:"300px",height:"200px"
    }}
	   
	   
       
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
		{name : 'userGroup_id'},
		{name : 'group_id'},
		{name : 'name'   },
		{name : 'first'  },
		{name : 'days'  },
		{name : 'startt' ,type: 'date'},
		{name : 'endd'  ,type: 'date'},
		//{name : 'supplement',type: 'float' },
		{name : 'price',type: 'float' },
		{name : 'price_suppl'},
		{name : 'length'    ,type: 'float' },
	    {name : 'class_type'  },
		{name : 'quantity'  ,type: 'float' },
		{name : 'total'  ,type: 'float'},
		{name : 'observations'}
		
		
	],
recordType : 'object'
}
 
 
function my_renderer_link(value ,record,columnObj,grid,colNo,rowNo){

	 var v0 =  record['endd'];
   	 var v1 =  record['startt'];
	 var v2 =  record['first'];
	 var v4 =  record['name'];
	 var v5 =  record['group_id'];
			 
	 var v6 =  parseFloat(record['quantity']);
	 var v7 =  parseFloat(record['total']);
	 var v8 =  parseFloat(record['supplement']);
	 var v9 =  parseFloat(record['price']);
	// var v10 = record['userGroup_id'] ;
	 var v11 =  parseFloat(record['length']);
	 var v12 = record['observations'] ; 
	/* var v12 =  record['class_type'];
	 
	  var options = {'1': 'Individual','2':'GC I', '3':'GC II','4': 'GC III'};
       var ret = options[v12];
       if(ret==null){
       ret = v12;
     }*/
  	  
     var url = "PDFcreator/factura_cliente.php?endd="+v0+"&startt="+v1+"&first="+v2+"&name="+v4+"&group_id="+v5+"&quantity="+v6+"&total="+v7+"&supplement="+v8+"&rate="+v9+"&length="+v11+"&observations="+v12;
        
     var name = record['name'];
	 if (name != null){
		return "<a target=\"blank\" href=\"" + url + "\" >" + name + "</a>";}else return name;
		
		
}

 
var colsGroupsOption = [
	   {id: 'group_id' 		,header: "Codigo" 			,width :45},
	   {id: 'name' 			,header: "Cliente" 	,toolTip : true ,toolTipWidth : 150,	renderer:my_renderer_link, width :80},
       {id: 'first' 		,header: "N.Prof." 		,width :150 },
	   {id: 'startt'         ,header: "Inicio"       ,width :80,  editor: { type :"date",validRule:['R']}},
	   {id: 'endd'          ,header: "Fin"         ,width :80,  editor: { type :"date",validRule:['R']}},
	   {id: 'price'   ,header: "RICES"       ,sortable:false, width :40},
	   {id: 'price_suppl'   ,header: "PXH+S"       ,sortable:false, width :50},
	   
	   {id: 'quantity'      ,header: "T.C.EMT."             ,width :70},
	   {id: 'total'         ,header: "T.EMT. €"            ,width :80},
	   {id: 'observations' , header: "Obs." , sortable:false, width :100,
    toolTip : true ,toolTipWidth : 150,editor:{
        type:"textarea",width:"300px",height:"200px"  }}
       
];
 
var gridOption={
    id : grid_demo_id,
	loadURL : "export_php/testMasterListD.php",
	saveURL : "export_php/testMasterListD.php",
    width: "1110",
	height: "300", 	
    container : 'gridbox', 
	replaceContainer : true, 
    dataset : dsOption ,
    columns : colsOption,
	customHead : 'myHead',
	pageSize : 20 ,
    pageSizeList : [20,40,60],
	 remotePaging : true,
	onCellDblClick  : function(value, record , cell, row,  colNO, rowNO,columnObj,grid){
	  var id = record.group_id;
	  var grid=Sigma.$grid(grid_details_id);
      grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "";
	  grid.parameters.id = id;
      grid.reload();
	},
	parameters:{'id':""},
	SigmaGridPath : 'grid/',
	
	
	onComplete:function( grid )
            {
			
	  var grid=Sigma.$grid(grid_details_id);
      //grid.loadURL = "export_php/testMasterListD1.php?id=" + id + "";
	  grid.parameters.id = "";
      //grid.reload();
        },
	
	
		remoteFilter: true,
        autoLoad : true,
        showIndexColumn : true,
		remoteSort : true,
		
	
	defaultRecord : {'name':"",'first':"",'days':"",
                         'class_type':1,'length':0,'start':"2008-01-01",'endd':"2008-01-01",'supplement':0},

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
  beforeSave:function(requestParameter){
  
     var date1=requestParameter.updatedRecords[0]["start"];
	 var date2=requestParameter.updatedRecords[0]["endd"];
	  //var date3=requestParameter.updatedRecords[0]["observations"];
    
	 
  if(date1 == null || date2 == null){
      alert("Date1 or Date2 Required!");
	  return false;
	  }else{return true;}
          
  },
 /* customRowAttribute : function(record,rn,grid){
		if (record.observations1.length > 4){
			return 'style="height:25px; background-color:#ffddcc"';
		}
	},*/
    	toolbarContent : 'nav goto | pagesize | reload | save | state'
};

var gridOptionDetails={
	id : grid_details_id,
	loadURL : "export_php/testMasterListD1.php",
	saveURL : "export_php/testMasterListD1.php",
	width: "782",
	height: "255", 	
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
		if (record[6]<3){
			
			return 'style="height:50px; background-color:#ffddcc"';
		}
	},
	toolbarContent : 'nav goto | pagesize | reload | save del  | state'
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
     Emision de Recibos</h1>

  
<body>  
<!-- grid container. -->


  <div id="header">
  </div>
 <div style="position: relative;" align="right">  
  <div id="content">

      <div id="bigbox" style="margin:15px;display:!none;">
      <div id="gridbox" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:200px;width:700px;" ></div>
    </div>
 
    
 
 <table>
   <tr>
   <td valign ="top"> 
      <div id="bigboxDetails" style="margin:15px;display:!none;">  
      <div id="gridboxDetails" style="border:0px solid #cccccc;background-color:#f3f3f3;padding:5px;height:250px;width:700px;" ></div>
    </div></td>
   <td align="left" valign ="top">
   <br />
   <form name="data_entry" action="#">
 <fieldset>
<legend><b><font size="2"><font color="#3333CC" >Buscar en primera tabla:</font></font></b></legend>
<select id="f_fieldName1" style="width:238px;">
     <option value="name" >Nombre Cliente</option>
     <option value="b.first" >Nombre Profesor</option>
     </select>
        <br />
<input type="text" name="f_value1" id="f_value1" size="40" value="">


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
   <br />
<form name="data_entry1" action="#">
     <fieldset>
   <legend><b><font size="2"><font color="#3333CC" >Buscar en segunda tabla:</font></font></b></legend>
<select id="f_fieldName2" style="width:238px;">
  	 <option value="b.first">Nombre del Profesor</option>
     <option value="a.id" >Codigo factura emitida</option>
 
  </select> 
   <br />
   <input type="text" name="f_value2" id="f_value2" size="40" value="" >

      <br />
<input type="text" name="f_date_c" id="f_date_c" size="40" value="" readonly="1" onChange="doFilter1()">
<div class="buttons"> 
    <button type="button" onclick="doFilter1()" class="positive">
        <img src="images/boton_buscar.png" alt=""/> 
        Search
    </button> 
    <button type="button" id="startt" value="startt" class="positive">
<img src="grid/calendar/img.gif"  width="26" height="20"/>By Date </button>

       <button  class="negative" value="Reset" type="reset" onclick="doUnfilter()" >
        <img src="images/cerrar1.gif" width="12" height="12" alt="">
        Reset
        </button>
        
</div>


     </fieldset>
 </form>
 
 
   
  
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
</td>
</tr>
</table>



    <table id="myHead" style="display:none">
<tr>
  <td rowspan="2" columnId='name' resizable='false'>Cliente<img src="images/customer.gif"/></td>
    <td rowspan="2" columnId='first' resizable='false'>N.Prof.</td>
    <td rowspan="2" columnId='days'>dias</td>
	<td rowspan="2" columnId='class_type'>TC</td>
	<td rowspan="2" columnId='length'>Duracion</td>
    <td rowspan="2" columnId='price'>PXH</td>
   	<td rowspan="2" columnId='supplement'>Sup.</td>
    <td rowspan="2" columnId='start'>Inicio</td>
	<td rowspan="2" columnId='endd'>Fin</td>
    <td rowspan="2" columnId='classes'>T.C.EMT.</td>
     <td rowspan="2" columnId='bill'>T.EMT. €</td>
    <td rowspan="2" columnId='observations1'>Obs.</td>
  
	</tr>
</table>
     </div>  
       

</body>


</html>
<?php } else { echo "NOT AUTHORIZED TO SEE THIS PAGE, PLEASE RETURN BACK"; }?>