<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$user_id = $_POST['user_id'];

$query = "SELECT COUNT(friend_id) AS total FROM users_follow_users WHERE user_id=?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


$number_of_followers_array = array();
if($row = $result->fetch_assoc()){
    $number_of_followers_array["id"]= $user_id;
    $number_of_followers_array["total"] = $row["total"];
}

$number_of_followers_json = json_encode($number_of_followers_array, JSON_PRETTY_PRINT);
echo $number_of_followers_json;

?>