<?php
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
        header("Location: /mvp/templates/login.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Dashboard - MVP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../static/css/dashboard.css">
    </head>

    <body style="display: flex; flex-direction: column; min-height: 100vh;">

        <header class="header-mvp">
            <div class="header-left">
                <a href="/mvp/templates/dashboard.php" class="dashboard-link">&#8592; Dashboard</a>
            </div>
            <div class="header-center">
                MVP - Criar Template
            </div>
            <div class="header-right" style="justify-content:right;">
                <a href="/mvp/php/logout.php" class="logout-link">Logout</a>
            </div>
        </header>
        <main>
            <div class="dashboard-container">
                <a href="dados" class="dashboard-link">Acesso a Dados
                    Coletados</a>
                <a href="create_template.php" class="dashboard-link">Criar Novo
                    Template</a>
                <a href="templates_list.php" class="dashboard-link">Visualizar
                    Templates</a>
            </div>
        </main>
    </body>

</html>

