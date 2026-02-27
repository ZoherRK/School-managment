<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>+ Afegir Assignatura</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($courses)): ?>
        <div class="alert alert-error">Cal crear un curs primer. <a href="/course/create">Crea un curs</a>.</div>
    <?php else: ?>
        <form method="POST" action="/subject/create">
            <div class="form-group">
                <label for="name">Nom de l'assignatura</label>
                <input type="text" id="name" name="name" required placeholder="Ex: Programació Web">
            </div>
            <div class="form-group">
                <label for="credits">Crèdits</label>
                <input type="number" id="credits" name="credits" required min="1" max="12" value="6">
            </div>
            <div class="form-group">
                <label for="course_id">Curs</label>
                <select id="course_id" name="course_id" required>
                    <option value="">-- Selecciona curs --</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c->id()->value() ?>">
                            <?= htmlspecialchars($c->name()) ?> (<?= $c->year() ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="display:flex; gap:1rem; margin-top:1.5rem;">
                <button type="submit" class="btn">Crear assignatura</button>
                <a href="/subject" class="btn" style="background:#718096;">Cancel·lar</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
