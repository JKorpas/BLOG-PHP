<?php

if (!isset($_SESSION['user_id'])) {
		echo '
			<header class="header">
			<nav class="nav">
				<ul class="menu">
			<li>
				<a href="index.php" id="currentPage">Home</a>
			</li>
			<!--<li>
				<a href="blog.php" id="menuitem">Blog</a>
			</li>-->
			<li>
				<a href="search.php" id="menuitem">Search</a>
			</li>
			<!--<li>
				<a href="account.php" id="menuitem">Account</a>
			</li>
			<li>
				<a href="#" id="menuitem">About</a>
			</li> -->
				</ul>
			</nav>
			<a href="login.php">Admin Panel</a>
			<!-- <a href="register.php">Sign up</a> -->
			</header>
			';
	}else{
		echo '
			<header class="header">
			<nav class="nav">
			<ul class="menu">
			<li>
				<a href="index.php" id="currentPage">Home</a>
			</li>
			<li>
				<a href="blog.php" id="menuitem">Add Post</a>
			</li>
			<li>
				<a href="search.php" id="menuitem">Search</a>
			</li>
			<li>
				<!-- <a href="account.php" id="menuitem">Account</a> -->
			</li>
			<!-- <li>
				<a href="#" id="menuitem">Admin Panel</a>
			</li> -->
				</ul>
			</nav>
			<a>'.$_SESSION['user_id'].'</a><a href="logout.php">logout</a>
			</header>
		';
	}

?>