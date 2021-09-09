<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Changed Successfully</title>
        <link rel="icon" type="image/png" href="assets/images/favi.png" sizes="32x32">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Lato:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="assets/fonts/linear-fonts.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.css">
        <link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
        <link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
        <link rel="stylesheet" href="assets/css/lightbox.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    </head>
    <body>
        <header id="home" class="welcome-area">
            <div class="header-top-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="logo">
                                <a href="#">
									<img src="YouNedia.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mainmenu">
                                <div class="navbar navbar-nobg">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav navbar-right">
 
                                            <li><a href="user-profile.php">Dashboard</a>
                                            </li>
                                            <li class="active"><a href="allvideocheckout.html">Order Now</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="logout.php">Sign Out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


			
        </header>



        <section id="about" class="section-padding">
            <div class="container">
			                 <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="header-text user-page">
<?php
    if (isset($_POST['submit_password']) && $_POST['email'] && $_POST['password'])
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];
    
        $conn = new mysqli('localhost', 'webdes57_prom', 'Prom99!!', 'webdes57_prom');
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='".$pass."' where username='".$email."'";
        $result = $conn->query($sql);
        echo "Password updated Successfully";
    }
?>

</div>
</div>
</div>
</div>
</section>


      <footer class="footer-area wow fadeInUp" data-wow-delay="1s">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="footer-social-link text-center">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                        <span class="title-divider">
                        <i class="fa fa-diamond" aria-hidden="true"></i>
                        </span>
                        <div class="footer-text">
                            <h6>All Rights Reserved.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="scroll-to-up">
            <div class="scrollup">
                <span class="lnr lnr-chevron-up"></span>
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
        <script type="text/javascript">
            $('.player').mb_YTPlayer();
        </script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/lightbox.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>