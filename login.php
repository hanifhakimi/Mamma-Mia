<?php
session_start();

$user = 'root';
$pass = '';
$db = 'userinfo';

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect!");

//check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve form data
    $username = ($_REQUEST['username']);
    $password = ($_REQUEST['password']);

    $selectQuery = "SELECT * FROM user WHERE user_name = '$username' AND pass_word = '$password'";

    $result = $conn->query($selectQuery);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 990px;
            background: linear-gradient( #3f5efb, #a351af, #fc466b);
        }
        
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        fieldset {
            background-color:white;
            width: 400px;
            height: 600px;
            text-align: center;
            border-radius: 10px;
        }

        h1{
            margin-top: 50px;
            font-size:40px;
            font-family: Lucida Handwriting;
        }

        input{
            border:0;
            border-bottom: 3px solid gray;
            padding : 20px;
            margin : 20px;
            font-size: 18px;
        }

        button{
            background-color: #5d5f68;
            color: white;
            cursor : pointer;
            font-size: 15px;
            font-family: Georgia;
            height: 50px;
            width: 200px;
            text-transform: uppercase;
            margin: 30px;
            border-radius: 10px;
        }

        button:hover{
            font-weight: bold;
            color:black;
            background: linear-gradient(#3f5efb, #a351af, #fc466b);
        }

        p{
            font-size: 18px;
            font-family: Lucida Bright;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Feed Your Passion!</h1>
    <fieldset>
            <h1>Login.</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="text" id="username" name="username" placeholder="Username" required><br>
        
            <input type="password" id="password" name="password" placeholder="Password" required><br>
        
            <button type="submit">Login</button>

            <p>Don't have an account? <a href="create.php">Sign up</a></p>
            </form>
            <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
        <?php } ?>
    </fieldset>
</div>
</body>
</html>






