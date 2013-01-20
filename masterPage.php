<?php

class Masterpage
{
	public function __Construct()
	{
	   
	}
	
	function header()
	{
		?>
		  <div id="header" class="container">
			<div id="logo">
				<h1><a href="index.php"><img src="images/logo.png" /></a></h1>
				<p>It's like a dream</p>
				
			</div>
			<div id="menu">
				<ul>
					<li class="current_page_item"><a href="index.php">Начало</a></li>
					<li><a href="dress.php">Рокли</a></li>
					<li><a href="banski.php">Бански</a></li>
					<li><a href="shoes.php">Oбувки</a></li>
					<li><a href="accessories.php">Аксесоари</a></li>
					<li><a href="about.php">За нас</a></li>
					<li><a href="contact.php">Контакт</a></li>
									
				</ul>
			</div>					
		  </div>

		<?
	}
	
	function footer()	
	{
	
	  ?>
		</div>
		<div id="page">
			<div id="bg1">
				<div id="bg2">
					<div id="bg3">
						<div id="content">
						<form action="search.php">
						Търси по ключова дума
						<input type="text" id="search-text" name="search" />
						<input type="submit"  id="search-text" value="Търси"/>
						</form>
							<h2>Стил и красота</h2>
								<p>Ние сме онлайн магазин за рокли, бански, костюми ,аксесоари и др.<br/>
								   Изградили сме екип от доказани и изградени модни дизайнери</p>
								<p>Направете вашия избор, бъдете свежи, модерни и предизвикателни!</p>
								<img src="images/developed.png" />
							</div>
						<div id="sidebar">
							<h2>Последни</h2>
							<?php
								$Nom = new TNom();
								$Nom->LastAdded();								
							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<p>Copyright (c) 2012 nh.zonebg.com. All rights reserved. Design by 
				<a href="http://nh.zonebg.com/">XSoft</a>. - <a href ="admin.php">Administrator</a>
				<?
				  if ($_SESSION['LoginID'])
					echo " - <a href =logout.php>Изход</a>";
				?>
				</p>

				
		</div>
		<!-- end #footer -->
	  <?
	
	}
}

?>


