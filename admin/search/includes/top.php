 <link rel="stylesheet" href="css/style.css" type="text/css" media="all" charset="utf-8"/>
	<head>

     <style type="text/css" media="screen">
 /* general */

body {
	background-color: #fff;
	margin: 0;
	padding: 0;
}
body, td, p, th {
	font-family: tahoma, verdana, arial, helvetica, sans-serif;
	font-size: 8pt; 
	color: #333;
}
img {
	border-color: #fff;
}


input {
  font-size: 9pt;
	color: #333;
	line-height: 14px;
}

select {
  font-size: 9pt;
	color: #333;
	line-height: 14px;
}

textarea {
  font-size: 9pt;
	color: #333;
	line-height: 14px;
}

.menuText {
	font-size: 10pt;
	color: #172244;
	line-height: 14px;
}

.textB {
	font-size: 10pt;
	color: #333;
	line-height: 14px;
}

.heading {
	font-size: 8pt;
	color: #172244;
	line-height: 14px;

}

.submit-button {
  font-size: 10pt;
	color: #FFFFFF;
	background: #0033CC;
	border: 0px;
	border-color: #0033CC;
	padding: 3px 10px
	align: left;
	cursor: hand;
}

.textW {
	font-size: 8pt;
	color: #ffffff;
	line-height: 14px;
}

.textWBig {
	font-size: 16pt;
	color: #ffffff;
	line-height: 16px;
	
}

.boldText {
	font-size: 9pt;
	color: #ff9900;
	line-height: 14px;
	text-decoration: none;
}


a:link, a.normal:link {
	color: #172244;
	font-size: 9pt;
	text-decoration: none;
}

a:visited, a.normal:visited {
	color: #172244;
	font-size: 9pt;
	text-decoration: none;
}
a:hover, a.normal:hover {
	color: #0033CC;
	font-size: 9pt;
	text-decoration: none;
}
a:active, a.normal:active {
	color: #0033CC;
	font-size: 9pt;
	text-decoration: none;
}

	a.button{
			display:block;
			color:#FFF;
			text-decoration:none;
			font-family:'Helvetica', Arial, sans-serif;
			font-size:13px;
			padding:3px 5px;
			text-shadow:1px 1px 1px #325179;
		}

 table.pepe {
                
                width: 85%;
                height:25%;
                
                *border-collapse: collapse; 
                border-spacing: 0;
                border:1px solid white;
                 -moz-border-radius: 20px 20px  20px 20px;
                border-radius: 20px 20px  20px 20px;
            } 
			
			 table.pepe1{
                
                width: 50%;
                height:25%;
                
                *border-collapse: collapse; 
                border-spacing: 0;
                border:1px solid white;
                 -moz-border-radius: 20px 20px  20px 20px;
                border-radius: 20px 20px  20px 20px;
            }    

	 table.pepe2{
                
                width: 0%;
                height:25%;
                
                *border-collapse: collapse; 
                border-spacing: 0;
                border:1px solid white;
                 -moz-border-radius: 20px 20px  20px 20px;
                border-radius: 20px 20px  20px 20px;
            }
			 table.pepe3{
                
                width: 70%;
                height:25%;
                
                *border-collapse: collapse; 
                border-spacing: 0;
                border:1px solid white;
                 -moz-border-radius: 20px 20px  20px 20px;
                border-radius: 20px 20px  20px 20px;
            } 
			
			 table.pepe4{
                
                width: 80%;
                height:25%;
                
                *border-collapse: collapse; 
                border-spacing: 0;
                border:1px solid white;
                 -moz-border-radius: 20px 20px  20px 20px;
                border-radius: 20px 20px  20px 20px;
            } 


	</style>
	<link rel="stylesheet" href="http://canterburyenglish.com/profesores/general/css/MenuMatic.css" type="text/css" media="screen" charset="utf-8"/>
   <!--[if lte IE 9]>
			<link rel="stylesheet" href="general_menu/vertical1/css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
		<![endif]-->
         <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
    
		<title>Canterbury Hourssss</title>
	</head>
	<body>
    
    
  <table width="100%" border="0" >
  <tr>
    <th colspan="3" scope="col" width="100%" bgcolor="#0033CC" class="noprint" class="noprint" align="right" height="30"> <div style="font-size:16px; color:#FFF; line-height: 16px" align="center"> Canterbury Intranet</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <font class="textW"><b>Welcome <font class="boldText"><?php echo $first;?></font></b>&nbsp;<br>
							Not <?php echo $first;?> <a href="/profesores/logout.php"><font class="boldText">Logout</font></a>&nbsp;&nbsp;
							</font></th>
  </tr>
  <tr>
    <td width="270px" class="noprint">   <?php
						if ($is_admin_a) {
						?>
              
                    
                      <div id="container" class="noprint"  >
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
           <!-- <li><a href="/profesores/calendar.php">My Calendar</a></li>-->
            <li><a href="/profesores/index.php" >My Hours</a></li>
          
			
           	<li class="noprint"><a href="#">Economics</a>
		
				<ul class="noprint">
					<li><a href="/profesores/admin/reports/billRcbd/demos1.php" >Emision Recibos</a></li>
					<li><a href="/profesores/admin/reports/billemtd/demos1.php" >Recepcion Recibos</a></li>
                    <li><a href="/profesores/admin/reports/viewbills/demos1.php" >Ver Emitidos</a></li>
					<li><a href="/profesores/admin/reports/paysheet/demos1.php" >Paysheet</a></li>
					<li><a href="/profesores/admin/reports2/teacher.php" >Bill report</a></li>
                    <li><a href="/profesores/admin/reports/companybills/demos1.php" >Facturas</a></li>
                    
						
		         </ul>
               </li>
			<li class="noprint"><a href="#">Admin</a>
				<ul class="noprint">
                
					<li><a href="/profesores/admin/search/searchTestclient.php" >Busqueda por Cliente</a></li>
					<li><a href="/profesores/admin/search/searchTest.php" >Busqueda por profesor</a></li>
					<li><a href="/profesores/admin/clients/index.php" >Client admin</a></li>
					<li><a href="/profesores/admin/users/index.php" >Teacher admin</a></li>
					<li><a href="/profesores/admin/calendar/holidays.php" >Classday admin</a></li>
                    <li><a href="/profesores/admin/prices/prices.php" >Price admin</a></li>
                    				
				</ul>
			</li>
		
			<li class="noprint"><a href="#">Signups</a>
				<ul class="noprint">
		
	<li><a href="/profesores/admin/Agenda/view.php"  >Pay Day Signups</a></li>
                    <li><a href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank">C. Club Trip Signup</a></li>
					<!-- <li><a href="http://www.canterburyenglish.com/profesores/admin/recursos/Useful_Teaching_Materials_Websites1.pdf"  >Library Signups</a></li>-->
					
					
				</ul>
			</li>
            
         <li><a href="http://192.168.1.111/"  target="_blank" >Virtual Library</a></li>
        <li><a href="/profesores/admin/estudiantes/busquedaReporteAlumno.php"  >Student Reports</a></li>
        <li><a href="/profesores/change_password.php">Change Password</a></li>
		<li><a href="/profesores/logout.php">Logout</a></li>
		
		</ul>
    </div>
             <!--[if lte IE 9]>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<![endif]-->
          <?php } else {	?> 
          
          
                    
                      <div id="container" class="noprint">
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
            <!-- <li><a href="/profesores/calendar.php">My Calendar</a></li>-->
            <li><a href="/profesores/index.php" >My Hours</a></li>
          
		<li><a href="#">Signups</a>
				<ul>
		<li><a href="/profesores/admin/Agenda/view.php"  >Pay Day Signups</a></li>
					<li><a href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank">C. Club Trip Signup</a></li>
					<!-- <li><a href="/profesores/admin/Library_Agenda/view.php"  >Library Signups</a></li>
					-->
					
				</ul>
			</li>
            
         <li><a href="http://teachingmaterials.no-ip.org/"  target="_blank" >Virtual Library</a></li>
        <li><a href="/profesores/admin/estudiantes/vistaReportesAlumnos.php"  >Student Reports</a></li>
        <li><a href="/profesores/change_password.php">Change Password</a></li>
		<li><a href="/profesores/logout.php">Logout</a></li>
		
		</ul>
    </div>
        <div id="content" class="noprint">
             <!--[if lte IE 9]>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<![endif]-->
          
          
                   <?php } ?> 	
                     <script src="http://www.google.com/jsapi"></script><script>google.load("mootools", "1.2.1");</script>	
	
	<script src="http://canterburyenglish.com/profesores/general/js/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript" >
		window.addEvent('domready', function() {			
			var myMenu = new MenuMatic({ orientation:'vertical',
										 physics: Fx.Transitions.Bounce.easeOut });			
		});		
	</script>

</div></td>
  




