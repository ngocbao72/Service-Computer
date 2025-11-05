<?php

require_once __DIR__ . '/../config/config.php';

class customer_model {
    private $conn;

    public function __construct() {
        $this->conn = get_db_connection();
    }

    public function __destruct() {
        close_db_connection($this->conn);
    }

    public function get_all_customers() {
        $query = "SELECT * FROM customers ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);

        $customers = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $customers[] = $row;
            }
        }

        return $customers;
    }

    public function get_customer_by_id($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT * FROM customers WHERE id = '$id'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    public function create_customer($name, $phone, $email) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $email = mysqli_real_escape_string($this->conn, $email);

        $query = "INSERT INTO customers (name, phone, email) VALUES ('$name', '$phone', '$email')";

        if (mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);
        }

        return false;
    }

    public function update_customer($id, $name, $phone, $email) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $name = mysqli_real_escape_string($this->conn, $name);
        $phone = mysqli_real_escape_string($this->conn, $phone);
        $email = mysqli_real_escape_string($this->conn, $email);

        $query = "UPDATE customers SET name = '$name', phone = '$phone', email = '$email' WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }

    public function delete_customer($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "DELETE FROM customers WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }
}
