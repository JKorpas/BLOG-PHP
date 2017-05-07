<?php
	require 'db_conn.php';

	session_start();
	if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
		
		$uname = $_SESSION['user_id'];

		//	Submit Blog Post
		if(isset($_POST['blogPost']) and isset($_POST['title'])){
			$post_id = mysql_real_escape_string(($_GET['post']));
			$title = htmlentities($_POST['title']);
			$post = htmlentities($_POST['blogPost']);
			
			if($title != "" && $post != ""){
				$time = date("M d, Y", time());
				$reg_query = "UPDATE posts SET 'title'='".$title."', 'post'='".$post."' where 'id'=\'".$post_id."\'";
				
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
					echo '
					<form action="edit.php" method="POST">
					';
				}else{
					echo 'You must login in order to post a blog.';
				}
				require 'db_conn.php';

				session_start();
				//	Display blog post by id
				if(isset($_GET['post'])){
					$post_id = mysql_real_escape_string(($_GET['post']));
					
					if ($query = mysql_query("SELECT id, username, time, title, post FROM posts WHERE id='".$post_id."'")) {
						
						if(mysql_num_rows($query) == 0){
							echo "Post was not found";
						
						}else{
							
							while ($queryrow = mysql_fetch_assoc($query)){
								$username = $queryrow['username'];
								$title = $queryrow['title'];
								$post = $queryrow['post'];
								$time = $queryrow['time'];
								
								echo "Title: <input type=\"text\" name=\"title\" value=\"".$title."\">
								<br/>
								<br/>
								<textarea rows=\"25\" cols=\"85\"> ".html_entity_decode($post)."</textarea>
								<br />
								</form>
								<br />";
							}
						}
					}
				}
			
				if(isset($_SESSION['user_id'])){
					echo '
					<input type="submit" value="Submit Post">
					</form>
					<br/>';
				}

			?>
		</div>

	</section>
	<?php 
		require_once("includes/footer.php");
	?>
</body>
</html>