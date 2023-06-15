<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="login_registration.css">
    <script src="popup.js"></script>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Imię: </label>
    <input type="text" name="name" required/><br>
    <label>Nazwisko: </label>
    <input type="text" name="surname" required/><br>
    <label>E-mail: </label>
    <input type="email" name="email" required/><br>
    <label>Hasło: </label>
    <input type="password" name="password" required/><br>
    <button type="submit" name="register">Stwórz konto</button>
</form>
</body>
</html>

<?php
require_once "../db_connection.php";
require_once "../test_input.php";
session_start();

if (isset($_POST['register'])) {
    if (!(empty($_POST['name']) && empty($_POST['surname']) && empty($_POST['email']) && empty($_POST['password']))) {
        $name = test_input($_POST['name']);
        $surname = test_input($_POST['surname']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);

        $checkQuery = "SELECT * FROM Klient WHERE Email = '$email'";

        if (!empty($conn)) {
            $checkResult = $conn->query($checkQuery);
        }

        if ($checkResult->num_rows > 0) {
            echo '<script src="popup.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            displayPopup("E-mail adres został już użyty");
        });
    </script>';
        } else {
            $insertQuery = "INSERT INTO Klient (Imie, Nazwisko, Email, Haslo) VALUES ('$name','$surname','$email','$password')";

            if ($conn->query($insertQuery) === true) {
                echo '<script src="popup.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            displayPopup("Konto zostało utworzone. Przekierowuje do strony logowania.");
        });
    </script>';
                $_SESSION['email'] = $email;
                sleep(3);
                header("Location: login_layout.php");
                exit();
            } else {
                echo 'Error: ' . $insertQuery . '<br>' . $conn->error;
            }
        }
        $conn->close();
    } else{
        echo '<script src="popup.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            displayPopup("Podaj poprawnie wszystkie dane!"); 
        });
    </script>';
    }
}
?>

