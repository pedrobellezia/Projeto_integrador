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
    
    <body>        
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
        <div class="template-container">
            <fieldset>
                <legend>Adicionar Campos</legend>
                <div class="form-group">
                    <label for="input-type">Tipo de Input</label>
                    <select id="input-type" onchange="showCampos(); limpaCampos();" required>
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
                    <label for="field-name">identificação</label>
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

                <div style="display: flex; justify-content: center;">
                    <button type="button" onclick="adicionarCampo()" style="margin-right: 15px;">Adicionar
                        Informação</button>
                    <button type="button" onclick="document.querySelector('.template-container').style.display='none'; document.querySelector('.template-final').style.display='flex';">Finalizar</button>
                </div>

                <div id="lista-campos" style="margin-top: 1rem;"></div>
                <div id="input-retorno"></div>
            </fieldset> 
            
        </div>
        <div class="template-container template-final" style="display: None">
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
                    <button type="button" onclick="document.querySelector('.template-final').style.display='none'; document.querySelector('.template-container').style.display='flex';">Voltar</button>
                </div>
                <div id="template-retorno"></div>
            </fieldset>
        </div>
        
        

        
        <script src="../static/js/create_template.js"></script>
    </body>
</html>

