<?php
	
	if(count(get_included_files()) ==1) exit("Direct access not permitted.");
	
	$cal_tbl = "
				CREATE TABLE IF NOT EXISTS `calendar` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` varchar(160) NOT NULL,
				  `description` text NOT NULL,
				  `start` datetime NOT NULL,
				  `end` datetime NOT NULL,
				  `allDay` varchar(5) NOT NULL,
				  `color` varchar(7) NOT NULL,
				  `url` varchar(255) NOT NULL,
				  `category` varchar(200) NOT NULL,
				  `repeat_type` varchar(20) NOT NULL,
				  `user_id` int(11) NOT NULL,
				  `repeat_id` int(11) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				";
	
	$users_tbl = "
				CREATE TABLE IF NOT EXISTS `users` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `username` varchar(255) NOT NULL,
				  `password` varchar(64) NOT NULL,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `username` (`username`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
				";
					
$file_write = 
"<?php
	
	// DB Connection Configuration
	define('DB_HOST', '".$f_db_host."'); 
	define('DB_USERNAME', '".$f_db_username."'); 
	define('DB_PASSWORD', '".$f_db_password."'); 
	define('DATABASE', '".$f_db_name."'); 
	define('TABLE', 'calendar');
	define('USERS_TABLE', 'users');
	
	define('SITE_FILES_URL', '".$f_site_url."');
	
	// Default Categories
	".'$categories = '.'array("General","Party","Work", "Letters & Arts");'."
	
?>";

	$file = dirname(__FILE__).'/connection.php';
	
	$write = file_put_contents($file, $file_write);
	
	if($write == true)
	{
		$con->query($cal_tbl);
		$con->query($users_tbl);
		
		$sha1 = sha1($f_db_admin_password);
		
		// prevent empty users from being dumped
		if(strlen($f_db_admin_username) !== 0 && strlen($f_db_admin_password) >= 6)
		{
			$dump_users_table = $con->query( 
			"
				INSERT INTO `users` (`id`, `username`, `password`) VALUES
				(NULL, '$f_db_admin_username', '$sha1');
			");	
		}
		
		$message = '<div class="alert alert-success">The installation was a success. Thank you for choosing AFFC</div>';
		$finish = true;
						
	} else {
		$finish = false;
		$message = '<div class="alert alert-danger">Installation Failed: Cannot create configuration file. Try manual install using this data</div>';		
	}
	
	
?>