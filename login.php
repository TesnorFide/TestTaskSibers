<?php
	session_start();

    include 'func.php';
    $tbName = "userSibers";
    $link = DbConnect("localhost", "u2239489_test", "qwerty12345", "u2239489_test");
	
	if (!empty($_POST['password']) and !empty($_POST['login'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM $tbName WHERE login='$login' AND password='$password'";
		$res = mysqli_query($link, $sql);
		$user = mysqli_fetch_assoc($res);
		
        if (!empty($user))
        {
            if ($user['login']=="admin")
            {
                $_SESSION['admin'] = true;
                $_SESSION['auth'] = true;
                header("Location: ./index.php");
            }
            else
            {
                $_SESSION['auth'] = true;
                header("Location: ./index.php");
            }
        }
        else
        {
			print("Данные введены неверно");
		}
	}
?>

<form action="" method="POST">
	<input name="login">
	<input name="password" type="password">
	<input type="submit">
</form>