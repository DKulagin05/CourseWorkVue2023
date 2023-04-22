<?php

include_once 'Database.php';
$conn = new Database();
$entityBodyReg = json_decode(file_get_contents('php://input'), true);
$item = $entityBodyReg['item_booking'];
$item_id = $item['id'];
$booking_search = "SELECT * FROM Booking WHERE id_room = '$item_id'";
$result = mysqli_query($conn->getConnection(), $booking_search);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
$id_booking = $data[0]['id'];

$booking_search = "DELETE FROM Booking_services WHERE id_booking = '$id_booking'";
mysqli_query($conn->getConnection(), $booking_search);

$booking_query = "DELETE FROM Booking WHERE id_room = '$item_id'";
mysqli_query($conn->getConnection(), $booking_query);

echo json_encode(['success' => true,
    'message' => 'Вы отменили бронирование']);




header('Content-Type: application/json');
//echo json_encode($user_id);
mysqli_close($conn->getConnection());
