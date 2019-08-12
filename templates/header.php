<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		.body {color: white;}
		.error { color: #FF0000; }
	</style>
</head>
<body>
	<div id="menu">
		<ul>
			<li><a href="index.php">JNews</a></li>
			<li><a href="category.php">US politics</a></li>
			<li><a href="category.php">Business</a></li>
			<li><a href="category.php">Health</a></li>
			<li><a href="category.php">Style</a></li>			
			<li><a href="category.php">Travel</a></li>			
			<li><a href="category.php">Sport</a></li>			
			<li><a href="category.php">Videos</a></li>			
		</ul>
		<ul>
			<?php 
				if(isset($_SESSION["username"]))
				{
					echo "Hello, ".$_SESSION["username"]."<a href='logout.php'>Logout </a>";
				}
				else{
					echo "<a href='login.php'>Login</a>";
					echo "|";
					echo "<a href='register.php'>Register</a>";					
				}

			 ?>
		</ul>
	</div>