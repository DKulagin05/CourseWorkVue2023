<?php
include_once 'Database.php';
$conn = new Database();
if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$entityBody = json_decode(file_get_contents('php://input'),true);
$query = "SELECT * FROM Promotions";
$result = mysqli_query($conn->getConnection(), $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
mysqli_close($conn->getConnection());
