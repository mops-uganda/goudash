<?php
	
	// Loader - class and connection
	include('loader.php');
	
	if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
	{
		$rep = $calendar->check_repetitive_events($_POST['id']);
		
		if($rep == true)
		{
			echo 'REP_FOUND';
		} else {
			echo 'REP_NOT_FOUND';
		}
	}
	
?>