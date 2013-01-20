<?php
    include "objects.php";
	include "masterPage.php";
	
	$detailID = $_GET['id'];
	$requestName = $_GET['requestName'];
	$requestDescr = $_GET['requestDescr'];
	$requestEmail = $_GET['requestEmail'];
	$requestPhone = $_GET['requestPhone'];
	
	$mp = new masterPage();
	
	$mp->header();
	$Request = new TRequest();
	$Request->makeRequest($detailID, $requestName, $requestDescr, $requestEmail, $requestPhone);
	
	echo '<div id="poptrox">
			<p>Благодарим Ви до няколко часа ще се свържем с вас за потвърждаване на поръчката.</p>	
		</div>';
	
	
	?>
	<br class="clear" />
	<script type="text/javascript">
		$('#gallery').poptrox();
	</script>
						
			
	<?
	
	
	$mp->footer();
 
?>