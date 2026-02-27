<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
        <h2>📚 Cursos</h2>
        <a href="/course/create" class="btn btn-sm">+ Afegir curs</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Curs creat correctament!</div>
    <?php endif; ?>

    <?php if (empty($courses)): ?>
        <p style="color:#888;">No hi ha cursos. <a href="/course/create">Crea el primer!</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nom</th><th>Descripció</th><th>Any</th></tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($c->name()) ?></strong></td>
                        <td><?= htmlspecialchars($c->description()) ?></td>
                        <td><span class="badge badge-blue"><?= $c->year() ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
