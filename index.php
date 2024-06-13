<?php
            session_start();

            include 'func.php';
            $tbName = "userSibers";
            $link = DbConnect("localhost", "u2239489_test", "qwerty12345", "u2239489_test");



            //InsertUser($link, $tbName, "TestUser" . strval(rand(0,1000)), "qwerty21", "John", "Cena", true, "2002.10.11");



        ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Тестовое задание для Sibers</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        

     


       

<form method="POST" action="">
    <select name="sort" value="<?php if (isset($_SESSION['sort'])) {$_SESSION['sort'];} else {"test";}?>">
        <option value="id">Id</option>
        <option value="login">Login</option>
        <option value="name">Name</option>
        <option value="lastname">Lastname</option>
        <option value="sex">Sex</option>
        <option value="dob">Age</option>
    </select>
    <input type="submit" value="Click"/>
</form>


<?php
$kol = 3;  //количество записей для вывода

if (!empty($_SESSION['admin'])) {

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
        unset($users[0]);
        $myJSON = json_encode($users);
        foreach ($users as $user)
        {
            print("<button class='openModal' id='" . $user['login'] . "'>Идентификатор: " . $user['id'] . "Имя: " . $user['login'] . "Имя: " . $user['name']. "Имя: " . $user['lastname']. "Имя: " . $user['sex']. "Имя: " . $user['dob'] . "</button><br>");
    	}
        for ($i = 1; $i <= $str_pag; $i++){
            echo "<a href=index.php?page=".$i."> Страница ".$i." </a>";
        }
    }
    else
    {?>
    <div id="modal" class="modal">
            <div class="modal-content">
                <button class="close">close</button>
                <p id="demo"><?php
                $user = FindUserByLogin ($link, $tbName, $_GET['page'])[0];
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