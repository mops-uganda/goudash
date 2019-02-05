<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true ");
	header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
	header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

	// sample key (you can create a proper API system for this)
	$key = 'k20d802kfahvui0280fghl';

	if(isset($_GET['key']) && $_GET['key'] == $key)
	{
		if(isset($_GET['action']))
		{
			include('cal/includes/loader.php');
			switch($_GET['action'])
			{
				case "event_description":
					$id = $_GET['id'];
					$c = $calendar->get_event($id);
					$content = $c['description'];
					$cat = $c['category'];
					if($cat == '') { $cat = 'General'; }
					if($content == '') { $content = '$null'; } else {
						$content = $embed->oembed($formater->html_format($content));
						$content = $maps->to_maps($content);	
					} 
					$array = array('description' => $content, 'category' => $cat);
					echo json_encode($array);
				break;
				
				case "insert":
					$title = (isset($_GET['title']) ? $_GET['title'] : '');
					$description = (isset($_GET['description']) ? $_GET['description'] : '');
					$start_date = @(strlen($_GET['start_date']) !== 0 ? $_GET['start_date'] : date('Y-m-d', time()));
					$start_time = @(strlen($_GET['start_time']) !== 0 ? $_GET['start_time'] : '00:00:00');
					$end_date = @(strlen($_GET['end_date']) !== 0 ? $_GET['end_date'] : date('Y-m-d', strtotime('+1 day', strtotime($start_date))));
					$end_time = @(strlen($_GET['end_time']) !== 0 ? $_GET['end_time'] : '00:00:00');
					$color = (isset($_GET['color']) ? $_GET['color'] : '#587ca3');
					$allDay = (isset($_GET['all-day']) ? $_GET['all-day'] : 'true');
					
					$extra = array('repeat_method' => (isset($_GET['repeat_method']) ? $_GET['repeat_method'] : 'no'), 'repeat_times' => (isset($_GET['repeat_times']) ? $_GET['repeat_times'] : 1));
					$extra['user_id'] = 0; // this is not used because its considered that the API KEY belongs to the user, so it does not support multiple users
					$extra['categorie'] = (isset($_GET['categorie']) ? $_GET['categorie'] : 'General'); 
					
					if(strlen($title) == 0)
					{
						echo 'Title cannot be empty';
					} else {
						$add_event = $calendar->addEvent($title, $description, $start_date, $start_time, $end_date, $end_time, $color, $allDay, 'false', $extra);	
						if($add_event == true)
						{
							echo 1;
						} else {
							echo 0;	
						}
					}
				break;
				
				case "update":
					$event = array(
						'id' => $_GET['id'],
						'title' => $_GET['edit_title'],
						'description' => $_GET['edit_description'],
						'color' => $_GET['edit_color'],
						'start_date' => $_GET['edit_start_date'],
						'start_time' => $_GET['edit_start_time'],
						'end_date' => $_GET['edit_end_date'],
						'end_time' => $_GET['edit_end_time']
					);
					
					$event['url'] = 'false';	
					
					if(isset($_GET['rep_id']) && isset($_GET['method']) && $_GET['method'] == 'repetitive_event')
					{
						$event['rep_id'] = $_GET['rep_id'];	
					}
					
					if(isset($_GET['edit_categorie']))
					{
						$event['category'] = $_GET['edit_categorie'];
					} else {
						$event['category'] = '';	
					}
					
					if($event['start_time'] !== '00:00' || $event['end_time'] !== '00:00')
					{
						$event['allDay'] = 'false';	
					} else {
						$event['allDay'] = 'true';		
					}
					
					if(strtotime($event['end_date']) < strtotime($event['start_date']))
					{
						echo 0;	
					}
					
					if($calendar->updates($event) === true) {
						echo 1;	
					} else {
						echo 0;	
					}
				break;
				
				case "delete":
					if(isset($_GET['method']) && $_GET['method'] == 'repetitive_event')
					{
						$method = true;
						$rep_id = $_GET['rep_id'];
						$id = $_GET['id'];
					} else {
						$method = '';
						$rep_id = $_GET['id'];
						$id = $_GET['id'];	
					}
					
					$calendar->delete($id, $rep_id, $method);
				break;
			}
		} else {
			$is_api = true;
			include('cal/includes/cal_events.php');
		}
	}
	
?>