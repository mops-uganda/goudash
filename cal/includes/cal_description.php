<?php
	
	// Loader - class and connection
	include('loader.php');
	
	if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
	{
		$c = $calendar->get_event($_POST['id']);
		
		$content = $c['description'];
		$cat = $c['category'];
		$color = $c['color'];
		
		if($cat == '') { $cat = 'General'; }
		
		if($content == '') { $content = '$null'; } else {
			$content = $formater->html_format($embed->oembed($content));
			$content = $maps->to_maps($content);	
		} 
		
		$content_editable = $c['description'];
		
		if($color == '') { $color = '$null'; }
		
		$array = array('description' => $content, 'description_editable' => $content_editable, 'category' => $cat, 'categorie' => $cat, 'all-day' => $c['allDay'], 'color' => $color, 'categories' => $calendar->categories);
		
		unset($c['description'], $c['category'], $c['categorie'], $c['color'], $c['allDay']);
		
		$array = array_merge($array, $c);
		
		if($content == true)
		{
			if(isset($_POST['mode']) && $_POST['mode'] == 'edit')
			{	
				echo json_encode($array);
			} else {
				echo $content_editable;
			}
		} else {
			echo '';
		}
	}
	
?>