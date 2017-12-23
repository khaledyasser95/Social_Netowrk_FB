
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
		$searched_ids = array();
		$searched_posts = array();

	if ( !empty($_POST['search']))
	{
		$f = 0;
		$search = $_POST['search'];


		$sql="SELECT * FROM sn_users WHERE Fname='$search' OR Lname='$search' OR email='$search' OR Hometown='$search' ";
		$result=mysqli_query($db,$sql);
		$f++;
		if (mysqli_num_rows($result) > 0  ) {
			while($row = $result->fetch_assoc()) {
				array_push($searched_ids, $row['user_id']);
			}
		}
		$_SESSION['searched_ids'] = $searched_ids;
		
		


		$sql2="SELECT * FROM posts WHERE post LIKE UPPER('%$search%') OR post LIKE LOWER('%$search%') ";
		$result1=mysqli_query($db,$sql2);
		if (mysqli_num_rows($result1) > 0  ) {
			$searched_posts = array();
			reset($searched_posts);
			while($row1 = $result1->fetch_assoc()) {
				array_push($searched_posts, $row1['post_id']);
			}
		}
$_SESSION['searched_posts'] = $searched_posts;
header('location: search.php');

		if ($f == 2)
		{//header('location: search.php')


	;}
		else 
			{//echo "No matching searches";
			array_push($errors, "No matching searches");
	}

	}

	 else
	{
		array_push($errors, "USER NOT FOUND");
		//echo "USER NOT FOUND";
	}



//header('search.php');
}


if (isset($_POST['deletepost_btn']))
{
	//$idlike=$_SESSION['userid'];
	
	$post = mysqli_real_escape_string($db, $_POST['deletepost_btn']);
	
   $query = "DELETE FROM posts WHERE post_id='$post'";
			mysqli_query($db, $query);

			header('location: profile.php?id=-1');
		
}




if (isset($_POST['like_btn']))
{
	$idlike=$_SESSION['userid'];
	
	$post = mysqli_real_escape_string($db, $_POST['like_btn']);
	
   $query = "INSERT INTO likes(post_id,user_id) 
			VALUES('$post','$idlike')";
			mysqli_query($db, $query);
}

if (isset($_POST['liked_btn']))
{
	$idlike=$_SESSION['userid'];
	//echo $idlike;
	$post = mysqli_real_escape_string($db, $_POST['liked_btn']);
	//echo $idlike;
   $query = "DELETE FROM likes WHERE user_id='$idlike' AND post_id='$post'";
			mysqli_query($db, $query);
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

	if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_tmp = $_FILES['fileToUpload']['tmp_name'];
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"pictures/".$file_name);
         $flaggy=1;
      }else{
         print_r($errors);
      }
   }else
   {
   	$file_name=NULL;
   }

	if (!empty($Post))
	{
		$userid = $_SESSION['userid'];
	$selected_val = $_POST['privacy'];
	$query = "INSERT INTO posts (user_id,pic,post,IsPublic) 
		VALUES('$userid','$file_name', '$Post', '$selected_val')";
		mysqli_query($db, $query);
	}

}

if (isset($_POST['editprofi']))
{
header('location: editprofile.php');

}

if (isset($_POST['accept']))
{
	$userid = $_SESSION['userid'];
	$accept=$_POST['accept'];



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

if (isset($_POST['editprofile']))
{
	$userid = $_SESSION['userid'];
	$Firstname = mysqli_real_escape_string($db, $_POST['editfname']);
	$lastname = mysqli_real_escape_string($db, $_POST['editlname']);
	$email = mysqli_real_escape_string($db, $_POST['editemail']);
	$Gender = mysqli_real_escape_string($db, $_POST['editselect']);
	$bdate = mysqli_real_escape_string($db, $_POST['editbdate']);
	$Nick_name = mysqli_real_escape_string($db, $_POST['editNick']);
	$Hometown = mysqli_real_escape_string($db, $_POST['editHometown']);
	$Status = mysqli_real_escape_string($db, $_POST['editradio']);
	$aboutme = mysqli_real_escape_string($db, $_POST['editaboutme']);
	

if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"pictures/".$file_name);
         $flaggy=1;
      }else{
         print_r($errors);
      }
   }

   	if (empty($file_name))
	{

$pp = $_SESSION['Prof'];
	
		$file_name = $pp;

	}
	else
	{
		$sql = "INSERT INTO posts (user_id,pic,post,IsPublic) 
		VALUES('$userid', '$file_name', '$Firstname $lastname has changed the profile picture', 0)";
		mysqli_query($db, $sql);
	}

$sql = "UPDATE sn_users SET Fname='$Firstname' , Lname='$lastname' , email = '$email' , Gender = '$Gender' , Birthdate = '$bdate' , Nickname = '$Nick_name' , Hometown = '$Hometown' , Marital_Status = '$Status' , About_me = '$aboutme' , Profile_Picture = '$file_name' WHERE user_id='$userid'";


mysqli_query($db, $sql);

header('location: profile.php?id=-1');
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
	$Nick_name = mysqli_real_escape_string($db, $_POST['Nick']);
	$Hometown = mysqli_real_escape_string($db, $_POST['Hometown']);
	$Status = mysqli_real_escape_string($db, $_POST['radio']);
	$aboutme = mysqli_real_escape_string($db, $_POST['aboutme']);
if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"pictures/".$file_name);
         $flaggy=1;
      }else{
         print_r($errors);
      }
   }
$bit=0;
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

	if (empty($file_name))
	{

		if($bit==1)
			$file_name="female.jpg";
		else
			$file_name="male.jpg";

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
		$query = "INSERT INTO sn_users(Fname, Lname, Nickname, email, password, Gender, Birthdate, Profile_Picture, Hometown, Marital_Status, About_me)
		VALUES('$Firstname', '$lastname','$Nick_name', '$email','$password','$Gender','$bdate','$file_name','$Hometown','$Status','$aboutme')";
		mysqli_query($db, $query);

		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		//header('location: Home.php');
	}

	$sql="SELECT user_id FROM sn_users WHERE email='$email'";
	$result=mysqli_query($db,$sql);
		if (mysqli_num_rows($result) == 1 ) 
			{
		while($row = $result->fetch_assoc()) {
				$reg_ID=$row['user_id'];
			}
		}else $reg_ID=NULL;
	 if(isset($_POST['phone']) && !empty($reg_ID))
      {


      	for( $i = 0; $i < count($_POST['phone']); $i++ )
      {
        $phone=$_POST['phone'][$i];
        $type=$_POST['type'][$i];
       # echo $type .' = '. $phone .'<br >';
      	$query = "INSERT INTO phone_numbers (user_id,ph_no,type)  VALUES('$reg_ID','$phone','$type');";
        mysqli_query($db, $query);
        
      }
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
				//echo "<tr><td>".$row["user_id"]."</td><td>".$row["Fname"]." ".$row["Lname"]."</td></tr>";
				
				$_SESSION['userid'] = $row["user_id"];
				$nickname=$row['Nickname'];
				if (empty($nickname))
				{
					$_SESSION['user_name']= $row["Fname"]." ".$row['Lname'];
				}
				else
					$_SESSION['user_name']= $nickname;

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
