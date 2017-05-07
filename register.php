<?php
	require 'db_conn.php';

	//	Register user
	if(isset($_POST['uname']) && isset($_POST['passwd']) && $_POST['uname'] != null && $_POST['passwd'] != null){
		$uname = htmlentities($_POST['uname']);
		$passwd = $_POST['passwd'];
		
		//	Check if username is avaiable
		if($query = mysql_query("SELECT username FROM users WHERE username='".mysql_real_escape_string($uname)."'")){
			$query_row = mysql_fetch_assoc($query);
			$name = $query_row['username'];
			
			if($name == $uname){
				echo "Sorry username ".$uname." has been taken.";
			
			}else{
				//	Add user to database
				$salt = mcrypt_create_iv(16);	//	Create salt
				$hash = hash('sha256', $salt.$passwd);	//	Hash password
				$reg_query = "INSERT INTO users(username, password, salt) VALUES ('".mysql_real_escape_string($uname)."','".mysql_real_escape_string($hash)."','".$salt."')";
				
				if($run_query = mysql_query($reg_query)){
					echo "Registration successful";
				
				}else{
					echo "Sorry, registration failed.";
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/main.css" />
	<script type="text/javascript">
	
	</script>
</head>
<body>
	<?php
	require_once("includes/header.php");
	?>
	
	<section id="main">

			

		<div id="center">
			<?php
				if (!isset($_SESSION['user_id'])) {
					echo '
					<center>
						<form method="POST" action="register.php" style="text-align:right">
							Email: <input type="text" name="email"/><br />
							Username: <input type="text" name="uname"/><br />
							Password: <input type="password" name="passwd"/><br />
							Confirm Password: <input type="password" id="confirmpass" /><br />
						<input type="submit" value="Register" />
						</form>
					</center>
					';
				}else{
					echo '
						<h2>Notifications</h2>
					';
				}
			?>
			<a>
		</div>

	</section>
	<?php 
		require_once("includes/footer.php");
	?>
</body>
</html>