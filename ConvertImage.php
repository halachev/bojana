<?php
  define( 'UPLOADED_IMAGE_DESTINATION', 'thumbnails/temp/');
  define( 'THUMBNAIL_IMAGE_DESTINATION', 'thumbnails/');

  function generate_image_thumbnail( $source_image_path, $thumbnail_image_path, $max_width, $max_height)
  {

    list($width,$height)=getimagesize($source_image_path);

    if (($width == 0) && ($height == 0))
      return false;
    else
    {
      $src = imagecreatefromjpeg($source_image_path);

      $x_ratio = $max_width / $width;
      $y_ratio = $max_height / $height;

      if( ($width <= $max_width) && ($height <= $max_height) ){
        $tn_width = $width;
        $tn_height = $height;
      }
      else
      if (($x_ratio * $height) < $max_height){
	$tn_height = $max_height;//ceil($x_ratio * $height);
	$tn_width = $max_width;
      }
      else
      {
	$tn_width = ceil($y_ratio * $width);
	$tn_height = $max_height;
      }

      $tmp=imagecreatetruecolor($tn_width,$tn_height);
      imagecopyresampled($tmp,$src,0,0,0,0,$tn_width, $tn_height,$width,$height);

      imagejpeg($tmp,$thumbnail_image_path,100);
      imagedestroy($src);
      imagedestroy($tmp);

      return true;

    }

  }

//--------------------------------
// FILE PROCESSING FUNCTION
//--------------------------------

  function process_image_upload($field, $max_width, $max_height)
  {

    $temp_image_path = $_FILES[$field]['tmp_name'];
    $temp_image_name = $_FILES[$field]['name'];

    if ($_FILES['imagefile']['size'] > 999999)
    {
      echo "<script language=javascript>alert('Снимката не може да бъде качена.Размера е твърде голям!')</script>";
      echo '<META HTTP-EQUIV="Refresh" CONTENT="0; register.php?UOK =1">';
      exit;
    }

    $uploaded_image_path = UPLOADED_IMAGE_DESTINATION.$temp_image_name;

    move_uploaded_file( $temp_image_path, $uploaded_image_path );

    $thumbnail_image_path = THUMBNAIL_IMAGE_DESTINATION . preg_replace( '{\\.[^\\.]+$}', '.jpg', $temp_image_name );

    $result = generate_image_thumbnail( $uploaded_image_path, $thumbnail_image_path, $max_width, $max_height );

    unlink($uploaded_image_path);

    return $result ? array( $uploaded_image_path, $thumbnail_image_path ) : false;
  }
?>
