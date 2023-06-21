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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="order_functions.js"></script>
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
        <table id="orderTable">
            <tr>
                <th>Kategoria</th>
                <th>Produkt</th>
                <th>Cena</th>
                <th>Ilość</th>
            </tr>
            <tr>
                <td>
                    <select name="category" id="category" onchange="getMenuProducts()">
                        <option value="">Wybierz kategorie</option>
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
                    <div id="productList"></div>
                </td>
                <td>
                    <div id="productPrice">
                </td>
                <td><input type="number" name="quantity" id="quantity" min="1" onchange="calculateTotal()"></td>
            </tr>
        </table>
        <button onclick="addRow()">Dodaj kolejny produkt</button>
        <div id="totalPrice"></div>
        Typ płatności:
        <input type="radio" name=""><br>
        <input type="submit" name="submit" value="Zlóż zamówienie">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $selectedItems = $_POST['item'];

        echo "<div class='order-summary'>";
        echo "<h2>Podsumowanie:</h2>";
        if (count($selectedItems) > 0) {
            echo "<ul>";
            foreach ($selectedItems as $item) {
                echo "<li>$item</li>";
            }
            echo "</ul>";
            echo "<p>Wartość: <span id='totalPrice'>0.00 zł</span></p>";
        } else {
            echo "<p>Nic nie zostało wybrane.</p>";
        }
        echo "</div>";
    }
    ?>
</section>
</body>
</html>
