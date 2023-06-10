<?php
session_start();

$username = $_SESSION['username'];

$user = 'root';
$pass = '';
$db = 'comment';

$conn = new mysqli('localhost', $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //get comment from the form data
    $comment = $_POST['comment'];

    $insertSql = "INSERT INTO comments (username, comment)
                    VALUES (?, ?)";
    
    $stmt = $conn->prepare($insertSql);

    //bind the parameters and execute the statement
    $stmt->bind_param("ss", $username, $comment);
    $stmt->execute();

    //close the statement
    $stmt->close();

    header("Location: home.php");
    exit;
}
?>









