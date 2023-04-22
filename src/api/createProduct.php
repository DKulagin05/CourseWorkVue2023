<?php
include_once 'Database.php';
$conn = new Database();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$create_title = $_POST['create_title'];
$create_description = $_POST['create_description'];
$create_people_count = $_POST['create_people_count'];
$create_square = $_POST['create_square'];
$create_price = $_POST['create_price'];
$arr = [$create_title,$create_description,$create_people_count,$create_square,$create_price];
// echo json_encode($arr);
if (empty($create_title) || empty($create_description)
    || empty($create_people_count) || empty($create_square)
    || empty($create_price)) {
    $result = array(
        'success' => $arr,
        'message' => 'Заполните все поля'
    );
} else {
    $img =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['create_img']['name'];
    move_uploaded_file($_FILES['create_img']['tmp_name'], $img);
    $img = $_FILES['create_img']['name'];
    $query = "INSERT INTO Rooms (title,
                        description, people_count, square, price, img)
    VALUES ('$create_title', '$create_description',
            '$create_people_count', '$create_square',
            '$create_price','$img')";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Данные успешно добавлены ',
        'tet' => getcwd()
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);