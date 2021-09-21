<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];
$current_password = hash('sha256', $_POST['current_password']);
$new_password = hash('sha256', $_POST['new_password']);
$confirm_password = hash('sha256', $_POST['confirm_new_password']);

$password_in_database = "";

$query = "SELECT password FROM users WHERE id=?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
if($row = $result->fetch_assoc()){
    $password_in_database = $row['password'];
}

if($password_in_database == $current_password){
    if($new_password == $confirm_password){
        $query2 = "UPDATE users SET password = ? WHERE id = ?";
        $stmt2 = $connection->prepare($query2);
        $stmt2->bind_param("si", $new_password,$user_id);
        $stmt2->execute();
        $response["message"] = "success";
    }
}
else{
    $response["message"] = "wrong password";
}

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;

