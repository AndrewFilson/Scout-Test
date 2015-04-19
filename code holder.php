$maxRows_rsScoutList = 10;
$pageNum_rsScoutList = 0;
if (isset($_GET['pageNum_rsScoutList'])) {
  $pageNum_rsScoutList = $_GET['pageNum_rsScoutList'];
}
$startRow_rsScoutList = $pageNum_rsScoutList * $maxRows_rsScoutList;

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList = "SELECT sid, birth_date, rank, contact, fname, lname FROM scouts ORDER BY lname ASC";
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


<input id="Search" name="Search" type="submit" value="Submit">

$colname_rsScoutList = "-1";
if (isset($_POST['lname'])) {
  $colname_rsScoutList = $_POST['lname'];
}
mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList = sprintf("SELECT * FROM scouts WHERE lname = %s ORDER BY lname ASC", GetSQLValueString($colname_rsScoutList, "text"));
$query_limit_rsScoutList = sprintf("%s LIMIT %d, %d", $query_rsScoutList, $startRow_rsScoutList, $maxRows_rsScoutList);
$rsScoutList = mysql_query($query_limit_rsScoutList, $scouts_dev) or die(mysql_error());
$row_rsScoutList = mysql_fetch_assoc($rsScoutList);

$colname_rsScoutList3 = "-1";


if (isset($_POST['search_string'])) {
  $colname_rsScoutList3 = $_POST['search_string'];
}
mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList3 = sprintf("SELECT * FROM scouts WHERE lname = %s", GetSQLValueString($colname_rsScoutList3, "text"));
$rsScoutList3 = mysql_query($query_rsScoutList3, $scouts_dev) or die(mysql_error());
$row_rsScoutList3 = mysql_fetch_assoc($rsScoutList3);
$totalRows_rsScoutList3 = mysql_num_rows($rsScoutList3);

mysql_select_db($database_scouts_dev, $scouts_dev);
$query_rsScoutList = "SELECT * FROM scouts ORDER BY lname ASC";
$rsScoutList = mysql_query($query_rsScoutList, $scouts_dev) or die(mysql_error());
$row_rsScoutList = mysql_fetch_assoc($rsScoutList);
$totalRows_rsScoutList = mysql_num_rows($rsScoutList);