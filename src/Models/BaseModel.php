<?php
namespace MyApp\Models;

use MyApp\Config\DbConnection;


class BaseModel {
    protected $conn;

    public function __construct() {
        $dbConnection = DbConnection::getInstance();
        $this->conn = $dbConnection->getConnection();
    }
}
