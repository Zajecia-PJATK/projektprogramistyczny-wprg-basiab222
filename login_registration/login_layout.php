<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login_registration.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>E-mail: </label>
    <input type="email" name="email" required/><br>
    <label>Hasło: </label>
    <input type="password" name="password" required/>
    <button type="submit" name="login">Zaloguj sie</button>
</form>
<form method="post" action="registration_layout.php">
    <label>Nie masz jeszcze konta? </label><br>
    <button type="submit" name="register">Stwórz konto</button>
</form>
</body>
</html>

<?php
require_once "../db_connection.php";
require_once "../test_input.php";

if (isset($_POST['login'])) {
    if (!(empty($_POST['email']) && empty($_POST['password'])) &&
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);

        $selectQueryCustomer = "SELECT * FROM Klient WHERE Email = '$email' AND Haslo = '$password';";
        $selectQueryEmployee = "SELECT * FROM Pracownicy WHERE Email = '$email' AND Haslo = '$password';";

        if (!empty($conn)) {
            $resultCustomer = $conn->query($selectQueryCustomer);
            $resultEmployee = $conn->query($selectQueryEmployee);
        }

        if ($resultCustomer->num_rows > 0) {
            $_SESSION['email'] = $email;
            header("Location: ../customer_app/menu_layoutC.php");
            exit();
        } else if ($resultEmployee->num_rows > 0) {
            header("Location: ../employee_app/menu_layoutE.php");
            exit();
        } else {
            echo '<script src="popup.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            displayPopup("Zły adres e-mail lub hasło"); 
        });
    </script>';
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