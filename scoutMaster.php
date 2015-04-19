<?php require_once('Connections/scouts_dev.php'); ?>
<?php require_once('Connections/scouts_dev.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "badgeUpdate")) {
  $updateSQL = sprintf("UPDATE badges_status SET completed=%s WHERE bid=%s AND sid=%s",
                       GetSQLValueString(isset($_POST['completed']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['badgeList'], "int"),
                       GetSQLValueString($_POST['ScoutList'], "int"));

  mysql_select_db($database_scouts_dev, $scouts_dev);
  $Result1 = mysql_query($updateSQL, $scouts_dev) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insertBadge")) {
  $insertSQL = sprintf("INSERT INTO badges_status (bid, sid, completed, last_updated) VALUES (%s, %s, 'N', %s)",
                       GetSQLValueString($_POST['badgeList2'], "int"),
                       GetSQLValueString($_POST['scoutList2'], "int"),
                       GetSQLValueString(isset($_POST['startBadge']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['currentDate'], "date"));

  mysql_select_db($database_scouts_dev, $scouts_dev);
  $Result1 = mysql_query($insertSQL, $scouts_dev) or die(mysql_error());
}

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

$colname_rsBadgeStatus = "-1";
if (isset($_GET['sid'])) {
  $colname_rsBadgeStatus = $_GET['sid'];
}

$maxRows_rsBadgeList2 = 200;
$pageNum_rsBadgeList2 = 0;
if (isset($_GET['pageNum_rsBadgeList2'])) {
  $pageNum_rsBadgeList2 = $_GET['pageNum_rsBadgeList2'];
}
$startRow_rsBadgeList2 = $pageNum_rsBadgeList2 * $maxRows_rsBadgeList2;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsBadgeList2 = "SELECT bid, badge_name FROM badges";
$query_limit_rsBadgeList2 = sprintf("%s LIMIT %d, %d", $query_rsBadgeList2, $startRow_rsBadgeList2, $maxRows_rsBadgeList2);
$rsBadgeList2 = mysql_query($query_limit_rsBadgeList2, $scouts_dev) or die(mysql_error());
$row_rsBadgeList2 = mysql_fetch_assoc($rsBadgeList2);

if (isset($_GET['totalRows_rsBadgeList2'])) {
  $totalRows_rsBadgeList2 = $_GET['totalRows_rsBadgeList2'];
} else {
  $all_rsBadgeList2 = mysql_query($query_rsBadgeList2);
  $totalRows_rsBadgeList2 = mysql_num_rows($all_rsBadgeList2);
}
$totalPages_rsBadgeList2 = ceil($totalRows_rsBadgeList2/$maxRows_rsBadgeList2)-1;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList2 = "SELECT sid, fname, lname FROM scouts";
$rsScoutList2 = mysql_query($query_rsScoutList2, $scouts_dev) or die(mysql_error());
$row_rsScoutList2 = mysql_fetch_assoc($rsScoutList2);
$totalRows_rsScoutList2 = mysql_num_rows($rsScoutList2);
?>
<?PHP
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Scout Master";
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

$MM_restrictGoTo = "scoutPage.php";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO scouts (fname, lname, birth_date, last_updated, contact, address, city, `state`, zip) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['birth_date'], "date"),
                       GetSQLValueString($_POST['last_updated'], "date"),
                       GetSQLValueString($_POST['contact'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"));

  mysql_select_db($database_scouts_dev, $scouts_dev);
  $Result1 = mysql_query($insertSQL, $scouts_dev) or die(mysql_error());
}

if ((isset($_POST['sid'])) && ($_POST['sid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM scouts WHERE sid=%s",
                       GetSQLValueString($_POST['sid'], "int"));

  mysql_select_db($database_scouts_dev, $scouts_dev);
  $Result1 = mysql_query($deleteSQL, $scouts_dev) or die(mysql_error());
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

$maxRows_rsScoutList = 10;
$pageNum_rsScoutList = 0;
if (isset($_GET['pageNum_rsScoutList'])) {
  $pageNum_rsScoutList = $_GET['pageNum_rsScoutList'];
}
$startRow_rsScoutList = $pageNum_rsScoutList * $maxRows_rsScoutList;
/*
$colname_rsScoutList = "-1";

mysql_select_db($database_scouts_dev, $scouts_dev);
if (isset($_POST['search_string'])) 
{
  	$searchword = $_POST['search_string'];
	$query_rsScoutList = "SELECT * FROM scouts WHERE lname LIKE '%".$searchword."%' ORDER BY lname ASC";
}
else
{
	$query_rsScoutList = "SELECT * FROM scouts ORDER BY lname ASC";
}

$colname_rsScoutList = "-1";
if (isset($_POST['lname'])) {
  $colname_rsScoutList = $_POST['lname'];
}
mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList = sprintf("SELECT * FROM scouts WHERE lname = %s ORDER BY lname ASC", GetSQLValueString($colname_rsScoutList, "text"));
$query_limit_rsScoutList = sprintf("%s LIMIT %d, %d", $query_rsScoutList, $startRow_rsScoutList, $maxRows_rsScoutList);
$rsScoutList = mysql_query($query_limit_rsScoutList, $scouts_dev) or die(mysql_error());
$row_rsScoutList = mysql_fetch_assoc($rsScoutList);
}*/


if (isset($_GET['totalRows_rsScoutList'])) {
  $totalRows_rsScoutList = $_GET['totalRows_rsScoutList'];
} else {
  $all_rsScoutList = mysql_query($query_rsScoutList);
  $totalRows_rsScoutList = mysql_num_rows($all_rsScoutList);
}
$totalPages_rsScoutList = ceil($totalRows_rsScoutList/$maxRows_rsScoutList)-1;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsBadgeList = "SELECT distinct badges.bid, badges.badge_name FROM badges ORDER BY badges.badge_name";
$rsBadgeList = mysql_query($query_rsBadgeList, $scouts_dev) or die(mysql_error());
$row_rsBadgeList = mysql_fetch_assoc($rsBadgeList);
$totalRows_rsBadgeList = mysql_num_rows($rsBadgeList);

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutPullDown = "SELECT scouts.sid, scouts.lname, scouts.fname FROM scouts ORDER BY scouts.lname";
$rsScoutPullDown = mysql_query($query_rsScoutPullDown, $scouts_dev) or die(mysql_error());
$row_rsScoutPullDown = mysql_fetch_assoc($rsScoutPullDown);
$totalRows_rsScoutPullDown = mysql_num_rows($rsScoutPullDown);

/*$maxRows_rsScoutList = 10;
$pageNum_rsScoutList = 0;
if (isset($_GET['pageNum_rsScoutList'])) {
  $pageNum_rsScoutList = $_GET['pageNum_rsScoutList'];
}
$startRow_rsScoutList = $pageNum_rsScoutList * $maxRows_rsScoutList;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList = "SELECT * FROM scouts ORDER BY lname ASC";
$query_limit_rsScoutList = sprintf("%s LIMIT %d, %d", $query_rsScoutList, $startRow_rsScoutList, $maxRows_rsScoutList);
$rsScoutList = mysql_query($query_limit_rsScoutList, $scouts_dev) or die(mysql_error());
$row_rsScoutList = mysql_fetch_assoc($rsScoutList);

if (isset($_GET['totalRows_rsScoutList'])) {
  $totalRows_rsScoutList = $_GET['totalRows_rsScoutList'];
} else {
  $all_rsScoutList = mysql_query($query_rsScoutList);
  $totalRows_rsScoutList = mysql_num_rows($all_rsScoutList);
}
$totalPages_rsScoutList = ceil($totalRows_rsScoutList/$maxRows_rsScoutList)-1;
*/
$maxRows_rsCurrentBadges = 10;
$pageNum_rsCurrentBadges = 0;
if (isset($_GET['pageNum_rsCurrentBadges'])) {
  $pageNum_rsCurrentBadges = $_GET['pageNum_rsCurrentBadges'];
}
$startRow_rsCurrentBadges = $pageNum_rsCurrentBadges * $maxRows_rsCurrentBadges;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsCurrentBadges = "SELECT scouts.fname, scouts.lname, badges.badge_name, badges_status.completed, badges_status.last_updated FROM badges_status, scouts, badges WHERE badges_status.sid = scouts.sid AND badges_status.bid = badges.bid ORDER BY scouts.fname";
$query_limit_rsCurrentBadges = sprintf("%s LIMIT %d, %d", $query_rsCurrentBadges, $startRow_rsCurrentBadges, $maxRows_rsCurrentBadges);
$rsCurrentBadges = mysql_query($query_limit_rsCurrentBadges, $scouts_dev) or die(mysql_error());
$row_rsCurrentBadges = mysql_fetch_assoc($rsCurrentBadges);

if (isset($_GET['totalRows_rsCurrentBadges'])) {
  $totalRows_rsCurrentBadges = $_GET['totalRows_rsCurrentBadges'];
} else {
  $all_rsCurrentBadges = mysql_query($query_rsCurrentBadges);
  $totalRows_rsCurrentBadges = mysql_num_rows($all_rsCurrentBadges);
}
$totalPages_rsCurrentBadges = ceil($totalRows_rsCurrentBadges/$maxRows_rsCurrentBadges)-1;

$colname_rsScoutList = "-1";

mysql_select_db($database_scouts_dev, $scouts_dev);
if (isset($_POST['search_string'])) 
{
  	$searchword = $_POST['search_string'];
	$query_rsScoutList = "SELECT * FROM scouts WHERE lname LIKE '%".$searchword."%' OR fname LIKE '%".$searchword."%' ORDER BY lname ASC";
	$rsScoutList = mysql_query($query_rsScoutList, $scouts_dev) or die(mysql_error());
	$row_rsScoutList = mysql_fetch_assoc($rsScoutList);
	$totalRows_rsScoutList = mysql_num_rows($rsScoutList);
}
else
{
$query_rsScoutList = "SELECT * FROM scouts ORDER BY lname ASC";
$rsScoutList = mysql_query($query_rsScoutList, $scouts_dev) or die(mysql_error());
$row_rsScoutList = mysql_fetch_assoc($rsScoutList);
$totalRows_rsScoutList = mysql_num_rows($rsScoutList);
}
$queryString_rsScoutList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsScoutList") == false && 
        stristr($param, "totalRows_rsScoutList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsScoutList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsScoutList = sprintf("&totalRows_rsScoutList=%d%s", $totalRows_rsScoutList, $queryString_rsScoutList);

$queryString_rsCurrentBadges = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsCurrentBadges") == false && 
        stristr($param, "totalRows_rsCurrentBadges") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsCurrentBadges = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsCurrentBadges = sprintf("&totalRows_rsCurrentBadges=%d%s", $totalRows_rsCurrentBadges, $queryString_rsCurrentBadges);

$queryString_rsBadgeList2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsBadgeList2") == false && 
        stristr($param, "totalRows_rsBadgeList2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsBadgeList2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsBadgeList2 = sprintf("&totalRows_rsBadgeList2=%d%s", $totalRows_rsBadgeList2, $queryString_rsBadgeList2);

?>
<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Scout Entry Page</title>
    	<meta name="keywords" content="" />
		<meta name="description" content="" />
        <meta name="viewport" content="width=device-width">
        
        <!-- Google Web Font Embed -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,600,500,300,700' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/templatemo_main.css">
        <link href="jQueryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
        <script src="jQueryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<img src="bsa_logo.png" width="140" height="162" style="position: absolute; top: 10px; right: 10px;" alt=""/>
    </head>
    <body>
        <div id="main-wrapper">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 affix text-center" style="z-index: 1;">
                <h1 class="templatemo-site-title">Troop 1046<img src="images/btn-menu.png" alt="main menu" class="pull-left visible-xs visible-sm" id="m-btn">
                </h1>

                <ul id="responsive" style="display:none" class="hidden-lg hidden-md"></ul><!-- /.responsive -->
            </div>

            <div class="menu visible-md visible-lg">
                <ul id="menu-list">
                    <li class="active scoutlist-menu"><a href="#scoutlist">Scout List</a></li>
                  	<li class="scout-menu"><a href="#scout">Enter New Scout</a></li>
                    <li class="badgestatus-menu"><a href="#badgestatus">Current Badges</a></li>
                    <li class="requirement-menu"><a href="#requirement">Current Requirements</a></li>
                    <li class="badges-menu"><a href="#badges">Start Badge</a></li>
                    <li class="badgec-menu"><a href="#badgec">Complete Badge</a></li>
                </ul>
            </div><!-- /.menu -->

            <div class="image-section">
                <div class="image-container">
                    <img src="images/lake.jpg" id="scoutlist-img" class="main-img inactive" alt="Scoutlist">
                    <img src="images/trail2.jpg" id="scout-img" class="inactive" alt="Scout">
                    <img src="images/trail1.jpg" id="badgec-img" class="inactive" alt="Badgec">
                    <img src="images/trail5.jpg" id="badges-img"  class="inactive" alt="Badges">
                    <img src="images/trail5.jpg" id="requirement-img"  class="inactive" alt="Requirement">
                    <img src="images/trail7.jpg" id="badgestatus-img"  class="inactive" alt="Badgestatus">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 templatemo-content-wrapper">
                    <div class="templatemo-content">
                        
                        <section id="scoutlist-text" class="active templatemo-content-section">
                          <div class="col-sm-12 col-md-12 col-lg-12">
                                <h2>Scout List</h2>
                                
                                <p><form id="form3" name="form3" action="" method="post">
                                <label>Search:</label><input id="search_string" name="search_string" type="text">
                                <input id="Search" name="search" type="submit" value="Search">
                                </form></p>
                            
                            <p2><table width="540" border="0" align="center" cellpadding="0" cellspacing="5">
                              <tr>
                                <td width="90"><b>Last Name</b></td>
                                <td width="90"><b>First Name</b></td>
                                <td width="90"><b>Rank</b></td>
                                <td width="90"><b>Birth Date</b></td>
                                <td width="90"><b>Contact Phone</b></td>
                                <td width="90">&nbsp;</td>
                              </tr>
                              <?php do { ?>
                                <tr>
                                  <td><?php echo $row_rsScoutList['lname']; ?></td>
                                  <td><?php echo $row_rsScoutList['fname']; ?></td>
                                  <td><?php echo $row_rsScoutList['rank']; ?></td>
                                  <td><?php echo $row_rsScoutList['birth_date']; ?></td>
                                  <td><?php echo $row_rsScoutList['contact']; ?></td>
                                  <td><a href="deleteScout.php?sid=<?php echo $row_rsScoutList['sid']; ?>">delete</a></td>
                                </tr>
                                <?php } while ($row_rsScoutList = mysql_fetch_assoc($rsScoutList)); ?>
                            </table></p2>
                          <p2><a href="scoutMaster.php">Show All</a>
                          <a href="<?php printf("%s?pageNum_rsScoutList=%d%s", $currentPage, 0, $queryString_rsScoutList); ?>">First</a>
                          <a href="<?php printf("%s?pageNum_rsScoutList=%d%s", $currentPage, max(0, $pageNum_rsScoutList - 1), $queryString_rsScoutList); ?>">Previous</a> 
                          <a href="<?php printf("%s?pageNum_rsScoutList=%d%s", $currentPage, min($totalPages_rsScoutList, $pageNum_rsScoutList + 1), $queryString_rsScoutList); ?>">Next</a> 
                          <a href="<?php printf("%s?pageNum_rsScoutList=%d%s", $currentPage, $totalPages_rsScoutList, $queryString_rsScoutList); ?>">Last</a> Total Scouts:<?php echo $totalRows_rsScoutList ?></p2> 
                          </div>
                        </section><!-- /.home-text --> 
                        
                      <section id="scout-text" class="inactive">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h2>Enter New Scout</h2>
                                <p3>
                                <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                    <table align="center">
                      <tr valign="baseline">
                        <td nowrap align="right">First Name:</td>
                        <td><span id="sprytextfield1">
                        <input type="text" name="fname" value="" size="32">
                        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">Last Name:</td>
                        <td><span id="sprytextfield2">
                        <input type="text" name="lname" value="" size="32">
                        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">Birth Date:</td>
                        <td><span id="sprytextfield4">
                        <input type="text" name="birth_date" value="" size="32">
                        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">Phone Number:</td>
                        <td><span id="sprytextfield3">
                          <input type="text" name="contact" value="" size="32">
                        <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">Street Address:</td>
                        <td><input type="text" name="address" value="" size="32"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">City:</td>
                        <td><input type="text" name="city" value="" size="32"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">State:</td>
                        <td><input type="text" name="state" value="" size="32"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">Zip:</td>
                        <td><input type="text" name="zip" value="" size="32"></td>
                      </tr>
                      <tr valign="baseline">
                        <td nowrap align="right">&nbsp;</td>
                        <td><input type="submit" value="Insert record"></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="form1">
                  </form><p>&nbsp;</p3>
                                </p>
                            </div>
                        </section><!-- /.home-text -->    

                        <section id="badgec-text" class="inactive">
                            <h2 class="text-center">Complete Badge</h2>
                            <div class="col-sm-6 col-md-6">
                              <p>
                              <form action="<?php echo $editFormAction; ?>" method="POST" name="badgeUpdate">
                              <p><label>Badge Selection:</label><select name="badgeList"></p>
                                <?php
								do {  
								?>
                                <option value="<?php echo $row_rsBadgeList['bid']?>"><?php echo $row_rsBadgeList['badge_name']?>
                                </option>
                                <?php
								} while ($row_rsBadgeList = mysql_fetch_assoc($rsBadgeList));
 										 $rows = mysql_num_rows($rsBadgeList);
  									if($rows > 0) {
     									 mysql_data_seek($rsBadgeList, 0);
	 									 $row_rsBadgeList = mysql_fetch_assoc($rsBadgeList);
  													}
									?></select>
                              	<p><label>Scout Selection:</label><select name="ScoutList"></p>
                              	  <?php 
								  do {  
								  ?>
                              	  <option value="<?php echo $row_rsScoutPullDown['sid']?>"><?php echo $row_rsScoutPullDown['lname'] . ", " . $row_rsScoutPullDown['fname']?></option>
                              	  <?php
} while ($row_rsScoutPullDown = mysql_fetch_assoc($rsScoutPullDown));
  $rows = mysql_num_rows($rsScoutPullDown);
  if($rows > 0) {
      mysql_data_seek($rsScoutPullDown, 0);
	  $row_rsScoutPullDown = mysql_fetch_assoc($rsScoutPullDown);
  }
?>
                              	</select>
                                <p><label>Complete:</label><input name="completed" type="checkbox" value="Y"></p>
                                <p><input name="Compete Button" type="submit" value="Update Badge Status"></p>
                                <input type="hidden" name="MM_update" value="badgeUpdate">
                              </form></p>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              
                            </div>
                        </section><!-- /.about-text --> 
                        
                        <section id="badges-text" class="inactive">
                            <h2 class="text-center">Start Badge</h2>
                            <div class="col-sm-6 col-md-6">
                              <p><form action="<?php echo $editFormAction; ?>" method="POST" name="insertBadge">
                              <p><label>Badge Selection:</label><select name="badgeList2">
                                <?php
								do {  
								?>
                                <option value="<?php echo $row_rsBadgeList2['bid']?>"><?php echo $row_rsBadgeList2['badge_name']?></option>
                                <?php
									} while ($row_rsBadgeList2 = mysql_fetch_assoc($rsBadgeList2));
 											 $rows = mysql_num_rows($rsBadgeList2);
  										if($rows > 0) {
      										mysql_data_seek($rsBadgeList2, 0);
	  										$row_rsBadgeList2 = mysql_fetch_assoc($rsBadgeList2);
  									}
?></select>
                              <label>Scout Selection:</label><select name="scoutList2">
                                <?php
do {  
?>
                                <option value="<?php echo $row_rsScoutList2['sid']?>"><?php echo $row_rsScoutList2['lname'] . ", " . $row_rsScoutList2['fname']?></option>
                                <?php
} while ($row_rsScoutList2 = mysql_fetch_assoc($rsScoutList2));
  $rows = mysql_num_rows($rsScoutList2);
  if($rows > 0) {
      mysql_data_seek($rsScoutList2, 0);
	  $row_rsScoutList2 = mysql_fetch_assoc($rsScoutList2);
  }
?></select>
								<p><label>Start Badge:</label><input name="startBadge" type="checkbox" value="N"><p/>
                                <input name="Start Badge" type="submit">
                                <input type="hidden" name="MM_insert" value="insertBadge">
                              </form></p>
                              
                            </div>
                            <div class="col-sm-6 col-md-6">
                              
                            </div>
                        </section><!-- /.about-text --> 

                        <section id="requirement-text" class="inactive">
                            <h2 class="text-center">View Badge Requirements</h2>
                            <div class="col-sm-4 col-md-4">
                                <h3>Natural World</h3>
                                <p></p>
                            </div>
                        </section><!-- /.services-text -->    
                        
                        <section id="badgestatus-text" class="inactive">
                            <h2 class="text-center">View Badge Status</h2>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Current Badge Status</h3>
                                <p></p>
                             <p2><table width="540" border="0" align="center" cellpadding="0" cellspacing="5">
                                  <tr>
                                    <td><b>First Name</b></td>
                                    <td><b>Last Name</b></td>
                                    <td><b>Badge</b></td>
                                    <td><b>Completed</b></td>
                                    <td><b>Last Updated</b></td>
                                  </tr>
                                  <?php do { ?>
                                    <tr>
                                      <td><?php echo $row_rsCurrentBadges['fname']; ?></td>
                                      <td><?php echo $row_rsCurrentBadges['lname']; ?></td>
                                      <td><?php echo $row_rsCurrentBadges['badge_name']; ?></td>
                                      <td><?php echo $row_rsCurrentBadges['completed']; ?></td>
                                      <td><?php echo $row_rsCurrentBadges['last_updated']; ?></td>
                                    </tr>
                                    <?php } while ($row_rsCurrentBadges = mysql_fetch_assoc($rsCurrentBadges)); ?>
                                </table></p2>
<p2><a href="<?php printf("%s?pageNum_rsCurrentBadges=%d%s", $currentPage, 0, $queryString_rsCurrentBadges); ?>">First</a>
   <a href="<?php printf("%s?pageNum_rsCurrentBadges=%d%s", $currentPage, max(0, $pageNum_rsCurrentBadges - 1), $queryString_rsCurrentBadges); ?>">Previous</a> 
   <a href="<?php printf("%s?pageNum_rsCurrentBadges=%d%s", $currentPage, min($totalPages_rsCurrentBadges, $pageNum_rsCurrentBadges + 1), $queryString_rsCurrentBadges); ?>">Next</a> 
   <a href="<?php printf("%s?pageNum_rsCurrentBadges=%d%s", $currentPage, $totalPages_rsCurrentBadges, $queryString_rsCurrentBadges); ?>">Last</a> Total Scouts:<?php echo $totalRows_rsCurrentBadges ?></p2>
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
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {maxChars:30});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {maxChars:30});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "phone_number", {isRequired:false, useCharacterMasking:true});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"yyyy/mm/dd", useCharacterMasking:true});
    </script>
    </body>
</html>
<?php
mysql_free_result($rsBadgeList2);

mysql_free_result($rsBadgeList2);

mysql_free_result($rsScoutList2);

mysql_free_result($rankDescription);

mysql_free_result($rsScoutList);

mysql_free_result($rsCurrentBadges);

mysql_free_result($rsScoutList3);

mysql_free_result($rsBadgeList);

mysql_free_result($rsScoutPullDown);

mysql_free_result($RSdeletePage);
?>
