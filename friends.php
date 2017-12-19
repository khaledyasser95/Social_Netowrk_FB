<?php include('server_sender.php');
$userid = $_SESSION['userid'] ;
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Friends</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
  <div class="header">
    <h2>Friends</h2>
  </div>
  <form method="post" action="requests.php" id="req_form"  >
   <a href="Home.php"> Home</a>
   <a href='profile.php?id=<?php echo $userid;  ?>' >Profile</a>

   <a href="requests.php"> Friend Requests</a>
   <a href="friends.php"> Friends</a>  
   <a href="login.php"> Logout</a> 
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
        $q="SELECT Fname,Lname FROM sn_users WHERE user_id='$id2' ";
        $reso=mysqli_query($db,$q);
        if ($reso->num_rows > 0)
        {
          while($row1 = $reso->fetch_assoc()) 
            {  ?>
              <?php //echo $row1['Fname'] 



               ?> 
 <a href='profile.php?id=<?php echo $id2;  ?>' > 
        <h3><?php echo $row1['Fname']." " .$row1['Lname']. "<br>"; }
       ?></h3> 
   </a>


              <?php  }
            }
          
        
          


          else if ($rs['user_id2'] == $userid )
          {
            
           $id1=$rs['user_id1'];
           $q="SELECT Fname,Lname FROM sn_users WHERE user_id='$id1' ";
           $reso=mysqli_query($db,$q);
           if ($reso->num_rows > 0)
           {
            while($row1 = $reso->fetch_assoc()) 
              {  ?>
                <a href='profile.php?id=<?php echo $id1;  ?>' > 
        <h3><?php echo $row1['Fname']." " .$row1['Lname']. "<br>"; }
       ?></h3> 
   </a>


            <?php  }
            }}}?>



          </form>

        </body>
        </html>