<!DOCTYPE hmtl>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Boni Style</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="jquery.poptrox-0.1.js"></script>
<script type="text/javascript" src="boniStyle.js"></script>
</head>
<body>


<?
  include "connect.php";   
  include "ConvertImage.php";   
  include "class.phpmailer.php";
  session_start();
	  

  define ('dress', 1);  
  define ('banski', 2);
  define ('obuvki', 3);
  define ('aksesoari', 4); 
	  
  class TNom extends TSession
  {
    public $id;
	public $number;
	public $name;
	public $categoryID;
	public $decsr;
	public $color;
	public $price;
	public $front_image;
	public $front_thumbnail;
	public $back_image;
	public $back_thumbnail;
	
	public function __Construct()
	{
	   parent::__construct();
	 	 
	}
	
	function GetNewNumber()
	{
		$sqltext = "select max(number) as number from articles";
	    $query = mysql_query($sqltext);
		$query = mysql_fetch_array($query);
		$number = $query['number'] + 1;	
		return $number;
	}
		
	function Add()
	{	
		
		$number = $this->GetNewNumber();
		
        $query = "INSERT INTO articles (number, name, category, descr, color, price, front_image, front_thumbnail, back_image, back_thumbnail)
		VALUES ('$number', '$this->name', '$this->categoryID', '$this->descr', '$this->color', '$this->price', 
		'$this->front_image', '$this->front_thumbnail', '$this->back_image', '$this->back_thumbnail')"; 

		
	    $insert = mysql_query($query);
	    if (!$insert)
	     die("Възникна проблем опитайте пак или ни пишете : ".mysql_error());
		
	    echo '<div id="poptrox">
		<h2>Артикула беше добавен!</h2>
		</div>';	
	}
	
	function Update()
	{
	  $query = "update articles set 
		name='$this->name', category='$this->categoryID', 
		descr='$this->descr', color='$this->color', price='$this->price' where id='$this->id'";
		
		
	  $query = mysql_query($query);
	   if (!$query)
	     die("Възникна проблем опитайте пак или ни пишете : ".mysql_error());
		 
	   echo '<META HTTP-EQUIV="Refresh" CONTENT="0; detail.php?id='.$this->id.'">';
	 
	}
	
	function Search($searchKey)
	{
	
		$query = mysql_query("SELECT * FROM articles WHERE (name LIKE '$searchKey%') or (number = '$searchKey')");
		    			
		echo ' <div id="poptrox"><ul id="gallery">';
		
		while ($row = mysql_fetch_array($query))
		{
		
		  if ($row['front_image'] != "")
		  {	
		    $len = strlen($row['name']);
					
		    if ($len > 12)
				$name = substr($row['name'], 0, 12) . "...";
			else
			  $name = $row['name'];
			  
		    echo '<li>'.$name.'<br/><a href=detail.php?id='.$row['id'].'><img src=ShowFrontImage.php?id='.$row['id'].' />
			</a><br/><a href="detail.php?id='.$row['id'].'">Детайли</a></li>';			
	      }
		  
		}
		
		echo ' </ul></div>';
	
	}
	
	function LoadNoms($category, $limit = false)
	{
	    if ($limit)
			$query = mysql_query("SELECT * FROM articles where category = $category GROUP by id ORDER BY id DESC ");
		else
		    $query = mysql_query("SELECT * FROM articles where category = $category GROUP by id ORDER BY id DESC LIMIT 6");
		    
			
		echo ' <div id="poptrox"><ul id="gallery">';
		
		while ($row = mysql_fetch_array($query))
		{
		
		  if ($row['front_image'] != "")
		  {	
		    $len = strlen($row['name']);
					
		    if ($len > 12)
				$name = substr($row['name'], 0, 12) . "...";
			else
			  $name = $row['name'];
			  
			$spanFrontImage = '<span><img src=ShowFrontBigImage.php?id='.$row[id].' width="180"></span>';   
			  
		    echo '<li>'.$name.'<br/><a class="thumbnail" href=detail.php?id='.$row['id'].'><img src=ShowFrontImage.php?id='.$row['id'].'/>
			'.$spanFrontImage.'			
			</a><br/><a href="detail.php?id='.$row['id'].'">Детайли</a></li>';			
	      }
		  
		}
		
		echo ' </ul></div>';
	
	}
		
	function GetNomByID($detailID)
	{
		
		$query = mysql_query("SELECT * FROM articles where id = $detailID");
		    		
     
		echo '<div id="poptrox"><ul id="gallery">';
		
		while ($row = mysql_fetch_array($query))
		{
		
		  if ($row['front_image'] != "")
		  {		
		    $this->id = $row['id'];
			$this->number = $row['number'];
			$this->categoryID = $row['category'];
			$this->name = $row['name'];
			$this->descr = $row['descr'];
			$this->color = $row['color'];
			$this->price = $row['price'];
			
			$price = number_format($row['price']);
				
	
				
			$spanFrontImage = '<span><img src=ShowFrontBigImage.php?id='.$row[id].' width="180"></span>';   
			$spanBackImage = '<span><img src=ShowBackBigImage.php?id='.$row[id].' width="180"></span>';   
			
			$front_image = '<a class="thumbnail" href=ShowFrontBigImage.php?id='.$row['id'].'>'.$spanFrontImage.'
			<img src=ShowFrontImage.php?id='.$row['id'].' />
			</a>';
			
			if ($row['back_image'])
			{
				$back_image = '
				<a class="thumbnail"  href=ShowBackBigImage.php?id='.$row['id'].'>'.$spanBackImage.'
				<img src=ShowBackImage.php?id='.$row['id'].' />
				</a>	
				';
			}
			
		    echo '<li>'.$row[name].'<br/>			
			'.$front_image.'
			'.$back_image.'
			<br/>
			Номер: '.$row[number].' <br/>
			Опсание: '.$row[descr].'<br/>
			Цвят: '.$row[color].'<br/>
			Цена: '.$price.' лв.<br/>			
			</li>';		
	
	      }
		  
				 
		}
		
		echo ' </ul></div>';
	
		
		return $this;
	
	}
	
	function PublicateFrontImage()
	{
		if (empty($_FILES["ufront_file"]["tmp_name"]))
		{
			$this->front_image = file_get_contents("images/unavailable.gif");
			$this->front_image = mysql_real_escape_string($this->front_image);
			$this->front_thumbnail =  file_get_contents("images/unavailable.gif");
			$this->front_thumbnail =  mysql_real_escape_string($this->front_thumbnail);
		}
		else
		{
		    
			$this->front_image = file_get_contents($_FILES["ufront_file"]["tmp_name"]);
			$this->front_image = mysql_real_escape_string($this->front_image);

			$result = process_image_upload("ufront_file", 210, 120);

			if (!$result)
			{
				echo "<script language=javascript>alert('Снимката не може да бъде качена.Не отговаря на изискваните параметри!')</script>";
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; admin.php">';
				exit;
			}
			else if ($result)
			{
				$this->front_thumbnail = '';
				$ResizeFile = THUMBNAIL_IMAGE_DESTINATION;
				$ResizeFile .= $_FILES['ufront_file']['name'];
				$this->front_thumbnail = file_get_contents($ResizeFile);
				$this->front_thumbnail = mysql_real_escape_string($this->front_thumbnail);
				unlink($ResizeFile);
			}
		}	
	}
		
	function PublicateBackImage()
	{
		if (empty($_FILES["uback_file"]["tmp_name"]))
		{
			return;
		}
		else
		{
		    
			$this->back_image = file_get_contents($_FILES["uback_file"]["tmp_name"]);
			$this->back_image = mysql_real_escape_string($this->back_image);

			$result = process_image_upload("uback_file", 210, 120);

			if (!$result)
			{
				echo "<script language=javascript>alert('Снимката не може да бъде качена.Не отговаря на изискваните параметри!')</script>";
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; admin.php">';
				exit;
			}
			else if ($result)
			{
				$this->back_thumbnail = '';
				$ResizeFile = THUMBNAIL_IMAGE_DESTINATION;
				$ResizeFile .= $_FILES['uback_file']['name'];
				$this->back_thumbnail = file_get_contents($ResizeFile);
				$this->back_thumbnail = mysql_real_escape_string($this->back_thumbnail);
				unlink($ResizeFile);
			}
		}	
	}
	
	function LastAdded()
	{
	    $query = mysql_query("SELECT * FROM articles GROUP by id ORDER BY id DESC LIMIT 4");
		    		
  		
		while ($row = mysql_fetch_array($query))
		{

		    echo '<ul><a href="detail.php?id='.$row[id].'">'.$row[name].'</a><br/>						
			Цена: '.$row[price].' лв.<br/>			
			</ul>';			

		}
			
	}
	
	function Delete($id)
	{
	    $query = "delete from articles where id=$id";
		
		
	    $insert = mysql_query($query);
	    if (!$insert)
	     die("Възникна проблем опитайте пак или ни пишете : ".mysql_error());
	}
	
  }
  
  class TSession 
  {
    protected $username;
	protected $password;
	public $SessionID;
		
	public function __Construct()
	{
	   	
	   $this->username = "";
	   $this->password = "";		  
	   $this->SessionID = $_SESSION['LoginID'];
    
	}

	function Edit($editedID)
	{
	  $nom = new TNom();
	  $nom->GetNomByID($editedID);
	  
	
	  ?>
	  <div id="poptrox">
		<h2>Редакция на артикул</h2>
		<form name= "post" enctype="multipart/form-data" method="post">    
		<table width="50%" cellspacing="2" cellpadding="2">
			<tr><td>Наименование: </td><td><input type="text" name="name" id="name" value='<?php echo $nom->name ?>' /></td></tr>
			<tr><td>
			Категория: 
			</td><td>
					 <select name="category" id="category">
							<option value="0">- Изберете Категория - </option>
							<option value="1" <?php echo set_select($nom->categoryID, 1);?>>Рокли</option>     
							<option value="2" <?php echo set_select($nom->categoryID, 2);?>>Бански</option>  
							<option value="3" <?php echo set_select($nom->categoryID, 3);?>>Обувки</option>  
							<option value="4" <?php echo set_select($nom->categoryID, 4);?>>Рокли</option>  			
					 </select>
					<br/>     
			</td></tr>
			<tr><td>Описание: </td><td><textarea name="descr" rows="5" cols="40"><?php echo $nom->descr ?></textarea></td></tr>
			<tr><td>Цвят: </td><td><input type="text" name="color" id="color" value='<?php echo $nom->color ?>' /></td></tr>
			<tr><td>Цена: </td><td><input type="text" name="price" id="price" value='<?php echo $nom->price ?>' /></td></tr>	
							
		    <tr><td><td align="right"><input type="submit" type="submit" name="btnEditNom" id="btnEditNom"  value="Редакция"/></td></td></tr>	
		</table>
		</form>
	  </div>
	  <?
	  
	  if (isset($_POST['btnEditNom']))  
	  {
	    $Nom = new TNom();
		$Nom->id = $editedID;
		$Nom->name = $_POST['name'];
		$Nom->categoryID = $_POST['category'];
		$Nom->descr = $_POST['descr'];
		$Nom->color = $_POST['color'];
		$Nom->price = $_POST['price'];
				
		$Nom->Update();
	  
	  }
		
	
	}
	function Administration()
	{
	  echo 
	  '<div id="poptrox">
		<h2>Добавяне на артикул</h2>
		<form name= "post" enctype="multipart/form-data" method="post">    
		<table width="50%" cellspacing="2" cellpadding="2">
			<tr><td>Наименование: </td><td><input type="text" name="name" id="name" /></td></tr>
			<tr><td>
			Категория: 
			</td><td>
					<select name="category" id="category">
					<option value="0">- Изберете Категория - </option>
					<option value="1">Рокли</option>
					<option value="2">Бански</option>
					<option value="3">Обувки</option>		
					<option value="4">Аксесоари</option>						
					</select><br/>     
			</td></tr>
			<tr><td>Описание: </td><td><textarea name="descr" rows="5" cols="40"></textarea></td></tr>
			<tr><td>Цвят: </td><td><input type="text" name="color" id="color" /></td></tr>
			<tr><td>Цена: </td><td><input type="text" name="price" id="price" /></td></tr>	
			<tr><td>Снимка 1: </td><td><input type="file"  name="ufront_file" id="file" /></td></tr>	
			<tr><td>Снимка 2: </td><td><input type="file"  name="uback_file" id="file" /></td></tr>					
		  			
		    <tr><td><td align="right"><input type="submit" type="submit" name="btnAddNom" id="btnAddNom"  value="Добави"/></td></td></tr>	
		</table>
		</form>
	  </div>';
	  
	  if (isset($_POST['btnAddNom']))  
	  {
	    $Nom = new TNom();
		
		$Nom->name = $_POST['name'];
		$Nom->categoryID = $_POST['category'];
		$Nom->descr = $_POST['descr'];
		$Nom->color = $_POST['color'];
		$Nom->price = $_POST['price'];
		$Nom->PublicateFrontImage();
		$Nom->PublicateBackImage();
		
		$Nom->Add();
	  
	  }
	  	 	 
	}
	
	
	function Login()
	{
		?>
			
			<div id="poptrox">
				<h2>Администратор</h2>	
				<form  name= "post" method="post">      
					Потребител: <input type="text" name="username" id="username" />
					Парола: <input type="password" name="password" id="password" />
					<input type="submit" type="submit" name="btnLogin" id="btnLogin"  value="Влез"/>	
				</form>					
				
			</div>
			
			<?php
				if (isset($_POST['btnLogin']))         
				{	
				    $username = $_POST['username'];
				    $password = $_POST['password'];
								
					 
					$query = mysql_query("SELECT * FROM users WHERE username='$username' and password='$password'");

					$result = mysql_fetch_array($query);
					$this->username  = $result['username'];
					$this->password = $result['password'];	  
					
										
					if (($this->username != $username) || (!$this->username))
						echo '<div id="poptrox">Грешно потребителско име и парола<br/><br/></div>';
					 else if (($this->password != $password) || (!$password))
						echo "Грешно потребителско име и/или парола<br>";
					 else
					 {					 
						$_SESSION['LoginID'] = $result['id'];		
									
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; admin.php">';
					 }		
				}
			?>
		 
		<?	
	}
	
	
  }
  
  class TRequest extends TSession
  {
	
	public function __Construct()
	{
	  parent::__construct();
	}
		
    function makeRequest($detailID, $name, $descr, $email, $phone)
	{
			
		$mail = new PHPMailer();
		
		$body = '<html><body>		
		<p>Номер: '.$number.'</p>
		<h2>Клиент:'.$name.'</h2>
		<p>Описание:'.$descr.'</p>
		<p>Емайл:'.$email.'</p>
		<p>Телефон:'.$phone.'</p>
		</body></html>';
		//file_get_contents('contents.html');
		
		$body  = eregi_replace("[\]",'',$body);

		$mail->IsSMTP(); // telling the class to use SMTP
		
		//$mail->Host       = "smtp.gmail.com"; // SMTP server
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
												   
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "pmsystem.mehmedov@gmail.com";  // GMAIL username
		$mail->Password   = "palladium1";            // GMAIL password
		$mail->CharSet = 'windows-1251'; 

		$mail->SetFrom('jakomen@abv.bg', 'Boni-Style');

		$mail->AddReplyTo("jakomen@abv.bg","Boni-Style");

		$mail->Subject    = "Имате нова заявка";

		$mail->AltBody    = "Имате нова заявка вижте"; // optional, comment out and test

		$mail->MsgHTML($body);

		$address = $email;
		$mail->AddAddress($address, "Имате нова заявка");

		$mail->AddAttachment("images/logo.png");      // attachment
		//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!";
		}
	
	}
	
	
  }

	function set_select($value1, $value2)
	{

		$result = "";
		if ($value1 == $value2) $result = "selected=selected";
		return $result;
	}
  
?>

</body>
</html>