<?php
	/*********************************************************************************************************************************
	**********************************************************************************************************************************
	***** InstallCheck Database Class
	***** Author: Paulo Regina
	***** Author URI: www.pauloreg.com
	***** Description: This class requires the database.class.php and it checks if the selected database have tables and matches
	*****			   at least the required tables for installation
	***** Version: 2.0 - May 2015
	**********************************************************************************************************************************
	**********************************************************************************************************************************/
	
	class InstallCheck
	{
		// Tables from db
		public $tables = array(); 
		
		// Check table
		public function check($con, $db, $tbl)
		{
			$q = $con->query('show tables');
			$r = $con->results($q);
			$af_r = $con->affected_rows();
			
			if($af_r > 0)
			{
				$q2 = $con->query('SHOW COLUMNS FROM '.$tbl);
				if($q2 == false){return false;}
				$r2 = $con->results($q2);
				
				$r2_total = count($r2);
				$main_tbl = count($this->tables[$tbl]);
			
				foreach($r as $r_v)
				{
					// found at least 1 table
					if(in_array($r_v['Tables_in_'.$db], array_keys($this->tables)))
					{
						// check at all fields of main_tbl
						if($r2_total == $main_tbl)
						{
							return true;
						} else {
							return false;	
						}
					} else {
						return false;	
					}
				}
			} else {
				return 'EMPTY_DB';	
			}
		}
	}
	
	$insCheck = new InstallCheck();
	
?>