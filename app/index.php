<?php
include_once "config/database/DatabaseConnection.php"; 

try {
    $databaseConnection = new DatabaseConnection();
    $pdo = $databaseConnection->getConnection();
    echo "Success: Connected to  the database successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
