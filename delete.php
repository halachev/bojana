<?php
    include "objects.php";
	include "masterPage.php";
	
	$detailID = $_GET['id'];
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	echo '<div id="poptrox">
			<h2>Артикула беше изтрит!</h2>	
		</div>';
	
	$Nom->Delete($detailID);	
	
	?>
	<br class="clear" />
					<script type="text/javascript">
						$('#gallery').poptrox();
						</script>
						
				

	<?
	
	
	$mp->footer();
 
?>