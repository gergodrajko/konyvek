<?php
declare(strict_types=1);

require_once __DIR__ . '/../controllers/BookController.php';

$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($action) {

    case 'create':
        (new BookController())->create();
        break;

    case 'edit':
        if (!$id) die("Hiányzó ID.");
        (new BookController())->edit($id);
        break;

    case 'delete':
        if (!$id) die("Hiányzó ID.");
        (new BookController())->delete($id);
        break;

    /* 🔥 EZEKET KELL HOZZÁADNI */
    case 'new_author':
        require_once __DIR__ . '/../controllers/AuthorController.php';
        (new AuthorController())->create();
        break;

    case 'new_publisher':
        require_once __DIR__ . '/../controllers/PublisherController.php';
        (new PublisherController())->create();
        break;

    case 'new_category':
        require_once __DIR__ . '/../controllers/CategoryController.php';
        (new CategoryController())->create();
        break;

    default:
        (new BookController())->index();
        break;
}
