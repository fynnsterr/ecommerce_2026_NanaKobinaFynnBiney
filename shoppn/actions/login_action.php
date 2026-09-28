<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CustomerController.php';

// Only run on POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . 'views/login.php');
}

// Sanitize inputs
$email = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass  = $_POST['customer_pass'] ?? '';

// Basic server-side validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $pass === '') {
    $_SESSION['error'] = 'Invalid email or password.';
    redirect(BASE_URL . 'views/login.php');
}

$controller = new CustomerController();
$result = $controller->login($email, $pass);

if ($result['success']) {
    $c = $result['customer'];

    // Store user data in session
    $_SESSION['customer_id']    = $c['customer_id'];
    $_SESSION['customer_name']  = $c['customer_name'];
    $_SESSION['customer_email'] = $c['customer_email'];
    $_SESSION['user_role']      = $c['user_role'];

    redirect(BASE_URL . 'index.php');
} else {
    $_SESSION['error'] = $result['error'];
    redirect(BASE_URL . 'views/login.php');
}
?>