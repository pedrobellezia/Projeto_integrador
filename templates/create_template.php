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
        <title>Criar Novo Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../static/css/create_template.css">
    </head>
    <body style="display: flex; flex-direction: row;">
        <div class="template-container" style="margin-right:10px ;">
            <fieldset style="margin-bottom: 2rem;">
                <legend>Adicionar Campos</legend>
                <div class="form-group">
                    <label for="input-type">Tipo de Input</label>
                    <select id="input-type" onchange="showCampos()" required>
                        <option value disabled selected>Selecione um tipo</option>
                        <option value="text">Texto</option>
                        <option value="number">Número</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                </div>

                <div class="form-group" id="titulo" style="Display: None;">
                    <label for="field-title">Título do Campo</label>
                    <input type="text" id="field-title" required>
                </div>

                <div class="form-group" id="nomeCampo" style="Display: None;">
                    <label for="field-name">Nome do Campo</label>
                    <input type="text" id="field-name" required>
                </div>

                <div class="form-group" id="labelCampo" style="Display: None;">
                    <label for="input-labels">Labels do Campo</label>
                    <input type="text" id="input-labels"
                        placeholder="label1; label2; label3">
                </div>

                <div class="form-group" id="valorCampo" style="Display: None;">
                    <label for="input-values">Valores do Campo</label>
                    <input type="text" id="input-values"
                        placeholder="valor1; valor2; valor3">
                </div>

                <button type="button" onclick="adicionarCampo()">Adicionar
                    Informação</button>

                <div id="lista-campos" style="margin-top: 1rem;"></div>
            </fieldset>            
        </div>
        <div class="template-container">
            <fieldset>
                <legend>Finalizar Template</legend>

                <div class="form-group">
                    <label for="template-name">Nome do Template</label>
                    <input type="text" id="template-name" required>
                </div>
                <div class="form-group">
                    <label for="template-desc">Descrição do Template</label>
                    <input type="text" id="template-desc" required>
                </div>

                <div class="button-group">
                    <button type="button" onclick="enviarCampos()">Criar
                        Template</button>
                    <a href="dashboard.php" class="button-link">Voltar</a>
                </div>
            </fieldset>
        </div>
        
        <script src="../static/js/create_template.js"></script>
    </body>
</html>