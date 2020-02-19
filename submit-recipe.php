<?php
// User must be logged in to submit recipe
require 'include/session.php';
require_login();

// Teapot
if(strpos($_POST['Name'], 'tea') !== false){
  header("HTTP/1.0 418 I'm a teapot");
  exit;
}

if(isset($_FILES['image'])){
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false){
      $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

        /*
         * Insert image data into database
         */

        //DB details
        require 'include/database.php';

        //Insert image content into database
        $name = $_POST["Name"];
        $Desc = $_POST["Description"];
        $Tags = $_POST["Tags"];
        $Directions = $_POST["Directions"];

        $insert_stmt = $db->prepare('INSERT INTO posts (Name, Description, Tags, file_name, Directions) VALUES (?, ?, ?, ?, ?)');
        $insert = $insert_stmt->execute([$name, $Desc, $Tags, $imgContent, $Directions]);

        if($insert){
          header("Location: index.php");
        }else{

            echo "File upload failed, please try again.";
        }
    }else{
        echo "Please select an image file to upload.";
    }
} else {
  echo "Failed to find image";
}
?>
