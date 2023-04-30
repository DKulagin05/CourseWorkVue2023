<?php
include_once 'Database.php';
$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $_POST['edit_id'];
$edit_title= $_POST['edit_title'];
$edit_description = $_POST['edit_description'];
$edit_people_count = $_POST['edit_people_count'];
$edit_square = $_POST['edit_square'];
$edit_price = $_POST['edit_price'];
$edit_minibar = $_POST['edit_minibar'];
$edit_tv = $_POST['edit_tv'];
$edit_wifi = $_POST['edit_wifi'];
$edit_conditioner = $_POST['edit_conditioner'];

if (empty($edit_title) || empty($edit_description)
    || empty($edit_people_count) || empty($edit_square)
    || empty($edit_price)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все поля'
    );
} else {

    $img1 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['edit_product_img_1']['name'];
    move_uploaded_file($_FILES['edit_product_img_1']['tmp_name'], $img1);
    $img2 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['edit_product_img_2']['name'];
    move_uploaded_file($_FILES['edit_product_img_2']['tmp_name'], $img2);
    $img3 =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\products\\" . $_FILES['edit_product_img_3']['name'];
    move_uploaded_file($_FILES['edit_product_img_3']['tmp_name'], $img3);

    if ($_FILES['edit_product_img_1'] === null) {
        $query = "UPDATE Rooms
              SET `title` = '$edit_title', `description` = '$edit_description', `people_count` = '$edit_people_count', 
                  `square` = '$edit_square', `price` = '$edit_price',  `TV` = '$edit_tv', `WiFi` = '$edit_wifi', `Conditioner` = '$edit_conditioner', 
                  `Minibar` = '$edit_minibar'
              WHERE id = '$id';";
    } else {
        $img = $_FILES['edit_product_img_1']['name'] ?? '';
        $img2 = $_FILES['edit_product_img_2']['name'] ?? '';
        $img3 = $_FILES['edit_product_img_3']['name'] ?? '';
        $query = "UPDATE Rooms
              SET `title` = '$edit_title', `description` = '$edit_description', `people_count` = '$edit_people_count', 
                  `square` = '$edit_square', `price` = '$edit_price',  `TV` = '$edit_tv', `WiFi` = '$edit_wifi', `Conditioner` = '$edit_conditioner', 
                  `Minibar` = '$edit_minibar', `img_1` = '$img', `img_2` = '$img2', `img_3` = '$img3'
              WHERE id = '$id';";
    }

    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Данные успешно изменены',
        'tet' => $query
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);