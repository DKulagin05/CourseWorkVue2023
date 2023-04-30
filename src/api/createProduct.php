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
$create_minibar = $_POST['create_minibar'];
$create_tv = $_POST['create_tv'];
$create_wifi = $_POST['create_wifi'];
$create_conditioner = $_POST['create_conditioner'];

if (empty($create_title) || empty($create_description)
    || empty($create_people_count) || empty($create_square)
    || empty($create_price)) {
    $result = array(
        'success' => true,
        'message' => 'Заполните все поля'
    );
} else {
    //
    $img1 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['create_img_1']['name'];
    move_uploaded_file($_FILES['create_img_1']['tmp_name'], $img1);
    $img2 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['create_img_2']['name'];
    move_uploaded_file($_FILES['create_img_2']['tmp_name'], $img2);
    $img3 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['create_img_3']['name'];
    move_uploaded_file($_FILES['create_img_3']['tmp_name'], $img3);
    $img1 = $_FILES['create_img_1']['name'] ?? '';
    $img2 = $_FILES['create_img_2']['name'] ?? '';
    $img3 = $_FILES['create_img_3']['name'] ?? '';
    $query = "INSERT INTO Rooms (title,
                        description, people_count, square, price, TV, WiFi, Conditioner, Minibar, img_1, img_2, img_3)
    VALUES ('$create_title', '$create_description',
            '$create_people_count', '$create_square',
            '$create_price','$create_tv','$create_wifi','$create_conditioner',
            '$create_minibar','$img1','$img2','$img3')";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Данные успешно добавлены'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);