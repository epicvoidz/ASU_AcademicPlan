<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$servername = "localhost";  // Found in your VS Code settings
$port = "3306";  // MySQL default port
$username = "root";  // MySQL username from your settings
$password = "CS4522025";  // Empty password (as per your settings)
$dbname = "catalog";  // Your MySQL database name

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8", 
                   $username, 
                   $password,
                   [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    echo json_encode(["success" => "Database connected successfully"]);

} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit;
}
?>
