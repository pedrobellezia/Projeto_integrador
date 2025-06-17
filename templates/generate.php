<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: /mvp/templates/login.php");
    exit;
}

require_once '../php/connect.php';

$template_id = null;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $template_id = intval($_GET['template_id']);
} 

$sql = "
    SELECT inputs.*
    FROM template_gen
    JOIN inputs ON template_gen.input_id = inputs.id
    WHERE template_gen.template_id = $template_id;
";

$result = $conn->query($sql);
if (!$result) {
    echo "Erro na consulta: " . $conn->error;
    exit;
}

$inputs = [];
while ($row = $result->fetch_assoc()) {
    $inputs[] = [
        'titulo' => $row['titulo'],
        'id' => $row['id'],
        'tipo' => $row['tipo'],
        'values' => explode(';', $row['value']),
        'label' => explode(';', $row['label'])
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário - MVP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/generate.css">
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">
    <header>
        MVP - Formulário
    </header>
    <main>
        <div class="form-container">
            <h2 class="form-title">Formulário Genérico</h2>
            <form action="/mvp/php/save_info.php" method="post">
                <input type="text" name="template_id" value="<?php echo htmlspecialchars($template_id); ?>" style="display:none;">
                <?php foreach ($inputs as $item): ?>
                    <?php
                    switch ($item['tipo']) {
                        case 'radio':
                            $title = $item['titulo'];
                            $id = $item['id'];
                            $labels = $item['label'];
                            $values = $item['values'];
                            echo '<div class="form-group">
                                    <label>'.$title.'</label>
                                    <div class="radio-group">';
                            for ($i = 0; $i < count($values); $i++) {
                                $value = htmlspecialchars($values[$i]);
                                $label = htmlspecialchars($labels[$i]);
                                echo '<label class="radio-container">
                                        <input type="radio" name="'.$id.'" value="'.$value.'">
                                        <span class="custom-radio"></span>
                                        '.$label.'
                                    </label>';
                            }
                            echo '</div>
                                </div>';
                            break;

                        case 'checkbox':
                            $title = $item['titulo'];
                            $id = $item['id'];
                            $labels = $item['label'];
                            $values = $item['values'];
                            echo '<div class="form-group">
                                    <label>'.$title.'</label>
                                    <div class="checkbox-group">';
                            for ($i = 0; $i < count($values); $i++) {
                                $value = htmlspecialchars($values[$i]);
                                $label = htmlspecialchars($labels[$i]);
                                echo '<label class="checkbox-container">
                                        <input type="checkbox" name="'.$id.'[]" value="'.$value.'">
                                        <span class="custom-checkbox"></span>
                                        '.$label.'
                                    </label>';
                            }
                            echo '</div>
                                </div>';
                            break;
                            
                        case 'text':
                            $title = $item['titulo'];
                            $id = $item['id'];
                            echo '<div class="form-group">
                                    <label for="'.$id.'">'.$title.'</label>
                                    <input type="text" id="'.$id.'" name="'.$id.'" placeholder="Digite algo..." required>
                                </div>';
                            break;

                        case 'number':
                            $title = $item['titulo'];
                            $id = $item['id'];
                            echo '<div class="form-group">
                                    <label for="'.$id.'">'.$title.'</label>
                                    <input type="number" id="'.$id.'" name="'.$id.'" placeholder="Digite um número..." required>
                                </div>';
                            break;
                    }
                    ?>
                <?php endforeach; ?>
                <div class="form-actions">
                    <button type="submit" class="submit-button">Enviar</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        &copy; 2025 MVP. Todos os direitos reservados.
    </footer>
</body>
</html>
