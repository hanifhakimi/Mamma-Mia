<?php
session_start();

//retrieve the username from the session
$username = $_SESSION['username'];

$user = 'root';
$pass = '';
$db = 'comment';

$conn = new mysqli('localhost', $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//retrieve comments from the database
$selectSql = "SELECT * FROM comments";
$result = $conn->query($selectSql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home-Page</title>
        <style>
            body{
                background-color:white;
                color:black;
            }
            header{
                text-align:center;
            }
            h1{
                font-family: Lucida Handwriting;
            }
            h2{
                color:black;
            }
            #theme{
                font-family: Bahnschrift SemiBold;
            }

            /*style for breadcrumb*/
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            ul, li {
                list-style: none;
            }
            .container {
                display: flex;
                flex-direction: column;
                height: 100%;
                width: 100%;
                min-width: 480px;
                padding: 0 40px;
            }
            .breadcrumb {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 10px 0;
            }
            .breadcrumbItem {
                height: 40px;
                color: #F8EFEA;
                font-family: 'Oswald', sans-serif;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                text-transform: uppercase;
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 16px;
                margin: 5px;
                padding: 20px;
                cursor: pointer;
                background-color: #192F01;
                border-radius: 20px;
            }
            .breadcrumbItem:hover {
                background-color: #DED369;
                color: black;
            }
            .breadcrumbItem:first-child {
                margin-left: 0;
            }
            .breadcrumbItem:last-child {
                margin-right: 0;
            }
            .breadcrumbInner {
                transform: skew(-11deg);
            }
            section {
                text-align: center;
                padding: 20px;
            }
            .recipeSection {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                grid-gap: 20px;
                text-align: center;
                padding: 20px;
            }
            .recipe {
                position: relative;
                border-radius: 4px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }
            .link-unstyled {
                text-decoration: none; /* Remove underline */
                color: inherit; /* Inherit text color */
            }
            .link-unstyled:hover {
                text-decoration: none; /* Remove underline on hover */
                color: inherit; /* Inherit text color on hover */
            }
            @media all and (max-width: 1000px) {
            .breadcrumbItem {
                padding: 0 15px;
                height: 35px;
                font-size: 11px;
                }
            }
            @media all and (max-width: 710px) {
            .breadcrumbItem {
                padding: 0 10px;
                height: 30px;
                }
            }

            /*style for recipe image*/
            .recipeSection {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                grid-gap: 20px;
                text-align: center;
                padding: 20px;
            }
            #recipeTitle {
                font-size: 24px;
                font-family: Bahnschrift SemiBold;
                margin: 15px;
            }
            .recipe:hover {
                transform: translateY(-5px); /*make it go up a little bit*/
            }
            .recipeImage {
                width: 100%;
                height: 200px;
                object-fit: cover;/*make the picture look fine & not strecth*/
                display: block;
                border-radius: 4px;
            }
            .recOverlay {
                position: absolute;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                display: flex;
                flex-direction: column;/*recipe name and view recipe in a column*/
                justify-content: center;
                align-items: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .recipe:hover .recOverlay {
                opacity: 1;
            }
            .recName {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
            }
            .recipeLink {
                font-size: 16px;
                font-weight: bold;
                color: white;
                text-decoration: none;
                background-color: #414141;
                padding: 8px 16px;
                border-radius: 20px;
                transition: background-color 0.3s ease;
            }
            .recipeLink:hover {
                background-color: #ff6701;
            }

            /*Style for user Public Space*/
            #commentTitle {
                font-size: 24px;
                font-family: Bahnschrift SemiBold;
                margin: 15px;
            }
            .userComments {
                margin-top: 20px;
            }
            .commentForm {
                margin-bottom: 20px;
            }
            .commentInput {
                width: 100%;
                height: 80px;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                resize: vertical;
                font-family: Lucida Handwriting;
                color:#3C3B3F;
            }
            .commentButton {
                background-color: #4CAF50;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .commentButton:hover {
                background-color: #45a049;
            }
            .comments {
                margin-top: 20px;
            }
            .comment {
                height: 100px;
                margin-bottom: 10px;
                padding: 10px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                background: linear-gradient( #D3CCE3,#E9E4F0);
            }
            #commentText {
                font-size:20px;
                font-family: Snell Roundhand, cursive;
                display: block;
                margin-bottom: 5px;
                color:black;
            }
            .commentInfo {
                padding-top:30px;
                color: #3C3B3F;
                font-size: 17px;
            }
            .uploadSection {
                margin: 10px;
            }
            .uploadButton {
                background-color: #4CAF50;
                color: white;
                padding: 20px;
                margin:20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .uploadButton:hover {
                background-color: #45a049;
            }
            .uploadInput {
                display: none;
            }
            .comments {
                margin-top: 20px;
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-start;
                align-items: flex-start;
            }
            .comment {
                width: 200px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
        <header> 
            <h1>Welcome <?php echo $username ?>!</h1>
            <img id="image" src="lightmode.png" onclick="change()" width="400" height="400">
            <p id="theme" >Click Logo to Dark Mode</p>
            <script>
                function change(){
                    var image = document.getElementById('image');
                    var h2 = document.getElementById('recipeTitle');
                    var h3 = document.getElementById('commentTitle');
                    var t = document.getElementById('theme');
                    var body = document.getElementsByTagName('body')[0];

                    if(image.src.match("darkmode")){
                        image.src = "lightmode.png";
                        body.style.backgroundColor = "white";
                        body.style.color = "black";
                        h2.style.color="black";
                        h3.style.color="black";
                        t.innerHTML = "Click Logo to Dark Mode";
                       
                    }else{
                        image.src = "darkmode.png";
                        body.style.backgroundColor = "black";
                        body.style.color = "white";
                        h2.style.color="white";
                        h3.style.color="white";
                        t.innerHTML = "Click Logo to Light Mode";
                    }
                }
            </script>
        </header>

        <!--navigation section-->

        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumbItem">
                    <a class="breadcrumbInner link-unstyled" href="breakfast.php" target="_blank">
                    <span class="breadcrumbTitle">BREAKFAST</span>
                    </a>
                </li>
                <li class="breadcrumbItem">
                    <a class="breadcrumbInner link-unstyled" href="lunch.php" target="_blank">
                    <span class="breadcrumbTitle">LUNCH</span>
                    </a>
                </li>
                <li class="breadcrumbItem">
                    <a class="breadcrumbInner link-unstyled" href="dinner.php" target="_blank">
                    <span class="breadcrumbTitle">DINNER</span>
                    </a>
                </li>
                <li class="breadcrumbItem">
                    <a class="breadcrumbInner link-unstyled" href="rform.php" target="_blank">
                    <span class="breadcrumbTitle">POST MY RECIPE</span>
                    </a>
                </li>
                <li class="breadcrumbItem">
                    <a class="breadcrumbInner link-unstyled" href="login.php" target="_blank">
                    <span class="breadcrumbTitle">LOG OUT</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--recipe section-->
        
        <h2 id="recipeTitle">You Need To Try These Recipes !</h2>
        <section class="recipeSection">
            <div class="recipe">
                <div class="recOverlay">
                    <h3 class="recName">Italian Chicken Marinade</h3>
                    <a href="#" class="recipeLink">View Recipe</a>
                </div>
                    <img src="https://res.cloudinary.com/hksqkdlah/image/upload/SFS_ItalianDressingChickenBreasts_039_ifeo5w.jpg" alt="Italian Chicken Marinade" class="recipeImage">
            </div>

            <div class="recipe">
                <div class="recOverlay">
                    <h3 class="recName">Easy Chicken Fries</h3>
                    <a href="#" class="recipeLink">View Recipe</a>
                </div>
                    <img src="https://img-global.cpcdn.com/recipes/65b19f097ddc1123/1360x964cq70/easy-chicken-fries-recipe-main-photo.webp" alt="Easy Chicken Fries" class="recipeImage">
            </div>

            <div class="recipe">
                <div class="recOverlay">
                    <h3 class="recName">Mushroom Pie</h3>
                    <a href="#" class="recipeLink">View Recipe</a>
                </div>
                    <img src="https://www.simplyrecipes.com/thmb/Tn5ymX7CVEGCGSfsS3QL8yDlccE=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__simply_recipes__uploads__2007__12__mushroom-pie-horiz-b-1800-e2223f35bb8c445784ef297e56c47dd3.jpg" alt="Mushroom Pie" class="recipeImage">
            </div>

            <div class="recipe">
                <div class="recOverlay">
                    <h3 class="recName">Classic Roast Chicken</h3>
                    <a href="#" class="recipeLink">View Recipe</a>
                </div>
                    <img src="https://static.onecms.io/wp-content/uploads/sites/19/2011/02/15/0886_192302_DuPree_MR_13299-2000.jpg" alt="Classic Roast Chicken" class="recipeImage">
            </div>
        </section>

        <!--comment section-->

        <h2 id="commentTitle">Public Space</h2>
        <section class="userComments">

            <form class="commentForm" method="post" action="comment.php">
                <textarea class="commentInput" name="comment" placeholder="Share your thoughts or cooking tips..."></textarea>
                <button type="submit" class="commentButton">Post Comment</button>
            </form>

            <div class="comments">
            <!-- Display user comments here -->
             <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='comment'>";
                            echo "<span id='commentText'>" . $row['comment'] . "</span>";
                            echo "<span class='commentInfo'> Posted by: " . $row['username'] . "</span>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No comments yet.</p>";
                    }
                ?>
            </div>
        </section>
    </body>
</html>