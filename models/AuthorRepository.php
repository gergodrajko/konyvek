<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class AuthorRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function create(string $name, ?string $bio): int {
        $stmt = $this->pdo->prepare("INSERT INTO authors (name, bio) VALUES (?, ?)");
        $stmt->execute([$name, $bio]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findAll(): array {
        return $this->pdo->query("SELECT * FROM authors")->fetchAll(PDO::FETCH_ASSOC);
    }
}
