<?php include('server_sender.php');
//echo $_SERVER['HTTP_REFERER'];
$db = mysqli_connect('localhost', 'root', '', 'social_network');
$test = $_GET['id'];
if (($_SERVER['HTTP_REFERER'] == "http://localhost/SocialNetwork_Kha/SocialNetwork/search.php" && $test != -1) || ($_SERVER['HTTP_REFERER'] == "http://localhost/SocialNetwork_Kha/SocialNetwork/friends.php" && $test !=-1) || ($_SERVER['HTTP_REFERER'] == "http://localhost/SocialNetwork_Kha/SocialNetwork/requests.php" && $test !=-1) )
 {

    $flag = 0;
    
        
    $id = $_GET['id'];
    $userid = $_SESSION['userid'];
    //echo "MIHI".$id."<br>";
    $_SESSION['friendid'] = $id;
    $query = "SELECT * FROM friend_request WHERE user_id='$id' AND friendid='$userid'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $delete = 1;
        
    } else {
        $delete = 0;
       
    }
} else {
    $id = $_SESSION['userid'];
    //echo "mihiebn el wes5a".$id;
    $flag = 1;
}
?>
  <?php
        
        $num = 0;
        if ($flag == 0)
        {

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

    }

    else
    {
        $sql="SELECT user_id FROM friend_request WHERE user_id='$id'";
        $result=mysqli_query($db,$sql);
        $num = 0;
        if (mysqli_num_rows($result) > 0)
        {
          while($rs = $result->fetch_assoc() )
          {

            $num++;


        }




    }

}



?>
<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="style.css" >
    <link type="text/css" rel="stylesheet" href="ust.css" >

</head>
<body>
    <title>Profile</title>
   

    <form method="post" action="Home.php" id="profile_form" enctype = "multipart/form-data">

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

        

      


<?php if($flag ==1) {  ?>
<div class="post">
       
<div id="column-1" class="post" >update status | add photos/videos | create photo album<hr><br><br><br><br><br><br><hr></div>
 <select name="privacy" id="postpriv" class="post">
        <option value="1">Public</option>
        <option value="0">Private</option>
        </select>
<div id="postpos" class="post"> <button type="submit"  id="buttonpost" name="post_btn" value="Get Selected Values"> Post </button></div>
<div id="postboxpos" class="post"><textarea placeholder="What's on your mind" name="post" id="postbox" value="" size="10"></textarea></div>
</div>
<?php } ?>



    <?php
    echo "Account Info";
    $friendo=0;
    if ($flag==0)
    {
        $sql = "SELECT * FROM friends WHERE user_id1='$id' AND user_id2 = '$userid'";
        $sqlmihy = "SELECT * FROM friends WHERE user_id1='$userid' AND user_id2 = '$id'";
        $result1 = mysqli_query($db, $sql);
        $resultmihy = mysqli_query($db, $sqlmihy);

        if (mysqli_num_rows($result1) > 0 OR mysqli_num_rows($resultmihy) > 0) 
            $friendo=1;     
        else $friendo=0;

    }


    if ($friendo==1 || $flag==1 )
    {


        $sql = "SELECT * FROM sn_users WHERE user_id='$id'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $pic = $row['Profile_Picture'] ?>
                <img class="profilepicx" width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'>
                <div class="">
                     <?php echo "<br>" . "First Name: " . $row['Fname'] . "<br>" . "Last Name: " . $row['Lname'] . "<br>" . "Email: " . $row['email'] . "<br>" . "Gender: " . $row['Gender'] . "<br>" . "Birthdate: " . $row['Birthdate']. "<br>" . "Status: " . $row['Marital_Status']. "<br>"  . "Hometown: " . $row['Hometown']."<br>". "About : " . $row['About_me'];?>

                </div>
               
          <?php   }
//Add Friend
        }
        $sql = "SELECT * FROM phone_numbers WHERE user_id='$id'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br>" . $row['type']." : " . $row['ph_no'] ;
            }
//Add Friend
        }

    }
    else
    {
        $sql = "SELECT * FROM sn_users WHERE user_id='$id'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $pic = $row['Profile_Picture'] ?>
                <br><img width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'><br>
                <?php echo "<br>" . "First Name: " . $row['Fname'] . "<br>" . "Last Name: " . $row['Lname'] . "<br>" . "Email: " . $row['email'] . "<br>" . "Gender: " . $row['Gender']. "<br>"  . "Hometown: " . $row['Hometown']."<br>". "Status: " . $row['Marital_Status'] ;
            }
//Add Friend
        }
        $sql = "SELECT * FROM phone_numbers WHERE user_id='$id'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br>" .  $row['type']." : " . $row['ph_no'] ;
            }
//Add Friend
        }

    }


if ($flag==1){
    ?>
    <div class="input-group">
        <button type="submit" class="btn" name="editprofi" >Edit Profile</button>

    </div>



    <?php }

echo "<br>MY POSTS: <br>";
    if ($flag == 1) {


        $sql = "SELECT * FROM posts WHERE user_id='$id' ORDER BY post_id DESC";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $pic = $row['pic'] ;
                 $p = $row['post_id'];
                 
       if (!empty($pic)){;
       ?>
                <br><img class="" width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'><br>
                <?php  }
                echo "<br>" . $row['post'];
 ?>
                <br><button type="submit" class="btn" name="deletepost_btn" value="<?= $p ?>"> Delete </button><br><br>
                <?php

            }

        }

    } else {
        $sql = "SELECT * FROM friends WHERE user_id1='$id' AND user_id2 = '$userid'";
        $sqlmihy = "SELECT * FROM friends WHERE user_id1='$userid' AND user_id2 = '$id'";
        $result1 = mysqli_query($db, $sql);
        $resultmihy = mysqli_query($db, $sqlmihy);

        if (mysqli_num_rows($result1) > 0 OR mysqli_num_rows($resultmihy) > 0) {
            $delete = 2;
            $sql = "SELECT * FROM posts WHERE user_id='$id' ORDER BY post_id DESC";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {

                      $pic = $row['pic'] ;
       if (!empty($pic)){;
       ?>
                <br><img class="" width='150' height='200' src="pictures/<?= $pic ?>" alt='Default Profile Pic'><br>
                <?php  }
                echo "<br>" . $row['post'];

                }

            }


        } else {

            $sql = "SELECT * FROM posts WHERE user_id='$id' AND IsPublic ='1' ORDER BY post_id DESC";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<br>" . $row['post'];

                }

            }

        }

    }
    $uss = $_SESSION['userid'];
    $sql = "SELECT * FROM friend_request WHERE friendid='$id' AND user_id ='$uss'";

    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0)
        $delete = 4;


    ?>

</div>


<div>
    <?php
    if ($id != $_SESSION['userid']) {
        if ($delete == 0) {

            ?>

            <button type="submit" class="btn" name="addfriend_btn"> Add Friend</button>
            <?php } else if ($delete == 1) { ?>
            <button type="submit" class="btn" name="removefriend_btn"> Remove Request</button>
            <?php } else if ($delete == 2) { ?>
            <button type="submit" class="btn" name="deletefriend_btn"> Delete Friend</button>
            <?php } else if ($delete == 4) { ?>
            <button id=$row['user_id'] type="submit" class="btn" name="accept" value="<?= $id ?>">Accept</button>
            <?php $delete = 6;
        }
    }

    ?>


</div>


</form>


</body>
</html>