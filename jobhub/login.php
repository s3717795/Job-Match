<?php

if (!(isset($_SESSION["no_username"])
    || isset($_SESSION["no_password"])
    || isset($_SESSION["incorrect_username_password"])
    || isset($_SESSION["session_error"])))
{
    session_start();
}

if (isset($_SESSION["user_id"]))
{
    header("Location: .");
}

$wrong_password = "";
if (isset($_SESSION["no_username"])
    || isset($_SESSION["no_password"])
    || isset($_SESSION["incorrect_username_password"])
    || isset($_SESSION["session_error"]))
    if ($_SESSION["no_username"] && $_SESSION["no_password"])
    {
        $wrong_password = "Please enter a username and password.";
    } else if ($_SESSION["no_username"] == true)
    {
        $wrong_password = "Please enter a username.";
    } else if ($_SESSION["no_password"] == true)
    {
        $wrong_password = "Please enter a password.";
    } else if ($_SESSION["incorrect_username_password"])
    {
        $wrong_password = "Your username or password is incorrect.";
    } else if ($_SESSION["session_error"])
    {
        $wrong_password = "Unknown session error has occurred, please try again.";
    }

$_SESSION["no_username"] = null;
$_SESSION["no_password"] = null;
$_SESSION["incorrect_username_password"] = null;
$_SESSION["session_error"] = null;

$_SESSION['current_page'] = "login.php";
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<main class="login-body"> <!--data-vide-bg="assets/img/login-bg.mp4"-->
    <!-- Login Admin -->
    <form class="form-default" action="php/logging_in.php" method="POST">
        
        <div class="login-form">
            <!-- logo-login -->
            <div class="logo-login">
                <a href="index.php"><img src="assets/img/logo/JobMatchLogo.png" alt=""></a>
            </div>
            <h2>Login Here</h2>
            <h1 style="color:red;"><?php echo $wrong_password; ?></h1>
            <div class="form-input">
                <label for="name">Username</label>
                <input  type="text" name="username" placeholder="Username">
            </div>
            <div class="form-input">
                <label for="name">Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-input pt-30">
                <input type="submit" name="submit" value="login">
            </div>
            
            <!-- Forget Password -->
            <a href="#" class="forget">Forget Password</a>
            <!-- Forget Password -->
            <a href="register.php" class="registration">Registration</a>
            <a href="php/admin/admin_login.php" class="registration">Admin Login</a>
        </div>
    </form>
    <!-- /end login form -->
</main>


    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <!--<script src="./assets/js/jquery.vide.js"></script>-->

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    
    </body>
</html>