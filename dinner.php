<!DOCTYPE html>
<html>
<head>
    <title>Dinner</title>
    <style>
        body{
            background:#C6426E;
        }
        /*style for recipe cards*/
        .recipe {
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 20px;
        }
        
        .recipe-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 4px;
            background: linear-gradient( #d9a7c7, #fffcdc);
            text-align: center;
        }
        
        img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Recipe Collection for Dinner</h1>

    <div class="recipe"> <!--to separate each recipe-->
        <?php
        $db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'recipe') or die(mysqli_error($db));

        //select the dinner recipes
        $query = 'SELECT recipe_name, cook_time, list_ing, step1, step2, step3, photo
                  FROM recipeinfo
                  WHERE cook_time = "Dinner"
                  ORDER BY recipe_name';
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //display recipe as a card
                echo "<div class='recipe-card'>";
                echo "<img src='" . $row['photo'] . "' alt='Recipe Photo'>";
                echo "<h2>" . $row['recipe_name'] . "</h2>";
                echo "<p><strong>Cook Time:</strong> " . $row['cook_time'] . "</p>";
                echo "<p><strong>List of Ingredients:</strong> " . $row['list_ing'] . "</p>";
                echo "<p><strong>Preparation</strong></p>";
                echo "<p><strong>Step 1:</strong> " . $row['step1'] . "</p>";
                echo "<p><strong>Step 2:</strong> " . $row['step2'] . "</p>";
                echo "<p><strong>Step 3:</strong> " . $row['step2'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No breakfast recipes found.";
        }
        ?>
    </div>
</body>
</html>