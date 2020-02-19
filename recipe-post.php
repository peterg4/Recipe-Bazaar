<?php
// User must be logged in to submit recipe
require 'include/session.php';
require_login();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Recipe Post</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./resources/styles/recipe-post.css'>
    <script src='main.js'></script>
</head>
<body>

    <nav collapsed="true">
        <span class="navbar-brand">
            <a href='./index.php'>Recipe 🥧Bazaar</a>
        </span>
        <button id="navbar-toggle"> 🍔</button>
        <ul class="navbar-items">
            <li class="navbar-item">
                <a href="index.php" class="navbar-link">🔎 Search</a>
            </li>
            <li class="navbar-item">
                <a href="recipe-post.php" class="navbar-link">➕ Add Recipe</a>
            </li>
			<?php if($logged_in): ?>
		        <li class="navbar-item">
			        <a href="profile.php" class="navbar-link">👨‍🍳 <?=get_user_information()['Username']?></a>
		        </li>
			<?php
			endif;
			if($logged_in):
				?>
		        <li class="navbar-item">
			        <a href="login/logout.php" class="navbar-link">Logout</a>
		        </li>
			<?php else: ?>
		        <li class="navbar-item">
			        <a href="user-login.html" class="navbar-link">👨 Login</a>
		        </li>
			<?php endif; ?>
        </ul>
    </nav>

    <p id="submitRecipe">Submit Recipe</p>
    <form action="submit-recipe.php" method="post" enctype="multipart/form-data" id="post-form">
        <input class="initial" placeholder="Name" type="text" name="Name"/><br>
        <input class="initial" placeholder="Description" type="text" name="Description"/><br>
        <input class="initial" placeholder="Image URL" type="file" name="image"/><br>
        <input class="initial" placeholder="Tags (Seperated by commas)" type="text" name="Tags"/><br>
        <textarea rows="10" cols="75" name="Directions" form="post-form">Enter Directions Here!</textarea>
       <br>

        <input type="submit" class="submit" name="submit"/>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./resources/scripts/index.js"></script>
</body>
</html>
