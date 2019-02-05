<?php
	// Loader - class and connection
	include('loader.php');
	
	if(isset($is_api) && $is_api == true)
	{
		echo $calendar->json_transform();
	} else {
		if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
		{
			echo $calendar->json_transform();	
		}
	}
	

		
?>