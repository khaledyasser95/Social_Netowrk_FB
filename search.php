<?php
include('server_sender.php');
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
$searched_posts=array();
$searched_posts = $_SESSION['searched_posts'];
$mihy = $_SESSION['userid'];
$searched_ids=array();
$searched_ids = $_SESSION['searched_ids'];
?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="style.css">
 <link rel="stylesheet" type="text/css" href="ust.css">
</head>
<body>
    <title> Search</title>
    <div class="">
    <h2>Search</h2>
  </div>
    
   <form method="post" action="search.php" id="search_form"  >
  <?php include('errors.php'); ?>
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

<h3> 
    <?php 
foreach($searched_ids as $value){
    $sql = " SELECT * FROM sn_users WHERE user_id='$value' ";
    $result=mysqli_query($db,$sql);
    mysqli_num_rows($result);
    $row = $result->fetch_assoc();
    ?>
    <a href='profile.php?id=<?php echo $value;  ?>' > 
        <h3><?php echo $row['Fname']." " .$row['Lname']. "<br>"; }
       ?></h3> 
   </a>

   <?php unset($searched_ids);



//LOCATION HERE

#foreach ($searched_posts as $error)  {
      # echo $error. "<br>"."KHALOOOOOD" . "<br>";

     #}
    foreach($searched_posts as $value){
    $sql = " SELECT * FROM posts WHERE post_id='$value' ";
    $result=mysqli_query($db,$sql);
    mysqli_num_rows($result);
    $row = $result->fetch_assoc(); //post
    $puid = $row['user_id'];

    if ($mihy == $puid)
    {
      $sql1 = "SELECT * FROM sn_users WHERE user_id = '$mihy'";
      $result1 = mysqli_query($db,$sql1);
      mysqli_num_rows($result1);
      $row1 = $result1->fetch_assoc();
      echo $row1['Fname'] . "--->" . $row['post'] . "<br>";
      unset($searched_posts);
    }
    elseif($row['IsPublic'] == 1)
    {
      $sql1 = "SELECT * FROM sn_users WHERE user_id = '$puid'";
      $result1 = mysqli_query($db,$sql1);
      mysqli_num_rows($result1);
      $row1 = $result1->fetch_assoc();
      echo $row1['Fname'] . "--->" . $row['post'] . "<br>";
unset($searched_posts);
    }
    else
    {

    $sql = "SELECT * FROM friends WHERE user_id1='$mihy' AND user_id2 = '$puid'";
    $sqlmihy = "SELECT * FROM friends WHERE user_id1='$puid' AND user_id2 = '$mihy'";
    $result1 = mysqli_query($db, $sql);
    $resultmihy = mysqli_query($db, $sqlmihy);

    if (mysqli_num_rows($result1) > 0 OR mysqli_num_rows($resultmihy) > 0)
    {
        $sql1 = "SELECT * FROM sn_users WHERE user_id = '$puid'";
      $result1 = mysqli_query($db,$sql1);
      mysqli_num_rows($result1);
      $row1 = $result1->fetch_assoc();
      if(!empty($searched_posts))
      echo $row1['Fname'] . "--->" . $row['post'] . "<br>";
unset($searched_posts);

    }
  }

}

    ?>
       
   


</h3>
</form>

</body>
</html>