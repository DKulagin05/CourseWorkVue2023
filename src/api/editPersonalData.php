<?php
include_once 'Database.php';
$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $_POST['id'];
$new_name = $_POST['new_name'];
$new_surname = $_POST['new_surname'];
$new_patronymic = $_POST['new_patronymic'];
$new_phone = $_POST['new_phone'];
$new_mail = $_POST['new_mail'];
if (empty($new_name) || empty($new_surname)
    || empty($new_phone) || empty($new_mail)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все поля'
    );
} else {
    if (empty($new_patronymic)) {
        $new_patronymic = '';
    }
    if ($_FILES['edit_img']['name']) {
        $img =  "C:\\OSPanel\\domains\\Coursovaya\\assets\\img\\profile_pictures\\" . $_FILES['edit_img']['name'];
        move_uploaded_file($_FILES['edit_img']['tmp_name'], $img);
        $img = $_FILES['edit_img']['name'];
        $query = "UPDATE Users
              SET name = '$new_name', surname = '$new_surname', 
                  patronymic = '$new_patronymic', phone = '$new_phone',
                  email = '$new_mail', img = '$img'
              WHERE id = '$id';";
    } else {
        $query = "UPDATE Users
              SET name = '$new_name', surname = '$new_surname', 
                  patronymic = '$new_patronymic', phone = '$new_phone',
                  email = '$new_mail'
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