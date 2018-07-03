<?php
    if($_POST['keyword'] && !empty($_POST['keyword'])){
		// Include config file
	    require_once 'config.php';

        //$conn = mysqli_connect('localhost','root','','work'); //Connection to my database

        $keyword = $_POST['keyword'];
        $keyword="$keyword%";
        $query = "SELECT ID, ShowName FROM tvEpisodes WHERE ShowName like ? ORDER BY ShowName DESC";
        $statement = $mysqli->prepare($query);
        $statement->bind_param('s',$keyword);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows() == 0) // so if we have 0 records acc. to keyword display no records found
        {
            echo '<div id="item">Ah snap...! No results found :/</div>';
            $statement->close();
            $mysqli->close();

        }
        else {
			echo "<ul class='shownames'>";            
            $statement->bind_result($ID, $ShowName);
            while ($statement->fetch()) {  //outputs the records

					//echo "<input id='item$ID' onclick='location.href=`read.php?ID=$ID`' type='button' value='" . $ShowName . "'>";
					//echo "<li id='item$ID' onclick='location.href=`read.php?ID=$ID`'> $ShowName </li>";
					echo "<div class='showitem' id='item$ID' onclick='location.href=`read.php?ID=$ID`'> $ShowName </div>";
					
            }
			echo '</ul>';            
            $statement->close();
            $mysqli->close();
        };
    };
?>
