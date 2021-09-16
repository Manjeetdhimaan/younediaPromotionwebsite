<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: allvideocheckout.html");
    exit;
}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $sql = "SELECT account_status FROM users WHERE username='" . $username . "'";
                            $result = mysqli_query($link, $sql);
                            if (mysqli_num_rows($result) === 1) {
                                $row = mysqli_fetch_array($result);
                                if ($row["account_status"] === "active") {
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    header("location: allvideocheckout.html");
                                } else {
                                    $password_err = "The account is suspended.";
                                }
                            }
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Views, Likes, Subscribers</title>
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
      <!-- new theme -->
</head>

<body id="top">
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
            <li class="current"><a class="smoothscroll" href="#home" title="home">Home</a></li>
            <li><a class="smoothscroll" href="#about" title="about">Why Choose Us</a></li>
            <li><a class="smoothscroll" href="#services" title="services">Our Services</a></li>
            <li><a class="smoothscroll" href="#clients" title="clients">Clients</a></li>
            <li><a class="smoothscroll" href="#contact" title="contact">Contact</a></li>
        </ul>

        <!-- <p>Perspiciatis hic praesentium nesciunt. Et neque a dolorum <a href='#0'>voluptatem</a> porro iusto
            sequi veritatis libero enim. Iusto id suscipit veritatis neque reprehenderit.</p> -->

        <ul class="header-nav__social">
            <li>
                <a style="color: black;" target="_blank" href="http://facebook.com/younedia"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
                <a style="color: black;" target="_blank" href="https://twitter.com/younedia"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a style="color: black;" target="_blank" href="https://www.instagram.com/younedia/"><i class="fa fa-instagram"></i></a>
            </li>
            <li>
                <a style="color: black;" target="_blank" href="https://www.linkedin.com/company/younedia"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>

</nav> 

<a class="header-menu-toggle" href="#0">
    <!-- <span class="header-menu-text" style="color: #ffa800;">Menu</span> -->
    <span class="header-menu-icon"></span>
</a>

</header>
  
<section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/hero.jpg"
        data-natural-width=3000 data-natural-height=2000 data-position-y=center>

        <div class="overlay"></div>
        <div class="shadow-overlay"></div>
        <div class="home-content">
            <div class="row home-content__main">
                <h1 style="color: #FFBA00;">Welcome to YouNedia</h1>
                <div class="home-content__buttons">
                    <a href="#login" class="smoothscroll btn btn--stroke">
                        LOGIN NOW
                    </a>
                    <a href="#register" class="smoothscroll btn btn--stroke">
                        REGISTER
                    </a>
                </div>
            </div>
        </div>
        <!-- end home-content -->


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
        <!-- end home-social -->

    </section> <!-- end s-home -->

    <section id="" class="s-contact">
        <div class="row contact-content loginSection" id="login" data-aos="fade-up">
            <div class="contact-primary">
                <h3 class="h6" style="font-size: 40px;">Login</h3>
                <form id="signupform0" style="margin-top: 0px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <fieldset>
                        <div class="form-field">
                            <input type="email" id="advertiser_email_box0" placeholder="Enter your email here"
                                name="username" value="" required="" aria-required="true" class="full-width">
                        </div>
                        <div class="form-field">
                            <input id="advertiser_password_box0" placeholder="Enter your password here" type="password"
                                value="" required aria-required="true" class="full-width" required="">
                        </div>
                        <span class="help-block"><?php echo $password_err; ?></span>
                        <input type="text" name="value" value="high" hidden required>
                        <div class="form-field">
                            <input type="submit" class="full-width btn--primary" style="margin-top: 15px;vertical-align:top;" id="register_btn" value="Login Now">
                            <div class="register-with-us" style="text-align: center;" >
                                NOT HAVE ACCOUNT, REGISTER NOW</div>
                                <a class="smoothscroll  " href="#register" style="color: #fff;"><button  type="button" class="full-width btn--primary" style="margin-top: 15px;vertical-align:top;" id="register_btn" value="Register Now">Register Now</button></a>
                            <div class="register-with-us" style="text-align: center;"><a class="resendemail" form="0"
                                    href="reset_pass.html">FORGOT YOUR PASSWORD?</a></div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row contact-content loginSection" id="register" data-aos="fade-up">
            <div class="contact-primary">
                <h3 class="h6" style="font-size: 40px;">START PROMOTING YOUR VIDEO NOW</h3>
                <form id="register_form" class="" action="sign-up.php" method="POST">
                    <fieldset>
                        <div class="form-field">
                            <label for="input-name">Name*</label>

                            <input type="text" id="register_fullname" name="fullname" placeholder="Enter your Name"
                                required="" aria-required="true" class="full-width">
                        </div>
                        <div class="form-field">
                            <label for="input-phone">E-mail Address*</label>
                            <input type="email" id="register_e-mail" name="username" placeholder="Enter Email*"
                                required="" value="" required aria-required="true" class="full-width">
                        </div>
                        <div class="form-field">
                            <label for="input-phone">Password*</label>
                            <input type="password" id="register_password" name="password" placeholder="Create Password"
                                required="" value="" required aria-required="true" class="full-width">
                        </div>
                        <div class="form-field">
                            <label for="input-phone">Confirm Password*</label>
                            <input type="password" id="register_confirmpassword" name="confirm_password"
                                placeholder="Confirm Your Password" required="" value="" required aria-required="true"
                                class="full-width">
                        </div>
                        <div class="form-field">
                            <input type="submit" class="full-width btn--primary"
                                style="margin-top: 45px;vertical-align:top;" name="" value="Promote Video Now"
                                id="register_btn">
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>

    </section>
    <section id='about' class="s-about">
        <div class="row section-header has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead subhead--dark">Hello There</h3>
                <h1 class="display-1 display-1--light">We Are YouNedia</h1>
            </div>
        </div> <!-- end section-header -->
        <div class="row about-desc" data-aos="fade-up">
            <div class="col-full">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt.
                </p>
            </div>
        </div> <!-- end about-desc -->

        <div class="row about-stats stats block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">

            <div class="col-block stats__col ">
                <div class="stats__count" style="display: inline;">1200 </div><span class="stats__count__span" >+</span>
                <h5>Videos Promoted</h5>
            </div>
            <div class="col-block stats__col">
                <div class="stats__count" style="display: inline;">123000</div><span class="stats__count__span">+</span>
                <h5>Likes Given</h5>
            </div>
            <div class="col-block stats__col">
                <div class="stats__count" style="display: inline;">4500</div><span class="stats__count__span">+</span>
                <h5>Subscribers Given</h5>
            </div>
            <div class="col-block stats__col">
                <div class="stats__count" style="display: inline;">457000</div><span class="stats__count__span">+</span>
                <h5>Views Given</h5>
            </div>

        </div> <!-- end about-stats -->

        <div class="about__line"></div>

    </section>


    

    <section id='services' class="s-works">

<div class="intro-wrap">

    <div class="row section-header has-bottom-sep light-sep" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead">What We Offer</h3>
            <h1 class="display-2 display-2--light">We’ve everything you need to grow your business</h1>
        </div>
    </div> <!-- end section-header -->

</div> <!-- end intro-wrap -->

<div class="row works-content">
    <div class="col-full masonry-wrap">
        <div class="masonry">
            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">
                    <div class="item-folio__thumb">
                        <a href="images/SEO.jpg" class="thumb-link"
                            title="Shutterbug" data-size="1050x700">
                            <img src="images/SEO.jpg"
                                srcset="images/SEO.jpg, images/SEO.jpg"
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            SEO
                        </h3>
                        <p class="item-folio__cat">
                            Digital Marketing
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p>
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">
                    <div class="item-folio__thumb">
                        <a href="images/webDesining.jfif" class="thumb-link" title="Woodcraft"
                            data-size="1050x700">
                            <img src="images/webDesining.jfif"
                                srcset="images/webDesining.jfif 1x, images/webDesining.jfif 2x"
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Website
                        </h3>
                        <p class="item-folio__cat">
                            Web Developing
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p>
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="images/youtubeMarket.jpg" class="thumb-link"
                            title="The Beetle Car" data-size="1050x700">
                            <img src=""
                                srcset="images/youtubeMarket.jpg , images/youtubeMarket.jpg "
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Youtube Management
                        </h3>
                        <p class="item-folio__cat">
                            Youtube Marketing
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p>
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="images/socialMediaMarket.jpg" class="thumb-link"
                            title="Grow Green" data-size="1050x700">
                            <img src=""
                                srcset="images/socialMediaMarket.jpg 1x, images/socialMediaMarket.jpg 2x"
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Social Media Management
                        </h3>
                        <p class="item-folio__cat">
                            Social Media Marketing.
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p>
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="images/fb&instaa.png" class="thumb-link" title="Guitarist"
                            data-size="1050x700">
                            <img src="images/fb&instaa.png"
                                srcset="images/fb&instaa.png 1x, images/fb&instaa.png 2x"
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            Facebook and Insta Ads
                        </h3>
                        <p class="item-folio__cat">
                            Digital Marketing
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p>
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

            <div class="masonry__brick" data-aos="fade-up">
                <div class="item-folio">

                    <div class="item-folio__thumb">
                        <a href="images/linkedin.jpg" class="thumb-link" title="Palmeira"
                            data-size="1050x700">
                            <img src="images/linkedin.jpg"
                                srcset="images/linkedIn.jpg 1x, images/linkedIn.jpg 2x"
                                alt="">
                        </a>
                    </div>

                    <div class="item-folio__text">
                        <h3 class="item-folio__title">
                            LinkedIn Advertisement
                        </h3>
                        <p class="item-folio__cat">
                            Digital Marketing
                        </p>
                    </div>

                    <!-- <a href="https://www.behance.net/" class="item-folio__project-link" title="Project link">
                        <i class="icon-link"></i>
                    </a> -->

                    <div class="item-folio__caption">
                        <!-- <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde
                            dolorem corrupti neque nisi.</p> -->
                    </div>

                </div>
            </div> <!-- end masonry__brick -->

        </div> <!-- end masonry -->
    </div> <!-- end col-full -->
</div> <!-- end works-content -->

</section>


    </div>
    </div>


     <!-- clients
    ================================================== -->
    <section id="clients" class="s-clients">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead">Our Clients</h3>
                <h1 class="display-2">YouNedia has been honored to
                    partner up with these clients</h1>
            </div>
        </div> <!-- end section-header -->

        <div class="row clients-outer" data-aos="fade-up">
            <div class="col-full">
                <div class="clients">

                    <a href="#0" title="" class="clients__slide"><img src="images/clients/himanshi.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/Tania.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/Ammy-Virk.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/baaniSandhu.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/sonam-bajwa.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/InderChahal.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/Binnu-Dhillon.png" /></a>
                    <a href="#0" title="" class="clients__slide"><img src="images/clients/Nia-Sharma.png" /></a>

                </div> <!-- end clients -->
            </div> <!-- end col-full -->
        </div> <!-- end clients-outer -->

        <div class="row clients-testimonials" data-aos="fade-up">
            <div class="col-full">
                <div class="testimonials">

                    <div class="testimonials__slide">

                        <p>Qui ipsam temporibus quisquam vel. Maiores eos cumque distinctio nam accusantium ipsum.
                            Laudantium quia consequatur molestias delectus culpa facere hic dolores aperiam. Accusantium
                            quos qui praesentium corpori.
                            Excepturi nam cupiditate culpa doloremque deleniti repellat.</p>

                        <img src="images/avatars/user-01.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__info">
                            <span class="testimonials__name">Tim Cook</span>
                            <span class="testimonials__pos">CEO, Apple</span>
                        </div>

                    </div>

                    <div class="testimonials__slide">

                        <p>Excepturi nam cupiditate culpa doloremque deleniti repellat. Veniam quos repellat voluptas
                            animi adipisci.
                            Nisi eaque consequatur. Quasi voluptas eius distinctio. Atque eos maxime. Qui ipsam
                            temporibus quisquam vel.</p>

                        <img src="images/avatars/user-05.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__info">
                            <span class="testimonials__name">Sundar Pichai</span>
                            <span class="testimonials__pos">CEO, Google</span>
                        </div>

                    </div>

                    <div class="testimonials__slide">

                        <p>Repellat dignissimos libero. Qui sed at corrupti expedita voluptas odit. Nihil ea quia
                            nesciunt. Ducimus aut sed ipsam.
                            Autem eaque officia cum exercitationem sunt voluptatum accusamus. Quasi voluptas eius
                            distinctio.</p>

                        <img src="images/avatars/user-02.jpg" alt="Author image" class="testimonials__avatar">
                        <div class="testimonials__info">
                            <span class="testimonials__name">Satya Nadella</span>
                            <span class="testimonials__pos">CEO, Microsoft</span>
                        </div>

                    </div>

                </div><!-- end testimonials -->

            </div> <!-- end col-full -->
        </div> <!-- end client-testimonials -->

    </section> <!-- end s-clients -->





      <!-- contact
    ================================================== -->
    <section id="contact" class="s-contact">

        <div class="overlay"></div>
        <div class="contact__line"></div>

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead">Contact Us</h3>
                <h1 class="display-2 display-2--light">Reach out for a new project or just say hello</h1>
            </div>
        </div>

        <div class="row contact-content" data-aos="fade-up">

            <div class="contact-primary">

                <h3 class="h6">Send Us A Message</h3>
                <!-- assets/php/contact.php -->
                <form name="contactForm" id="contactForm" action="inc/sendEmail.php" method="post" novalidate="novalidate">
                    <fieldset>

                        <div class="form-field">
                            <input name="contactName" type="text" id="contactName" placeholder="Your Name" value=""
                                minlength="2" required="" aria-required="true" class="full-width">
                        </div>
                        
                        <div class="form-field">
                            <input name="contactEmail" type="email" id="contactEmail" placeholder="Your Email" value=""
                                required="" aria-required="true" class="full-width">
                        </div>
                        <div class="form-field">
                            <input name="contactSubject" type="text" id="contactSubject" placeholder="Subject" value=""
                                class="full-width">
                        </div>
                        <div class="form-field">
                            <textarea name="contactMessage" id="contactMessage" placeholder="Your Message" rows="10"
                                cols="50" required="" aria-required="true" class="full-width"></textarea>
                        </div>
                        <div class="form-field">
                            <input class="full-width btn--primary" type="submit">
                            <div class="submit-loader">
                                <div class="text-loader">Sending...</div>
                                <div class="s-loader">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>

                <!-- contact-warning -->
                <div class="message-warning">
                    Something went wrong. Please try again.
                </div>

                <!-- contact-success -->
                <div class="message-success">
                    Your message was sent, thank you!<br>
                </div>

            </div> <!-- end contact-primary -->

            <div class="contact-secondary">
                <div class="contact-info">

                    <h3 class="h6 hide-on-fullwidth">Contact Info</h3>

                    <div class="cinfo">
                        <h5>Where to Find Us</h5>
                        <p>
                            Cabin no.- 2, Basement, <br>
                             Plot no. - F-471, <br>
                             Phase -8b, Industrial Area <br>
                              Mohali
                        </p>
                    </div>

                    <div class="cinfo">
                        <h5>Email Us At</h5>
                        <p>
                            info@younedia.com<br>
                        </p>
                    </div>

                    <div class="cinfo">
                        <h5>Call Us At</h5>
                        <p>
                            Phone: (+63) 555 1212<br>
                            Mobile: (+63) 555 0100<br>
                        </p>
                    </div>

                    <ul class="contact-social">
                        <li>
                            <a target="_blank" href="http://facebook.com/younedia"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://twitter.com/younedia"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.instagram.com/younedia/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.linkedin.com/company/younedia"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                    </ul> <!-- end contact-social -->

                </div> <!-- end contact-info -->
            </div> <!-- end contact-secondary -->

        </div> <!-- end contact-content -->

    </section> <!-- end s-contact -->
    <footer>

<div class="row footer-main">

    <div class=" footer-desc">
         <!-- class="col-six tab-full left" -->
        <div class="footer-logo"></div>
        Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Praesent sapien
        massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh
        pulvinar a. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Quaerat voluptas
        autem necessitatibus vitae aut.

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
            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up"
                    aria-hidden="true"></i></a>
        </div>
    </div>

</div> <!-- end footer-bottom -->

</footer> <!-- end footer -->
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
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>






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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        const counters = document.querySelectorAll('.increment');
        const speed = 200; // The lower the slower

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;

                // Lower inc to slow and higher to slow
                const inc = target / speed;

                // console.log(inc);
                // console.log(count);

                // Check if target is reached
                if (count < target) {
                    // Add inc to count and output in counter
                    counter.innerText = count + inc;
                    // Call function every ms
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };

            updateCount();
        });
    </script>

<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>