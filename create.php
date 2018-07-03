<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$ShowName = $NextEpisode = $Season = $ShowSource = "";
$ShowName_err = $NextEpisode_err = $Season_err = $ShowSource_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate ShowName
    $input_ShowName = trim($_POST["ShowName"]);
    if(empty($input_ShowName)){
        $ShowName_err = "Please enter a Show Name.";
    } elseif(!filter_var(trim($_POST["ShowName"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $ShowName_err = 'Please enter a valid Show Name.';
    } else{
        $ShowName = $input_ShowName;
    }
    
    // Validate NextEpisode
    $input_NextEpisode = trim($_POST["NextEpisode"]);
    if(empty($input_NextEpisode)){
        $NextEpisode_err = 'Please enter an Next Episode.';     
    } else{
        $NextEpisode = $input_NextEpisode;
    }
    
    // Validate Season
    $input_Season = trim($_POST["Season"]);
    if(empty($input_Season)){
        $Season_err = "Please enter the Season.";     
    } else{
        $Season = $input_Season;
    }

    // Validate ShowSource
    $input_ShowSource = trim($_POST["ShowSource"]);
    if(empty($input_ShowSource)){
        $ShowSource_err = "Please enter a Show Source.";
    } elseif(!filter_var(trim($_POST["ShowSource"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $ShowSource_err = 'Please enter a valid Show Source.';
    } else{
        $ShowSource = $input_ShowSource;
    }
    
    // Check input errors before inserting in database
    if(empty($ShowName_err) && empty($NextEpisode_err) && empty($Season_err) && empty($ShowSource_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tvEpisodes (ShowName, NextEpisode, Season, ShowSource) VALUES (?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_ShowName, $param_NextEpisode, $param_Season, $param_ShowSource);
            
            // Set parameters
            $param_ShowName = $ShowName;
            $param_NextEpisode = $NextEpisode;
            $param_Season = $Season;
            $param_ShowSource = $ShowSource;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a a new show to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($ShowName_err)) ? 'has-error' : ''; ?>">
                            <label>ShowName</label>
                            <input type="text" name="ShowName" class="form-control" value="<?php echo $ShowName; ?>">
                            <span class="help-block"><?php echo $ShowName_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($NextEpisode_err)) ? 'has-error' : ''; ?>">
                            <label>Next Episode</label>
                            <textarea name="NextEpisode" class="form-control"><?php echo $NextEpisode; ?></textarea>
                            <span class="help-block"><?php echo $NextEpisode_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Season_err)) ? 'has-error' : ''; ?>">
                            <label>Season</label>
                            <input type="text" name="Season" class="form-control" value="<?php echo $Season; ?>">
                            <span class="help-block"><?php echo $Season_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ShowSource_err)) ? 'has-error' : ''; ?>">
                            <label>Show Source</label>
                            <input type="text" name="ShowSource" class="form-control" value="<?php echo $ShowSource; ?>">
                            <span class="help-block"><?php echo $ShowSource_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
