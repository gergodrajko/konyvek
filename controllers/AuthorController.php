<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/AuthorRepository.php';

class AuthorController {
    private AuthorRepository $repo;

    public function __construct() {
        $this->repo = new AuthorRepository();
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $bio = $_POST['bio'] ?? null;

            $this->repo->create($name, $bio);

            header("Location: index.php?action=create"); // vissza a könyv létrehozáshoz
            exit;
        }

        require __DIR__ . '/../views/authors/create.php';
    }
}
