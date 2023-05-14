<?php
include_once 'Database.php';
$conn = new Database();

if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Reviews";
$result = mysqli_query($conn->getConnection(), $sql);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => $data]);
} else {
    echo json_encode(['success' => false, 'message' => 'Что-то пошло не так']);
}
mysqli_close($conn->getConnection());