<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Grafik</title>
    <link rel="stylesheet" href="../menu_bar.css">
    <link rel="stylesheet" href="calendar.css">
</head>
<body>
<ul>
    <li><a class="active" href="schedule_layoutE.php">Grafik</a></li>
    <li><a href="menu_layoutE.php">Menu</a></li>
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
require_once "../db_connection.php";
include_once "schedule_manager.php";

$daysOfWeek = array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');


if(isset($_GET['date'])) {
    $date = $_GET['date'];
    $today = new DateTime($date);
} else {
    $today = new DateTime();
}

$today->setISODate($today->format('o'), $today->format('W'));

$startDate = $today->format('Y-m-d');
$endDate = $today->modify('+6 days')->format('Y-m-d');

$monday = $today->format('Y-m-d');

$html = '<h2>' . $today->format('d/m/Y') . " - " .$today->format('d/m/Y').'</h2>';

$html .= '<a class = "button" href="?date=' . date('Y-m-d', strtotime($monday . ' - 7 days')) . '"> < </a> ';
$html .= '<a class = "button" href="?date=' . date('Y-m-d', strtotime($monday . ' + 7 days')) . '"> > </a>';

$html .= '<table>';
$html .= '<tr><th>Godzina</th>';

foreach ($daysOfWeek as $day) {
    $html .= '<th>' . $day . '</th>';
}

$html .= '</tr>';

$timeSlots = array('9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00');
$daysOfWeekEN = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

$events = array();

try {
    $weekSchedules = getWeekSchedule();
    print_r($weekSchedules);
    foreach ($weekSchedules as $schedule) {
        $scheduleDate = date('Y-m-d', strtotime($schedule->getDateTime()));
        $day = date('l', strtotime($schedule->getDateTime()));

        if ($scheduleDate >= $startDate && $scheduleDate <= $endDate) {
            foreach ($schedule->getEmployees() as $employee) {
                $event = array('employee' => $employee, 'time' => date('h:i', strtotime($schedule->dateTime)));
                $events[$day][] = $event;
            }
        }
    }
} catch (mysqli_sql_exception $mysqli_sql_exception){
    echo "blad";
}


foreach ($timeSlots as $timeSlot) {
    $html .= '<tr>';
    $html .= '<td>' . $timeSlot . '</td>';

    foreach ($daysOfWeekEN as $day) {
        $html .= '<td>';

        if (isset($events[$day])) {
            foreach ($events[$day] as $event) {
                if ($event['time'] == $timeSlot) {
                    $html .= $event['employee'] . '<br>';
                }
            }
        }

        $html .= '</td>';
    }

    $html .= '</tr>';
}

$html .= '</table>';

echo $html;
?>

</section>
</body>
</html>

