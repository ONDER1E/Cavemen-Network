<?php      
$db_host = $_ENV['SQL_HOST'];
$db_user = $_ENV['SQL_USER'];
$db_password = $_ENV['SQL_PASS'];
$db_name = $_ENV['SQL_DB_NAME'];
mysqli_report(MYSQLI_REPORT_OFF);
$con = @mysqli_connect($db_host, $db_user, $db_password, $db_name);
?>