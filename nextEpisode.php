<?php
	// Check existence of id parameter before processing further
	if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){		// Include config file
		require 'config.php';
		
		// Prepare a select statement
		$sql = "SELECT * FROM tvEpisodes WHERE ID = ?";

		if($stmt = $mysqli->prepare($sql)){
					   
		     // Bind variables to the prepared statement as parameters
		     $stmt->bind_param("i", $param_ID);
		     
		     // Set parameters
		     $param_ID = trim($_GET["ID"]);
		     
		     // Attempt to execute the prepared statement
			if($stmt->execute()){
		         $result = $stmt->get_result();
		         
		         if($result->num_rows == 1){
		             /* Fetch result row as an associative array. Since the result set
		             contains only one row, we don't need to use while loop */ 
		             $row = $result->fetch_array(MYSQLI_ASSOC);
		             
		             // Retrieve individual field value
		             $ID = $row["ID"];
		             $currentEpisode = $row["NextEpisode"];
		             
		         } else{
		             // URL doesn't contain valid id parameter. Redirect to error page
		             header("location: error.php");
		             exit();
		         }
		         
		     } else{
		         echo "Oops! Something went wrong. Please try again later.";
		     }
			// Close statement
			$stmt->close();
		}
    
		//Do the math to generate the next Episode number
		$temp = 1 + intval(ltrim($currentEpisode, "a..zA..Z"));
		if($temp<10){
			$NextEpisode = "E0" . strval($temp);		
		} else{
			$NextEpisode = "E" . strval($temp);				
		}

		// Prepare an update statement to increment to next Episode
		$sql = "UPDATE tvEpisodes SET NextEpisode=? WHERE ID=?";
	    
		if($stmt = $mysqli->prepare($sql)){
			// Bind variables to the prepared statement as parameter
			$stmt->bind_param("si", $param_NextEpisode, $param_ID);
			  
			// Set parameters
			$param_NextEpisode = $NextEpisode;        
			$param_ID = $ID;
			  
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Records updated successfully. Redirect to landing page
					header("location: index.php");
					exit();
					    
				} else{
				    // URL doesn't contain valid id parameter. Redirect to error page
				    header("location: error.php");
				    exit();
				}
			// Close statement
			$stmt->close();      
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
		// Close connection
		$mysqli->close();
	} else{
	    // URL doesn't contain id parameter. Redirect to error page
	    header("location: error.php");
	    exit(); 
	} 
?>