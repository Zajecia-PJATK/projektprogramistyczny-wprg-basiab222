<?php
require_once "../db_connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Pracownicy</title>
    <link rel="stylesheet" href="../menu_bar.css">
    <link rel="stylesheet" href="employees.css">
</head>
<body>
<ul>
    <li><a href="schedule_layoutE.php">Grafik</a></li>
    <li><a href="menu_layoutE.php">Menu</a></li>
    <li><a href="special_offers_layoutE.php">Oferty specjalne</a></li>
    <li><a class="active" href="employees_layoutE.php">Pracownicy</a></li>
    <li><a href="reservation_layoutE.php">Rezerwacje</a></li>
    <li><a href="events_layoutE.php">Wydarzenia</a></li>
    <li><a href="take_order_layoutE.php">Przyjmij zamowienie</a></li>
    <li><a href="pending_orders_layoutE.php">Oczekujace zamowienia</a></li>
    <li><a href="stock_layoutE.php">Zapasy składników</a></li>
    <li><a href="sales_data_layoutE.php">Dane sprzedazowe</a></li>
    <li><a href="settings_layoutE.php">Ustawienia</a></li>
</ul>
<section>
<h1>Lista pracowników</h1>
<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Stanowisko</th>
        <th>Email</th>
        <th>Akcje</th>
    </tr>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pracownikID = $_POST["id"];
        $notatka = $_POST["notatka"];


        $sql = "UPDATE Pracownicy SET Notatka = '$notatka' WHERE ID = '$pracownikID'";
        if (!empty($conn)) {
            if (mysqli_query($conn, $sql)) {
                echo "Notatka została zaktualizowana.";
            } else {
                echo "Błąd aktualizacji notatki: " . mysqli_error($conn);
            }
        }
    }
    $sql = "SELECT * FROM Pracownicy";
    if (!empty($conn)) {
        $result = mysqli_query($conn, $sql);
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Imie'] . "</td>";
            echo "<td>" . $row['Nazwisko'] . "</td>";
            echo "<td>" . $row['Stanowisko'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>
                    <form method='post' action='" . $_SERVER["PHP_SELF"] . "'>
                        <input type='hidden' name='id' value='" . $row['ID'] . "'>
                        <textarea name='notatka' placeholder='Wprowadź notatkę' required>" . $row['Notatka'] . "</textarea><br>
                        <input type='submit' value='Zapisz notatkę'>
                    </form>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Brak pracowników</td></tr>";
    }

    mysqli_close($conn);
    ?>
</section>
</body>
</html>
