<?php
// Параметры подключения к базе данных
include_once 'Database.php';
$conn_db = new Database();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Coursework';

// Установка соединения с базой данных
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка соединения на ошибки
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Формирование запроса для выборки записей с датой меньше текущей
$sql = "SELECT * FROM Booking WHERE departure_date < NOW()";

// Выполнение запроса и получение результата
$result = $conn->query($sql);

// Проверка наличия записей
if ($result->num_rows > 0) {
    // Проход по каждой записи
//    echo json_encode($result->fetch_assoc());
    while ($row = $result->fetch_assoc()) {
        // Формирование запроса на удаление записи

        $id = $row['id'];
        $booking_search = "DELETE FROM Booking_services WHERE id_booking = '$id'";
        mysqli_query($conn_db->getConnection(), $booking_search);

        $delete_sql = "DELETE FROM Booking WHERE id = '$id'" ;
        // Выполнение запроса на удаление
        $conn->query($delete_sql);
//        echo json_encode($conn->query($delete_sql));
    }

    $result->free();
} else {
    echo "No records to delete";
}
header('Content-Type: application/json');
// Закрытие соединения с базой данных
$conn->close();
