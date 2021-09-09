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
                                <a href="index.php">
									<img src="YouNedia.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mainmenu">
                                <div class="navbar navbar-nobg">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsibleNavbar">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li class="active">
                                                <a class="smoth-scroll" href="index.php">
                                                    Home 
                                                    <div class="ripple-wrapper"></div>
                                                </a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#why-us">Why Choose Us</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#service">Our Service</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="#contact">contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
<nav class="navbar navbar-expand-md bg-dark navbar-dark navformobile">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
        <li class="active">
         <a class="smoth-scroll" href="index.php">Home</a> </li>
        <li><a class="smoth-scroll" href="#why-us">Why Choose Us</a> </li>
        <li><a class="smoth-scroll" href="#service">Our Service</a></li>
        <li><a class="smoth-scroll" href="#contact">contact</a>  </li>

    </ul>
  </div>  
</nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </header>
		
		
		
		
		
		
		
		
		
 <div class="welcome-image-area" data-stellar-background-ratio="0.6" id="register-area">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 text-center register-home login-sec">

                     <div class="section-title">
                            <h2>Already Have Account? </br> Login Now</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div> 

                        <form id="signupform0" style="margin-top: 0px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="email" id="advertiser_email_box0" placeholder="Enter your email here" name="username" required>
                            <span class="help-block"><?php echo $username_err; ?></span>
                            <input type="password" id="advertiser_password_box0" placeholder="Enter your password here" name="password" required>
                            <span class="help-block"><?php echo $password_err; ?></span>
                            <input type="text" name="value" value="high" hidden required> 
                            <div class="submit-buttons-home">
                                <input type="submit" class="start_camp" style="margin-top: 15px;vertical-align:top;" id="register_btn" value="Login Now">
                            </div>
                            <div class="register-with-us"><a class="resendemail" form="0" href="reset_pass.html">FORGOT YOUR PASSWORD?</a></div>
                        </form>

                                </div>
								
						 <div class="col-md-1">
						 </div>
								
						<div class="col-md-6 text-center register-home register-sec">
                     <div class="section-title">
                            <h2>Start Promoting Your Video Now</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div> 
						<form id="register_form" class="" action="sign-up.php" method="POST">
                            <div class="form-group"> 
                                <label for="input-name">Name*</label>
                                <input type="text" class="input-field" id="register_fullname" name="fullname" placeholder="Enter your Name" required="">
                            </div>
                            <div class="form-group">
                                <label for="input-phone">E-mail Address*</label>
                                <input type="email" class="input-field" id="register_e-mail" name="username" placeholder="Enter Email*" required="">
                            </div>
                            <div class="form-group">
                                <label for="input-password">Password*</label>
                                <input type="password" class="input-field" id="register_password" name="password" placeholder="Create Password" required="">
                            </div>
                            <div class="form-group">
                                <label for="input-password">Confirm Password*</label>
                                <input type="password" class="input-field" id="register_confirmpassword" name="confirm_password" placeholder="Confirm Your Password" required="">
                            </div>
                            <div class="form-group">
							
								<label></label>
								<input type="submit" class="mybtn1" name="" value="Promote Video Now" id="register_btn">

                            </div>
                        </form>
                    </div>
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        <div class="why-chhose-us-area section-padding" id="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 why-choose-us-title">
                        <div class="section-title">
                            <h2>why choose us?</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
 <p class="text-center"> We will help you to increase original views on your YouTube videos. We will help you distribute your YouTube video across our trusted publisher network, which includes blogs, websites, applications, and social media platforms.
We prioritise quality over quantity. We broadcast your video to individuals who are most interested in learning more about you.</p>

						
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
		
		
        <section class="call-to-action-area" data-stellar-background-ratio="0.6">
            <div class="container">
             <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-thumbs-o-up"></span>
                            <h2 class="counter-num">1200</h2>
                            <h6 class="text-muted">Videos Promoted</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-smile-o"></span>
                            <h2 class="counter-num">123000</h2>
                            <h6 class="text-muted">Likes Given</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-signal"></span>
                            <h2 class="counter-num">456090</h2>
                            <h6 class="text-muted">Views Given</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="single-project-complete">
                            <span class="fa fa-trophy"></span>
                            <h2 class="counter-num">4531</h2>
                            <h6 class="text-muted">Subscribers Given</h6>
                        </div>
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
                            <h4>Youtube Views</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-service text-center">
                            <span class="fa fa-refresh"></span>
                            <h4>Youtube Likes</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-service text-center">
                            <span class="fa fa-signal"></span>
                            <h4>Youtube Subscribers</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                        </div>
                    </div>
								
                </div>
            </div>
        </section>
		
		
 
		


  
        <section id="testimonial" class="testimonial-area section-padding" data-stellar-background-ratio="0.6">
            <div class="container">
				
               <div class="row">
                    <div class="col-sm-9">
                        <div class="section-title white-title">
                            <h2>Ready to Promote your Video? </h2>

                        </div>
                    </div>
					
                    <div class="col-sm-3">
                        <div class="section-title white-title">
                            <h4><a href="#register-area">Promote Now</a></h4>
   
                        </div>
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
                                    <p class="text-muted">+91 111 222 3333</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-contact-details text-center">
                                    <span class="lnr lnr-envelope"></span>
                                    <h4>E-mail</h4>
                                    <p class="text-muted">support@jotgill.in</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-contact-details text-center">
                                    <span class="lnr lnr-map-marker"></span>
                                    <h4>Address</h4>
                                    <p class="text-muted">Chandigarh</p>
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
                            <h6>All Right Reserved.</h6>
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

    </body>
</html>