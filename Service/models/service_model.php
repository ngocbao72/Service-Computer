<?php

require_once __DIR__ . '/../config/config.php';

class service_model {
    private $conn;

    public function __construct() {
        $this->conn = get_db_connection();
    }

    public function __destruct() {
        close_db_connection($this->conn);
    }

    public function get_all_services() {
        $query = "SELECT * FROM services ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);

        $services = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $services[] = $row;
            }
        }

        return $services;
    }

    public function get_service_by_id($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT * FROM services WHERE id = '$id'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    public function create_service($name, $price, $description) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);
        $description = mysqli_real_escape_string($this->conn, $description);

        $query = "INSERT INTO services (name, price, description) VALUES ('$name', '$price', '$description')";

        return mysqli_query($this->conn, $query);
    }

    public function update_service($id, $name, $price, $description) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $name = mysqli_real_escape_string($this->conn, $name);
        $price = mysqli_real_escape_string($this->conn, $price);
        $description = mysqli_real_escape_string($this->conn, $description);

        $query = "UPDATE services SET name = '$name', price = '$price', description = '$description' WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }

    public function delete_service($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "DELETE FROM services WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }
}
