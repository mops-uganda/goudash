<?php

	// Loader - class and connection
	include('loader.php');

	if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
	{
		$_POST['start_date'] = (strlen($_POST['start_date']) !== 0 ? $_POST['start_date'] : date('Y-m-d', time()));
		$_POST['start_time'] = (strlen($_POST['start_time']) !== 0 ? $_POST['start_time'] : '00:00:00');
		$_POST['end_date'] = (strlen($_POST['end_date']) !== 0 ? $_POST['end_date'] : date('Y-m-d', strtotime('+1 day', strtotime($start_date))));
		$_POST['end_time'] = (strlen($_POST['end_time']) !== 0 ? $_POST['end_time'] : '00:00:00');
				
		$_POST['user_id'] = 0;
		
		// Category Handler - Core
		if(isset($_POST['categorie']) && strlen($_POST['categorie']) !== 0)
		{
			$_POST['categorie'] = $_POST['categorie'];
		} else {
			$_POST['categorie'] = '';	
		}
		
		if(strlen($_POST['title']) == 0) 
		{
			echo 0;	
		} else {
			if(isset($_FILES))
			{
				$add_event = $calendar->addEvent($_POST, $_FILES);
			} else {
				$add_event = $calendar->addEvent($_POST, '');
			}
			
			if($add_event == true)
			{
				echo 1;
			} else {
				echo 0;	
			}
		}
	}
	
?>