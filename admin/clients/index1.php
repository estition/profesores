<script type="text/javascript">
   	function sendEmails(contador){
	
 
if (typeof contador !== 'undefined' && contador !== null) {
	
	window.location="envioMassmail.php?identificador="+contador;

		
		} else  {
			alert("Select emails.");
		}
	}
</script>


<?php 
 $movies = array("Bloodsport", "Kickboxer", "Cyborg", "Timecop", "Universal Soldier", "In Hell", "The Quest");
?>


<form action="index1.php" name="edit_directory" id="edit_directory" method="post">
     
                      
                           
                             <input type="submit" name="Emailsubmit" id="Emailsubmit" value="emails"  onclick='sendEmails(<?php echo json_encode($movies); ?>);' />                
                           
    
    
    </form>