<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: rgba(255, 255, 0, 0.2); /* Light yellow with 20% opacity */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .terms {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .terms a {
            color: #00f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['success'])): ?>
        <div class="message" id="message">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
        <?php endif; ?>
        <h2>Login</h2>
        <form action="authenticate_user.php" method="post">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <div class="terms">
            <a href="register.php">Register</a>
        </div>
    </div>
    
    <script>
        // Hide the message div after 5 seconds
        setTimeout(function() {
            var messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
