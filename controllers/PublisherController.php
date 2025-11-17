<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/PublisherRepository.php';

class PublisherController {
    private PublisherRepository $repo;

    public function __construct() {
        $this->repo = new PublisherRepository();
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $this->repo->create($name);

            header("Location: index.php?action=create");
            exit;
        }

        require __DIR__ . '/../views/publishers/create.php';
    }
}
