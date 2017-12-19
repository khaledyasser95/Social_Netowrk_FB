<?php include('server_sender.php');
$userid = $_SESSION['userid'] ;
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Requests</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<div class="header">
    <h2>Requests</h2>
  </div>
  <form method="post" action="requests.php" id="req_form"  >
   <a href="Home.php"> Home</a>
  <a href="profile.php"> Profile</a>
  <a href="requests.php"> Friend Requests</a>
  <a href="friends.php"> Friends</a>  
  <a href="login.php"> Logout</a> 
  <?php 
$sql="SELECT user_id,friendid FROM friend_request WHERE user_id='$userid'";
$result=mysqli_query($db,$sql);
if (mysqli_num_rows($result) > 0)
{
      $select= '<select id="mySelect" name="select">';
      while($rs = $result->fetch_assoc() )
      { ?>
  <?php
  $friend_id=$rs['friendid'];

  $query="SELECT user_id,Fname,Lname FROM sn_users WHERE user_id='$friend_id'";
  $res=mysqli_query($db,$query); 
  if ($res->num_rows > 0) {
    // output data of each row
    $count=0;
    while($row = $res->fetch_assoc()) { $khaled=$row['user_id']; echo $khaled;?>
      <li><?php echo $row['Fname']  ?> </li>
      <button id=$row['user_id'] type="submit" class="btn" name="accept" value="<?= $khaled ?>">Accept</button>
      <button id=$row['user_id'] type="submit" class="btn" name="Decline" value="<?= $khaled ?>">Decline</button>
      <?php } }} }?>


  </form>

</body>
</html>

