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
  $imgFile= mysqli_real_escape_string($db, $_FILES['usr_img']['name']);
  $tmp_dir = mysqli_real_escape_string($db, $_FILES['usr_img']['tmp_name']);
  $imgSize = mysqli_real_escape_string($db, $_FILES['usr_img']['size']);
 
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
      //header('location: index.php');
    }

  }

?>
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

  <form method="post" action="register_n.php" id="formy"  >

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
