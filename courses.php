
<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	$db = mysqli_connect('localhost', 'root', '', 'social_network');
	$department=$_SESSION['dept_id'];
	$sql=mysqli_query($db,"SELECT course_id,course_name 	FROM `course` where department_id='$department'");
	$number=mysqli_num_rows($sql) 


?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>COURSES</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Course</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<p>Welcome <strong ><?php echo $_SESSION['username']; ?></strong > please choose your department</p>
		</div>
	<div class="dropdown">

		<?php 

		if(mysqli_num_rows($sql)){

			$select= '<select id="mySelect" name="selectcourse" >';
			while($rs = $sql->fetch_assoc() ){
				
         $select.='<option class="dropdown-content" value="'.$rs['course_id'].'">'.$rs['course_name'].'</option>';

  	}
	}
		$select.='</select>';
	




		echo $select;
		
 ?>
<div class="xx">
			<?php 
				$sql=mysqli_query($db,"SELECT course_id,course_name 	FROM `course` where department_id='$department'");
	while($rs = $sql->fetch_assoc() ){
				
			 ?>
			<li><?php echo $rs['course_name']  ?> </li>
			<?php } ?>

		</div>
 </div>

		<div class="input-group">
			<button type="submit" class="btn" name="sub">Submit</button>
		</div>
		
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	</form>
</body>
</html>