<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ta_webdas-3";
$is_connection_success = mysql_connect($host, $username, $password);
if ($is_connection_success) {
  $is_database_selected = mysql_select_db($database);
  if (!$is_database_selected) {
    mysql_error();
  }
} else {
  mysql_error();
}
?>
