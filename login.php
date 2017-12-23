	<?php include('server_sender.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	
	<link rel="stylesheet" type="text/css" href="style2.css">
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
<body>

	<div class="header">
		<h2>Login</h2>
		
		
		</div>

	
	
	<form method="post" action="login.php" id="logy">
``
		<?php include('errors.php'); ?>

			<div class="fb-header">
			<div id="img1" class="fb-header"><img src="facebook.png" /></div>
			<div id="form1" class="fb-header">Email<br>
			<input placeholder="Email" type="mail" name="email" /><br>
			</div>
			
			<div id="form2" class="fb-header">Password<br>
			<input placeholder="Password" type="password" name="password">
			<button type="submit" class="submit" name="login_user" >Login</button>
			</div>
			
			</div>
			</form>
		<form method="post" action="login.php" id="formy" enctype = "multipart/form-data" >
		<div class="fb-body">
			<div id="intro1" class="fb-body">Facebook helps you connect and share with the <br>
			people in your life.</div>
			<div id="intro2" class="fb-body">Create an account</div>
			<div id="img2" class="fb-body"><img src="world.png" /></div>
			<div id="intro3" class="fb-body">It's free and always will be.</div>
			<div id="form3" class="fb-body">
				<input placeholder="First Name" type="text" id="namebox" name="fname" value="<?php  ?>">
				<input placeholder="Last Name" type="text" id="namebox" name="lname" value="<?php  ?>"> <br>
				<input  placeholder="Nickname" id="mailbox" type="text" name="Nick" value="<?php  ?>">
				<input placeholder="Email" id="mailbox" type="email" name="email" value="<?php  ?>"><br>
		
				<input placeholder="Password" type="password" id="mailbox" name="password_1" value="<?php  ?>"><br>
				<input placeholder="Renter-Password" type="password" id="mailbox" name="password_2" value="<?php  ?>"><br>
				<input type="date" id="namebox" name="bdate" value="<?php  ?>">
				<input placeholder="Hometown" type="text" id="mailbox" name="Hometown" value="<?php  ?>"><br>
				<input type="radio" id="r-b" name="select" value="MALE" checked="checked"/>Male
				<input type="radio" id="r-b" name="select" value="FEMALE" />Female<br>
				
				<input placeholder="About Me" id="namebox" type="text" name="aboutme" value="<?php  ?>"><br>
				<input type="radio" id="r-b" name="radio" value="Single" checked="checked"> Single
				<input type="radio" id="r-b" name="radio" value="Engaged"> Engaged
				<input type="radio" id="r-b" name="radio" value="Married"> Married
				
				<p class="number">
				<input placeholder="Phone_Number" id="namebox" type="text" name="phone[]"  class="sf" />
				<select name="type[]">
					<option value="Office">Office</option>
					<option value="Cell">Cell</option>
					<option Value="Fax">Fax</option>
				</select>
			</p>
			<a href="javascript:void();" class="add_phone">Add More</a>

			</textarea><br>
	<img width='100' height='100' src='pictures/male.jpg' alt='Default Profile Pic'><br>
	 Select image to upload:
    <input type = "file" class="button2" name = "image" />
    

				<br>

				
				


				<p id="intro4">By clicking Create an account, you agree to our Terms and that 
				you have read our Data Policy, including our Cookie Use.</p>
				<button type="submit" class="button2" name="reg_user" >Create Account</button>
				<br><hr>
				
			</div>
			
		</div>

	</form>

</body>
</html>