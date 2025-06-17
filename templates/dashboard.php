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
        <header style="display: flex; justify-content: space-between; align-items: center; padding: 16px;">
            <span>MVP - Dashboard</span>
            <form action="logout.php" method="post" style="margin: 0;">
            <button type="submit">Logout</button>
            </form>
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

