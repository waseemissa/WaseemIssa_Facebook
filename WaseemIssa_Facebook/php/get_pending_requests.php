<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];


$query = "SELECT  u.id  AS id, u.first_name AS first_name, u.last_name AS last_name, u.email AS email, u.date_of_birth AS date_of_birth, u.profile_picture_url AS picture FROM users u, users_send_requests_users ufu WHERE ufu.user_id = ? AND u.id = ufu.another_user_id AND ufu.status LIKE 'pending'";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$i = 0;
$pending_friends_array = array();
while($row = $result->fetch_assoc()){
    $pending_friends_array[$i]["id"] = $row["id"];
    $pending_friends_array[$i]["first_name"] = $row["first_name"];
    $pending_friends_array[$i]["last_name"] = $row["last_name"];
    $pending_friends_array[$i]["email"] = $row["email"];
    $pending_friends_array[$i]["picture"] = $row["picture"];
    $pending_friends_array[$i]["date_of_birth"] = $row["date_of_birth"];
    $i++;
}

$pending_friends_json = json_encode($pending_friends_array, JSON_PRETTY_PRINT);
echo $pending_friends_json;


?>