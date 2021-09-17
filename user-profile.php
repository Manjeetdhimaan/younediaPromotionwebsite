<?php
session_start();
if (isset($_SESSION["loggedin"]) === false || $_SESSION["loggedin"] === false) {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard - YouNedia</title>
    <link rel="icon" type="image/png" href="assets/images/favi.png" sizes="32x32">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/linear-fonts.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- new theme -->

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favi.png" type="image/x-icon">
    <link rel="icon" href="favi.png" type="image/x-icon">
</head>

<style>
    input[type="radio"] { display: none; }
input + label { display: inline-block }

input ~ .tab { display: none }
#tab1:checked ~ .tab.content1,
#tab2:checked ~ .tab.content2,
#tab3:checked ~ .tab.content3,
#tab4:checked ~ .tab.content4,
#tab5:checked ~ .tab.content5 { display: block; }

input + label {
  border: 1px solid #999;
  background: #EEE;
  padding: 4px 12px;
  border-radius: 4px 4px 0 0;
  position: relative;
  top: 1px;
}
input:checked + label {
  background: #FFF;
  border-bottom: 1px solid transparent;
}
input ~ .tab {
  border-top: 1px solid #999;
  padding: 12px;
}
</style>

<body id="top">
   
    <!-- header
    ================================================== -->
    <header class="s-header">
        <div class="header-logo">
            <a class="site-logo" href="index.php">
                <img src="YouNedia.png" alt="Homepage">
            </a>
        </div>
        <nav class="header-nav">
            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>
            <div class="header-nav__content">
                <h3 style="color:#FFBA00;">Navigation</h3>
                <ul class="header-nav__list">
                    <li class="current"><a class="smoothscroll" href="user-profile.php" title="home">Dashboard</a></li>
                    <li><a class="smoothscroll" href="allvideocheckout.html" title="about">Order Now</a></li>
                    <li><a class="smoothscroll" href="logout.php" title="services">Sign Out</a></li>
                </ul>
                <ul class="header-nav__social">
                    <li>
                        <a style="color: black;" target="_blank" href="http://facebook.com/younedia"><i
                                class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a style="color: black;" target="_blank" href="https://twitter.com/younedia"><i
                                class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a style="color: black;" target="_blank" href="https://www.instagram.com/younedia/"><i
                                class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a style="color: black;" target="_blank" href="https://www.linkedin.com/company/younedia"><i
                                class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-icon"></span>
        </a>

    </header>
    <!-- home
    ================================================== -->
    <section id="service" class="s-home target-section" data-parallax="scroll" data-image-src="images/hero.jpg"
        data-natural-width=3000 data-natural-height=2000 data-position-y=center>

        <div class="overlay" style="background-color: transparent;"></div>
        <div class="shadow-overlay"></div>
        <div class="home-content">
            <div class=" home-content__main homeAllVideoCheckOut">
                <div style="background-color: rgba(255, 255, 255, 0.904);" class="row contact-content loginSection"
                    id="login" data-aos="fade-up">
                    <div class="contact-primary">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="header-text user-page">
                                        <h2>User Dashboard!</h2>
                                        <span class="title-divider">
                                            <i class="fa fa-diamond" aria-hidden="true"></i>
                                        </span>
                                        <p style="color: #000;">Change your password or view your order history here.</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="vertical-tab" role="tabpanel">
                                        <input type="radio" name="tabs" id="tab1" checked />
                                                    <label class="dashboardLabel" for="tab1">Change Password</label>
                                        <input type="radio" name="tabs" id="tab2"  />
                                                    <label class="dashboardLabel" for="tab2">View Order History</label>
                                        <input type="radio" name="tabs" id="tab3"  />
                                                    <label class="dashboardLabel" for="tab3">Log Out</label>
                                        <!-- <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#Section1"
                                                    aria-controls="home" role="tab" data-toggle="tab">Change Password
                                                </a></li>
                                            <li role="presentation"><a href="#Section2" aria-controls="profile"
                                                    role="tab" data-toggle="tab">View Order History</a></li>
                                            <li role="presentation"><a href="#Section3" aria-controls="messages"
                                                    role="tab" data-toggle="tab">Log Out</a></li>
                                                    
                                        </ul> -->

                                        <div class="tab content1 tabs">
                                            <div role="tabpanel" class="tab content1 tab-pane fade  " id="Section1">
                                                <h4>Update your password now</h4>
                                                <form method="post" action="submit_new.php">
                                                    <input type="hidden" name="email" value="<?php echo $_SESSION["
                                                        username"]; ?>">
                                                    <div class="form-field">
                                                        <input style="color: black;" type="password" class="full-width"
                                                            placeholder="Enter your new Password" id="password" required>
                                                    </div>
                                                    <div class="form-field" >
                                                        <input style="color: black;" required type="password" class="full-width"
                                                            placeholder="Confirm Password" name="password"
                                                            oninput="check(this);">
                                                    </div>
                                                    <input type="submit" name="submit_password">
                                                </form>
                                                <script language='javascript' type='text/javascript'>
                                                    function check(input) {
                                                        if (input.value != document.getElementById('password').value) {
                                                            input.setCustomValidity('Password Must be Matching.');
                                                        } else {
                                                            // input is valid -- reset the error message
                                                            input.setCustomValidity('');
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            </div>
                                        <div class="tab content2 tabs">

                                            <div role="tabpanel" class="tab content2 tab-pane fade" id="Section2">
                                                <h3 style="color: #000;">Order History</h3>
                                                <div class="responsive-table">
                                                    <table class="table lms_table_active">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Sr No.</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Order Details</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                    require_once "dbcontroller.php";
                                                    $db_handle = new DBController();
                                                    $query = "SELECT * FROM users WHERE username='" . $_SESSION["username"] . "'";
                                                    $row = $db_handle->runQuery($query);
                                                    $i = 1;
                                                    foreach ($row as $item) {
                                                        $str = $item['order_details'];
                                                        while (preg_match('/\n/', $str)) {
                                                            $str = preg_replace('/\n/', '<br>', $str, 1);
                                                        }
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <p>
                                                                        <?php
                                                                    echo $i;
                                                                    $i += 1;
                                                                    ?>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p class="pending-order">
                                                                        <?php
                                                                    $tempStr = $item['order_status'];
                                                                    $tempStr2 = str_replace("uncomplete", "Pending", $tempStr);
                                                                    $tempStr2 = str_replace("complete", "Completed", $tempStr2);
                                                                    echo $tempStr2;
                                                                    ?>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p class="nowrap">
                                                                        <?php
                                                                    echo $str;
                                                                    ?>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                    }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                            </div>
                                        <div class="tab content3 tabs">

                                            <div role="tabpanel" class="tab content3 tab-pane fade" id="Section3">
                                                <h4>Are you Sure you want to log out? </h4>
                                                <a href="logout.php" class="confirm-logout">Confirm Log Out</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <ul class="home-social">
            <li>
                <a target="_blank" href="http://facebook.com/younedia"><i class="fa fa-facebook"
                        aria-hidden="true"></i><span>Facebook</span></a>
            </li>
            <li>
                <a target="_blank" href="https://twitter.com/younedia"><i class="fa fa-twitter"
                        aria-hidden="true"></i><span>Twiiter</span></a>
            </li>
            <li>
                <a target="_blank" href="https://www.instagram.com/younedia/"><i class="fa fa-instagram"
                        aria-hidden="true"></i><span>Instagram</span></a>
            </li>
            <li>
                <a target="_blank" href="https://www.linkedin.com/company/younedia"><i class="fa fa-linkedin"
                        aria-hidden="true"></i><span>LinkedIn</span></a>
            </li>
        </ul>
    </section>


    <!-- footer
    ================================================== -->
    <footer>
        <div class="row footer-main">
            <div class=" footer-desc">
                <!-- class="col-six tab-full left" -->
                <!-- <div class="footer-logo"></div> -->
                <h1>YOUNEDIA | Digital Marketing Agency</h1>
                YouNedia Marketing Agency is a premier, full-service digital marketing, 
                web design, and consulting agency that generates explosive growth and revenue 
                in businesses through creative strategy and optimization.
            </div>
            <div style="text-align: center;margin-top: 4rem;">
                <ul class="header-nav__social">
                    <li>
                        <a target="_blank" href="http://facebook.com/younedia"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="https://twitter.com/younedia"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.instagram.com/younedia/"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.linkedin.com/company/younedia"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>

                </ul>
            </div>
            <!-- end footer-main -->

            <div class="row footer-bottom">

                <div class="col-twelve">
                    <div class="copyright">
                        <span>© Copyright YouNedia 2020</span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up" aria-hidden="true"></i></a>
                    </div>
                </div>

            </div> <!-- end footer-bottom -->
        </div>
    </footer>  <!-- end footer -->


    <!-- photoswipe background
    ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                        title="Close (Esc)"></button> <button class="pswp__button pswp__button--share"
                        title="Share"></button> <button class="pswp__button pswp__button--fs"
                        title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom"
                        title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->

  


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale-pulse-out">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.mixitup.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.stellar.min.js"></script>
    <script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- new theme scripts -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>