<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];
$another_user_id = $_POST['another_user_id'];
$status = "pending";
$notification_text = "";
$is_opened = 0;


$query = "INSERT INTO users_send_requests_users (user_id, another_user_id, status) VALUES (?,?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("iis", $user_id, $another_user_id, $status);
$stmt->execute();

$query2 = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result = $stmt2->get_result();
if($row = $result->fetch_assoc()){
    $notification_text = $row["first_name"]." ".$row["last_name"]." sent you a friend request";
}


$query3 = "INSERT INTO notifications (user_id, created_by, text, is_opened) VALUES (?,?,?,?)";
$stmt3 = $connection->prepare($query3);
$stmt3->bind_param("iisi", $another_user_id, $user_id, $notification_text, $is_opened);
$stmt3->execute();

$query4 = "SELECT * FROM USERS WHERE id = ?";
$stmt4 = $connection->prepare($query4);
$stmt4->bind_param("i", $another_user_id);
$stmt4->execute();
$result2 = $stmt4->get_result();

$response = array();
while($person = $result2->fetch_assoc()){
    $response["id"] = $person["id"];
    $response["first_name"] = $person["first_name"];
    $response["last_name"] = $person["last_name"];
    $response["email"] = $person["email"];
    $response["picture"] = $person["profile_picture_url"];
    $response["date_of_birth"] = $person["date_of_birth"];
}



$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;

?>