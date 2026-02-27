<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>✓ Assignar Professor a Assignatura</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($teachers) || empty($subjects)): ?>
        <div class="alert alert-error">
            Cal tenir almenys un professor i una assignatura.
            <?php if (empty($teachers)): ?><a href="/teacher/create">Crea un professor</a>. <?php endif; ?>
            <?php if (empty($subjects)): ?><a href="/subject/create">Crea una assignatura</a>.<?php endif; ?>
        </div>
    <?php else: ?>
        <form method="POST" action="/teacher/assign">
            <div class="form-group">
                <label for="teacher_id">Professor</label>
                <select id="teacher_id" name="teacher_id" required>
                    <option value="">-- Selecciona professor --</option>
                    <?php foreach ($teachers as $t): ?>
                        <option value="<?= $t->id()->value() ?>">
                            <?= htmlspecialchars($t->name()) ?> — <?= htmlspecialchars($t->specialty()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subject_id">Assignatura</label>
                <select id="subject_id" name="subject_id" required>
                    <option value="">-- Selecciona assignatura --</option>
                    <?php foreach ($subjects as $s): ?>
                        <option value="<?= $s->id()->value() ?>">
                            <?= htmlspecialchars($s->name()) ?> (<?= $s->credits() ?> crèdits) — <?= htmlspecialchars($s->course()->name()) ?>
                            <?= $s->teacher() ? ' ✓ ' . htmlspecialchars($s->teacher()->name()) : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="display:flex; gap:1rem; margin-top:1.5rem;">
                <button type="submit" class="btn btn-success">Assignar</button>
                <a href="/teacher" class="btn" style="background:#718096;">Cancel·lar</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
