<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$notification_id = $_POST['id'];
$user_id = $_POST['user_id'];
$another_user_id = $_POST['another_user_id'];
$status = "accepted";
$notification_text = "";
$is_opened = 0;
$is_opened2 = 1;


$query = "UPDATE users_send_requests_users SET status = ? WHERE user_id = ? AND another_user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("sii", $status, $another_user_id, $user_id);
$stmt->execute();

$query2 = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result = $stmt2->get_result();
if($row = $result->fetch_assoc()){
    $notification_text = $row["first_name"]." ".$row["last_name"]." accepted your friend request";
}


$query3 = "INSERT INTO notifications (user_id, created_by, text, is_opened) VALUES (?,?,?,?)";
$stmt3 = $connection->prepare($query3);
$stmt3->bind_param("iisi", $another_user_id, $user_id, $notification_text, $is_opened);
$stmt3->execute();

$query4 = "UPDATE notifications SET is_opened = ? WHERE id = ?";
$stmt4 = $connection->prepare($query4);
$stmt4->bind_param("ii", $is_opened2 , $notification_id);
$stmt4->execute();

$query5 = "INSERT INTO users_follow_users (user_id, friend_id) VALUES (?,?)";
$stmt5 = $connection->prepare($query5);
$stmt5->bind_param("ii", $user_id, $another_user_id);
$stmt5->execute();

$query6 = "INSERT INTO users_follow_users (user_id, friend_id) VALUES (?,?)";
$stmt6 = $connection->prepare($query6);
$stmt6->bind_param("ii", $another_user_id, $user_id);
$stmt6->execute();

$query7 = "DELETE FROM notifications WHERE user_id = ? AND created_by = ?";
$stmt7 = $connection->prepare($query7);
$stmt7->bind_param("ii", $user_id, $another_user_id);
$stmt7->execute();


$response = array();
$response["message"] = "Friend request accepted.";

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;



?>