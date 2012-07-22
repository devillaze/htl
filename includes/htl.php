<?php require_once("dbconfig.php"); ?>
<?php require_once("session.php"); ?>
<?php
	
	function GetRoomList(){
		$get = $db->query("SELECT * FROM rooms");
		$result = $db->fetch_array($get);
		return($result); 
	}
	
?>