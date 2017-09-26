    <tr>
				<td width="150px">
                <table cellpadding="0" cellspacing="0" height="500" width="150px" valign="top"  >
                    <tr><td width="150px" >
	
	<?php
						if ($is_admin_a) {
						?>
   <div id="container" >
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
            <li><a href="/profesores/calendar.php">My Calendar</a></li>
            <li><a href="/profesores/index.php" >My Hours</a></li>
          
			
           	<li><a href="#">Economics</a>
		
				<ul>
					<li><a href="/profesores/admin/reports/billRcbd/demos1.php" >Bill's emision </a></li>
					<li><a href="/profesores/admin/reports/billemtd/demos1.php" >Emitted bills</a></li>
					<li><a href="/profesores/admin/reports/teacher.php" >Paysheet</a></li>
					<li><a href="/profesores/admin/reports2/teacher.php" >Bill report</a></li>
						
		         </ul>
               </li>
			<li><a href="#">Admin</a>
				<ul>
					<li><a href="/profesores/admin/clients/index.php" >Client admin</a></li>
					<li><a href="/profesores/admin/users/index.php" >User admin</a></li>
					<li><a href="/profesores/admin/calendar/holidays.php" >Classday admin</a></li>
                    <li><a href="/profesores/admin/prices/prices.php" >Price admin</a></li>
                    				
				</ul>
			</li>
		
			<li><a href="#">Signups</a>
				<ul>
		
					<li><a href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank">C. Club Trip Signup</a></li>
					<li><a href="/profesores/admin/Library_Agenda/view.php"  >Library Signups</a></li>
					<li><a href="/profesores/admin/Agenda/view.php"  >Pay Day Signups</a></li>
					
				</ul>
			</li>
            
         <li><a href="/profesores/admin/recursos/Useful_Teaching_Materials_Websites1.pdf"  target="_blank" >Virtual Library</a></li>
        <li><a href="/profesores/admin/estudiantes/busquedaReporteAlumno.php"  >Student Reports</a></li>
        <li><a href="/profesores/change_password.php">Change Password</a></li>
		<li><a href="/profesores/logout.php">Logout</a></li>
		
		</ul>
	
		<!-- END Menu -->
	
    </div>
	
	
	<!-- Load the Mootools Framework -->

		<?php } else {?>  
         <div id="container" >
   		
   			    
		<!-- BEGIN Menu -->
	    <ul id="nav">
            <li><a href="/profesores/calendar.php" >My Calendar</a></li>
            <li><a href="/profesores/index.php" >My Hours</a></li>
          
			
           
		
			<li><a href="#">Signups</a>
				<ul>
		
					<li><a href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank">C. Club Trip Signup</a></li>
					<li><a href="/profesores/admin/Library_Agenda/view.php"  >Library Signups</a></li>
					<li><a href="/profesores/admin/Agenda/view.php"  >Pay Day Signups</a></li>
					
				</ul>
			</li>
            
         <li><a href="/profesores/admin/recursos/Useful_Teaching_Materials_Websites1.pdf"  target="_blank">Virtual Library</a></li>
        <li><a href="/profesores/admin/estudiantes/vistaReportesAlumnos.php"  target="_blank">Student Reports</a></li>
        <li><a href="/profesores/change_password.php">Change Password</a></li>
		<li><a href="/profesores/logout.php">Logout</a></li>
		
		</ul>
	
		<!-- END Menu -->
	
    </div>
	
        
         <?php }?>
         </td></tr>
                        
                        	
					</table>
				</td>
				<td width="0px" >
				</td>
				<td valign="top">
