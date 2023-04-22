<?php
session_start();
//include_once 'Database.php';
//$entityBody = json_decode(file_get_contents('php://input'),true);
//if($_SESSION['auth']) {
//    $id_user = $_SESSION['id'];
//    $conn = new Database();
//    $check_query = "SELECT * FROM Booking WHERE id_user = '$id_user'";
//    $result = mysqli_query($conn->getConnection(), $check_query);
//
//    if (mysqli_num_rows($result) > 0) {
//        $user = mysqli_fetch_assoc($result);
//        echo json_encode(['success' => true, 'message' => 'Все верно']);
//    } else {
//        echo json_encode(['success' => false, 'message' => 'Что-то пошло не так']);
//    }
//    mysqli_close($conn->getConnection());
//} else {
//    echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован']);
//}


include_once 'Database.php';
$conn = new Database();
$id_user = $_SESSION['id'];
$check_query = "SELECT * FROM Booking WHERE id_user = '$id_user'";
$result_booking = mysqli_query($conn->getConnection(), $check_query);
$data_booking = array();
while ($row = mysqli_fetch_assoc($result_booking)) {
    $data_booking[] = $row;
}
$data = array();
$result_data = array();
for ($i=0;$i<count($data_booking);$i++) {
    $temp_data = array();
    $all_booking = $data_booking[$i]['id_room'];
    $id_booking = $data_booking[$i]['id'];

    $sql_services = "SELECT * FROM Booking_services WHERE id_booking = '$id_booking'";
    $result_services = mysqli_query($conn->getConnection(), $sql_services);
    while ($row = mysqli_fetch_assoc($result_services)) {
        $temp_data[] = $row;
    }

    $sql = "SELECT * FROM Rooms WHERE id = '$all_booking'";
    $result = mysqli_query($conn->getConnection(), $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        $temp_data[] = $row;
    }
    $result_data[] = $temp_data;
}
//header('Content-Type: application/json');
//echo json_encode($data);
//mysqli_close($conn->getConnection());

header('Content-Type: application/json');
echo json_encode(['success' => true,
    'message' => $data,
    'result' => $result_data]);
mysqli_close($conn->getConnection());