<?php
include_once 'Database.php';
include_once "../config/core.php";
require_once "../libs/php-jwt/src/BeforeValidException.php";
require_once "../libs/php-jwt/src/ExpiredException.php";
require_once "../libs/php-jwt/src/SignatureInvalidException.php";
require_once "../libs/php-jwt/src/JWT.php";
require_once "../libs/php-jwt/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
include_once 'Database.php';
$conn = new Database();
$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$item_id = $entityBodyReg['item_id'];
$token = $entityBodyReg['token'];
if (!$conn->getConnection()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Room_services where id_room = '$item_id'";
$result = mysqli_query($conn->getConnection(), $sql);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
header('Content-Type: application/json');
$jwt = JWT::decode($token, new Key('your_secret_key', 'HS256'));
$arr = [$data,$jwt];
echo json_encode($data);
mysqli_close($conn->getConnection());