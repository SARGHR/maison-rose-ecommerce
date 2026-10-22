<?php
class Database {
    public static function connect(): PDO {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $database = getenv('DB_NAME') ?: 'maison_rose';
        $user = getenv('DB_USER') ?: 'maisonrose';
        $password = getenv('DB_PASSWORD') ?: '';
        return new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }
}
