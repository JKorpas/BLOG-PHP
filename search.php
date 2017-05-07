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

			<form method="GET" action="search.php">
				Search by: <select name="category" >
					<option value="title">Title</option>
					<option value="user">User</option>
					<option value="content">Content</option>
				</select>
				<input name="query" type="text">
				<input type="submit" value="search">
			</form>

			<?php
				if(isset($_GET['category']) && isset($_GET['query']) && $_GET['category'] != "" && $_GET['query'] != ""){
					$cat = $_GET['category'];
					$category = "";
					$query = mysql_real_escape_string($_GET['query']);
					
					//	Determine category to search
					if($cat == "title"){
						$category = "title";
					
					}elseif ($cat == "user") {
						$category = "username";
					
					}elseif($cat == "content"){
						$category = "post";
					}

					if($category != ""){
						
						//	If searching by user, return links to matching users
						if($category == "username"){
							if ($query = mysql_query("SELECT username FROM users WHERE ".$category." LIKE '%".$query."%' ")) {
							
								if(mysql_num_rows($query) == 0){
									echo "Sorry, no results for ".htmlentities($_GET['query']).".";
								
								}else{
									
									while ($queryrow = mysql_fetch_assoc($query)){
										$username = $queryrow['username'];
										echo '<a href="profile.php?user='.$username.'">'.$username.'</a><br />';
										}
									}
								}
						
						//	If searching by title or content, return matching blog posts
						}else{
							if ($query = mysql_query("SELECT id, time, username, title, post FROM posts WHERE ".$category." LIKE '%".$query."%' ORDER BY id DESC")) {
							
								if(mysql_num_rows($query) == 0){
									echo "Sorry, no results for ".htmlentities($_GET['query']).".";
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
										if(isset($_SESSION['user_id'])){
											$post = $post." <a href=\"edit.php?post=".$id."\">Edit</a>";
										}
										echo "<div class=\"recent\"><h4>".$title." <a href=\"profile.php?user=".$username."\">".$username."</a></h4><h5>".$time."</h5><div class=\"post\">".html_entity_decode($post)."</div><br /><br /></div>";
									}

								}

							}
						}
					}else{
						echo htmlentities($cat)." is not valid category.";
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