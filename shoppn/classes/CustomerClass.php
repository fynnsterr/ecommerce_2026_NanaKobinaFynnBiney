<?php
require_once __DIR__ . '/../core/db_class.php';

class CustomerClass extends Database {

    // Check if email already exists
    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT customer_email FROM customer WHERE customer_email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    // Add new customer
    public function addCustomer($name, $email, $pass, $country, $city, $contact) {
        // Hash the password securely before passing it to the DB
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare(
            "INSERT INTO customer 
            (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact) 
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("ssssss", $name, $email, $hash, $country, $city, $contact);

        if ($stmt->execute()) {
            $id = $this->conn->insert_id;
            $stmt->close();
            return $id;
        }

        $stmt->close();
        return false;
    }

        // Get a single customer by email
    public function getCustomerByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM customer WHERE customer_email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ?: false;
    }

    // Verify login credentials
    public function login($email, $pass) {
        $row = $this->getCustomerByEmail($email);
        // password_verify checks the plain text password against the hash in the DB
        if ($row && password_verify($pass, $row['customer_pass'])) {
            return $row;
        }
        return false;
    }
}
?>