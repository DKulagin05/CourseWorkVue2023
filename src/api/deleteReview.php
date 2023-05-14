<?php
include_once 'Database.php';
$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['remove_id'];

if (empty($id)) {
    $result = array(
        'success' => false,
        'message' => 'Произошла ошибка'
    );
} else {
    $query = "DELETE FROM Reviews
              WHERE id = '$id';";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Отзыв успешно удален'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);