<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Könyv Nyilvántartó</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .button { padding: 6px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 3px; }
        .button:hover { background-color: #0056b3; }
        form input, form select, form textarea { padding: 5px; margin: 3px 0; width: 200px; }
    </style>
</head>
<body>
    <nav>
        <a href="index.php" class="button">Könyvek</a>
        <a href="index.php?action=create" class="button">Új könyv</a>
    </nav>
    <hr>
    <?= $content ?? '' ?>
</body>
</html>
