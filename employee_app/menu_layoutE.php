<?php
require_once "../db_connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="stylesheet" href="../menu_bar.css">
    <link rel="stylesheet" href="../menu_items.css">
</head>
<body>
<ul>
    <li><a href="schedule_layoutE.php">Grafik</a></li>
    <li><a class="active" href="menu_layoutE.php">Menu</a></li>
    <li><a href="special_offers_layoutE.php">Oferty specjalne</a></li>
    <li><a href="employees_layoutE.php">Pracownicy</a></li>
    <li><a href="reservation_layoutE.php">Rezerwacje</a></li>
    <li><a href="events_layoutE.php">Wydarzenia</a></li>
    <li><a href="take_order_layoutE.php">Przyjmij zamowienie</a></li>
    <li><a href="pending_orders_layoutE.php">Oczekujace zamowienia</a></li>
    <li><a href="stock_layoutE.php">Zapasy składników</a></li>
    <li><a href="sales_data_layoutE.php">Dane sprzedazowe</a></li>
    <li><a href="settings_layoutE.php">Ustawienia</a></li>
</ul>
<section>
    <?php

    $sql = "SELECT * FROM Pozycje_w_menu";
    if (!empty($conn)) {
        $result = mysqli_query($conn, $sql);
    }

    if (mysqli_num_rows($result) > 0) {

        echo '<ul class="menu-list"><h1>Menu</h1>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>';
            echo '<h3>' . $row['Nazwa'] . '</h3>';
            echo '<p>' . $row['Opis'] . '</p>';
            echo '<p>Cena: ' . $row['Cena'] . ' zł</p>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Brak pozycji w menu.';
    }

    mysqli_close($conn);
    ?>
</section>
</body>
</html>
