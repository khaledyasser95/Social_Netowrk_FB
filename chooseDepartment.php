<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
	$db = mysqli_connect('localhost', 'root', '', 'Regy');

	$sql=mysqli_query($db,"SELECT dept_id,name 	FROM `department` ");
	


?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DEPARTMENT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	<div class="header">
		<h2>Department</h2>
	</div>

	
	<form method="post" action="chooseDepartment.php">

		<?php include('errors.php'); ?>

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
	
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong ><?php echo $_SESSION['username']; ?></strong > please choose your department</p>

		
		<div class="dropdown">

		<?php 
		if(mysqli_num_rows($sql)){

			$select= '<select id="mySelect" name="select">';
			while($rs = $sql->fetch_assoc() ){
				
        $select.='<option class="dropdown-content" value="'.$rs['dept_id'].'">'.$rs['name'].'</option>';
  	}
	}
		$select.='</select>';
		echo $select;
 ?>
 

	

 </div>
		<div class="input-group">
			<button type="submit" class="btn" name="sub_user">Submit</button>
		</div>
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
		
	</form>



</body>
</html>


