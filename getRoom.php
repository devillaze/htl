<?php require_once("includes/dbconfig.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php
extract($_POST);
extract($_GET);
$isOccupied = 1;//occupied
$check = $db->query("SELECT * FROM rooms,status,guests WHERE rooms.status = status.status_no 
	AND rooms.guest_id = guests.id
	AND roomnumber = ".$room_number);
$num	= $db->num_rows($check);

if($num == 0){
	$isOccupied = 0;//empty
}


if($isOccupied == 0){
	$sql = $db->query("SELECT * FROM rooms,status WHERE rooms.status = status.status_no 
		AND roomnumber = ".$room_number);
}
else{
	$sql = $db->query("SELECT * FROM rooms,status,guests WHERE rooms.status = status.status_no 
		AND rooms.guest_id = guests.id
		AND roomnumber = ".$room_number);
}
$room = $db->fetch_array($sql);
$result["id"] = $room["id"];
$result["room_number"] = $room["roomnumber"];
$result["status"] = $room["status"];
$result["guest"] = $room["guest_id"];
$result["guest_name"] = $room["fname"];

echo json_encode($result);

?>
<?php
	
?>
<table>
	
	<tr>
		<td>Room Number</td><td><p id="roomNumber"><?php echo $room["roomnumber"];?></p></td>
	</tr>
	<tr>
		<td>Status</td><td><p id="roomStatus"><?php echo $room["status"];?></p></td>
	</tr>
	<tr>
		<td>Guest</td><td><p id="roomGuest"><?php echo $room["fname"];?></p></td>
	</tr>
	
</table>