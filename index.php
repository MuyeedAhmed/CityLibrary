<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>City Library</title>
</head>
<body>
    <div class="jumbotron text-center">
	   <h1>Welcome to the City Library</h1>
    </div>
    <div class="container">
        <div class="row">
         <!-- <div class="col-sm-6"> -->
            <div class="col-sm-1">
            </div>
            <button class="btn btn-primary btn-lg col-sm-4" onclick="reader()">Reader</button>
            <!-- </div> -->
            <div class="col-sm-2">
            </div>
            <button class="btn btn-success btn-lg col-sm-4" onclick="admin()">Admin</button>
            <!-- </div> -->
            <div class="col-sm-1">
            </div>
        </div>
        <div class="row">
            <br><br>
        </div>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <span class="form-group col-sm-8" id="reader" style="display: none;">
                <form action="index.php" method="post" name="readerLogin">
                    <div class="form-group">
                    <label>Reader Name:</label>
                    <input type="text" name="rname" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                    <label>Reader ID:</label>
                     <input type="number" name="rid" class="form-control" placeholder="Enter ID">
                    </div>
                    <br><br>
                    <input type="submit" name="readerLogin" class="btn btn-info btn-block">
                </form>
            </span>
             <span class="form-group col-sm-8" id="admin" style="display: none;">
                <form action="index.php" method="post" onsubmit="return checkPass()" name="adminLogin">
                     <div class="form-group">
                        <label>Admin Password:</label>
                        <input type="password" name="adpass" class="form-control" placeholder="Enter Password">
                    </div>
                    
                    <input type="submit" name="adminLogin" class="btn btn-info btn-block">
                </form>
             </span>
             <p id="demo"></p>
         </div>
	</div>
	
</body>
</html>

<script type="text/javascript">
	function reader(){
		document.getElementById("admin").style.display = 'none';
		document.getElementById("reader").style.display = 'block';
	}
	function admin() {
    	document.getElementById("reader").style.display = 'none';
    	document.getElementById("admin").style.display = 'block';
    }
    function checkPass() {
    	var x = document.forms["adminLogin"]["adpass"].value;
    	if (x != "p"){
    		document.getElementById("demo").innerHTML = "invalid password";
    		return false;
    	}
    }

</script>

<?php
    if (isset($_POST['readerLogin'])) {
        include_once "connection.php";
        $rid = $_POST['rid'];
        $rname = $_POST['rname'];

        $query = "SELECT * FROM READER WHERE RID =".$rid." AND RNAME='".$rname."'";
        
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
        	$row=$result->fetch_assoc();

			session_start();
        	$_SESSION['rid']=$rid;
        	$_SESSION['rname']=$row['RNAME'];
            header("Location: readerMenu.php"); 
			exit();
        } else {
            echo "No such user found.";
        }
        $conn->close();
    }
    if (isset($_POST['adminLogin'])) {
        include_once "connection.php";
        $adminFlag = 1;
        session_start();
        $_SESSION['adminFlag']=$adminFlag;
        header("Location: adminMenu.php"); 
        exit();
        $conn->close();
    }
?>
