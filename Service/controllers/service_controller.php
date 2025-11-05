<?php

require_once __DIR__ . '/../models/service_model.php';

class service_controller {
    private $model;

    public function __construct() {
        $this->model = new service_model();
    }

    public function list_services() {
        return $this->model->get_all_services();
    }

    public function get_service($id) {
        return $this->model->get_service_by_id($id);
    }

    public function add_service($name, $price, $description) {
        if (empty($name) || empty($price)) {
            return ['success' => false, 'message' => 'Tên và giá dịch vụ không được để trống'];
        }

        if (!is_numeric($price) || $price <= 0) {
            return ['success' => false, 'message' => 'Giá dịch vụ không hợp lệ'];
        }

        $result = $this->model->create_service($name, $price, $description);

        if ($result) {
            return ['success' => true, 'message' => 'Thêm dịch vụ thành công'];
        }

        return ['success' => false, 'message' => 'Thêm dịch vụ thất bại'];
    }

    public function edit_service($id, $name, $price, $description) {
        if (empty($id) || empty($name) || empty($price)) {
            return ['success' => false, 'message' => 'Dữ liệu không hợp lệ'];
        }

        if (!is_numeric($price) || $price <= 0) {
            return ['success' => false, 'message' => 'Giá dịch vụ không hợp lệ'];
        }

        $result = $this->model->update_service($id, $name, $price, $description);

        if ($result) {
            return ['success' => true, 'message' => 'Cập nhật dịch vụ thành công'];
        }

        return ['success' => false, 'message' => 'Cập nhật dịch vụ thất bại'];
    }

    public function remove_service($id) {
        if (empty($id)) {
            return ['success' => false, 'message' => 'ID không hợp lệ'];
        }

        $result = $this->model->delete_service($id);

        if ($result) {
            return ['success' => true, 'message' => 'Xóa dịch vụ thành công'];
        }

        return ['success' => false, 'message' => 'Xóa dịch vụ thất bại'];
    }
}
