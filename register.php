	<?php include('server_sender.php') ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Registration system PHP and MySQL</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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

	<div class="header" >
		<h2>Register</h2>
		<body >

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script>
				$(document).ready(function(){
					$("#hide").click(function(){
						$("#formy").hide(1000);
					});
					$("#show").click(function(){
						$("#formy").show(1000);
					});
				});
			</script>	
			<div class="input-group">
				<button id="hide" class="btn">Hide</button>
				<button id="show" class="btn">Show</button>
			</div>

		</body>
	</div>

	<form method="post" action="register.php" id="formy"  >

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="fname" value="<?php  ?>">
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="lname" value="<?php  ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<label>Gender</label>
			<select name="select">
				<option value="MALE" name="male">MALE</option>
				<option value="FEMALE" name="female">FEMALE</option>
			</select>
		</div>
		<div class="input-group">
			<label>Birthdate</label>
			<input type="date" name="bdate" value="<?php  ?>">
		</div>

		
		<div class="input-group">
			
			<p class="number">
				<label for="name">Phone Number</label>
				<input type="text" name="phone[]"  class="sf" />
				<select name="type[]">
					<option value="Office">Office</option>
					<option value="Cell">Cell</option>
					<option Value="Fax">Fax</option>
				</select>
			</p>
			<a href="javascript:void();" class="add_phone">Add More</a>
		</div>
		
	</textarea><br>
	<img width='100' height='100' src='pictures/male.jpg' alt='Default Profile Pic'><br>


		<FONT size="5" COLOR="#000059">Choose your profile picture:</FONT></a><br>

		<input type="file" name="usr_img" id="fileToUpload" >


	<div class="input-group">
		<button type="submit" class="btn" name="reg_user">Register</button>
	</div>

	
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>


</form>


</body>
</html>