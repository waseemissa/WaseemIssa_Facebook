<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];

$query = "SELECT u.profile_picture_url AS picture, n.id AS id, n.user_id AS user_id, n.created_by AS created_by, n.text AS text, n.is_opened AS is_opened FROM notifications n, users u WHERE n.created_by = u.id AND n.user_id = ? AND n.text LIKE '%accepted%'";
$stmt  = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


$i = 0;
$notifications_array = array();
while($notification = $result->fetch_assoc()){
    $notifications_array[$i]["id"] = $notification["id"];
    $notifications_array[$i]["user_id"] = $notification["user_id"];
    $notifications_array[$i]["created_by"] = $notification["created_by"];
    $notifications_array[$i]["picture"] = $notification["picture"];
    $notifications_array[$i]["text"] = $notification["text"];
    $notifications_array[$i]["is_opened"] = $notification["is_opened"];
    $i++;
}

$notifications_json = json_encode($notifications_array, JSON_PRETTY_PRINT);
echo $notifications_json;





?>