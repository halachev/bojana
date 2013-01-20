<?php
    include "objects.php";
	include "masterPage.php";
	
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	
	echo '<div id="poptrox">
			<h2>Най - новите</h2>	
		</div>';
		
	$Nom->LoadNoms(dress, false);
	?><br class="clear" /><?
	$mp->footer();
 
?>