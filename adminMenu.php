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
	<title>Admin Menu</title>
	
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">City Library</a>
	    </div>
	    <ul class="nav navbar-nav" style="float:right">
	    	<li class="navbar-text">Admin</li>
	    	<li><form action="adminMenu.php" method="post" name="adminLogout">
				<input class="btn btn-danger navbar-btn" type="submit" name="logout" value="Log Out">
			</form></li>
	    </ul>
	  </div>
	</nav>
	<br>
	<div class="container">
		<br><br>
       <div class="row">
       		<h2 class="jumbotron text-center">Admin Home Page</h2>
       	</div>
       	<div class="row">
       		<div >
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='AddDocument.php'">Add a Document</button>
       		</div>
       		
       		<div>
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='AddDocumentCopy.php'">Add a Copy of a Document</button>
       		</div>
       		
       		<div>
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='ReaderAdd.php'">Add a Reader</button>
       		</div>
       		
       		<div>
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='SearchDocumentAdmin.php'">Search A Document</button>
       		</div>
       	</div>
		<br><br>
		
	</div>
	
	<div class="container">
	<div class="row">
		<div class="col-sm-8">
		<table border = 1 class="table table-bordered table-condensed">

				<tr>
					<th colspan="2" align="center">
						<h4 align="center">What would you like to know?</h4>
					</th>
				</tr>
				<tr>
				<form action="adminMenu.php" method="post" name="q1">
		            <td>Q1: Top <input type="number" name="q1N" min="1" required> most frequent borrowers of 
		            <select name="q1bid">
		                <?php
		                include_once "connection.php";
		                $query = "SELECT BID, LNAME FROM BRANCH";
		                
		                $result = $conn->query($query);
		                if ($result->num_rows> 0) {
		                     while ($row=$result->fetch_assoc()) {
		                        echo "<option value=\"".$row['BID']."\">".$row['LNAME']."</option>";
		                    }
		                }else {
		                    echo "There are no branch in the database.";
		                }
		                ?>
		            </select></td>
		            <td><input type="submit" name="q1" class="btn btn-info" value="GO"></td>
				</form>
			
			</tr>
			<tr>
				<form action="adminMenu.php" method="post" name="q2">
		            <td>Q2: Top <input type="number" name="q2N" min="1" required> most frequent borrowers overall.</td>
		            <td><input type="submit" name="q2" class="btn btn-info" value="GO"></td>
				</form>
			
			</tr>
			<tr>
			<div class='q3'>
				<form action="adminMenu.php" method="post" name="q3">
		            <td>Q3: Top <input type="number" name="q3N" min="1" required> most borrowed books of 
		            <select name="q3bid">
		                <?php
		                include_once "connection.php";
		                $query = "SELECT BID, LNAME FROM BRANCH";
		                
		                $result = $conn->query($query);
		                if ($result->num_rows> 0) {
		                     while ($row=$result->fetch_assoc()) {
		                        echo "<option value=\"".$row['BID']."\">".$row['LNAME']."</option>";
		                    }
		                }else {
		                    echo "There are no branch in the database.";
		                }
		                ?>
		            </select></td>
		            <td><input type="submit" name="q3" class="btn btn-info" value="GO"></td>
				</form>
			</div>
			</tr>
			<tr>
			<div class='q4'>
				<form action="adminMenu.php" method="post" name="q4">
		            <td>Q4: Top <input type="number" name="q4N" min="1" required> most borrowed books overall.</td>
		            <td><input type="submit" name="q4" class="btn btn-info" value="GO"></td>
				</form>
			</div>
			</tr>
			<tr>
			<div class='q5'>
				<form action="adminMenu.php" method="post" name="q5">
		            <td>Q5: Top 10 most popular books of year <input type="number" name="q5year" min="2000" max="2021" required>.</td>
		            <td><input type="submit" name="q5" class="btn btn-info" value="GO"></td>
				</form>
			</div>
			</tr>
			<tr>
			<div class='q6'>
				<form action="adminMenu.php" method="post" name="q6">
		            <td>Q6: Average fine paid by the borrowers between <input type="date" name="q6s"> and <input type="date" name="q6e"> for each branch.</td>
		            <td><input type="submit" name="q6" class="btn btn-info" value="GO"></td>
				</form>
			</div>
			</tr>
			<tr>
			<div class='branchInfo'>
				<form action="adminMenu.php" method="post" name="branchInfo">
		            <td colspan="2"><input type="submit" name="branchInfo" class="btn btn-info" value="Branch Information" style="width: 100%"></td>
				</form>
			</div>
			</tr>
		</table>
		</div>
	<!--------------------------------------------------------------Forms-PHP------------------------------------------------------------------------->
		<div class="col-sm-4 jumbotron text-center">
		<?php
			include_once "connection.php";
			
			if (isset($_POST['q1'])) {
				$n = $_POST['q1N'];
		        $bid = $_POST['q1bid'];
		        echo "<h4>Top ".$n." most frequent borrowers of that brunch.</h4>";

		        $query = "SELECT R.RID, R.RNAME, COUNT(B.RID) AS COUNT FROM BORROWS B, READER R WHERE R.RID = B.RID AND BID = ".$bid." GROUP BY B.RID ORDER BY COUNT(B.RID) DESC";
		        
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		        	$c = 0;
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Reader ID</th>
		                <th>Reader Name</th>
		                <th># Books Borrowed</th>
		                </tr>";
		            while ($row=$result->fetch_assoc() and $c<$n) {
		                echo "<tr>";
		                echo "<td>" . $row['RID'] . "</td>";
		                echo "<td>" . $row['RNAME'] . "</td>";
		                echo "<td>" . $row['COUNT'] . "</td>";
		                echo "</tr>";
		                $c = $c+1;
		            }
		            echo "</table>";
		        } else {
		            echo "The branch has no borrowers.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['q2'])) {
				$n = $_POST['q2N'];
				echo "<h4>Top ".$n." most frequent borrowers overall.</h4>";
		        
		        $query = "SELECT R.RID, R.RNAME, COUNT(B.RID) AS COUNT FROM BORROWS B, READER R WHERE R.RID = B.RID GROUP BY B.RID ORDER BY COUNT(B.RID) DESC";
		        
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		        	$c = 0;
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Reader ID</th>
		                <th>Reader Name</th>
		                <th># Books Borrowed</th>
		                </tr>";
		            while ($row=$result->fetch_assoc() and $c<$n) {
		                echo "<tr>";
		                echo "<td>" . $row['RID'] . "</td>";
		                echo "<td>" . $row['RNAME'] . "</td>";
		                echo "<td>" . $row['COUNT'] . "</td>";
		                echo "</tr>";
		                $c = $c+1;
		            }
		            echo "</table>";
		        } else {
		            echo "There are no borrowers.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['q3'])) {
		        $n = $_POST['q3N'];
		        $bid = $_POST['q3bid'];
		        echo "<h4>Top ".$n." most borrowed books of that branch:</h4>";

		        $query = "SELECT D.DOCID, D.TITLE, COUNT(B.DOCID) AS COUNT FROM BORROWS B, DOCUMENT D WHERE D.DOCID = B.DOCID AND BID = ".$bid." GROUP BY B.DOCID ORDER BY COUNT(B.DOCID) DESC";
		        
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		        	$c = 0;
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Document ID</th>
		                <th>Title</th>
		                <th># Copies Borrowed</th>
		                </tr>";
		            while ($row=$result->fetch_assoc() and $c<$n) {
		                echo "<tr>";
		                echo "<td>" . $row['DOCID'] . "</td>";
		                echo "<td>" . $row['TITLE'] . "</td>";
		                echo "<td>" . $row['COUNT'] . "</td>";
		                echo "</tr>";
		                $c = $c+1;
		            }
		            echo "</table>";
		        } else {
		            echo "No such document found.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['q4'])) {
				$n = $_POST['q4N'];
				echo "<h4>Top ".$n." most borrowed books overall:</h4>";
		        $query = "SELECT D.DOCID, D.TITLE, COUNT(B.DOCID) AS COUNT FROM BORROWS B, DOCUMENT D WHERE D.DOCID = B.DOCID GROUP BY B.DOCID ORDER BY COUNT(B.DOCID) DESC";
		        
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		        	$c = 0;
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Document ID</th>
		                <th>Title</th>
		                <th># Copies Borrowed</th>
		                </tr>";
		            while ($row=$result->fetch_assoc() and $c<$n) {
		                echo "<tr>";
		                echo "<td>" . $row['DOCID'] . "</td>";
		                echo "<td>" . $row['TITLE'] . "</td>";
		                echo "<td>" . $row['COUNT'] . "</td>";
		                echo "</tr>";
		                $c = $c+1;
		            }
		            echo "</table>";
		        } else {
		            echo "No such document found.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['q5'])) {
				$year = $_POST['q5year'];
				echo "<h4>Top 10 most popular books of year ".$year.":</h4>";
		        
		        $query = "SELECT D.DOCID, D.TITLE, COUNT(B.DOCID) AS COUNT FROM BORROWS B, DOCUMENT D, BORROWING BG WHERE D.DOCID = B.DOCID AND BG.BOR_NO=B.BOR_NO 
		        	AND BDTIME LIKE '".$year."%' GROUP BY B.DOCID ORDER BY COUNT(B.DOCID) DESC";
		        
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		        	$c = 0;
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Document ID</th>
		                <th>Title</th>
		                <th># Copies Borrowed</th>
		                </tr>";
		            while ($row=$result->fetch_assoc() and $c<10) {
		                echo "<tr>";
		                echo "<td>" . $row['DOCID'] . "</td>";
		                echo "<td>" . $row['TITLE'] . "</td>";
		                echo "<td>" . $row['COUNT'] . "</td>";
		                echo "</tr>";
		                $c = $c+1;
		            }
		            echo "</table>";
		        } else {
		            echo "No such document found.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['q6'])) {
		    	$S = $_POST['q6s'];
		        $E = $_POST['q6e'];
				echo "<h4>Average fine paid by the borrowers between ".$S." and ".$E." for each branch:</h4>";
		        
		        	        

				$query = "SELECT BR.BID, BR.LNAME, SUM((DATEDIFF(RDTIME, BDTIME)-20)*0.2)/COUNT(LNAME) as FINE
				FROM BRANCH BR, BORROWING BG, BORROWS BW
				WHERE BW.BOR_NO=BG.BOR_NO AND BW.BID=BR.BID AND RDTIME IS NOT NULL AND DATEDIFF(RDTIME, BDTIME) > 20 AND BDTIME BETWEEN '".$S."' AND '".$E."' GROUP BY BR.BID";
				
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Branch ID</th>
		                <th>Branch Name</th>
		                <th>Average Fine</th>
		                </tr>";
		            while ($row=$result->fetch_assoc()) {
		                echo "<tr>";
		                echo "<td>" . $row['BID'] . "</td>";
		                echo "<td>" . $row['LNAME'] . "</td>";
		                echo "<td>$" . round($row['FINE'], 2) . "</td>";
		                echo "</tr>";           
		            }
		            echo "</table>";
		        } else {
		            echo "No such document found.";
		        }
		        $conn->close();
		    }
		    if (isset($_POST['branchInfo'])) {
				echo "<h3>Branch Information</h3>";
		        	        

				$query = "SELECT * FROM BRANCH";
				
		        $result = $conn->query($query);
		        if ($result->num_rows> 0) {
		            echo "<table class=\"table table-bordered table-condensed\">
		                <tr>
		                <th>Branch ID</th>
		                <th>Branch Name</th>
		                <th>Branch Location</th>
		                </tr>";
		            while ($row=$result->fetch_assoc()) {
		                echo "<tr>";
		                echo "<td>" . $row['BID'] . "</td>";
		                echo "<td>" . $row['LNAME'] . "</td>";
		                echo "<td>" . $row['LOCATION'] . "</td>";
		                echo "</tr>";           
		            }
		            echo "</table>";
		        } else {
		            echo "There are no branch information in the database.";
		        }
		        $conn->close();
		    }
		?>
		</div>
	</div>
	</div>
</body>
</html>