<?php
	session_start();

	include_once "connection.php";

	if(isset($_POST['readerLogout'])){
		session_destroy();
		header("Location: index.php"); 
		exit();
	}

	if(isset($_POST['back'])){
		unset($_SESSION['visit']);
		header("Location: readerMenu.php"); 
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
    <title>Check Out A Document</title>
   <style>
		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;
		}
		table {
			width:100%;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">City Library</a>
	    </div>
	    <ul class="nav navbar-nav" style="float:right">
	    	<li><form action="readerMenu.php" method="post" name="back">
					<input class="btn btn-default navbar-btn" type="submit" name="back" value="Home">
				</form></li>
	    	<li class="navbar-text"><?php echo $_SESSION["rname"]?></li>
	    	<li><form action="readerMenu.php" method="post" name="readerLogout">
					<input class="btn btn-danger navbar-btn" type="submit" name="readerLogout" value="Log Out">
				</form></li>    
	    </ul>
	  </div>
	</nav>
	<br><br>
	<div class="container">
		<br><br>
       <div class="row">
       		<h2 class="jumbotron text-center">Return Document</h2>
       	</div>
       	<div class="row">
       		<form action="returnDocument.php" method="post" name="selectWhat">
	       		<div >
	       			<input class="btn btn-primary btn-lg col-sm-5" type="submit" name="selectWhat" value="Present Borrowings">
	       		</div>
	       		<div class="col-sm-2">
	            </div>
	       		<div>
	       			<input class="btn btn-primary btn-lg col-sm-5" type="submit" name="selectWhat" value="Past Borrowings">
	       		</div>
       		</form>
       	</div>
       </div>
	<br><br>
	 <span id="presentBorrows">
    	<?php
    		function displayPresentBors($connect){
    			include_once "connection.php";

				echo"<div class=\"container\"><h3>Your Have Borrowed The Following Books</h3>";

				$query = "SELECT DISTINCT BOR_NO, BDTIME FROM BORROWS NATURAL JOIN BORROWING NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE (RID ='".$_SESSION['rid']."' AND RDTIME IS NULL) ORDER BY BOR_NO ASC";

				$result = $connect->query($query);
			    if ($result->num_rows> 0) {
			    	echo "<form action=\"returnDocument.php\" method=\"post\" name=\"returnDoc\">
			    		<table class=\" table table-striped table-hover\">
			    			<tr><th>Serial No.</th>
				    			<th>Reader ID</th>
				    			<th>Borrow No</th>
				    			<th>Documents</th>
				    			<th>Borrow Time</th>
				    			<th>Status</th>
				    			<th>Due By</th>
				    			<th>Fine</th>
				    			<th>Action</th>
			    			</tr>";
			    			$counter =1;
			    			$docName = 3000;
			    	while ($row=$result->fetch_assoc()) {
			    			$docToRemove = $row['BOR_NO'];
			    		echo "<tr><td>".$counter."</td>
			    					<td>".$_SESSION['rid']."</td>
			    					<td>".$row['BOR_NO']."</td><td>";

			    					$query2 = "SELECT * FROM BORROWS NATURAL JOIN BORROWING NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE (RID ='".$_SESSION['rid']."' AND BOR_NO = '".$row['BOR_NO']."' AND RDTIME IS NULL) ORDER BY BOR_NO ASC, DOCID ASC";
			    					$result2 = $connect->query($query2);
			    					if ($result2->num_rows> 0) {
			    						echo "
									    	<table >
									    			<tr><th>DOCID</th>
										    			<th>COPYNO</th>
										    			<th>LNAME</th>
										    			<th>TITLE</th>
									    			</tr>";
			    						while ($row2=$result2->fetch_assoc()){

								    		echo "<tr><td>".$row2['DOCID']."</td>
			    									  <td>".$row2['COPYNO']."</td>
			    									  <td>".$row2['LNAME']."</td>
			    									  <td>".$row2['TITLE']."</td></tr>";
			    						}
			    						echo "</table>";
			    					}
    					date_default_timezone_set("America/New_York");
						$now = date("Y-m-d H:i:s");
						
    					$dueby = date('Y-m-d H:i:s',strtotime('+1 days',strtotime($row['BDTIME'])));
    					$status = "You're Good";
    					$fine = 0;
    					if($now > $dueby){
    						$to_time = strtotime($now);
    						$from_time = strtotime($dueby);
							$duetime = round(($to_time - $from_time) / (60*60*24),2);
							
    						$status = "Already Due";
    						$fine = round(($duetime)*0.2,2)*$result2->num_rows;
    					}
			    					
						echo "</td><td>".$row['BDTIME']."</td>
									<td>".$status."</td>
									<td>".$dueby."</td>
									<td>$".$fine."</td>
									<td><input type=\"checkbox\" id=\"$docName\" name=\"$docName\" value=\"$docToRemove\">
										</td>
			    				</tr>";
			    				$counter++;
			    				$docName++;
			    	}
			    	echo "</table><br><br>";

			    	echo "<input class=\"btn btn-info btn-block\" type=\"submit\" name=\"returnDoc\" value=\"Return\"></form></div><br><br>";
			    }
			    else{
			    	echo "<div class=\"alert alert-info\">
								  <strong>Hi There!</strong> You have no present borrowings.
								</div><br><br></div>";
			    }
    		}
    	?>
    </span>
    <span id="pastBorrows">
    	<?php
    		function displayPastBors($connect){
    			include_once "connection.php";

				echo"<div class=\"container\"><h3>Your Borrowing History</h3>";

				$query = "SELECT * FROM BORROWS NATURAL JOIN BORROWING NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE RID ='".$_SESSION['rid']."' AND RDTIME IS NOT NULL ORDER BY BOR_NO ASC";

				$result = $connect->query($query);
			    if ($result->num_rows> 0) {
			    	echo "<table class=\" table table-striped table-hover\">
			    			<tr><th>Serial No.</th>
				    			<th>Reader ID</th>
				    			<th>Borrow No</th>
				    			<th>Document ID</th>
				    			<th>Copy Number</th>
				    			<th>Branch Name</th>
				    			<th>Title</th>
				    			<th>Borrow time</th>
				    			<th>Return time</th>
			    			</tr>";
			    			$counter =1;
			    	while ($row=$result->fetch_assoc()) {
			    		echo "<tr><td>".$counter."</td>
			    					<td>".$row['RID']."</td>
			    					<td>".$row['BOR_NO']."</td>
			    					<td>".$row['DOCID']."</td>
			    					<td>".$row['COPYNO']."</td>
			    					<td>".$row['LNAME']."</td>
			    					<td>".$row['TITLE']."</td>
									<td>".$row['BDTIME']."</td>
									<td>".$row['RDTIME']."</td>
			    				</tr>";
			    				$counter++;
			    	}
			    	echo "</table><br><br></div>";
			    }
			    else{
			    	echo "<div class=\"alert alert-info\">
								  <strong>Hi There!</strong> You have no borrowing history at this point
								</div><br><br></div>";
			    }
    		}
    	?>
    </span>
</body>
</html>

<?php
	if(isset($_POST['selectWhat'])){
		if($_POST['selectWhat']=="Present Borrowings"){
			displayPresentBors($conn);
		}
		else{
			displayPastBors($conn);
		}
	}

	if (isset($_POST['returnDoc'])){
		$i = 3000;
		while ($i<3011){
			if(isset($_POST["$i"])){
				$bor_no = $_POST["$i"];
				$rid = $_SESSION['rid'];
				date_default_timezone_set("America/New_York");
				$now = date("Y-m-d h:i:sa");

				$query = "UPDATE BORROWING SET RDTIME='".$now."' WHERE BOR_NO ='".$bor_no."' ";

				if ($conn->query($query) === FALSE) {
					echo "Error: ". mysqli_error($conn);
		    	}
		    	else{
		    		$query2 = "SELECT * FROM BORROWS NATURAL JOIN BORROWING NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE (RID ='".$_SESSION['rid']."' AND BOR_NO = '".$bor_no."' AND RDTIME='".$now."')";
		    		$result2 = $conn->query($query2);
		    		if ($result2->num_rows> 0) {
		    			while ($row2=$result2->fetch_assoc()){
		    				echo "
		    				<div class=\"container alert alert-success\">
										  <strong>THANKS!</strong> ".$row2["TITLE"]." with DOCID ".$row2["DOCID"]." and COPYNO ".$row2["COPYNO"]." returned to ".$row2["LNAME"]." at ".$now."
											</div><br><br>";
		    			}
		    		}
		    		
    			}

			}
			$i++;
    	}
    	displayPresentBors($conn);
    }
?>