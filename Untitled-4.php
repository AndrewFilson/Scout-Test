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

$maxRows_rsTest = 10;
$pageNum_rsTest = 0;
if (isset($_GET['pageNum_rsTest'])) {
  $pageNum_rsTest = $_GET['pageNum_rsTest'];
}
$startRow_rsTest = $pageNum_rsTest * $maxRows_rsTest;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsTest = "SELECT scouts.fname, scouts.lname, badges.badge_name, badges_status.completed, badges_status.last_updated FROM scouts, badges, badges_status WHERE scouts.sid = badges_status.sid AND badges_status.bid = badges.bid";
$query_limit_rsTest = sprintf("%s LIMIT %d, %d", $query_rsTest, $startRow_rsTest, $maxRows_rsTest);
$rsTest = mysql_query($query_limit_rsTest, $scouts_dev) or die(mysql_error());
$row_rsTest = mysql_fetch_assoc($rsTest);

if (isset($_GET['totalRows_rsTest'])) {
  $totalRows_rsTest = $_GET['totalRows_rsTest'];
} else {
  $all_rsTest = mysql_query($query_rsTest);
  $totalRows_rsTest = mysql_num_rows($all_rsTest);
}
$totalPages_rsTest = ceil($totalRows_rsTest/$maxRows_rsTest)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<blockquote>&nbsp;</blockquote>
<table border="0">
  <tr>
    <td>fname</td>
    <td>lname</td>
    <td>badge_name</td>
    <td>completed</td>
    <td>last_updated</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsTest['fname']; ?></td>
      <td><?php echo $row_rsTest['lname']; ?></td>
      <td><?php echo $row_rsTest['badge_name']; ?></td>
      <td><?php echo $row_rsTest['completed']; ?></td>
      <td><?php echo $row_rsTest['last_updated']; ?></td>
    </tr>
    <?php } while ($row_rsTest = mysql_fetch_assoc($rsTest)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsTest);
?>
