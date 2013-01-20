<?php
    include "objects.php";
	include "masterPage.php";
	
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	echo '<div id="poptrox">
			<h2>Секция аксесоари</h2>	
		</div>';
	$Nom->LoadNoms(aksesoari, true);

	?><br class="clear" /><?
	$mp->footer();
 
?>