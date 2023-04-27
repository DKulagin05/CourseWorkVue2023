<?php
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
$item_id = $entityBodyReg['item_booking'];
$InDate = $entityBodyReg['InDate'];
$OutDate = $entityBodyReg['OutDate'];
$array_services = $entityBodyReg['array_services'];

$key = "your_secret_key";
$jwt = $entityBodyReg['token'];
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
$user_id = $decoded->data->id;


if ($user_id != '') {
    $booking_query = "INSERT INTO Booking (id_user, id_room, arrival_date, departure_date) VALUES ('$user_id','$item_id','$InDate','$OutDate')";
    mysqli_query($conn->getConnection(), $booking_query);
    $booking_query_search = "select * from Booking where id_user ='$user_id' and id_room = '$item_id'";
    $result = mysqli_query($conn->getConnection(), $booking_query_search);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $id_booking_room = $data[0]['id'];

    $booking_services_query = "INSERT INTO Booking_services 
    (id_booking,awakening,dinner,zones,transport) 
    VALUES ('$id_booking_room','$array_services[0]','$array_services[1]','$array_services[2]',
            '$array_services[3]')";
    mysqli_query($conn->getConnection(), $booking_services_query);
    echo json_encode(['success' => true,
        'message' => 'Вы успешно забронировали номер ',
        'tet' => $booking_services_query]);
} else {
    echo json_encode(['success' => false,
        'message' => 'Для бронироания необходимо зарегистрироватся на сайте']);

}


header('Content-Type: application/json');
mysqli_close($conn->getConnection());
