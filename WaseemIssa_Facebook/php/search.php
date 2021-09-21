<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';
$user_id = $_POST['user_id'];
$text = $_POST['text'];
$name = explode(" ", $text);
if(sizeof($name) == 2 ){
    $first_name = $name[0];
    $last_name = $name[1];

    $query = "SELECT DISTINCT * FROM users u WHERE u.id!= ? AND (u.first_name LIKE '%".$first_name."%' or u.last_name LIKE '%".$last_name."%') AND NOT EXISTS (SELECT 1 FROM users_follow_users ufu WHERE ufu.user_id = ? AND ufu.friend_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_follow_users ufu WHERE ufu.user_id = u.id AND ufu.friend_id = ?) AND NOT EXISTS (SELECT 1 FROM users_send_requests_users usru WHERE usru.user_id = ? AND usru.another_user_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_block_users ubu WHERE ubu.user_id = ? AND ubu.blocked_user_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_block_users ubu WHERE ubu.user_id = u.id AND ubu.blocked_user_id = ?)" ;
    $stmt  = $connection->prepare($query);
    $stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $i=0;
    $search_results = array();
    while($row = $result->fetch_assoc()){
    $search_results[$i]["id"] = $row["id"];
    $search_results[$i]["first_name"] = $row["first_name"];
    $search_results[$i]["last_name"] = $row["last_name"];
    $search_results[$i]["email"] = $row["email"];
    $search_results[$i]["picture"] = $row["profile_picture_url"];
    $i++;
    }
}

else{
    $first_name = $name[0];
    $last_name = $name[0];

    $query = "SELECT DISTINCT * FROM users u WHERE u.id!= ? AND (u.first_name LIKE '%".$first_name."%' or u.last_name LIKE '%".$last_name."%') AND NOT EXISTS (SELECT 1 FROM users_follow_users ufu WHERE ufu.user_id = ? AND ufu.friend_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_follow_users ufu WHERE ufu.user_id = u.id AND ufu.friend_id = ?) AND NOT EXISTS (SELECT 1 FROM users_send_requests_users usru WHERE usru.user_id = ? AND usru.another_user_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_block_users ubu WHERE ubu.user_id = ? AND ubu.blocked_user_id = u.id) AND NOT EXISTS (SELECT 1 FROM users_block_users ubu WHERE ubu.user_id = u.id AND ubu.blocked_user_id = ?)" ;
    $stmt  = $connection->prepare($query);
    $stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $i=0;
    $search_results = array();
    while($row = $result->fetch_assoc()){
    $search_results[$i]["id"] = $row["id"];
    $search_results[$i]["first_name"] = $row["first_name"];
    $search_results[$i]["last_name"] = $row["last_name"];
    $search_results[$i]["email"] = $row["email"];
    $search_results[$i]["picture"] = $row["profile_picture_url"];
    $i++;
    }
}

$search_results_json = json_encode($search_results, JSON_PRETTY_PRINT);
echo $search_results_json;

?>