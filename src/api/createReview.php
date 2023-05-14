<?php
include_once 'Database.php';
$conn = new Database();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id_user = $entityBodyReg['id_user'];
$user_name = $entityBodyReg['user_name'];
$title = $entityBodyReg['title'];
$description = $entityBodyReg['description'];
$rating = $entityBodyReg['rating'];
//$arr = [$id_user,$user_name,$title,$description,$rating];
if (empty($id_user) || empty($user_name) || empty($title)
    || empty($description) || empty($rating)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все поля'
    );
} else {
    $query = "INSERT INTO Reviews (id_user, user_name, title, description, date, score)
    VALUES ('$id_user', '$user_name', '$title', '$description', NOW(), '$rating')";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Отзыв оставлен'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);