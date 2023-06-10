<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #fdbb2d, #91be77, #22c1c3);
        }
        
        fieldset {
            background-color: white;
            width: 400px;
            height: 550px;
            text-align: center;
            border-radius: 10px;
            border: 2px solid #ccc;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 40px;
            font-family: Lucida Handwriting;
            margin-right: 20px;
        }

        h2 {
            margin-top: 50px;
            font-size: 40px;
            font-family: Lucida Handwriting;
        }

        input {
            border: 0;
            border-bottom: 3px solid gray;
            padding: 20px;
            margin: 20px;
            font-size: 18px;
        }

        button {
            background-color: #5d5f68;
            color: white;
            cursor: pointer;
            font-size: 15px;
            font-family: Georgia;
            height: 50px;
            width: 200px;
            text-transform: uppercase;
            margin: 30px;
            border-radius: 10px;
        }

        button:hover {
            font-weight: bold;
            color: black;
            background-color: linear-gradient(to bottom right, #fdbb2d, #91be77, #22c1c3);
        }

        p {
            font-size: 18px;
            font-family: Lucida Bright;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Mamma Mia!</h1>
        <fieldset>
            <h2>Create Account.</h2>
            <form action="userinfo.php" method="post">
                <input type="text" id="username" name="username" placeholder="Create Username" required><br>
                <input type="password" id="password" name="password" placeholder="Create Password" required><br>
                <button type="submit">Create Now</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </fieldset>
    </div>
</body>
</html>




