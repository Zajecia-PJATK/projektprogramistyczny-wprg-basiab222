<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="login_registration.css">
</head>
<body>
<form method="post" action="" name="registration.php">
    <label>Imię: </label>
    <input type="text" name="name" pattern="[a-zA-Z0-9]+" required/><br>
    <label>Nazwisko: </label>
    <input type="text" name="surname" pattern="[a-zA-Z0-9]+" required/><br>
    <label>E-mail: </label>
    <input type="email" name="email" required/><br>
    <label>Hasło: </label>
    <input type="password" name="password" required/><br>
    <button type="submit" name="register" value="register">Stwórz konto</button>
</form>
</body>
</html>
