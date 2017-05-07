<?php

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
				if (!isset($_SESSION['user_id'])) {
					echo '
						Please sign in
					';
				}else{
					echo '
						</h2>'.$_SESSION['user_id'].'</h2><br />
						Email: <input /><br />
						Gender: <input /><br />
						Birthday: <input /><br />

						<input type="submit" value="Submit Changes">
					';
				}
			?>
			<a href="logout.php">logout</a>
			<a>
		</div>

	</section>
	<?php 
		require_once("includes/footer.php");
	?>
</body>
</html>