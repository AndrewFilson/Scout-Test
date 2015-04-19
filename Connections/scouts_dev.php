<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_scouts_dev = "localhost";
$database_scouts_dev = "scouting";
$username_scouts_dev = "grails";
$password_scouts_dev = "grails";
$scouts_dev = mysql_pconnect($hostname_scouts_dev, $username_scouts_dev, $password_scouts_dev) or trigger_error(mysql_error(),E_USER_ERROR); 
?>