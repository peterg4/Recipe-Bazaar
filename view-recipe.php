<?php
include 'include/session.php';
require_once 'include/database.php';
  try {
    $recipe_ID = $_GET['ID'];
    $recipe_stmt = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $recipe_stmt->execute([$recipe_ID]);
    $recipe_result = $recipe_stmt->fetchAll();
   // print_r($recipe_result);
    if (count($recipe_result) === 1) {
      $recipe_name = $recipe_result[0]["Name"];
      $recipe_desc = $recipe_result[0]['Description'];
      $recipe_tags = $recipe_result[0]['Tags'];
      $recipe_dir = $recipe_result[0]['Directions'];
      $recipe_img = $recipe_result[0]['file_name'];

    } else {
      die('Invalid recipe ID');
    }
  } catch(PDOException $e) {
    die('Error connecting to database');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Recipe Bazaar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="resources/styles/index.css">
    <link rel="stylesheet" href="resources/styles/profile.css">
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
		      <a href="user-login.php" class="navbar-link">👨 Login</a>
		  </li>
		<?php endif; ?>
      </ul>
    </nav>

    <main class="recipe-view--container">
      <img class="recipe-view--image" src=<?php echo"\"data:image/jpeg;base64,".base64_encode( $recipe_img )."\""?>/>
      <div>
        <h1 class="recipe-view--title">
          <?php echo $recipe_name ?>
        </h1>
        <section class="recipe-view--description">
          <h2>Description:</h2>
          <p><?php echo $recipe_desc ?></p>
          <h2>Directions:</h2>
          <p><?php echo $recipe_dir ?></p>
        </section>
        </div>
        <h4>⚠️ Comments and reviews under construction</h4>
      </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./resources/scripts/index.js"></script>
  </body>
</html>
