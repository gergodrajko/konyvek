<?php ob_start(); ?>

<h1>Könyv szerkesztése</h1>

<form method="post" enctype="multipart/form-data">
    <label>Cím:<br>
        <input type="text" name="title" required value="<?= htmlspecialchars($bookData['title']) ?>">
    </label><br>

    <label>ISBN:<br>
        <input type="text" name="isbn" required value="<?= htmlspecialchars($bookData['isbn']) ?>">
    </label><br>

    <label>Ár:<br>
        <input type="number" step="0.01" min="0" name="price" required value="<?= htmlspecialchars($bookData['price']) ?>">
    </label><br>

    <label>Leírás:<br>
        <textarea name="description" rows="4"><?= htmlspecialchars($bookData['description']) ?></textarea>
    </label><br>

    <label>Könyv borító:<br>
        <input type="file" name="cover_path" accept="image/*">
        <?php if (!empty($bookData['cover_url'])): ?>
            <br><small>Jelenlegi borító: <img src="<?= htmlspecialchars($bookData['cover_url']) ?>" alt="Könyv borító" style="max-width: 100px; max-height: 100px;"></small>
        <?php endif; ?>
    </label><br>

    <label>Értékelés (1-5):<br>
        <select name="ratings">
            <option value="">Válassz értékelést</option>
            <option value="1" <?= $bookData['ratings'] == 1 ? 'selected' : '' ?>>1</option>
            <option value="2" <?= $bookData['ratings'] == 2 ? 'selected' : '' ?>>2</option>
            <option value="3" <?= $bookData['ratings'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="4" <?= $bookData['ratings'] == 4 ? 'selected' : '' ?>>4</option>
            <option value="5" <?= $bookData['ratings'] == 5 ? 'selected' : '' ?>>5</option>
        </select>
    </label><br>

    <label>Szerző:<br>
        <select name="author_id" required>
            <?php foreach ($data['authors'] as $author): ?>
                <option value="<?= $author['id'] ?>" <?= $author['id'] == $bookData['author_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($author['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <label>Kiadó:<br>
        <select name="publisher_id" required>
            <?php foreach ($data['publishers'] as $publisher): ?>
                <option value="<?= $publisher['id'] ?>" <?= $publisher['id'] == $bookData['publisher_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($publisher['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <label>Kategória:<br>
        <select name="category_id" required>
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $bookData['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>

    <button type="submit">Mentés</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
