<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class PublisherRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function create(string $name): int {
        $stmt = $this->pdo->prepare("INSERT INTO publishers (name) VALUES (?)");
        $stmt->execute([$name]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findAll(): array {
        return $this->pdo->query("SELECT * FROM publishers")->fetchAll(PDO::FETCH_ASSOC);
    }
}
