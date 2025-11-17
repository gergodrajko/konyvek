<?php ob_start(); ?>

<h1>Könyv törlése</h1>

<p>Biztosan törölni szeretnéd a következő könyvet?</p>

<ul>
    <li><strong>Cím:</strong> <?= htmlspecialchars($book['title']) ?></li>
    <li><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']) ?></li>
    <li><strong>Ár:</strong> <?= htmlspecialchars($book['price']) ?> Ft</li>
    <li><strong>Leírás:</strong> <?= htmlspecialchars($book['description']) ?></li>
    <li><strong>Szerző:</strong> <?= htmlspecialchars($book['author']) ?></li>
    <li><strong>Kiadó:</strong> <?= htmlspecialchars($book['publisher']) ?></li>
    <li><strong>Kategória:</strong> <?= htmlspecialchars($book['category']) ?></li>
    <li><strong>Értékelés:</strong> <?= !empty($book['ratings']) ? htmlspecialchars($book['ratings']) . '/5' : 'Nincs értékelés' ?></li>
    <?php if (!empty($book['cover_url'])): ?>
    <li><strong>Könyv borító:</strong> <img src="<?= htmlspecialchars($book['cover_url']) ?>" alt="Könyv borító" style="max-width: 200px; max-height: 200px;"></li>
    <?php endif; ?>
</ul>

<form method="post">
    <button type="submit">Igen, törlés</button>
    <a href="index.php" class="button">Mégsem</a>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
