<?php
require 'connection.php';
session_start();

if(isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != "" && $_POST['password'] != ""){
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
}
else{
    die("Try again later");
}

$query = "SELECT * FROM users WHERE email =?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()){
    if($row['password'] == $password){
        $_SESSION['status']="Active";
        $_SESSION['user_id']=$row['id'];
        $_SESSION['first_name']=$row['first_name'];
        $_SESSION['last_name']=$row['last_name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['date_of_birth']=$row['date_of_birth'];
        $_SESSION['profile_picture_url']=$row['profile_picture_url'];
        unset($_SESSION['user_login_error']);
        header("Location:../feed.php");
    }
    else{
        $_SESSION['user_login_error']= "Wrong password.. Try again, please!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
    else{
        $_SESSION['user_login_error']= "Email not found.. Try again or create an account if you do not have one!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }





?>