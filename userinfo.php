<?php
$user = 'root';
$pass = '';
$db = 'userinfo';

$con = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect: " . $con->connect_error);

//create the table 
$tableQuery = "CREATE TABLE IF NOT EXISTS user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    pass_word VARCHAR(255) NOT NULL
)";

if ($con->query($tableQuery) === FALSE) {
    echo "Error creating table: " . $con->error;
    exit;
}

//check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = ($_REQUEST['username']);
    $password = ($_REQUEST['password']);

    $insertQuery = "INSERT INTO user (user_name, pass_word)
                    VALUES ('$username', '$password')";

    if ($con->query($insertQuery) === TRUE) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . $con->error;
    }

    $con->close();
}
?>








