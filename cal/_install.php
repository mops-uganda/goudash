<?php
	if(isset($_POST['db_name']) && isset($_POST['db_username']) && isset($_POST['db_password']) && isset($_POST['db_host']) && isset($_POST['add_username']) && isset($_POST['add_password']))
	{
		$f_db_name = $_POST['db_name'];
		$f_db_username = $_POST['db_username'];
		$f_db_password = $_POST['db_password'];	
		$f_db_host = $_POST['db_host'];
		$f_db_admin_username = $_POST['add_username'];
		$f_db_admin_password = $_POST['add_password'];
		
		$f_site_url = $_POST['site_url'];
		
		include('includes/database.class.php');
		
		@$con = new connectMe($f_db_host, $f_db_username, $f_db_password, $f_db_name);

		$error = $con->mysqli->connect_errno;
		
		if($error == 2002)
		{ 
			$message = '<div class="alert alert-info">Unable to connect to database. Database name, username, password and host are wrong. Try again</div>';
			$finish = false;
		} elseif($error == 0) {
			
			$sdb = $con->mysqli->select_db($f_db_name);
			if($sdb == false)
			{
				$message = '<div class="alert alert-info">The database name does not exist. Create one and Try again</div>';
				$finish = false;
			} else {
				include('includes/inscheck.class.php');
				
				$insCheck->tables = array(
					'calendar' => array('id', 'title', 'description', 'start', 'end', 'allDay', 'color', 'url', 'category', 'repeat_type', 'user_id', 'repeat_id'),
					'users' => array('id', 'username', 'password')
				);
				
				@$c = $insCheck->check($con, $f_db_name, 'calendar');
				
				if($c === false)
				{
					// REJECT HERE
					$message = '<div class="alert alert-info">Please select another database name. Your database must be calendar ready</div>';
					$finish = false;
				} elseif($c === 'EMPTY_DB') {
					// IMPORT TABLES AND INSTALL HERE
					include('includes/install.data.php');
				} else {
					// INSTALLED
					// recheck with the connection.php file
					if(file_exists(rtrim(getcwd(), '/').'/includes/connection.php'))
					{ 
						include('includes/connection.php');
						
						$c = $insCheck->check($con, DATABASE, TABLE);
						
						if($c === true)
						{
							@$con = new connectMe(DB_HOST, DB_USERNAME, DB_PASSWORD, DATABASE);
							$error = $con->mysqli->connect_errno;
							if($error == 2002)
							{
								$finish = false;
								$message = '<div class="alert alert-info">The installer detected issues with database connection. The DB Name Field is OK, try username, password and host</div>';
							} else {
								$finish = true;
								$message = '<div class="alert alert-success">The installer detected that AFFC2 is already installed.</div>';	
							}
						} else {
							$finish = false;
							$message = '<div class="alert alert-info">The installer detected issues with calendar ready database. Try using another database</div>';	
						}
					} else {
						$message = '<div class="alert alert-warning">The installer detected that your data is valid and calendar ready (perhaps is already installed) but is unable to create configuration file, try creating it manually using this data</div>'; // rare case
						$finish = false;	
					}
					@$con = new connectMe(DB_HOST, DB_USERNAME, DB_PASSWORD, DATABASE);
					include('includes/install.data.php');
				}
			}	
		} elseif($error == 1049) {
			$message = '<div class="alert alert-info">Please choose a database name that you created and exist</div>';
			$finish = false;	
		} elseif($error == 1045) {
			 $message = '<div class="alert alert-info">The installer detected that the database is denying this user, try another user.</div>';
			$finish = false;
		} else {
			$message = '<div class="alert alert-info">Invalid data supplied. Try again</div>';
			$finish = false;		
		}
	} else {
		$f_db_name = '';
		$f_db_username = '';
		$f_db_password = '';	
		$f_db_host = '';
		$f_db_admin_username = '';
		$f_db_admin_password = '';
		$message = '';
		$finish = false;
		
		// Check for the existence of the connection.php file
		if(file_exists(rtrim(getcwd(), '/').'/includes/connection.php'))
		{ 
			include('includes/connection.php');
			include('includes/database.class.php');
			include('includes/inscheck.class.php');

			@$con = new connectMe(DB_HOST, DB_USERNAME, DB_PASSWORD, DATABASE);
			$error = $con->mysqli->connect_errno;
							
			$insCheck->tables = array(
				'calendar' => array('id', 'title', 'description', 'start', 'end', 'allDay', 'color', 'url', 'category', 'repeat_type', 'user_id', 'repeat_id'),
				'users' => array('id', 'username', 'password')
			);
							
			@$c = $insCheck->check($con, DATABASE, TABLE);

			if($c === true)
			{
				if($error == 2002)
				{
					$finish = false;
					$message = '<div class="alert alert-info">The installer detected issues with database connection. Reinstall</div>';
				} else {
					$finish = true;
					$message = '<div class="alert alert-success">The installer detected that AFFC2 is already installed.</div>';	
				}
			} else {
				$finish = false;
				$message = '<div class="alert alert-info">The installer detected issues with calendar ready database. Try to reinstall</div>';	
			}
		} else {
			$message = '<div class="alert alert-info">The installer detected that you need to install</div>'; 
			$finish = false;	
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Paulo">
    <meta name="author" content="Paulo Regina">
    
	<title>Ajax Full Featured Calendar 2 Installation</title>
    
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/install.css" rel="stylesheet" media="screen">
</head>
<body>
	
    <div class="container">
    	<div class="wrap">
        
            <!-- page -->
            <div id="page">
            
				<div id="header"><h1 align="center">AFFC2 Install</h1></div>
                
                <?php if(isset($finish) && $finish == false) { ?>
                <p class="intro">
                Welcome to the one click install. Before start using ajax full featured calendar, we need some
            	information for the application configuration:
                </p>
                <?php } ?>
                
                <?php echo $message; ?>
                
                <?php if(isset($finish) && $finish == false) { ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table class="table table-striped">
                        <tr>
                            <th scope="row"><label>DB Name:</label></th>
                            <td>
                                <input name="db_name" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_name; ?>" />
                                <p class="help-block">The Database Name</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>DB User Name:</label></th>
                            <td>
                            	<input name="db_username" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_username; ?>" />
                                <p class="help-block">The Database Username</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>DB Password:</label></th>
                            <td>
                            	<input name="db_password" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_password; ?>" />
                                <p class="help-block">The Database Password</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>DB Host:</label></th>
                            <td>
                            	<input name="db_host" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_host; ?>" />
                                <p class="help-block">The Database Host</p>
                            </td>
                        </tr>
						<tr>
                            <th scope="row"><label>Site File URL:</label></th>
                            <td>
                            	<input name="site_url" class="form-control" id="req" type="text" size="32" value="<?php echo $f_site_url; ?>" />
                                <p class="help-block">Your website folder to store files. (Important for custom fields file upload)</p>
                            </td>
                        </tr>
                        <tr><th></th><td></td></tr>
                        <tr>
                            <th scope="row"><label>Login Username:</label></th>
                            <td>
                            	<input name="add_username" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_admin_username; ?>" />
                                <p class="help-block">Your username to login to the system</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Login Password:</label></th>
                            <td>
                            	<input name="add_password" class="form-control" id="req" type="text" size="32" value="<?php echo $f_db_admin_password; ?>" />
                                <p class="help-block">Your  password (*Make sure it is longer than 6 Characters)</p>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-primary pull-right" name="e_install" value="Install" />
                </form>
                
                <p class="help-block">Please Note: If you see this install, its because ajax full featured calendar is not installed yet. Can't use this? Fill up (or created one) connection.php manually from /includes/.</p>
                <?php } ?>
                <div class="clear"></div>
                
            </div>
            
		</div>
            
	</div>
            
</body>        
</html>