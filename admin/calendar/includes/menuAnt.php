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
						<tr><a href="/profesores/index.php"><td class="menuText" bgcolor="#<?php echo isSelected("main", $page_name);?>" style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("main", $page_name);?>'">- My Hours</td></a></tr>
						
						<?php
						if ($is_admin_a) {
						?>
						<tr><a href="/profesores/admin/reports/teacher.php"><td class="menuText" bgcolor="#<?php echo isSelected("paysheet", $page_name);?>" style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("paysheet", $page_name);?>'">- Paysheet</td></a></tr>
						<tr><a href="/profesores/admin/reports/client.php"><td class="menuText" bgcolor="#<?php echo isSelected("client report", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("client report", $page_name);?>'">- Client report</td></a></tr>
						<tr><a href="/profesores/admin/prices/prices.php"><td class="menuText" bgcolor="#<?php echo isSelected("prices", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("prices", $page_name);?>'">- Price admin</td></a></tr>
						<tr><a href="/profesores/admin/users/index.php"><td class="menuText" bgcolor="#<?php echo isSelected("user admin", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("user admin", $page_name);?>'">- User admin</td></a></tr>
						<tr><a href="/profesores/admin/clients/index.php"><td class="menuText" bgcolor="#<?php echo isSelected("client admin", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("client admin", $page_name);?>'">- Client admin</td></a></tr>
						<tr><a href="/profesores/admin/calendar/holidays.php"><td class="menuText" bgcolor="#<?php echo isSelected("classday", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("classday", $page_name);?>'">- Classday admin</td></a></tr>
						<tr><a href="/profesores/admin/import/import.php"><td class="menuText" bgcolor="#<?php echo isSelected("import", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("import", $page_name);?>'">- Import</td></a></tr>
						<tr><a href="/profesores/admin/reports2/teacher.php"><td class="menuText" bgcolor="#<?php echo isSelected("paysheet2", $page_name);?>"  style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("paysheet2", $page_name);?>'">- Bill report</td></a></tr>

						
						<?php } ?>
						<tr><a href="/profesores/change_password.php"><td class="menuText"  bgcolor="#<?php echo isSelected("change password", $page_name);?>" style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("change password", $page_name);?>'">- Change Password</td></a></tr>
						<tr><a href="/profesores/logout.php"><td class="menuText"  bgcolor="#<?php echo isSelected("logout", $page_name);?>" style="cursor: hand" onMouseOver="javascript:this.style.background='#738FE6'" onMouseOut="javascript:this.style.background='#<?php echo isSelected("logout", $page_name);?>'">- Logout</td></a></tr>
					</table>
				</td>
				<td width="1px" bgcolor="#172244">
				</td>
				<td valign="top">