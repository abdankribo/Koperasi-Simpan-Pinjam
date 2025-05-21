<?php
	session_start(); //memulai session
	if (isset($_SESSION['IsMaster'])) { //kondisi ketika session kosong
		session_destroy();
		header("Location: ../index.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}else if(isset($_SESSION['IsUser'])) { //kondisi ketika session kosong
        session_destroy();
		header("Location: ../index.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}else if(!isset($_SESSION['IsAdmin'])) { //kondisi ketika session kosong
		header("Location: ../index.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}
?>