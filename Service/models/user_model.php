<?php

require_once __DIR__ . '/../config/config.php';

class user_model {
    private $conn;

    public function __construct() {
        $this->conn = get_db_connection();
    }

    public function __destruct() {
        close_db_connection($this->conn);
    }

    public function login($username, $password) {
        $username = mysqli_real_escape_string($this->conn, $username);
        $query = "SELECT * FROM admins WHERE username = '$username'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    public function create_admin($username, $password) {
        $username = mysqli_real_escape_string($this->conn, $username);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO admins (username, password) VALUES ('$username', '$hashed_password')";

        return mysqli_query($this->conn, $query);
    }

    public function get_all_admins() {
        $query = "SELECT id, username, created_at FROM admins ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);

        $admins = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $admins[] = $row;
            }
        }

        return $admins;
    }
}
