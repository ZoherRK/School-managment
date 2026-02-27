<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>+ Afegir Professor</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/teacher/create">
        <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" id="name" name="name" required placeholder="Ex: Marc López">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="marc@escola.cat">
        </div>
        <div class="form-group">
            <label for="specialty">Especialitat</label>
            <input type="text" id="specialty" name="specialty" required placeholder="Ex: Programació Web">
        </div>
        <div style="display:flex; gap:1rem; margin-top:1.5rem;">
            <button type="submit" class="btn">Crear professor</button>
            <a href="/teacher" class="btn" style="background:#718096;">Cancel·lar</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
