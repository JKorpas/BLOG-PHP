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

		

		<div id="center">
			<?php
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
								$post = html_entity_decode($post);
								echo "<div class=\"recent\"><h4>".$title."</h4><h5>".$time."</h5><div class=\"post\">".$post."</div><br /><br /></div>";
							}
						}
					}
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