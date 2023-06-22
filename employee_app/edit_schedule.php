<?php
require_once "../db_connection.php";
include_once "schedule_manager.php";

if (isset($_POST['submit'])) {
    $dateTime = $_POST['datetime'];
    $employeeId = $_POST['employee'];

    try {
        $formattedDateTime = date('Y-m-d H:i:s', strtotime($dateTime));

        $query = "DELETE FROM Pracownicy_Grafik
              WHERE ID_pracownicy = {$employeeId}
              AND ID_grafik IN (
                  SELECT ID
                  FROM Grafik
                  WHERE Data_godzina = '{$formattedDateTime}'
              )";

        if (!empty($conn)) {
            $result = $conn->query($query);
        }

        if ($result) {
            header("Location: schedule_layoutE.php");
            exit();
        }

        $conn->close();

    } catch (Exception $e) {
        echo "Wystąpił błąd: " . $e->getMessage();
    }
}

?>

<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Dodaj grafik</title>
    <link rel="stylesheet" href="schedule_modifications.css">
    <title>Edytuj grafik</title>
</head>
<body>
<h2>Edytuj grafik</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="datetime">Data i godzina:</label>
    <input type="datetime-local" id="datetime" name="datetime" required>

    <button type="submit">Wybierz</button>
</form>

<?php
if (isset($_POST['datetime'])) {
    $dateTime = $_POST['datetime'];
    try {
        $formattedDateTime = date('Y-m-d H:i:s', strtotime($dateTime));

        $query = "SELECT * FROM Pracownicy
              JOIN Pracownicy_Grafik ON Pracownicy.ID = Pracownicy_Grafik.ID_pracownicy
              JOIN Grafik ON Pracownicy_Grafik.ID_grafik = Grafik.ID
              WHERE Grafik.Data_godzina = '{$formattedDateTime}'";

        if (!empty($conn)) {
            $result = $conn->query($query);
        }

        if (!$result) {
            throw new Exception("Błąd zapytania do bazy danych: " . $conn->error);
        }

        $employees = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employee = new Employee($row['ID'], $row['Imie'], $row['Nazwisko'], $row['Haslo'], $row['Email'],
                    $row['Stanowisko']);
                $employees[] = $employee;
            }
        }

        $conn->close();

        if (!empty($employees)) {
            if (!empty($employees)) {
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='datetime' value='{$dateTime}'>";
                echo "<label for='employee'>Wybierz pracownika:</label>";
                echo "<select id='employee' name='employee'>";
                foreach ($employees as $employee) {
                    echo "<option value='{$employee->getID()}'>{$employee->getName()} {$employee->getSurname()}</option>";
                }
                echo "</select>";
                echo "<button type='submit' name='submit'>Usuń</button>";
                echo "</form>";
            } else {
                echo "Brak pracowników w grafiku dla wybranej daty i godziny.";
            }
        }
    } catch (Exception $e) {
        echo "Wystąpił błąd: " . $e->getMessage();
    }
}
?>

</body>
</html>
