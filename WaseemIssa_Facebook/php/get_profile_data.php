<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$profile = array();
while($row = $result->fetch_assoc()){
    $profile["first_name"] = $row["first_name"];
    $profile["last_name"] = $row["last_name"];
    $profile["email"] = $row["email"];
    $profile["date_of_birth"] = $row["date_of_birth"];
}

$profile_json = json_encode($profile, JSON_PRETTY_PRINT);
echo $profile_json;

?>