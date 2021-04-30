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
    <title>Add Document Copy</title>
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
            <li><form action="AddDocumentCopy.php" method="post" name="adminLogout">
                    <input class="btn btn-danger navbar-btn" type="submit" name="logout" value="Log Out">
                </form>
            </li>
        </ul>
      </div>
    </nav>
    <br><br>

    <div class="container">
    <div class="row">
        <h2 class="jumbotron text-center">Add Document Copy</h2>
    </div>
    <div class="row">
        <div class="col-sm-1">
        </div>
        <button class="btn btn-primary btn-lg col-sm-4" onclick="location.href = 'AddDocument.php';">Add New Document</button>
        <div class="col-sm-2">
        </div>
        <button class="btn btn-primary btn-lg col-sm-4" onclick="addCopy()">Add Copy of an Existing Document</button>
        <div class="col-sm-1">
        </div>
    </div>
    <br>

    <span id="searchForm" style="display: none;">
        <br><br>
        <div class="row">
            <div class="form-group col-sm-2">
            </div>
             <span class="form-group col-sm-8" id="searchForm">       
                <form action="AddDocumentCopy.php" method="post" name="searchDocument">
                    <div class="form-group">
                        <input class="form-control col-sm-8" type="text" name="title" placeholder="Enter document name">
                        <br><br>
                        <input  class="btn btn-success btn-block" type="submit" name="search" value="Search">
                    </div>
                    
                    <br><br>
                </form>
            </span>
        </div>
    </span>
    
    
    <span id="addCopyForm" style="display: none;" >
        <br><br>
        <div class="row">
        <div class="form-group col-sm-4">
        </div>    
        <span class="form-group col-sm-4" id="searchForm">       
            <form action="AddDocumentCopy.php" method="post" name="addCopyForm">
                
                <div class="form-group">
                <label>Document ID:</label>
                <input type="number" name="docid" class="form-control" readonly>
                </div>
                <div class="form-group">
                <label>Copy #:</label>
                <input type="number" name="copyno" class="form-control" placeholder="Enter Copy #">
                </div>
                <div class="form-group">
                <label>Branch:</label>
                <select name="bid" class="form-control">
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
                </select>
                </div>
                <div class="form-group">
                <label>Position:</label>
                <input type="text" name="position" class="form-control" placeholder="Enter Position">
                </div>
                <br><br>
                <input type="submit" name="submit" class="btn btn-success btn-block">
            </form>
        </span>

        

        </div>
    </span>


    <p id="demo"></p>

    <script>
        function addCopy() {
            document.getElementById("searchForm").style.display = 'block';
        }

        function selectDoc(docid){
            document.getElementById("addCopyForm").style.display = 'block';
            document.forms['addCopyForm'].elements["docid"].value = docid;
            //document.getElementById("demo").innerHTML = docid;
        }
    </script>



<?php
    if (isset($_POST['search'])) {
        include_once "connection.php";
        $dname = $_POST['title'];

        $query = "SELECT * FROM Document WHERE TITLE LIKE '%".$dname."%'";
        
        $result = $conn->query($query);
        if ($result->num_rows> 0) {
            echo "<table class=\" table table-striped table-hover\">
                <tr>
                <th>Document ID</th>
                <th>Title</th>
                <th>Publication Date</th>
                <th>Publisher ID</th>
                <th></th>
                </tr>";
            while ($row=$result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['DOCID'] . "</td>";
                echo "<td>" . $row['TITLE'] . "</td>";
                echo "<td>" . $row['PDATE'] . "</td>";
                echo "<td>" . $row['PUBLISHERID'] . "</td>";
                echo "<td><button onclick=\"selectDoc(". $row['DOCID'] .")\">Select Document</button></td>";
                echo "</tr>";
                //echo "Document ID:" . $row['DOCID']." - Title: " . $row["TITLE"]. " - P Date: ". $row["PDATE"]. "<br>";
            }
            echo "</table>";
        } else {
            echo "No such document found.";
        }
        $conn->close();
    }
    if (isset($_POST['submit'])) {
        include_once "connection.php";
        $query = "INSERT INTO COPY (DOCID, COPYNO, BID, POSITION)
        VALUES ('".$_POST['docid']."', '".$_POST['copyno']."', '".$_POST['bid']."', '".$_POST['position']."')";
        if ($conn->query($query) === FALSE) {
            echo "Error: ". mysqli_error($conn);
        }
        $conn->close();
    }
?>
    </div>
</body>
</html>