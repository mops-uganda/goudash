<?php

	// Loader - class and connection
	include('loader.php');
	
	if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
	{
		$_POST['url'] = 'false';	
		
		if(isset($_POST['rep_id']) && isset($_POST['method']) && $_POST['method'] == 'repetitive_event')
		{
			$_POST['rep_id'] = $_POST['rep_id'];	
		}
		
		if(isset($_POST['categorie']))
		{
			$_POST['categorie'] = $_POST['categorie'];
		} else {
			$_POST['categorie'] = '';	
		}
		
		if($_POST['start_time'] !== '00:00' || $_POST['end_time'] !== '00:00')
		{
			$_POST['allDay'] = 'false';	
		} else {
			$_POST['allDay'] = 'true';		
		}
		
		if(strtotime($_POST['end_date']) < strtotime($_POST['start_date']))
		{
			return false;	
		}
			
		if($calendar->updates($_POST, $_FILES) === true) {
			return true;	
		} else {
			return false;	
		}
	}

?>