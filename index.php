<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style type="text/css">
		.sortbyfield{
	    	margin: 20px;
	    }
	</style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Show Episodes</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Show</a>
                    </div>
					<div class="sortbyfield">
					   <div class="dropdown">
					        <a data-target="#" href="index.php" data-toggle="dropdown" class="dropdown-toggle">Sort By <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href='index.php?sortfield=ModifiedDate DESC'>Latest Mods</a></li>
					            <li><a href='index.php?sortfield=ShowName ASC'>Show Name</a></li>
					        </ul>
					    </div>
					</div>		                    
                    <?php
                    //Setup field to sort database or use default field
                    if(isset($_GET["sortfield"]) && !empty(trim($_GET["sortfield"]))){
                    	$sortField = trim($_GET["sortfield"]);	                    
                    } else {
                    	$sortField = "ModifiedDate DESC";
                    }
                    // Include config file
                    require_once 'config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tvEpisodes ORDER BY ". $sortField ;
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-hover'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Show Name</th>";
                                        echo "<th>Next Episode</th>";
                                        echo "<th>Season</th>";
                                        echo "<th>Show Source</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['ShowName'] . "</td>";
                                        echo "<td>" . $row['NextEpisode'] . "</td>";
                                        echo "<td>" . $row['Season'] . "</td>";
                                        echo "<td>" . $row['ShowSource'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?ID=". $row['ID'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?ID=". $row['ID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?ID=". $row['ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>