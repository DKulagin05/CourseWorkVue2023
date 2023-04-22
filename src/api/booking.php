<?php
include_once 'Database.php';
$conn = new Database();
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$item = $entityBodyReg['item_booking'];
$item_id = $item['id'];
$array_services = $entityBodyReg['array_services'];
$user_id = $entityBodyReg['userId'];
$today = date('Y-m-d');
$today = "'$today'";
if ($user_id != '') {
    $booking_query = "INSERT INTO Booking (id_user, id_room) VALUES ('$user_id','$item_id')";
    mysqli_query($conn->getConnection(), $booking_query);
    $booking_query_search = "select * from Booking where id_user ='$user_id' and id_room = '$item_id'";
    $result = mysqli_query($conn->getConnection(), $booking_query_search);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $id_booking_room = $data[0]['id'];

    $booking_services_query = "INSERT INTO Booking_services 
    (id_booking,breakfast,dinner,spa,transport) 
    VALUES ('$id_booking_room','$array_services[0]','$array_services[1]','$array_services[2]',
            '$array_services[3]')";
    mysqli_query($conn->getConnection(), $booking_services_query);
    echo json_encode(['success' => true,
        'message' => 'Вы успешно забронировали номер ',
        'tet' => $array_services]);
} else {
    echo json_encode(['success' => false,
        'message' => 'Для бронироания необходимо зарегистрироватся на сайте']);

}


header('Content-Type: application/json');
//echo json_encode($user_id);
mysqli_close($conn->getConnection());
