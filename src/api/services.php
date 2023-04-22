<?php
session_start();
include_once 'Database.php';
$conn = new Database();
$check_query = "SELECT * FROM Services";
$result = mysqli_query($conn->getConnection(), $check_query);
while ($row = mysqli_fetch_assoc($result)) {
    $data_services[] = $row;
}
echo json_encode($data_services);
mysqli_close($conn->getConnection());
