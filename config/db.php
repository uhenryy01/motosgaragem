<?php
class Database
{
    private static $conn = null;
    private static $databaseName = 'leilao_de_carros';

    public static function getConnection()
    {
        if (self::$conn !== null) {
            return self::$conn;
        }

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $dsnCandidates = [
            'mysql:host=localhost;dbname=' . self::$databaseName . ';charset=utf8mb4',
            'mysql:host=localhost;dbname=garagem_motores;charset=utf8mb4',
        ];

        foreach ($dsnCandidates as $dsn) {
            try {
                self::$conn = new PDO($dsn, 'root', '', $options);
                return self::$conn;
            } catch (PDOException $e) {
                continue;
            }
        }

        try {
            $fallback = new PDO('mysql:host=localhost;charset=utf8mb4', 'root', '', $options);
            $fallback->exec('CREATE DATABASE IF NOT EXISTS ' . self::$databaseName);
            self::$conn = new PDO(
                'mysql:host=localhost;dbname=' . self::$databaseName . ';charset=utf8mb4',
                'root',
                '',
                $options
            );
            return self::$conn;
        } catch (PDOException $e) {
            die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    }
}
