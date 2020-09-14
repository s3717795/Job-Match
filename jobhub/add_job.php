<?php
session_start();
require_once("php/account_class.php");
require_once("php/db_inc.php");
$sessionid = $_SESSION["user_id"];
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job board | Template</title>
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
<!-- ? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/loder.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="categori.html">Categories</a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="about.html">about</a></li>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog_details.html">Blog Details</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                </ul>
                                            </li>
                                            <li><?php
                                                $login_text = "Log in";
                                                $modified_link = "<a href='login.php'>";

                                                if (isset($_SESSION["user_id"]))
                                                {
                                                    $login_text = "Profile";
                                                    $modified_link = "<a href='profile.php'>";
                                                }
                                                ?><?php echo $modified_link.$login_text; ?></a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-right-btn d-none d-lg-block ml-65">
                                    <a href="contact.html" class="border-btn">Post a Job</a>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>
    <!-- Hero Area Start-->
    <div class="slider-area2">
        <div class="single-slider slider-height3 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-9">
                        <!-- Hero Caption -->
                        <div class="hero__caption hero__caption2">
                            <h1>Adding a Job</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Hero Area End-->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <div class="top-jobs mb-50">
                        <!-- Single -->
                        <div class="single-top-jobs">
                            <div class="services-cap">
                                <form id="addjobform" name="addjobform" method="post" action="php/adding_job.php">
                                    <p>Job Name<span style="color: red;"> *</span></p>
                                    <div style="text-align:center;"><input style="margin: auto; width: 550px" type="text" id="jobname" name="jobname" placeholder="Job name"></div><br><br>
                                    <p>Job Location<span style="color: red;"> *</span></p>
                                    <div style="text-align:center;"><input style="margin: auto; width: 550px" type="text" id="joblocation" name="joblocation" placeholder="Job location"></div><br><br>
                                    <p>Job Nature<span style="color: red;"> *</span></p>
                                    <div style="text-align:center;">
                                        <select name="jobnature" id="jobnature" form="addjobform">
                                            <option value="Full time">Full time</option>
                                            <option value="Part time">Part time</option>
                                            <option value="Casual">Casual</option>
                                        </select>
                                    </div><br><br><br>
                                    <p>Job Salary</p>
                                    <div style="text-align:center;"><input style="margin: auto; width: 550px" type="text" id="jobsalary" name="jobsalary" placeholder="Job salary"></div><br><br>
                                    <p>Job Application Date</p>
                                    <div><input style="margin: auto;" type="date" id="jobposted" name="jobposted"></div><br><br>
                                    <p>Short Job Description<span style="color: red;"> *</span></p>
                                    <div style="text-align:center;"><textarea id="jobshortdesc" name="jobshortdesc" rows="5" cols="60" form="addjobform" placeholder="Short job description"></textarea></div><br><br>
                                    <p>Job Description</p>
                                    <div style="text-align:center;"><textarea id="jobdesc" name="jobdesc" rows="10" cols="60" form="addjobform" placeholder="Job description"></textarea></div><br><br>
                                    <p>Job Skills</p>
                                    <div style="text-align:center;">
                                        <input style="margin: auto; width: 550px;" type="text" id="jobskills" name="jobskills" placeholder="Job skill"><br><br id="break1">
                                        <input type="button" id="addTextBox" value="Add Skill" onClick="incrementCount()">
                                        <!-- <input type="button" id="removeTextBox" value="Remove Skill" onClick="decCount()"> -->
                                        <script language="javascript" type="text/javascript">
                                            var count1 = 0;
                                            function incrementCount() {
                                                //document.addjobform.count.value = parseInt(document.frm.count.value) + 1;
                                                count1++;
                                                addTextBox();
                                            }

                                            // function decCount() {
                                            //     //document.addjobform.count.value = parseInt(document.frm.count.value) - 1;
                                            //     if(count1>=1)
                                            //         count1--;
                                            //     removeTextBox();
                                            // }

                                            function addTextBox() {
                                                var form = document.addjobform;
                                                // form.appendChild(document.createElement('div')).innerHTML
                                                //     = "<div style=\"text-align:center;\">" +
                                                //         "<input style=\"margin: auto; width: 550px;\" " +
                                                //         "type=\"text\" " +
                                                //         "name=\"jobskills\" " +
                                                //         "placeholder=\"Job skill\">" +
                                                //     "</div><br><br>";
                                                form.appendChild($("#break1").after("<div style=\"text-align:center;\">" +
                                                    "<input style=\"margin: auto; width: 550px;\"" +
                                                    "type=\"text\"" +
                                                    "name=\"jobskills\"" +
                                                    "placeholder=\"Job skill\"><br><br>"));
                                            }

                                            // function removeTextBox() {
                                            //     var form = document.addjobform;
                                            //     //if (form.lastChild.nodeName.toLowerCase() == '$("#break1")')
                                            //     if(count1>=1)
                                            //         form.removeChild(form.lastChild);
                                            // }
                                        </script>
                                    </div><br><br>
                                    <p>Job Education</p>
                                    <div style="text-align:center;">
                                        <input style="margin: auto; width: 550px;" type="text" id="jobeducation" name="jobeducation" placeholder="Job education"><br><br id="break2">
                                        <input type="button" id="addTextBox" value="Add Skill" onClick="incrementCount2()">
<!--                                        <input type="button" id="removeTextBox" value="Remove Skill" onClick="decCount2()">-->
                                        <script language="javascript" type="text/javascript">
                                            var count2 = 0;
                                            function incrementCount2() {
                                                //document.addjobform.count.value = parseInt(document.frm.count.value) + 1;
                                                count2++;
                                                addTextBox2();
                                            }

                                            // function decCount2() {
                                            //     //document.addjobform.count.value = parseInt(document.frm.count.value) - 1;
                                            //     if(count2>=1)
                                            //         count2--;
                                            //     removeTextBox2();
                                            // }

                                            function addTextBox2() {
                                                var form = document.addjobform;
                                                // form.appendChild(document.createElement('div')).innerHTML
                                                //     = "<div style=\"text-align:center;\">" +
                                                //         "<input style=\"margin: auto; width: 550px;\" " +
                                                //         "type=\"text\" " +
                                                //         "name=\"jobskills\" " +
                                                //         "placeholder=\"Job skill\">" +
                                                //     "</div><br><br>";
                                                form.appendChild($("#break2").after("<div style=\"text-align:center;\">" +
                                                    "<input style=\"margin: auto; width: 550px;\"" +
                                                    "type=\"text\"" +
                                                    "name=\"jobeducation\"" +
                                                    "placeholder=\"Job education\"><br><br>"));
                                            }

                                            // function removeTextBox2() {
                                            //     var form = document.addjobform;
                                            //     if (form.lastChild.nodeName.toLowerCase() == 'div2')
                                            //         form.removeChild(form.lastChild);
                                            // }
                                        </script>
                                    </div><br><br>
                                    <p style="color: lightblue;">Fields marked with <span style="color: red;">*</span> are required.</p>
                                    <input type="hidden" id="sessionid" name="sessionid" value=<?php echo $_SESSION["user_id"]; ?>>
                                    <input type="submit" name="submit" id="submitbutton" value="Add job"b>
                                    <script language="javascript" type="text/javascript">
                                        document.getElementById('submitbutton').addEventListener('click', validateForm);

                                        function validateForm()
                                        {
                                            var jobname = document.forms["addjobform"]["jobname"].value;
                                            var joblocation = document.forms["addjobform"]["joblocation"].value;
                                            var jobnature = document.forms["addjobform"]["natures"].value;
                                            var jobshortdesc = document.forms["addjobform"]["shortjobdesc"].value;

                                            //alert("Success!");

                                            if(isEmptyOrSpaces(jobname)
                                                || isEmptyOrSpaces(joblocation)
                                                || isEmptyOrSpaces(jobnature)
                                                || isEmptyOrSpaces(jobshortdesc))
                                            {
                                                alert("Please fill out all required fields.");
                                            }
                                        }
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
</main>
<footer>
    <div class="footer-wrappper pl-100 pr-100 section-bg" data-background="assets/img/gallery/footer-bg.png">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-5 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>The automated process starts as  soon as your clothes go into the machine.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Top categories</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>For employer</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Company</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle mb-50">
                                <h4>Subscribe newsletter</h4>
                                <p>Subscribe newsletter to get updates.</p>
                            </div>
                            <!-- Form -->
                            <div class="footer-form" >
                                <div id="mc_embed_signup">
                                    <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                          method="get" class="subscribe_form relative mail_part">
                                        <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                               class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                               onblur="this.placeholder = ' Email Address '">
                                        <div class="form-icon">
                                            <button type="submit" name="submit" id="newsletter-submit"
                                                    class="email_icon newsletter-submit button-contactForm"><img src="assets/img/gallery/form.png" alt=""></button>
                                        </div>
                                        <div class="mt-10 info"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </div>
</footer>

<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->

<script src="./JS/tools.js"></script>

<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

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