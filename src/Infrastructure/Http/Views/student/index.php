<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <h2>👨‍🎓 Alumnes</h2>
        <div style="display:flex; gap:.5rem;">
            <a href="/student/create" class="btn btn-sm">+ Afegir alumne</a>
            <a href="/student/enroll" class="btn btn-sm btn-success">✓ Matricular</a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= $_GET['success'] === 'created' ? 'Alumne creat correctament!' : 'Alumne matriculat correctament!' ?>
        </div>
    <?php endif; ?>

    <?php if (empty($students)): ?>
        <p style="color:#888;">No hi ha alumnes registrats. <a href="/student/create">Crea el primer!</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nom</th><th>Email</th><th>Data registre</th></tr>
            </thead>
            <tbody>
                <?php foreach ($students as $s): ?>
                    <tr>
                        <td><?= htmlspecialchars($s->name()) ?></td>
                        <td><?= htmlspecialchars($s->email()) ?></td>
                        <td><?= $s->createdAt()->format('d/m/Y') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
