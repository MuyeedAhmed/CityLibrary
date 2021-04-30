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
    <title>Add New Document</title>
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
            <li><form action="AddDocument.php" method="post" name="adminLogout">
                    <input class="btn btn-danger navbar-btn" type="submit" name="logout" value="Log Out">
                </form>
            </li>
        </ul>
      </div>
    </nav>
    <br><br>

    <div class="container">
    <div class="row">
        <h2 class="jumbotron text-center">Add a New Document</h2>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <button class="btn btn-primary btn-lg col-sm-2" onclick="book()">Book</button>
        <div class="col-sm-1">
        </div>
        <button class="btn btn-primary btn-lg col-sm-3" onclick="journal()">Journal Volume</button>
        <div class="col-sm-1">
        </div>
        <button class="btn btn-primary btn-lg col-sm-3" onclick="conference()">Conference Proceedings</button>
        <div class="col-sm-1">
        </div>
    </div>
    
    <br>

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
        
            <span id="addBook" style="display: none;">       
                <form action="AddDocument.php" method="post" name="addBook">
            	<table class=" table table-striped table-hover">
                    <tr>
                    	<td>Title</td> 
                    	<td><input type="text" name="title" required></td>
                    </tr>
                    <tr>
                    	<td>Publication Date</td>	
                    	<td><input type="Date" name="pdate" required></td>
                    </tr>
                    <tr>
                    	<td>Publisher</td>	
                    	<td>
                    		<select name="publisherid">
        		                <?php
        		                include_once "connection.php";
        		                $query = "SELECT PUBLISHERID, PUBNAME FROM PUBLISHER";
        		                
        		                $result = $conn->query($query);
        		                if ($result->num_rows> 0) {
        		                    while ($row=$result->fetch_assoc()) {
        		                        echo "<option value=\"".$row['PUBLISHERID']."\">".$row['PUBNAME']."</option>";
        		                    }
        		                }else {echo "There are no publisher information in the database.";}
        		                ?>
        		            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>ISBN</td> 
                    	<td><input type="text" name="isbn" required></td>
                    </tr>
                    <tr>
                    	<td>Authors <em>(If there are multiple authors, put a "," between them)</em></td> 
                    	<td><input type="text" name="authors" required></td>
                    </tr>
                    <tr>
                    	<td colspan="2" ><input type="submit" name="submitBook" class="btn btn-success btn-block"></td>
                    </tr>
                </table>
                </form>
            </span>
            <span id="addJournal" style="display: none;">
                <form action="AddDocument.php" method="post" name="addJournal">
                    
                    <table class=" table table-striped table-hover">
                    <tr>
                    	<td>Title</td> 
                    	<td><input type="text" name="title" style="width: 99%" required></td>
                    </tr>
                    <tr>
                    	<td>Publication Date</td>	
                    	<td><input type="Date" name="pdate" style="width: 99%" required></td>
                    </tr>
                    <tr>
                    	<td>Publisher</td>	
                    	<td>
                    		<select name="publisherid" style="width: 99%">
        		                <?php
        		                include_once "connection.php";
        		                $query = "SELECT PUBLISHERID, PUBNAME FROM PUBLISHER";
        		                
        		                $result = $conn->query($query);
        		                if ($result->num_rows> 0) {
        		                     while ($row=$result->fetch_assoc()) {
        		                        echo "<option value=\"".$row['PUBLISHERID']."\">".$row['PUBNAME']."</option>";
        		                    }
        		                }else {
        		                    echo "There are no publisher information in the database.";
        		                }
        		                ?>
        		            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>Volume#</td> 
                    	<td><input type="number" name="volume_no" style="width: 99%" required></td>
                    </tr>
                    <tr>
                    	<td>Editor</td> 
                    	<td><input type="text" name="editor" style="width: 99%" required></td>
                    </tr>
                    <tr>
                    	<td>Journal Issues</td> 
                    	<td>
                    		<table class=" table table-striped table-hover">
                    			<tr>
                    				<th>Issue#</th>
                    				<th>Scope</th>
                    				<th>Guest Editor <em>(If there are multiple guest editos, put a "," between them)</em></th>
                    			</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no1" required></td>
        	            			<td><input type="text" name="scope1" required></td>
        	            			<td><input type="text" name="gedits1" style="width: 98%" required></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no2"></td>
        	            			<td><input type="text" name="scope2"></td>
        	            			<td><input type="text" name="gedits2" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no3"></td>
        	            			<td><input type="text" name="scope3"></td>
        	            			<td><input type="text" name="gedits3" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no4"></td>
        	            			<td><input type="text" name="scope4"></td>
        	            			<td><input type="text" name="gedits4" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no5"></td>
        	            			<td><input type="text" name="scope5"></td>
        	            			<td><input type="text" name="gedits5" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no6"></td>
        	            			<td><input type="text" name="scope6"></td>
        	            			<td><input type="text" name="gedits6" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no7"></td>
        	            			<td><input type="text" name="scope7"></td>
        	            			<td><input type="text" name="gedits7" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no8"></td>
        	            			<td><input type="text" name="scope8"></td>
        	            			<td><input type="text" name="gedits8" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no9"></td>
        	            			<td><input type="text" name="scope9"></td>
        	            			<td><input type="text" name="gedits9" style="width: 98%"></td>
        	            		</tr>
        	            		<tr>
        	            			<td><input type="number" name="issue_no10"></td>
        	            			<td><input type="text" name="scope10"></td>
        	            			<td><input type="text" name="gedits10" style="width: 98%"></td>
        	            		</tr>
                    		</table>
                    	</td>
                    </tr>
                    <tr>
                    	<td colspan="2" ><input type="submit" name="submitJournal" class="btn btn-success btn-block"></td>        	
                    </tr>
                </table>
                </form>
            </span>
            <span id="addConference" style="display: none;">
                <form action="AddDocument.php" method="post" name="addConference">
            	<table class=" table table-striped table-hover">
                    <tr>
                    	<td>Title</td> 
                    	<td><input type="text" name="title" required></td>
                    </tr>
                    <tr>
                    	<td>Publication Date</td>	
                    	<td><input type="Date" name="pdate" required></td>
                    </tr>
                    <tr>
                    	<td>Publisher</td>	
                    	<td>
                    		<select name="publisherid">
        		                <?php
        		                include_once "connection.php";
        		                $query = "SELECT PUBLISHERID, PUBNAME FROM PUBLISHER";
        		                
        		                $result = $conn->query($query);
        		                if ($result->num_rows> 0) {
        		                     while ($row=$result->fetch_assoc()) {
        		                        echo "<option value=\"".$row['PUBLISHERID']."\">".$row['PUBNAME']."</option>";
        		                    }
        		                }else {
        		                    echo "There are no publisher information in the database.";
        		                }
        		                
        		                ?>
        		            </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>Conference Date</td> 
                    	<td><input type="Date" name="cdate" required></td>
                    </tr>
                    <tr>
                    	<td>Conference Location</td> 
                    	<td><input type="text" name="clocation" required></td>
                    </tr>
                    <tr>
                    	<td>Conference Chairs <em>(If there are multiple chairs, put a "," between them)</em></td> 
                    	<td><input type="text" name="chairs" required></td>
                    </tr>
                    <tr>
                    	<td colspan="2" ><input type="submit" name="submitConference" class="btn btn-success btn-block"></td>        	
                    </tr>
                </table>
                </form>
            </span>
        </div>
    </div>

    <p id="demo"></p>

    <script>
        function book() {
        	document.getElementById("addJournal").style.display = 'none';
        	document.getElementById("addConference").style.display = 'none';
            document.getElementById("addBook").style.display = 'block';
        }
        function conference() {
        	document.getElementById("addJournal").style.display = 'none';
        	document.getElementById("addBook").style.display = 'none';
            document.getElementById("addConference").style.display = 'block';
        }
        function journal(docid){
            document.getElementById("addBook").style.display = 'none';
            document.getElementById("addConference").style.display = 'none';
            document.getElementById("addJournal").style.display = 'block';

            //document.forms['addCopyForm'].elements["docid"].value = docid;
            //document.getElementById("demo").innerHTML = docid;
        }
        
    </script>
    </div>
</body>
</html>

<?php

    if (isset($_POST['submitBook'])) {
        include_once "connection.php";
		//Insert to Document Table
        $docid = insertDocument($conn, $_POST['title'], $_POST['pdate'], $_POST['publisherid']);
        //Insert to Book Table
        $query2 = "INSERT INTO BOOK (DOCID, ISBN)
        VALUES ('".$docid."', '".$_POST['isbn']."')";
        
        if ($conn->query($query2) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
        //Insert to Person->Author Table
		$authors = explode(",",$_POST['authors']);
		
		foreach ($authors as $author) {
			
			$author = ltrim($author, " "); // Trip leading whitespace
			$query3 = "SELECT PID FROM PERSON WHERE PNAME='".$author."'";
			$result = $conn->query($query3);
	        if ($result->num_rows == 1) {
	        	$row=$result->fetch_assoc();
	        	insertAuthor($conn, $row['PID'], $docid);
            } else {
	        	//Insert into Person Table
		        $pid = insertPerson($conn, $author);
		        //Insert new author into author table
		        insertAuthor($conn, $pid, $docid);
                echo "<br><br><div class=\"alert alert-success\">A new author \"".$author."\" was added in the PERSON table.</div>";
		        //echo "A new author \"".$author."\"was added in the PERSON table.";
	        }		
		}
        $conn->close();
    }
    if (isset($_POST['submitConference'])) {
        include_once "connection.php";
		//Insert to Document Table
        $docid = insertDocument($conn, $_POST['title'], $_POST['pdate'], $_POST['publisherid']);
        //Insert to Proceedings Table
        $query2 = "INSERT INTO PROCEEDINGS (DOCID, CDATE, CLOCATION)
        VALUES ('".$docid."', '".$_POST['cdate']."', '".$_POST['clocation']."')";
        
        if ($conn->query($query2) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
        //Insert to Person->Chair Table
		$chairs = explode(",",$_POST['chairs']);
		
		foreach ($chairs as $chair) {
			
			$chair = ltrim($chair, " "); // Trip leading whitespace
			$query3 = "SELECT PID FROM PERSON WHERE PNAME='".$chair."'";
			$result = $conn->query($query3);
	        if ($result->num_rows == 1) {
	        	$row=$result->fetch_assoc();
	        	insertChair($conn, $row['PID'], $docid);
            } else {
	        	//Insert into Person Table
		        $pid = insertPerson($conn, $chair);
		        //Insert new chair into chair table
		        insertChair($conn, $pid, $docid);
                echo "<br><br><div class=\"alert alert-success\">A new chair \"".$chair."\" was added in the PERSON table.</div>";
		        //echo "A new chair \"".$chair."\"was added in the PERSON table.";
	        }		
		}
        $conn->close();
    }
    if (isset($_POST['submitJournal'])) {
        include_once "connection.php";
		//Insert to Document Table
        $docid = insertDocument($conn, $_POST['title'], $_POST['pdate'], $_POST['publisherid']);
        //Get or insert Editor
        $editor = $_POST['editor'];
        $editorPID = 0;
        $query1 = "SELECT PID FROM PERSON WHERE PNAME='".$editor."'";
		$result = $conn->query($query1);
        if ($result->num_rows == 1) {
        	$row=$result->fetch_assoc();
        	$editorPID = $row['PID'];
        } else {
        	//Insert into Person Table
	        $editorPID = insertPerson($conn, $editor);
	        //Insert new editor into chair table
	        echo "<br><br><div class=\"alert alert-success\">A new editor \"".$editor."\" was added in the PERSON table.</div>";
            //echo "A new editor \"".$editor."\"was added in the PERSON table.";
        }
        //Insert to Journal Volume Table
        $query2 = "INSERT INTO JOURNAL_VOLUME (DOCID, VOLUME_NO, EDITOR)
        VALUES ('".$docid."', '".$_POST['volume_no']."', '".$editorPID."')";
        if ($conn->query($query2) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
        //Insert Journal Issues
        for($i = 1; $i<=10; $i++) {
        	if($_POST['issue_no'.$i.''] === ''){
        		break;
        	}
			$query2 = "INSERT INTO JOURNAL_ISSUE (DOCID, ISSUE_NO, SCOPE)
	        VALUES ('".$docid."', '".$_POST['issue_no'.$i.'']."', '".$_POST['scope'.$i.'']."')";
	        
	        if ($conn->query($query2) === FALSE) {    	
	            echo "Error: ". mysqli_error($conn)."<br>";
	        }
	        //Insert to Person->Gedits Table
			$gedits = explode(",",$_POST['gedits'.$i.'']);
			
			foreach ($gedits as $gedit) {
				
				$gedit = ltrim($gedit, " "); // Trip leading whitespace
				$query3 = "SELECT PID FROM PERSON WHERE PNAME='".$gedit."'";
				$result = $conn->query($query3);
		        if ($result->num_rows == 1) {
		        	$row=$result->fetch_assoc();
		        	insertGedits($conn, $docid, $_POST['issue_no'.$i.''], $row['PID']);
	            } else {
		        	//Insert into Person Table
			        $pid = insertPerson($conn, $gedit);
			        //Insert new gedit into gedit table
			        insertGedits($conn, $docid, $_POST['issue_no'.$i.''], $pid);
                    echo "<br><br><div class=\"alert alert-success\">A new gedit \"".$gedit."\" was added in the PERSON table.</div>";
			        //echo "A new gedit \"".$gedit."\"was added in the PERSON table.";
		        }		
			}
		}



        
        $conn->close();
    }



    function insertDocument($conn, $title, $pdate, $publisherid){
		$query1 = "INSERT INTO DOCUMENT (DOCID, TITLE, PDATE, PUBLISHERID)
        VALUES ('NULL', '".$title."', '".$pdate."', '".$publisherid."')";
        if ($conn->query($query1) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
        return $conn->insert_id;
	}
	function insertPerson($conn, $pname){
		$query5 = "INSERT INTO PERSON (PID, PNAME)
        VALUES ('NULL', '".$pname."')";
        if ($conn->query($query5) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
        return $conn->insert_id;
	}
	function insertAuthor($conn, $pid, $docid){
		$query6 = "INSERT INTO AUTHOR (PID, DOCID)
		VALUES (".$pid.", ".$docid.")";
        if ($conn->query($query6) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
	}
	function insertChair($conn, $pid, $docid){
		$query6 = "INSERT INTO CHAIRS (PID, DOCID)
		VALUES (".$pid.", ".$docid.")";
        if ($conn->query($query6) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
	}
	function insertGedits($conn, $docid, $issue_no, $pid){
		$query = "INSERT INTO GEDITS (DOCID, ISSUE_NO, PID)
		VALUES (".$docid.", ".$issue_no.", ".$pid.")";
        if ($conn->query($query) === FALSE) {    	
            echo "Error: ". mysqli_error($conn);
        }
	}
?>
