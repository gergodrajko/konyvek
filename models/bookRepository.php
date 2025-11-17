<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/Book.php';

class BookRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findAll(array $filters = []): array {
        $filterSql = "";
        $params = [];

        if (!empty($filters['author'])) {
            $filterSql .= " AND a.name LIKE :author";
            $params[':author'] = '%' . $filters['author'] . '%';
        }
        if (!empty($filters['publisher'])) {
            $filterSql .= " AND p.name LIKE :publisher";
            $params[':publisher'] = '%' . $filters['publisher'] . '%';
        }
        if (!empty($filters['category'])) {
            $filterSql .= " AND c.name LIKE :category";
            $params[':category'] = '%' . $filters['category'] . '%';
        }
        if (!empty($filters['id'])) {
            $filterSql .= " AND b.id = :id";
            $params[':id'] = $filters['id'];
        }

        $sql = "
            SELECT
                b.id, b.title, b.isbn, b.price, b.description, b.cover_url, b.ratings,
                a.name AS author, p.name AS publisher, c.name AS category
            FROM books b
            LEFT JOIN authors a ON b.author_id = a.id
            LEFT JOIN publishers p ON b.publisher_id = p.id
            LEFT JOIN categories c ON b.category_id = c.id
            WHERE 1=1 $filterSql
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        $book = $stmt->fetch();
        return $book ?: null;
    }

    public function create(Book $book): int {
        $stmt = $this->pdo->prepare("
            INSERT INTO books (title, isbn, price, description, cover_url, ratings, author_id, publisher_id, category_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $book->title,
            $book->isbn,
            $book->price,
            $book->description,
            $book->cover_url,
            $book->ratings,
            $book->author_id,
            $book->publisher_id,
            $book->category_id
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, Book $book): bool {
        $stmt = $this->pdo->prepare("
            UPDATE books SET
                title=?, isbn=?, price=?, description=?, cover_url=?, ratings=?, author_id=?, publisher_id=?, category_id=?
            WHERE id=?
        ");
        return $stmt->execute([
            $book->title,
            $book->isbn,
            $book->price,
            $book->description,
            $book->cover_url,
            $book->ratings,
            $book->author_id,
            $book->publisher_id,
            $book->category_id,
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getDropdownData(): array {
        return [
            'authors' => $this->pdo->query("SELECT * FROM authors")->fetchAll(),
            'publishers' => $this->pdo->query("SELECT * FROM publishers")->fetchAll(),
            'categories' => $this->pdo->query("SELECT * FROM categories")->fetchAll()
        ];
    }

    public function getAverageRating(): ?float {
        $stmt = $this->pdo->query("SELECT AVG(ratings) AS avg_rating FROM books WHERE ratings IS NOT NULL");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['avg_rating'] ? (float) $result['avg_rating'] : null;
    }
}
