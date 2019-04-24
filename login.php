<?php
session_start();
require "database.php";

if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMessage = " ";

if($_POST) {
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    //$password = MD5($password);
    
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM uploadfiles WHERE email = '$username' AND password = '$password'";
	$q = $pdo->prepare($sql);
	$q->execute(array());
	$data = $q->fetch(PDO::FETCH_ASSOC);
	//print_r($data) ; exit();
	
    if($data){
        $_SESSION["username"] = $username;
        header("Location: success.php");
    }
    else {
        header("Location: login.php?errorMessage=Invalid");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset='UTF-8'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
	</head>

<body>
    <div class="container">
		<div class="span10 offset1">

			<div class="row">
				<h3>Login</h3>
			</div>

			<form class="form-horizontal" action="login.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="username@email.com" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="password" required> 
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign in</button>
					&nbsp; &nbsp;
					<a class="btn btn-primary" href="createAccount.php">Join</a>

                    <p style='color: red;'><?php echo $errorMessage; ?></p>
				</div>
				
				<div>
					<br><span style='color: red;' class='help-inline'>&nbsp;&nbsp;</span><br>				</div>
				
				<footer>
					<small>&copy; Copyright 2019, Tyrell Wheeler
					</small>
				</footer>
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>
