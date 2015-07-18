<?php ob_start(); ?>
<?php session_start(); ?>
<?php
	//destroy session
	session_destroy();

	//go to index page		
	header("Location: index.php");
?>
<? ob_flush(); ?>
