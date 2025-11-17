<?php ob_start(); ?>
<h1>Könyvek listája</h1>

<form method="get">
    <input type="hidden" name="action" value="index">
    <input type="text" name="author" placeholder="Szerző" value="<?= htmlspecialchars($_GET['author'] ?? '') ?>">
    <input type="text" name="publisher" placeholder="Kiadó" value="<?= htmlspecialchars($_GET['publisher'] ?? '') ?>">
    <input type="text" name="category" placeholder="Kategória" value="<?= htmlspecialchars($_GET['category'] ?? '') ?>">
    <button type="submit">Szűrés</button>
    <a href="index.php" class="button">Szűrő törlése</a>
</form>

<?php if ($averageRating !== null): ?>
    <p><strong>Átlagos értékelés:</strong> <?= number_format($averageRating, 2) ?>/5</p>
<?php else: ?>
    <p>Nincs elérhető értékelés.</p>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Cím</th><th>ISBN</th><th>Ár</th><th>Szerző</th><th>Kiadó</th><th>Kategória</th><th>Leírás</th><th>Értékelés</th><th>Borító</th><th>Műveletek</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= htmlspecialchars($book['isbn']) ?></td>
        <td><?= htmlspecialchars($book['price']) ?> Ft</td>
        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= htmlspecialchars($book['publisher']) ?></td>
        <td><?= htmlspecialchars($book['category']) ?></td>
        <td><?= htmlspecialchars($book['description']) ?></td>
        <td>
            <?php if (!empty($book['ratings'])): ?>
                <?= htmlspecialchars($book['ratings']) ?>/5
            <?php else: ?>
                Nincs értékelés
            <?php endif; ?>
        </td>
        <td>
            <?php if (!empty($book['cover_url'])): ?>
                <img src="<?= htmlspecialchars($book['cover_url']) ?>" alt="Könyv borító" style="max-width: 100px; max-height: 100px; border: 2px solid #ddd; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <?php else: ?>
                Nincs borító
            <?php endif; ?>
        </td>
        <td>
            <a href="index.php?action=edit&id=<?= $book['id'] ?>">Szerkeszt</a> |
            <a href="index.php?action=delete&id=<?= $book['id'] ?>">Töröl</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
