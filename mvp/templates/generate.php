
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
	if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
		header("Location: /mvp/templates/login");
		exit;
	}

	require_once '../php/connect.php';

	if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['template_name'])) {
		$searchfor = $conn->real_escape_string($_GET['template_name']);
		$result = $conn->query("SELECT data FROM templates WHERE template_name = '$searchfor'");
		if ($result && $row = $result->fetch_assoc()) {
			$array = json_decode($row['data'], true);
		} else {
			exit;
		}
	} else {
		exit;
	}
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
            <form action="/mvp/php/save_info" method="post">
                <?php foreach ($array as $item): ?>
                    <?php
                    switch ($item['type']) {
                        case 'radio':
                            $title = $item['title'];
                            $name = $item['name'];
                            $labels = $item['labels'];
                            $values = $item['values'];
                            echo '<div class="form-group">
                                    <label>'.$title.'</label>
                                    <div class="radio-group">';
                            for ($i = 0; $i < count($values); $i++) {
                                $value = htmlspecialchars($values[$i]);
                                $label = htmlspecialchars($labels[$i]);
                                echo '<label class="radio-container">
                                        <input type="radio" name="'.$name.'" value="'.$value.'"'.($i === 0 ? ' checked' : '').'>
                                        <span class="custom-radio"></span>
                                        '.$label.'
                                    </label>';
                            }
                            echo '</div>
                                </div>';
                            break;

                        case 'checkbox':
                            $title = $item['title'];
                            $name = $item['name'];
                            $labels = $item['labels'];
                            $values = $item['values'];
                            echo '<div class="form-group">
                                    <label>'.$title.'</label>
                                    <div class="checkbox-group">';
                            for ($i = 0; $i < count($values); $i++) {
                                $value = htmlspecialchars($values[$i]);
                                $label = htmlspecialchars($labels[$i]);
                                echo '<label class="checkbox-container">
                                        <input type="checkbox" name="'.$name.'[]" value="'.$value.'">
                                        <span class="custom-checkbox"></span>
                                        '.$label.'
                                    </label>';
                            }
                            echo '</div>
                                </div>';
                            break;

                        case 'text':
                            $title = $item['title'];
                            $name = $item['name'];
                            echo '<div class="form-group">
                                    <label for="'.$name.'">'.$title.'</label>
                                    <input type="text" id="'.$name.'" name="'.$name.'" placeholder="Digite algo..." required>
                                </div>';
                            break;

                        case 'number':
                            $title = $item['title'];
                            $name = $item['name'];
                            echo '<div class="form-group">
                                    <label for="'.$name.'">'.$title.'</label>
                                    <input type="number" id="'.$name.'" name="'.$name.'" placeholder="Digite um número..." required>
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
