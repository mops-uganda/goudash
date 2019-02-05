<?php

	/*************************************************************************
	*	Ajax Full Featured Calendar
	*	- Add Event To Calendar
	*	- Edit Event On Calendar
	*	- Delete Event On Calendar
	*	- View Event On Calendar
	*	- Update Event On Rezise
	*	- Update Event On Drag
	*
	*	Author: Paulo Regina
	*	Version: 2.2 (June 2016)
	**************************************************************************/
	
	class calendar extends calendarExtensions
	{
		###############################################################################################
		#### Properties
		###############################################################################################
		
		// Initializes A Container Array For All Of The Calendar Events
		var $json_array = array();
		var $categories = '';
		var $connection = '';
		var $filter ='';
		
		var $uploadDir = '';
		
		############################################################################################### 
		#### Methods
		###############################################################################################
		
		/**
		* Construct
		* Returns connection
		*/
		public function __construct($db_server, $db_username, $db_password, $db_name, $table, $condition=false, $cf='')
		{
			// Set Internal Variables
			$this->db_server = $db_server;	
			$this->db_username = $db_username;
			$this->db_password = $db_password;
			$this->db_name = $db_name;
			$this->table = $table;	
			
			$this->filter = $cf;
			$this->condition = $condition;
			
			// Connection @params 'Server', 'Username', 'Password'
			$this->connection = mysqli_connect($this->db_server, $this->db_username, $this->db_password, $this->db_name);
			
			// Display Friend Error Message On Connection Failure
			if(!$this->connection) 
			{
				header('Location: _install.php');
				exit();
				//die('Could not connect: ('.mysqli_connect_errno().') - ' . mysqli_connect_error());
			}
			
			// Internal UTF-8
			mysqli_query($this->connection, "SET NAMES 'utf8'");
			mysqli_query($this->connection, 'SET character_set_connection=utf8');
			mysqli_query($this->connection, 'SET character_set_client=utf8');
			mysqli_query($this->connection, 'SET character_set_results=utf8');
			

			// json_transform filter
			$start = @$this->filter['start'];
			$end = @$this->filter['end'];
			
			if(isset($start) && isset($end))
			{
				$newdate_start = strtotime('-4 months', strtotime($start));
				$start = date('Y-m-d', $newdate_start);
				
				$newdate_end = strtotime('+1 month', strtotime($end));
				$end = date('Y-m-d', $newdate_end);
			}
			
			// Run The Query
			$dc = '';
			if($this->condition == false)
			{
				if(strlen($start) !== 0 && strlen($end) !== 0) 
				{
					$dc = sprintf(" WHERE start >= '%s' AND end <= '%s'", addslashes($start), addslashes($end));
				}

				$this->result = mysqli_query($this->connection, "SELECT * FROM $this->table $dc");
			} else {
				
				if(strlen($start) !== 0 && strlen($end) !== 0) 
				{
					$dc = sprintf(" AND start >= '%s' AND end <= '%s'", addslashes($start), addslashes($end));
				} 
				$this->result = mysqli_query($this->connection, "SELECT * FROM $this->table WHERE $this->condition $dc");	
			}
			
		}
		
		/**
		* Function To Transform MySQL Results To jQuery Calendar Json
		* Returns converted json
		*/
		public function json_transform()
		{
			while($this->row = mysqli_fetch_array($this->result, MYSQLI_ASSOC))
			{
				 if($this->row['allDay'] == 'true') 
				 {
					 $allDayStatus = true;
				 } else {
					$allDayStatus = false;	 
				 }
				 
				 // Set Variables Data from DB
				 $event_id = $this->row['repeat_id'];
				 $event_original_id = $this->row['id'];
				 $event_title = $this->row['title'];
				 $event_description = $this->row['description'];
				 $event_start = $this->row['start'];
				 $event_end = $this->row['end'];
				 $event_allDay = $allDayStatus;
				 $event_color = $this->row['color'];
				 $event_url = $this->row['url'];

				 $build_json = array('id' => $event_id, 'original_id' => $event_original_id, 'title' => $event_title, 'start' => $event_start, 'end' => $event_end, 'allDay' => $event_allDay, 'color' => $event_color);
					
				 array_push($this->json_array, $build_json);	 
				 	  
			} // end while loop
			
			// Output The Json Formatted Data So That The jQuery Call Can Read It
			return json_encode($this->json_array);	
		}
		
		/**
		* This function will check for repetitive events (since 1.6.4)
		* Returns true
		*/
		public function check_repetitive_events($id)
		{
			$query = sprintf('SELECT * FROM %s WHERE repeat_id != id AND id = %d || repeat_id = %d',
				  mysqli_real_escape_string($this->connection, $this->table),
				  mysqli_real_escape_string($this->connection, $id),
				  mysqli_real_escape_string($this->connection, $id)
			);
			
			$res = mysqli_query($this->connection, $query);
			
			if(mysqli_num_rows($res) > 1)
			{
				return true; 
			} elseif(mysqli_num_rows($res) == 1) {
				$row = mysqli_fetch_assoc($res);
				if($row['id'] == $row['repeat_id'])
				{
					return false;
				} else {
					return true;	
				}
			} else {
				return false;	
			}
		}
		
		/**
		* This function will update event on drag or resize
		* Returns boolean
		*/
		public function update($allDay, $start, $end, $id, $original_id)
		{			
			// Convert Date Time
			$start = strftime('%Y-%m-%d %H:%M:%S', strtotime(substr($start, 0, 24)));
			$end = strftime('%Y-%m-%d %H:%M:%S', strtotime(substr($end, 0, 24)));
			
			$allDay_value = $allDay;
			
			// Before updating on drag or resize check if it is repetitive event
			$is_rep = $this->check_repetitive_events($original_id);

			if($is_rep == true)
			{
				$process = $this->repetitive_event_procedure($allDay, $start, $end, $id, $original_id, '');
				
				if($process == true)
				{
					return true;
				} else {
					return false;	
				}
			 }
			
			// The update query for normal events
			$query = sprintf('UPDATE %s 
									SET 
										start = "%s",
										end = "%s",
										allDay = "%s"
									WHERE
										repeat_id = %s
						',
										mysqli_real_escape_string($this->connection, $this->table),
										mysqli_real_escape_string($this->connection, $start),
										mysqli_real_escape_string($this->connection, $end),
										mysqli_real_escape_string($this->connection, $allDay_value),
										mysqli_real_escape_string($this->connection, $id)
						);
			
			// The result
			return $this->result = mysqli_query($this->connection, $query);
		}
		
		/**
		* This function updates events to the database (Edit Update)
		* Returns true
		*/
		public function updates($post, $file, $id_field = '')
		{	
			// Handle Upload
			$post = $this->handle_file_upload($post, $file);
			
			if(strlen($id_field) == '') 
			{ 
				$start = $post['start_date'].' '.$post['start_time'].':00';
				$end = $post['end_date'].' '.$post['end_time'].':00';
			} else { 
				$start = $post['start'];
				$end = $post['end'];
				$id_field = 'id';
			}
			
			$id = mysqli_real_escape_string($this->connection, $post['id']);
			
			if(isset($post['rep_id']) && strlen($post['rep_id']) !== 0)
			{
				$is_rep = $this->check_repetitive_events($id);
				
				if($is_rep == true)
				{ 
					$process = $this->repetitive_event_procedure($post['allDay'], $start, $end, $post['rep_id'], $id, $post);
					
					if($process == true)
					{
						return true;
					} else {
						return false;	
					}
				 }
			}
			
			if(strlen($id_field) == '')
			{
				$id_field = 'id';
			}
			
			// The update query
			$query = sprintf("UPDATE %s SET 
										title = '%s',
										description = '%s',
										color = '%s',
										start = '%s',
										end = '%s',
										url = '%s',
										category = '%s',
										allDay = '%s'
									WHERE
									{$id_field} = %d
						",
										mysqli_real_escape_string($this->connection, $this->table),
										mysqli_real_escape_string($this->connection, strip_tags($post['title'])),
										mysqli_real_escape_string($this->connection, htmlspecialchars($post['description'], ENT_COMPAT, 'UTF-8')),
										mysqli_real_escape_string($this->connection, htmlspecialchars($post['color'])),
										mysqli_real_escape_string($this->connection, $start),
										mysqli_real_escape_string($this->connection, $end),
										mysqli_real_escape_string($this->connection, htmlspecialchars($post['url'])),
										mysqli_real_escape_string($this->connection, htmlspecialchars($post['categorie'])),
										mysqli_real_escape_string($this->connection, $post['allDay']),
										$id
										
						);
			
			$this->result = mysqli_query($this->connection, $query);
			
			unset($post['rep_id'], $post['method'], $post['id'], $post['end_date'], $post['end_time'], $post['start_date'], $post['start_time'], $post['allDay'], $post['repeat_times'], $post['repeat_method'], $post['categorie']);
			
			// add all other custom fields
			$this->update_custom_fields($post, $id);
		}
		
		/**
		* This function adds events to the database
		* Returns true
		*/
		public function addEvent($post, $file='')
		{	
			// Avoid empty title
			if(strlen($post['title']) == 0)
			{
				return false;
			}
			
			// Avoid empty start date
			if(strlen($post['start_date']) == 0)
			{
				return false;
			}
			
			// Check for empty data
			if(empty($post['title']) && empty($post['start_date']))
			{
				return false;	
			}
			
			// Checking URL
			if(empty($post['url'])) 
			{
				$post['url'] = 'false';
			}
			
			// Handle Upload
			$post = $this->handle_file_upload($post, $file);
			
			// Convert Date Time
			$start = $post['start_date'].' '.$post['start_time'].':00';
			$end = $post['end_date'].' '.$post['end_time'].':00';
			
			// Prepare Existing Fields
			$post['title'] = mysqli_real_escape_string($this->connection, strip_tags($post['title']));
			$post['description'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['description'], ENT_COMPAT, 'UTF-8'));
			$post['start_date'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['start_date']));
			$post['start_time'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['start_time']));
			$post['end_date'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['end_date']));
			$post['end_time'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['end_time']));
			$post['all-day'] = mysqli_real_escape_string($this->connection, $post['all-day']);
			$post['color'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['color']));
			$post['url'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['url']));
			$post['categorie'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['categorie'], ENT_COMPAT, 'UTF-8'));
			$post['user_id'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['user_id']));
			$post['repeat_method'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['repeat_method']));
			$post['repeat_times'] = mysqli_real_escape_string($this->connection, htmlspecialchars($post['repeat_times']));
			
			// Copy
			$fields = $post;
			
			// Insert Default Data
			if(isset($post) && is_array($post))
			{	
				$query = sprintf('INSERT INTO %s 
										SET 
											title = "%s",
											description = "%s",
											start = "%s",
											end = "%s",
											allDay = "%s",
											color = "%s",
											url = "%s",
											category = "%s",
											user_id = %d,
											repeat_type = "%s",
											repeat_id = "%s"
							',
											mysqli_real_escape_string($this->connection, $this->table),
											$post['title'],
											$post['description'],
											$start,
											$end,
											$post['all-day'],
											$post['color'],
											$post['url'],
											$post['categorie'],
											$post['user_id'],
											$post['repeat_method'],
											"0"
							);
							
				unset($post['title'], $post['description']);
				unset($post['start_date'], $post['start_time'], $post['end_date'], $post['end_time']);
				unset($post['all-day'], $post['color'], $post['url'], $post['categorie']);
				unset($post['user_id']);
				unset($post['repeat_method'], $post['repeat_times']);
				
				// The result
				$this->result = mysqli_query($this->connection, $query);
				$inserted_id = mysqli_insert_id($this->connection);
			} 
			
			// Handle Custom Fields and Other Data
			if($this->result) 
			{
				// update repeat_id
				mysqli_query(
					$this->connection, 
					sprintf("UPDATE %s SET repeat_id = %d WHERE id = %d", mysqli_real_escape_string($this->connection, $this->table), $inserted_id, $inserted_id)
				);
				
				// add all other custom fields
				$this->update_custom_fields($post, $inserted_id);
				
				// deal with repetitive events
				if(strlen($inserted_id) !== 0)
				{ 
					if($fields['repeat_method'] == 'no')
					{
						return true;
					} else {
						$current_date = date('d', strtotime($fields['start_date']));
						$current_month = date('m', strtotime($fields['start_date']));
						$current_year = date('Y', strtotime($fields['start_date']));
						
						$fields['table'] = mysqli_real_escape_string($this->connection, $this->table);
						$fields['repeat_id'] = $inserted_id;
						
						$added_repetitive_events = $this->insert_repetitive_events($fields, $current_date, $current_month, $current_year);	
						
						if($added_repetitive_events)
						{
							return true;	
						}
					}
				} else {
					return false;	
				}
			} else {
				return false;	
			}
		}
		
		/**
		* This function deletes event from database
		* Returns true
		*/
		public function delete($id, $rep_id, $method='')
		{
			// Delete Query
			if($method == '')
			{
				$query = "DELETE FROM $this->table WHERE id = $id";		
			} else {
				$query = "DELETE FROM $this->table WHERE repeat_id = $rep_id";		
			}
			
			// Result
			$this->result = mysqli_query($this->connection, $query);
			
			if($this->result) 
			{
				return true;
			} else {
				return false;	
			}
			
		}
		
		/**
		* This function will get description (since 1.6.4)
		* Returns true
		*/
		public function get_description($id)
		{
			$query = sprintf('SELECT description FROM %s WHERE id = %d',
				  mysqli_real_escape_string($this->connection, $this->table),
				  mysqli_real_escape_string($this->connection, $id)
			);
			
			$res = mysqli_query($this->connection, $query);

			if(mysqli_num_rows($res) >= 1)
			{
				$result = mysqli_fetch_assoc($res);
				return $result['description'];
			} else {
				return false;	
			}
		}
		
		/**
		* This function will get event data (since 2.0)
		* Returns boolean
		*/
		public function get_event($id)
		{
			$query = sprintf('SELECT * FROM %s WHERE id = %d',
				  mysqli_real_escape_string($this->connection, $this->table),
				  mysqli_real_escape_string($this->connection, $id)
			);
			
			$res = mysqli_query($this->connection, $query);

			if(mysqli_num_rows($res) >= 1)
			{
				$result = mysqli_fetch_assoc($res);
				return $result;
			} else {
				return false;	
			}
		}
		
		/**
		* This function retrieves calendar data
		* Returns true
		*/
		public function retrieve($id)
		{
			// Result Query
			$this->result = mysqli_query($this->connection, sprintf("SELECT * FROM $this->table WHERE id = %s", mysqli_real_escape_string($this->connection, $id)));
			
			if($this->result) {
				return mysqli_fetch_assoc($this->result);
			} else {
				return false;	
			}
				
		}
		
		/**
		* Gets all Categories - since version 1.4
		* Returns array
		*/
		public function getCategories()
		{
			// Set default category in case the user do not have categories with events
			$results = $this->categories;
			asort($results);
			$return = array_unique(array_filter($results));
			
			if(count($return) == 0)
			{
				return false;
			} else {
				return $return;	
			}
		}
		
		/**
		* This function exports each event to the icalendar format and forces a download
		* Returns true
		*/		
		public function icalExport($id, $title, $description, $start_date, $end_date, $url=false)
		{
			
			if($url == 'undefined') 
			{
				$url = '';
			} else {
				$url = ' '.$url.' ';	
			}
			
			$event = $this->get_event($id);
			
			$description_fn = $str = str_replace(array("\r","\n","\t"),'\n',$description);
			
			// Build the ics file
$ical = 'BEGIN:VCALENDAR
PRODID:-//Paulo Regina//Ajax Calendar 2.0 MIMEDIR//EN
VERSION:2.0
BEGIN:VEVENT
CREATED:'.date('Ymd\This', time()).'Z'.'
DESCRIPTION:'.$description_fn.'
DTEND:'.$end_date.'
DTSTAMP:'.date('Ymd\This', time()).'Z'.'
DTSTART:'.$start_date.'
CATEGORIES:'.$event['category'].'
AFFC-ALLDAY:'.$event['allDay'].'
AFFC-COLOR:'.$event['color'].'
AFFC-URL:'.$event['url'].'
AFFC-UID:'.$event['user_id'].'
LAST-MODIFIED:'.date('Ymd\This', time()).'Z'.'
SUMMARY:'.addslashes($title).'
END:VEVENT
END:VCALENDAR';
			 
			if(isset($id)) {
				return $ical;
			} else {
				return false;
			}
		}
		
		/**
		* Export entire calendar to icalendar (since 1.6.4)
		* Returns true
		*/
		public function icalExport_all($uid=0)
		{
			
			if(isset($uid))
			{
				$u_f = $uid;
			} else {
				$u_f = 0;	
			}
			
			$query = mysqli_query($this->connection, "SELECT * FROM $this->table WHERE user_id = $u_f");
			
			if(mysqli_num_rows($query) > 0)
			{
				$ical = '';
				
$ical .= 'BEGIN:VCALENDAR' ."\n";
$ical .= 'PRODID:-//Paulo Regina//Ajax Calendar 2.0 MIMEDIR//EN'."\n";
$ical .= 'VERSION:2.0'."\n";
				while($row = mysqli_fetch_assoc($query))
				{
$ical .= 'BEGIN:VEVENT'."\n";
$ical .= 'CREATED:'.date('Ymd\This', time()).'Z'."\n";
$ical .= 'DESCRIPTION:'.str_replace(array("\r","\n","\t"),'\n',$row['description'])."\n";
$ical .= 'DTEND:'.date('Ymd\This', strtotime($row['end'])).'Z'."\n";
$ical .= 'DTSTAMP:'.date('Ymd\This', time()).'Z'."\n";
$ical .= 'DTSTART:'.date('Ymd\This', strtotime($row['start'])).'Z'."\n";
$ical .= 'CATEGORIES:'.$row['category']."\n";
$ical .= 'AFFC-ALLDAY:'.$row['allDay']."\n";
$ical .= 'AFFC-COLOR:'.$row['color']."\n";
$ical .= 'AFFC-URL:'.$row['url']."\n";
$ical .= 'AFFC-UID:'.$row['user_id']."\n";
$ical .= 'LAST-MODIFIED:'.date('Ymd\This', time()).'Z'."\n";
$ical .= 'SUMMARY:'.addslashes($row['title'])."\n";
$ical .= 'END:VEVENT'."\n";			
				}
$ical .= 'END:VCALENDAR'."\n";

			return $ical;
			
			} else {
				return false;	
			}
				
		}
			
	}

?>