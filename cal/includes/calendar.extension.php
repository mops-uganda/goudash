<?php
	
	class calendarExtensions
	{
		
		/**
		* This function updates event drag, resize, repetitive event from jquery fullcalendar (update for repetitive events)
		*/
		protected function update_ui_repetitive($start, $end, $allDay_value, $repeat_type, $id, $extra)
		{
			$isForm = debug_backtrace();
			
			foreach($isForm as $is) 
			{
				if($is['function'] == 'updates')
				{
					$update = true;
				}
			}
			
			if(isset($update) && $update == true)
			{
				$extra['id'] = $id;
				$extra['start'] = $start;
				$extra['end'] = $end;
				unset($extra['rep_id']);
				$this->updates($extra, $_FILES, 'repeat_id');
			}
			
			if(strlen($allDay_value) == 0)
			{
				if(is_array($extra))
				{
					if(isset($extra['url']))
					{
						$url = $extra['url'];
					} else {
						$url = "false";	
					}
					
					$title = $extra['title'];
					$description = $extra['description'];
					$color = $extra['color'];
					$category = $extra['category'];

					$the_query = "title = '$title', description = '$description', color = '$color', category = '$category', url = '$url',";	
				} else {
					$the_query = '';	
				}
			} else {
				$the_query = "allDay = '$allDay_value',";	
			}
			
			$query = sprintf('UPDATE %s 
									SET 
										start = "%s",
										end = "%s",
										%s
										repeat_type = "%s"
									WHERE
										id = %d
						',
										mysqli_real_escape_string($this->connection, $this->table),
										mysqli_real_escape_string($this->connection, $start),
										mysqli_real_escape_string($this->connection, $end),
										$the_query,
										$repeat_type,
										mysqli_real_escape_string($this->connection, $id)
						);
			
			// The result
			return $this->result = mysqli_query($this->connection, $query);
		}
		
		/**
		* This function extends the update functions (repetitive event procedure for updates)
		*/
		protected function repetitive_event_procedure($allDay, $start, $end, $id, $original_id, $extra)
		{
			$current_date = date('d', strtotime($start));
			$current_month = date('m', strtotime($start));
			$current_year = date('Y', strtotime($start));
			$start_time = date('H:i:s', strtotime($start));
			
			$end_current_date = date('d', strtotime($end));
			$end_current_month = date('m', strtotime($end));
			$end_current_year = date('Y', strtotime($end));
			$end_time = date('H:i:s', strtotime($end));
			
			$query = mysqli_query($this->connection, sprintf('SELECT id, repeat_type FROM %s WHERE repeat_id = %d ORDER BY id ASC', 
				mysqli_real_escape_string($this->connection, $this->table),
				mysqli_real_escape_string($this->connection, $id)
			));
			
			while($row = mysqli_fetch_assoc($query))
			{
				$ids[] = $row['id'];
				$rt = $row['repeat_type'];
			}
	
			$num_rows = mysqli_num_rows($query);
			
			$allDay_value = $allDay;
			
			if($num_rows >= 1)
			{ 
				switch($rt)
				{
					case 'every_day':
						for($i = 0; $i <= $num_rows-1; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i day", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$start_time;
							$end = date('Y-m-d', strtotime("+$i day", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$end_time;
							$this->update_ui_repetitive($start, $end, $allDay_value, 'every_day', $ids[$i], $extra);
						}
						return true;
					break;
					
					case 'every_week':
						for($i = 0; $i <= $num_rows-1; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i week", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$start_time;
							$end = date('Y-m-d', strtotime("+$i week", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$end_time;
							$this->update_ui_repetitive($start, $end, $allDay_value, 'every_week', $ids[$i], $extra);
						}
						return true;
					break;
					
					case 'every_month':
						for($i = 0; $i <= $num_rows-1; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i month", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$start_time;
							$end = date('Y-m-d', strtotime("+$i month", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$end_time;
							$this->update_ui_repetitive($start, $end, $allDay_value, 'every_month', $ids[$i], $extra);
						}
						return true;
					break;	
				}
			}	
		}
		
		/**
		* Insert Repetitive Events Query (since 1.6.4)
		*/
		protected function insert_repetitive_query($fields, $start, $end)
		{
			$query =  mysqli_query($this->connection, sprintf('INSERT INTO %s 
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
																repeat_id = %d,
																repeat_type = "%s"
												',
													$fields['table'],
													$fields['title'],
													$fields['description'],
													$start,
													$end,
													$fields['all-day'],
													$fields['color'],
													$fields['url'],
													$fields['categorie'],
													$fields['user_id'],
													$fields['repeat_id'],
													$fields['repeat_method']
												));
			
			$inserted_id = mysqli_insert_id($this->connection);
			
			unset($fields['title'], $fields['description']);
			unset($fields['start_date'], $fields['start_time'], $fields['end_date'], $fields['end_time']);
			unset($fields['all-day'], $fields['color'], $fields['url'], $fields['categorie']);
			unset($fields['user_id']);
			unset($fields['repeat_method'], $fields['repeat_times'], $fields['repeat_id']);
				
			// add all other custom fields
			if(!empty($fields))
			{
				foreach($fields as $k => $v)
				{ 
					$v = (strlen($v) == 0) ? 'null' : $v;
					$k = str_replace('_', ' ', $k);
					mysqli_query(
						$this->connection, 
						sprintf("UPDATE %s SET `{$k}` = '%s' WHERE id = %d", mysqli_real_escape_string($this->connection, $this->table), mysqli_real_escape_string($this->connection, $v), $inserted_id)
					);
				}
			}
			
		}
		
		/**
		* Insert Repetitive Events (since 1.6.4)
		*/
		protected function insert_repetitive_events($fields, $current_date, $current_month, $current_year)
		{
			$repeat_times = $fields['repeat_times'];
			
			$end_current_date = date('d', strtotime($fields['end_date']));
			$end_current_month = date('m', strtotime($fields['end_date']));
			$end_current_year = date('Y', strtotime($fields['end_date']));
			
			switch($fields['repeat_method'])
			{
				case 'every_day':
					if($repeat_times <= '30')
					{
						for($i = 1; $i <= $repeat_times; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i day", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$fields['start_time'].':00';
							$end = date('Y-m-d', strtotime("+$i day", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$fields['end_time'].':00';
							$this->insert_repetitive_query($fields, $start, $end);
						}
						return true;
					}
				break;
				
				case 'every_week':
					if($repeat_times <= 30)
					{
						for($i = 1; $i <= $repeat_times; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i week", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$fields['start_time'].':00';
							$end = date('Y-m-d', strtotime("+$i week", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$fields['end_time'].':00';
							$this->insert_repetitive_query($fields, $start, $end);
						}
						return true;
					}
				break;
				
				case 'every_month':
					if($repeat_times <= 30)
					{
						for($i = 1; $i <= $repeat_times; $i++)
						{
							$start = date('Y-m-d', strtotime("+$i month", strtotime($current_year.'-'.$current_month.'-'.$current_date))) . ' ' .$fields['start_time'].':00';
							$end = date('Y-m-d', strtotime("+$i month", strtotime($end_current_year.'-'.$end_current_month.'-'.$end_current_date))) . ' ' .$fields['end_time'].':00';
							$this->insert_repetitive_query($fields, $start, $end);
						}
						return true;
					}
				break;
			}
		}
		
		/**
		* This function updates custom fields
		*/
		protected function update_custom_fields($post, $id) 
		{
			if(!empty($post))
			{
				foreach($post as $k => $v)
				{ 
					if(is_array($v))
					{
						$v = implode(', ', $v);
					} else {
						$v = (strlen($v) == 0) ? '' : $v;
					}
					$k = str_replace('_', ' ', $k);
					mysqli_query(
						$this->connection, 
						sprintf("UPDATE %s SET `{$k}` = '%s' WHERE id = %d", mysqli_real_escape_string($this->connection, $this->table), mysqli_real_escape_string($this->connection, $v), $id)
					);
				}
			}
		}
		
		/**
		* This function handles file upload
		*/
		protected function handle_file_upload($post, $file) 
		{
			if(!empty($file))
			{
				if(strlen($file['file']['name']) !== 0)
				{
					// Allowed Extensions
					$targetFolder = $this->uploadDir;
					$fileTypes = array('zip','pdf','doc','ppt','xls','txt','docx','xlsx','pptx','png','jpg','gif');
					$fileParts = pathinfo($file['file']['name']);

					$tempFile = $file['file']['tmp_name'];

					$timestamp = time();
					$filename = $timestamp . $_FILES['file']['name'];
					$targetFile = $targetFolder . $filename;
					
					if(in_array($fileParts['extension'], $fileTypes)) 
					{
						$upd = move_uploaded_file($tempFile, $targetFile);
						if($upd) 
						{
							$post['file'] = SITE_FILES_URL.$filename;
							return $post;
						} else {
							$post['file'] = '';
							return $post;
						}
						
					} else {
						return $post;
					}
				} else {
					return $post;
				}
			} else {
				return $post;
			}
		}
		
		/**
		* Strip unwanted tags from the calendar
		* Those that want HTML support on the calendar use this function on the 'updates' and 'addEvent' to the $description
		* like this $this->strip_html_tags($description) to filter it and use on the function 'json_transform' htmlspecialchars_decode($event_description)
		* to render html to the event description.
		*/
		protected function strip_html_tags($text)
		{
			$text = preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bhead\b[^>]*>(.*?)<\s*\/\s*head\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bstyle\b[^>]*>(.*?)<\s*\/\s*style\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bobject\b[^>]*>(.*?)<\s*\/\s*object\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bapplet\b[^>]*>(.*?)<\s*\/\s*applet\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bnoframes\b[^>]*>(.*?)<\s*\/\s*noframes\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bnoscript\b[^>]*>(.*?)<\s*\/\s*noscript\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bframeset\b[^>]*>(.*?)<\s*\/\s*frameset\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bframe\b[^>]*>(.*?)<\s*\/\s*frame\s*>~is', '', $text);
			$text = preg_replace('~<\s*\biframe\b[^>]*>(.*?)<\s*\/\s*iframe\s*>~is', '', $text);
			$text = preg_replace('~<\s*\bform\b[^>]*>(.*?)<\s*\/\s*form\s*>~is', '', $text);
			$text = preg_replace('/on[a-z]+=\".*\"/i', '', $text);
			
			return $text;
			
		}
				
	}

?>