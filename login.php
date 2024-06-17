<?php
	session_start();

    include 'func.php'; // Connecting MySQL function file
    include 'bdconnect.php'; // Connecting auth database file
	
	if (!empty($_POST['password']) and !empty($_POST['login'])) { // If user sent auth data
		$login = $_POST['login']; // Set login to user login
		$password = $_POST['password']; // Set password to user password
		
		$sql = "SELECT * FROM $tbName WHERE login='$login' AND password='$password'"; // Make a request in which find user where login & password equal user login & user password
		$res = mysqli_query($link, $sql); // Sent request
		$user = mysqli_fetch_assoc($res); // Get result
		
        if (!empty($user)) // If user exist
        {
            if ($user['login']=="admin") // If user login - admin
            {
                $_SESSION['admin'] = true;
                $_SESSION['auth'] = "admin";
                header("Location: ./index.php"); // Return to index file
            }
            else
            {
                $_SESSION['auth'] = $user['login']; // Remember the login the user logged in with
                header("Location: ./index.php"); // Return to index file
            }
        }
        else // If user dosn't exist
        {
			print("Данные введены неверно"); // Print alert about wrong data
		}
	}
?>

<form action="" method="POST">
	<input name="login">
	<input name="password" type="password">
	<input type="submit">
</form>