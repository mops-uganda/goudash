<?php

	// Loader - class and connection
	include('loader.php');
	
	if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
	{
		if(isset($_GET['method']) && $_GET['method'] == 'export') {
			// Catch data from javascript
			$id = $_GET['id'];
			$title = $_GET['title'];
			$description = $_GET['description'];
			$start_date = date('Ymd\This', strtotime($_GET['start_date'])).'Z';
			$end_date = date('Ymd\This', strtotime($_GET['end_date'])).'Z';
		
			$data = $calendar->icalExport($id, $title, $description, $start_date, $end_date);	
			header('Content-type: text/calendar; charset=utf-8');
			header('Content-Disposition: inline; filename=Event-'.$id.'.ics');
			//echo preg_replace('#\[[^\]]+\]#', '', $data);
			echo $data;
		} else {
			$id = $_GET['id'];
			if(file_exists(getcwd().'/'.'Event-'.$id.'.ics')) {
				@unlink(getcwd().'/'.'Event-'.$id.'.ics');
			}
		}
	}

	


?>