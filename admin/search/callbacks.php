<?php include '../../includes/constants.php'?>
<?php include '../../includes/functions.php'?>
<?php include '../../includes/database.php'?>
<?php include '../../includes/authorize.php'?>
 

<html>
  <div>
  <?php require_once('includes/top.php');?>
  </div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">

var $j = jQuery.noConflict();
$j(document).ready(function() {

	//##### send add record Ajax request to response.php #########
	$j("#FormSubmit").click(function (e) {
			e.preventDefault();
			if($j("#my-select").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}		
			//ssalert(myData)
		 	var myData = 'my-select1='+ jQuery("#my-select").val(); //build a post data structure
			//alert(myData);
			$j.ajax({
			type: "POST", // HTTP method POST or GET
			url: "response.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				$j("#responds").empty();
				$j("#responds").append(response);
				//jQuery("#my-select").val(''); //empty text field on successful
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError+myData);
			}
			});
	});

		//##### Send delete Ajax request to response.php #########
	$j("body").on("click", "#responds .del_button", function(e) {
		 e.returnValue = false;
		 var clickedID = this.id.split('-'); //Split string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
			$j.ajax({
			type: "POST", // HTTP method POST or GET
			url: "response.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				$j('#item_'+DbNumberID).fadeOut("slow");
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
	});

});
</script>

<body>
    <div class="form_style">
      
  <head>
    <link href="css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    
    
  </head>

  <div class="content_wrapper" align="right">
<ul id="responds">

</ul>
</div>

  <div style="width:65%;">

      <select multiple="multiple" id="my-select" name="my-select1[]">
       <optgroup label='ZONES'>
       <option value="1.7N">7N (L7 North)</option>
        <option value="1.PC">PC (Plaza Castilla)</option>
        <option value="1.N">N (North)</option>
        <option value="1.4NE">4NE (L4 North East)</option>
        <option value="1.8E">8E (L8 East)</option>
        <option value="1.7E">7E (L7 East)</option>
        <option value="1.5E">5E (L5 East)</option>
        <option value="1.2E">2E (L2 East)</option>
        <option value="1.9E" selected="selected">9E (L9 East)</option>

        <option value="1.1S">1S (L1 South)</option>
        <option value="1.3S">3S (L3 South)</option>
        <option value="1.11">11 (L11)</option>
        <option value="1.SW">SW (South West)</option>
        <option value="1.SE">SE (South East)</option>
        <option value="1.CNE">CNE (Central North East)</option>
        <option value="1.CE">CE (Central East)</option>
        <option value="1.CSE">CSE (Central South East)</option>
        <option value="1.CS">CS (Central South)</option>

        <option value="1.CW">CW (Central West)</option>
        <option value="1.CN">CN (Central North)</option>
        <option value="1.12SE">12SE (L12 South East)</option>
        <option value="1.12SW">12SW (L12 South West)</option>
        <option value="1.ML2">ML2 (Metro Ligero 2)</option>
        <option value="1.ML3">ML3 (Metro Ligero 3)</option>
        <option value="1.A">A (Aravaca)</option>
        </optgroup>

  <optgroup label='Certification'>
    <option value='2.TE'>TE</option>
    <option value='2.CE-TEFL'>CE-TEFL</option>
    <option value='2.CELTA'>CELTA</option>
    <option value='2.TEFL'>TEFL</option>
    <option value='2.TESOL'>TESOL</option>
        </optgroup>
        
         <optgroup label='Class type'>
    <option value='3.Company'>Company</option>
    <option value='3.Kids'>Kids</option>
    <option value='3.Teenagers'>Teenagers</option>
    <option value='3.Adults'>Adults</option>
    </optgroup>
         <optgroup label='Gender'>
    <option value='4.Female'>Female</option>
    <option value='4.Male'>Male</option>
    </optgroup>
    
     <optgroup label='Availability'>
    <option value='5.Dec'>Dec</option>
    <option value='5.Feb'>Feb</option>
    <option value='5.May'>May</option>
    <option value='5.June'>June</option>
    <option value='5.July'>July</option>
    <option value='5.Aug'>Aug</option>
    </optgroup>
    
       <optgroup label='Spanish'>
    <option value='6.Low'>Low</option>
    <option value='6.Intermediate'>Intermediate</option>
    <option value='6.High'>High</option>
    <option value='6.Bilingual-Native'>Bilingual-Native</option>
    
    </optgroup>
    </select>
  
    
    <button id="FormSubmit">Add record</button>


    <script src="js/jquery.multi-select.js" type="text/javascript"></script>
   
    
         
           <script  type="text/javascript">
		 jQuery.noConflict();  
		
		(function($){
      jQuery('#my-select').multiSelect({ selectableOptgroup: true });
	})(jQuery);
    </script>

</div>


  </body>
  
</html>
<?php include 'includes/foot.php';?>