<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="../../../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Seguimiento</div>
    <div class="AccordionPanelContent">  <fieldset>
  <span id="sprytextarea1">
  
   <label><span class="style9">Seguimiento:<span id="countdown002"></span><div class="textareaRequiredMsg"><font size="2">Required</font></div></span>
   <textarea name="Seguimiento" id="Seguimiento" cols="35" rows="5"  onKeyDown="limitText(this.form.Seguimiento,'countdown002',200);" 
onKeyUp="limitText(this.form.Seguimiento,'countdown002',200);"><?php echo  $Seguimiento;?></textarea>
   </label>
  </span><br />
   <span id="sprytextarea0">
  
  <label><span class="style9">Objetivos:<span id="countdown001"></span>
  <div class="textareaRequiredMsg"><font size="2">Required</font></div></span>
  <textarea name="Objetivos" id="Objetivos" cols="35" rows="5" onKeyDown="limitText(this.form.Objetivos,'countdown001',200);" 
onKeyUp="limitText(this.form.Objetivos,'countdown001',200);"><?php echo  $Objetivos;?></textarea>
  </label>
  </span>
  </fieldset></div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Preferencia</div>
    <div class="AccordionPanelContent"><fieldset>
 <label><span class="style7 style9 style6">Niño?</span>
 
 <input name="nino" type="checkbox" checked="checked" /> </label> 
 
 <label><span class="style7 style9 style6">USA</span>
 
 <input name="contry" type="radio" value="USA" /> 
 </label>
 
 <label><span class="style7 style9 style6">UK</span>
 
 <input name="contry" type="radio" value="UK" /> 
 </label>
 
 <label><span class="style7 style9 style6">H</span>
 
 <input name="gender" type="radio" value="H"/> 
 </label>  
 
 <label><span class="style7 style9 style6">M</span>
 
 <input name="gender" type="radio" value="M"/> 
 </label>
 
 <br />
 <br />
 <span id="spryselect0">
 <label><span class="style7 style9 style6">Nivel</span>
 <select name="nivel" size="1" id="nivel" accesskey="L" tabindex="0">
   <option value="">---</option>
   <option value="False Beginner">False Beginner</option>
   <option value="Elementary Upper">Elementary Upper</option>
   <option value="Elementary">Elementary</option>
   <option value="Lower Intermediate">Lower Intermediate</option>
   <option value="Intermediate">Intermediate</option>
   <option value="Upper Intermediate">Upper Intermediate</option>
   <option value="Advanced Level 1">Advanced Level 1</option>
   <option value="Advanced Level 2">Advanced Level 2</option>
   <option value="Advanced Level 3">Advanced Level 3</option>
 </select>
 </label>
 <span class="selectRequiredMsg"><font size="2">Required</font></span></span>  
 <br />
 <br />
 <span id="sprytextarea2">
   
   <label><span class="style9">Preferencia:<span id="countdown003"></span>
   <div class="textareaRequiredMsg"><font size="2">Required</font></div>
   </span>
   <textarea name="Preferencia" id="Preferencia" cols="35" rows="5"  
   onKeyDown="limitText(this.form.Preferencia,'countdown003',200);" 
onKeyUp="limitText(this.form.Preferencia,'countdown003',200);"><?php echo  $Preferencia;?></textarea>
   </label>
   </span>
   </fieldset></td>
  </tr>
  <tr>
    <td>Precio informado:  </td>
    <td><span id="sprytextfield01">
   
   <label><span class="style10">
  </span>
   <input name="price" type="text" id="price" size="35" maxlength="20" value="<?php echo  $price;?>" />
   </label>
  <span class="textfieldRequiredMsg"><font size="2">Required</font></span></span></div>
  </div>
</div>

<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
</html>
