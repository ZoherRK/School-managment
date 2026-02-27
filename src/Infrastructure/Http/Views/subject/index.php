<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <h2>📖 Assignatures</h2>
        <a href="/subject/create" class="btn btn-sm">+ Afegir assignatura</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Assignatura creada correctament!</div>
    <?php endif; ?>

    <?php if (empty($subjects)): ?>
        <p style="color:#888;">No hi ha assignatures. <a href="/subject/create">Crea la primera!</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nom</th><th>Crèdits</th><th>Curs</th><th>Professor</th></tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $s): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($s->name()) ?></strong></td>
                        <td><span class="badge badge-blue"><?= $s->credits() ?></span></td>
                        <td><?= htmlspecialchars($s->course()->name()) ?></td>
                        <td>
                            <?php if ($s->teacher()): ?>
                                <span class="badge badge-green"><?= htmlspecialchars($s->teacher()->name()) ?></span>
                            <?php else: ?>
                                <a href="/teacher/assign" style="color:#e53e3e; font-size:.85rem;">Sense professor</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
