<?php
include 'include/session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="./resources/styles/index.css" />
    <title>Recipe Bazaar</title>
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

    <main>
      <div class="search-box">
        <input type="text" name="search" autocomplete="off" placeholder="Search..." />
        <div class="result"></div>
      </div>

      <section id="recipes">
      <?php
      require 'include/database.php';
        // create prepared statement
        $sql = "SELECT * FROM posts";
        $stmt = $db->prepare($sql);

        $stmt->execute();
        if($stmt->rowCount() > 0){
        //  echo "<section id=\"recipes\">";
            while($row = $stmt->fetch()){
               // header("Content-type: image/jpg");
              //  $img = $row["file_name"];
                $id=$row["id"];
                echo "
                <article class=\"main--recipe-container\">
                  <img src=\"data:image/jpeg;base64,".base64_encode( $row["file_name"] )."\"/>
                  <div>
                    <h2 class=\"main--recipe-name\">".$row["Name"]."</h2>
                    <p class=\"main--recipe-desc\">".$row["Description"]."</p>
                    <a class=\"main--recipe-link\" href=\"./view-recipe.php?ID=".$id."\">View Recipe</a>
                  </div>
                </article>";
            }
        //    echo "</section>";
        }

      // Close statement
      unset($stmt);

      // Close connection
      unset($db);
      ?>
      </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./resources/scripts/index.js"></script>
    <script src="./resources/scripts/search.js"></script>
  </body>
</html>
