<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>

<!DOCTYPE html>
<head>
  <title>Startupwala - Edit Profile</title>

</head>
<body>
  <h3>Startupwala - Edit Profile</h3>

<?php
require_once("heroku_postgres_database.php");

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="https://startupwala.herokuapp.com/login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
  }

  // Connect to the database
 $herokupostgrsdatabse = new HerokuPostgresDatabase();

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $first_name = $herokupostgrsdatabse->escape_value(trim($_POST['firstname']));
    $last_name = $herokupostgrsdatabse->escape_value(trim($_POST['lastname']));
	 $city =$herokupostgrsdatabse->escape_value(trim($_POST['city']));
	 $phone =  $herokupostgrsdatabse->escape_value(trim($_POST['phone']));
    $lookingfor = $herokupostgrsdatabse->escape_value(trim($_POST['looking_for']));

    $error = false;


    // Update the profile data in the database
    if (!$error) {
      if (!empty($first_name) && !empty($last_name) && !empty($city) && !empty($phone) && !empty($lookingfor)) {
        // Only set the picture column if there is a new picture
     
          $update_user_data_query = "UPDATE registered_users SET first_name = '$first_name', last_name = '$last_name', " .
            " phone = '$phone', city = '$city', looking_for = '$lookingfor' WHERE user_id = '" . $_SESSION['user_id'] . "'";
       
       
$update_user_data_result =  $herokupostgrsdatabse->query($update_user_data_query);
        // Confirm success with the user
        echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';

        exit();
      }
      else {
        echo '<p class="error">You must enter all of the profile data (the picture is optional).</p>';
      }
    }
  } // End of check for form submission
  else {
    // Grab the profile data from the database
    $fetch_user_data = "SELECT  first_name, last_name, email, phone,city, looking_for FROM registered_users WHERE user_id  = '" . $_SESSION['user_id'] . "'";
  $fetch_user_data_result =  $herokupostgrsdatabse->query($fetch_user_data);

    $row = pg_fetch_array($fetch_user_data_result);

    if ($row != NULL) {
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $city = $row['city'];
      $phone = $row['phone'];
      $lookingfor = $row['looking_for'];

    }
    else {
      echo '<p class="error">There was a problem accessing your profile.</p>';
    }
  }


?>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
    <fieldset>
      <legend>Personal Information</legend>
      <label for="firstname">First name:</label>
      <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
      <label for="lastname">Last name:</label>
      <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
 
 
      <label for="city">City:</label>
      <input type="text" id="city" name="city" value="<?php if (!empty($city)) echo $city; ?>" /><br />
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" value="<?php if (!empty($phone)) echo $phone; ?>" /><br />
  
  <label for="looking_for">Looking For:</label>
      <input type="text" id="looking_for" name="looking_for" value="<?php if (!empty($looking_for)) echo $looking_for; ?>" /><br />

    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
  </form>
</body> 
</html>
