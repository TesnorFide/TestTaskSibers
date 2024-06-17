<?php

    session_start();

    include 'func.php'; // Connecting MySQL function file
    include 'bdconnect.php'; // Connecting auth database file

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Тестовое задание для Sibers</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


<?php
if (isset($_POST['kol']))
{
    $kol = $_POST['kol'];
}
else 
{
    $kol = 5;  // Number of records to output
}

if (!empty($_SESSION['admin'])) {
 
    $cat_user = array_keys(OutputUsers($link, $tbName, "id", 1, 1)[2]); // Get database fields

    if (isset($_GET['page']) && is_numeric($_GET['page']) || !isset($_GET['page'])) // If page is numeric & exist or not exist
    {
        if (!isset($_GET['page'])) // Set page, if not exist
        {
            $page = 1;
        }
        if (!isset($page)) // Set variable page if not exist
        {
            $page = $_GET['page'];
        }
        $art = ($page * $kol) - $kol; // Determine from which record we should output
        if(!empty($_POST['sort'])) // Set post sort if not exist
        {
            $_SESSION['sort'] = $_POST['sort'];
        }
        if(empty($_SESSION['sort'])) // Set session sort if not exist
        {
            $_SESSION['sort'] = "id";
        }
        $sort = $_SESSION['sort']; // Set variable sort if not exist
	    $users = OutputUsers($link, $tbName, $sort, $art, $kol); // Get users by number
        $total_users = $users[0];
        array_shift($users); // Delete page from users
        $str_pag = $users[0]; // Get page
        array_shift($users); // Delete page from users
        ?>
        <div class="headbar">
        <form method="POST" action="">
            <select name="sort">
                <?php
                foreach ($cat_user as $cat) // Display the list of sort method page by page
                {
                    $selected = null;
                    if (isset($sort) && $sort=="$cat") 
                    {
                        $selected = "selected";
                    }
                    print("<option value='". $cat . "' " . $selected . ">". $cat . "</option>");
                }
                ?>
            </select>
            <input type="submit" value="Click"/>
        </form>
        <form method="POST" action="?page=new_user">
            <input type="submit" value="New User"/>
        </form>
        </div>
        <div class="main">
        <?php
        foreach ($users as $user) // Display the list of users page by page
        {
            print("<div class='user'><form method='POST' action='./index.php?page=" . $user['login'] . $user['id'] . "'><input type='submit' id='" . $user['login'] . "' name='". $user['id'] . "' value='Идентификатор: " . $user['id'] . " Логин: " . $user['login'] . " Имя: " . $user['name']. " Фамилия: " . $user['lastname']. " Пол: " . $user['sex']. " Дата рождения: " . $user['dob'] . "'/></form></form><form method='POST' action='./deluser.php?id=" . $user['id'] . "'><input type='submit' value='X'/></form></div>");
    	}?>
        <div class="page">
        <?php
        for ($i = 1; $i <= $str_pag; $i++){ // Display the list of number page by page
            echo "<a href=index.php?page=".$i."> Страница ".$i." </a>";
        }?>
        <form action="" method="post">
        <?php
        print("<input name='kol' type='number' min=1 max='". $total_users ."' step=1 value='". $kol ."'><input type='submit'>");
        ?>
        </form></div></div>
        <?php
    }
    else if ($_GET['page'] == "new_user") // Creation new user
    {
        ?>
        <form action="" method="post">
        <?php
        array_shift($cat_user);
        foreach ($cat_user as $cat)
        {
            $input = ">";
            if ($cat == "sex")
            {
                $input = 'type="radio" value="1">Man</input><input name="sex" type="radio" value="0">Woman</input>';
            }
            else if ($cat == "dob")
            {
                $input = 'type="date">';
            }
            print($cat . ": <input name='". $cat . "'" . $input ."<br>");
        }
        print("<input type='submit' value='Submit'/>");
        if (array_keys($_POST) == $cat_user)
        {
            InsertUser($link, $tbName, $_POST['login'], $_POST['password'], $_POST['name'], $_POST['lastname'], $_POST['sex'], $_POST['dob']);
        }
        ?></form><?php
    }
    else // User page
    {?>
    
        <form action="" method="post">
        <?php
        $userLogin = preg_replace('/\d/','', $_GET['page']); 
        $user = FindUserByLogin ($link, $tbName, $userLogin)[0];
        array_shift($user);
        array_shift($cat_user);
        for ($i = 0; $i <= count($user)-1; $i++)
        {
            $cat = $cat_user[$i];
            $param = $user[$cat];
            $input = ">";
            if ($cat == "sex")
            {
                if ($param == 1)
                {
                    $man = "checked='checked'";
                    $woman = null;
                }
                else
                {
                    $man = null;
                    $woman = "checked='checked'";
                }
                $input = 'type="radio" value="1"' . $man . '>Man</input><input name="sex" type="radio" value="0"' . $woman . '>Woman</input>';
                $param = 1;
            }
            else if ($cat == "dob")
            {
                $input = 'type="date">';
            }
            print($cat . ": <input value='" . $param . "' name='". $cat . "'" . $input ."<br>");
        }
        print("<input type='submit' value='Submit'/>");
        if (array_keys($_POST) == $cat_user)
        {
            $login = $_POST['login'];
            $new_user = $_POST;
            $new_cat = $cat_user;
            for ($i = 0; $i <= count($user)-1; $i++)
            {
                $cat = $cat_user[$i];
                if ($new_user[$cat] == $user[$cat])
                {
                    unset($new_user[$cat]);
                    unset($new_cat[$i]);
                }
            }
            if (!empty($new_user))
            {
                $new_cat = array_values($new_cat);
                EditUser($link, $tbName,  $login, $new_user, $new_cat);
                print_r($new_user);
                print_r($new_cat);
            }
        }
        ?></form><?php
    }
}
?>

<?php if (empty($_SESSION['auth'])): ?>
    <form method='POST' action='./login.php'><input type="submit" value="Авторизоваться"/></form> 
<?php endif; ?>

<div class="authdata">
<?php if (!empty($_SESSION['auth']))
    {
        print("<br>Вы авторизованы как " . $_SESSION['auth'] . "<form method='POST' action='./login.php'><input type='submit' value='Выйти'/></form> ");
    }
?>
</div>

<?php if (!empty($_SESSION['admin'])): ?>
   <!--Админ-->
<?php endif; ?>

<!--Anyone-->