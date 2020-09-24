<?php 
	include 'config.php';
    function formatDate($date){
        return date('g:i a', strtotime($date));
    }
    $id_send = $_GET['ids'];
    $id_receive = $_GET['idr'];
    $qr = "SELECT * FROM chat_message WHERE (to_user_id =".$id_send."AND from_user_id=".$id_receive.")OR (to_user_id =".$id_receive."AND from_user_id=".$id_send.")";
   
    $run = mysqli_query($con,$qr);
    if($run){
	while($row = mysqli_fetch_array($run)) :
		?>
			<div id="chat_data">
				<span style="color:green;"><?php echo $row['to_user_id']; ?></span> :
				<span style="color:brown;"><?php echo $row['msg'];  echo $qr; ?></span>
				<span style="float:right;"><?php echo formatDate($row['created_at']); ?></span>
			</div>
            <?php endwhile;}?>
            