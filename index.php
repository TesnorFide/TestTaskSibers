<?php
            session_start();

            include 'func.php';
            include 'bdconnect.php';

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
$kol = 3;  //количество записей для вывода

if (!empty($_SESSION['admin'])) {
 
    $cat_user = array_keys(OutputUsers($link, $tbName, "id", 1, 1)[1]);

    if (isset($_GET['page']) && is_numeric($_GET['page']) || !isset($_GET['page']))
    {
        if (!isset($_GET['page']))
        {
            $page = 1;
        }
        if (!isset($page))
        {
            $page = $_GET['page'];
        }
        $art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить
        if(!empty($_POST['sort']))
        {
            $_SESSION['sort'] = $_POST['sort'];
        }
        if(empty($_SESSION['sort']))
        {
            $_SESSION['sort'] = "id";
        }
        $sort = $_SESSION['sort'];
	    $users = OutputUsers($link, $tbName, $sort, $art, $kol);
        $str_pag = $users[0];
        array_shift($users);
        ?>
        <form method="POST" action="">
            <select name="sort">
                <?php
                foreach ($cat_user as $cat)
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
        <?php
        foreach ($users as $user)
        {
            print("<button class='openModal' id='" . $user['login'] . "' name='". $user['id'] . "'>Идентификатор: " . $user['id'] . "Имя: " . $user['login'] . "Имя: " . $user['name']. "Имя: " . $user['lastname']. "Имя: " . $user['sex']. "Имя: " . $user['dob'] . "</button><form method='POST' action='./deluser.php?id=" . $user['id'] . "'><input type='submit' value='X'/></form><br>");
    	}
        for ($i = 1; $i <= $str_pag; $i++){
            echo "<a href=index.php?page=".$i."> Страница ".$i." </a>";
        }
    }
    else if ($_GET['page'] == "new_user")
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
            print($_POST['sex']);
        }
        ?></form><?php
    }
    else
    {?>
    <div id="modal" class="modal">
            <div class="modal-content">
                <button class="close">close</button>
                <p id="demo"><?php
                $userLogin = preg_replace('/\d/','', $_GET['page']); 
                $user = FindUserByLogin ($link, $tbName, $userLogin)[0];
                print("Идентификатор: " . $user['id'] . "Имя: " . $user['login'] . "Имя: " . $user['name']. "Имя: " . $user['lastname']. "Имя: " . $user['sex']. "Имя: " . $user['dob'] . "<br>");
                ?>
                </p>
            </div>
        </div><?php
    }
}


     
?>



<?php if (!empty($_SESSION['auth'])): ?>
    <!--Авторизованный-->
<?php endif; ?>

<?php if (!empty($_SESSION['admin'])): ?>
   <!--Админ-->
<?php endif; ?>

<!--Anyone-->

<script src="script.js"></script>