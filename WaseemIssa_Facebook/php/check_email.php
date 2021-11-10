<?php
header("Access-Control-Allow-Origin: *");
require 'connection.php';

$email = $_POST['email'];

$query = "SELECT email FROM users WHERE email = ?";
$stmt  = $connection->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
if($row = $result->fetch_assoc()){
    $response["message"] = "E-mail verified!";
}
else{
    $response["message"] = "No matching account with this e-mail address!";
}

$response_json = json_encode($response, JSON_PRETTY_PRINT);
echo $response_json;

?>