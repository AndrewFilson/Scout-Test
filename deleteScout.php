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

if ((isset($_GET['sid'])) && ($_GET['sid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM scouts WHERE sid=%s",
                       GetSQLValueString($_GET['sid'], "int"));

  mysql_select_db($database_scouts_dev, $scouts_dev);
  $Result1 = mysql_query($deleteSQL, $scouts_dev) or die(mysql_error());

  $deleteGoTo = "scoutMaster.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsDSpage = "-1";
if (isset($_GET['sid'])) {
  $colname_rsDSpage = $_GET['sid'];
}
mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsDSpage = sprintf("SELECT * FROM scouts WHERE sid = %s", GetSQLValueString($colname_rsDSpage, "int"));
$rsDSpage = mysql_query($query_rsDSpage, $scouts_dev) or die(mysql_error());
$row_rsDSpage = mysql_fetch_assoc($rsDSpage);
$totalRows_rsDSpage = mysql_num_rows($rsDSpage);
?>
<title>deleteScout</title>
<?php
mysql_free_result($rsDSpage);
?>
