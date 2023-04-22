<?php
include_once 'Database.php';
$conn = new Database();
$entityBodyReg = json_decode(file_get_contents('php://input'), true);
$id = $entityBodyReg['id'];
$pattern = '%'.$id.'%';
if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Rooms WHERE id = '$id' or title like '$pattern';";
$result = mysqli_query($conn->getConnection(), $sql);
$data = array();
if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'message' => $data]);
} else if (mysqli_num_rows($result) >= 2) {
    echo json_encode(['success' => false, 'message' => 'Уточните запрос']);
} else if (mysqli_num_rows($result) == 0){
    echo json_encode(['success' => false, 'message' => 'Номера с таким id или названием не найдено']);
}

header('Content-Type: application/json');
mysqli_close($conn->getConnection());