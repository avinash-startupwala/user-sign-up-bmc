<?php
require_once("heroku_postgres_database.php");

  // Start the session
       $save_username;
  session_start();


  // Clear the error message
  $error_msg = "";

print_r($_POST);

echo "<br>";

 if (isset($_POST['submit'])) {
 echo "submit is set";
 }

else {
echo "sumbit is NOT set";
}

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {

      // Connect to the database

      $herokupostgrsdatabse = new HerokuPostgresDatabase();
      // $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username =  $herokupostgrsdatabse->escape_value(trim($_POST['email']));

     // $save_username = $user_username;
      $user_password =  $herokupostgrsdatabse->escape_value(trim($_POST['password']));

     
        // Look up the username and password in the database
        $query = "SELECT user_id, email FROM registered_users WHERE email = '$user_username' AND password = '$user_password'";
        $data = $herokupostgrsdatabse->query($query);

        if (pg_num_rows($data) == 1) 
        {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = $herokupostgrsdatabse->fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['email'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['email'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      

    }
  



?>


<?php
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>


<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
  }
?>

</body>
</html>
