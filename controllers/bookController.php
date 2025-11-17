<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/BookRepository.php';
require_once __DIR__ . '/../models/Book.php';

class BookController {
    private BookRepository $repo;

    public function __construct() {
        $this->repo = new BookRepository();
    }

    public function index(): void {
        $filters = [
            'author' => $_GET['author'] ?? '',
            'publisher' => $_GET['publisher'] ?? '',
            'category' => $_GET['category'] ?? '',
        ];
        $books = $this->repo->findAll($filters);
        $averageRating = $this->repo->getAverageRating();
        require __DIR__ . '/../views/books/list.php';
    }

    public function create(): void {
        $data = $this->repo->getDropdownData();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = new Book($_POST);
            if (isset($_FILES['cover_path']) && $_FILES['cover_path']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../public/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['cover_path']['name']);
                $uploadPath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['cover_path']['tmp_name'], $uploadPath)) {
                    $book->cover_url = 'uploads/' . $fileName;
                }
            }
            $bookId = $this->repo->create($book);
            header("Location: index.php");
            exit;
        }

        require __DIR__ . '/../views/books/create.php';
    }

    public function edit(int $id): void {
        $bookData = $this->repo->findById($id);
        if (!$bookData) {
            die("Könyv nem található.");
        }
        $data = $this->repo->getDropdownData();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = new Book($_POST);
            if (isset($_FILES['cover_path']) && $_FILES['cover_path']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../public/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['cover_path']['name']);
                $uploadPath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['cover_path']['tmp_name'], $uploadPath)) {
                    $book->cover_url = 'uploads/' . $fileName;
                }
            } else {
                // Keep existing cover if no new file uploaded
                $existing = $this->repo->findById($id);
                $book->cover_url = $existing['cover_url'];
            }
            $this->repo->update($id, $book);
            header("Location: index.php");
            exit;
        }

        require __DIR__ . '/../views/books/edit.php';
    }

    public function delete(int $id): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->delete($id);
            header("Location: index.php");
            exit;
        }

        $book = $this->repo->findAll(['id' => $id])[0] ?? null;
        if (!$book) {
            die("Könyv nem található.");
        }
        require __DIR__ . '/../views/books/delete_confirm.php';
    }
}
