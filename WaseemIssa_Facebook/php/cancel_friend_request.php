<?php

require 'connection.php';
header("Access-Control-Allow-Origin: *");
$user_id = $_POST['user_id'];
$another_user_id = $_POST['another_user_id'];
$name = "";

$query = "DELETE FROM users_send_requests_users WHERE user_id = ? AND another_user_id = ? AND status LIKE 'pending'";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $user_id, $another_user_id);
$stmt->execute();

$query2 = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result = $stmt2->get_result();
if($row = $result->fetch_assoc()){
    $name = $row['first_name']." ".$row['last_name'];
}

$query3 = "DELETE FROM notifications WHERE user_id = ? AND text LIKE '%".$name."%'";
$stmt3 = $connection->prepare($query3);
$stmt3->bind_param("i", $another_user_id);
$stmt3->execute();

$response = array();
$response["success"] = "Follow request canceled";

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;

?>