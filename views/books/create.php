<?php ob_start(); ?>

<h1>Új könyv hozzáadása</h1>

<form method="post" enctype="multipart/form-data">

    <label>Cím:<br>
        <input type="text" name="title" required>
    </label><br>

    <label>ISBN:<br>
        <input type="text" name="isbn" required>
    </label><br>

    <label>Ár:<br>
        <input type="number" step="0.01" min="0" name="price" required>
    </label><br>

    <label>Leírás:<br>
        <textarea name="description" rows="4"></textarea>
    </label><br>

    <label>Könyv borító:<br>
        <input type="file" name="cover_path" accept="image/*">
    </label><br>

    <label>Értékelés (1-5):<br>
        <select name="ratings">
            <option value="">Válassz értékelést</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </label><br><br>

    <!-- Szerző -->
    <label>Szerző:<br>
        <select name="author_id" required>
            <?php foreach ($data['authors'] as $author): ?>
                <option value="<?= $author['id'] ?>"><?= htmlspecialchars($author['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <a href="index.php?action=new_author">+ Új szerző hozzáadása</a>
    <br><br>

    <!-- Kiadó -->
    <label>Kiadó:<br>
        <select name="publisher_id" required>
            <?php foreach ($data['publishers'] as $publisher): ?>
                <option value="<?= $publisher['id'] ?>"><?= htmlspecialchars($publisher['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <a href="index.php?action=new_publisher">+ Új kiadó hozzáadása</a>
    <br><br>

    <!-- Kategória -->
    <label>Kategória:<br>
        <select name="category_id" required>
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <a href="index.php?action=new_category">+ Új kategória hozzáadása</a>
    <br><br>

    <button type="submit">Mentés</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
