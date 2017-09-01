<?php

 require_once('heroku_postgres_database.php');


  // Connect to the database
$herokupostgrsdatabse = new HerokuPostgresDatabase();

    // Grab the profile data from the POST
    $first_name = $herokupostgrsdatabse->escape_value(trim($_POST['first_name']));
      $last_name = $herokupostgrsdatabse->escape_value(trim($_POST['last_name']));
   $email = $herokupostgrsdatabse->escape_value(trim($_POST['email']));
   $city = $herokupostgrsdatabse->escape_value(trim($_POST['city']));
   $looking_for = $herokupostgrsdatabse->escape_value(trim($_POST['00N90000002GeUl']));
      $phone = $herokupostgrsdatabse->escape_value(trim($_POST['phone']));

    $password = $herokupostgrsdatabse->escape_value(trim($_POST['password']));
    
    //if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM registered_users WHERE email = '$username'";
      $data = $herokupostgrsdatabse->query($query);
      if (pg_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO registered_users (first_name,last_name,phone,city,looking_for,email, password) VALUES ('$first_name', '$last_name','$phone','$city','$looking_for','$email','$password')";
        $herokupostgrsdatabse->query($query);

        // Confirm success with the user

      header('Location: https://startupwala.herokuapp.com/thankyou.html');


        
        // echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

       
        //exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }





?>
