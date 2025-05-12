<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login of Registreren</title>
    <link rel="stylesheet" href="../view/styles.css">

</head>
<body>
    <div class="container">
        <h1>Kaartspel Inloggen</h1>
        <form class="form" method="POST" action="../controller/login.php">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <input type="hidden" id="action" name="action" value="">
    <button type="submit" onclick="document.getElementById('action').value='login'">Inloggen</button>
    <button type="submit" onclick="document.getElementById('action').value='register'">Registreren</button>
       </form>

    </div>
</body>
</html>