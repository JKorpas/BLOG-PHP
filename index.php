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
				define('ENTITIES_PER_PAGE', 5);

				echo '
					<h2>Recent Posts</h2>
				';
				$SQL = "SELECT SQL_CALC_FOUND_ROWS * 
					   FROM posts 
					   ORDER BY id DESC 
					   LIMIT ".mysql_escape_string((int)$_GET['part']*ENTITIES_PER_PAGE).",".ENTITIES_PER_PAGE;
				
				if ($query = mysql_query($SQL)) {
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
						// w inny sposób pobieramy ilosc danych w bazie
						$SQL = "SELECT FOUND_ROWS() as Ilosc";
						$RES= mysql_query($SQL);
						list($entities) = mysql_fetch_row($RES);

						if($_GET['part']>0){ 
						   echo '<a href="?part='.($_GET['part']-1).'">Poprzednie</a> ';
						}
						 
						for($i = 0;$i<=floor($entities/ENTITIES_PER_PAGE);$i++){
						   echo '<a href="?part='.($i).'">[ '.($i+1).' ]</a> ';
						}
						if($_GET['part']<floor($entities/ENTITIES_PER_PAGE)){ 
						   echo ' <a href="?part='.($_GET['part']+1).'">Nastepne</a>';
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