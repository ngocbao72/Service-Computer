<?php

require_once __DIR__ . '/../models/user_model.php';
require_once __DIR__ . '/../models/issue_model.php';

class admin_controller {
    private $user_model;
    private $issue_model;

    public function __construct() {
        $this->user_model = new user_model();
        $this->issue_model = new issue_model();
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            return ['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin'];
        }

        $user = $this->user_model->login($username, $password);

        if ($user) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            return ['success' => true, 'message' => 'Đăng nhập thành công'];
        }

        return ['success' => false, 'message' => 'Tên đăng nhập hoặc mật khẩu không đúng'];
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        return ['success' => true, 'message' => 'Đăng xuất thành công'];
    }

    public function is_logged_in() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public function list_issues() {
        return $this->issue_model->get_all_issues();
    }

    public function get_issue($id) {
        return $this->issue_model->get_issue_by_id($id);
    }

    public function update_issue_status($id, $status) {
        $valid_statuses = ['pending', 'in_progress', 'done'];

        if (!in_array($status, $valid_statuses)) {
            return ['success' => false, 'message' => 'Trạng thái không hợp lệ'];
        }

        $result = $this->issue_model->update_issue_status($id, $status);

        if ($result) {
            return ['success' => true, 'message' => 'Cập nhật trạng thái thành công'];
        }

        return ['success' => false, 'message' => 'Cập nhật trạng thái thất bại'];
    }

    public function remove_issue($id) {
        if (empty($id)) {
            return ['success' => false, 'message' => 'ID không hợp lệ'];
        }

        $result = $this->issue_model->delete_issue($id);

        if ($result) {
            return ['success' => true, 'message' => 'Xóa yêu cầu thành công'];
        }

        return ['success' => false, 'message' => 'Xóa yêu cầu thất bại'];
    }
}
