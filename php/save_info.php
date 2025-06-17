<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'connect.php';
    $hash = bin2hex(random_bytes(16));
    foreach ($_POST as $key => $value) {

        if (!is_numeric($key)) continue;

        $sql = "SELECT * FROM inputs WHERE id = $key";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Erro na consulta: " . $conn->error;
            continue;
        }
        while ($row = $result->fetch_assoc()) {
            $template_id = $_POST['template_id'];
            
            if (is_array($value)) {
                $response = implode(';', $value);
            } else {
                $response = $value;
            }

            $input_id = $row['id'];
            
            $template_id = (int)$template_id;
            $input_id = (int)$input_id;
            $sql_insert = "INSERT INTO template_response (template_id, input_id, response, hash) VALUES ($template_id, $input_id, '$response', '$hash')";
            if (!$conn->query($sql_insert)) {
                echo "Erro ao inserir: " . $conn->error;
            }
        }
    }
}
?>
