<?php 
	session_start();

	if(isset($_POST['readerLogout'])){
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
	<title>Reader Menu</title>
	
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">City Library</a>
	    </div>
	    <ul class="nav navbar-nav" style="float:right">
	    	<li><button class="btn btn-default navbar-btn" name="readerLogout">Home</button></li>
	    	<li class="navbar-text"><?php echo $_SESSION["rname"]?></li>
	    	<li><form action="readerMenu.php" method="post" name="readerLogout">
					<input class="btn btn-danger navbar-btn" type="submit" name="readerLogout" value="Log Out">
				</form></li>    
	    </ul>
	  </div>
	</nav>
	<div>
	<br><br>
	<div class="container">
		<br><br>
       <div class="row">
       		<?php echo "<h2 class=\"jumbotron text-center\">Welcome ".$_SESSION["rname"]."</h2>";?>
       	</div>
       	<div class="row">
       		<div >
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='SearchDocument.php'">Search to Reserve</button>
       		</div>
       		<div class="col-sm-1">
            </div>
       		<div>
       			<button class="btn btn-primary btn-lg col-sm-4" onclick="location.href='checkoutDocument.php'">Checkout Document</button>
       		</div>
       		<div class="col-sm-1">
            </div>
       		<div>
       			<button class="btn btn-primary btn-lg col-sm-3" onclick="location.href='returnDocument.php'">Return & History</button>
       		</div>
       	</div>
		
		<!-- <h3>What would you like to do?</h3> -->
		
		
		
		<!-- <button>Borrowed Documents</button> -->
		<br><br>
		
	</div>
</body>
</html>