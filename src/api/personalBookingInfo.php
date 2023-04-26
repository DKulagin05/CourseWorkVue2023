<?php
session_start();

include_once 'Database.php';
include_once "../assets/config/core.php";
require_once "../assets/libs/php-jwt/src/BeforeValidException.php";
require_once "../assets/libs/php-jwt/src/ExpiredException.php";
require_once "../assets/libs/php-jwt/src/SignatureInvalidException.php";
require_once "../assets/libs/php-jwt/src/JWT.php";
require_once "../assets/libs/php-jwt/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$key = "your_secret_key";
$jwt = $entityBodyReg['token'];
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
$id_user = $decoded->data->id;

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