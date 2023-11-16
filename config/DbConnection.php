<?php

namespace MyApp\Config;

class DbConnection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $dbHost = 'localhost'; // Replace with your actual database host
        $dbUser = 'root'; // Replace with your actual database user
        $dbPassword = ''; // Replace with your actual database password
        $dbName = 'test'; // Replace with your actual database name

        $this->conn = new \mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
