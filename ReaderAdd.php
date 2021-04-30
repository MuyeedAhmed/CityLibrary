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
    <title>Add Reader</title>
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
            <li><form action="ReaderAdd.php" method="post" name="adminLogout">
                <input class="btn btn-danger navbar-btn" type="submit" name="logout" value="Log Out">
            </form></li>
        </ul>
      </div>
    </nav>
    <br><br><br>

    <div class="container">
        <div class="row">
            <h2 class="jumbotron text-center">Add Reader</h2>
        </div>
        <form action="ReaderAdd.php" method="post" name="readerAdd">
            
            <div class="form-group">
            <label>Reader Type:</label>
            <input type="text" name="rtype" class="form-control" placeholder="Enter Reader Type" required>
            </div>
            <div class="form-group">
            <label>Name:</label>
            <input type="text" name="rname" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
            <label>Address:</label>
            <input type="text" name="raddress" class="form-control" placeholder="Enter Address" required>
            </div>
            <div class="form-group">
            <label>Phone Number:</label>
            <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" required>
            </div>


            <input type="submit" name="readerAdd" name="Add" class="btn btn-info btn-block">
        </form>
    
        <?php
            if (isset($_POST['readerAdd'])) {
                include_once "connection.php";
                $reader_type = $_POST['rtype'];
                $reader_name = $_POST['rname'];
                $reader_address = $_POST['raddress'];
                $number = $_POST['phone'];
                
                $query = "INSERT INTO READER (RTYPE, RNAME, RADDRESS, PHONE_NO)
                VALUES ('".$reader_type."', '".$reader_name."', '".$reader_address."', '".$number."')";
                if ($conn->query($query) === TRUE) {
                    echo "<br><br><div class=\"alert alert-success\">New record created successfully with Reader ID: ".$conn->insert_id."</div>";
                } else {
                    echo "<br><br><div class=\"alert alert-danger\">Error</div>";
                }
                $conn->close();
            }
        ?>

    </div>
</body>
</html>