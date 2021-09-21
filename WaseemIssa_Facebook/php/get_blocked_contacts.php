<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];

$query = "SELECT u.id AS id, u.first_name AS first_name, u.last_name AS last_name, u.email AS email, u.profile_picture_url AS picture from users u, users_block_users ubu WHERE ubu.user_id = ? AND ubu.blocked_user_id = u.id";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$i=0;
$blocked = array();
while($row = $result->fetch_assoc()){
    $blocked[$i]["id"] = $row["id"];
    $blocked[$i]["first_name"] = $row["first_name"];
    $blocked[$i]["last_name"] = $row["last_name"];
    $blocked[$i]["email"] = $row["email"];
    $blocked[$i]["picture"] = $row["picture"];
    $i++;

}

$blocked_json = json_encode($blocked, JSON_PRETTY_PRINT);
echo $blocked_json;


?>