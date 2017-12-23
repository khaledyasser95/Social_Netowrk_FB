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
  <link rel="stylesheet" type="text/css" href="style.css">
   <link rel="stylesheet" type="text/css" href="ust.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Friends</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

  <form method="post" action="friends.php" id="req_form"  >
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
   $sql="SELECT user_id1,user_id2 FROM Friends WHERE user_id1='$userid' OR user_id2='$userid'";
#$sql="SELECT sn_users.Fname,sn_users.Lname,friends.user_id1,friends.user_id2 FROM friends inner join sn_users on user_id1='$userid' OR user_id2='$userid'";

   $result=mysqli_query($db,$sql);
   if (mysqli_num_rows($result) > 0)
   {
     while($rs = $result->fetch_assoc() )
     {
       if ($rs['user_id1'] == $userid )
       {
        $id2=$rs['user_id2'];
        $q="SELECT Fname,Lname,Profile_Picture FROM sn_users WHERE user_id='$id2' ";
        $reso=mysqli_query($db,$q);
        if ($reso->num_rows > 0)
        {
          while($row1 = $reso->fetch_assoc()) 
            {  $pic = $row1['Profile_Picture']  ?>
              <?php //echo $row1['Fname'] 



               ?> 
               <div >
           <li class="w3-bar"> 
<span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>
      <img src="pictures/<?= $pic ?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
             <a id="test" href='profile.php?id=<?php echo $id2;  ?>' > 
                  <div class="w3-bar-item">  <span class="w3-large" ><?php echo $row1['Fname']." " .$row1['Lname']. "<br>"; }
                   ?></span><br> </div>
               </a> </li>
        </div>

              <?php  }
            }
          
        
          


          else if ($rs['user_id2'] == $userid )
          {
            
           $id1=$rs['user_id1'];
           $q="SELECT Fname,Lname,Profile_Picture FROM sn_users WHERE user_id='$id1' ";
           $reso=mysqli_query($db,$q);
           if ($reso->num_rows > 0)
           {
            while($row1 = $reso->fetch_assoc()) 
              { $pic = $row1['Profile_Picture']  ?>
                 <div >
           <li class="w3-bar">  
         <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>
         <img src="pictures/<?= $pic ?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px">
            <a id="test" href='profile.php?id=<?php echo $id1;  ?>' > 
                  <div class="w3-bar-item">  <span class="w3-large" ><?php echo $row1['Fname']." " .$row1['Lname']. "<br>"; }
                   ?></span><br> </div>
               </a> </li>
        </div>



            <?php  }
            }}}?>
             </form>
        </body>
        </html>