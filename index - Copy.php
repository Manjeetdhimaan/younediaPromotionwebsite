<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: allvideocheckout.html");
      exit;
    }
    require_once "config.php";
    $username = $password = "";
    $username_err = $password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                $sql="SELECT account_status FROM users WHERE username='".$username."'";
                                $result=mysqli_query($link, $sql);
                                if(mysqli_num_rows($result) === 1){
                                    $row = mysqli_fetch_array($result);
                                    if($row["account_status"]==="active"){
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;
                                        header("location: allvideocheckout.html");
                                    }else{
                                        $password_err = "The account is suspended.";
                                    }
                                }
                            } else{
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        $username_err = "No account found with that username.";
                    }
                } else{
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
                                            <li class="active">
                                                <a class="smoth-scroll" href="#home">
                                                    Home 
                                                    <div class="ripple-wrapper"></div>
                                                </a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#about">About</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#service">service</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#team">team</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#portfolio">Portfolio</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#pricing">Pricing</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#blog">blog</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#contact">contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="welcome-image-area" data-stellar-background-ratio="0.6">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="header-text">
                         <div style="color:#fff;">LOGIN FORM</div>
                        <form id="signupform0" style="margin-top: 0px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="email" id="advertiser_email_box0" placeholder="Enter your email here" name="username" required>
                            <span class="help-block"><?php echo $username_err; ?></span>
                            <input type="password" id="advertiser_password_box0" placeholder="Enter your password here" name="password" required>
                            <span class="help-block"><?php echo $password_err; ?></span>
                            <input type="text" name="value" value="high" hidden required> 
                            <div class="submit-buttons-home">
                                <input type="submit" class="start_camp" style="margin-top: 15px;vertical-align:top;" value="Sign In Using E-mail Address">
                            </div>
                            <div class="register-with-us"> Don't have an account?  Please <a href="sign-up.php">Register</a> | <a class="resendemail" form="0" href="reset_pass.html">FORGOT YOUR PASSWORD?</a></div>
                        </form>
 


								   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="about" class="about-us-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>About us</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-text wow fadeInUp" data-wow-delay=".2s">
						  <h2 class="text-center">Welcome to SEO Friendly</h2>
                            <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        


						  <div class="col-md-6">
                                <div class="our-skill">
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Keyword Research
                                            <span>92%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="95" style="transition: width 3s ease 0s; width: 95%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Onpage Optimization
                                            <span>98%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="95" style="transition: width 3s ease 0s; width: 95%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Offpage Optimization
                                            <span>90%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="90" style="transition: width 3s ease 0s; width: 90%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Competition Analysis
                                            <span>70%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="90" style="transition: width 3s ease 0s; width: 90%;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="our-skill">
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Digital marketing
                                            <span>87%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="87" style="transition: width 3s ease 0s; width: 87%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Social Media Marketing
                                            <span>81%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="81" style="transition: width 3s ease 0s; width: 81%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Search Engine Marketing
                                            <span>85%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="85" style="transition: width 3s ease 0s; width: 85%;"></span>
                                        </div>
                                    </div>
                                    <div class="progress-bar-linear">
                                        <p class="progress-bar-text">Search Engine Optimization
                                            <span>82%</span>
                                        </p>
                                        <div class="progress-bar">
                                            <span data-percent="82" style="transition: width 3s ease 0s; width: 82%;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="" class="read-more">Download Price List</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-thumbs-o-up"></span>
                            <h2 class="counter-num">1200</h2>
                            <h6 class="text-muted">project completed</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-smile-o"></span>
                            <h2 class="counter-num">1000</h2>
                            <h6 class="text-muted">Happy Clients</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-signal"></span>
                            <h2 class="counter-num">56090</h2>
                            <h6 class="text-muted">Rank Position</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-trophy"></span>
                            <h2 class="counter-num">31</h2>
                            <h6 class="text-muted">Awards Won</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="sign-up-home" class="service-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                        <div style="color:#fff;">LOGIN FORM</div>
                        <form id="signupform0" style="margin-top: 0px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="email" id="advertiser_email_box0" placeholder="Enter your email here" name="username" required>
                            <span class="help-block"><?php echo $username_err; ?></span>
                            <input type="password" id="advertiser_password_box0" placeholder="Enter your password here" name="password" required>
                            <span class="help-block"><?php echo $password_err; ?></span>
                            <input type="text" name="value" value="high" hidden required> 
                            <div class="submit-buttons-home">
                                <input type="submit" class="start_camp" style="margin-top: 15px;vertical-align:top;" value="Sign In Using E-mail Address">
                            </div>
                            <div class="register-with-us"> Don't have an account?  Please <a href="sign-up.php">Register</a> | <a class="resendemail" form="0" href="reset_pass.html">FORGOT YOUR PASSWORD?</a></div>
                        </form>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
            </div>
        </section>
        <section id="service" class="service-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>our services</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-service text-center">
                            <span class="fa fa-search"></span>
                            <h4>Keyword Research</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-service text-center">
                            <span class="fa fa-refresh"></span>
                            <h4>Website Analysis</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-service text-center">
                            <span class="fa fa-signal"></span>
                            <h4>Rank Positioning</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-service text-center">
                            <span class="fa fa-sliders"></span>
                            <h4>Competition Analysis</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1s">
                        <div class="single-service text-center">
                            <span class="fa fa-eye"></span>
                            <h4>Onpage SEO</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1.2s">
                        <div class="single-service text-center">
                            <span class="fa fa-eye-slash"></span>
                            <h4>Offpage SEO</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="team" class="team-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>our expert team</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-team">
                            <img src="assets/images/team/team1.jpg" alt="">
                            <div class="team-description text-center">
                                <h4>David Warner</h4>
                                <h6 class="text-muted">CEO/Founder</h6>
                                <div class="team-social">
                                    <ul>
                                        <li><a href=""><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-team">
                            <img src="assets/images/team/team2.jpg" alt="">
                            <div class="team-description text-center">
                                <h4>William Jackson</h4>
                                <h6 class="text-muted">SEO Expert</h6>
                                <div class="team-social">
                                    <ul>
                                        <li><a href=""><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-team">
                            <img src="assets/images/team/team3.jpg" alt="">
                            <div class="team-description text-center">
                                <h4>Steve Anderson</h4>
                                <h6 class="text-muted">SMM Expert</h6>
                                <div class="team-social">
                                    <ul>
                                        <li><a href=""><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-dribbble"></i></a>
                                        </li>
                                        <li><a href=""><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="call-to-action-area" data-stellar-background-ratio="0.6">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Do you want to purchase our template?</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        <a href="#" class="read-more white-read-more">Purchase now</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="why-chhose-us-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 why-choose-us-title">
                        <div class="section-title">
                            <h2>why choose us?</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="why-image">
                            <img src="assets/images/why.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-sun"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Innovative idea</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-crop"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Customize Pricing</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-pencil"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Unique Content</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-pie-chart"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Easy to use</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-text-align-justify"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Free demo</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="content-grid clearfix">
                                    <div class="icon-holder">
                                        <div class="chid-pernt">
                                            <div class="child">
                                                <div class="about-icon"><span class="lnr lnr-clock"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h3>Timely Updates</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="portfolio" class="work section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>our portfolio</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="work">
                        <li class="filter" data-filter="all">all</li>
                        <li class="filter" data-filter=".seo">SEO</li>
                        <li class="filter" data-filter=".socialmedia">Social Media</li>
                        <li class="filter" data-filter=".digitalmarketing">Digital Marketing</li>
                    </ul>
                </div>
                <div class="work-inner">
                    <div class="row work-posts">
                        <div class="col-md-4 col-sm-6 mix seo">
                            <div class="item">
                                <img src="assets/images/portfolio/project1.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project1.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mix socialmedia">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s">
                                <img src="assets/images/portfolio/project2.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project2.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mix web">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s">
                                <img src="assets/images/portfolio/project3.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project3.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mix socialmedia digitalmarketing">
                            <div class="item wow fadeInUp" data-wow-delay="0.8s">
                                <img src="assets/images/portfolio/project4.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project4.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mix typography web">
                            <div class="item wow fadeInUp" data-wow-delay="1s">
                                <img src="assets/images/portfolio/project5.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project5.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mix seo socialmedia digitalmarketing">
                            <div class="item wow fadeInUp" data-wow-delay="1.2s">
                                <img src="assets/images/portfolio/project6.jpg" alt="About te image">
                                <div class="tooltip">
                                    <div class="align">
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <a href="assets/images/portfolio/project6.jpg" class="work-popup"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="testimonial" class="testimonial-area section-padding" data-stellar-background-ratio="0.6">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title white-title">
                            <h2>our clients</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="testimonial-list wow fadeInUp">
                        <div class="single-testimonial text-center">
                            <img src="assets/images/testimonial/1.jpg" class="img-circle" alt="">
                            <h6 class="text-muted">Sara Jackson</h6>
                            <h6>CEO, Gooole Inc.</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <div class="buyer-rating">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="assets/images/testimonial/2.jpg" class="img-circle" alt="">
                            <h6 class="text-muted">John Doe</h6>
                            <h6>CEO, Micoosoft Inc.</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <div class="buyer-rating">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="assets/images/testimonial/3.jpg" class="img-circle" alt="">
                            <h6 class="text-muted">David Herry</h6>
                            <h6>CEO, Facebooo Inc.</h6>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <div class="buyer-rating">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="pricing" class="pricing-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>our pricing</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="pricing-table text-center wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                            <h3 class="price-title">Basic</h3>
                            <div class="price">
                                <p><span class="dollor">$</span>29<span class="month">/monthly</span></p>
                            </div>
                            <p>1 Keyword Rank</p>
                            <p>1 Copetitor Analysis</p>
                            <p>1 Social Media</p>
                            <p>1 Bookmarking</p>
                            <a href="#" class="read-more">BUY NOW</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="pricing-table active text-center wow fadeIn animated" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeIn;">
                            <h3 class="price-title">Standard</h3>
                            <div class="price">
                                <p><span class="dollor">$</span>49<span class="month">/monthly</span></p>
                            </div>
                            <p>2 Keyword Rank</p>
                            <p>5 Copetitor Analysis</p>
                            <p>2 Social Media</p>
                            <p>20 Bookmarking</p>
                            <a href="#" class="read-more active">BUY NOW</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="pricing-table text-center wow fadeIn animated" data-wow-delay="500ms" style="visibility: visible; animation-delay: 500ms; animation-name: fadeIn;">
                            <h3 class="price-title">Premium</h3>
                            <div class="price">
                                <p><span class="dollor">$</span>99<span class="month">/monthly</span></p>
                            </div>
                            <p>3 Keyword Rank</p>
                            <p>10 Copetitor Analysis</p>
                            <p>3 Social Media</p>
                            <p>30 Bookmarking</p>
                            <a href="#" class="read-more">BUY NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-news-letter" data-stellar-background-ratio="0.6">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>suscribe our news letter to get latest news</h2>
                        <input type="text" placeholder="Enter Your Email">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </section>
        <section id="blog" class="blog-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>our Latest News</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-blog">
                            <div class="meta-block-container">
                                <a title="Blog" href="single-blog.html">
                                <img alt="blog" src="assets/images/blog/blog1.jpg">
                                </a>
                                <div class="post-meta-block">
                                    <div class="post-user"><i class="fa fa-user-secret"></i> <a href="#" title="">Admin</a></div>
                                    <div class="post-date"><a href="#"><i class="fa fa-calendar"></i> 13 Feb 2017</a></div>
                                    <div class="post-comment"><a href="#"><i class="fa fa-comment"></i> 2</a></div>
                                </div>
                            </div>
                            <div class="blog-description text-center">
                                <a href="single-blog.html">
                                    <h3>this is an image post</h3>
                                </a>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                                <a href="single-blog.html" class="read-more">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-blog">
                            <div class="meta-block-container">
                                <a title="Blog" href="single-blog.html">
                                <img alt="blog" src="assets/images/blog/blog2.jpg">
                                </a>
                                <div class="post-meta-block">
                                    <div class="post-user"><i class="fa fa-user-secret"></i> <a href="#" title="">Admin</a></div>
                                    <div class="post-date"><a href="#"><i class="fa fa-calendar"></i> 13 Feb 2017</a></div>
                                    <div class="post-comment"><a href="#"><i class="fa fa-comment"></i> 2</a></div>
                                </div>
                            </div>
                            <div class="blog-description text-center">
                                <a href="single-blog.html">
                                    <h3>this is an image post</h3>
                                </a>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                                <a href="single-blog.html" class="read-more">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-blog">
                            <div class="meta-block-container">
                                <a title="Blog" href="single-blog.html">
                                <img alt="blog" src="assets/images/blog/blog3.jpg">
                                </a>
                                <div class="post-meta-block">
                                    <div class="post-user"><i class="fa fa-user-secret"></i> <a href="#" title="">Admin</a></div>
                                    <div class="post-date"><a href="#"><i class="fa fa-calendar"></i> 13 Feb 2017</a></div>
                                    <div class="post-comment"><a href="#"><i class="fa fa-comment"></i> 2</a></div>
                                </div>
                            </div>
                            <div class="blog-description text-center">
                                <a href="single-blog.html">
                                    <h3>this is an image post</h3>
                                </a>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                                <a href="single-blog.html" class="read-more">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="contact-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>contact us</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row contact-form-design-area wow fadeInUp">
                    <div class="col-md-8">
                        <div class="contact-form">
                            <div class="row">
                                <form action="assets/php/contact.php" method="post">
                                    <div class="form-group col-md-6">
                                        <p>Name</p>
                                        <input type="text" name="name" class="form-control" id="first-name" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <p>email</p>
                                        <input type="email" name="email" class="form-control" id="email" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <p>Subject</p>
                                        <input type="text" name="subject" class="form-control" id="subject" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <p>message</p>
                                        <textarea rows="6" name="message" class="form-control" id="description" required="required"></textarea>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button>Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-details-area wow fadeInUp" data-wow-delay=".2s">
                            <div class="col-md-12 contact-no">
                                <div class="single-contact-details text-center">
                                    <span class="lnr lnr-phone-handset"></span>
                                    <h4>phone</h4>
                                    <p class="text-muted">+1 111 222 3333</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-contact-details text-center">
                                    <span class="lnr lnr-envelope"></span>
                                    <h4>E-mail</h4>
                                    <p class="text-muted">support@dueza.com</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-contact-details text-center">
                                    <span class="lnr lnr-map-marker"></span>
                                    <h4>Address</h4>
                                    <p class="text-muted">New York, United States</p>
                                </div>
                            </div>
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
                            <h6>&copy;copyright | SEO Friendly 2017.Developed by DuezaThemes</h6>
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