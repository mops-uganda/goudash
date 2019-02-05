<?php

	include('includes/loader.php');
	include('includes/ics.parser.class.php');
	
	error_reporting(0);
	
	if(strlen($_POST['import']) !== 0)
	{
		$file = 'includes/ics_template.ics';
		$save = file_put_contents($file, $_POST['import']);
		
		if($save)
		{
			$ical = new ical($file);
			
			$events = $ical->events();

			if(!empty($events))
			{ 
				$post = array('repeat_method' => 'no', 'repeat_times' => 1);
				
				foreach($events as $ev)
				{
					$post['start_date'] = date('Y-m-d', $ical->iCalDateToUnixTimestamp($ev['DTSTART']));
					$post['start_time'] = date('H:i', $ical->iCalDateToUnixTimestamp($ev['DTSTART']));
					$post['end_date'] = date('Y-m-d', $ical->iCalDateToUnixTimestamp($ev['DTEND']));
					$post['end_time'] = date('H:i', $ical->iCalDateToUnixTimestamp($ev['DTEND']));
					$post['description'] = $ev['DESCRIPTION'];
					$post['title'] = $ev['SUMMARY'];
					
					if(isset($ev['AFFC-COLOR'])) { $post['color'] = $ev['AFFC-COLOR']; } else { $post['color'] = '#587ca3'; }
					if(isset($ev['AFFC-ALLDAY'])) { $post['all-day'] = $ev['AFFC-ALLDAY']; } else { $post['all-day'] = 'false'; }
					if(isset($ev['AFFC-URL'])) { $post['url'] = $ev['AFFC-URL']; } else { $post['url'] = 'false'; }
					
					if(isset($ev['AFFC-UID'])) { $post['user_id'] = $ev['AFFC-UID']; } else { $post['user_id'] = 0; }
					if(isset($post['categorie'])) { $post['categorie'] = $ev['CATEGORIES'];} else { $post['categorie'] = 'General'; }
					
					$calendar->addEvent($post, '');
				}
				echo $ical->event_count.' Events were imported!';
			}
		}
	} else {
		echo 'Nothing to import';	
	}
	
?>