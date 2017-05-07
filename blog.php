<?php
	
	require 'db_conn.php';

	session_start();
	if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
		
		$uname = $_SESSION['user_id'];

		//	Submit Blog Post
		if(isset($_POST['blogPost']) and isset($_POST['title'])){
			$title = htmlentities($_POST['title']);
			$post = htmlentities($_POST['blogPost']);
			
			if($title != "" && $post != ""){
				$time = date("M d, Y", time());
				$reg_query = "INSERT INTO posts(username, time, title, post) VALUES ('".mysql_real_escape_string($uname)."','".$time."','".mysql_real_escape_string($title)."','".mysql_real_escape_string($post)."')";
				
				if($run_query = mysql_query($reg_query)){
					echo "Post successful";
				}else{
					echo mysql_error();
					echo "Sorry, post failed.";
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
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>tinymce.init({ 
		selector:'textarea'
	});
	</script>
</head>
<body>
	<?php
	require_once("includes/header.php");
	?>
	
	<section id="main">

		<div id="center">

			<?php
				if(isset($_SESSION['user_id'])){
					echo '<form action="blog.php" method="GET">
					Title: <input type="text" name="title"><br />
					<textarea rows="25" cols="85" name="blogPost" value="" ></textarea>

					<br />
					<input type="submit" value="Submit Post">
				</form>
				<br />';
				}else{
					echo 'You must login in order to post a blog.';
				}

			?>
		</div>

	</section>
	<?php 
		require_once("includes/footer.php");
	?>
</body>
</html>