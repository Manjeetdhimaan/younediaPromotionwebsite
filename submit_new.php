<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Changed Successfully</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>


        <!-- new theme -->

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
    <body id="top">
    <header class="s-header">
		<div class="header-logo" id="header-logo1">
			<a class="site-logo" href="index.php">
				<img src="YouNedia.png" alt="Homepage">
			</a>
		</div>
		<nav class="header-nav">
			<a href="#0" class="header-nav__close" title="close"><span>Close</span></a>
			<div class="header-nav__content">
				<h3 style="color:#FFBA00;">Navigation</h3>
				<ul class="header-nav__list">
					<li class="current"><a class="smoothscroll" href="user-profile.php" >Dashboard</a></li>
					<li><a class="smoothscroll" href="allvideocheckout.html" >Order Now</a></li>
					<li><a class="smoothscroll" href="logout.php" >Sign Out</a></li>
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


    <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/hero.jpg"
    data-natural-width=3000 data-natural-height=2000 data-position-y=center>

    <div class="overlay"></div>
    <div class="shadow-overlay"></div>
    <div class="home-content">
        <div class="row home-content__main">
            <div class="row contact-content loginSection" id="login" data-aos="fade-up">
                <div class="contact-primary">
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
                </div>
            </div>
        </div>
    </div>
    <ul class="home-social">
        <li>
            <a target="_blank" href="http://facebook.com/younedia"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
        </li>
        <li>
            <a target="_blank" href="https://twitter.com/younedia"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
        </li>
        <li>
            <a target="_blank" href="https://www.instagram.com/younedia/"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
        </li>
        <li>
            <a target="_blank" href="https://www.linkedin.com/company/younedia"><i class="fa fa-linkedin" aria-hidden="true"></i><span>LinkedIn</span></a>
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
                        <span>?? Copyright YouNedia 2020</span>
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
          
        </footer>
       
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

        <!-- new theme scripts -->

        <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    </body>
</html>