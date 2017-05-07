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
				//	Display users five most recently submitted blog posts
				if(isset($_GET['user'])){
					$uname = mysql_real_escape_string(($_GET['user']));
					
					if($query = mysql_query("SELECT username FROM users WHERE username='".$uname."'")){
						$query_row = mysql_fetch_assoc($query);
						$name = $query_row['username'];
						
						if($name == $uname){
							echo "<center><h2>".htmlentities($uname)."'s Blog</h2></center>";
							
							if ($query = mysql_query("SELECT id, username, time, title, post FROM posts WHERE username='".$uname."' ORDER BY id DESC LIMIT 5")) {
								
								if(mysql_num_rows($query) == 0){
									echo "User has no posts.";
								
								}else{
									
									while ($queryrow = mysql_fetch_assoc($query)){
										$id = $queryrow['id'];
										$username = $queryrow['username'];
										$title = $queryrow['title'];
										$post = $queryrow['post'];
										$time = $queryrow['time'];
										
										if(strlen($post) > 1000){
											$post = substr($post, 0, 1000)."...";
										}
										
										$post = $post." <a href=\"read.php?post=".$id."\">Read</a>";

										echo "<div class=\"recent\"><h4>".$title."</h4><h5>".$time."</h5><div class=\"post\">".$post."</div><br /><br /></div>";
								
									}
								}
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