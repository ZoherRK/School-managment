<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>+ Afegir Curs</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/course/create">
        <div class="form-group">
            <label for="name">Nom del curs</label>
            <input type="text" id="name" name="name" required placeholder="Ex: DAW, ASIX, SMX">
        </div>
        <div class="form-group">
            <label for="description">Descripció</label>
            <input type="text" id="description" name="description" required placeholder="Descripció del curs">
        </div>
        <div class="form-group">
            <label for="year">Any</label>
            <input type="number" id="year" name="year" required value="<?= date('Y') ?>" min="2000" max="2100">
        </div>
        <div style="display:flex; gap:1rem; margin-top:1.5rem;">
            <button type="submit" class="btn">Crear curs</button>
            <a href="/course" class="btn" style="background:#718096;">Cancel·lar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
