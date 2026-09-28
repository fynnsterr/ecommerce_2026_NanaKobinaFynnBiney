<?php
// Start session on every page
session_start();

// Set timezone
date_default_timezone_set('Africa/Accra');

// Define base URL for easy linking
define('BASE_URL', '/shoppn/');

// Require the database base class
require_once __DIR__ . '/db_class.php';

//helper functions

function get_ip() {
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function is_logged_in() {
    return isset($_SESSION['customer_id']);
}

function is_admin() {
    return isset($_SESSION['user_role']) && (int)$_SESSION['user_role'] === 1;
}

function require_login() {
    if (!is_logged_in()) {
        $_SESSION['error'] = 'Please login first.';
        redirect(BASE_URL . 'views/login.php');
    }
}

function require_admin() {
    if (!is_admin()) {
        $_SESSION['error'] = 'Admin access required.';
        redirect(BASE_URL . 'index.php');
    }
}
?>