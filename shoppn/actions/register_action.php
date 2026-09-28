<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CustomerController.php';

// Only run on POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(BASE_URL . 'views/register.php');
}

// Sanitize inputs
$name    = trim(strip_tags($_POST['customer_name'] ?? ''));
$email   = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass    = $_POST['customer_pass'] ?? '';
$country = trim(strip_tags($_POST['customer_country'] ?? ''));
$city    = trim(strip_tags($_POST['customer_city'] ?? ''));
$contact = trim(strip_tags($_POST['customer_contact'] ?? ''));

$errors = [];

// Server-side validation
if (strlen($name) < 2) {
    $errors[] = 'Name must be at least 2 characters.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address.';
}
if (strlen($email) > 100) {
    $errors[] = 'Email is too long.';
}
if (strlen($pass) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
}
if (!preg_match('/^[0-9+\-\s]{7,15}$/', $contact)) {
    $errors[] = 'Contact must be 7-15 digits.';
}

if ($errors) {
    $_SESSION['error'] = implode('<br>', $errors);
    redirect(BASE_URL . 'views/register.php');
}

$controller = new CustomerController();
$result = $controller->register(compact('name', 'email', 'pass', 'country', 'city', 'contact'));

if ($result['success']) {
    // Set session variables on success
    $_SESSION['customer_id'] = $result['customer_id'];
    $_SESSION['user_role'] = 2; // Default customer role
    $_SESSION['customer_name'] = $name;
    $_SESSION['customer_email'] = $email;
    redirect(BASE_URL . 'views/account/my_account.php');
} else {
    $_SESSION['error'] = $result['error'];
    redirect(BASE_URL . 'views/register.php');
}
?>