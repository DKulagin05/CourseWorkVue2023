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
if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$key = "your_secret_key";
$entityBody = json_decode(file_get_contents('php://input'),true);
$jwt = $entityBody['token'];
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

$id = $decoded->data->id;
$admin = $decoded->data->admin;
$data[] = $admin;
$query = "SELECT * FROM Users WHERE id = '$id'";
$result = mysqli_query($conn->getConnection(), $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
mysqli_close($conn->getConnection());