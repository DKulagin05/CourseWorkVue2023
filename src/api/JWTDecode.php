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

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$key = "your_secret_key";
$jwt = $entityBodyReg['token'];
$decoded = JWT::decode($jwt, new Key($key, 'HS256'));

header('Content-Type: application/json');
echo json_encode($decoded);