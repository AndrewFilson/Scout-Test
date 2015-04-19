<?php require_once('Connections/scouts_dev.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_rankDescription = 10;
$pageNum_rankDescription = 0;
if (isset($_GET['pageNum_rankDescription'])) {
  $pageNum_rankDescription = $_GET['pageNum_rankDescription'];
}
$startRow_rankDescription = $pageNum_rankDescription * $maxRows_rankDescription;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rankDescription = "SELECT DISTINCT rank.rank_name, rank.`description` FROM rank";
$query_limit_rankDescription = sprintf("%s LIMIT %d, %d", $query_rankDescription, $startRow_rankDescription, $maxRows_rankDescription);
$rankDescription = mysql_query($query_limit_rankDescription, $scouts_dev) or die(mysql_error());
$row_rankDescription = mysql_fetch_assoc($rankDescription);

if (isset($_GET['totalRows_rankDescription'])) {
  $totalRows_rankDescription = $_GET['totalRows_rankDescription'];
} else {
  $all_rankDescription = mysql_query($query_rankDescription);
  $totalRows_rankDescription = mysql_num_rows($all_rankDescription);
}
$totalPages_rankDescription = ceil($totalRows_rankDescription/$maxRows_rankDescription)-1;
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['UserName'])) {
  $loginUsername=$_POST['UserName'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "role";
  $MM_redirectLoginSuccess = "scoutAdmin.php";
  $MM_redirectLoginFailed = "failedLogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_scouts_dev, $scouts_dev);
  	
  $LoginRS__query=sprintf("SELECT username, password, role FROM users WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $scouts_dev) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'role');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Scout Index</title>
    	<meta name="keywords" content="" />
		<meta name="description" content="" />
        <meta name="viewport" content="width=device-width">
    <!-- Google Web Font Embed -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,600,500,300,700' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/templatemo_main.css">
        <img src="bsa_logo.png" width="140" height="162" style="position: absolute; top: 10px; right: 10px;" alt=""/>
    </head>
    <body>
        <div id="main-wrapper">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 affix text-center" style="z-index: 1;">
                <h1 class="templatemo-site-title">Scout Troop 1046<img src="images/btn-menu.png" alt="main menu" class="pull-right visible-xs visible-sm" id="m-btn">
                </h1>

                <ul id="responsive" style="display:none" class="hidden-lg hidden-md"></ul><!-- /.responsive -->
            </div>

            <div class="menu visible-md visible-lg">
                <ul id="menu-list">
                    <li class="active home-menu"><a href="#home">Home</a></li>
                    <li class="about-menu"><a href="#about">About Us</a></li>
                    <li class="services-menu"><a href="#services">Our Service Projects</a></li>
                    <li class="rank-menu"><a href="#rank">Scout Ranking</a></li>
                    <li class="login-menu"><a href="#login">Log In</a></li>
                    <li class="contact-menu"><a href="#contact">Contact</a></li>
                </ul>
            </div><!-- /.menu -->

            <div class="image-section">
                <div class="image-container">
                    <img src="images/trail2.jpg" id="home-img" class="main-img inactive" alt="Home">
                    <img src="images/trail1.jpg" id="about-img" class="inactive" alt="About">
                    <img src="images/lake.jpg" id="services-img"  class="inactive" alt="Services">
                    <img src="images/LSsign.jpg" id="rank-img" class="inactive" alt="Rank">
                    <img src="images/trail5.jpg" id="login-img" class="inactive" alt="Login">
                    <img src="images/trail7.jpg" id="contact-img" class="inactive" alt="Contact">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 templatemo-content-wrapper">
                    <div class="templatemo-content">
                        
                        <section id="home-text" class="active templatemo-content-section">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h2>The Boy Scouts Purpose</h2>
                                <p>"The purpose of this corporation shall be to promote, through organization and cooperation with other agencies, the ability of boys to do things for themselves and others, to train them in Scoutcraft, and to teach them patriotism, courage, self-reliance, and kindred virtues, using methods which are now in common use by the Boy Scouts."</p>
                                <h2>The Mission of the Boy Scouts</h2>
                                <p>"It is the mission of the Boy Scouts of America to serve others by helping to instill values in young people and, in other ways, to prepare them to make ethical choices during their lifetime in achieving their full potential. The values we strive to instill are based on those found in the Scout Oath and Law."</p>
                            </div>
                        </section><!-- /.home-text -->    

                        <section id="about-text" class="inactive">
                            <h2 class="text-center">About Us</h2>
                            <div class="col-sm-6 col-md-6">
                              <p>We are the local Boy Scout troop 1046. We meet on Wednedays nights from 6:30 to 8:00 pm. </p>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <p>Additional material here.</p>
                            </div>
                        </section><!-- /.about-text --> 
                        
                        <section id="rank-text" class="inactive">
                            <h2 class="text-center">Ranks</h2>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                              <?php do { ?>
                              <h2><?php echo $row_rankDescription['rank_name']; ?></h2>
                              <p><?php echo $row_rankDescription['description']; ?></p>
                                <?php } while ($row_rankDescription = mysql_fetch_assoc($rankDescription)); ?>
                            </div>
                            
                      </section><!-- /.rank-text --> 

                        <section id="services-text" class="inactive">
                            <h2 class="text-center">Our Service Projects</h2>
                            <div class="col-sm-4 col-md-4">
                                <h3>Natural World</h3>
                                <p>Assiting with clean up, repair, planting, tending, and other helpful aspects of the natural world around us.</p>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <h3>Community Service</h3>
                                <p>To assist our community in which we live be better places. Help individuals in need.</p>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <h3>Organization Help</h3>
                                <p>To help chartered organizations with special events or projects.</p>
                            </div>
                        </section><!-- /.services-text --> 

                        <section id="login-text" class="inactive">
                            <div class="col-sm-12 col-md-12">
                                <h2>Log-in</h2>
                                <form action="<?php echo $loginFormAction; ?>" method="POST" name="Login" target="_blank">
                                <p>
                                <label for="UserName">Username:</label>
                                <input name="UserName" type="text" maxlength="30">
                                </p>
                                <p>
                                <label for="Password">Password: </label>
                                <input name="Password" type="password" maxlength="30">
                                </p>
                                <p>
                                <input name="Login" type="submit" value="Login">
                              </form>
                                </p>
                            </div>
                        </section><!-- /.testimonial-text --> 

                        <section id="contact-text" class="inactive">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12"><h2>Contact</h2></div>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div id="map-canvas"></div>
                                        <p>1803 19th St, Huntsville, TX 77340. Wednesday Nights 6:30pm - 8:00pm</p>
                                        <p>Joel Wilkinson - joel.photo@gmail.com</p>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <form action="#" method="post">

                                                <div class="form-group">
                                                    <!--<label for="contact_name">Name:</label>-->
                                                    <input type="text" id="contact_name" class="form-control" placeholder="Name" />
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="contact_email">Email:</label>-->
                                                    <input type="text" id="contact_email" class="form-control" placeholder="Email Address" />
                                                </div>
                                                <div class="form-group">
                                                    <!--<label for="contact_message">Message:</label>-->
                                                    <textarea id="contact_message" class="form-control" rows="9" placeholder="Write a message"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Send</button>

                                        </form>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </section><!-- /.contact-text --> 
                    </div><!-- /.templatemo-content -->  
                </div><!-- /.templatemo-content-wrapper --> 
            </div><!-- /.row --> 

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
                    
                </div><!-- /.footer --> 
            </div>

	</div><!-- /#main-wrapper -->
        
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div><!-- /#preloader -->
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/templatemo_script.js"></script>
        <!-- templatemo 398 nature -->
    </body>
</html>
<?php
mysql_free_result($rankDescription);
?>
