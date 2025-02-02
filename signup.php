<?php
    session_start();
  if(isset($_POST['signup'])) {
      $new_username = $_POST['fname'];
      $new_userid   = $_POST['email'];
      $new_password = md5($_POST['psw']);
      $usertype= "Contributor";

      $con=mysqli_connect("localhost","root","","events");
      $sql = "INSERT INTO user(user_id,user_name,user_password,user_type) VALUES('$new_userid','$new_username','$new_password','$usertype')";
      $result = mysqli_query($con,$sql);  

      echo "<script type='text/javascript'>alert('You have been successfully registered!! ');window.location.href='login.php';</script>";

    }
     
   
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Kamrul Events</title>
	
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
   <link href="css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" type="text/css" href="profile/css/signup.css">


</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +8801749--140494</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="https://web.facebook.com/mdkamrulhasan.hasan.5496"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/md-kamrul-hasan-502906266/"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Kamrul Events</a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li ><a href="index.php">Home</a></li>
                        <li>
                            <a href="index.php">Events</a>
                            
                        </li>
                            
                       <?php
                            if(isset($_SESSION['userid'])){
                                if($_SESSION["userid"]=="admin@admin.com"){
                                    echo "<li><a href='profile/..\index.php'><span class='glyphicon glyphicon-log-in'></span> Profile</a></li>";
                                    

                                }
                                else{

                                    echo "<li><a href='profile/contributor_profile.php'><span class='glyphicon glyphicon-log-in'></span> Profile</a></li>";
                                    
                                }
                                echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Log Out</a></li>";
                            }
                            else{

                               echo "<li class='active'><a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
                                echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>"; 
                            }
                        ?>        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->

    
    <section class="container">
        <div class="center">
            <h2>Sign Up Form</h2>
        </div>
        <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="#">Sign Up Page</a>
                    </li>           
        </ol>
        <div class="center">

            <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post" style="border:1px solid #ccc">
                 <label><b>NAME</b></label>
                 <input type="text" placeholder="Enter your full name" name="fname" required><br>
                <label><b>Mail ID</b></label>
                    <input type="email" placeholder="Enter Email ID" name="email" required><br>
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required><br>                
                    <button type="reset" class="btn btn-danger" style="width:100px">Cancel</button>
                    <button type="submit" name="signup" class="btn btn-success" style="width:100px">Sign Up</button>
            
            </form>
        </div>




    </section><!--/#blog-->

    
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 <a target="_blank" href="#" title="Kamrul Events">Kamrul Events</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
</body>
</html>