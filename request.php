<?php
    include "objects.php";
	include "masterPage.php";
	
	$detailID = $_GET['id'];
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	$nom = $Nom->GetnomByID($detailID);
	echo '<div id="poptrox">
			<h2>Заявка за артикул - '.$nom->name.'</h2>				
			<input type="hidden" name="detailID" id="detailID" value='.$detailID.' />
					 
			<div id="poptrox">			
			<form name= "post">    
			<table width="50%" cellspacing="2" cellpadding="2">
				<tr><td>Вашето име*: </td><td><input type="text" name="requestName" id="requestName" /></td></tr>
							
				<tr><td>Вашите мерки*: </td><td><textarea name="requestDescr" id="requestDescr" rows="5" cols="40"></textarea></td></tr>
				<tr><td>Email: </td><td><input type="text" name="requestEmail" id="requestEmail" /></td></tr>
				<tr><td>Тел за връзка*: </td><td><input type="text" name="requestPhone" id="requestPhone" /></td></tr>	
				<tr><td></td><td><input type="button" name="addRequest" id="addRequest" value="Изпрати"/></td></tr>				
			
			</table>
			</form>
		  </div>
										
		</div>';
	
	?>
	<br class="clear" />
	<script type="text/javascript">
		$('#gallery').poptrox();
	</script>
						
			
	<?
	
	
	$mp->footer();
 
?>