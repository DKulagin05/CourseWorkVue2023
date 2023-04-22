<?php
//// Получаем данные из массива $_POST
//$username = $_POST['username'];
//$password = $_POST['password'];
//include_once 'Database.php';
//// Создаем соединение с базой данных
//$conn = new Database();
//
//// Проверяем соединение
//if (!$conn->getConnection()) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//
//// Проверяем, есть ли пользователь с таким же именем в базе данных
//$sql = "SELECT * FROM users WHERE username='$username'";
//$result = mysqli_query($conn->getConnection(), $sql);
//
//if (mysqli_num_rows($result) > 0) {
//    // Если пользователь уже существует, возвращаем сообщение об ошибке
//    $response = array(
//        'success' => false,
//        'message' => 'User with this username already exists'
//    );
//} else {
//    // Если пользователь не существует, добавляем его в базу данных
//    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
//
//    if (mysqli_query($conn->getConnection(), $sql)) {
//        // Если данные были успешно добавлены, возвращаем сообщение об успехе
//        $response = array(
//            'success' => true,
//            'message' => 'User registered successfully'
//        );
//    } else {
//        // Если произошла ошибка при добавлении данных, возвращаем сообщение об ошибке
//        $response = array(
//            'success' => false,
//            'message' => 'Error registering user'
//        );
//    }
//}
//
//// Закрываем соединение с базой данных
//mysqli_close($conn->getConnection());

// Возвращаем данные в формате JSON
//echo json_encode($response);

include_once 'Database.php';
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$name = $entityBodyReg['name'];
$surname = $entityBodyReg['surname'];
$patronymic = $entityBodyReg['patronymic'];
$email = $entityBodyReg['email'];
$phone = $entityBodyReg['phone'];
$password = $entityBodyReg['password'];
$password_repeat = $entityBodyReg['password_repeat'];
// Проверяем, что все обязательные поля заполнены
if (empty($name) || empty($surname)
    || empty($email) || empty($phone)
    || empty($password) || empty($password_repeat)) {
    $result = array(
        'success' => false,
        'message' => 'Заполните все обязательные поля'
    );
} else {
    // Проверяем, что пароль и его подтверждение совпадают
    if ($password !== $password_repeat) {
        $result = array(
            'success' => false,
            'message' => 'Пароли не совпадают'
        );
    } else {
        // Подключаемся к базе данных
        $conn = new Database();

        // Проверяем, существует ли пользователь с таким же email или телефоном
        $query = "SELECT * FROM Users WHERE email = '$email' OR phone = '$phone'";
        $result = mysqli_query($conn->getConnection(), $query);

        if (mysqli_num_rows($result) > 0) {
            $result = array(
                'success' => false,
                'message' => 'Пользователь с таким email или телефоном уже существует'
            );
        } else {
            // Хэшируем пароль
//            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Сохраняем данные пользователя в базу данных
            $query = "INSERT INTO Users (name, surname, patronymic, email, phone, password) VALUES ('$name', '$surname', '$patronymic', '$email', '$phone', '$password')";
            mysqli_query($conn->getConnection(), $query);

            $result = array(
                'success' => true,
                'message' => 'Регистрация прошла успешно'
            );
        }

        // Закрываем соединение с базой данных
        mysqli_close($conn->getConnection());
    }
}

// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode($result);