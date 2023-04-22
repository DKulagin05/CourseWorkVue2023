<?php
include_once 'Database.php';
$conn = new Database();

$entityBodyReg = json_decode(file_get_contents('php://input'),true);
$id = $entityBodyReg['delete_id'];
$delete_title = $entityBodyReg['delete_title'];

if (empty($id) && empty($delete_title)) {
    $result = array(
        'success' => false,
        'message' => 'Произошла ошибка'
    );
} else {
    $query = "DELETE FROM Rooms
              WHERE id = '$id' or title = '$delete_title';";
    mysqli_query($conn->getConnection(), $query);

    $result = array(
        'success' => true,
        'message' => 'Номер успешно удален'
    );
}

mysqli_close($conn->getConnection());
header('Content-Type: application/json');
echo json_encode($result);