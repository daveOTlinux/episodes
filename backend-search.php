<?php
// Include config file
require_once 'config.php';
 
// Escape user inputs for security
$term = mysqli_real_escape_string($mysqli, $_REQUEST['term']);
 
if(isset($term)){
    // Attempt select query execution
    $sql = "SELECT * FROM tvEpisodes WHERE ShowName LIKE '" . $term . "%'";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['ShowName'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found</p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }
}
 
// Close connection
$mysqli->close();
?>