<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>+ Afegir Alumne</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/student/create">
        <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" required placeholder="Ex: Anna García López">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="anna@escola.cat">
        </div>
        <div style="display:flex; gap:1rem; margin-top:1.5rem;">
            <button type="submit" class="btn">Crear alumne</button>
            <a href="/student" class="btn" style="background:#718096;">Cancel·lar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
