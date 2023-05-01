<?php
include_once 'Database.php';
$conn = new Database();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$createPromotionTitle = $_POST['createPromotionTitle'];
$createPromotionDescription = $_POST['createPromotionDescription'];

if (empty($createPromotionTitle) || empty($createPromotionDescription)) {
    $result = array(
        'success' => true,
        'message' => 'Заполните все поля'
    );
} else {
    $img1 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\promotions\\" . $_FILES['CreatePromotionImg']['name'];
    move_uploaded_file($_FILES['CreatePromotionImg']['tmp_name'], $img1);
    $img1 = $_FILES['CreatePromotionImg']['name'] ?? '';
    $query = "INSERT INTO Promotions (title, description, img)
              VALUES ('$createPromotionTitle', '$createPromotionDescription', '$img1')";
    mysqli_query($conn->getConnection(), $query);
    $result = array(
        'success' => true,
        'message' => 'Данные успешно добавлены'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);