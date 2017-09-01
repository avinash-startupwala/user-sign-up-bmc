<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sign-Up Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<?php
  if(isset($_POST['email']))
  {
  require_once("heroku_postgres_database.php");
  $email = $_POST['email'];
 $herokupostgrsdatabse = new HerokuPostgresDatabase();
$selectquery = "select * from registered_users where email = '$email' ";
$select_result =  $herokupostgrsdatabse->query($selectquery);
  if (pg_num_rows($select_result) == 1) 
        {
$password = $_POST['password'];
$email = $_POST['email'];
          $update_user_data_query = "UPDATE registered_users SET password = '$password' WHERE email = '$email'";
$update_user_data_result =  $herokupostgrsdatabse->query($update_user_data_query);
echo "Password Changed Successfully";
    echo "<br>";
    echo "You can log in now";
    echo "<br>";

    ?>
     <a href="loginform.php" class="button button-block"/>Log In</a>
     <?php
     //echo '&#10084; <a href="loginform.php">Log In</a><br />';
}
else {
  echo "You are not a valid user";
}
}
else {
  echo "Enter your email and new password";
?>
  
  <div class="form">
      

      
    
        
  <div id="login">   
          <h1>Welcome Back!</h1>
          
         <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          
            <div class="field-wrap">
            <label>
              Registered Email Address<span class="req">*</span>
            </label>
            <input type="email" id="email" name="email"  required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              New Password<span class="req">*</span>
            </label>
            <input type="password" id="password" name="password" required autocomplete="off"/>
          </div>
          

          <button type="submit" class="button button-block"/>Change Password</button>
          
          </form>


  
      
</div> <!-- /form -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
<?php
}
?>
