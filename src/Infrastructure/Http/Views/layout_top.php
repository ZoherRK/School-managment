<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f4f8; color: #333; }
        nav { background: #1e3a5f; color: white; padding: 1rem 2rem; display: flex; gap: 1.5rem; align-items: center; }
        nav h1 { font-size: 1.2rem; margin-right: auto; }
        nav a { color: #a8d4f5; text-decoration: none; font-size: 0.9rem; }
        nav a:hover { color: white; }
        .container { max-width: 960px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: white; border-radius: 8px; padding: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,.08); margin-bottom: 1.5rem; }
        h2 { color: #1e3a5f; margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1e3a5f; color: white; padding: .6rem 1rem; text-align: left; }
        td { padding: .6rem 1rem; border-bottom: 1px solid #e2e8f0; }
        tr:hover td { background: #f7fafd; }
        .btn { display: inline-block; padding: .5rem 1.2rem; background: #1e3a5f; color: white; border-radius: 4px; text-decoration: none; font-size: .9rem; border: none; cursor: pointer; }
        .btn:hover { background: #2a5298; }
        .btn-sm { padding: .3rem .8rem; font-size: .8rem; }
        .btn-success { background: #2d8a4e; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-weight: 600; margin-bottom: .3rem; font-size: .9rem; }
        input, select, textarea { width: 100%; padding: .5rem .8rem; border: 1px solid #cbd5e0; border-radius: 4px; font-size: .95rem; }
        input:focus, select:focus { outline: none; border-color: #1e3a5f; }
        .alert { padding: .8rem 1rem; border-radius: 4px; margin-bottom: 1rem; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .badge { display: inline-block; padding: .2rem .6rem; border-radius: 12px; font-size: .75rem; font-weight: 600; }
        .badge-blue { background: #bee3f8; color: #2b6cb0; }
        .badge-green { background: #c6f6d5; color: #276749; }
    </style>
</head>
<body>
<nav>
    <h1>🏫 School Management</h1>
    <a href="/">Inici</a>
    <a href="/student">Alumnes</a>
    <a href="/teacher">Professors</a>
    <a href="/course">Cursos</a>
    <a href="/subject">Assignatures</a>
</nav>
<div class="container">
