<?php
header('Content-Type: application/json');

$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_DATABASE') ?: 'erp_db';
$user = getenv('DB_USERNAME') ?: 'erp_user';
$pass = getenv('DB_PASSWORD') ?: 'erp_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo json_encode([
        "status" => "success",
        "service" => "ERP Backend API (PHP 8.2)",
        "database" => "Terhubung ke MySQL ($db)"
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
