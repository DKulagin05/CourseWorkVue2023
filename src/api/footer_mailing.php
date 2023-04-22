<?php
session_start();
include_once 'Database.php';
$entityBody = json_decode(file_get_contents('php://input'),true);
if(isset($entityBody['email'])) {
    $email = $entityBody['email'];
    $conn = new Database();
    $check_query = "INSERT INTO Mailing (mail) VALUES ('$email')";
    $result = mysqli_query($conn->getConnection(), $check_query);
    echo json_encode(['success' => true, 'message' => 'Вы успешно подписалтсь на рассылку']);
    mysqli_close($conn->getConnection());
} else {
    echo json_encode(['success' => false, 'message' => 'Необходимо ввести email']);
}