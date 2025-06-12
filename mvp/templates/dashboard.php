<?php
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
        header("Location: /mvp/templates/login");
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
        <header>
            MVP - Dashboard
        </header>
        <main>
            <div class="dashboard-container">
                <a href="dados" class="dashboard-link">Acesso a Dados
                    Coletados</a>
                <a href="create_template" class="dashboard-link">Criar Novo
                    Template</a>
                <a href="templates_list" class="dashboard-link">Visualizar
                    Templates</a>
            </div>
        </main>

        <footer>
            &copy; 2025 MVP. Todos os direitos reservados.
        </footer>
    </body>

</html>

