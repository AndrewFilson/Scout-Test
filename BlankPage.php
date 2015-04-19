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

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsBlankPage = "SELECT * FROM scouts ORDER BY lname ASC";
$rsBlankPage = mysql_query($query_rsBlankPage, $scouts_dev) or die(mysql_error());
$row_rsBlankPage = mysql_fetch_assoc($rsBlankPage);
$totalRows_rsBlankPage = mysql_num_rows($rsBlankPage);$colname_rsBlankPage = "-1";
if (isset($_POST['txt_search'])) {
  $colname_rsBlankPage = $_POST['txt_search'];
}
mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsBlankPage = sprintf("SELECT * FROM scouts WHERE lname = %s ORDER BY lname ASC", GetSQLValueString($colname_rsBlankPage, "text"));
$rsBlankPage = mysql_query($query_rsBlankPage, $scouts_dev) or die(mysql_error());
$row_rsBlankPage = mysql_fetch_assoc($rsBlankPage);
$totalRows_rsBlankPage = mysql_num_rows($rsBlankPage);

$maxRows_rsBlankPage = 10;
$pageNum_rsBlankPage = 0;
if (isset($_GET['pageNum_rsBlankPage'])) {
  $pageNum_rsBlankPage = $_GET['pageNum_rsBlankPage'];
}
$startRow_rsBlankPage = $pageNum_rsBlankPage * $maxRows_rsBlankPage;

$colname_rsBlankPage = "-1";

mysql_select_db($database_scouts_dev, $scouts_dev);

if (isset($_POST['txt_search'])) 
{
  	$searchword = $_POST['txt_search'];
	$query_rsBlankPage = "SELECT * FROM scouts WHERE lname LIKE '%".$searchword."%'";
}
else
{
	$query_rsBlankPage = "SELECT * FROM scouts ORDER BY lname ASC";
}

if (isset($_GET['totalRows_rsBlankPage'])) {
  $totalRows_rsBlankPage = $_GET['totalRows_rsBlankPage'];
} else {
  $all_rsBlankPage = mysql_query($query_rsBlankPage);
  $totalRows_rsBlankPage = mysql_num_rows($all_rsBlankPage);
}
$totalPages_rsBlankPage = ceil($totalRows_rsBlankPage/$maxRows_rsBlankPage)-1;

$queryString_rsBlankPage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsBlankPage") == false && 
        stristr($param, "totalRows_rsBlankPage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsBlankPage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsBlankPage = sprintf("&totalRows_rsBlankPage=%d%s", $totalRows_rsBlankPage, $queryString_rsBlankPage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="BlankPage.php"><label>Search:</label>
  <label for="txt_search"></label>
  <input type="text" name="txt_search" id="txt_search" />
  <input type="submit" name="Search_Button" id="Search_Button" value="Submit" />
</form>
<p>&nbsp;</p>
 <p>
<table width="800" border="1">
    <tr>
      <th scope="col">Last Name</th>
      <th scope="col">First Name</th>
      <th scope="col">Rank</th>
      <th scope="col">Birthdate</th>
      <th scope="col">Phone</th>
    </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsBlankPage['lname']; ?></td>
      <td><?php echo $row_rsBlankPage['fname']; ?></td>
      <td><?php echo $row_rsBlankPage['rank']; ?></td>
      <td><?php echo $row_rsBlankPage['birth_date']; ?></td>
      <td><?php echo $row_rsBlankPage['contact']; ?></td>
    </tr>
    <?php } while ($row_rsBlankPage = mysql_fetch_assoc($rsBlankPage)); ?>
</table>
<p>&nbsp;</p>
<p><a href="BlankPage.php">Show All</a> <a href="<?php printf("%s?pageNum_rsBlankPage=%d%s", $currentPage, 0, $queryString_rsBlankPage); ?>">First</a>
			<a href="<?php printf("%s?pageNum_rsBlankPage=%d%s", $currentPage, max(0, $pageNum_rsBlankPage - 1), $queryString_rsBlankPage); ?>">Previous</a> 
            <a href="<?php printf("%s?pageNum_rsBlankPage=%d%s", $currentPage, min($totalPages_rsBlankPage, $pageNum_rsBlankPage + 1), $queryString_rsBlankPage); ?>">Next</a>
            <a href="<?php printf("%s?pageNum_rsBlankPage=%d%s", $currentPage, $totalPages_rsBlankPage, $queryString_rsBlankPage); ?>">Last</a></p>
</body>
</html>
<?php
mysql_free_result($rsBlankPage);
?>
