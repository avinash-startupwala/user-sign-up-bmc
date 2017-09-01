<?php
  error_reporting(E_ALL);
    ini_set('display_errors', 1);

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    echo "\n";
    echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
    echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    echo '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
  }
  else {
    ?>
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
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab "><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
         <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name = "email" id="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" id="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="forgotpassword.php">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="signup.php" method="post">
        
          
            <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" id="first_name" name="first_name" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" id="last_name" name="last_name" required autocomplete="off"/>
            </div>
          </div>

            <div class="top-row">
             <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"  id="email" name="email" required autocomplete="off"/>
          </div>
         
          
          <div class="field-wrap">
            <label>
              Mobile No<span class="req">*</span>
            </label>
            <input type="text"  id="phone" name="phone" required autocomplete="off"/>
          </div>
          </div>
          
              <div class="field-wrap">
            <label>
              City<span class="req">*</span>
            </label>
            <input type="text"  id="city" name="city" required autocomplete="off"/>
          </div>


<div class = "select-style">
 

            <select id="looking_for" name="00N90000002GeUl">
            <option value="">Looking For*</option>
            <option value="One Person Company Registration">One Person Company Registration</option>
            <option value="Pvt. Ltd. Registration">Pvt. Ltd. Registration</option>
            <option value="LLP Registration">LLP Registration</option>
            <option value="Trademark Registration">Trademark Registration</option>
            <option value="GST Registration">GST Registration</option>
            <option value="MSME Registration">MSME Registration</option>
            <option value="ISO Certification">ISO Certification</option>
            <option value="Other Services">Other Services</option>                        
          </select>
      
          </div>
  

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" id="password" name="password" required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block"/>Get Started</button>
          
          </form>


        


          </div>
        
       
  
      
</div> <!-- /form -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>


  <?php
}
?>
