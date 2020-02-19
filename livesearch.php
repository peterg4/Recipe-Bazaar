<?php
// Attempt search query execution
require 'include/database.php';
try{
    if(isset($_REQUEST["term"])){
        // create prepared statement
        $sql = "SELECT * FROM posts WHERE name LIKE :term OR Description LIKE :term OR Tags LIKE :term";
        $stmt = $db->prepare($sql);
        $term = '%'.$_REQUEST["term"] . '%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
          echo "<section id=\"recipes\">";
            while($row = $stmt->fetch()){
              $id=$row["id"];
                echo "
                <article>
                  <img src=\"data:image/jpeg;base64,".base64_encode( $row["file_name"] )."\"/>
                  <div>
                    <h2>".$row["Name"]."</h2>
                    <p>".$row["Description"]."</p>
                    <a class=\"main--recipe-link\" href=\"./view-recipe.php?ID=".$id."\">View Recipe</a>
                  </div>
                </article>";
            }
            echo "</section>";
        } else{
            echo "<p>No matches found</p>";
        }
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Close statement
unset($stmt);

// Close connection
unset($db);
?>
