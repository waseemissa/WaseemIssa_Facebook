<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';


$user_id = $_POST['user_id'];
$blocked_user_id = $_POST['another_user_id'];

$query = "DELETE FROM users_block_users WHERE user_id = ? and blocked_user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $user_id, $blocked_user_id);
$stmt->execute();

$response = array();
$response["id"] = $blocked_user_id;


$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json; 

?>