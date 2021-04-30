<?php
	session_start();
	
	date_default_timezone_set("America/New_York");
		$now = date("Y-m-d h:i:sa");
	include_once "connection.php";
	if(!isset($_SESSION['visit'])){
		$query = "INSERT INTO BORROWING (BOR_NO,BDTIME)
        VALUES ('NULL','".$now."')";

	    if ($conn->query($query) === FALSE) {
	    	echo "Error: ". mysqli_error($conn);
	        }
	    else{
	    	$_SESSION['visit'] = TRUE;
	    	$_SESSION['borTime'] = $now;
	    	$_SESSION['currentBor'] = $conn->insert_id;
	    	//echo "".$_SESSION['currentBor']."";
	    }
	    
	}
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
       		<h2 class="jumbotron text-center">Check Out Document</h2>
       	</div>
       	<div class="row">
       		<form action="checkoutDocument.php" method="post" name="selectWhat">
	       		<div >
	       			<input class="btn btn-primary btn-lg col-sm-5" type="submit" name="selectWhat" value="Your Reservations">
	       		</div>
	       		<div class="col-sm-2">
	            </div>
	       		<div>
	       			<input class="btn btn-primary btn-lg col-sm-5" type="submit" name="selectWhat" value="Your Current Borrowed List">
	       		</div>
       		</form>
       	</div>
       </div>
	<br><br>
		<span id="allReservation">
    	<?php
    		function displayCurrentRes($connect){
    			include_once "connection.php";

				echo"<div class=\"container\"><h3>Your Current Reservations</h3>";

				$query = "SELECT * FROM RESERVES NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE RID ='".$_SESSION['rid']."'";

				$result = $connect->query($query);
			    if ($result->num_rows> 0) {
			    	echo "<form action=\"checkoutDocument.php\" method=\"post\" name=\"checkOut\">
			    		<table class=\" table table-striped table-hover\">
			    			<tr><th>Serial No.</th>
				    			<th>Reader ID</th>
				    			<th>Reservation No</th>
				    			<th>Document ID</th>
				    			<th>Copy Number</th>
				    			<th>Branch Name</th>
				    			<th>Title</th>
				    			<th>Action</th>
			    			</tr>";
			    			$counter =1;
			    			$docName = 3000;
			    	while ($row=$result->fetch_assoc()) {
			    		$docToRemove = $row['DOCID'];
			    		$docToRemove .=",". $row['COPYNO'];
			    		$docToRemove .=",". $row['LNAME'];
			    		$docToRemove .=",". $row['TITLE'];
			    		$docToRemove .=",". $row['RESERVATION_NO'];
			    		$docToRemove .=",". $row['BID'];
			    		echo "<tr><td>".$counter."</td>
			    					<td>".$row['RID']."</td>
			    					<td>".$row['RESERVATION_NO']."</td>
			    					<td>".$row['DOCID']."</td>
			    					<td>".$row['COPYNO']."</td>
			    					<td>".$row['LNAME']."</td>
			    					<td>".$row['TITLE']."</td>
			    					<td><input type=\"checkbox\" id=\"$docName\" name=\"$docName\" value=\"$docToRemove\">
										</td>
			    				</tr>";
			    				$counter++;
			    				$docName++;
			    	}
			    	echo "</table><br><br>";

			    	echo "<input class=\"btn btn-info btn-block\" type=\"submit\" name=\"checkOut\" value=\"Check Out\"><br><br></form></div>";
			    }
			    else{
			    	echo "<div class=\"alert alert-info\">
								  <strong>Hi There!</strong> You have no reservations at this point
								</div><br><br>";
			    }
    		}	
		?>
    </span>

	 
	
		<span id="allBorrows">
    	<?php
    		function displayCurrentBor($connect){
    			include_once "connection.php";

				echo"<div class=\"container\"><h3>You Have Borrowed The Following Books</h3>";

				$query = "SELECT * FROM BORROWS NATURAL JOIN BORROWING NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE RID ='".$_SESSION['rid']."' AND RDTIME IS NULL";

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
			    				</tr>";
			    				$counter++;
			    	}
			    	echo "</table></div><br><br>";
			    }
			    else{
			    	echo "<div class=\"alert alert-info\">
								  <strong>Hi There!</strong> You have no present borrowings.
								</div><br><br></div>";
			    }
    		}
    	?>
    </span>
    
</body>
</html>
<!-- ==============================================================check OUT================================================== -->

<?php
	if(isset($_POST['selectWhat'])){
		if($_POST['selectWhat']=="Your Reservations"){
			displayCurrentRes($conn);
		}
		else{
			displayCurrentBor($conn);
		}
	}

	if (isset($_POST['checkOut'])){
		$i = 3000;
		while ($i<3011){
			if(!empty($_POST["$i"])){

				$query3 = "SELECT COUNT(RID) as NOB FROM BORROWS NATURAL JOIN BORROWING WHERE RID = ".$_SESSION['rid']." AND RDTIME IS NULL";

				$result = $conn->query($query3);

				$noOfReservations = $result->fetch_assoc();

				if($noOfReservations['NOB']==10){
					echo "<div class=\"container alert alert-danger\">
								  <strong>Sorry!</strong> You Cannot Borrow More Than 10 Documents.
								</div><br><br>";
				}

				else{
					$cart = explode(",",$_POST["$i"]);
					$title = $cart[3];
					$docid = $cart[0];
					$copyno = $cart[1];
					$lname = $cart[2];
					$res_no = $cart[4];
					$bor_no = $_SESSION['currentBor'];
					$bid = $cart[5];
					$rid = $_SESSION['rid'];

					$query = "INSERT INTO BORROWS (BOR_NO, DOCID, COPYNO, BID, RID) VALUES ('".$bor_no."', '".$docid."','".$copyno."','".$bid."','".$rid."')";

					if ($conn->query($query) === FALSE) {
						echo "Error: ". mysqli_error($conn);
			    	}
			    	else{
			    		echo "<div class=\"container alert alert-success\">
										  <strong>Great!</strong> ".$title." with DOCID ".$docid." and COPYNO ".$copyno." borrowed from ".$lname."
											</div><br><br>";
	    			}

	    			$query = "DELETE FROM RESERVES WHERE RESERVATION_NO =".$res_no." AND DOCID=".$docid." AND  COPYNO=".$copyno." AND BID=".$bid." AND RID=".$_SESSION['rid']."";

					if ($conn->query($query) === FALSE) {
			    			echo "Error: ". mysqli_error($conn);
			    	}
				}
			}
			$i++;
    	}
    	displayCurrentBor($conn);
    }
?>