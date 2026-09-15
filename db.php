<?php
$host = "localhost";
$db_user = "nana.biney";
$db_pass = "YOUR_MYSQL_PASSWORD_HERE";
$db_name = "ecommerce_2026A_nana_biney";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>