<?php
session_start();

	if(isset($_GET['start_ip_1'])){
		$start = $_GET['start_ip_1'];
		$end = $_GET['end_ip_1'];
		
		$_SESSION['start_ip'] = $start;
		$_SESSION['end_ip'] = $end;
		
	}
?>