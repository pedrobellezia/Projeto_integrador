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
    <title>Respostas por Período - MVP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/value_tables.css">
</head>
<body>
    <header class="header-mvp">
        <div class="header-left">
            <a href="/mvp/templates/dashboard.php" class="dashboard-link">&#8592; Dashboard</a>
        </div>
        <div class="header-center">
            MVP - Respostas por Período
        </div>
        <div class="header-right" style="justify-content:right;">
            <a href="/mvp/php/logout.php" class="logout-link">Logou</a>
        </div>
    </header>
    <main>
        
        <div class="value-table-container">
            <h1>Consultar Respostas</h1>    
            
            <form class="value-table-form" method="get" action="value_tables.php" style="display:flex; flex-direction: column;">
                <div class="form-group">
                    <label for="template_id">Template:</label>
                    <select name="template_id" id="template_id" required>
                        <option value="">Selecione um template</option>
                        <?php
                        require_once '../php/connect.php';
                        $query = "SELECT id, template_name, template_desc FROM template";
                        $result = $conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = htmlspecialchars($row['id']);
                                $name = htmlspecialchars($row['template_name']);
                                echo "<option value=\"$id\">$name</option>";
                            }
                        } else {
                            echo "<option disabled>Nenhum template encontrado</option>";
                        }
                    ?>
                    </select>
                </div>
                <div style="display:flex; flex-direction: row; justify-content: space-between;">
                <div class="form-group">
                    <label for="data_inicio">Data Início:</label>
                    <input type="date" name="data_inicio" id="data_inicio" value="" style="align-self:center;">
                </div>
                <div class="form-group">
                    <label for="data_fim">Data Fim:</label>
                    <input type="date" name="data_fim" id="data_fim" value="" style="align-self:center;">
                </div>
                </div>
                <div style="display:flex; flex-direction: row; justify-content: space-between;">
    <div class="form-group">
        <label for="hora_inicio">Hora Início:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" value="" style="align-self:center;">
    </div>
    <div class="form-group">
        <label for="hora_fim">Hora Fim:</label>
        <input type="time" name="hora_fim" id="hora_fim" value="" style="align-self:center;">
    </div>
</div>
                <div class="button-group" style="display:flex; justify-content:center;">
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>