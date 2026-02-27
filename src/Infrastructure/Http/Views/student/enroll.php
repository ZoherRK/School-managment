<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>✓ Matricular Alumne</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($students) || empty($courses)): ?>
        <div class="alert alert-error">
            Cal tenir almenys un alumne i un curs per poder matricular.
            <?php if (empty($students)): ?><a href="/student/create">Crea un alumne</a>. <?php endif; ?>
            <?php if (empty($courses)): ?><a href="/course/create">Crea un curs</a>.<?php endif; ?>
        </div>
    <?php else: ?>
        <form method="POST" action="/student/enroll">
            <div class="form-group">
                <label for="student_id">Alumne</label>
                <select id="student_id" name="student_id" required>
                    <option value="">-- Selecciona alumne --</option>
                    <?php foreach ($students as $s): ?>
                        <option value="<?= $s->id()->value() ?>">
                            <?= htmlspecialchars($s->name()) ?> (<?= htmlspecialchars($s->email()) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
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
                <button type="submit" class="btn btn-success">Matricular</button>
                <a href="/student" class="btn" style="background:#718096;">Cancel·lar</a>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
