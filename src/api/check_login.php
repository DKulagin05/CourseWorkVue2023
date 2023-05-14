<?php
session_start();

include_once 'Database.php';
include_once "../assets/config/core.php";
require_once "../assets/libs/php-jwt/src/BeforeValidException.php";
require_once "../assets/libs/php-jwt/src/ExpiredException.php";
require_once "../assets/libs/php-jwt/src/SignatureInvalidException.php";
require_once "../assets/libs/php-jwt/src/JWT.php";
require_once "../assets/libs/php-jwt/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
$entityBody = json_decode(file_get_contents('php://input'),true);
if(isset($entityBody['email']) && isset($entityBody['password'])) {
    $email = $entityBody['email'];
    $password = $entityBody['password'];
    $conn = new Database();
    $check_query = "SELECT * FROM Users WHERE email = '$email' or phone = '$email'";
    $result = mysqli_query($conn->getConnection(), $check_query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) {
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user['id'];
            global $iss, $aud, $iat, $nbf, $key;
            $token = array(
                "iss" => $iss,
                "aud" => $aud,
                "iat" => $iat,
                "nbf" => $nbf,
                "data" => array(
                    "id" => $user['id'],
                    "user_name" => $user['name'],
                    "admin" => $user['admin']
                )
            );
            $jwt = JWT::encode($token, $key, 'HS256');
            echo json_encode(
                ['success' => true, 'message' => 'Успешная авторизация', 'token' => $jwt]
            );

        } else {
            echo json_encode(['success' => false, 'message' => 'Неверный пароль']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Пользователь с такой почтой или номером не найден']);
    }
    mysqli_close($conn->getConnection());
} else {
    echo json_encode(['success' => false, 'message' => 'Необходимо ввести email и пароль']);
}