<?php
	require 'db_conn.php';
	session_start();
	if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
		
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
					echo '
						<h2>Recent Posts</h2>
					';

					// Display the 5 most recently submitted posts
					if ($query = mysql_query("SELECT id, time, username, title, post FROM posts ORDER BY id DESC LIMIT 5")) {
						if (mysql_num_rows($query) == 0){
							echo "No Posts";
						}else{
							
							while ($queryrow = mysql_fetch_assoc($query)){
								$id = $queryrow['id'];
								$username = $queryrow['username'];
								$title = $queryrow['title'];
								$time = $queryrow['time'];
								$post = $queryrow['post'];
								
								if (strlen($post) > 1000){
									$post = substr($post, 0, 500)."...";
								}
								$post = html_entity_decode($post);
								$post = $post." <a href=\"read.php?post=".$id."\">Read</a>";
								if(isset($_SESSION['user_id'])){
									$post = $post." <a href=\"edit.php?post=".$id."\">Edit</a>";
								}
								echo "<div class=\"recent\"><h4>".$title." <a href=\"profile.php?user=".$username."\">".$username."</a></h4><h5>".$time."</h5><div class=\"post\">".$post."</div><br /><br /></div>";
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