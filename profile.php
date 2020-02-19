<?php
include 'include/session.php';

// Get the profile data for the specified user, otherwise get the logged in user's profile
if(isset($_GET['userid'])){
	$profile_user_id = $_GET['userid'];
}else{
	if($logged_in){
		$profile_user_id = $user_id;
	}else{
		die('Error: Not logged in and no userid specified');
	}
}

require_once 'include/database.php';

try{
	// Get profile data
	$profile_stmt = $db->prepare('SELECT Username, FavoriteIngredients, Allergies FROM Users WHERE ID = ?');
	$profile_stmt->execute([$profile_user_id]);
	$profile_data = $profile_stmt->fetchAll();
	if(count($profile_data) !== 1){
		die('Error: Invalid user ID');
	}else{
		$profile_data = $profile_data[0];
	}
	// Get profile picture
	$image_stmt = $db->prepare('SELECT name FROM tbl_images WHERE id = ?');
	$image_stmt->execute([$profile_user_id]);
	$image = $image_stmt->fetchAll();
	if(count($image) === 1){
		$profile_data['Image'] = $image[0]['name'];
	}else{
		$profile_data['Image'] = null;
	}
}catch(PDOException $e){
	die('Database error');
}

?>

<html lang="en">
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Profile</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel = "stylesheet" href="resources/styles/index.css">
    <link rel = "stylesheet" href="resources/styles/profile.css">
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
        <div>
            <h1><?=$profile_data['Username']?></h1>
	        <img class="recipe-view--image" src="data:image/jpeg;base64,<?=base64_encode($profile_data['Image'])?>">
        </div>
        <div class="d-flex">
            <section id="fav-ingredients" class="profile-list">
                <h2>My favorite ingredients:</h2>
                <?=$profile_data['FavoriteIngredients']?>
            </section>
            <section id="my-allergies" class="profile-list">
                <h2>My allergies:</h2>
	            <?=$profile_data['Allergies']?>
            </section>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./resources/scripts/profile.js"></script>
    <script>
        $(document).ready(function(){
            $('#insert').click(function(){
                var image_name = $('#image').val();
                if(image_name == '')
                {
                        alert("Please Select Image");
                        return false;
                }
                else
                {
                        var extension = $('#image').val().split('.').pop().toLowerCase();
                        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                        {
                            alert('Invalid Image File');
                            $('#image').val('');
                            return false;
                        }
                }
            });
        });
    </script>
  </body>
</html>
