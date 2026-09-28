<?php
require_once __DIR__ . '/../classes/CustomerClass.php';

class CustomerController {
    private $customer;

    public function __construct() {
        $this->customer = new CustomerClass();
    }

    public function register($data) {
        if ($this->customer->emailExists($data['email'])) {
            return ['success' => false, 'error' => 'Email already registered'];
        }

        $id = $this->customer->addCustomer(
            $data['name'],
            $data['email'],
            $data['pass'],
            $data['country'],
            $data['city'],
            $data['contact']
        );

        if ($id) {
            return ['success' => true, 'customer_id' => $id];
        }

        return ['success' => false, 'error' => 'Registration failed'];
    }

        public function login($email, $pass) {
        $row = $this->customer->login($email, $pass);
        if ($row) {
            return ['success' => true, 'customer' => $row];
        }
        return ['success' => false, 'error' => 'Invalid email or password'];
    }
}
?>