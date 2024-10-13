<?php
require_once "../db_connection.php";
include_once "schedule_manager.php";

function getEmployees()
{
    $dbHost = "127.0.0.1";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "Projekt_wprg";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        $query = "SELECT * FROM Pracownicy";
        if (!empty($conn)) {
            $result = $conn->query($query);
        }

        $employees = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employee = new Employee($row['ID'], $row['Imie'], $row['Nazwisko'], $row['Email'],$row['Haslo'],$row['Stanowisko']);
                $employees[] = $employee;
            }
        }
        return $employees;
    } catch (Exception $e) {
        throw new Exception("Wystąpił błąd podczas pobierania pracowników: " . $e->getMessage());
    }
}

function addSchedule($dateTime, $employeeId) {

    try {
        $time = date("H:i", strtotime($dateTime));
        if ($time >= "08:00" && $time <= "21:00") {
            $insertScheduleQuery = "INSERT INTO Grafik (Data_godzina) VALUES ('$dateTime')";
            if (!empty($conn)) {
                $conn->query($insertScheduleQuery);
            }
            $scheduleId = $conn->insert_id;

            $insertEmployeeScheduleQuery = "INSERT INTO Pracownicy_Grafik (ID_grafik, ID_pracownicy) VALUES ('$scheduleId', '$employeeId')";
            $conn->query($insertEmployeeScheduleQuery);
            echo "hello";
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        throw new Exception("Wystąpił błąd podczas dodawania grafiku: " . $e->getMessage());
    }
}

if (isset($_POST['submit'])) {
    $dateTime = $_POST['datetime'];
    $employeeId = $_POST['employee'];

    try {
        if (addSchedule($dateTime, $employeeId)) {
            header("Location: schedule_layoutE.php");
            exit();
        } else {
            echo "Podana godzina jest nieprawidłowa. Zmiana może zostać dodana tylko między 8:00 a 21:00.";
        }
    } catch (Exception $e) {
        echo "Wystąpił błąd: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Dodaj grafik</title>
    <link rel="stylesheet" href="schedule_modifications.css">
</head>
<body>
<h2>Dodaj grafik</h2>
<form method="POST" action="">
    <label for="datetime">Data i godzina:</label>
    <input type="datetime-local" id="datetime" name="datetime" required>

    <label for="employee">Pracownik:</label>
    <select id="employee" name="employee" required>
        <?php
        try {
            $employees = getEmployees();
            foreach ($employees as $employee) {
                echo "<option value='{$employee->getID()}'>{$employee->getName()} {$employee->getSurname()}</option>";
            }
        } catch (Exception $e) {
            echo "Wystąpił błąd: " . $e->getMessage();
        }
        ?>
    </select><br>
    <button type="submit" name="submit">Dodaj grafik</button>
</form>
</body>
</html>
