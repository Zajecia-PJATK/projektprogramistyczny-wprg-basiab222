<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login_registration.css">
</head>
<body>
<form method="post" action="l<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>E-mail: </label>
    <input type="email" name="email" required/><br>
    <label>Hasło: </label>
    <input type="password" name="password" required/>
    <button type="submit" name="login">Zaloguj sie</button>
</form>
<form method="post" action="registration_layout.php">
    <label>Nie masz jeszcze konta? </label><br>
    <button type="submit" name="register" >Stwórz konto</button>
</form>
</body>
</html>


