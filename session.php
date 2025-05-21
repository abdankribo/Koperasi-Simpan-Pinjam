<?php
	session_start(); //memulai session
	if (!isset($_SESSION['IsUser'])) { //kondisi ketika session kosong
		header("Location: ../index.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}
?>