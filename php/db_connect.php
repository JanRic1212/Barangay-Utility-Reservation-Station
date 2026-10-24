<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'utility_reservation');
    try {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    } catch(Error $e) {
        echo "An error occured.<br>";
        echo "Message: " . $e -> getMessage() . ".<br>";
        echo "The system is busy, please try again later.";
    }

    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "utility_reservation";

    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>