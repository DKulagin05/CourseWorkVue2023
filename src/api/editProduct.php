<?php
include_once 'Database.php';
$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $_POST['id'];
$new_title = $_POST['new_title'];
$new_description = $_POST['new_description'];
$new_people_count = $_POST['new_people_count'];
$new_square = $_POST['new_square'];
$new_price = $_POST['new_price'];

if (empty($new_title) || empty($new_description)
    || empty($new_people_count) || empty($new_square)
    || empty($new_price)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все поля'
    );
} else {
    $img =  "C:\\OSPanel\\domains\\Coursovaya\\assets\\img\\products\\" . $_FILES['edit_img']['name'];
    move_uploaded_file($_FILES['edit_img']['tmp_name'], $img);
    $img = $_FILES['edit_img']['name'];
    $query = "UPDATE Rooms
              SET title = '$new_title', description = '$new_description', 
                  people_count = '$new_people_count', square = '$new_square',
                  price = '$new_price', img = '$img'
              WHERE id = '$id';";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Данные успешно изменены'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);