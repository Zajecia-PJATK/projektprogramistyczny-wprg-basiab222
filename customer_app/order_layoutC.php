<?php
require_once "../db_connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Złóż zamówienie</title>
    <link rel="stylesheet" href="../menu_bar.css">
    <link rel="stylesheet" href="../employee_app/take_order.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../employee_app/order_functions.js"></script>
</head>
<body>
<ul>
    <li><a href="menu_layoutC.php">Menu</a></li>
    <li><a class="active" href="order_layoutC.php">Złóż zamówienie</a></li>
    <li><a href="order_history_layoutC.php">Śledzenie i historia zamówień</a></li>
    <li><a href="reserve_table_layoutC.php">Zarezerwuj stolik</a></li>
    <li><a href="book_event_layoutC.php">Wydarzenia specjalne</a></li>
    <li><a href="special_offers_layoutC.php">Oferty specjalne</a></li>
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
</body>
</html>
