<?php
    include "objects.php";
	include "masterPage.php";
	
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	
	echo '<div id="poptrox">
			<h2>Секция рокли</h2>	
		</div>';
	
	$Nom->LoadNoms(dress, true);
	
	?><br class="clear" /><?
	$mp->footer();
 
?>