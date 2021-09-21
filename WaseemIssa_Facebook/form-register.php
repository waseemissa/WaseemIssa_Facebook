<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.foxthemes.net/instellohtml/form-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 07:08:38 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link href="assets/images/favicon.png" rel="icon" type="image/png">
    
    <!-- Basic Page Needs
    ================================================== -->
    <title>Instello</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Instello - Sharing Photos platform HTML Template">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="assets/css/icons.css">

    <!-- CSS 
    ================================================== -->
    <link rel="stylesheet" href="assets/css/uikit.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/tailwind.css">

</head>

<body class="bg-gray-100">


    <div id="wrapper" class="flex flex-col justify-between h-screen">

        <!-- header-->
        <div class="bg-white py-4 shadow dark:bg-gray-800">
            <div class="max-w-6xl mx-auto">


                <div class="flex items-center lg:justify-between justify-around">

                    <a href="">
                        <img src="assets/images/logo.png" alt="" class="w-32">
                    </a>

                    <div class="capitalize flex font-semibold hidden lg:block my-2 space-x-3 text-center text-sm">
                        <a href="index.php" class="py-3 px-4">Login</a>
                        <a href="" class="bg-pink-500 pink-500 px-6 py-3 rounded-md shadow text-white">Register</a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Content-->

        <div>
            <div class="lg:p-12 max-w-md max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
                <h1 class="lg:text-3xl text-xl font-semibold mb-6"> Sign Up</h1>
                <p class="mb-2 text-black text-lg"> Register to connect with people!</p>
                <form action="php/signup.php" method="POST">
                    <div class="flex lg:flex-row flex-col lg:space-x-2">
                        <input type="text" name = "first_name" placeholder="First Name"  class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                        <input type="text" name = "last_name" placeholder="Last Name" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                    </div>
                    <input type="text" name = "date_of_birth" placeholder="Date of Birth" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                    <input type="email" name = "email" placeholder="Email" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                    <input type="password" name = "password" placeholder="Password" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                    <input type="password" name = "confirm_password" placeholder="Confirm Password" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                    <div id="error" class="alert alert-light" role="alert">
                            <?php
                            if(isset($_SESSION['first_name_error']))
                            echo nl2br($_SESSION['first_name_error']."\n");
                            if(isset($_SESSION['last_name_error']))
                            echo nl2br($_SESSION['last_name_error']."\n");
                            if(isset($_SESSION['email_error']))
                            echo nl2br($_SESSION['email_error']."\n");
                            if(isset($_SESSION['password_error']))
                            echo nl2br($_SESSION['password_error']."\n");
                            if(isset($_SESSION['confirm_password_error']))
                            echo nl2br($_SESSION['confirm_password_error']."\n");
                            if(isset($_SESSION['phone_error']))
                            echo nl2br($_SESSION['phone_error']."\n");
                            if(isset($_SESSION['age_error']))
                            echo nl2br($_SESSION['age_error']."\n");
                            if(isset($_SESSION['error_email']))
                            echo nl2br($_SESSION['error_email']."\n");
                            ?>
                    </div>
                    <button type="submit" class="bg-gradient-to-br from-pink-500 py-3 rounded-md text-white text-xl to-red-400 w-full">Sign Up</button>
                    <div class="text-center mt-5 space-x-2">
                        <p class="text-base"> Do you have an account? <a href="index.php"> Login </a></p>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer -->

        <div class="lg:mb-5 py-3 uk-link-reset">
            <div class="flex flex-col items-center justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                <p class="capitalize">Instello By Waseem Issa</p>
            </div>
        </div>

    </div>

    <!-- Scripts
    ================================================== -->
    <script src="assets/js/tippy.all.min.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/uikit.js"></script>
    <script src="assets/js/simplebar.js"></script>
    <script src="assets/js/custom.js"></script>


    <script src="../../unpkg.com/ionicons%405.2.3/dist/ionicons.js"></script>
</body>


<!-- Mirrored from demo.foxthemes.net/instellohtml/form-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Sep 2021 07:08:38 GMT -->
</html>