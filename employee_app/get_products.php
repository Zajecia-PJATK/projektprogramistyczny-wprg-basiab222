<?php
require_once "../db_connection.php";

if (isset($_POST['category'])) {
    $selectedCategory = $_POST['category'];

    $query = "SELECT * FROM Pozycje_w_menu, Typ_produktu_z_menu
                            WHERE Typ_produktu_z_menu.id = Pozycje_w_menu.Typ_produktu_ID 
                              AND Typ_produktu_z_menu.typ = '$selectedCategory'";

    if (!empty($conn)) {
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<select name='products' id='products' onchange='getProductPrice()'>
                      <option value=''>Wybierz produkt</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                $productName = $row['Nazwa'];
                echo "<option value='$productName'>$productName</option>";
            }
        } else {
            echo "<p>Brak produktów z danej kategorii..</p>";
        }
    }
}

mysqli_close($conn);


