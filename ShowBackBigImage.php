<?php
if(isset($_REQUEST['id']))
{
  session_start();
  include "connect.php";
  $id = $_REQUEST ['id'];
  $query = "SELECT back_image FROM articles WHERE id = '$id'";
  $result = mysql_query($query) or die(mysql_error());
  list($image) = mysql_fetch_array($result);
  header('Content-Type: image/jpeg');
  echo $image;

}

?>
