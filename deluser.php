<?php

include 'func.php';
include 'bdconnect.php';

DeleteUser($link, $tbName, $_GET['id']);

header('Location: ./index.php');