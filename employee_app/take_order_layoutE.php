<?php
require_once "../db_connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Przyjmij zamówienie</title>
    <link rel="stylesheet" href="../menu_bar.css">
    <link rel="stylesheet" href="take_order.css">
</head>
<body>
<ul>
    <li><a href="schedule_layoutE.php">Grafik</a></li>
    <li><a href="menu_layoutE.php">Menu</a></li>
    <li><a href="special_offers_layoutE.php">Oferty specjalne</a></li>
    <li><a href="employees_layoutE.php">Pracownicy</a></li>
    <li><a href="reservation_layoutE.php">Rezerwacje</a></li>
    <li><a href="events_layoutE.php">Wydarzenia</a></li>
    <li><a class="active" href="take_order_layoutE.php">Przyjmij zamowienie</a></li>
    <li><a href="pending_orders_layoutE.php">Oczekujace zamowienia</a></li>
    <li><a href="stock_layoutE.php">Zapasy składników</a></li>
    <li><a href="sales_data_layoutE.php">Dane sprzedazowe</a></li>
    <li><a href="settings_layoutE.php">Ustawienia</a></li>
</ul>

<section>
    <form method="POST" action="">
        <table border="1">
            <tr>
                <th>Kategoria</th>
                <th>Produkt</th>
                <th>Cena</th>
                <th>Ilość</th>
            </tr>
            <tr>
                <td>
                    <select name="category">
                        <?php
                        $query = "SELECT * FROM Typ_produktu_z_menu";
                        if (!empty($conn)) {
                            $result = mysqli_query($conn, $query);
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                            $categoryName = $row['Typ'];
                            echo "<option value='$categoryName'>$categoryName</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <?php
                    if (isset($_POST['category'])) {
                        $selectedCategory = $_POST['category'];

                        $query = "SELECT * FROM Pozycje_z_menu WHERE typ_produktu = '$selectedCategory'";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $itemName = $row['name'];
                            echo "<input type='checkbox' name='item[]' value='$itemName'>$itemName";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (isset($_POST['category'])) {

                        $selectedCategory = $_POST['category'];

                        $query = "SELECT * FROM Pozycje_z_menu WHERE typ_produktu = '$selectedCategory'";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $itemName = $row['name'];
                            echo "<input type='checkbox' name='item[]' value='$itemName'>$itemName";
                        }
                    }
                    ?>
                </td>
                <td><input type="number" min="0" name="quantity" value="1" ></td>
            </tr>
        </table>
        Typ płatności:
        <input type="radio" name=""><br>
        <input type="submit" name="submit" value="Zlóż zamówienie">
    </form>

</section>
</body>
</html>
