<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '722005');
define('DB_NAME', 'servicefix_db');

function get_db_connection() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conn) {
        die("Kết nối database thất bại: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8mb4");

    return $conn;
}

function close_db_connection($conn) {
    if ($conn) {
        mysqli_close($conn);
    }
}
