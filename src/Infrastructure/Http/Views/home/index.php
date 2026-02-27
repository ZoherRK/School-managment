<?php require __DIR__ . '/../layout_top.php'; ?>

<div class="card">
    <h2>Benvingut al School Management</h2>
    <p style="margin-bottom:1.5rem; color:#555;">Gestiona alumnes, professors, cursos i assignatures seguint arquitectura DDD.</p>
    <div style="display:grid; grid-template-columns: repeat(2,1fr); gap:1rem;">
        <a href="/student" class="card" style="text-decoration:none; display:block; border-left: 4px solid #1e3a5f;">
            <strong style="font-size:1.1rem;">👨‍🎓 Gestió Alumnes</strong>
            <p style="color:#666; font-size:.9rem; margin-top:.4rem;">/student</p>
        </a>
        <a href="/teacher" class="card" style="text-decoration:none; display:block; border-left: 4px solid #2d8a4e;">
            <strong style="font-size:1.1rem;">👩‍🏫 Gestió Professors</strong>
            <p style="color:#666; font-size:.9rem; margin-top:.4rem;">/teacher</p>
        </a>
        <a href="/course" class="card" style="text-decoration:none; display:block; border-left: 4px solid #6b46c1;">
            <strong style="font-size:1.1rem;">📚 Gestió Cursos</strong>
            <p style="color:#666; font-size:.9rem; margin-top:.4rem;">/course</p>
        </a>
        <a href="/subject" class="card" style="text-decoration:none; display:block; border-left: 4px solid #c05621;">
            <strong style="font-size:1.1rem;">📖 Gestió Assignatures</strong>
            <p style="color:#666; font-size:.9rem; margin-top:.4rem;">/subject</p>
        </a>
    </div>
</div>

<?php require __DIR__ . '/../layout_bottom.php'; ?>
