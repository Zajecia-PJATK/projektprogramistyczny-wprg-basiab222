<?php
require_once "../db_connection.php";
session_start();

if (isset($_POST['register'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM Klient WHERE Email = '$email'";

    if (!empty($conn)) {
        $checkResult = $conn->query($checkQuery);
    }

    if ($checkResult->num_rows > 0) {
        echo '<script>
                  window.addEventListener("DOMContentLoaded", () => {
            const popup = document.createElement("div");
            popup.className = "popup";
            popup.textContent = "Adres e-mail został już użyty";
            document.body.appendChild(popup);
            setTimeout(() => {
                document.body.removeChild(popup);
            }, 3000);
                  });
              </script>';
    } else {
        $insertQuery = "INSERT INTO Klient (Imie, Nazwisko, Email, Haslo) VALUES ('$name','$surname','$email','$password')";

        if ($conn->query($insertQuery) === true) {
            header("Location: login_layout.php");
            exit();
        } else {
            echo 'Error: ' . $insertQuery . '<br>' . $conn->error;
        }
    }
    $conn->close();
}
?>