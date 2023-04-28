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

$key = "your_secret_key";
$jwt = $_POST['token'];
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
$id = $decoded->data->id;

$new_name = $_POST['new_name'];
$new_surname = $_POST['new_surname'];
$new_patronymic = $_POST['new_patronymic'];
$new_phone = $_POST['new_phone'];
$new_email = $_POST['new_email'];
if (empty($new_name) || empty($new_surname) || empty($new_patronymic)
    || empty($new_phone) || empty($new_email)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все поля',
    );
} else {
    if (empty($new_patronymic)) {
        $new_patronymic = '';
    }
    if ($_FILES['edit_img']['name']) {
        $img =  "C:\\OSPanel\\domains\\frontend\\src\\assets\\img\\profile_pictures\\" . $_FILES['edit_img']['name'];
        move_uploaded_file($_FILES['edit_img']['tmp_name'], $img);
        $img = $_FILES['edit_img']['name'];
        $query = "UPDATE Users
              SET name = '$new_name', surname = '$new_surname', 
                  patronymic = '$new_patronymic', phone = '$new_phone',
                  email = '$new_email', img = '$img'
              WHERE id = '$id';";
    } else {
        $query = "UPDATE Users
              SET name = '$new_name', surname = '$new_surname', 
                  patronymic = '$new_patronymic', phone = '$new_phone',
                  email = '$new_email'
              WHERE id = '$id';";
    }

    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Данные успешно изменены',
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);