<?php

require_once __DIR__ . '/../models/customer_model.php';
require_once __DIR__ . '/../models/issue_model.php';

class customer_controller {
    private $customer_model;
    private $issue_model;

    public function __construct() {
        $this->customer_model = new customer_model();
        $this->issue_model = new issue_model();
    }

    public function submit_issue($name, $phone, $email, $service_id, $description) {
        if (empty($name) || empty($phone) || empty($service_id) || empty($description)) {
            return ['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin bắt buộc'];
        }

        if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            return ['success' => false, 'message' => 'Số điện thoại không hợp lệ'];
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email không hợp lệ'];
        }

        $customer_id = $this->customer_model->create_customer($name, $phone, $email);

        if ($customer_id) {
            $issue_result = $this->issue_model->create_issue($customer_id, $service_id, $description);

            if ($issue_result) {
                return ['success' => true, 'message' => 'Gửi yêu cầu thành công! Chúng tôi sẽ liên hệ với bạn sớm'];
            }
        }

        return ['success' => false, 'message' => 'Gửi yêu cầu thất bại. Vui lòng thử lại'];
    }

    public function list_customers() {
        return $this->customer_model->get_all_customers();
    }

    public function get_customer($id) {
        return $this->customer_model->get_customer_by_id($id);
    }

    public function remove_customer($id) {
        if (empty($id)) {
            return ['success' => false, 'message' => 'ID không hợp lệ'];
        }

        $result = $this->customer_model->delete_customer($id);

        if ($result) {
            return ['success' => true, 'message' => 'Xóa khách hàng thành công'];
        }

        return ['success' => false, 'message' => 'Xóa khách hàng thất bại'];
    }
}
