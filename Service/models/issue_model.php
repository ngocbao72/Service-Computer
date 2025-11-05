<?php

require_once __DIR__ . '/../config/config.php';

class issue_model {
    private $conn;

    public function __construct() {
        $this->conn = get_db_connection();
    }

    public function __destruct() {
        close_db_connection($this->conn);
    }

    public function get_all_issues() {
        $query = "SELECT i.*, c.name as customer_name, c.phone as customer_phone,
                  s.name as service_name, s.price as service_price
                  FROM issues i
                  LEFT JOIN customers c ON i.customer_id = c.id
                  LEFT JOIN services s ON i.service_id = s.id
                  ORDER BY i.created_at DESC";
        $result = mysqli_query($this->conn, $query);

        $issues = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $issues[] = $row;
            }
        }

        return $issues;
    }

    public function get_issue_by_id($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "SELECT i.*, c.name as customer_name, c.phone as customer_phone, c.email as customer_email,
                  s.name as service_name, s.price as service_price
                  FROM issues i
                  LEFT JOIN customers c ON i.customer_id = c.id
                  LEFT JOIN services s ON i.service_id = s.id
                  WHERE i.id = '$id'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    public function create_issue($customer_id, $service_id, $description) {
        $customer_id = mysqli_real_escape_string($this->conn, $customer_id);
        $service_id = mysqli_real_escape_string($this->conn, $service_id);
        $description = mysqli_real_escape_string($this->conn, $description);

        $query = "INSERT INTO issues (customer_id, service_id, description, status)
                  VALUES ('$customer_id', '$service_id', '$description', 'pending')";

        return mysqli_query($this->conn, $query);
    }

    public function update_issue_status($id, $status) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $status = mysqli_real_escape_string($this->conn, $status);

        $query = "UPDATE issues SET status = '$status' WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }

    public function delete_issue($id) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $query = "DELETE FROM issues WHERE id = '$id'";

        return mysqli_query($this->conn, $query);
    }
}
