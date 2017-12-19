<?php include('server_sender.php') ;
//echo $_SERVER['HTTP_REFERER'];
$db = mysqli_connect('localhost', 'root', '', 'social_network');
if($_SERVER['HTTP_REFERER'] == "http://localhost/SocialNetwork_Kha/SocialNetwork/search.php" && $_GET['id'] != -1 || $_SERVER['HTTP_REFERER'] == "http://localhost/SocialNetwork_Kha/SocialNetwork/friends.php")
  {
    
    $flag = 0;
    $id=$_GET['id'];
    $userid = $_SESSION['userid'];
    $_SESSION['friendid']=$id;
    $query = "SELECT * FROM friend_request WHERE user_id='$id' AND friendid='$userid'";
    $result=mysqli_query($db,$query);
    if (mysqli_num_rows($result) == 1 )
    {
      $delete=1;
      echo $delete;
    }
    else 
    {
      $delete=0;
      echo $delete;
    }
  }
  else
  {
    $id = $_SESSION['userid'];
    $flag = 1;
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <title>Profile</title>
    <div class="header">
      <h2>Profile</h2>
    </div>

    <form method="post" action="Home.php" id="profile_form"  >
     <a href="Home.php"> Home</a>
     <a href="profile.php"> Profile</a>
     <a href="requests.php"> Friend Requests</a>
     <a href="friends.php"> Friends</a>  
     <a href="login.php"> Logout</a> 
     <div class="input-group">
      <input name="search" id="search_label" value="" size="10">
      <button type="submit" class="btn" name="search_btn"> Search </button>
    </div>

    <?php 


    if ($flag == 1)
    {

      $sql = "SELECT * FROM posts WHERE user_id='$id'";
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0  ) {
       while($row = $result->fetch_assoc()) {
         echo "<br>".$row['post'];


       }

     }

   }

   else
   {
    $sql = "SELECT * FROM friends WHERE user_id1='$id' AND user_id2 = '$userid'";
    $sqlmihy = "SELECT * FROM friends WHERE user_id1='$userid' AND user_id2 = '$id'";
    $result1 = mysqli_query($db,$sql);
    $resultmihy = mysqli_query($db,$sqlmihy);

    if (mysqli_num_rows($result1) > 0 OR mysqli_num_rows($resultmihy) > 0)
    {
      $delete=2;
      $sql = "SELECT * FROM posts WHERE user_id='$id'";
      $result=mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0  ) {
       while($row = $result->fetch_assoc()) {

 echo "<br>".$row['post'];

       }

     }


   }

   else

   {

    $sql = "SELECT * FROM posts WHERE user_id='$id' AND IsPublic ='1' ";
    $result=mysqli_query($db,$sql);
    if (mysqli_num_rows($result) > 0  ) {
     while($row = $result->fetch_assoc()) {

      echo "<br>".$row['post'];

    }

  }

}

}
$uss=$_SESSION['userid'];
   $sql = "SELECT * FROM friend_request WHERE friendid='$id' AND user_id ='$uss'";
     
        $result=mysqli_query($db,$sql);
       if (mysqli_num_rows($result) > 0  )
       $delete=4;



?>






<?php 
$sql = "SELECT * FROM sn_users WHERE user_id='$id'";
$result=mysqli_query($db,$sql);
if (mysqli_num_rows($result) > 0  ) {
 while($row = $result->fetch_assoc()) {
   echo "<br>"."First Name: ".$row['Fname']."<br>"."Last Name: " .$row['Lname']."<br>"."Email: ".$row['email']."<br>". "Gender: " .$row['Gender']."<br>". "Birthdate: " .$row['Birthdate'];  
 }
   //Add Friend
}

?>
<div>
  <?php 
  if ($id != $_SESSION['userid']) {
    if ($delete ==0) {
   
      ?>

      <button type="submit" class="btn" name="addfriend_btn"> Add Friend </button>
      <?php } else if ($delete ==1) {  ?>
      <button type="submit" class="btn" name="removefriend_btn"> Remove Request </button>
      <?php  }
      else if ($delete ==2){ ?>
<button type="submit" class="btn" name="deletefriend_btn"> Delete Friend </button>
    <?php    }
else if ($delete ==4) {?>
<button id=$row['user_id'] type="submit" class="btn" name="accept" value="<?= $id ?>">Accept</button>
  <?php $delete=6;}} 

      ?>



    </div>

  </form>

  
</body>
</html>