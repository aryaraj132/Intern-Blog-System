<?php include("../path.php"); ?>
<?php include(ROOT_PATH . "/php/controllers/users.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Intern Blog System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href=" ../fonts/icomoon/style.css">

    <link rel="stylesheet" href=" ../css/bootstrap.min.css">
    <link rel="stylesheet" href=" ../css/jquery-ui.css">
    <link rel="stylesheet" href=" ../css/owl.carousel.min.css">
    <link rel="stylesheet" href=" ../css/owl.theme.default.min.css">
    <link rel="stylesheet" href=" ../css/owl.theme.default.min.css">

    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" ../css/forms.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <div class="border-bottom top-bar py-2 bg-dark" id="home-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">
                            <span class="mr-3"><strong class="text-white">Contact Number:</strong> <a href="tel://+918340728808">+91   8340728808</a></span>
                            <span><strong class="text-white">Email:</strong> <a href="mailto://aryaraj132@gmail.com">aryaraj132@gmail.com</a></span>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>

    <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
        <div class="col-10 col-xl-2">
                          <h3 style="width: 200px;font-size:22px;">Intern Blog System</h3>
                    </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="verify.php" class="nav-link">Verify</a></li>
                <li><a href="blog.php" class="nav-link">Blog</a></li>
                <?php if(isset($_SESSION['id'])): ?>
                  
                  <li class="has-children">
                    <span class="text-primary icon-user"></span> Welcome <?php echo $_SESSION['username']; ?>
                    <ul class="dropdown" style="width:240px;">
                    <li><a href="<?php echo BASE_URL . 'logout.php'?>" class="nav-link">Logout</a></li>                  
                  </ul>
                  </li>
                <?php else: ?>
                  <li><a href="login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>
    <?php if(($_SESSION['admin']=='1')&& ($_SESSION['username']=='aryaraj132')): ?>
<div class="login-wrap">
<div class="login-box">
<form class="form" action="signup.php" method="post">
		    <h2>SIGNUP Here</h2>
		    <div class="form-container">
	            <input type="text" value="<?php echo $username; ?>" class="form-input" placeholder="Username" name="username" autofocus />
	            <input type="email" value="<?php echo $email; ?>" class="form-input" placeholder="Email ID" name="email" autofocus />
                <input type="password" value="<?php echo $password; ?>" class="form-input" placeholder="Password" name="password">
                <input type="password" value="<?php echo $passwordCnf; ?>" class="form-input" placeholder="Confirm Password" name="passwordCnf">
                <?php include(ROOT_PATH . "/php/formError.php"); ?>
                <button class="btn btn-login" type="submit" name="btn-signup"> SUBMIT </button>
	            <hr>
	        </div>
</form>	  	
</div>
</div>
<?php else: ?>
    <div style="margin-top: 150px;margin-left:50px;">
            <?php echo "You are not Authorised, Please Login Here :" ?>   <a href="login.php" class="nav-link">Login</a>
            </div>
        <?php endif; ?>
      
      
     <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 class="footer-heading mb-4">About Project</h2>
                                <p>This website is bulit with help of HTML CSS JS and PHP for backend using MySQL database. <br /> Its basic functionality is to hold and manage different interns as well as different posts posted by them giving total access to admin via dashboard with proper credentials management </p>
                            </div>
                            <div class="col-md-3 ml-auto">
                                <h2 class="footer-heading mb-4">Browse Link</h2>
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo BASE_URL . 'index.php'?>" class="nav-link">Home</a></li>
                  <li><a href="<?php echo BASE_URL . 'intern/verify.php'?>" class="nav-link">Verify Interns</a></li>
                                </ul>
                            </div>
                            

                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="footer-heading mb-4">Contact</h2>
                        <ul class="list-unstyled">
                            
                            <li><a href="tel:8340728808">+91 8340728808</a></li>
                            <li><a href="mailto:aryaraj132@gmail.com">aryaraj132@gmail.com</a></li>

                        </ul>

                    </div>
                </div>
                <!--        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <!--Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a> 
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <!--  </p>
            </div>
          </div>
        -->

            </div>
    </div>
    </footer>


  </div> <!-- .site-wrap -->

  <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/jquery.countdown.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>

    <script src="../js/typed.js"></script>
    <script>
        var typed = new Typed('.typed-words', {
            strings: ["Web Apps", " WordPress", " Mobile Apps"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
        });
    </script>

    <script src="../js/main.js"></script>
  


  </body>
</html>
