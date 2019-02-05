<?php
	
	/*********************************************************************************************************************************
	**********************************************************************************************************************************
	***** MySQLi Database Class
	***** Author: Paulo Regina
	***** Author URI: www.pauloreg.com
	***** Version: 2.0 - May 2015
	**********************************************************************************************************************************
	**********************************************************************************************************************************/
	
	class ConnectMe
	{
		public function __construct($db_server, $db_username, $db_password, $db_name) 
		{
			$this->db_server = $db_server;	
			$this->db_username = $db_username;
			$this->db_password = $db_password;
			$this->db_name = $db_name;
			
			$this->mysqli = new mysqli($this->db_server, $this->db_username, $this->db_password, $this->db_name);

			if($this->mysqli->connect_error)
			{
				return false;
			}
			
			$this->mysqli->query("SET NAMES 'utf8'");
			$this->mysqli->query('SET character_set_connection=utf8');
			$this->mysqli->query('SET character_set_client=utf8');
			$this->mysqli->query('SET character_set_results=utf8');	
		}
		
		public function results($result)
		{
			$result_array = array();
			
			for($i = 0; $row = $this->fetch_row($result); $i++)
			{
			   $result_array[$i] = $row; 
			}
			
			return $result_array;
		}
		
		public function array_values_recursive($ary)  
		{
			$lst = array();
			foreach( array_keys($ary) as $k ) 
			{
				$v = $ary[$k];
				if(is_scalar($v)) 
				{
					$lst[] = $v;
				} elseif (is_array($v)) {
					$lst = array_merge($lst, $this->array_values_recursive($v));
				}
			}
		
			return $lst;
		}
		
		public function sanitize_integer($get_id)
		{
			// clean it
			$sanitize = strip_tags($get_id);
			$sanitize = str_replace("'","", $sanitize);
			$sanitize = str_replace('"', "", $sanitize);
			
			$sanitize = (int) $sanitize;
			
			if(is_int($sanitize))
			{
				return $sanitize;
			}
			
			// return all data before a space
			$sanitize = substr($sanitize, 0, strpos($sanitize, ' '));
			
			// get only the numbers
			preg_match("/^\d+$/", $sanitize, $matches);	
			
			if(!empty($matches['0']))
			{
				return $matches['0'];	
			}
		}
		
		public function escape($arg)
		{
			return $this->mysqli->real_escape_string($arg);
		}
		
		public function query($query)
		{
			$this->result = $this->mysqli->query($query);	
			return $this->result;
		}
		
		public function fetch_row($result)
		{
			if($result) {
				return $result->fetch_assoc();	
			} else {
				return false;	
			}
		}
		
		public function affected_rows()
		{
			return $this->mysqli->affected_rows;	
		}
		
		public function num_rows($result)
		{
			if($result) {
				return $result->num_rows;	
			} else {
				return 0;	
			}	
		}
		
		public function error()
		{
			return $this->mysqli->error;
		}	
		
		public function error_number()
		{
			return $this->mysqli->errno;	
		}
		
		public function insert_id()
		{
			return $this->mysqli->insert_id;	
		}
			
	}
	
?>