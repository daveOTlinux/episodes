<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Episodes Dashboard</title>
	<script src="jquery.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link href="style.css" rel="stylesheet">
	
	<script>
		 $(document).ready(function () {
		     $("#searchbox").on('keyup',function () {
		         var key = $(this).val();
		
		         $.ajax({
		             url:'fetch.php',
		             type:'POST',
		             data:'keyword='+key,
		             beforeSend:function () {
		                 $("#results").slideUp('fast');
		             },
		             success:function (data) {
		                 $("#results").html(data);
		                 $("#results").slideDown('fast');
		             }
		         });
		     });
		 });
    
</script>
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
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
			<div class="row" style="height: 100px;>
				<div class="col-sm-6">
					<div class="page-header clearfix">
						<h2 class="pull-left">Show Episodes</h2>
					</div>
				</div>
				<div class="col-sm-6">  		
					<a href="create.php" class="btn btn-success pull-right">Add New Show</a>
				</div>
			</div>
           <div class="row">    
					<div class="col-sm-6">
					   <div class="dropdown">
					        <a data-target="#" href="index.php" data-toggle="dropdown" class="dropdown-toggle">Sort By <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					            <li><a href='index.php?sortfield=ModifiedDate DESC'>Latest Mods</a></li>
					            <li><a href='index.php?sortfield=ShowName ASC'>Show Name</a></li>
					        </ul>
					    </div>
					</div>
					<div class="col-sm-6" id="content">
						<input type="search" name="keyword" placeholder="Search Names" id="searchbox">
						<div id="results">
							<!--<a href="post-location">Fetched Item</a>-->
						</div>
					</div>
				</div>
				<div class="row">
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
                                  echo "<th style='width: 10%'>ID</th>";
                                  echo "<th style='width: 40%'>Show Name</th>";
                                  echo "<th style='width: 5%'>Next Episode</th>";
                                  echo "<th style='width: 5%'>Season</th>";
                                  echo "<th style='width: 20%'>Show Source</th>";
                                  echo "<th style='width: 20%'>Action</th>";
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
</body>
</html>