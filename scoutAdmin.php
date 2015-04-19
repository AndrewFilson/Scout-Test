<?php require_once('Connections/scouts_dev.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Scout Admin";
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

$MM_restrictGoTo = "scoutMaster.php";
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

$maxRows_rsUsers = 10;
$pageNum_rsUsers = 0;
if (isset($_GET['pageNum_rsUsers'])) {
  $pageNum_rsUsers = $_GET['pageNum_rsUsers'];
}
$startRow_rsUsers = $pageNum_rsUsers * $maxRows_rsUsers;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsUsers = "SELECT * FROM users ORDER BY username ASC";
$query_limit_rsUsers = sprintf("%s LIMIT %d, %d", $query_rsUsers, $startRow_rsUsers, $maxRows_rsUsers);
$rsUsers = mysql_query($query_limit_rsUsers, $scouts_dev) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);

if (isset($_GET['totalRows_rsUsers'])) {
  $totalRows_rsUsers = $_GET['totalRows_rsUsers'];
} else {
  $all_rsUsers = mysql_query($query_rsUsers);
  $totalRows_rsUsers = mysql_num_rows($all_rsUsers);
}
$totalPages_rsUsers = ceil($totalRows_rsUsers/$maxRows_rsUsers)-1;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <title>scoutAdmin</title>
    	<meta name="keywords" content="" />
		<meta name="description" content="" />
<!-- 
Nature Template 
http://www.templatemo.com/preview/templatemo_398_nature 
-->
        <meta name="viewport" content="width=device-width">
        
        <!-- Google Web Font Embed -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,600,500,300,700' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/templatemo_main.css">
        <img src="bsa_logo.png" width="140" height="162" style="position: absolute; top: 10px; right: 10px;" alt=""/>
    </head>
    <body>
        <div id="main-wrapper">
            <!--[if lt IE 7]>
                <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a rel="nofollow" href="http://browsehappy.com">upgrade your browser</a> or <a rel="nofollow" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
            <![endif]-->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 affix text-center" style="z-index: 1;">
                <h1 class="templatemo-site-title">Troop 1046<img src="images/btn-menu.png" alt="main menu" class="pull-right visible-xs visible-sm" id="m-btn">
                </h1>

                <ul id="responsive" style="display:none" class="hidden-lg hidden-md"></ul><!-- /.responsive -->
            </div>

            <div class="menu visible-md visible-lg">
                <ul id="menu-list">
                    <li class="active admin-menu"><a href="#admin">Admin Home</a></li>
                    <li class="useradd-menu"><a href="#useradd">Add User</a></li>
                    <li class="rank-menu"><a href="#rank">Scout Ranking</a></li>
                </ul>
            </div><!-- /.menu -->

            <div class="image-section">
                <div class="image-container">
                    <img src="images/trail2.jpg" id="admin-img" class="main-img inactive" alt="Admin">
                    <img src="images/trail1.jpg" id="useradd-img" class="inactive" alt="Useradd">
                    <img src="images/LSsign.jpg" id="rank-img" class="inactive" alt="Rank">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 templatemo-content-wrapper">
                    <div class="templatemo-content">
                      
<section id="admin-text" class="active templatemo-content-section">
              <div class="col-sm-12 col-md-12 col-lg-12">
                  <h2>User List</h2>
                  <p2><table border="0" cellpadding="5">
                        <tr>
                          <td>username</td>
                          <td>role</td>
                          <td>troop</td>
                          <td>last_updated</td>
                        </tr>
                        <?php do { ?>
                          <tr>
                            <td><?php echo $row_rsUsers['username']; ?></td>
                            <td><?php echo $row_rsUsers['role']; ?></td>
                            <td><?php echo $row_rsUsers['troop']; ?></td>
                            <td><?php echo $row_rsUsers['last_updated']; ?></td>
                          </tr>
                          <?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>
                      </table></p2>
              </div>
          </section><!-- /.home-text -->    

                        <section id="useradd-text" class="inactive">
                            <h2 class="text-center">Adding Leaders</h2>
                            <div class="col-sm-6 col-md-6">
                              <p></p>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <p></p>
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

mysql_free_result($rsUsers);
?>
