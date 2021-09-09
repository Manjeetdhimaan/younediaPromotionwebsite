<?php
    session_start();
    if(isset($_SESSION["loggedin"]) === false || $_SESSION["loggedin"] === false){
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
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsibleNavbar">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav navbar-right">
 
                                            <li class="active"><a href="user-profile.php">Dashboard</a>
                                            </li>
                                            <li ><a href="allvideocheckout.html">Order Now</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="logout.php">Sign Out</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    
                                    
<nav class="navbar navbar-expand-md bg-dark navbar-dark navformobile">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
                                            <li class="active"><a href="user-profile.php">Dashboard</a>
                                            </li>
                                            <li ><a href="allvideocheckout.html">Order Now</a>
                                            </li>
                                            <li><a class="smoth-scroll" href="logout.php">Sign Out</a>
                                            </li>

    </ul>
  </div>  
</nav>                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
			<!--
		    <div class="welcome-image-area" data-stellar-background-ratio="0.6">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="header-text user-page">
                                        <h2>User Dashboard!</h2>
                                        <p>Change your password or view your order history here.</p>
								 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			-->

        </header>

        <section id="service" class="service-area section-padding user-profile-section">
            <div class="container">
			                 <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="header-text user-page">
                                        <h2>User Dashboard!</h2>
							<span class="title-divider">
                            <i class="fa fa-diamond" aria-hidden="true"></i>
                            </span>
                                        <p>Change your password or view your order history here.</p>
								 </div>
                                </div>
                            </div>
			
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="vertical-tab" role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Change Password </a></li>
                                <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">View Order History</a></li>
                                <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Log Out</a></li>
                            </ul>
                            <div class="tab-content tabs">
                                <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                                    <h4>Update your password now</h4>
                                    <form method="post" action="submit_new.php">
                                        <input type="hidden" name="email" value="<?php echo $_SESSION["username"]; ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter your new Password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Confirm Password" name="password" oninput="check(this);">
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
                                <div role="tabpanel" class="tab-pane fade" id="Section2">
                                    <h3>Order History</h3>
                                    
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
                    					        $query="SELECT * FROM users WHERE username='".$_SESSION["username"]."'";
                    					        $row = $db_handle->runQuery($query);
                    					        $i=1;
                                                foreach($row as $item) {
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
                                                            $i+=1;
                                                        ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="pending-order">
                                                        <?php
                                                            $tempStr=$item['order_status'];
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
                                <div role="tabpanel" class="tab-pane fade" id="Section3">
                                    <h4>Are you Sure you want to log out? </h4>
                                    <a href="logout.php" class="confirm-logout">Confirm Log Out</a>
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
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/lightbox.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  
  
    </body>
</html>