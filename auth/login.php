<!DOCTYPE html>
<html>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
session_start();

if(isset($_POST['submit'])){
    $username =  $_POST['username'];
    $password = $_POST['password'];
    $row= $db->prepare("SELECT * From users WHERE username= :username");
    $row->bindParam(':username', $username);
    $row->execute();
    if($result=$row->fetch(PDO::FETCH_ASSOC)){
		if(password_verify($password,$result['password'])){
		$_SESSION['auth']=$result['username'];
		//echo $_SESSION['auth'];
		if($result['privileges']==1){
			$_SESSION['is_admin']=1;
		}
		require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/further_auth.php');
		if($authorised){
			header("Location: /home/home.php");}
		else{
			$authorised=false; $errorm="You are either banned or timmed out!";
		}
		}else{$errorm= "<script>alert('Woops! Password was wrong . Try again')</script>";}
    }else{ $errorm= "<script>alert('Woops! Email was Wrong. Try again')</script>";}
	echo $errorm;
}

?>
<head>
    <meta charset="UTF-8">
    <title>Log-in Page</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,400i,700">
</head>
<body class="body">
	<div class="container">
		<form action="login.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username"  required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btnn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>