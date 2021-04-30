<?php
	session_start();
	
	date_default_timezone_set("America/New_York");
	$now = date("Y-m-d H:i:s");
	//echo $now;
	include_once "connection.php";
	if(!isset($_SESSION['visited'])){
		$query = "INSERT INTO RESERVATION (RES_NO,DTIME)
        VALUES ('NULL','".$now."')";

	    if ($conn->query($query) === FALSE) {
	    	echo "Error: ". mysqli_error($conn);
	        }
	    else{
	    	$_SESSION['visited'] = TRUE;
	    	$_SESSION['resTime'] = $now;
	    	$_SESSION['currentRes'] = $conn->insert_id;
	    }
	    
	}
	if(isset($_POST['readerLogout'])){
		session_destroy();
		header("Location: index.php"); 
		exit();
	}
	if(isset($_POST['back'])){
		//$_SESSION['visited'] = FALSE;
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
    <title>Search a Document</title>

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
       		<h2 class="jumbotron text-center">Search Document</h2>
       	</div>
       <div class="row">
       		<div class="form-group col-sm-2">
       		</div>
       	     <span class="form-group col-sm-8" id="searchDoc">       
		        <form action="searchDocument.php" method="post" name="searchDocument" placeholder="search a document">
		        	<div class="form-group">
		        		<input class="form-control col-sm-8" type="text" name="searchTerm" placeholder="search by ID or Publisher Name or Title">
		        		<br><br>
		        		<input  class="btn btn-success btn-block" type="submit" name="submitSearch" value="search">
		        	</div>
		        	
		        	<br><br>
		        </form>
		    </span>
       </div>
       <div class="row">
       	 <span id="reserveDoc">       
	        <form action="searchDocument.php" method="post" name="reserveDocument">
	        	<?php
					if (isset($_POST['submitSearch']) && empty($_POST['searchTerm'])==FALSE){
					include_once "connection.php";

					$searchTerm = $_POST['searchTerm'];

				    $query = "SELECT * FROM DOCUMENT NATURAL JOIN PUBLISHER NATURAL JOIN COPY NATURAL JOIN BRANCH WHERE (TITLE LIKE '%".$searchTerm."%' OR DOCID='".$searchTerm."' OR PUBNAME='".$searchTerm."')" ;
				    
				    $result = $conn->query($query);
				    if ($result->num_rows> 0) {
					    echo "<table class=\" table table-striped table-hover\">
					    		<tr><th> </th>
					    			<th>Title</th>
					    			<th>Publishing Date</th>
					    			<th>Copy Number</th>
					    			<th>Publisher</th>
					    			<th>Library Name</th>
					    			<th>Position</th>
					    			<th>Availability</th>
					    		</tr>";
					    		$resDocNo = 0;
					        while ($row=$result->fetch_assoc()) {
					        	$docInfo = $row['TITLE'];
					        	$docInfo .=",". $row['DOCID'];
					        	$docInfo .=",". $row['BID'];
					        	$docInfo .=",". $row['COPYNO'];
					        	$docInfo .=",". $row['LNAME'];

					        	$status = "Available";
				    	 		$query2 = "SELECT * FROM RESERVES WHERE (DOCID =".$row['DOCID']." AND COPYNO =".$row['COPYNO']." AND BID =".$row['BID'].")";

				    	 		$result2 = $conn->query($query2);

				    	 		if ($result2->num_rows == 1){
				    	 			$status = "Reserved";
				    	 		}

				    	 		$query3 = "SELECT * FROM BORROWS NATURAL JOIN BORROWING WHERE (DOCID =".$row['DOCID']." AND COPYNO =".$row['COPYNO']." AND BID =".$row['BID']." AND RDTIME IS NULL)";

				    	 		$result3 = $conn->query($query3);
				    	 		
			    	 			if ($result3->num_rows > 0){
			    	 			$status = "Borrowed";
			    	 			}

				    	 		
					            echo "<tr><td><input type=\"checkbox\" id=\"$resDocNo\" name=\"$resDocNo\" value=\"$docInfo\"></td>
		  								<td> ".$row["TITLE"]."</td><td> ".$row["PDATE"]."</td><td> ".$row["COPYNO"]."</td><td> ".$row["PUBNAME"]."</td><td> ".$row["LNAME"]."</td><td> ".$row["POSITION"]."</td><td> ".$status."</td></tr>
					            ";
					            $resDocNo++;
					            $_SESSION['totalDis']=$resDocNo;
					        }
				        echo "</table></div>";
				        echo "<br><input class=\"container btn btn-info btn-block\" type=\"submit\" name=\"makeReservation\" value=\"Reserve\">";
				    }else {echo "There is no such document information in the database.";}

				    disCurrent($conn);
					}
				 ?>

	        </form>
	    </span>
	    <br><br>
       </div>
   </div>
       	<span id="allReservation">
	    	<?php
	    		function disCurrent ($connect){
	    			include_once "connection.php";

					echo"<div class=\"container\"><h3>Your Current Reservations</h3>";

					$query = "SELECT * FROM RESERVES NATURAL JOIN DOCUMENT NATURAL JOIN BRANCH WHERE RID ='".$_SESSION['rid']."'";

					$result = $connect->query($query);
				    if ($result->num_rows> 0) {
				    	echo "<form action=\"SearchDocument.php\" method=\"post\" name=\"cancelReservation\">
				    		<table class=\"table table-striped table-hover\">
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

				    	echo "<input class=\"btn btn-info btn-block\" type=\"submit\" name=\"cancelReservation\" value=\"Cancel\"><br><br></form></div>";
				    }
				    else{
				    	echo "<div class=\"alert alert-info\">
								  <strong>Hi There!</strong> You have no reservations at this point
								</div><br><br>";
				    }
	    		}
			?>
	    </span>

       </div>

		<br><br>

 </body>
</html>

<?php
	
	//============================================================Insertion into Reserves Table===============================================
	if (isset($_POST['makeReservation'])) {
		include_once "connection.php";

		
			$i = 0;
			while ($i<$_SESSION['totalDis']){
				if(isset($_POST["$i"])){

					$query3 = "SELECT COUNT(RID) as NOR FROM RESERVES WHERE RID = ".$_SESSION['rid']."";

					$result = $conn->query($query3);

					$noOfReservations = $result->fetch_assoc();

					if($noOfReservations['NOR']==10){
						echo "<div class=\"container alert alert-danger\">
								  <strong>Sorry!</strong> You Cannot Make More Than 10 Reservations<br><br>.
								</div>";
					}

					else{
						$cart = explode(",",$_POST["$i"]);

						$title = $cart[0];
						$docid = $cart[1];
						$bid = $cart[2];
						$copyno = $cart[3];
						$lname = $cart[4];
						$rid = $_SESSION['rid'];
						$res_no = $_SESSION['currentRes'];

						$isReserved = "Available";
		    	 		$query2 = "SELECT * FROM RESERVES WHERE (DOCID =".$docid." AND COPYNO =".$copyno." AND BID =".$bid.")";

		    	 		$result2 = $conn->query($query2);

		    	 		if ($result2->num_rows == 1){
		    	 			$isReserved = "Reserved";
		    	 		}

		    	 		$query3 = "SELECT * FROM BORROWS NATURAL JOIN BORROWING WHERE (DOCID =".$docid." AND COPYNO =".$copyno." AND BID =".$bid." AND RDTIME IS NULL)";

		    	 		$result3 = $conn->query($query3);
		    	 		
	    	 			if ($result3->num_rows > 0){
	    	 				$isReserved = "Borrowed";
	    	 			}

		    	 		if($isReserved == "Reserved" || $isReserved=="Borrowed"){
		    	 			echo "<div class=\"container alert alert-danger\">
									  <strong>Sorry!</strong> ".$title." with DOCID ".$docid." and COPYNO ".$copyno." at ".$lname." is already ".$isReserved.".
									</div><br><br>";
		    	 		}
		    	 		else{
		    	 			$query = "INSERT INTO RESERVES (RID, RESERVATION_NO, DOCID, COPYNO, BID) VALUES ('".$rid."', '".$res_no."','".$docid."','".$copyno."','".$bid."')";
							if ($conn->query($query) === FALSE) {
				    			echo "Error: ". mysqli_error($conn);
				        	}
				        	else{
				        		echo "<div class=\"container alert alert-success\">
										  <strong>Great!</strong> ".$title." with DOCID ".$docid." reserved from ".$lname."
											</div><br><br>";
				        	}
		    	 		}
		    	 	}
					
				}
			$i++;
		}

		
		disCurrent($conn);
	}

	//==============================================================Cancel Reservation==================================================

	if (isset($_POST['cancelReservation'])){
		$i = 3000;
		while ($i<3011){
			if(!empty($_POST["$i"])){
				$cart = explode(",",$_POST["$i"]);
				$title = $cart[3];
				$docid = $cart[0];
				$copyno = $cart[1];
				$lname = $cart[2];
				$res_no = $cart[4];
				$bid = $cart[5];

				$query = "DELETE FROM RESERVES WHERE RESERVATION_NO =".$res_no." AND DOCID=".$docid." AND  COPYNO=".$copyno." AND BID=".$bid." AND RID=".$_SESSION['rid']."";

				if ($conn->query($query) === FALSE) {
		    			echo "Error: ". mysqli_error($conn);
		    	}
		    	else{
		    		echo "<div class=\"container alert alert-warning\">
										  <strong>Okay!</strong> ".$title." with DOCID ".$docid." and Copy Number ".$copyno." from ".$lname." removed from reservation.
											</div><br><br>";
	    		}
			}
	    	$i++;
		}
		disCurrent($conn);
    }
	
 ?>


