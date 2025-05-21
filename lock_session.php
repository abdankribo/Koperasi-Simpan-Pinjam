<?php
	session_start(); //memulai session
	if (isset($_SESSION['IsAdmin'])) { //kondisi ketika session kosong
		header("Location: ./admin/edit_anggota.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}elseif(isset($_SESSION['IsMaster'])){
        header("Location: ./pihak3/pihak3_edit_anggota.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
    }
?>