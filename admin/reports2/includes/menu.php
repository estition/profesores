			<?php
			
			function isSelected($thename, $page_name) {
				
				if ($thename == $page_name) {
					return "738FE6";
				} else {
					return "B6C5F2";
				}
			}
			
								
			?>
			
			<tr>
				<td height="500" bgcolor="B6C5F2" width="130px" valign="top" >
					<table cellpadding="5" cellspacing="0" border="0" width="100%" >
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("main", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("main", $page_name);?>'"><a href="/profesores/index.php">- My Hours</a></td></tr>                        
						
						<?php
						if ($is_admin_a) {
						?>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("paysheet", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("paysheet", $page_name);?>'"><a href="/profesores/admin/reports/teacher.php">- Paysheet</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("client report", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("client report", $page_name);?>'"><a href="/profesores/admin/reports/client.php">- Client report</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("prices", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("prices", $page_name);?>'"><a href="/profesores/admin/prices/prices.php">- Price admin</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("user admin", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("user admin", $page_name);?>'"><a href="/profesores/admin/users/index.php">- User admin</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("client admin", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("client admin", $page_name);?>'"><a href="/profesores/admin/clients/index.php">- Client admin</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("classday", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("classday", $page_name);?>'"><a href="/profesores/admin/calendar/holidays.php">- Classday admin</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("import", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("import", $page_name);?>'"><a href="/profesores/admin/import/import.php">- Import</a></td></tr>
						<tr><td class="menuText" bgcolor="#<?php echo isSelected("paysheet2", $page_name);?>"  style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("paysheet2", $page_name);?>'"><a href="/profesores/admin/reports2/teacher.php">- Bill report</a></td></tr>
                       
						<?php } ?>
                        
                        
						<?php if ($is_admin_a) {	?>
                        <tr><td class="menuText"  bgcolor="#<?php echo isSelected("student report", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("student report", $page_name);?>'"><a href="/profesores/admin/estudiantes/busquedaReporteAlumno.php">- Student Reports</a></td></tr>
                        <?php } else {	?> 
                        <tr><td class="menuText"  bgcolor="#<?php echo isSelected("student report", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("student report", $page_name);?>'"><a href="/profesores/admin/estudiantes/vistaReportesAlumnos.php">- Student Reports</a></td></tr>                        
                        <?php } ?> 	
                        
                          		<tr><td class="menuText"  bgcolor="#<?php echo isSelected("Club", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("Club", $page_name);?>'"><a href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank">- C. Club Trip Signup</a></td></tr>
                        
                              
                       <tr><td class="menuText"  bgcolor="#<?php echo isSelected("library1", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("library1", $page_name);?>'"><a href="/profesores/admin/recursos/Useful_Teaching_Materials_Websites1.pdf" target="_blank">- Virtual Library</a></td></tr>

		       <tr><td class="menuText"  bgcolor="#<?php echo isSelected("library1", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("library1", $page_name);?>'"><a href="/profesores/admin/Library_Agenda/view.php">- Library Signups</a></td></tr>
                        
                       

			                        				
			<tr><td class="menuText"  bgcolor="#<?php echo isSelected("change password", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("change password", $page_name);?>'"><a href="/profesores/change_password.php">- Change Password</a></td></tr>	

			<tr><td class="menuText"  bgcolor="#<?php echo isSelected("library1", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("library1", $page_name);?>'"><a href="/profesores/admin/Agenda/view.php">- Pay Day Signups</a></td></tr>					
						
                        <tr><td class="menuText"  bgcolor="#<?php echo isSelected("logout", $page_name);?>" style="cursor:pointer" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("logout", $page_name);?>'"><a href="/profesores/logout.php">- Logout</a></td></tr>
                        
                        	
					</table>
				</td>
				<td width="1px" bgcolor="#172244">
				</td>
				<td valign="top">