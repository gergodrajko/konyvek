<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';

class CategoryRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function create(string $name): int {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findAll(): array {
        return $this->pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }
}
