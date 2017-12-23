<?php include('server_sender.php');
$userid = $_SESSION['userid'] ;
 
$sql="SELECT user_id FROM friend_request WHERE user_id='$userid'";
$result=mysqli_query($db,$sql);
$num = 0;
if (mysqli_num_rows($result) > 0)
{
      while($rs = $result->fetch_assoc() )
      {

        $num++;


      }

      


}



 ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	 <link type="text/css" rel="stylesheet" href="style.css" >
  <link type="text/css" rel="stylesheet" href="ust.css" >
	<title>Requests</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
	<div>
    <h2>Requests</h2>
  </div>
  <form method="post" action="requests.php" id="req_form"  >

  <div class="header1">
      <div id="img3" ><img src="facebook.png" id="img3"/></div>
      <div id="searcharea" class="header1"><input placeholder="search here..." type="text" id="searchbox" name="search" /></div>
      <div id="searchareabtn" class="header1"> <button type="submit"  id="x" name="search_btn" hidden="hidden" value="Get Selected Values"> Search </button></div>
      <div id="profilearea" class="header1"><img src="prof.png"height="30"/></div>
      <div id="profilearea1" class="header1"> <a href="profile.php?id=-1"> Profile</a></div>
      <div id="profilearea3" class="header1">|</div>
      <div id="profilearea4" class="header1"><a href="Home.php" >Home</a></div>
      <div id="findf" class="header1" > <a href="requests.php"><img  src="frn.png"  height="30"><?= $num ?></a></div>
      <div id="message" class="header1"><img src="chat.png"height="30"/></div>
      <div id="notification" class="header1"><img src="noti.png"height="30"/></div>
      <div id="profilearea2" class="header1">|</div>
      <div id="setting" class="header1"><img src="set.png"height="30"/></div>
      <div id="logout" class="header1"><a href="login.php"><img src="lo.png"height="30"/></a></div>
    </div>

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

  $query="SELECT user_id,Fname,Lname,Profile_Picture FROM sn_users WHERE user_id='$friend_id'";
  $res=mysqli_query($db,$query); 
  if ($res->num_rows > 0) {
    // output data of each row
    $count=0;
    while($row = $res->fetch_assoc()) { $khaled=$row['user_id']; $pic = $row['Profile_Picture']?>
 
                 <div >
           <li class="w3-bar"> 
<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>
      <img src="pictures/<?= $pic ?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
             <a id="test" href='profile.php?id=<?php echo $khaled;  ?>' > 
                  <div class="w3-bar-item">  <span class="w3-large" ><?php echo $row['Fname']  ?></span><br> </div>
               </a> </li>
        </div>

      <button id=$row['user_id'] type="submit" class="btn" name="accept" value="<?= $khaled ?>">Accept</button>
      <button id=$row['user_id'] type="submit" class="btn" name="Decline" value="<?= $khaled ?>">Decline</button>
      <?php } }} }?>


  </form>

</body>
</html>

