<?php
//include_once 'Database.php';
//include_once "../assets/config/core.php";
//require_once "../assets/libs/php-jwt/src/BeforeValidException.php";
//require_once "../assets/libs/php-jwt/src/ExpiredException.php";
//require_once "../assets/libs/php-jwt/src/SignatureInvalidException.php";
//require_once "../assets/libs/php-jwt/src/JWT.php";
//require_once "../assets/libs/php-jwt/src/Key.php";
//use \Firebase\JWT\JWT;
//use \Firebase\JWT\Key;
//$conn = new Database();
//$entityBodyReg = json_decode(file_get_contents('php://input'),true);
//$item_id = $entityBodyReg['item_id'];
//$key = "your_secret_key";
//$jwt = $entityBodyReg['token'];
//$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
//$user_id = $decoded->data->id;
//
//
//if (!$conn->getConnection()) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//$sql = "SELECT * FROM Room_services where id_room = '$item_id'";
//$result = mysqli_query($conn->getConnection(), $sql);
//$data = array();
//while ($row = mysqli_fetch_assoc($result)) {
//    $data[] = $row;
//}
//header('Content-Type: application/json');
//echo json_encode($data);
//mysqli_close($conn->getConnection());