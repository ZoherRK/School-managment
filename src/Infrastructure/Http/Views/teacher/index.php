<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <h2>👩‍🏫 Professors</h2>
        <div style="display:flex; gap:.5rem;">
            <a href="/teacher/create" class="btn btn-sm">+ Afegir professor</a>
            <a href="/teacher/assign" class="btn btn-sm btn-success">✓ Assignar assignatura</a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= $_GET['success'] === 'created' ? 'Professor creat correctament!' : 'Professor assignat correctament!' ?>
        </div>
    <?php endif; ?>

    <?php if (empty($teachers)): ?>
        <p style="color:#888;">No hi ha professors registrats. <a href="/teacher/create">Crea el primer!</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nom</th><th>Email</th><th>Especialitat</th></tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t->name()) ?></td>
                        <td><?= htmlspecialchars($t->email()) ?></td>
                        <td><span class="badge badge-blue"><?= htmlspecialchars($t->specialty()) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
