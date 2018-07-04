<?php

// Check existence of id parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM tvEpisodes WHERE ID = ?";
    
   if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["ID"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $ShowName = $row["ShowName"];
                $NextEpisode = $row["NextEpisode"];
                $Season = $row["Season"];
                $ShowSource	 = $row["ShowSource"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>											
<html lang="en">
<head>
	<title>View Record</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
	<link
		rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
		integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
		crossorigin="anonymous">
  	<script
  		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
  		integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
  		crossorigin="anonymous"></script>
	<script
		src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
		integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
		crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<link href="style.css" rel="stylesheet">
	
<!--        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style> -->
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row" style="height: 75px;">
                <div class="pt-2 col-sm-8">
                    <div class="page-header">
                        <h2>View Record</h2>
                    </div>
					</div>
					<div class="pt-2 col-sm-4">
						<?php  		
							echo "<a href='update.php?ID=". $row["ID"] . "' class='btn btn-success pull-right'>Edit Show</a>";
						?>
					</div>
				</div>
				<div class="row">	
	            <div class="form-group">
		            <label>Show Name</label>
		            <p class="form-control-static"><?php echo $row["ShowName"]; ?></p>
	            </div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label>Next Episode</label>
					</div>
					<div class="col-sm-1">
						<p class="form-control-static"><?php echo $row["NextEpisode"]; ?></p>
					</div>
					<div class="col-sm-1">
						<i class="fa fa-arrow-up" aria-hidden="true"></i>
					</div>
					<div class="col-sm-2"></div>								
					<div class="col-sm-3">
							<label>Season</label>
					</div>
					<div class="col-sm-1">
						<p class="form-control-static"><?php echo $row["Season"]; ?></p>
					</div>
					<div class="col-sm-1">
						<i class="fa fa-arrow-up" aria-hidden="true"></i>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label>Show Source</label>
						<p class="form-control-static"><?php echo $row["ShowSource"]; ?></p>
					</div>
				</div>
				<div class="row">                    
              <p><a href="index.php" class="btn btn-primary">Back</a></p>
            </div>        
        </div>
    </div>
</body>
</html>

