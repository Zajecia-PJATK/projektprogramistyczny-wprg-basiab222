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
    <li><a class="active" href="menu_layoutC.php">Menu</a></li>
    <li><a href="order_layoutC.php">Złóż zamówienie</a></li>
    <li><a href="order_history_layoutC.php">Śledzenie i historia zamówień</a></li>
    <li><a href="reserve_table_layoutC.php">Zarezerwuj stolik</a></li>
    <li><a href="book_event_layoutC.php">Wydarzenia specjalne</a></li>
    <li><a href="special_offers_layoutC.php">Oferty specjalne</a></li>
</ul>
<section>
    <?php
    require_once "../db_connection.php";
    session_start();

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
