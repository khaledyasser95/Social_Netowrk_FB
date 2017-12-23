<?php include('server_sender.php');
$userid = $_SESSION['userid'] ;
$username= $_SESSION['user_name'];

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
	 <link type="text/css" rel="stylesheet" href="style.css" >
  <link type="text/css" rel="stylesheet" href="ust.css" >
  <title>Home</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>


  <form method="post" action="Home.php" id="Home_form" class="form2" enctype = "multipart/form-data"  >
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



<div class="bodyn">
<div id="side1" class="bodyn"><img src="prof.png"id="profpic"/><?= $username ?></div>
<div id="side2" class="bodyn"><a href="editprofile.php" >Edit Profile</a></div>
<div id="side3" class="bodyn">News feed</div>
<div id="side4" class="bodyn">Messages</div>
<div id="side5" class="bodyn">Events</div>
<div id="side6" class="bodyn">PAGES</div>
<div id="side7" class="bodyn">Pages feed</div>
<div id="side8" class="bodyn">Like pages</div>
<div id="side9" class="bodyn">Create page</div>
<div id="side10" class="bodyn">Create ad</div>
<div id="side11" class="bodyn">GROUPS</div>
<div id="side12" class="bodyn">New groups</div>
<div id="side13" class="bodyn">Create group</div>
<div id="side14" class="bodyn">APPS</div>
<div id="side15" class="bodyn" >Games</div>
<div id="side16" class="bodyn">On this day</div>
<div id="side17" class="bodyn">Games feed</div>
<div id="side18" class="bodyn"><a href="friends.php" >FRIENDS</a></div>
<div id="side19" class="bodyn">Close friends</div>
<div id="side20" class="bodyn">Family</div>
<div id="side21" class="bodyn">INTERESTS</div>
<div id="side22" class="bodyn">Pages and public</div>
<div id="side23" class="bodyn">EVENTS</div>
<div id="side24" class="bodyn">Create event</div>
</div>


  

<div class="post">
       
<div id="column-1" class="post" type>update status | add photos/videos | create photo album<hr><br><br><br><br><br><br><hr></div>

 <select name="privacy" id="postpriv" class="post">
        <option value="1">Public</option>
        <option value="0">Private</option>
        </select>

     <div id="postBros" class="post">  <input type="file" name="fileToUpload" id="buttonpost"></div>
<div id="postpos" class="post"> <button type="submit"  id="buttonpost" name="post_btn" value="Get Selected Values"> Post </button></div>

<div id="postboxpos" class="post"><textarea placeholder="What's on your mind" name="post" id="postbox" value="" size="10"></textarea></div>
</div>
  

  <?php 
//$sql2 = "SELECT * FROM posts ORDER BY post_id DESC ";
    $sql2 = "SELECT posts.IsPublic , sn_users.Fname , posts.post, posts.user_id,posts.post_id,posts.pic
    FROM posts
    INNER JOIN sn_users ON posts.user_id = sn_users.user_id ORDER BY posts.post_id DESC";
    $result2 = mysqli_query($db, $sql2);

    while ($row = $result2->fetch_assoc())
    {
      $tarek = $row['user_id'];
      if($row['IsPublic'] == 1 || $userid == $tarek)
      {
        echo $row['Fname']." Posted: <br>";
        
         $pic = $row['pic'] ;
            
               if (!empty($pic)){;
              ?>
                <img class="" width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'><br>
                <?php  } echo $row['post']."<br>";






        $post_id = $row['post_id'];
        $sql1 = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id = '$userid'";
        $result11 = mysqli_query($db, $sql1);
        if (mysqli_num_rows($result11) == 0)
        {

          ?>

         <button type="submit" class="btn" name="like_btn" value="<?= $post_id ?>"> Like </button><br><br>
          <?php } else {
            ?>
            <button type="submit" class="btn" name="liked_btn" value="<?= $post_id ?>"> Unlike </button><br><br>
            <?php
          }
        }
        else{

          $sql = "SELECT * FROM friends WHERE user_id1='$userid' AND user_id2 = '$tarek'";
          $sqlmihy = "SELECT * FROM friends WHERE user_id1='$tarek' AND user_id2 = '$userid'";
          $result1 = mysqli_query($db, $sql);
          $resultmihy = mysqli_query($db, $sqlmihy);

          if (mysqli_num_rows($result1) > 0 OR mysqli_num_rows($resultmihy) > 0)
          {
            echo $row['Fname']." Posted:<br>";
           
             $pic = $row['pic'] ;
             
               if (!empty($pic)){;
              ?>
              <img class="" width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'><br>
                <?php  } echo $row['post']."<br>";




            $post_id = $row['post_id'];
            $sql1 = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id = '$userid'";
            $result1 = mysqli_query($db, $sql1);
            if (mysqli_num_rows($result1) == 0)
            { echo "<br>";
              ?>
             <br> <button type="submit" class="btn" name="like_btn" value="<?= $post_id ?>"> Like </button><br><br>
              <?php } else {
                ?>
                <br><button type="submit" class="btn" name="liked_btn" value="<?= $post_id ?>"> Unlike </button><br><br>
                <?php


              }



            } ?>



            <?php }
          }


          ?>

        </form>




</body>
</html>