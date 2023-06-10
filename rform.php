<?php
$user = 'root';
$pass = '';
$db = 'recipe';

$db = new mysqli('localhost', $user, $pass, 'recipe') or die("Unable to connect");

$query = "CREATE DATABASE IF NOT EXISTS recipe";
mysqli_query($db, $query) or die(mysqli_error($db));

$db = new mysqli('localhost', $user, $pass, 'recipe') or die("Unable to connect");

$db->select_db('recipe');

$tableQuery = "CREATE TABLE IF NOT EXISTS recipeinfo (
    num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    recipe_name VARCHAR(255) NOT NULL,
    cook_time VARCHAR(255) NOT NULL,
    list_ing TEXT NOT NULL,
    step1 TEXT NOT NULL,
    step2 TEXT NOT NULL,
    step3 TEXT NOT NULL,
    photo VARCHAR(255)
)";

if ($db->query($tableQuery) === FALSE) {
    echo "Error creating table: " . $db->error;
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = ($_REQUEST['recipe_name']);
    $cookTime = ($_REQUEST['cook_time']);
    $listIng = ($_REQUEST['list_ing']);
    $s1 = ($_REQUEST['step1']);
    $s2 = ($_REQUEST['step2']);
    $s3 = ($_REQUEST['step3']);
    $photoLink = ($_REQUEST['photo_link']);

    $insertQuery = "INSERT INTO recipeinfo (recipe_name, cook_time, list_ing, step1, step2, step3, photo)
                    VALUES ('$recipeName', '$cookTime', '$listIng', '$s1', '$s2', '$s3', '$photoLink')";

    if ($db->query($insertQuery) === TRUE) {
        echo "Recipe submitted successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $db->error;
    }
}

// Close the database connection
$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: linear-gradient( #800080, #ffc0cb);
        }

        form {
            font-family: Lucida Bright;
            width: 600px;
            margin: 0 auto;
            background-color: #242424;
            color:white;
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            font-family: Lucida Handwriting;
            margin-bottom: 40px
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 14px;
        }

        textarea {
            height: 150px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button-container {
        display: flex;
        justify-content: center; 
        align-items: center; 
        height: 65px; 
        }

        .submit-button {
        background-color: #7d7d7d; 
        color: white;
        padding: 15px; 
        width: 100px;
        font-size: 16px;
        font-family: Georgia;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        }

        .submit-button:hover {
        background-color: #0ab100;
        }
    </style>
    </style>
</head>
<body>
    <h1>Share Your Creativity!</h1>
<form id="recipeForm" method="POST" action="">
    <h1>Recipe Form.</h1>
    <label for="recipe_name">Recipe Title</label>
    <input type="text" name="recipe_name" id="recipe_name" required><br>
    
    <label for="cook_time">Select Time</label>
    <select name="cook_time" id="cook_time">
        <option value="">choose here</option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
    </select><br>
    
    <label for="list_ing">List of Ingredients</label>
    <textarea name="list_ing" id="list_ing" cols="30" rows="10" required></textarea><br>
    
    <label for="step1">Step 1</label>
    <textarea name="step1" id="step1" cols="30" rows="10" required></textarea><br>

    <label for="step2">Step 2</label>
    <textarea name="step2" id="step2" cols="30" rows="10" required></textarea><br>

    <label for="step3">Step 3</label>
    <textarea name="step3" id="step3" cols="30" rows="10"></textarea><br>
    
    <label for="photo_link">Photo Link</label>
    <input type="text" name="photo_link" id="photo_link" required><br>
    
    <div class="button-container">
        <button type="submit" class="submit-button">POST</button>
    </div>
</form>
</body>
</html>









