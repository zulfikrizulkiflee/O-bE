<?php
define('DB_SERVER', '111.221.46.48');
define('DB_USERNAME', 'zfikritk');
define('DB_PASSWORD', 'zul280606');
define('DB_DATABASE', 'zfikritk_obe');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>