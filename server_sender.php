
<?php 

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 
$username="";
$email="";
$errors=array();
$_SESSION['username'] = $username;


//connect to database
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbase = "social_network";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'social_network');

if (isset($_POST['search_btn']))
{

	if ( !empty($_POST['search']))
	{

		$search = $_POST['search'];
     //echo $search ;
		$sql = "SELECT * FROM sn_users WHERE Fname='$search' OR Lname='$search'";
		$result=mysqli_query($db,$sql);
		if (mysqli_num_rows($result) > 0  ) {
			$searched_ids = array();
			$x = 0;
			while($row = $result->fetch_assoc()) {
				array_push($searched_ids, $row['user_id']);


			}
			$_SESSION['searched_ids'] = $searched_ids;
			header('location: search.php');


		}
	} else
	{
		echo "USER NOT FOUND";
	}
//header('search.php');
}

if (isset($_POST['addfriend_btn']))
{
	$userid = $_SESSION['userid'];
	$friendid= $_SESSION['friendid'];
		$query = "INSERT INTO friend_request (user_id, friendid) 
		VALUES('$friendid', '$userid')";
		mysqli_query($db, $query);
	

}
if (isset($_POST['removefriend_btn']))
{
	$friendid= $_SESSION['friendid'];
$userid = $_SESSION['userid'];
		$query = "DELETE FROM friend_request WHERE user_id='$userid' AND friendid='$friendid'";
		mysqli_query($db, $query);
	

}

if (isset($_POST['post_btn']))
{
	$Post = mysqli_real_escape_string($db, $_POST['post']);
	$userid = $_SESSION['userid'];

	$query = "INSERT INTO posts (user_id,post,IsPublic) 
		VALUES('$userid', '$Post', 0)";
		mysqli_query($db, $query);

}



if (isset($_POST['accept']))
{
	$userid = $_SESSION['userid'];
	$accept=$_POST['accept'];
	echo $accept;
	$query = "INSERT INTO friends (user_id1,user_id2) 
		VALUES('$userid', '$accept')";
		mysqli_query($db, $query);

	$query = "DELETE FROM friend_request WHERE user_id='$userid' AND friendid='$accept'";
		mysqli_query($db, $query);

}

if (isset($_POST['Decline']))
{
	$userid = $_SESSION['userid'];
	$accept=$_POST['Decline'];
	$query = "DELETE FROM friend_request WHERE user_id='$userid' AND friendid='$accept'";
		mysqli_query($db, $query);

}

if (isset($_POST['deletefriend_btn']))
{
	$friendid= $_SESSION['friendid'];
	$userid = $_SESSION['userid'];
		$query = "DELETE FROM friends WHERE user_id1='$userid' AND user_id2='$friendid'";
		mysqli_query($db, $query);
		$query = "DELETE FROM friends WHERE user_id1='$friendid' AND user_id2='$userid'";
		mysqli_query($db, $query);

}
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


//  $imgFile= mysqli_real_escape_string($db, $_FILES['usr_img']['name']);
//$tmp_dir = mysqli_real_escape_string($db, $_FILES['usr_img']['tmp_name']);
//$imgSize = mysqli_real_escape_string($db, $_FILES['usr_img']['size']);




	if($Gender=="MALE")
		$bit=0;
	if($Gender=="FEMALE")
		$bit=1;

	// form validation: ensure that the form is correctly filled
	if (empty($Firstname)) { array_push($errors, "First Name is required"); }
	if (empty($lastname)) { array_push($errors, "Last Name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($Gender)) { array_push($errors, "Gender is required"); }
	if (empty($bdate)) { array_push($errors, "Birthdate is required"); }

	if (empty($imgFile))
	{

		if($bit==1)
			$userpic="female.jpg";
		else
			$userpic="male.jpg";

	}
	else
	{
//echo "TMAAAAAAAAAAAAAAAAAM";
   $upload_dir = 'pictures/'; // upload directory

   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;

// allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
// Check file size '5MB'
   	if($imgSize < 5000000)    {
   		move_uploaded_file($tmp_dir,$upload_dir.$userpic);
 //echo "<img width='100' height='100' src='$upload_dir.$userpic' alt='Default Profile Pic'>";
   	}
   	else{
   		array_push($errors, "Sorry, your file is too large.");
   		
   	}
   }
   else{
   	array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
   	
   }


}

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
		$query = "INSERT INTO sn_users (Fname, Lname, email,password,Gender,Birthdate,Profile_Picture) 
		VALUES('$Firstname', '$lastname', '$email','$password','$Gender','$bdate','$userpic')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		//header('location: Home.php');
	}

}

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	/**
		Check if Username / Password == Null
		*/
		if (empty($email)) {
			array_push($errors, "Email is required");
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
		$query = "SELECT * FROM sn_users WHERE email='$email' AND password='$password'";
		//Result in the code
		$results = mysqli_query($db, $query);
		//Check if department == null
		//$sql="SELECT username,department_id FROM users WHERE department_id IS NULL AND username='$username'";
		//Result from the database
		$reso=mysqli_query($db,$query);
		//If there is result
		if (mysqli_num_rows($reso) == 1 ) {
			while($row = $reso->fetch_assoc()) {
				echo "<tr><td>".$row["user_id"]."</td><td>".$row["Fname"]." ".$row["Lname"]."</td></tr>";
				
				$_SESSION['userid'] = $row["user_id"];
				$_SESSION['user_name']= $row["Fname"];
				$_SESSION['user_id'] = $username;
				$_SESSION['success'] = "You are now logged in";

			//Redirect to choose Department
				header('location: Home.php');
			}
			
		}else {

			array_push($errors, "Wrong username/password combination");
		}
	}
	

	
}
//Department



?>
