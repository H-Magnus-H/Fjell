<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Signup</title>
</head>

<body>

    <div class="container">
        <p>trykk <a class="astyle" href="index.php">her</a> for å gå tilbake til forsiden</p>

        <h1>Signup</h1>
        <h4>Når du har laget en bruker vil du bli tatt med til start siden hvor du kan logge inn med din nye bruker</h4>

        <form action="includes/signuphandler.inc.php" method="post">
            <input class="input" type="text" name="username" placeholder="Username" required>
            <input class="input" type="text" name="email" placeholder="Email" required>
            <input class="input" type="password" name="password" placeholder="Password" required>
            <br>
            <br>
            <button type="submit" class="button">Signup</button>
        </form>
    </div>

</body>

</html>