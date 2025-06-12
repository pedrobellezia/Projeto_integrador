<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Template - MVP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/templates_list.css">
</head>
<body>
    <main>
        <div class="dashboard-container">
            <h2 style="text-align:center;">Escolha um template para gerar</h2>
            <form action="/mvp/templates/generate.php" method="GET" style="display: flex; flex-direction: column; gap: 1rem;">
                <label for="template">Template:</label>
                <select id="template" name="template_name" required>
                    <option value="" disabled selected>Selecione um template</option>
                    <?php
                        require_once '../php/connect.php';
                        $query = "SELECT template_name, template_desc FROM templates";
                        $result = $conn->query($query);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $name = htmlspecialchars($row['template_name']);
                                $desc = htmlspecialchars($row['template_desc']);
                                echo "<option value=\"$name\" data-desc=\"$desc\">$name</option>";
                            }
                        } else {
                            echo "<option disabled>Nenhum template encontrado</option>";
                        }
                    ?>
                </select>
                <div class="template-description" id="template-desc"></div>
                <button type="submit" style="margin-top:1rem;">Gerar Template</button>
            </form>
            <a href="dashboard" class="dashboard-link">Voltar ao Dashboard</a>
        </div>
    </main>

    <script>
        const select = document.getElementById("template");
        const descBox = document.getElementById("template-desc");

        select.addEventListener("change", function () {
            const selectedOption = select.options[select.selectedIndex];
            const desc = selectedOption.getAttribute("data-desc");
            descBox.textContent = desc || "";
        });
    </script>
</body>
</html>
