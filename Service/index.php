<?php

require_once __DIR__ . '/controllers/service_controller.php';
require_once __DIR__ . '/controllers/customer_controller.php';
require_once __DIR__ . '/controllers/admin_controller.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include __DIR__ . '/views/home.php';
        break;

    case 'services':
        $service_controller = new service_controller();
        $services = $service_controller->list_services();
        include __DIR__ . '/views/service_list.php';
        break;

    case 'error_form':
        $service_controller = new service_controller();
        $customer_controller = new customer_controller();
        $services = $service_controller->list_services();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $customer_controller->submit_issue(
                $_POST['name'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['service_id'],
                $_POST['description']
            );

            $success = $result['success'];
            $message = $result['message'];
        }

        include __DIR__ . '/views/error_form.php';
        break;

    case 'login':
        $admin_controller = new admin_controller();

        if ($admin_controller->is_logged_in()) {
            header('Location: index.php?page=admin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $admin_controller->login($_POST['username'], $_POST['password']);

            if ($result['success']) {
                header('Location: index.php?page=admin');
                exit;
            }

            $success = $result['success'];
            $message = $result['message'];
        }

        include __DIR__ . '/views/login.php';
        break;

    case 'logout':
        $admin_controller = new admin_controller();
        $admin_controller->logout();
        header('Location: index.php');
        exit;

    case 'admin':
        $admin_controller = new admin_controller();

        if (!$admin_controller->is_logged_in()) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status']) && isset($_POST['issue_id'])) {
            $result = $admin_controller->update_issue_status($_POST['issue_id'], $_POST['status']);
            $success = $result['success'];
            $message = $result['message'];
        }

        $issues = $admin_controller->list_issues();
        include __DIR__ . '/views/admin_dashboard.php';
        break;

    case 'admin_services':
        $admin_controller = new admin_controller();

        if (!$admin_controller->is_logged_in()) {
            header('Location: index.php?page=login');
            exit;
        }

        $service_controller = new service_controller();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_id'])) {
                $result = $service_controller->remove_service($_POST['delete_id']);
                $success = $result['success'];
                $message = $result['message'];
            } elseif (isset($_POST['edit_id'])) {
                $result = $service_controller->edit_service(
                    $_POST['edit_id'],
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['description']
                );
                $success = $result['success'];
                $message = $result['message'];

                if ($result['success']) {
                    header('Location: index.php?page=admin_services');
                    exit;
                }
            } else {
                $result = $service_controller->add_service(
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['description']
                );
                $success = $result['success'];
                $message = $result['message'];
            }
        }

        if (isset($_GET['edit_id'])) {
            $edit_service = $service_controller->get_service($_GET['edit_id']);
        }

        $services = $service_controller->list_services();
        include __DIR__ . '/views/admin_services.php';
        break;

    case 'admin_customers':
        $admin_controller = new admin_controller();

        if (!$admin_controller->is_logged_in()) {
            header('Location: index.php?page=login');
            exit;
        }

        $customer_controller = new customer_controller();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $result = $customer_controller->remove_customer($_POST['delete_id']);
            $success = $result['success'];
            $message = $result['message'];
        }

        $customers = $customer_controller->list_customers();
        include __DIR__ . '/views/admin_customers.php';
        break;

    case 'admin_issues':
        $admin_controller = new admin_controller();

        if (!$admin_controller->is_logged_in()) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_id'])) {
                $result = $admin_controller->remove_issue($_POST['delete_id']);
                $success = $result['success'];
                $message = $result['message'];
            } elseif (isset($_POST['status']) && isset($_POST['issue_id'])) {
                $result = $admin_controller->update_issue_status($_POST['issue_id'], $_POST['status']);
                $success = $result['success'];
                $message = $result['message'];
            }
        }

        $issues = $admin_controller->list_issues();
        include __DIR__ . '/views/admin_issues.php';
        break;

    case 'admin_issue_detail':
        $admin_controller = new admin_controller();

        if (!$admin_controller->is_logged_in()) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_id'])) {
                $result = $admin_controller->remove_issue($_POST['delete_id']);
                if ($result['success']) {
                    header('Location: index.php?page=admin');
                    exit;
                }
                $success = $result['success'];
                $message = $result['message'];
            } elseif (isset($_POST['status']) && isset($_POST['issue_id'])) {
                $result = $admin_controller->update_issue_status($_POST['issue_id'], $_POST['status']);
                $success = $result['success'];
                $message = $result['message'];
            }
        }

        if (isset($_GET['id'])) {
            $issue = $admin_controller->get_issue($_GET['id']);
        }

        include __DIR__ . '/views/admin_issue_detail.php';
        break;

    default:
        include __DIR__ . '/views/home.php';
        break;
}
