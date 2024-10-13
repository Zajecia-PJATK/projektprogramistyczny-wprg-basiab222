<?php
require_once "../db_connection.php";

if (isset($_POST['product'])) {
    $selectedProduct = $_POST['product'];

    $query = "SELECT * FROM Pozycje_w_menu 
         WHERE Pozycje_w_menu.Nazwa = '$selectedProduct'";

    if (!empty($conn)) {

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $productPrice = $row['Cena'];
            echo $productPrice." zł";
        }
    }
}
mysqli_close($conn);


