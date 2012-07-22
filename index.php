<?php require_once("includes/dbconfig.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php
//Check Wether user allready logged in or not
	if(logged_in()) {
				 redirect("home.php");
	}
	
	//if form submited
	if(isset($_POST['submit'])) {
	
		$error = false;
		extract($_POST);
		
		//Sanitize the POST values
		$username = clean($_POST['username']);
		$pwd = clean($_POST['pwd']);
		
		
		$sql=$db->query("SELECT * FROM users WHERE username='{$username}' AND password='".md5($_POST['pwd'])."'");
		if(mysql_num_rows($sql) == 1) {
				
				
				//Login Successful
				$user = mysql_fetch_assoc($sql);
				$_SESSION['SESS_USER_ID'] = $user['user_id'];
				
				redirect("home.php" );
				exit();
				
		}
		else {
			
				//Login failed
				$message = "Username/Password are incorect. <br/>
							Please try again.";
							redirect("index.php" );
		}
	
	}
	
	else {
		if(isset($_GET['logout']) && $_GET['logout'] == 1) {
				$message = "You have been logged out.";
				}
			$user_id = "";
			$pwd ="";
				
	}
?>
<html>
<head>
<title> HTL </title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="login">
<h1>HTL Login</h1>
<form method="post" action="index.php">
<table>
<tr>
	<td>Username: </td><td><input type="text" name="username"></td>
</tr>
<tr>
	<td>Password: </td><td><input type="password" name="pwd"></td>
</tr>
<tr>
<td><input name="submit" type="submit" value="Log In" class="button" /></td></tr>
</table>
</form>
</div>
</body>
</html>