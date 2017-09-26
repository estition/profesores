
     <link rel="stylesheet" href="http://canterburyenglish.com/profesores/general/css/style.css" type="text/css" media="all" charset="utf-8"/>
	<link rel="stylesheet" href="http://canterburyenglish.com/profesores/general/css/MenuMatic.css" type="text/css" media="screen" charset="utf-8"/>
   <!--[if lte IE 9]>
			<link rel="stylesheet" href="general_menu/vertical1/css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
		<![endif]-->
        
<link href="http://canterburyenglish.com/profesores/includes/css/canterbury.css" type="text/css" rel="stylesheet">

                <?php
						if ($is_admin_a) {
						?>
                <table cellpadding="0" cellspacing="0" height="500" width="150px" valign="top"  >
                    <tr><td width="150px" >
                    
                      <div id="container" >
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
            <li><a href="/profesores/calendar.php">My Calendar</a></li>
            <li><a href="/profesores/index.php" >My Hours</a></li>
          
			
           	<li><a href="#">Economics</a>
		
				<ul>
					<li><a href="/profesores/admin/reports/billRcbd/demos1.php" >Emision Recibos</a></li>
					<li><a href="/profesores/admin/reports/billemtd/demos1.php" >Recepcion Recibos</a></li>
                    <li><a href="/profesores/admin/reports/viewbills/demos1.php" >Ver Emitidos</a></li>
					<li><a href="/profesores/admin/reports/paysheet/demos1.php" >Paysheet</a></li>
					<li><a href="/profesores/admin/reports2/teacher.php" >Bill report</a></li>
						
		         </ul>
               </li>
			<li><a href="#">Admin</a>
				<ul>
					<li><a href="/profesores/admin/clients/index.php" >Client admin</a></li>
					<li><a href="/profesores/admin/users/index.php" >Teacher admin</a></li>
					<li><a href="/profesores/admin/calendar/holidays.php" >Classday admin</a></li>
                    <li><a href="/profesores/admin/prices/prices.php" >Price admin</a></li>
                    				
				</ul>
			</li>
		
			<li><a href="#">Signups</a>
				<ul>
		
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
    
        <div id="content">
             <!--[if lte IE 9]>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<![endif]-->
          <?php } else {	?> 
          
          
          <table cellpadding="0" cellspacing="0" height="500" width="150px" valign="top"  >
                    <tr><td width="150px" >
                    
                      <div id="container" >
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
            <li><a href="/profesores/calendar.php">My Calendar</a></li>
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
    
        <div id="content">
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
</div>
</div>
</td></tr>
                        
                        	
					</table>
				

	
