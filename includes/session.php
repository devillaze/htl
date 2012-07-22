<?php
	session_start();
	
	//Check if User logged in
	function logged_in() {
		return isset($_SESSION['SESS_USER_ID']);
	}
	
	function confirm() {
		if(!logged_in()) {
			redirect("../index.php");
		}
	}
	
	function redirect($loc = NULL ) {
	if($loc != NULL) {
		header("Location: {$loc}");
		exit;
	}
}


//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
}
	
?>