<?php 
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
$username="";
$email="";
$errors=array();

//connect to database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbase = "social_network";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'social_network');


// REGISTER USER
if (isset($_POST['reg_user'])) {
		// receive all input values from the form
	$Firstname = mysqli_real_escape_string($db, $_POST['fname']);
	$lastname = mysqli_real_escape_string($db, $_POST['lname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$Gender = mysqli_real_escape_string($db, $_POST['select']);
	$bdate = mysqli_real_escape_string($db, $_POST['bdate']);

		// form validation: ensure that the form is correctly filled
	if (empty($Firstname)) { array_push($errors, "First Name is required"); }
	if (empty($lastname)) { array_push($errors, "Last Name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($Gender)) { array_push($errors, "Gender is required"); }
	if (empty($bdate)) { array_push($errors, "Birthdate is required"); }
	

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
		//Find in the database the username
	$sql="SELECT email FROM sn_users WHERE email='$email'";
	$result=mysqli_query($db,$sql);
	if (mysqli_num_rows($result) == 1 )
		array_push($errors, "User Already Exists");
		// register user if there are no errors in the form
	if (count($errors) == 0) {
			//Password Encryption 
			$password = md5($password_1);//encrypt the password before saving in the database
			//Insert into Database
			$query = "INSERT INTO sn_users (Fname, Lname, email,password,Gender,Birthdate) 
			VALUES('$Firstname', '$lastname', '$email','$password','$Gender','$bdate')";
			mysqli_query($db, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		/**
			Check if Username / Password == Null
			*/
			if (empty($username)) {
				array_push($errors, "Username is required");
			}
			if (empty($password)) {
				array_push($errors, "Password is required");
			}

			if (count($errors) == 0) {

			/**
			Password Encryption using MD5
			*/
			$password = md5($password);
			//Find in the query 
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			//Result in the code
			$results = mysqli_query($db, $query);
			//Check if department == null
			$sql="SELECT username,department_id FROM users WHERE department_id IS NULL AND username='$username'";
			//Result from the database
			$reso=mysqli_query($db,$sql);
			//If there is result
			if (mysqli_num_rows($results) == 1 ) {
				if (mysqli_num_rows($reso)){
					$_SESSION['username'] = $username;
					$_SESSION['success'] = "You are now logged in";

				//Redirect to choose Department
					header('location: chooseDepartment.php');
				}else{
					$sql="SELECT username,department_id FROM users WHERE department_id IS NOT NULL AND username='$username'";
					$reso=mysqli_query($db,$sql);
					$rs = $reso->fetch_assoc();
					$_SESSION['dept_id']=$rs['department_id'];
					$_SESSION['username'] = $username;
					header('location: courses.php');
				}
				
			}else {

				array_push($errors, "Wrong username/password combination");
			}
		}
	}


	//Department
	


	if (isset($_POST['sub_user'])) {
	//Get username ID
		$username1=$_SESSION['username'];
		$sql1=mysqli_query($db,"SELECT user_id FROM `users` where username='$username1'");
		$result1=mysqli_num_rows($sql1) ;
		$rs = $sql1->fetch_assoc();
		$usernameID=$rs['user_id'];


		$dept_ID=$_POST['select'];
		$_SESSION['dept_id']= $dept_ID;
  	// Insert into Database
		$sql2=mysqli_query($db,"UPDATE users SET department_id='$dept_ID' WHERE user_id='$usernameID'");
		header('location: courses.php');

	}

	if (isset($_POST['sub'])) {
	//Get username ID
		$username1=$_SESSION['username'];
		$dept_ID=$_POST['selectcourse'];
		$_SESSION['dept_id'] = $dept_ID;
		echo $_SESSION['dept_id']  ;
	}

	?>
