<?php
session_start();
require_once("php/account_class.php");
require_once("php/db_inc.php");
$Account = new Account();

/* Account type check */
if (isset($_SESSION["type_error"]))
{
    $type_error = "Please select an account type";
} else
{
    $type_error = "";
}

/* Username check */
if (isset($_SESSION["username_error1"]))
{
    $username_error = "Username already exists.";
} else if (isset($_SESSION["username_error2"]))
{
    $username_error = "Please enter a username.";
} else if (isset($_SESSION["username_error3"]))
{
    $username_error = "Invalid username.";
} else
{
    $username_error = "";
}

/* Fullname check */
if (isset($_SESSION["fullname_error1"]))
{
    $fullname_error = "Please enter your full name.";
} else if (isset($_SESSION["fullname_error2"]))
{
    $fullname_error = "Invalid full name.";
} else
{
    $fullname_error = "";
}

/* Email check */
if (isset($_SESSION["email_error"]))
{
    $email_error = "Invalid email format.";
} else
{
    $email_error = "";
}

/* Email check */
if (isset($_SESSION["phone_error"]))
{
    $phone_error = "Invalid phone number format.";
} else
{
    $phone_error = "";
}

/* Password check */
if (isset($_SESSION["password_error1"]))
{
    $password_error = "Please enter a password.";
} else if (isset($_SESSION["password_error2"]))
{
    $password_error = "Invalid password.";
} else
{
    $password_error = "";
}

/* Second password check */
if (isset($_SESSION["password2_error1"]))
{
    $password2_error = "Please enter your password again.";
} else if (isset($_SESSION["password2_error2"]))
{
    $password2_error = "Password doesn't match.";
} else
{
    $password2_error = "";
}

session_unset();
$_SESSION['currentpage'] = "register.php";
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

<!-- Register -->
    <div>
        <main class="login-body"> <!-- data-vide-bg="assets/img/login-bg.mp4"-->
            <!-- Login Admin -->
            <form class="form-default" action="php/registering.php" method="POST">

                <div class="login-form">
                    <!-- logo-login -->
                    <div class="logo-login">
                        <a href="index.php"><img src="assets/img/logo/JobMatchLogo.png" alt=""></a>
                    </div>
                    <h2>Register Here</h2>
                        <div class="form-input">
                            <p style="color: red;"><?php echo $type_error; ?></p>
                            <label for="name">Account type</label><br>
                            <label for="name">Applicant<input type="radio" name="type" value="applicants"></label><br>
                            <label for="name">Employer<input type="radio" name="type" value="employers"></label><br>
                        </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $username_error; ?></p>
                        <label for="name">Username<span style="color: red;"> *</span></label>
                        <p style="color: lightgrey;">(8 to 32 characters, numbers and letters allowed)</p>
                        <input  type="text" name="username" placeholder="Username">
                    </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $fullname_error; ?></p>
                        <label for="name">Full name<span style="color: red;"> *</span></label>
                        <input  type="text" name="fullname" placeholder="Full name">
                    </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $email_error; ?></p>
                        <label for="name">Email Address</label>
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $phone_error; ?></p>
                        <label for="name">Phone number</label>
                        <p style="color: lightgrey;">(10 digits, including area code)</p>
                        <input  type="text" name="phone" placeholder="Phone number">
                    </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $password_error; ?></p>
                        <label for="name">Password<span style="color: red;"> *</span></label>
                        <p style="color: lightgrey;">(8 to 32 characters, numbers and letters allowed)</p>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-input">
                        <p style="color: red;"><?php echo $password2_error; ?></p>
                        <label for="name">Confirm Password<span style="color: red;"> *</span></label>
                        <input type="password" name="password2" placeholder="Password">
                    </div>
                    <div>
                        <p style="color: lightblue;">Fields marked with <span style="color: red;">*</span> are required.</p>
                    </div>
                    <div class="form-input pt-30">
                        <input type="submit" name="submit" value="Register Account">
                    </div>
                    <!-- Forget Password -->
                    <a href="login.php" class="registration">Login</a>
                </div>
            </form>
    <!-- /end login form -->
        </main>
    </div>

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Video bg -->
    <script src="./assets/js/jquery.vide.js"></script>

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