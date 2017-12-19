<?php
include('server_sender.php');
$searched_ids = $_SESSION['searched_ids'];
?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <title> Search</title>
    <div class="header">
    <h2>Search</h2>
  </div>
    
   <form method="post" action="Home.php" id="search_form"  >
    <a href="Home.php"> Home</a>
   <a href='profile.php?id=-1' > Profile</a>
   <a href="profile.php"> Friend Requests</a>
   <a href="profile.php"> Friends</a>
   <a href="login.php"> Logout</a>
   <h3><?php //echo $userid; ?></h3>
<div class="input-group">
    <input name="search" id="search_label" value="" size="10">
    <button type="submit" class="btn" name="search_btn"> Search </button>
  </div>
<h3> 
    <?php 
$searched_names = array();

foreach($searched_ids as $value){
    $sql = " SELECT * FROM sn_users WHERE user_id='$value' ";
    $result=mysqli_query($db,$sql);
    mysqli_num_rows($result);
    $row = $result->fetch_assoc();

    ?>
    <a href='profile.php?id=<?php echo $row['user_id'];  ?>' > 
        <h3><?php echo $row['Fname']." " .$row['Lname']. "<br>"; }
       ?></h3> 
   </a>
</h3>
</form>

</body>
</html>