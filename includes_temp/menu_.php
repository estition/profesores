<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script>
if (!document.layers)
document.write('<div id="divStayTopLeft" style="position:absolute">')


</script>

<layer id="divStayTopLeft">
<script type="text/javascript" charset="utf-8">
$(function(){
	$('#menu li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#menu ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>
	
<style type="text/css" media="screen">
		#menu{
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			border-radius:5px;
			-webkit-box-shadow:1px 1px 3px #888;
			-moz-box-shadow:1px 1px 3px #888;
		}
		#menu li.lista{border-bottom:1px solid #FFF;}
		#menu ul li.lista, #menu li.lista:last-child{border:none}	
		a.button{
			display:block;
			color:#FFF;
			text-decoration:none;
			font-family:'Helvetica', Arial, sans-serif;
			font-size:13px;
			padding:3px 5px;
			text-shadow:1px 1px 1px #325179;
		}
		#menu a.button:hover{
			color:#F9B855;
			-webkit-transition: color 0.2s linear;
		}
		#menu ul a.button{background-color:#6594D1;}
		#menu ul a.button:hover{
			background-color:#FFF;
			color:#2961A9;
			text-shadow:none;
			-webkit-transition: color, background-color 0.2s linear;
		}
		ul.lista{
			display:block;
			background-color:#2961A9;
			margin:0;
			padding:0;
			width:130px;
			list-style:none;
		}
		#menu ul.lista{background-color:#6594D1;}
		#menu li.lista ul.lista {display:none;}
	</style>	

    <body>
    <table cellpadding="0" cellspacing="0" align="left"  valign="top"  >
                    <tr><td valign="top" >

  <?php
						if ($is_admin_a) {
						?>
                
                    
                    
                    <ul class="lista" id="menu">
                    <li class="lista"><a class="button" href="/profesores/index.php"> My Hours<span></span></a></li>

<li class="lista"><a  class="button" href="#">Economics</a>
	<ul class="lista">
    
					<li class="lista"><a  class="button" href="/profesores/admin/reports/billRcbd/demos1.php" >Emision Recibos</a></li>
					<li class="lista"><a   class="button" href="/profesores/admin/reports/billemtd/demos1.php" >Recepcion Recibos</a></li>
                    <li class="lista"><a   class="button" href="/profesores/admin/reports/viewbills/demos1.php" >Ver Emitidos</a></li>
					<li class="lista"><a   class="button" href="/profesores/admin/reports/paysheet/demos1.php" >Paysheet</a></li>
					<li class="lista"><a   class="button" href="/profesores/admin/reports2/teacher.php" >Bill report</a></li>
                    <li class="lista"><a   class="button" href="/profesores/admin/reports/companybills/demos1.php" >Facturas</a></li>
	</ul>
</li>
<li class="lista"><a  class="button" href="#">Admin</a>
	<ul class="lista">
					<li class="lista"><a   class="button" href="/profesores/admin/clients/index.php" >Client admin</a></li>
					<li class="lista"><a   class="button" href="/profesores/admin/users/index.php" >Teacher admin</a></li>
					<li class="lista"><a   class="button" href="/profesores/admin/calendar/holidays.php" >Classday admin</a></li>
                    <li class="lista"><a   class="button" href="/profesores/admin/prices/prices.php" >Price admin</a></li>
	</ul>
</li>
<li class="lista"><a   class="button" href="#">Signups</a>
	<ul class="lista">
		<li class="lista"><a   class="button" href="/profesores/admin/Agenda/view.php" >Pay Day Signups</a></li>
<li class="lista"><a   class="button" href="https://spreadsheets.google.com/viewform?hl=en&formkey=dDZFNG5RZDcwSVBIVW9aaks2b29RWkE6MQ#gid=0" target="_blank" >Trip Signup</a></li>
	</ul>
</li>
   
<li class="lista"><a   class="button" href="#">Resources</a>
	<ul class="lista">
	 <li class="lista"><a   class="button" href="http://192.168.1.111/"  target="_blank" >Virtual Library</a></li>
       <li class="lista"><a   class="button" href="/profesores/admin/estudiantes/busquedaReporteAlumno.php"  >Student Reports</a></li>
       <li class="lista"><a   class="button" href="/profesores/change_password.php">Change Password</a></li>
	</ul>
</li>                 
       <li class="lista"><a   class="button" href="/profesores/logout.php">Logout</a></li>

        
        </ul>
         <?php } else {	?> 
          
 <ul class="lista" id="menu">
                    <li class="lista"><a class="button" href="/profesores/index.php"> My Hours</a></li>
            
           <li class="lista"><a class="button" href="/profesores/admin/Agenda/view.php">Signups</a></li>
        
        
            <li class="lista"><a   class="button" href="#">Resources</a>
		<ul class="lista">
	  <li class="lista"><a   class="button" href="http://teachingmaterials.no-ip.org/"  target="_blank" >Virtual Library</a></li class="lista">
        <li class="lista"><a   class="button" href="/profesores/admin/estudiantes/vistaReportesAlumnos.php"  >Student Reports</a></li>
        <li class="lista"><a   class="button" href="/profesores/change_password.php">Change Password</a></li>
	</ul>
</li>                 
       <li class="lista"><a   class="button" href="/profesores/logout.php">Logout</a></li>

      
          </ul>

       


          
                   <?php } ?> 	

     
    </td></tr>
                        
                        	
					</table>
               </body>     
                     </div></div>
<!--END OF EDIT-->

</layer>


<script type="text/javascript">

/*
Floating Menu script-  Roy Whittle (http://www.javascript-fx.com/)
Script featured on/available at http://www.dynamicdrive.com/
This notice must stay intact for use
*/

//Enter "frombottom" or "fromtop"
var verticalpos="frombottom"

if (!document.layers)
document.write('</div>')

function JSFX_FloatTopDiv()
{
	var startX = -60,
	startY = 556;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function()
	{
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : document.body.scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		ftlObj.y += (pY - startY - ftlObj.y)/8;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 10);
	}
	ftlObj = ml("divStayTopLeft");
	stayTopLeft();
}
JSFX_FloatTopDiv();
</script>

        
