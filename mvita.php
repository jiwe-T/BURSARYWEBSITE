
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="form">
        <h2>Login Here</h2>
        <form action="login.php" method="post">
            <?php if (isset($_GET['error'])) { ?>

                <p class="error"> <?php echo $_GET['error']; ?></p>
        
            <?php } ?>
            <input type="text" name="username" placeholder="Constituency" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
