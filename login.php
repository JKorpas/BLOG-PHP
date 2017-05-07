<?php
	require 'db_conn.php';

	session_start();

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


		<div id="center" style="text-align:right">
			
		<?php
			if(!isset($_SESSION['user_id'])){
				echo '
			<br />
			<form method="POST" action="login.php" style="text-align:right">
			Username: <input type="text" name="uname"/><br />
			Password: <input type="password" name="passwd"/><br />
			<input type="submit" value="submit" />
			</form>
			<!-- <a href="register.php" >Sign up</a> -->
			';
				}

			if(isset($_POST['uname']) && isset($_POST['passwd']) && $_POST['uname'] != null && $_POST['passwd'] != null){
				$uname = $_POST['uname'];
				
				if ($query = mysql_query("SELECT username, password, salt FROM users WHERE username='".mysql_real_escape_string($uname)."'")) {
					
					if(mysql_num_rows($query) == 0){	//	Username not in database
						echo "incorrect username/password";
					
					}else{
					
					//	Hash the submitted password with salt and compare it to hash stored in database
					while ($queryrow = mysql_fetch_assoc($query)){
						$passwd = hash('sha256', $queryrow['salt'].$_POST['passwd']);
						$username = $queryrow['username'];
						$password = $queryrow['password'];
					
						if ($uname == $username and $passwd == $password) {
							$_SESSION['user_id'] = $uname;
							header('Location: index.php');
						}else{
							echo "<br />Incorrect username/password";
						}
					}
				}
			}

		}

			?>
			
		</div>

	</section>
	<?php 
		require_once("includes/footer.php");
	?>
</body>
</html>