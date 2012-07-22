<?php require_once("includes/dbconfig.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/htl.php"); ?>
<?php
	//Check Wether user allready logged in or not
	if(logged_in()) {
				 redirect("home.php");
	}
	
	
?>
<?php $title = "Main"; ?>
<?php include_once('view/head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){

	$('.fancybox').fancybox({
		ajax: {
				type : 'GET',
				url : 'getRoom.php',
				dataType : 'html',
				
				success : function(data){
					$("#RoomsInfo").css("display","block");
					$("#roomNumber").text(data["room_number"]);
					$("#roomStatus").text(data["status"]);
					if(data["guest"] == null){
						$("#roomGuest").text("None");
					}
					else{
						$("#roomGuest").text(data["guest_name"]);
					}
					console.log(data["room_number"]);

				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Error");
				}
			}
		
	});
	
})

function getRoom(room_number){
	
	$.ajax({
			type : 'POST',
			url : 'getRoom.php',
			dataType : 'json',
			data: {
				room_number : room_number
			},
			success : function(data){
				$("#RoomsInfo").css("display","block");
				$("#roomNumber").text(data["room_number"]);
				$("#roomStatus").text(data["status"]);
				if(data["guest"] == null){
					$("#roomGuest").text("None");
				}
				else{
					$("#roomGuest").text(data["guest_name"]);
				}
				console.log(data["room_number"]);
				
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				console.log("Error");
			}
		});
}
</script>

<header>
TEST
</header>
<div class="room_list">
<a href="getRoom.php?room_number=107" class='fancybox fancybox.ajax' >Hello</a>
<?php 
	$sql = $db->query("SELECT * FROM rooms,status WHERE rooms.status = status.status_no");
	while($rooms = $db->fetch_array($sql)){
	if($rooms['status'] == "Available") {$color = "#83f51f";}
	else if($rooms['status'] == "Not Available"){$color = "#f51e82";}
	else{$color="orange";}
?>
<div class="rooms" onclick="getRoom(<?php echo  $rooms['roomnumber'];?>);">
<table>
<tr>
	<td style='background-color:<?php echo $color; ?>'><?php echo  $rooms['roomnumber'];?></td>
</tr>
<tr>
	<td><?php echo  $rooms['status'];?></td>
</tr>
</table>
</div>

<?php	
	}
?>
</div>

<div id="RoomsInfo" class="room_info" style="display:none">
<table>
	
	<tr>
		<td>Room Number</td><td><p id="roomNumber"></p></td>
	</tr>
	<tr>
		<td>Status</td><td><p id="roomStatus"></p></td>
	</tr>
	<tr>
		<td>Guest</td><td><p id="roomGuest"></p></td>
	</tr>
	
</table>
</div>
