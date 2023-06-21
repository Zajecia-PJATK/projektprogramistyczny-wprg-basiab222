<?php
include_once "../classes/Employee.php";
include_once "../classes/Schedule.php";
require_once "../db_connection.php";

function getWeekSchedule() {
    if (!empty($conn)) {

        $employees = array();

        $queryEmployees = "SELECT * FROM Pracownicy";
        $resultEmployees = $conn->query($queryEmployees);
        if ($resultEmployees->num_rows > 0) {
            while ($row = $resultEmployees->fetch_assoc()) {
                $employee = new Employee($row['ID'], $row['Imie'], $row['Nazwisko'], $row['Stanowisko'], $row['Email'],
                    $row['Haslo']);
                $employees[] = $employee;
            }
        }

        $schedules = array();
        $query = "SELECT * FROM Grafik WHERE Data_godzina";
        $resultSchedule = $conn->query($query);

        if ($resultSchedule->num_rows > 0) {
            while ($row = $resultSchedule->fetch_assoc()) {
                $employeeIds = array();

                $employeeScheduleQuery = "SELECT ID_pracownicy FROM Pracownicy_Grafik WHERE ID_grafik = " . $row['ID'];
                $employeeScheduleResult = $conn->query($employeeScheduleQuery);

                if ($employeeScheduleResult->num_rows > 0) {
                    while ($employeeScheduleRow = $employeeScheduleResult->fetch_assoc()) {
                        $employeeIds[] = $employeeScheduleRow['ID_pracownicy'];
                    }
                }

                $employeesArr = array();

                foreach ($employeeIds as $employeeId) {
                    foreach ($employees as $employee) {
                        if ($employee->ID == $employeeId) {
                            $employeesArr[] = $employee;
                        }
                    }
                }

                $schedule = new Schedule($row['ID'], $row['Data_godzina'], $employeesArr);
                $schedules[] = $schedule;
            }
        }

        $conn->close();
        return $schedules;
    }
}
?>

