<?php
    include "objects.php";
	include "masterPage.php";
	
	$detailID = $_GET['id'];
	
	$mp = new masterPage();
	
	$mp->header();
	$Nom = new TNom();
	echo '<div id="poptrox">
			<h2>�������</h2>	
		</div>';
		
	$Nom->GetnomByID($detailID);

	
	?>
	<br class="clear" />
					<script type="text/javascript">
						$('#gallery').poptrox();
						</script>
						
				

	<?
	
	echo '<div id="RequestBuuton"><a href="request.php?id='.$detailID.'">�������</a></div>';
	
	if ($Nom->SessionID)
	{
		echo '<div id="RequestBuuton"><a href="#canEditPost" data-identity='.$detailID.'>�������� |</a>
		<a href="#canDeletePost" data-identity='.$detailID.'>������</a>
		';
					
	}				
	
	$mp->footer();
 
?>