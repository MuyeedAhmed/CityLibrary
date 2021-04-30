<?php
    session_start();
    if($_SESSION['adminFlag'] != 1){
        session_destroy();
        header("Location: index.php"); 
        exit();
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: index.php"); 
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Search a Document</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="adminMenu.php">City Library</a>
        </div>
        <ul class="nav navbar-nav" style="float:right">
            <li><button class="btn btn-default navbar-btn" onclick="location.href='adminMenu.php'">Home</button></li>
            <li class="navbar-text">Admin</li>
            <li><form action="searchDocumentAdmin.php" method="post" name="adminLogout">
                <input class="btn btn-danger navbar-btn" type="submit" name="logout" value="Log Out">
            </form></li>
        </ul>
      </div>
    </nav>
    <br><br>

    <div class="container">
	<div class="row">
   		<h2 class="jumbotron text-center">Search Document</h2>
   	</div>
   	<div class="row">
   		<div class="form-group col-sm-2">
   		</div>
   	     <span class="form-group col-sm-8" id="searchDoc">       
	        <form action="searchDocumentAdmin.php" method="post" name="searchDocument">
	        	<div class="form-group">
	        		<input class="form-control col-sm-8" type="text" name="searchTerm" placeholder="Search by ID or Publisher Name or Title" required>
	        		<br><br>
	        		<input  class="btn btn-success btn-block" type="submit" name="submitSearch" value="Search">
	        	</div>
	        	
	        	<br><br>
	        </form>
	    </span>
    </div>
    <div class="row">    
	<?php
		if (isset($_POST['submitSearch']) && empty($_POST['searchTerm'])==FALSE){
			include_once "connection.php";

			$searchTerm = $_POST['searchTerm'];

		    $query = "SELECT * FROM DOCUMENT NATURAL JOIN PUBLISHER NATURAL JOIN COPY NATURAL JOIN BRANCH WHERE (TITLE LIKE '%".$searchTerm."%' OR DOCID='".$searchTerm."' OR PUBNAME='".$searchTerm."')" ;
		    
		    $result = $conn->query($query);
		    if ($result->num_rows> 0) {
			    echo "<table class=\" table table-striped table-hover\">
			    		<tr>
			    			<th>Title</th>
			    			<th>Publishing Date</th>
			    			<th>Copy Number</th>
			    			<th>Publisher</th>
			    			<th>Library Name</th>
			    			<th>Position</th>
			    			<th>Availability</th>
			    		</tr>";
		        while ($row=$result->fetch_assoc()) {
		        	$isReserved = "Available";
	    	 		$query2 = "SELECT * FROM RESERVES WHERE (DOCID =".$row['DOCID']." AND COPYNO =".$row['COPYNO']." AND BID =".$row['BID'].")";

	    	 		$result2 = $conn->query($query2);

	    	 		if ($result2->num_rows == 1){
	    	 			$isReserved = "Reserved";
	    	 		}

		            echo "<tr>
							<td> ".$row["TITLE"]."</td><td> ".$row["PDATE"]."</td><td> ".$row["COPYNO"]."</td><td> ".$row["PUBNAME"]."</td><td> ".$row["LNAME"]."</td><td> ".$row["POSITION"]."</td><td> ".$isReserved."</td>
						</tr>";
		        }
		        echo "</table>";
		    }else {echo "<br><div class=\"alert alert-danger\">There is no such document in the database.</div>";}
		}
	?>
	</div>
	</div>
</body>
</html>

