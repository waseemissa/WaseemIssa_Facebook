<?php
require 'connection.php';
session_start();


$valid = true;
$profile_picture_url = "profile_pic.png";

if(isset($_POST['first_name']) &&  isset($_POST['last_name']) && $_POST['first_name'] !="" && $_POST['last_name'] !=""){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    unset($_SESSION['first_name_error']);
    unset($_SESSION['last_name_error']);

    if(strlen($first_name) < 3){
        $_SESSION['first_name_error'] = "First name should be at least 3 characters";
        $valid = false;
    }
    if(strlen($last_name) < 3){
        $_SESSION['last_name_error'] = "Last name should be at least 3 characters";
        $valid = false;
    }
}

else{
    die();
}

if(isset($_POST['email']) && $_POST['email'] !=""){
    $email = $_POST['email'];
    unset($_SESSION['email_error']);

    if (strlen($email)<5 || !(filter_var($email, FILTER_VALIDATE_EMAIL))){
        $_SESSION['email_error'] = "Email should be like name@example.com";
        $valid = false;
    }
}

else{
    die();
}

if(isset($_POST['password']) && isset($_POST['confirm_password']) && $_POST['password'] != "" && $_POST['confirm_password'] !=""){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hashed_password = hash('sha256', $password);
    unset($_SESSION['password_error']);
    unset($_SESSION['confirm_password_error']);

    if($password != $confirm_password){
        $_SESSION['confirm_password_error'] = "Passwords should match";
        $valid = false;
    }
    if(strlen($password) <8){
        $_SESSION['password_error'] = "Password should be at least 8 characters";
        $valid = false;
    }
}
else{
    die();
}

if(isset($_POST['date_of_birth']) && $_POST['date_of_birth'] !=""){
    $date_of_birth = $_POST['date_of_birth'];
    unset($_SESSION['age_error']);

    $date2=date("d-m-Y");//today's date

    $date1=new DateTime($date_of_birth);
    $date2=new DateTime($date2);

    $final_date = $date1->format('Y-m-d');
    $interval = $date1->diff($date2);

    $age= $interval->y; 

  if ($age < 18){ 
      $_SESSION['age_error'] = "You should be 18 or older";
      $valid = false;
  }
}

else{
    die();
}



$query1 = "SELECT * FROM users WHERE email = ?";
$stmt1 = $connection->prepare($query1);
$stmt1->bind_param("s", $email);
$stmt1->execute();
$result = $stmt1->get_result();
$row1 = $result->fetch_assoc();

if(!empty($row1)){
    $_SESSION['error_email'] = "Email Already Exists!";
    $valid = false;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else{
    if($valid){
    $_SESSION['error_email'] = "";
    $query2 = "INSERT INTO users(first_name, last_name, profile_picture_url, date_of_birth, email, password) VALUES (?,?,?,?,?,?)";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("ssssss", $first_name, $last_name, $profile_picture_url, $final_date, $email, $hashed_password);
    $stmt2->execute();
    header("Location:../index.php");
    }
    else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}

?>



