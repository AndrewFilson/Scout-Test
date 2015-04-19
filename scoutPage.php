<?php require_once('Connections/scouts_dev.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Scout";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>scoutPage</title>
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
                <h1 class="templatemo-site-title">Troop 1046<img src="images/btn-menu.png" alt="main menu" class="pull-right visible-xs visible-sm" id="m-btn">
                </h1>

                <ul id="responsive" style="display:none" class="hidden-lg hidden-md"></ul><!-- /.responsive -->
            </div>

            <div class="menu visible-md visible-lg">
                <ul id="menu-list">
                    <li class="active scout-menu"><a href="#scout">Scout Home</a></li>
                    <li class="req-menu"><a href="#req">Requirement Check-Off</a></li>
                    <li class="services-menu"><a href="#services">Our Service Projects</a></li>
                    <li class="review-menu"><a href="#review">Review Request</a></li>
                </ul>
            </div><!-- /.menu -->

            <div class="image-section">
                <div class="image-container">
                    <img src="images/trail2.jpg" id="scout-img" class="main-img inactive" alt="Scout">
                    <img src="images/trail1.jpg" id="req-img" class="inactive" alt="Req">
                    <img src="images/lake.jpg" id="services-img"  class="inactive" alt="Services">
                    <img src="images/LSsign.jpg" id="review-img" class="inactive" alt="Review">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 templatemo-content-wrapper">
                    <div class="templatemo-content">
                        
                        <section id="scout-text" class="active templatemo-content-section">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h2>Scout Calendar</h2>
                                <p></p>
                            </div>
                        </section><!-- /.home-text -->    

                        <section id="req-text" class="inactive">
                            <h2 class="text-center">Requirement Status</h2>
                            <div class="col-sm-6 col-md-6">
                              <p></p>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <p></p>
                            </div>
                        </section><!-- /.about-text --> 
                        
                        <section id="review-text" class="inactive">
                            <h2 class="text-center">Request Review</h2>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                              <p></p>
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
    </body>
</html>
<?php
mysql_free_result($rankDescription);
?>
