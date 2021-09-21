<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$notification_id = $_POST["id"];
$user_id = $_POST["user_id"];
$another_user_id = $_POST["another_user_id"];

$query = "DELETE FROM users_send_requests_users WHERE user_id = ? AND another_user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $another_user_id, $user_id);
$stmt->execute();


$query2 = "DELETE FROM notifications WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $notification_id);
$stmt2->execute();

$response = array();
$response["message"] = "Friend request deleted.";

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;


?>