<?php
    // Include config file
    require_once "config.php";
     
    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $sql = "UPDATE users SET account_status='active'";
                    $result = $link->query($sql);
                    
                    // Set logged in session variables
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    // Redirect to login page
                    header("location: allvideocheckout.html");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
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
                                    <p>SEO Friendly</p>
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
                                        <h2>WE ARE SEO AGENCY!</h2>
                                        <p>We are making your dream true on the basis of Creativity is simply dummy the printing and typesetting industry.</p>
                                        <a class="slide-btn smoth-scroll" href="#contact">
                                        Contact us <i class="fa fa-hand-pointer-o btn-contact-us" aria-hidden="true"></i></a>
                                        <a class="smoth-scroll hire-us-slide-btn" href="#">Hire us <i class="fa fa-hand-pointer-o btn-hire-us" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="service" class="service-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Register with Us</h2>
                            <span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6">
                        <form id="register_form" class="" method="POST">
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
                                <input type="submit" class="mybtn1" name="" value="Register Now" id="register_btn">
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3">
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
        <script>
            function getIn(form, callback) {
                $.ajax({
                    url: "https://www.promolta.com/login",
                    type: 'POST',
                    data: form.serialize(),
                    beforeSend: function(xhrObj){
                        xhrObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    },
                    success: function (response) {
                        if ( !response.status ) {
                            callback(response.error.text);
                            return;
                        }
                        if ( response.redirect_url !== undefined ) {
                            window.location.href = $('#base_url').val() + response.redirect_url;
                        }
                    },
                    error: function () {
                        console.log('START_CAMPAIGN: Some error occurred');
                        callback('Something went wrong! Please try again');
                    }
                });
            }
        </script>
    </body>
</html>