<?php
    include "objects.php";
	include "masterPage.php";
	
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	echo '<div id="poptrox">
			<h2>Секция обувки</h2>	
		</div>';
	$Nom->LoadNoms(obuvki, true);
	
	
	$mp->footer();
 
?>