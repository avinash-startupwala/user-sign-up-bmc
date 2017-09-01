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
  <title>Startupwala - View Profile</title>
</head>
<body>
  <h3>Startupwala - View Profile</h3>

<?php
 

	require_once("heroku_postgres_database.php");

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
  }

  // Connect to the database
	$herokupostgrsdatabse = new HerokuPostgresDatabase();
  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    // $query = "SELECT username, first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_SESSION['user_id'] . "'";



$fetch_user_data=  "SELECT  user_id, first_name, last_name, email, phone,city, looking_for FROM registered_users WHERE user_id = '" . $_SESSION['user_id'] . "'";


  }
  else {
    $fetch_user_data = "SELECT  first_name, last_name, email, phone,city, looking_for FROM registered_users WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  	$fetch_user_data_result =  $herokupostgrsdatabse->query($fetch_user_data);

  	if(pg_num_rows($fetch_user_data_result) < 1)
  	{

  			echo "<br>";
  		echo "<h2>Sorry No data available in salesforce with username {$user}</h2>";
  	}

			
	while( $row = pg_fetch_array($fetch_user_data_result))
			   {

			   	 print "\n";


			   	 ?>
			   	 <pre>
			   	 <?php
			 		echo "First Name : ".$row['first_name'];
				echo "<br>";
			echo "Last Name : ".$row['last_name'];
			echo "<br>";
		echo "Email : ".$row['email'];
			echo "<br>";
		echo "Phone : ".$row['phone'];
			echo "<br>";
			echo "City : ".$row['city'];
			echo "<br>";
			echo "Looking For : ".$row['looking_for'];
		//print_r($row);
			   	 ?>
			   	 </pre>
			   	 <?php


			   }

?>
</body> 
</html>
