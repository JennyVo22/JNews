<?php 
session_start();

if($_SESSION["level"]==2){
	echo "Trang admin, <a href='../logout.php'>Logout</a>"; 
} else{
	header("location: ../index.php");
	exit();
}

?>