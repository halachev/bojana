<?php
    include "objects.php";
	include "masterPage.php";
	
	$searchKey = $_GET['search'];
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	echo '<div id="poptrox">
			<h2>���������</h2>	
		</div>';
		
	$Nom->Search($searchKey);

	$mp->footer();
 
?>