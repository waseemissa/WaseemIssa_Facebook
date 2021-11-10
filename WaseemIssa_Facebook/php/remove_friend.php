<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];
$another_user_id = $_POST['another_user_id'];
$name1 = "";
$name2 = "";

$query = "DELETE FROM users_follow_users WHERE user_id = ? AND friend_id = ? OR user_id = ? AND friend_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("iiii", $user_id, $another_user_id, $another_user_id, $user_id);
$stmt->execute();

$query2 = "SELECT first_name, last_name from users WHERE id = ?";
$stmt2 = $connection->prepare($query2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result1 = $stmt2->get_result();
if($row1 = $result1->fetch_assoc()){
    $name1 = $row1['first_name']." ".$row1['last_name'];
}

$query3 = "SELECT first_name, last_name from users WHERE id = ?";
$stmt3 = $connection->prepare($query3);
$stmt3->bind_param("i", $another_user_id);
$stmt3->execute();
$result2 = $stmt3->get_result();
if($row2 = $result2->fetch_assoc()){
    $name2 = $row2['first_name']." ".$row2['last_name'];
}

$query4 = "DELETE FROM notifications WHERE user_id = ? AND text LIKE '%".$name2."%'";
$stmt4 = $connection->prepare($query4);
$stmt4->bind_param("i", $user_id);
$stmt4->execute();

$query5 = "DELETE FROM notifications WHERE user_id = ? AND text LIKE '%".$name1."%'";
$stmt5 = $connection->prepare($query5);
$stmt5->bind_param("i",$another_user_id);

$query6 = "DELETE FROM users_send_requests_users WHERE user_id = ? AND another_user_id = ? OR user_id= ? AND another_user_id = ?";
$stmt6 = $connection->prepare($query6);
$stmt6->bind_param("iiii", $user_id, $another_user_id, $another_user_id, $user_id);
$stmt6->execute();


$response = array();
$response["message"] = $name2." unfriended.";

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;

?>