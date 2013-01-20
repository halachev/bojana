<?php
	
    include "objects.php";
	include "masterPage.php";
	
	$mp = new masterPage();	
	$mp->header();

	$session = new TSession();	
	$loginID = $_SESSION["LoginID"];

	if ($loginID)
	{
	  $editedID = $_GET["editedID"];	
	  if ($editedID)
		$session->Edit($editedID);
	  else
		$session->Administration();
	}
	else
	  $session->Login();
	  
	?><br class="clear" /><?
	$mp->footer();
 
?>