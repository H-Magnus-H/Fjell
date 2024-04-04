<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Loginn</title>
</head>

<body>

    <div class="container">
        <a class="astyle" href="index.php">tilbake til forside</a>

        <h1>Login</h1>
        <?php
        session_start();
        if (isset ($_SESSION['error_message'])) {
            echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>

        <form action="includes/loginhandler.inc.php" method="POST">
            <input class="input" type="text" name="brukernavn" placeholder="Username" requierd>
            <input class="input" type="password" name="passord" placeholder="Password" requiered>
            <br><br>
            <button class="button">Login</button> 
            <br>
            <br>
            <a class="astyle" href="signup.php">Har ikke bruker? <br> Signup</a>
        </form>
    </div>


</body>

</html>