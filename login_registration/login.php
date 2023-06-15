<?php
require_once "../db_connection.php";
session_start();

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $selectQueryCustomer = "SELECT * FROM Klient WHERE Email = '$email' AND Haslo = '$password';";
    $selectQueryEmployee = "SELECT * FROM Pracownicy WHERE Email = '$email' AND Haslo = '$password';";

    if (!empty($conn)) {
        $resultCustomer = $conn->query($selectQueryCustomer);
        $resultEmployee = $conn->query($selectQueryEmployee);
    }

    if ($resultCustomer->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: ../employee_app/menu_layout.php");
        exit();
    } else if ($resultEmployee->num_rows > 0) {
        header("Location: ../employee_app/menu_layout.php");
        exit();
    } else {
        echo '<script>
                  window.addEventListener("DOMContentLoaded", () => {
            const popup = document.createElement("div");
            popup.className = "popup";
            popup.textContent = "Zły adres e-mail lub hasło";
            document.body.appendChild(popup);
            setTimeout(() => {
                document.body.removeChild(popup);
            }, 3000);
                  });
              </script>';
    }
    $conn->close();
}
?>