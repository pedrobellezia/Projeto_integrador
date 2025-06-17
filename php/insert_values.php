
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'connect.php';
    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);    

    


    if (!isset($data['templateName']) || !isset($data['templateDesc'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Dados do template incompletos.']);
        exit;
    }

    $templateName = $data['templateName'];
    $template_desc = $data['templateDesc'];

    $checkSql = "SELECT id FROM template WHERE template_name = '$templateName' LIMIT 1";
    $result = $conn->query($checkSql);

    if ($result && $result->num_rows > 0) {
        http_response_code(409); 
        echo json_encode(['success' => false, 'message' => 'Nome do template já existe.']);
        $conn->close();
        exit;
    }

    $sql = "INSERT INTO template (template_name, template_desc) VALUES ('$templateName', '$template_desc')";
    if ($conn->query($sql)) {
        $id_template = $conn->insert_id;
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao inserir template.']);
        $conn->close();
        exit;
    }

    if (isset($data['data']) && is_array($data['data'])) {
        $inputIds = [];
        
        foreach ($data['data'] as $item) {
            $tipo = $item['tipo'] ?? '';
            $titulo = $item['titulo'] ?? '';
            $nome = $item['nome'] ?? '';
            $value = isset($item['value']) ? $item['value'] : '';
            $label = isset($item['label']) ? $item['label'] : '';

            $checkInputSql = "SELECT id FROM inputs WHERE tipo = '$tipo' AND titulo = '$titulo' AND nome = '$nome' LIMIT 1";
            $inputResult = $conn->query($checkInputSql);

            if ($inputResult && $inputResult->num_rows > 0) {
                $row = $inputResult->fetch_assoc();
                $inputIds[] = $row['id'];
            } else {
                if ($tipo === 'checkbox' || $tipo === 'radio') {
                    $insertInputSql = "INSERT INTO inputs (tipo, titulo, nome, value, label) VALUES ('$tipo', '$titulo', '$nome', '$value', '$label')";
                } else {
                    $insertInputSql = "INSERT INTO inputs (tipo, titulo, nome) VALUES ('$tipo', '$titulo', '$nome')";
                }

                if ($conn->query($insertInputSql)) {
                    $inputIds[] = $conn->insert_id;
                }
            }
        }

        foreach ($inputIds as $id_input) {
            $insertTemplateGenSql = "INSERT INTO template_gen (template_id, input_id) VALUES ($id_template, $id_input)";
            $conn->query($insertTemplateGenSql);
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'Template e inputs inseridos com sucesso.'
    ]);

    $conn->close();
}
?>
