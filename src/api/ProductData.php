<?php
include_once 'Database.php';
$conn = new Database();
if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Rooms WHERE id NOT IN (SELECT id_room FROM Booking);";
$result = mysqli_query($conn->getConnection(), $sql);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'message' => $data]);
} else {
    echo json_encode(['success' => false, 'message' => 'Свободных номеров нет, возвращайтесь позже']);
}

header('Content-Type: application/json');
mysqli_close($conn->getConnection());