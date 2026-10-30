<?php
require 'C:\xampp\htdocs\projetogaragembr-main\config\db.php';
try {
    $pdo = Database::getConnection();
    $count = $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
    echo 'USERS=' . $count . PHP_EOL;
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    echo 'TABLES=' . count($tables) . PHP_EOL;
} catch (Throwable $e) {
    echo 'ERR=' . $e->getMessage() . PHP_EOL;
}
