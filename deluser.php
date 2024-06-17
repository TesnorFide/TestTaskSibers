<?php

include 'func.php'; // Connecting MySQL function file
include 'bdconnect.php'; // Connecting auth database file

DeleteUser($link, $tbName, $_GET['id']); // Delete user by ID

header('Location: ./index.php'); // Return to index file