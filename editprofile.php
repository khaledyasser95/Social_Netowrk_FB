	<?php include('server_sender.php');
	$userID=$_SESSION['userid'];

$query = "SELECT * FROM sn_users WHERE user_id='$userID'";
		$reso = mysqli_query($db, $query);
		if (mysqli_num_rows($reso) == 1 ) {
			while($row = $reso->fetch_assoc()) 
				{
					$Fname=$row['Fname'];
					$Lname=$row['Lname'];
					$Nick=$row['Nickname'];
					$email=$row['email'];
					$Gender=$row['Gender'];
					$Birthdate=$row['Birthdate'];
					$Profile_Picture=$row['Profile_Picture'];
					$Hometown=$row['Hometown'];
					$Marital_Status=$row['Marital_Status'];
					$About_me=$row['About_me'];
					

				}
			}
			$_SESSION['Prof']=$Profile_Picture ;
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
		<title>Edit Profile</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		 <link type="text/css" rel="stylesheet" href="ust.css" >
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
<!-- DONT FORGET TO INCLUDE JQUERY //-->
$(document).ready(function() {
	$('.add_phone').click(function() {
		$('p.number:last').after('<p class="number">'+ $('p.number').html() +'</p>');
	});
});
</script>
</head>

<body >


	<form method="post" action="editprofile.php" id="formy" enctype = "multipart/form-data" >
<div class="header1">
      <div id="img3" ><img src="facebook.png" id="img3"/></div>
      <div id="searcharea" class="header1"><input placeholder="search here..." type="text" id="searchbox"/></div>
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
		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>First Name : <?= $Fname ?></label>
			<input type="text" name="editfname" value="<?php echo $Fname; ?>">
		</div>
		<div class="input-group">
			<label>Last Name : <?= $Lname ?></label>
			<input type="text" name="editlname" value="<?php echo $Lname; ?>">
		</div>
		<div class="input-group">
			<label>Nick Name : <?= $Nick ?></label>
			<input type="text" name="editNick" value="<?php echo $Nick ?>">
		</div>
		<div class="input-group">
			<label>Email : <?= $email ?></label>
			<input type="email" name="editemail" value="<?php echo $email; ?>">
		</div>
		
		<div class="input-group">
			<label>Gender : <?= $Gender ?></label>
			<select id="boxy2" name="editselect" value="<?php echo $Gender; ?>">
				<option value="MALE" name="male">MALE</option>
				<option value="FEMALE" name="female">FEMALE</option>
			</select>
		</div><br><br>
		<div class="input-group">
			<label>Birthdate :<?= $Birthdate ?></label>
			<input type="date" name="editbdate" value="<?php echo $Birthdate ?>">
		</div>

		<div class="input-group">
			<label>Hometown :<?= $Hometown ?></label>
			<input type="text" name="editHometown" value="<?php echo $Hometown ?>">
		</div>

		<div class="input-group">
			<label>Status : <?= $Marital_Status ?></label>
		</div>
			<input type="radio" name="editradio" value="Single"> Single
			<input type="radio" name="editradio" value="Engaged"> Engaged
			<input type="radio" name="editradio" value="Married"> Married

		<div class="input-group">
			<label>About me : <?= $About_me ?></label>
			<input type="text" name="editaboutme" value="<?php echo $About_me ?>">
		</div>

		
	<br><img width='200' height='200' src="pictures/<?= $Profile_Picture ?>" name="picy"  alt='Default Profile Pic' value="<?= $Profile_Picture ?>"><br>
    <input type = "file" name = "image" value="<?= $Profile_Picture ?>"/>
    

	<div class="input-group">
		<button type="submit" class="btn" name="editprofile" >Save</button>
	</div>



</form>


</body>
</html>