<?php
include 'include/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Recipe Post</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./resources/styles/index.css'>
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

    <main id="register-page">
        <p id="userLogin">Welcome to Recipe Dump!</p>
        <form class="login--form"  id="login-form" action="login/create-account/createAccount.php" method="POST">
            <input placeholder="username" type="text" name="username" required autofocus><br>
            <input placeholder="password" type="password" name="password" min="12" required><br>
            <input type="text" name="favorite_ingredients" placeholder="Favorite Ingredients"><br>
            <input type="text" name="allergies" placeholder="Allergies"><br>
            <input type="submit" class="submit">
        </form>
        <p id="new-user">Already have an account? <a href="user-login.php">Sign in</a></p>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./resources/scripts/index.js"></script>
</body>
</html>