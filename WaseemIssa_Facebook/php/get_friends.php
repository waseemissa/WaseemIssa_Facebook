<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];

$query = "SELECT u.id AS id, u.first_name AS first_name, u.last_name AS last_name, u.email AS email, u.profile_picture_url AS picture, u.date_of_birth AS date_of_birth FROM users u, users_follow_users ufu WHERE ufu.user_id = ? AND ufu.friend_id = u.id";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$friends = $stmt->get_result();

$i=0;
$friends_array = array();
while($friend = $friends->fetch_assoc()){
    $friends_array[$i]["id"] = $friend["id"];
    $friends_array[$i]["first_name"] = $friend["first_name"];
    $friends_array[$i]["last_name"] = $friend["last_name"];
    $friends_array[$i]["email"] = $friend["email"];
    $friends_array[$i]["picture"] = $friend["picture"];
    $friends_array[$i]["date_of_birth"] = $friend["date_of_birth"];
    $i++;
}

$friends_json = json_encode($friends_array, JSON_PRETTY_PRINT);
echo $friends_json;

?>