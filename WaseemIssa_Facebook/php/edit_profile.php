<?php
header("Access-Control-Allow-Origin: *");
session_start();
require 'connection.php';

$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$date_of_birth = $_POST['date_of_birth'];


$query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, date_of_birth = ? WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ssssi", $first_name, $last_name, $email, $date_of_birth, $user_id);
$stmt->execute();
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;

$edit_response = array();
$edit_response["first_name"] = $first_name;
$edit_response["last_name"] = $last_name;
$edit_response["email"] = $email;
$edit_response["date_of_birth"] = $date_of_birth;

$edit_response_json  = json_encode($edit_response, JSON_PRETTY_PRINT);
echo $edit_response_json;


?>