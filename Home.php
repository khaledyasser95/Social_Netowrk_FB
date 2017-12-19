<?php include('server_sender.php');
$userid = $_SESSION['userid'] ;
$username= $_SESSION['user_name'];
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<div class="header">
    <h2>HOME</h2>
    <div><?= $username ?></div>
  </div>
  <form method="post" action="Home.php" id="Home_form"  >
   <a href="Home.php"> Home</a>
  <a href="profile.php"> Profile</a>
  <a href="requests.php"> Friend Requests</a>
  <a href="friends.php"> Friends</a>  
  <a href="login.php"> Logout</a> 
     <div class="input-group">
    <input name="search" id="search_label" value="" size="10">
    <button type="submit" class="btn" name="search_btn"> Search </button>
  </div>

    <div class="input-group">
    <input name="post" id="post_label" value="" size="10">
    <button type="submit" class="btn" name="post_btn"> Post </button>
  </div>
  </form>

</body>
</html>