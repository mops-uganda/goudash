<?php
	
	/*********************************************************************************************************************************
	**********************************************************************************************************************************
	***** FormParser
	***** Ajax Full Featured Calendar Version
	**********************************************************************************************************************************
	**********************************************************************************************************************************/
	
	include('database.class.php');
	
	class FormParser
	{
		// Path to json file configurations
		public $json = '';
		
		public $beforeRow = '<p>';
		public $afterRow = '</p>';
		
		public $beforeRC = '<span class="radio-checkbox">';
		public $afterRC = '</span>';
		
		private $newLine = "\r\n";
		
		private $jsonCode;
		
		/***********************************************************************************************************************************
		** Parse - read json file and parse
		***********************************************************************************************************************************/
		private function parse()
		{
			$db = new ConnectMe(DB_HOST, DB_USERNAME, DB_PASSWORD, DATABASE);
			
			$json = file_get_contents($this->json);
			
			$jsonCode = json_decode($json, true);
			
			$form = '';
			
			if(!$jsonCode) 
			{
				return false;
			}
			
			foreach($jsonCode as $v)
			{
				switch($v['dataType']) 
				{
					case "input":
						foreach($v['fields'] as $if_label => $if_pattern) 
						{
							preg_match_all("/\<(.*?)\>/", $if_pattern, $name_result);
							preg_match_all("/\{(.*?)\}/", $if_pattern, $values_result);
							preg_match_all("/\~(.*?)\~/", $if_pattern, $placeholder_result);
							preg_match_all("/\+(.*?)\+/", $if_pattern, $id_result);
							
							$name = array_values($name_result[1]);
							$name = array_shift($name);
							
							$values = array_values($values_result[1]);
							$values = (empty($values) == false) ? array_shift($values) : '';
							
							$placeholder = array_values($placeholder_result[1]);
							$placeholder = (empty($placeholder) == false) ? array_shift($placeholder) : '';
							
							$id = array_values($id_result[1]);
							$v['id'] = (empty($id) == false) ? ' id="'.array_shift($id).'" ' : ' ';
							
							$form .= $this->beforeRow . $this->newLine;
							$form .= '<label>'.$if_label.'</label>' . $this->newLine;
							$form .= '<input'.$v['id'].'type="text" class="'.$v['class'].'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$values.'"  />' . $this->newLine;
							$form .= $this->afterRow . $this->newLine;
						}
					break;
					
					case "input-upload":
						foreach($v['fields'] as $if_label => $if_pattern) 
						{
							preg_match_all("/\<(.*?)\>/", $if_pattern, $name_result);
							preg_match_all("/\{(.*?)\}/", $if_pattern, $values_result);
							preg_match_all("/\~(.*?)\~/", $if_pattern, $placeholder_result);
							preg_match_all("/\+(.*?)\+/", $if_pattern, $id_result);
							
							$name = array_values($name_result[1]);
							$name = array_shift($name);
							
							$values = array_values($values_result[1]);
							$values = (empty($values) == false) ? array_shift($values) : '';
							
							$placeholder = array_values($placeholder_result[1]);
							$placeholder = (empty($placeholder) == false) ? array_shift($placeholder) : '';
							
							$id = array_values($id_result[1]);
							$v['id'] = (empty($id) == false) ? ' id="'.array_shift($id).'" ' : ' ';
							
							$form .= $this->beforeRow . $this->newLine;
							$form .= '<label>'.$if_label.'</label>' . $this->newLine;
							$form .= '<input'.$v['id'].'type="file" class="'.$v['class'].'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$values.'"  />' . $this->newLine;
							$form .= $this->afterRow . $this->newLine;
						}
					break;
					
					case "textarea":
						foreach($v['fields'] as $if_label => $if_pattern) 
						{
							preg_match_all("/\<(.*?)\>/", $if_pattern, $name_result);
							preg_match_all("/\{(.*?)\}/", $if_pattern, $values_result);
							preg_match_all("/\~(.*?)\~/", $if_pattern, $placeholder_result);
							preg_match_all("/\+(.*?)\+/", $if_pattern, $id_result);
							
							$name = array_values($name_result[1]);
							$name = array_shift($name);
							
							$values = array_values($values_result[1]);
							$values = (empty($values) == false) ? array_shift($values) : '';
							
							$placeholder = array_values($placeholder_result[1]);
							$placeholder = (empty($placeholder) == false) ? array_shift($placeholder) : '';
							
							$id = array_values($id_result[1]);
							$v['id'] = (empty($id) == false) ? ' id="'.array_shift($id).'" ' : ' ';
							
							$form .= $this->beforeRow . $this->newLine;
							$form .= '<label>'.$if_label.'</label>' . $this->newLine;
							$form .= '<textarea'.$v['id'].'class="'.$v['class'].'" name="'.$name.'" placeholder="'.$placeholder.'">'.$values.'</textarea>' . $this->newLine;
							$form .= $this->afterRow . $this->newLine;
						}
					break;
					
					case "radio":
					case "checkbox":
						foreach($v['fields'] as $if_label => $if_pattern) 
						{
							preg_match_all("/\<(.*?)\>/", $if_pattern, $name_result);
							preg_match_all("/\{(.*?)\}/", $if_pattern, $values_result);
							preg_match_all("/\((.*?)\)/", $if_pattern, $labels_result);
							preg_match_all("/\+(.*?)\+/", $if_pattern, $id_result);
							
							$name = array_values($name_result[1]);
							$name = array_shift($name);
							
							$values = array_values($values_result[1]);
							$values = (empty($values) == false) ? array_shift($values) : '';
							
							$labels = array_values($labels_result[1]);
							$labels = (empty($labels) == false) ? array_shift($labels) : '';
							
							$id = array_values($id_result[1]);
							$v['id'] = (empty($id) == false) ? ' id="'.array_shift($id).'" ' : ' ';
							
							$form .= $this->beforeRow . $this->newLine;
							$form .= '<label>'.$if_label.'</label>' . $this->newLine;
							
							$values = explode(',', $values);
							$labels = explode(', ', $labels);
							
							$t = 0;
							foreach($labels as $l) 
							{
								$form .= $this->beforeRC . $this->newLine;
								$form .= '<input'.$v['id'].'type="'.$v['dataType'].'" class="'.$v['class'].'" name="'.$name.'" value="'.$values[$t].'" />'.$labels[$t] . $this->newLine;
								$form .= $this->afterRC . $this->newLine;
								
								$t++;
							}
							
							$form .= $this->afterRow . $this->newLine;
						}
					break;
					
					case "select":
						foreach($v['fields'] as $if_label => $if_pattern) 
						{
							preg_match_all("/\<(.*?)\>/", $if_pattern, $name_result);
							preg_match_all("/\{(.*?)\}/", $if_pattern, $values_result);
							preg_match_all("/\((.*?)\)/", $if_pattern, $labels_result);
							preg_match_all("/\+(.*?)\+/", $if_pattern, $id_result);
							
							preg_match_all("/\*(.*?)\*/", $if_pattern, $tableName);
							preg_match_all("/\#(.*?)\#/", $if_pattern, $fieldsTableName);
							
							if(!empty($tableName[1]) && !empty($fieldsTableName[1]))
							{
								$table_name = $db->escape($tableName[1][0]);
								$fileds_table_name = $db->escape($fieldsTableName[1][0]);
								$query = $db->query("SELECT $fileds_table_name FROM $table_name");
								if($db->num_rows($query) > 1)
								{ 
									$rows = $db->results($query);
								}
							}
							
							$name = array_values($name_result[1]);
							$name = array_shift($name);
							
							$values = array_values($values_result[1]);
							$values = (empty($values) == false) ? array_shift($values) : '';
							
							$labels = array_values($labels_result[1]);
							$labels = (empty($labels) == false) ? array_shift($labels) : '';
							
							$id = array_values($id_result[1]);
							$v['id'] = (empty($id) == false) ? ' id="'.array_shift($id).'" ' : ' ';
							
							$form .= $this->beforeRow . $this->newLine;
							$form .= '<label>'.$if_label.'</label>' . $this->newLine;
							$form .= '<select'.$v['id'].'class="'.$v['class'].'" name="'.$name.'">' . $this->newLine;

							$values = explode(',', $values);
							$labels = explode(', ', $labels);
							
							$t = 0;
							foreach($labels as $l) 
							{ 
								if($l)
								{
									$form .= '<option value="'.$values[$t].'">'.$labels[$t] . '</option>' . $this->newLine;
									$t++;
								}
							}

							if(isset($rows))
							{
								foreach($rows as $r) 
								{
									$form .= '<option value="'.$r[$fileds_table_name].'">'.$r[$fileds_table_name] . '</option>' . $this->newLine;
								}
							}
							
							$form .= '</select>' . $this->newLine;
							$form .= $this->afterRow . $this->newLine;
						}
					break;
				}
			}
			
			return $form;
		}
		
		/***********************************************************************************************************************************
		** Parse - generate the form
		***********************************************************************************************************************************/
		public function generate()
		{
			echo $this->parse();
		}
		
		/***********************************************************************************************************************************
		** Parse - buildjson
		***********************************************************************************************************************************/
		public function buildConfig($arg)
		{
			$cfg = json_encode($arg);
			var_dump($cfg);
		}
	}
	
?>