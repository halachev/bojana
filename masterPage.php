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
					<li class="current_page_item"><a href="index.php">������</a></li>
					<li><a href="dress.php">�����</a></li>
					<li><a href="banski.php">������</a></li>
					<li><a href="shoes.php">O�����</a></li>
					<li><a href="accessories.php">���������</a></li>
					<li><a href="about.php">�� ���</a></li>
					<li><a href="contact.php">�������</a></li>
									
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
						����� �� ������� ����
						<input type="text" id="search-text" name="search" />
						<input type="submit"  id="search-text" value="�����"/>
						</form>
							<h2>���� � �������</h2>
								<p>��� ��� ������ ������� �� �����, ������, ������� ,��������� � ��.<br/>
								   ��������� ��� ���� �� �������� � ��������� ����� ���������</p>
								<p>��������� ����� �����, ������ �����, ������� � ���������������!</p>
								<img src="images/developed.png" />
							</div>
						<div id="sidebar">
							<h2>��������</h2>
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
					echo " - <a href =logout.php>�����</a>";
				?>
				</p>

				
		</div>
		<!-- end #footer -->
	  <?
	
	}
}

?>


